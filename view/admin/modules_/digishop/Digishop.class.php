<?php
  /**
   * Digishop Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: Digishop.class.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Digishop
  {

      const mTable = "mod_digishop";
	  const cTable = "mod_digishop_categories";
	  const rTable = "mod_digishop_related_categories";
	  const qTable = "mod_digishop_cart";
	  const gTable = "mod_digishop_gallery";
	  const xTable = "mod_digishop_payments";

      const DIGIDATA = 'digishop/data/';
	  const FILES = "zip,pdf,rar,mp3";
	  const MAXIMG = 5242880;
	  const MAXFILE = 104857600;


      /**
       * Digishop::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  $this->Config();
	  }
	  
      /**
       * Digishop::Config()
       * 
       * @return
       */
      private function Config()
      {

          $row = File::readIni(AMODPATH . 'digishop/config.ini');
          $this->filedir = Utility::decode($row->digishop->filedir);
          $this->allow_free = $row->digishop->allow_free;
          $this->cols = $row->digishop->cols;
          $this->fpp = $row->digishop->fpp;
          $this->ipp = $row->digishop->ipp;
		  $this->like = $row->digishop->like;
		  $this->catcount = $row->digishop->catcount;
		  $this->comments = $row->digishop->comments;
		  $this->thumb_w = $row->digishop->thumb_w;
		  $this->thumb_h = $row->digishop->thumb_h;

          return ($row) ? $this : 0;
      }
	  
      /**
       * Digishop::AdminIndex()
       * 
       * @return
       */
      public function AdminIndex()
      {
		  $find = isset($_POST['find']) ? Validator::sanitize($_POST['find'], "default", 30) : null;
		  
          if (isset($_GET['letter']) and $find) {
              $letter = Validator::sanitize($_GET['letter'], 'string', 2);
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE title" . Lang::$lang . " LIKE '%" . trim($find) . "%' AND `title" . Lang::$lang . "` REGEXP '^" . $letter . "'");
              $where = "WHERE `title" . Lang::$lang . "` LIKE '%" . trim($find) . "%' AND `title" . Lang::$lang . "` REGEXP '^" . $letter . "'";

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
                  "price",
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
			d.price,
			d.created,
			d.title" . Lang::$lang . " AS title,
			d.likes,
			d.category_id,
			GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'digishop') as comments,
			(SELECT 
			  COUNT(p.item_id) 
			FROM
			  `" . self::xTable . "` as p 
			WHERE p.item_id = d.id) AS xsales,
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
          $tpl->title = Lang::$word->_MOD_DS_TITLE;
		  $tpl->pager = $pager;
          $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
      }

      /**
       * Digishop::Edit()
       * 
       * @param int $id
       * @return
       */
      public function Edit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_DS_META_T6;
          $tpl->crumbs = ['admin', 'modules', 'digishop', 'edit'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Digishop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
              $tpl->langlist = App::Core()->langlist;
			  $tpl->membership_list = App::Membership()->getMembershipList();
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->categories);
			  $tpl->images = Db::run()->select(self::gTable, array("id", "name"), array("parent_id" => $row->id), "ORDER BY sorting")->results();
			  $tpl->custom_fields = Content::rendertCustomFields($id, "digishop");
              $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
          }
      }

      /**
       * Digishop::Save()
       * 
       * @return
       */
      public function Save()
      {
		  App::Session()->set("digitoken",Utility::randNumbers(4));
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_DS_META_T7;
		  $tpl->langlist = App::Core()->langlist;
		  $tpl->membership_list = App::Membership()->getMembershipList();
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->custom_fields = Content::rendertCustomFields("", "digishop");
		  
          $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
      }

      /**
       * Digishop::processItem()
       * 
       * @return
       */
      public function processItem()
      {

		  $rules = array(
			  'price' => array('required|numeric', Lang::$word->PRICE),
			  'downloads' => array('required|numeric', Lang::$word->DOWNLOADS),
			  );
		  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['title_' . $lang->abbr] = array('required|string|min_len,3|max_len,80', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $filters['title_' . $lang->abbr] = 'string';
			  $filters['slug_' . $lang->abbr] = 'string';
			  $filters['description_' . $lang->abbr] = 'string';
			  $filters['keywords_' . $lang->abbr] = 'string';
			  $filters['body_' . $lang->abbr] = 'advanced_tags';
		  }

          if (!array_key_exists('categories', $_POST)) {
              Message::$msgs['categories'] = LANG::$word->_MOD_DS_INFO1;
          }
		  
		  (Filter::$id) ? $this->_updateItem($rules, $filters) : $this->_addItem($rules, $filters);
		  
      }

      /**
       * Digishop::_updateItem()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _updateItem($rules, $filters)
      {

		  if (!empty($_FILES['poster']['name'])) {
			  $poster = File::upload("poster", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['file']['name'])) {
			  $file = File::upload("file", self::MAXFILE, self::FILES);
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  Content::verifyCustomFields("digishop");
		  
          if (empty(Message::$msgs)) {
			  foreach (App::Core()->langlist as $i => $lang) {
                  $slug[$i] = empty($safe->{'slug_' . $lang->abbr}) 
				  ? Url::doSeo($safe->{'title_' . $lang->abbr}) 
				  : Url::doSeo($safe->{'slug_' . $lang->abbr});
                  $datam['title_' . $lang->abbr] = $safe->{'title_' . $lang->abbr};
                  $datam['slug_' . $lang->abbr] = $slug[$i];
                  $datam['keywords_' . $lang->abbr] = $safe->{'keywords_' . $lang->abbr};
                  $datam['description_' . $lang->abbr] = $safe->{'description_' . $lang->abbr};
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
                  'price' => $safe->price,
				  'downloads' => $safe->downloads,
                  'active' => $safe->active,
				  'images' => Db::run()->select(self::gTable, array("name"), array("parent_id" => Filter::$id))->results('json'),
                  );
              
			  //process thumb 
			  $row = Db::run()->first(self::mTable, array("thumb", "poster", "file"), array('id' => Filter::$id));
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::DIGIDATA . Filter::$id . '/'; 
				  $tresult = File::process($thumb, $thumbpath, false);
				  File::deleteFile($thumbpath . $row->thumb);
				  File::deleteFile($thumbpath . 'thumbs/' . $row->thumb);
                  try {
                      $img = new Image($thumbpath . $tresult['fname']);
                      $img->bestFit($this->thumb_w, $this->thumb_h)->save($thumbpath . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $datax['thumb'] = $tresult['fname'];
			  }
			  //process poster 
			  if (!empty($_FILES['poster']['name'])) {
				  $thumbpath = FMODPATH . self::DIGIDATA . Filter::$id . '/'; 
				  $presult = File::process($poster, $thumbpath, "POSTER_");
				  File::deleteFile($thumbpath . $row->poster);
				  $datax['poster'] = $presult['fname'];
			  }
			  //process file 
			  if (!empty($_FILES['file']['name'])) {; 
				  $fresult = File::process($file, $this->filedir, false);
				  File::deleteFile($this->filedir . $row->file);
				  $datax['file'] = $fresult['fname'];
			  }

			  Db::run()->update(self::mTable, array_merge($datam, $datax), array("id" => Filter::$id));

			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $result = array();
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("digishop_id" => Filter::$id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  //process related categories 
			  Db::run()->delete(self::rTable, array('item_id' => Filter::$id));
			  foreach ($_POST['categories'] as $item):
				  $cdataArray[] = array(
					  'item_id' => Filter::$id,
					  'category_id' => $item);
			  endforeach;
			  Db::run()->insertBatch(self::rTable, $cdataArray);
			  
			  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_DS_ITM_UPDATE_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Digishop::_addItem()
       * 
	   * @param array $rules
	   * @param array $filters
       * @return
       */
      public function _addItem($rules, $filters)
      {

          if (empty($_FILES['thumb']['name'])) {
              Message::$msgs['thumb'] = LANG::$word->MAINIMAGE;
          }
		  
          if (empty($_FILES['file']['name'])) {
              Message::$msgs['file'] = LANG::$word->FILE;
          }
		  
		  if (!empty($_FILES['poster']['name'])) {
			  $poster = File::upload("poster", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['file']['name'])) {
			  $file = File::upload("file", self::MAXFILE, "zip,pdf,rar,mp3");
		  }
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  Content::verifyCustomFields("digishop");
		  
          if (empty(Message::$msgs)) {
			  foreach (App::Core()->langlist as $i => $lang) {
                  $slug[$i] = empty($safe->{'slug_' . $lang->abbr}) 
				  ? Url::doSeo($safe->{'title_' . $lang->abbr}) 
				  : Url::doSeo($safe->{'slug_' . $lang->abbr});
                  $datam['title_' . $lang->abbr] = $safe->{'title_' . $lang->abbr};
                  $datam['slug_' . $lang->abbr] = $slug[$i];
                  $datam['keywords_' . $lang->abbr] = $safe->{'keywords_' . $lang->abbr};
                  $datam['description_' . $lang->abbr] = $safe->{'description_' . $lang->abbr};
                  $datam['body_' . $lang->abbr] = Url::in_url($_POST['body_' . $lang->abbr]);

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
                  'price' => $safe->price,
				  'downloads' => $safe->downloads,
                  'token' => Utility::randomString(16),
				  'active' => $safe->active,
                  );
              
			  $temp_id = App::Session()->get("digitoken");
			  File::makeDirectory(FMODPATH . self::DIGIDATA . $temp_id . '/thumbs');
			  
			  //process thumb 
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::DIGIDATA . $temp_id . '/'; 
				  $tresult = File::process($thumb, $thumbpath, false);
                  try {
                      $img = new Image($thumbpath . $tresult['fname']);
                      $img->bestFit($this->thumb_w, $this->thumb_h)->save($thumbpath . 'thumbs/' . $tresult['fname']);
                  }
                  catch (exception $e) {
					  Debug::AddMessage("errors", '<i>Error</i>', $e->getMessage(), "session");
                  }
				  $datax['thumb'] = $tresult['fname'];
			  }
			  //process poster 
			  if (!empty($_FILES['poster']['name'])) {
				  $thumbpath = FMODPATH . Digishop::DIGIDATA . $temp_id . '/';
				  $presult = File::process($poster, $thumbpath, "POSTER_");
				  $datax['poster'] = $presult['fname'];
			  }
			  //process file 
			  if (!empty($_FILES['file']['name'])) {; 
				  $fresult = File::process($file, $this->filedir, false);
				  $datax['file'] = $fresult['fname'];
			  }
			  
			  $last_id = Db::run()->insert(self::mTable, array_merge($datam, $datax))->getLastInsertId();

			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $fields = Db::run()->select(Content::cfTable)->results();
				  foreach ($fields as $row) {
					  $dataArray[] = array(
						  'digishop_id' => $last_id,
						  'field_id' => $row->id,
						  'field_name' => $row->name,
						  'section' => "digishop",
						  );
				  }
				  Db::run()->insertBatch(Content::cfdTable, $dataArray);
				  
				  foreach ($fl_array as $key => $val) {
					  $cfdata['field_value'] = Validator::sanitize($val);
					  Db::run()->update(Content::cfdTable, $cfdata, array("digishop_id" => $last_id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  //process related categories 
			  foreach ($_POST['categories'] as $item):
				  $cdataArray[] = array(
					  'item_id' => $last_id,
					  'category_id' => $item);
			  endforeach;
			  Db::run()->insertBatch(self::rTable, $cdataArray);
			  
			  //process gallery 
			  if($rows = Db::run()->select(self::gTable, array("id", "parent_id"), array("parent_id" => App::Session()->get("digitoken")))->results()) {
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
			  File::renameDirectory(FMODPATH . self::DIGIDATA . $temp_id, FMODPATH . self::DIGIDATA . $last_id);
				  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_DS_ITM_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  $json['redirect'] = Url::url("/admin/modules", "digishop/");
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
       * Digishop::Settings()
       * 
       * @return
       */
      public function Settings()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_DS_META_T3;
		  $tpl->data = $this->Config();
          $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
      }

      /**
       * Digishop::processConfig()
       * 
       * @return
       */
	  public function processConfig()
	  {
	
		  $rules = array(
			  'filedir' => array('required|string', Lang::$word->_MOD_DS_FILEDIR),
			  'allow_free' => array('required|string', Lang::$word->_MOD_DS_FREEDOWN),
			  'cols' => array('required|numeric', Lang::$word->_MOD_DS_IPR),
			  'fpp' => array('required|numeric', Lang::$word->_MOD_DS_LP),
			  'ipp' => array('required|numeric', Lang::$word->_MOD_DS_IPC),
			  'like' => array('required|numeric', Lang::$word->_MOD_DS_LIKE),
			  'catcount' => array('required|numeric', Lang::$word->_MOD_DS_COUNTER),
			  'comments' => array('required|numeric', Lang::$word->_MOD_DS_COMMENTS),
			  'thumb_w' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_W),
			  'thumb_h' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_H),
			  );
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
	
		  if (empty(Message::$msgs)) {
			  $data = array('digishop' => array(
					  'filedir' => Utility::encode($safe->filedir),
					  'allow_free' => $safe->allow_free,
					  'cols' => $safe->cols,
					  'fpp' => $safe->fpp,
					  'ipp' => $safe->ipp,
					  'like' => $safe->like,
					  'catcount' => $safe->catcount,
					  'comments' => $safe->comments,
					  'thumb_w' => $safe->thumb_w,
					  'thumb_h' => $safe->thumb_h,
					  ));
	
			  Message::msgReply(File::writeIni(AMODPATH . 'digishop/config.ini', $data), 'success', Lang::$word->_MOD_DS_CUPDATED);
			  Logger::writeLog(Lang::$word->_MOD_DS_CUPDATED);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Digishop::History()
       * 
	   * @param int $id
       * @return
       */
      public function History($id)
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_DS_META_T1;
		  $tpl->crumbs = ['admin', 'modules', 'digishop', 'history'];
		  
		  if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Digishop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $pager = Paginator::instance();
			  $pager->items_total = Db::run()->count(self::xTable, 'item_id = ' . $id . ' AND status = 1');
			  $pager->default_ipp = App::Core()->perpage;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();
			  
			  $sql = "
			  SELECT 
				p.amount,
				p.tax,
				p.coupon,
				p.total,
				p.currency,
				p.created,
				p.user_id,
				CONCAT(u.fname,' ',u.lname) as name
			  FROM
				`" . self::xTable . "` AS p 
				LEFT JOIN " . Users::mTable . " AS u 
				  ON u.id = p.user_id 
			  WHERE p.item_id = ?
				AND p.status = ?
			  ORDER BY p.created DESC" . $pager->limit . ";";
		  
			  $tpl->data = $row;
			  $tpl->plist = Db::run()->pdoQuery($sql, array($id, 1))->results();
			  $tpl->pager = $pager;
			  $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
		  }
      }

      /**
       * Digishop::CategoryEdit()
       * 
       * @param int $id
       * @return
       */
      public function CategoryEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_DS_META_T4;
          $tpl->crumbs = ['admin', 'modules', 'digishop', 'category'];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Digishop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->parent_id);
		      $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
              $tpl->langlist = App::Core()->langlist;
              $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
          }
      }

      /**
       * Digishop::CategorySave()
       * 
       * @return
       */
      public function CategorySave()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_DS_META_T4;
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
		  $tpl->langlist = App::Core()->langlist;
          $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
      }
	 
	  
      /**
       * Digishop::itemChart()
       * 
	   * @param int $id
       * @return
       */
      public static function itemChart($id)
      {

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 

          $color = array(
              "#03a9f4",
              "#33BFC1",
              "#ff9800",
              "#e91e63",
              );

          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT,
              Lang::$word->TRX_TAX,
              Lang::$word->TRX_COUPON,
			  );

		  for ($i = 1; $i <= 12; $i++) {
			  $data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
			  $reg_data[$i] = array(
				  'month' => date('M', mktime(0, 0, 0, $i)),
				  'sales' => 0,
				  'amount' => 0,
				  'tax' => 0,
				  'coupon' => 0,
				  );
		  }

		  $sql = ("
			SELECT 
			  COUNT(id) AS sales,
			  SUM(amount) AS amount,
			  SUM(tax) AS tax,
			  SUM(coupon) AS coupon,
			  MONTH(created) as created
			FROM
			  `" . self::xTable . "` 
			  WHERE item_id = ?
			  AND status = ?
			GROUP BY MONTH(created);
		  ");
		  $query = Db::run()->pdoQuery($sql, array($id, 1));

		  foreach ($query->results() as $result) {
			  $reg_data[$result->created] = array(
				  'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
				  'sales' => $result->sales,
				  'amount' => $result->amount,
				  'tax' => $result->tax,
				  'coupon' => $result->coupon
				  );
		  }

          foreach ($reg_data as $key => $value) {
              $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
              $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
              $data['data'][$key][Lang::$word->TRX_TAX] = $value['tax'];
              $data['data'][$key][Lang::$word->TRX_COUPON] = $value['coupon'];
          }

          foreach ($labels as $k => $label) {
              $data['label'][] = $label;
              $data['color'][] = $color[$k];
              $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
          }
          $data['data'] = array_values($data['data']);
		  
          return $data;
      }

      /**
       * Digishop::itemPayments()
       * 
	   * @param int $id
       * @return
       */
      public static function itemPayments($id)
      {
          $sql = "
		  SELECT 
			p.txn_id,
			CONCAT(u.fname,' ',u.lname) as name,
			p.amount,
			p.tax,
			p.coupon,
			p.total,
			p.currency,
			p.pp,
			p.created
		  FROM
			`" . self::xTable . "` AS p 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = p.user_id 
		  WHERE p.item_id = ?
		  AND p.status = ?
		  ORDER BY p.created DESC;";
		  
		  $rows = Db::run()->pdoQuery($sql, array($id, 1))->results();
		  $array = json_decode(json_encode($rows), true);
		  
          return $array ? $array : 0;

      }

      /**
       * Digishop::Payments()
       * 
       * @return
       */
      public function Payments()
      {

		  $enddate = (Validator::get('enddate_submit') && Validator::get('enddate_submit') <> "") ? Validator::sanitize(Db::toDate(Validator::get('enddate_submit'), false)) : date("Y-m-d");
		  $fromdate = Validator::get('fromdate_submit') ? Validator::sanitize(Db::toDate(Validator::get('fromdate_submit'), false)) : null;
		  
          if (Validator::get('fromdate_submit') && $_GET['fromdate_submit'] <> "") {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::xTable . "` WHERE `created` BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'");
              $where = "WHERE p.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
          } else {
			  $counter = Db::run()->count(self::xTable);
              $where = null;
          }
		  
          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
			p.*,
			m.title" . Lang::$lang . " as title,
			CONCAT(u.fname,' ',u.lname) as name
		  FROM `" . self::xTable . "` as p 
			LEFT JOIN " . Users::mTable . " AS u 
			  ON p.user_id = u.id
			LEFT JOIN " . self::mTable . " AS m 
			  ON p.item_id = m.id
		  $where
		  ORDER BY p.created DESC " . $pager->limit;

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->data = Db::run()->pdoQuery($sql)->results();
		  $tpl->pager = $pager;
          $tpl->title = Lang::$word->_MOD_DS_META_T5;
          $tpl->template = 'admin/modules_/digishop/view/index.tpl.php';
		  
      }

      /**
       * Digishop::allPayments()
       * 
       * @return
       */
      public static function allPayments()
      {

		  $enddate = (Validator::get('enddate') && Validator::get('enddate') <> "") ? Validator::sanitize(Db::toDate(Validator::get('enddate'), false)) : date("Y-m-d");
		  $fromdate = Validator::get('fromdate') ? Validator::sanitize(Db::toDate(Validator::get('fromdate'), false)) : null;
		  
          if (Validator::get('fromdate') && $_GET['fromdate'] <> "") {
              $where = "WHERE p.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
          } else {
              $where = null;
          }
		  
          $sql = "
		  SELECT 
		    p.txn_id,
			CONCAT(u.fname,' ',u.lname) as name,
			m.title" . Lang::$lang . " as title,
			p.coupon,
			p.tax,
			p.amount,
			p.pp,
			p.currency,
			p.ip,
			p.status,
			p.created
		  FROM `" . self::xTable . "` as p 
			LEFT JOIN " . Users::mTable . " AS u 
			  ON p.user_id = u.id
			LEFT JOIN " . self::mTable . " AS m 
			  ON p.item_id = m.id
		  $where
		  ORDER BY p.created DESC;";
		  
		  $rows = Db::run()->pdoQuery($sql)->results();
		  $array = json_decode(json_encode($rows), true);
		  
          return $array ? $array : 0;

      }
	  
      /**
       * Digishop::salesChart()
       * 
       * @return
       */
      public static function salesChart()
      {
          $range = (isset($_GET['range'])) ? Validator::sanitize($_GET['range'], "string", 6) : 'all';

          $data = array();
          $data['label'] = array();
          $data['color'] = array();
          $data['legend'] = array();
		  $data['preUnits'] = Utility::currencySymbol(); 
		  
          $color = array(
              "#03a9f4",
              "#33BFC1",
              "#ff9800",
              "#e91e63",
              );
			  
          $labels = array(
              Lang::$word->TRX_SALES,
              Lang::$word->TRX_AMOUNT,
              Lang::$word->TRX_TAX,
              Lang::$word->TRX_COUPON,
			  );
			  
          switch ($range) {
              case 'day':
				for ($i = 0; $i < 24; $i++) {
					$data['data'][$i]['m'] = $i;
					$reg_data[$i] = array(
						'hour' => $i,
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
				
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					HOUR(created) as hour
				  FROM
					`" . self::xTable . "` 
					WHERE DATE(created) = DATE(NOW())
					AND status = ?
				  GROUP BY HOUR(created)
				  ORDER BY hour ASC;
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->hour] = array(
						'hour' => $result->hour,
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
			  
              case 'week':
			   $date_start = strtotime('-' . date('w') . ' days');
				for ($i = 0; $i < 7; $i++) {
					$date = date('Y-m-d', $date_start + ($i * 86400));
					$data['data'][$i]['m'] = Date::dodate("EE", date('D', strtotime($date)));
					$reg_data[date('w', strtotime($date))] = array(
						'day' => date('D', strtotime($date)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
				
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					DAYNAME(created) as created
				  FROM
					`" . self::xTable . "` 
					WHERE DATE(created) >= DATE('" . Validator::sanitize(date('Y-m-d', $date_start), "string", 10) . "')
					AND status = ?
				  GROUP BY DAYNAME(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[date('w', strtotime($date))] = array(
						'day' => Date::dodate("EE", date('D', strtotime($result->created))),
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
				  
              case 'month':
				for ($i = 1; $i <= date('t'); $i++) {
					$date = date('Y') . '-' . date('m') . '-' . $i;
					$data['data'][$i]['m'] = date('d', strtotime($date));
					$reg_data[date('j', strtotime($date))] = array(
						'day' => date('d', strtotime($date)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
	  
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					DAY(created) as created
				  FROM
					`" . self::xTable . "` 
					WHERE MONTH(created) = MONTH(CURDATE())
					AND YEAR(created) = YEAR(CURDATE())
					AND status = ?
				  GROUP BY DAY(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'month' => $result->created,
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
			  
              case 'year':
				for ($i = 1; $i <= 12; $i++) {
					$data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
					$reg_data[$i] = array(
						'month' => date('M', mktime(0, 0, 0, $i)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
	  
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					MONTH(created) as created
				  FROM
					`" . self::xTable . "` 
					WHERE YEAR(created) = YEAR(NOW())
					AND status = ?
				  GROUP BY MONTH(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
	  			  break;
			  
              case 'all':
				for ($i = 1; $i <= 12; $i++) {
					$data['data'][$i]['m'] = Date::dodate("MMM", date("F", mktime(0, 0, 0, $i, 10)));
					$reg_data[$i] = array(
						'month' => date('M', mktime(0, 0, 0, $i)),
						'sales' => 0,
						'amount' => 0,
						'tax' => 0,
						'coupon' => 0,
						);
				}
	  
				$sql = ("
				  SELECT 
					COUNT(id) AS sales,
					SUM(amount) AS amount,
					SUM(tax) AS tax,
					SUM(coupon) AS coupon,
					MONTH(created) as created
				  FROM
					`" . self::xTable . "` 
					WHERE status = ?
				  GROUP BY MONTH(created);
				");
				$query = Db::run()->pdoQuery($sql, array(1));
	  
				foreach ($query->results() as $result) {
					$reg_data[$result->created] = array(
						'month' => Date::dodate("MMM", date("F", mktime(0, 0, 0, $result->created, 10))),
						'sales' => $result->sales,
						'amount' => $result->amount,
						'tax' => $result->tax,
						'coupon' => $result->coupon
						);
				}
			  break;
			  
		  }
		  
		  foreach ($reg_data as $key => $value) {
			  $data['data'][$key][Lang::$word->TRX_SALES] = $value['sales'];
			  $data['data'][$key][Lang::$word->TRX_AMOUNT] = $value['amount'];
			  $data['data'][$key][Lang::$word->TRX_TAX] = $value['tax'];
			  $data['data'][$key][Lang::$word->TRX_COUPON] = $value['coupon'];
		  }

		  foreach ($labels as $k => $label) {
			  $data['label'][] = $label;
			  $data['color'][] = $color[$k];
			  $data['legend'][] = '<div class="item"><span class="wojo right ring label spaced" style="background:' . $color[$k] . '"> </span> ' . $label . '</div>';
		  }
		  $data['data'] = array_values($data['data']);
		  return $data;
	  }
	  
      /**
       * Digishop::categoryTree()
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
       * Digishop::getCategoryDropList()
       * 
	   * @param mixed $array
	   * @param mixed $parent_id
	   * @param integer $level
	   * @param mixed $spacer
	   * @param bool $selected
       * @return
       */
	  public static function getCategoryDropList($array, $parent_id, $level = 0, $spacer = "__", $selected = false)
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
       * Digishop::getCatCheckList()
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
       * Digishop::getSortCategoryList()
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
				  . '<div class="dd3-content"><span class="actions"><a class="delCategory" data-set=\'{"option":[{"delete": "deleteCategory","title": "' . $row['name'] . '","id":' . $row['id'] . '}],"action":"delete","parent":"li"}\'>' . $icon . '</a></span>'
				 . ' <a href="' . Url::url("/admin/modules/digishop/category", $row['id']) . '">' . $row['name'] . '</a>' 
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
       * Digishop::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {

		  $rules = array(
			  'parent_id' => array('required|numeric', Lang::$word->_MOD_DS_CATPARENT),
			  'active' => array('required|numeric', Lang::$word->PUBLISHED),
			  );

		  foreach (App::Core()->langlist as $lang) {
			  $rules['name_' . $lang->abbr] = array('required|string|min_len,3|max_len,80', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
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
				  'active' => $safe->active,
				  );
			  
			  $data = array_merge($datam, $datax);
	
			  (Filter::$id) ? Db::run()->update(self::cTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cTable, $data)->getLastInsertId();
			  if (Filter::$id) {
				  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_DS_CAT_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
				  Logger::writeLog($message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_DS_CAT_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/modules/digishop/categories");
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
       * Digishop::resendNotification()
       * 
       * @return
       */
      public function resendNotification()
      {
		  
		  $sql = "
		  SELECT 
			p.*,
			p.id AS id,
			m.title" . Lang::$lang . " AS title,
			u.email,
			CONCAT(u.fname,' ',u.lname) AS name 
		  FROM
			`" . self::xTable . "` AS p 
			LEFT JOIN `" . Users::mTable . "` AS u 
			  ON u.id = p.user_id 
			LEFT JOIN `" . self::mTable . "` AS m 
			  ON m.id = p.item_id 
		  WHERE p.id = ?;";

		  if($row = Db::run()->pdoQuery($sql, array(Filter::$id))->result()) {
			  $etpl = Db::run()->first(Content::eTable, array("body" . Lang::$lang, "subject" . Lang::$lang), array('typeid' => 'digiNotifyUser'));
			  $mailer = Mailer::sendMail();
			  $core = App::Core();

			  $tpl = App::View(AMODPATH . 'digishop/snippets/'); 
			  $tpl->row = $row;
			  $tpl->template = 'itemTemplate.tpl.php'; 
				
			  $body = str_replace(array(
				  '[LOGO]',
				  '[NAME]',
				  '[DATE]',
				  '[COMPANY]',
				  '[SITE_NAME]',
				  '[ITEMS]',
				  '[URL]',
				  '[FB]',
				  '[TW]',
				  '[SITEURL]'), array(
				  Utility::getLogo(),
				  $row->name,
				  date('Y'),
				  $core->company,
				  $core->site_name,
				  $tpl->render(),
				  Url::url('/' . $core->system_slugs->account[0]->{'slug' . Lang::$lang}, "digishop"),
				  $core->social->facebook,
				  $core->social->twitter,
				  SITEURL), $etpl->{'body' . Lang::$lang}); 
				  
			  $msg = (new Swift_Message())
					->setSubject($etpl->{'subject' . Lang::$lang})
					->setTo(array($row->email => $row->name))
					->setFrom(array($core->site_email => $core->company))
					->setBody($body, 'text/html'
					);
			  if($mailer->send($msg)) {
				  Db::run()->update(self::xTable, array("status" => 1), array('id' => $row->id));
				  $json['type'] = 'success';
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = Lang::$word->_MOD_DS_RSENT;
				  $json['html'] = self::status(1, 0);
			  } else {
				  $json['type'] = 'error';
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->NL_ERROR;
			  }
		  } else {
			  $json['type'] = 'error';
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = "Invalid ID detected";
		  }
		  print json_encode($json);
      }

      /**
       * Digishop::userDownloads()
       * 
       * @return
       */
	  public function userDownloads()
	  {
	
		  $sql = "
		  SELECT 
			MAX(t.token) as token,
			MAX(t.txn_id) as txn_id,
			MAX(t.created) as created,
			MAX(t.downloads) as downloads,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			p.thumb,
			p.slug" . Lang::$lang . " AS slug 
		  FROM
			`" . self::xTable . "` AS t 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = t.item_id 
		  WHERE t.user_id = ? 
			AND t.status = ? 
			AND p.active = ? 
		  GROUP BY p.id
		  ORDER BY created DESC ;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, 1, 1))->results();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Digishop::Invoice()
       * 
	   * @param str $txnid
       * @return
       */
	  public function Invoice($txnid)
	  {
	
		  $sql = "
		  SELECT 
			p.title" . Lang::$lang . " AS title,
			MAX(t.created) as created,
			MAX(t.tax) as tax,
			MAX(t.amount) as amount,
			MAX(t.total) as total,
			COUNT(t.item_id) AS items 
		  FROM
			`" . self::xTable . "` AS t 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = t.item_id 
		  WHERE t.user_id = ? 
			AND t.status = ? 
			AND t.txn_id = ?
			AND p.active = ?  
		  GROUP BY t.item_id
		  ORDER BY created DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, 1, Utility::decode($txnid), 1))->results();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Digishop::Invoice()
       * 
	   * @param str $txnid
       * @return
       */
	  public function invoiceTotal($txnid)
	  {
	
		  $sql = "
		  SELECT 
			SUM(t.tax) AS tax,
			SUM(t.amount) AS sub,
			SUM(t.total) AS grand,
			MAX(t.currency) as currency,
			MAX(t.created) as created,
			DATE_FORMAT(MAX(t.created), '%Y%m%d - %H%m') AS invid 
		  FROM
			`" . self::xTable . "` AS t 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = t.item_id 
		  WHERE t.user_id = ? 
			AND t.status = ? 
			AND t.txn_id = ?
			AND p.active = ?;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, 1, Utility::decode($txnid), 1))->result();
	
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Digishop::catList()
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
			  " . Digishop::mTable . " p 
			  INNER JOIN `" . Digishop::rTable . "` rc 
				ON p.id = rc.item_id 
			WHERE rc.category_id = c.id 
			  AND p.active = ?) AS items 
		  FROM `" . Digishop::cTable . "` AS c
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
	   * Digishop::renderCategories()
	   * 
	   * @return
	   */
	  public function renderCategories($array, $parent_id = 0, $menuid = 'digicats', $class = 'vertical-menu')
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
	
					  $url = Url::Url('/' . App::Core()->modname['digishop'] . '/' . App::Core()->modname['digishop-cat'], $row['slug'] . Url::buildQuery());
	
					  $counter = ($this->catcount) ? '<span>('.$row['items'].')</span> ' : null;
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
       * Digishop::FrontHome()
       * 
       * @return
       */
      public static function FrontHome()
      {

          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "title",
                  "price",
                  "memberships",
				  "created",
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
          $pager->items_total = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE active = 1 LIMIT 1");
          $pager->default_ipp = App::Digishop()->fpp;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
		    d.id,
			d.created,
			d.price,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			d.thumb,
			d.token,
			d.likes,
			d.membership_id,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle,
			GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'digishop') as comments
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = d.category_id
			LEFT JOIN `" . Membership::mTable . "` AS m 
			  ON FIND_IN_SET(m.id, d.membership_id)
		  WHERE d.active = ?  
		  GROUP BY d.id
		  ORDER BY $sorting " . $pager->limit; 
		  
		  $rows = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  return array("rows" => $rows, "pager" => $pager, "conf" => App::Digishop());

	  }
	  
      /**
       * Digishop::FrontIndex()
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
		  $tpl->data = Db::run()->first(Modules::mTable, array("title" . lang::$lang, "info" . lang::$lang, "keywords" . lang::$lang, "description" . lang::$lang), array("modalias" => "digishop"));

          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "title",
                  "price",
                  "memberships",
				  "created",
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
          $pager->items_total = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::mTable . "` WHERE active = 1 LIMIT 1");
          $pager->default_ipp = $this->fpp;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
		    d.id,
			d.created,
			d.price,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			d.thumb,
			d.token,
			d.likes,
			d.membership_id,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle,
			GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'digishop') as comments
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = d.category_id
			LEFT JOIN `" . Membership::mTable . "` AS m 
			  ON FIND_IN_SET(m.id, d.membership_id)
		  WHERE d.active = ?  
		  GROUP BY d.id
		  ORDER BY $sorting " . $pager->limit; 
		  
		  
		  $tpl->rows = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  if($tpl->data) {
			  $tpl->title = Url::formatMeta($tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->data->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->data->{'description' . Lang::$lang};
		  }
		  
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), $tpl->data->{'title' . Lang::$lang}];
		  $tpl->menu = App::Content()->menuTree(true);
		  $tpl->plugins = App::Plugins()->getModulelugins("digishop");
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
		  $tpl->pager = $pager;
		  $tpl->conf = $this;
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';

	  }

      /**
       * Digishop::Category()
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
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->core = $core;
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "digishop"));
		  $tpl->menu = App::Content()->menuTree(true);
	
		  if (!$tpl->row = Db::run()->first(self::cTable, null, array("slug" . Lang::$lang => $slug))) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Digishop.class.php, ln.:" . __line__ . "]";
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
					  "price",
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
				COUNT(p.id) 
			  FROM
				`" . self::mTable . "` AS p 
				INNER JOIN `" . self::rTable . "` AS rc 
				  ON p.id = rc.item_id 
			  WHERE rc.category_id = " . $tpl->row->id . " 
				AND p.active = 1 
			  LIMIT 1;";
		  
			  $pager = Paginator::instance();
			  $pager->items_total = Db::run()->count(false, false, $pSql);
			  $pager->default_ipp = $this->ipp;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();

			  $sql = "
			  SELECT 
				d.id,
				d.created,
				d.price,
				d.title" . Lang::$lang . " AS title,
				d.slug" . Lang::$lang . " AS slug,
				d.thumb,
				d.token,
				d.likes,
				d.membership_id,
				c.slug" . Lang::$lang . " AS cslug,
				c.name" . Lang::$lang . " AS ctitle,
				GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships,
				(SELECT 
				  COUNT(parent_id) 
				FROM
				  `" . Modules::mcTable . "`
				WHERE `" . Modules::mcTable . "`.parent_id = d.id 
				  AND section = 'digishop') as comments
			  FROM
				`" . self::mTable . "` AS d
				LEFT JOIN `" . self::cTable . "` AS c
				  ON c.id = d.category_id
				INNER JOIN `" . self::rTable . "` AS rc 
				  ON d.id = rc.item_id
				LEFT JOIN `" . Membership::mTable . "` AS m 
				  ON FIND_IN_SET(m.id, d.membership_id)
			  WHERE rc.category_id = ?
			  AND d.active = ? 
			  AND c.active = ?  
			  GROUP BY d.id
			  ORDER BY $sorting " . $pager->limit; 

			  $tpl->rows = Db::run()->pdoQuery($sql, array($tpl->row->id, 1, 1))->results();
			  
			  $tpl->conf = $this;
	
			  $tpl->title = Url::formatMeta($tpl->row->{'name' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['digishop']), $tpl->row->{'name' . Lang::$lang}];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("digishop");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  
			  $tpl->pager = $pager;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }

	  }

      /**
       * Digishop::Render()
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
			  "description" . lang::$lang), array("modalias" => "digishop"));
		  $tpl->menu = App::Content()->menuTree(true);
		  
		  $sql = "
		  SELECT 
			d.*,
			GROUP_CONCAT(m.title" . Lang::$lang . " SEPARATOR ', ') AS memberships
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . Membership::mTable . "` AS m 
			  ON FIND_IN_SET(m.id, d.membership_id)
		  WHERE slug" . Lang::$lang . " = ?
		  AND d.active = ? 
		  GROUP BY d.id;";
	
		  if (!$tpl->row = Db::run()->pdoQuery($sql, array($slug, 1))->result()) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Digishop.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $tpl->title = Url::formatMeta($tpl->row->{'title' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['digishop']), $tpl->row->{'title' . Lang::$lang}];

			  $tpl->meta = '
			  <meta property="og:type" content="article" />
			  <meta property="og:title" content="' . $tpl->row->{'title' . Lang::$lang} . '" />
			  <meta property="og:image" content="' . self::hasThumb($tpl->row->thumb, $tpl->row->id) . '" />
			  <meta property="og:description" content="' . $tpl->title . '" />
			  <meta property="og:url" content="' . Url::url('/' . $core->modname['digishop'], $slug) . '" />
			  ';
			  
			  $tpl->plugins = App::Plugins()->getModulelugins("digishop");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->custom_fields = Content::rendertCustomFieldsFront($tpl->row->id, "digishop");
			  $tpl->images = Utility::jSonToArray($tpl->row->images);
			  
			  $tpl->conf = $this;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }
	  }

      /**
       * Digishop::Checkout()
       * 
       * @return
       */
	  public function Checkout()
	  {
		  $core = App::Core();
		  $tpl = App::View(FMODPATH . 'modules/');
		  $tpl->dir = "front/themes/" . $core->theme . "/";
		  $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "digishop"));
		  $tpl->menu = App::Content()->menuTree(true);

		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['digishop']), $core->modname['digishop-checkout']];
		  $tpl->plugins = array();
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  
		  $tpl->core = $core;
		  $tpl->conf = $this;
		  $tpl->rows = Digishop::getCartContent();
		  $tpl->totals = Digishop::getCartTotal();
		  $tpl->tax = Membership::calculateTax();
		  $tpl->gateways = Db::run()->select(Core::gTable, null, array("active" => 1))->results();
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
	  }

      /**
       * Digishop::userHistory()
       * 
       * @return
       */
	  public function userHistory()
	  {
		  if (!App::Auth()->is_User()) {
			  Url::redirect(SITEURL); 
			  exit; 
		  }
		  
		  $core = App::Core();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "front/themes/" . $core->theme . "/";
          $tpl->title = str_replace("[COMPANY]", $core->company, Lang::$word->META_T31);
		  $tpl->keywords = null;
		  $tpl->description = null;
		  $tpl->meta = null;
		  $tpl->core = $core;
		  $tpl->menu = App::Content()->menuTree(true);
		  
          if (!$row = Db::run()->first(Content::pTable, null, array("page_type" => "account", "active" => 1))) {
			  $tpl->data = null;
			  $tpl->title = Lang::$word->META_ERROR; 
              $tpl->template = 'front/themes/' . $core->theme . '/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid page detected [front.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
			  $tpl->title = Url::formatMeta($row->{'title' . Lang::$lang});
			  $tpl->keywords = $row->{'keywords' . Lang::$lang};
			  $tpl->description = $row->{'description' . Lang::$lang};
			  $tpl->history = $this->userDownloads();

              $tpl->data = $row;
			  $tpl->url = $core->system_slugs->account[0]->{'slug' . Lang::$lang};
			  Content::$pagedata = $row;
              $tpl->template = 'front/themes/' . $core->theme . '/account.tpl.php';
          } 
	  }
	  
      /**
       * Digishop::status()
       * 
       * @param mixed $status
       * @param mixed $id
       * @return
       */
      public static function status($status, $id)
      {
          switch ($status) {
              case 1:
                  $html = '<span class="wojo small basic circular icon button" data-tooltip="' . Lang::$word->ACTIVE . '"><i class="icon check"></i></span>';
                  break;

              case 0:
			      $icon = '<i class="icon postcard"></i>';
                  $html = '<a  data-tooltip="' . Lang::$word->INACTIVE . '" id="self_' . $id . '" data-set=\'{"option":[{"action":"resendNotification","id": ' . $id  . '}], "label":"' . Lang::$word->M_SUB6 . '", "url":"modules_/digishop/controller.php", "parent":"#self_' . $id . '", "complete":"replaceWith", "modalclass":"normal"}\' class="wojo small circular icon button action">' . $icon .'</a>';
                  break;
          }

          return $html;
      }

      /**
       * Digishop::getCart()
       * 
       * @return
       */
	  public static function getCart($uid = '')
	  {
	
		  $sql = "
		  SELECT 
			c.totalprice,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			p.slug" . Lang::$lang . " AS slug,
			p.price,
			p.token,
			p.thumb
		  FROM
			`" . self::qTable . "` AS c 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = c.pid 
		  WHERE c.uid = ?
		  ORDER BY c.pid DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->results();
	
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Digishop::getCartContent()
       * 
       * @return
       */
	  public static function getCartContent($uid = '')
	  {
	
		  $sql = "
		  SELECT 
			c.totalprice,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			p.slug" . Lang::$lang . " AS slug,
			p.price,
			p.thumb,
			COUNT(*) AS items 
		  FROM
			`" . self::qTable . "` AS c 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = c.pid 
		  WHERE c.uid = ?
		  GROUP BY c.pid, c.totalprice
		  ORDER BY c.pid DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->results();
	
		  return ($row) ? $row : 0;
	  }
	  

      /**
       * Digishop::getCartTotal()
       * 
       * @return
       */
	  public static function getCartTotal($uid = '')
	  {
	
		  $sql = "
		  SELECT 
		    order_id,
			cart_id,
			SUM(totalprice) as grand,
			SUM(total) as sub,
			SUM(totaltax) as tax,
			COUNT(id) AS items 
		  FROM
			`" . self::qTable . "`
		  WHERE uid = ?
		  GROUP BY uid, order_id, cart_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->result();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Digishop::searchResults()
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
       * Digishop::Sitemap()
       * 
       * @return
       */
      public function Sitemap()
      {
		  
		  return Db::run()->select(self::mTable, array("title" . Lang::$lang . " AS title", "slug" . Lang::$lang . " AS slug"), array("active" => 1))->results();
	  }
	  
      /**
       * Digishop::hasThumb()
       * 
	   * @param str $thumb
	   * @param str $id
       * @return
       */
      public static function hasThumb($thumb, $id)
      {

          if($thumb) {
			  return FMODULEURL . self::DIGIDATA . $id . '/thumbs/' . $thumb;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
	  
      /**
       * Digishop::hasImage()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasImage($image, $id)
      {

          if($image) {
			  return FMODULEURL . self::DIGIDATA . $id . '/' . $image;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
  }