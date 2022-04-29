<?php
  /**
   * Blog Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: Blog.class.php, v5.00 2020-07-07 18:12:05 gewa Exp $
   */
  
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Blog
  {
      const mTable = "mod_blog";
	  const cTable = "mod_blog_categories";
	  const rTable = "mod_blog_related_categories";
	  const gTable = "mod_blog_gallery";
	  const tTable = "mod_blog_tags";
	  	  
      const BLOGDATA = 'blog/data/';
	  const BLOGFILES = 'blog/datafiles/';
	  const FILES = "zip,pdf,rar,mp3";
	  const MAXIMG = 5242880;
	  const MAXFILE = 52428800;
	  
      /**
       * Blog::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  $this->Config();
	  }

      /**
       * Blog::Config()
       * 
       * @return
       */
      private function Config()
      {

          $row = File::readIni(AMODPATH . 'blog/config.ini');
		  $this->thumb_w = $row->blog->thumb_w;
		  $this->thumb_h = $row->blog->thumb_h;
		  $this->auto_approve = $row->blog->auto_approve;
		  $this->blacklist_words = $row->blog->blacklist_words;
		  $this->cdateformat = $row->blog->cdateformat;
		  $this->char_limit = $row->blog->char_limit;
		  $this->comperpage = $row->blog->comperpage;
		  $this->cperpage = $row->blog->cperpage;
		  $this->email_req = $row->blog->email_req;
		  $this->flayout = $row->blog->flayout;
		  $this->fperpage = $row->blog->fperpage;
		  $this->latestperpage = $row->blog->latestperpage;
		  $this->notify_new = $row->blog->notify_new;
		  $this->popperpage = $row->blog->popperpage;
		  $this->public_access = $row->blog->public_access;
		  $this->show_captcha = $row->blog->show_captcha;
		  $this->show_counter = $row->blog->show_counter;
		  $this->show_username = $row->blog->show_username;
		  $this->show_www = $row->blog->show_www;
		  $this->sorting = $row->blog->sorting;
		  $this->upost = $row->blog->upost;
		  $this->username_req = $row->blog->username_req;

          return ($row) ? $this : 0;
      }
	  
      /**
       * Blog::AdminIndex()
       * 
       * @return
       */
      public function AdminIndex()
      {
		  $find = isset($_POST['find']) ? Validator::sanitize($_POST['find'], "default", 30) : null;
		  
          if (isset($_GET['letter']) and $find) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title" . Lang::$lang . "` LIKE '%" . trim($find) . "%' AND `title" . Lang::$lang . "` REGEXP '^" . $letter . "'");
              $where = "WHERE `title" . Lang::$lang . "` LIKE '%" . trim($find) . "%' AND d.title" . Lang::$lang . " REGEXP '^" . $letter . "'";

          } elseif (isset($_POST['find'])) {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title" . Lang::$lang . "` LIKE '%" . trim($find) . "%'");
              $where = "WHERE d.title" . Lang::$lang . " LIKE '%" . trim($find) . "%'";

          } elseif (isset($_GET['letter'])) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $where = "WHERE d.title" . Lang::$lang . " REGEXP '^" . $letter . "'";
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE `title" . Lang::$lang . "` REGEXP '^" . $letter . "' LIMIT 1");
          } else {
			  $counter = Db::run()->count(self::mTable);
              $where = null;
          }
		  
          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "title",
                  "hits",
                  "active",
				  "memberships",
                  "category_id"))) {
                  $ord = ($order == 'DESC') ? " DESC" : " ASC";
                  $sorting = $sort . $ord;
              } else {
                  $sorting = " created DESC";
              }
          } else {
              $sorting = " created DESC";
          }

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
		    d.id,
			d.category_id,
			d.hits,
			d.like_up,
			d.like_down,
			d.active,
			d.created,
			d.title" . Lang::$lang . " AS title,
			GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'blog') as comments,
			d.thumb,
			c.name" . Lang::$lang . " AS name 
		  FROM
			`" . self::mTable . "` AS d 
			LEFT JOIN `" . self::cTable . "` AS c 
			  ON c.id = d.category_id 
			LEFT JOIN `" . Membership::mTable . "` AS m 
			  ON FIND_IN_SET(m.id, d.membership_id)
		  $where 
		  GROUP BY d.id
		  ORDER BY $sorting " . $pager->limit; 
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = Db::run()->pdoQuery($sql)->results();
          $tpl->title = Lang::$word->_MOD_AM_TITLE;
		  $tpl->pager = $pager;
          $tpl->template = 'admin/modules_/blog/view/index.tpl.php';
      }

      /**
       * Blog::Edit()
       * 
       * @param int $id
       * @return
       */
      public function Edit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_TITLE2;
          $tpl->crumbs = ['admin', 'modules', 'blog', 'edit'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Blog.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
              $tpl->langlist = App::Core()->langlist;
			  $tpl->membership_list = App::Membership()->getMembershipList();
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->categories);
			  $tpl->images = Db::run()->select(self::gTable, array("id", "name"), array("parent_id" => $row->id), "ORDER BY sorting")->results();
              $tpl->template = 'admin/modules_/blog/view/index.tpl.php';
          }
      }

      /**
       * Blog::Save()
       * 
       * @return
       */
      public function Save()
      {
		  App::Session()->set("blogtoken",Utility::randNumbers(4));
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_NEW;
		  $tpl->langlist = App::Core()->langlist;
		  $tpl->membership_list = App::Membership()->getMembershipList();
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
          $tpl->template = 'admin/modules_/blog/view/index.tpl.php';
      }
	  
      /**
       * Blog::processItem()
       * 
       * @return
       */
      public function processItem()
      {
  
		  $rules = array(
			  'layout' => array('required|numeric', Lang::$word->_MOD_AM_SUB3),
			  'show_author' => array('required|numeric', Lang::$word->_MOD_AM_SUB7),
			  'show_ratings' => array('required|numeric', Lang::$word->_MOD_AM_SUB8),
			  'show_comments' => array('required|numeric', Lang::$word->_MOD_AM_SUB9),
			  'show_sharing' => array('required|numeric', Lang::$word->_MOD_AM_SUB11),
			  'show_created' => array('required|numeric', Lang::$word->_MOD_AM_SUB6),
			  'show_like' => array('required|numeric', Lang::$word->_MOD_AM_SUB10),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array(
			  'time_end' => 'string',
			  );
		  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['title_' . $lang->abbr] = array('required|string|min_len,3|max_len,100', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $filters['title_' . $lang->abbr] = 'string';
			  $filters['slug_' . $lang->abbr] = 'string';
			  $filters['description_' . $lang->abbr] = 'string';
			  $filters['keywords_' . $lang->abbr] = 'string';
			  $filters['body_' . $lang->abbr] = 'advanced_tags';
			  $filters['tags_' . $lang->abbr] = 'string|trim';
		  }

          if (!array_key_exists('categories', $_POST)) {
              Message::$msgs['categories'] = LANG::$word->_MOD_AM_INFO1;
          }
		  
		  (Filter::$id) ? $this->_updateItem($rules, $filters) : $this->_addItem($rules, $filters);
		  
      }
	  
      /**
       * Blog::_updateItem()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _updateItem($rules, $filters)
      {

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['file']['name'])) {
			  $file = File::upload("file", self::MAXFILE, self::FILES);
		  }  
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
			  foreach (App::Core()->langlist as $i => $lang) {
                  $slug[$i] = empty($safe->{'slug_' . $lang->abbr}) 
				  ? Url::doSeo($safe->{'title_' . $lang->abbr}) 
				  : Url::doSeo($safe->{'slug_' . $lang->abbr});
                  $datam['title_' . $lang->abbr] = $safe->{'title_' . $lang->abbr};
                  $datam['slug_' . $lang->abbr] = $slug[$i];
                  $datam['keywords_' . $lang->abbr] = $safe->{'keywords_' . $lang->abbr};
                  $datam['description_' . $lang->abbr] = $safe->{'description_' . $lang->abbr};
				  $tags[$i] = (empty($safe->{'tags_' . $lang->abbr})) ? null : str_replace(array(",", " "), array("-", ""), $safe->{'tags_' . $lang->abbr});
				  $tags[$i] = Url::doSeo($tags[$i]);
				  $datam['tags_' . $lang->abbr] = str_replace("-", ",", $tags[$i]);
                  $datam['body_' . $lang->abbr] = Url::in_url($safe->{'body_' . $lang->abbr});

                  if (empty($safe->{'keywords_' . $lang->abbr}) or empty($safe->{'description_' . $lang->abbr})) {
                      parseMeta::instance($safe->{'body_' . $lang->abbr});
                      if (empty($safe->{'keywords_' . $lang->abbr})) {
                          $datam['keywords_' . $lang->abbr] = parseMeta::get_keywords();
                      }
                      if (empty($safe->{'description_' . $lang->abbr})) {
                          $datam['description_' . $lang->abbr] = parseMeta::metaText($safe->{'body_' . $lang->abbr});
                      }
                  }
			  }
              $datax = array(
                  'category_id' => intval($_POST['categories'][0]),
				  'categories' => Utility::implodeFields($_POST['categories']),
				  'membership_id' => empty($_POST['membership_id']) ? 0 : Utility::implodeFields($_POST['membership_id']),
                  'show_author' => $safe->show_author,
                  'show_ratings' => $safe->show_ratings,
				  'show_comments' => $safe->show_comments,
				  'show_sharing' => $safe->show_sharing,
				  'show_created' => $safe->show_created,
				  'show_like' => $safe->show_like,
				  'layout' => $safe->layout,
				  'user_id' => Auth::$userdata->id,
				  'active' => $safe->active,
				  'modified' => Db::toDate(),
				  'images' => Db::run()->select(self::gTable, array("name"), array("parent_id" => Filter::$id))->results('json'),
                  );
				  
			  //process thumb 
			  $row = Db::run()->first(self::mTable, array("thumb", "file"), array('id' => Filter::$id));
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::BLOGDATA . Filter::$id . '/'; 
				  $tresult = File::process($thumb, $thumbpath, false);
				  File::deleteFile($thumbpath . $row->thumb);
				  File::deleteFile($thumbpath . 'thumbs/' . $row->thumb);
                  try {
                      $img = new Image($thumbpath . $tresult['fname']);
                      $img->thumbnail($this->thumb_w, $this->thumb_h)->save($thumbpath . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $datax['thumb'] = $tresult['fname'];
			  }
			  
			  //process file 
			  if (!empty($_FILES['file']['name'])) {; 
				  $fresult = File::process($file, FMODPATH . self::BLOGFILES, false);
				  File::deleteFile(FMODPATH . self::BLOGFILES . $row->file);
				  $datax['file'] = $fresult['fname'];
			  }
	          if(Validator::post('remfile')) {
				  $datam['file'] = "NULL";
			  }

			  //process related categories 
			  Db::run()->delete(self::rTable, array('item_id' => Filter::$id));
			  foreach ($_POST['categories'] as $item):
				  $dataArray[] = array(
					  'item_id' => Filter::$id,
					  'category_id' => $item);
			  endforeach;
			  Db::run()->insertBatch(self::rTable, $dataArray);
			  
			  Db::run()->update(self::mTable, array_merge($datam, $datax), array("id" => Filter::$id));
			  
			  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_AM_ITM_UPDATE_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Blog::_addItem()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _addItem($rules, $filters)
      {

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['file']['name'])) {
			  $file = File::upload("file", self::MAXFILE, self::FILES);
		  } 

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
			  foreach (App::Core()->langlist as $i => $lang) {
                  $slug[$i] = empty($safe->{'slug_' . $lang->abbr}) 
				  ? Url::doSeo($safe->{'title_' . $lang->abbr}) 
				  : Url::doSeo($safe->{'slug_' . $lang->abbr});
                  $datam['title_' . $lang->abbr] = $safe->{'title_' . $lang->abbr};
                  $datam['slug_' . $lang->abbr] = $slug[$i];
                  $datam['keywords_' . $lang->abbr] = $safe->{'keywords_' . $lang->abbr};
                  $datam['description_' . $lang->abbr] = $safe->{'description_' . $lang->abbr};
				  $datam['tags_' . $lang->abbr] = Url::doSeo($safe->{'tags_' . $lang->abbr});
				  $datam['tags_' . $lang->abbr] = str_replace("-", ",", $datam['tags_' . $lang->abbr]);
                  $datam['body_' . $lang->abbr] = Url::in_url($safe->{'body_' . $lang->abbr});

                  if (empty($safe->{'keywords_' . $lang->abbr}) or empty($safe->{'description_' . $lang->abbr})) {
                      parseMeta::instance($safe->{'body_' . $lang->abbr});
                      if (empty($safe->{'keywords_' . $lang->abbr})) {
                          $datam['keywords_' . $lang->abbr] = parseMeta::get_keywords();
                      }
                      if (empty($safe->{'description_' . $lang->abbr})) {
                          $datam['description_' . $lang->abbr] = parseMeta::metaText($safe->{'body_' . $lang->abbr});
                      }
                  }
			  }
              $datax = array(
                  'category_id' => intval($_POST['categories'][0]),
				  'categories' => Utility::implodeFields($_POST['categories']),
				  'membership_id' => empty($_POST['membership_id']) ? 0 : Utility::implodeFields($_POST['membership_id']),
                  'show_author' => $safe->show_author,
                  'show_ratings' => $safe->show_ratings,
				  'show_comments' => $safe->show_comments,
				  'show_sharing' => $safe->show_sharing,
				  'show_created' => $safe->show_created,
				  'show_like' => $safe->show_like,
				  'layout' => $safe->layout,
				  'user_id' => Auth::$userdata->id,
				  'active' => $safe->active,
                  );
				  
			  $temp_id = App::Session()->get("blogtoken");
			  File::makeDirectory(FMODPATH . self::BLOGDATA . $temp_id . '/thumbs');
			  
			  //process thumb 
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::BLOGDATA . $temp_id . '/'; 
				  $tresult = File::process($thumb, $thumbpath, false);
                  try {
                      $img = new Image($thumbpath . $tresult['fname']);
                      $img->thumbnail($this->thumb_w, $this->thumb_h)->save($thumbpath . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $datax['thumb'] = $tresult['fname'];
			  }
			  //process file 
			  if (!empty($_FILES['file']['name'])) {; 
				  $fresult = File::process($file, FMODPATH . self::BLOGFILES, false);
				  $datax['file'] = $fresult['fname'];
			  }
			  
			  $last_id = Db::run()->insert(self::mTable, array_merge($datam, $datax))->getLastInsertId();

			  //process related categories 
			  foreach ($_POST['categories'] as $item):
				  $dataArray[] = array(
					  'item_id' => $last_id,
					  'category_id' => $item);
			  endforeach;
			  Db::run()->insertBatch(self::rTable, $dataArray);
			  
			  //process gallery 
			  if($rows = Db::run()->select(self::gTable, array("id", "parent_id"), array("parent_id" => App::Session()->get("blogtoken")))->results()) {
				  $query = "UPDATE `" . self::gTable . "` SET `parent_id` = CASE ";
				  $idlist = '';
				  foreach ($rows as $item):
					  $query .= " WHEN id = " . $item->id . " THEN " . $last_id;
					  $idlist .= $item->id . ',';
				  endforeach;
				  $idlist = substr($idlist, 0, -1);
				  $query .= "
						  END
						  WHERE id IN (" . $idlist . ")";
				  Db::run()->pdoQuery($query);
			  }
			  
			  //rename temp folder 
			  File::renameDirectory(FMODPATH . self::BLOGDATA . $temp_id, FMODPATH . self::BLOGDATA . $last_id);
				  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_AM_ITM_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  $json['redirect'] = Url::url("/admin/modules", "blog/");
				  Logger::writeLog($message);
			  } else {
				  $json['type'] = "alert";
				  $json['title'] = Lang::$word->ALERT;
				  $json['message'] = Lang::$word->NOPROCCESS;
			  }
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Blog::CategoryEdit()
       * 
       * @param int $id
       * @return
       */
      public function CategoryEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_SUB12;
          $tpl->crumbs = ['admin', 'modules', 'blog', 'category'];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Blog.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->parent_id);
		      $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
              $tpl->langlist = App::Core()->langlist;
              $tpl->template = 'admin/modules_/blog/view/index.tpl.php';
          }
      }

      /**
       * Blog::CategorySave()
       * 
       * @return
       */
      public function CategorySave()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_SUB12;
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
		  $tpl->langlist = App::Core()->langlist;
          $tpl->template = 'admin/modules_/blog/view/index.tpl.php';
      }

      /**
       * Blog::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {

		  $rules = array(
			  'parent_id' => array('required|numeric', Lang::$word->_MOD_AM_SUB13),
			  'layout' => array('required|numeric', Lang::$word->_MOD_AM_SUB15),
			  'perpage' => array('required|numeric', Lang::$word->_MOD_AM_SUB17),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  $filters = array('icon' => 'string');
			  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['name_' . $lang->abbr] = array('required|string|min_len,3|max_len,100', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $filters['name_' . $lang->abbr] = 'string';
			  $filters['slug_' . $lang->abbr] = 'string';
			  $filters['keywords_' . $lang->abbr] = 'string';
			  $filters['description_' . $lang->abbr] = 'string';
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  foreach (App::Core()->langlist as $i=> $lang) {
                  $slug[$i] = empty($safe->{'slug_' . $lang->abbr}) 
				  ? Url::doSeo($safe->{'name_' . $lang->abbr}) 
				  : Url::doSeo($safe->{'slug_' . $lang->abbr});
				  $datam['name_' . $lang->abbr] = $safe->{'name_' . $lang->abbr};
				  $datam['slug_' . $lang->abbr] = $slug[$i];
				  $datam['keywords_' . $lang->abbr] = $safe->{'keywords_' . $lang->abbr};
				  $datam['description_' . $lang->abbr] = $safe->{'description_' . $lang->abbr};
			  }

			  $datax = array(
				  'parent_id' => $safe->parent_id,
				  'layout' => $safe->layout,
				  'perpage' => $safe->perpage,
				  'icon' => $safe->icon,
				  'active' => $safe->active,
				  );
			  
			  $data = array_merge($datam, $datax);
	
			  (Filter::$id) ? Db::run()->update(self::cTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cTable, $data)->getLastInsertId();
			  if (Filter::$id) {
				  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_AM_CAT_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
				  Logger::writeLog($message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_AM_CAT_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/modules/blog/categories");
					  Logger::writeLog($message);
				  } else {
					  $json['type'] = "alert";
					  $json['title'] = Lang::$word->ALERT;
					  $json['message'] = Lang::$word->NOPROCCESS;
				  }
				  print json_encode($json);
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Blog::categoryTree()
       * 
       * @return
       */
	  public function categoryTree()
	  {
	
		  $data = Db::run()->select(self::cTable, array("id", "parent_id"," name" . Lang::$lang), null,'ORDER BY parent_id, sorting')->results();
	
		  $cats = array();
		  $result = array();
	
		  foreach ($data as $row) {
			  $cats['id'] = $row->id;
			  $cats['name'] = $row->{'name' . Lang::$lang};
			  $cats['parent_id'] = $row->parent_id;
			  $result[$row->id] = $cats;
		  }
		  return $result;
	  }

      /**
       * Blog::getCategoryDropList()
       * 
	   * @param mixed $array
	   * @param mixed $parent_id
	   * @param integer $level
	   * @param mixed $spacer
	   * @param bool $selected
       * @return
       */
	  public static function getCategoryDropList($array, $parent_id, $level = 0, $spacer = "--", $selected = false)
	  {
		  $html = '';
		  if ($array) {
			  foreach ($array as $key => $row) {
				  $sel = ($row['id'] == $selected) ? " selected=\"selected\"" : "";
	
				  if ($parent_id == $row['parent_id']) {
					  $html .= "<option value=\"" . $row['id'] . "\"" . $sel . ">";
	
					  for ($i = 0; $i < $level; $i++)
						  $html .= $spacer;
	
					  $html .= $row['name'] . "</option>\n";
					  $level++;
					  $html .= self::getCategoryDropList($array, $key, $level, $spacer, $selected);
					  $level--;
				  }
			  }
			  unset($row);
		  }
		  return $html;
	  }

      /**
       * Blog::getCatCheckList()
       * 
	   * @param mixed $array
	   * @param mixed $parent_id
	   * @param integer $level
	   * @param mixed $spacer
	   * @param bool $selected
       * @return
       */
	  public function getCatCheckList($array, $parent_id, $level = 0, $spacer = "--", $selected = false)
	  {

		  $html = '';
		  if ($array) {
			  if($selected) {
				$arr = explode(",", $selected);
				reset($arr);
			  }
			  foreach ($array as $key => $row) {
				  $active = ($selected and in_array($row['id'], $arr)) ? " checked=\"checked\"" : "";
	
				  if ($parent_id == $row['parent_id']) {
					  $html .= "<div class=\"item\"><div class=\"wojo small checkbox fitted inline\"> <input id=\"ckb_" . $row['id'] . "\" type=\"checkbox\" name=\"categories[]\" value=\"" . $row['id'] . "\"" . $active . ">";
					  $html .= "<label for=\"ckb_" . $row['id'] . "\">";
					  for ($i = 0; $i < $level; $i++)
						  $html .= $spacer;
					  
					  $html .= $row['name'] . "</label></div></div>\n";
					  $level++;
					  $html .= self::getCatCheckList($array, $key, $level, $spacer, $selected);
					  $level--;
				  }
			  }
			  unset($row);
		  }
		  return $html;
	  }

            
      /**
       * Blog::getSortCategoryList()
       * 
	   * @param array $array
       * @param integer $parent_id
       * @return
       */
	  public function getSortCategoryList($array, $parent_id = 0)
	  {
		  
		  $submenu = false;
		  $class = ($parent_id == 0) ? "parent" : "child";
		  $icon =  '<i class="icon negative trash"></i>';
		  $html = '';
	
		  foreach ($array as $key => $row) {
			  if ($row['parent_id'] == $parent_id) {
				  if ($submenu === false) {
					  $submenu = true;
					  $html .= "<ol class=\"dd-list\">\n";
				  }
				  $html .= '<li class="dd-item dd3-item clearfix" data-id="' . $row['id'] . '"><div class="dd-handle dd3-handle"></div>' 
				  . '<div class="dd3-content"><span class="actions"><a class="delCategory" data-set=\'{"option":[{"delete": "deleteCategory","title": "' . Validator::sanitize($row['name'], "chars") . '","id":' . $row['id'] . '}],"action":"delete","parent":"li"}\'>' . $icon . '</a></span>'
				  . ' <a href="' . Url::url("/admin/modules/blog/category", $row['id']) . '">' . $row['name'] . '</a>' 
				  . '</div>';
				  $html .= $this->getSortCategoryList($array, $key);
				  $html .= "</li>\n";
			  }
		  }
		  unset($row);
	
		  if ($submenu === true) {
			  $html .= "</ol>\n";
		  }
		  
		  return $html;
	  }

      /**
       * Blog::Settings()
       * 
       * @return
       */
      public function Settings()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_AM_SUB18;
		  $tpl->data = $this->Config();
          $tpl->template = 'admin/modules_/blog/view/index.tpl.php';
      }

      /**
       * Blog::processConfig()
       * 
       * @return
       */
	  public function processConfig()
	  {
	
		  $rules = array(
			  'auto_approve' => array('required|numeric', Lang::$word->_MOD_AM_SUB32),
			  'cdateformat' => array('required|string', Lang::$word->_MOD_AM_SUB36),
			  'char_limit' => array('required|numeric', Lang::$word->_MOD_AM_SUB37),
			  'comperpage' => array('required|numeric', Lang::$word->_MOD_AM_SUB22),
			  'cperpage' => array('required|numeric', Lang::$word->_MOD_AM_SUB38),
			  'email_req' => array('required|numeric', Lang::$word->_MOD_AM_SUB30),
			  'flayout' => array('required|numeric', Lang::$word->_MOD_AM_SUB33),
			  'fperpage' => array('required|numeric', Lang::$word->_MOD_AM_SUB19),
			  'latestperpage' => array('required|numeric', Lang::$word->_MOD_AM_SUB20),
			  'popperpage' => array('required|numeric', Lang::$word->_MOD_AM_SUB21),
			  'notify_new' => array('required|numeric', Lang::$word->_MOD_AM_SUB31),
			  'public_access' => array('required|numeric', Lang::$word->_MOD_AM_SUB29),
			  'show_captcha' => array('required|numeric', Lang::$word->_MOD_AM_SUB25),
			  'show_counter' => array('required|numeric', Lang::$word->_MOD_AM_SUB23),
			  'show_username' => array('required|numeric', Lang::$word->_MOD_AM_SUB27),
			  'show_www' => array('required|numeric', Lang::$word->_MOD_AM_SUB26),
			  'sorting' => array('required|string', Lang::$word->_MOD_AM_SUB34),
			  'upost' => array('required|numeric', Lang::$word->_MOD_AM_SUB28),
			  'username_req' => array('required|numeric', Lang::$word->_MOD_AM_SUB24),
			  'thumb_w' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_W),
			  'thumb_h' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_H),
			  );
			  
	      $filters = array('blacklist_words' => 'trim|string');
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
	
		  if (empty(Message::$msgs)) {
			  $data = array('blog' => array(
					  'auto_approve' => $safe->auto_approve,
					  'cdateformat' => $safe->cdateformat,
					  'char_limit' => $safe->char_limit,
					  'comperpage' => $safe->comperpage,
					  'cperpage' => $safe->cperpage,
					  'email_req' => $safe->email_req,
					  'flayout' => $safe->flayout,
					  'fperpage' => $safe->fperpage,
					  'latestperpage' => $safe->latestperpage,
					  'popperpage' => $safe->popperpage,
					  'notify_new' => $safe->notify_new,
					  'public_access' => $safe->public_access,
					  'show_captcha' => $safe->show_captcha,
					  'show_counter' => $safe->show_counter,
					  'show_username' => $safe->show_username,
					  'show_www' => $safe->show_www,
					  'sorting' => $safe->sorting,
					  'upost' => $safe->upost,
					  'username_req' => $safe->username_req,
					  'blacklist_words' => $safe->blacklist_words,
					  'thumb_w' => $safe->thumb_w,
					  'thumb_h' => $safe->thumb_h,
					  ));
	
			  Message::msgReply(File::writeIni(AMODPATH . 'blog/config.ini', $data), 'success', Lang::$word->_MOD_AM_CUPDATED);
			  Logger::writeLog(Lang::$word->_MOD_DS_CUPDATED);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Blog::catList()
       * 
       * @return
       */
      public function catList()
	  {

		  $sql = "
		  SELECT 
			c.id,
			c.parent_id,
			c.name" . Lang::$lang . " AS name,
			c.slug" . Lang::$lang . " AS slug,
			(SELECT 
			  COUNT(p.id) 
			FROM
			  " . self::mTable . " p 
			  INNER JOIN `" . self::rTable . "` rc 
				ON p.id = rc.item_id 
			WHERE rc.category_id = c.id 
			  AND p.active = ?) AS items 
		  FROM `" . self::cTable . "` AS c
		  GROUP BY c.id
		  ORDER BY parent_id, sorting;";

		  $menu = array();
		  $result = array();
		  
		  if($data = Db::run()->pdoQuery($sql, array(1))->results()) {
			  foreach ($data as $row) {
				  $menu['id'] = $row->id;
				  $menu['name'] = $row->name;
				  $menu['parent_id'] = $row->parent_id;
				  $menu['slug'] = $row->slug;
				  $menu['items'] = $row->items;
				  
				  $result[$row->id] = $menu;
			  }
		  }
		  return $result;
	  }
	  
	  /**
	   * Blog::renderCategories()
	   * 
	   * @return
	   */
	  public function renderCategories($array, $parent_id = 0, $menuid = 'blogcats', $class = 'vertical-menu')
	  {
		  
		  if(is_array($array) && count($array) > 0) {
			  $submenu = false;
			  $attr = (!$parent_id) ? ' class="' . $class . '" id="' . $menuid . '"' : ' class="menu-submenu"';
			  $attr2 = (!$parent_id) ? ' class="nav-item"' : ' class="nav-submenu-item"';
			  $icon = (!$parent_id) ? '<i class="icon open folder"></i>' :null ;
			  
			  $html = '';
	
			  foreach ($array as $key => $row) {
				  
				  if ($row['parent_id'] == $parent_id) {
					  if ($submenu === false) {
						  $submenu = true;
						  
						  $html .= "<ul" . $attr . ">\n";
					  }
	
					  $url = Url::Url('/' . App::Core()->modname['blog'] . '/' . App::Core()->modname['blog-cat'], $row['slug'] . Url::buildQuery());
	
					  $counter =  '<span>('.$row['items'].')</span> ';
					  $active = (isset(Content::$segments[2]) and Content::$segments[2] == $row['slug']) ? " active" : "normal";
					  $link = '<a href="' . $url . '" class="' . $active . '" title="' . $row['name'] . '">' . $row['name'] . $counter.'</a>';
		
					  
					  $html .= "<li>";
					  $html .= $link;
					  $html .= $this->renderCategories($array, $key);
					  $html .= "</li>\n";
				  }
			  }
			  unset($row);
			  
			  if ($submenu === true)
				  $html .= "</ul>\n";
		  }
          return $html;
      }

      /**
       * Blog::blogCombo()
       * 
       * @return
       */
      public function blogCombo()
	  {
		  $data = array();
		  //archive
		  $aSql = "
		  SELECT 
			YEAR(created) AS year,
			DATE_FORMAT(created, '%m') AS month,
			COUNT(id) AS total 
		  FROM
			`" . self::mTable . "` 
		  WHERE active = ? 
			AND created <= DATE_SUB(NOW(), INTERVAL 1 MONTH)
		  GROUP BY year, month 
		  ORDER BY year DESC, month DESC;";
		  $data['archive'] = Db::run()->pdoQuery($aSql, array(1))->results();

		  //popular
		  $pSql = "
		  SELECT 
			title" . Lang::$lang . " AS title,
			slug" . Lang::$lang . " AS slug,
			thumb,
			created, 
			id 
		  FROM
			`" . self::mTable . "` 
		  WHERE active = ? 
		  ORDER BY hits DESC LIMIT {$this->popperpage};";
		  $data['popular'] = Db::run()->pdoQuery($pSql, array(1))->results();
		  
		  //comments
		  $cSql = "
		  SELECT 
			c.body,
			a.title" . Lang::$lang . " AS title,
			a.slug" . Lang::$lang . " AS slug,
			c.created 
		  FROM
			`" . Modules::mcTable . "` AS c 
			LEFT JOIN `" . self::mTable . "` AS a 
			  ON a.id = c.parent_id 
		  WHERE c.section = ? 
			AND c.active = ? 
			AND a.active = ? 
		  ORDER BY c.created DESC 
		  LIMIT {$this->comperpage};";
		  $data['comments'] = Db::run()->pdoQuery($cSql, array('blog', 1, 1))->results();
		  
		  return $data;
	  }
	  
      /**
       * Blog::FrontHome()
       * 
       * @return
       */
      public static function FrontHome()
      {
          $pager = Paginator::instance();
          $pager->items_total = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE active = 1 LIMIT 1");
          $pager->default_ipp = App::Blog()->fperpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
		    a.id,
			a.created,
			a.title" . Lang::$lang . " AS title,
			a.slug" . Lang::$lang . " AS slug,
			a.body" . Lang::$lang . " AS body,
			a.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = a.id 
			  AND section = 'blog') as comments
		  FROM
			`" . self::mTable . "` AS a
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = a.category_id
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = a.user_id
		  WHERE a.active = ?  
		  ORDER BY a.created DESC " . $pager->limit; 
		  
		  $rows = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  return array("rows" => $rows, "pager" => $pager);
		  
	  }
	  
      /**
       * Blog::FrontIndex()
       * 
       * @return
       */
      public function FrontIndex()
      {
		  
		  $core = App::Core();
          $tpl = App::View(FMODPATH . 'modules/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
          $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->core = $core;
		  $tpl->data = Db::run()->first(Modules::mTable, array("title" . lang::$lang, "info" . lang::$lang, "keywords" . lang::$lang, "description" . lang::$lang), array("modalias" => "blog"));

          $pager = Paginator::instance();
          $pager->items_total = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE active = 1 LIMIT 1");
          $pager->default_ipp = $this->fperpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
		    a.id,
			a.created,
			a.title" . Lang::$lang . " AS title,
			a.slug" . Lang::$lang . " AS slug,
			a.body" . Lang::$lang . " AS body,
			a.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = a.id 
			  AND section = 'blog') as comments
		  FROM
			`" . self::mTable . "` AS a
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = a.category_id
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = a.user_id
		  WHERE a.active = ?  
		  ORDER BY a.created DESC " . $pager->limit; 
		  
		  $tpl->rows = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  $tpl->pager = $pager;
		  
		  if($tpl->data) {
			  $tpl->title = Url::formatMeta($tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->data->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->data->{'description' . Lang::$lang};
		  }
		  
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), $tpl->data->{'title' . Lang::$lang}];
		  $tpl->menu = App::Content()->menuTree(true);
		  $tpl->plugins = App::Plugins()->getModulelugins("blog");
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';

	  }

      /**
       * Blog::Category()
       * 
	   * @param str $slug
       * @return
       */
      public function Category($slug)
      {
		  
		  $core = App::Core();
		  
		  $tpl = App::View(FMODPATH . 'modules/');
		  $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->core = $core;
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "blog"));
		  $tpl->menu = App::Content()->menuTree(true);
	
		  if (!$tpl->row = Db::run()->first(self::cTable, null, array("slug" . Lang::$lang => $slug))) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Blog.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
				  list($sort, $order) = explode("|", $_GET['order']);
				  $sort = Validator::sanitize($sort, "default", 16);
				  $order = Validator::sanitize($order, "default", 4);
				  if (in_array($sort, array(
					  "title",
					  "rating",
					  "hits",
					  "memberships",
					  "created"))) {
					  $ord = ($order == 'DESC') ? " DESC" : " ASC";
					  $sorting = $sort . $ord;
				  } else {
					  $sorting = " created DESC";
				  }
			  } else {
				  $sorting = " created DESC";
			  }
			  
			  $pSql = "
			  SELECT 
				COUNT(a.id) 
			  FROM
				`" . self::mTable . "` AS a 
				INNER JOIN `" . self::rTable . "` AS rc 
				  ON a.id = rc.item_id 
			  WHERE rc.category_id = " . $tpl->row->id . " 
				AND a.active = 1 
			  LIMIT 1;";
		  
			  $pager = Paginator::instance();
			  $pager->items_total = Db::run()->count(false, false, $pSql);
			  $pager->default_ipp = $tpl->row->perpage;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();

			  $sql = "
			  SELECT 
				a.id,
				a.created,
				a.title" . Lang::$lang . " AS title,
				a.slug" . Lang::$lang . " AS slug,
				a.body" . Lang::$lang . " AS body,
				a.thumb,
				a.rating,
				a.membership_id,
				c.slug" . Lang::$lang . " AS cslug,
				c.name" . Lang::$lang . " AS ctitle,
				GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships,
				(SELECT 
				  COUNT(parent_id) 
				FROM
				  `" . Modules::mcTable . "`
				WHERE `" . Modules::mcTable . "`.parent_id = a.id 
				  AND section = 'blog') as comments
			  FROM
				`" . self::mTable . "` AS a
				LEFT JOIN `" . self::cTable . "` AS c
				  ON c.id = a.category_id
				INNER JOIN `" . self::rTable . "` AS rc 
				  ON a.id = rc.item_id
				LEFT JOIN `" . Membership::mTable . "` AS m 
				  ON FIND_IN_SET(m.id, a.membership_id)
			  WHERE rc.category_id = ?
			  AND a.active = ? 
			  AND c.active = ?  
			  GROUP BY a.id
			  ORDER BY $sorting " . $pager->limit; 

			  $tpl->rows = Db::run()->pdoQuery($sql, array($tpl->row->id, 1, 1))->results();
			  $tpl->conf = $this;
	
			  $tpl->title = Url::formatMeta($tpl->row->{'name' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['blog']), $tpl->row->{'name' . Lang::$lang}];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("blog");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  
			  $tpl->pager = $pager;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }

	  }
	  
      /**
       * Blog::Render()
       * 
	   * @param str $slug
       * @return
       */
	  public function Render($slug)
	  {
		  $core = App::Core();
		  $tpl = App::View(FMODPATH . 'modules/');
		  $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->core = $core;
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "blog"));
		  $tpl->menu = App::Content()->menuTree(true);
		  
		  $sql = "
		  SELECT 
			a.*,
			a.slug" . Lang::$lang . " as slug,
			c.slug" . Lang::$lang . " as catslug,
			c.name" . Lang::$lang . " as catname,
			CONCAT(u.fname,' ',u.lname) as user,
			u.username,
			GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships
		  FROM
			`" . self::mTable . "` AS a
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = a.user_id
			LEFT JOIN `" . self::cTable . "` AS c 
			  ON c.id = a.category_id
			LEFT JOIN `" . Membership::mTable . "` AS m 
			  ON FIND_IN_SET(m.id, a.membership_id)
		  WHERE a.slug" . Lang::$lang . " = ?
		  AND a.active = ? 
		  GROUP BY a.id;";
	
		  if (!$tpl->row = Db::run()->pdoQuery($sql, array($slug, 1))->result()) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Blog.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $this->doHits($tpl->row->id);
			  $tpl->title = Url::formatMeta($tpl->row->{'title' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};

			  $tpl->meta = '
			  <meta property="og:type" content="article" />
			  <meta property="og:title" content="' . $tpl->row->{'title' . Lang::$lang} . '" />
			  <meta property="og:image" content="' . self::hasThumb($tpl->row->thumb, $tpl->row->id) . '" />
			  <meta property="og:description" content="' . $tpl->title . '" />
			  <meta property="og:url" content="' . Url::url('/' . $core->modname['blog'], $tpl->row->slug) . '" />
			  ';
			  
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['blog']), $tpl->row->{'title' . Lang::$lang}];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("blog");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->images = Utility::jSonToArray($tpl->row->images);
			  $tpl->conf = $this;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
			  
		  }
	  }

      /**
       * Blog::Archive()
       * 
	   * @param str $year
	   * @param str $month
       * @return
       */
	  public function Archive($year, $month)
	  {
		  $core = App::Core();
		  $tpl = App::View(FMODPATH . 'modules/');
		  $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->core = $core;
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "blog"));
		  $tpl->menu = App::Content()->menuTree(true);

		  $sql = "
		  SELECT 
			a.*,
			a.slug" . Lang::$lang . " as slug,
			a.title" . Lang::$lang . " as title
		  FROM
			`" . self::mTable . "` AS a
		  WHERE a.active = ? 
		  AND YEAR(a.created) = ? 
		  AND MONTH(a.created) = ? 
		  GROUP BY a.id ORDER BY a.created DESC;";
		  
		  if (!$tpl->rows = Db::run()->pdoQuery($sql, array(1, $year, $month))->results()) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Blog.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['blog']), Lang::$word->_MOD_AM_SUB42];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("blog");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->conf = $this;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }
		  
	  }

      /**
       * Blog::Tags()
       * 
	   * @param str $tag
       * @return
       */
	  public function Tags($slug)
	  {
		  $core = App::Core();
		  $tpl = App::View(FMODPATH . 'modules/');
		  $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->core = $core;
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "blog"));
		  $tpl->menu = App::Content()->menuTree(true);

		  $sql = "
		  SELECT 
		    id,
			slug" . Lang::$lang . " as slug,
			title" . Lang::$lang . " as title, 
			thumb 
		  FROM 
			`" . self::mTable . "` 
		  WHERE tags" . Lang::$lang . " = '$slug' 
		    OR tags" . Lang::$lang . " LIKE '$slug,%' 
		    OR tags" . Lang::$lang . " LIKE '%,$slug,%' 
		    OR tags" . Lang::$lang . " LIKE '%,$slug' 
		  AND active = ?;";
		
		  if (!$tpl->rows = Db::run()->pdoQuery($sql, array(1))->results()) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Blog.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['blog']), Lang::$word->_MOD_AM_SUB79];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("blog");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->conf = $this;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }
	  }
  
      /**
       * Blog::LatestPlugin()
       * 
       * @return
       */
      public function LatestPlugin()
      {

          $sql = "
		  SELECT 
		    b.id,
			b.title" . Lang::$lang . " as title,
			b.slug" . Lang::$lang . " as slug,
			b.body" . Lang::$lang . " as body,
			b.thumb,
			u.avatar,
			CONCAT(u.fname,' ',u.lname) as name,
			u.username,
			b.created
			FROM
			  `" . self::mTable . "` as b
			  LEFT JOIN `" . Users::mTable . "` as u
			  ON u.id = b.user_id 
		  WHERE b.active = ?
		  ORDER BY b.created DESC LIMIT 0, " . $this->latestperpage; 
		  
		  $row = Db::Run()->pdoQuery($sql, array(1))->results();
		  
		  return ($row) ? $row : 0;
      } 

      /**
       * Blog::getMembershipAccess()
       * 
       * @param mixed $memid
       * @return
       */
	  public static function getMembershipAccess($memid)
	  {
          
		  $m_arr = explode(",", $memid);
		  reset($m_arr);
		  if ($memid > 0) {
			  if (App::Auth()->logged_in and in_array(App::Auth()->membership_id, $m_arr)) {
				  return true;
			  } else {
				  $rows = Db::run()->pdoQuery("SELECT title" . Lang::$lang . " as title FROM `" . Membership::mTable . "` WHERE id IN(" . $memid . ")")->results();
				  echo Utility::getSnippets(THEMEBASE . "/snippets/membershipError.tpl.php", $data = $rows);
				  return false;
			  }
		  } else {
			  return true;
		  }
	  }
	  
      /**
       * Blog::searchResults()
       * 
	   * @param string $keyword
       * @return
       */
      public function searchResults($keyword)
      {
		  $keyword = Validator::sanitize($keyword, "default", 20);
		  $sql = "
		  SELECT 
			title" . Lang::$lang . " AS title,
			body" . Lang::$lang . " AS body,
			slug" . Lang::$lang . " AS slug 
		  FROM
			`" . self::mTable . "` 
		  WHERE MATCH (title" . Lang::$lang . ") AGAINST ('" . $keyword . "*' IN BOOLEAN MODE)
		  OR MATCH (body" . Lang::$lang . ") AGAINST ('" . $keyword . "*' IN BOOLEAN MODE)
		  AND active = ?
		  ORDER BY created DESC 
		  LIMIT 10;";
		  
		  return Db::run()->pdoQuery($sql, array(1))->results();
	  }

      /**
       * Blog::doHits()
       * 
	   * @param int $id
       * @return
       */
      public function doHits($id)
      {

		  Db::run()->pdoQuery("UPDATE `" . self::mTable . "` SET `hits` = `hits` + 1 WHERE id = ?", array($id));
	  }
	  
      /**
       * Blog::Sitemap()
       * 
       * @return
       */
      public function Sitemap()
      {
		  
		  return Db::run()->select(self::mTable, array("title" . Lang::$lang . " AS title", "slug" . Lang::$lang . " AS slug"), array("active" => 1))->results();
	  }

      /**
       * Blog::hasThumb()
       * 
	   * @param str $thumb
	   * @param str $id
       * @return
       */
      public static function hasThumb($thumb, $id)
      {

          if($thumb) {
			  return FMODULEURL . self::BLOGDATA . $id . '/thumbs/' . $thumb;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
	  
      /**
       * Blog::hasImage()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasImage($image, $id)
      {

          if($image) {
			  return FMODULEURL . self::BLOGDATA . $id . '/' . $image;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      } 
  }