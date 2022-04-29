<?php
  /**
   * Portfolio Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: Portfolio.class.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Portfolio
  {

      const mTable = "mod_portfolio";
	  const cTable = "mod_portfolio_categories";
	  const gTable = "mod_portfolio_gallery";

      const PORTDATA = 'portfolio/data/';
	  const FILEDATA = 'portfolio/datafiles/';
	  const MAXIMG = 5242880;
	  const MAXFILE = 52428800;

      /**
       * Portfolio::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  $this->Config();
	  }
	  
      /**
       * Portfolio::Config()
       * 
       * @return
       */
      private function Config()
      {

          $row = File::readIni(AMODPATH . 'portfolio/config.ini');
		  $this->fpp = $row->portfolio->fpp;
		  $this->ipc = $row->portfolio->ipc;
		  $this->cols = $row->portfolio->cols;
		  $this->layout = $row->portfolio->layout;
		  $this->show_cats = $row->portfolio->show_cats;
		  $this->show_sort = $row->portfolio->show_sort;
		  $this->show_featured = $row->portfolio->show_featured;
		  $this->thumb_w = $row->portfolio->thumb_w;
		  $this->thumb_h = $row->portfolio->thumb_h;
		  $this->social = $row->portfolio->social;
		  $this->latest = $row->portfolio->latest;

          return ($row) ? $this : 0;
      }
	  
      /**
       * Portfolio::AdminIndex()
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
              $where = "WHERE `title" . Lang::$lang . "` REGEXP '^" . $letter . "'";
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
                  "client",
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
			d.created,
			d.category_id,
			d.client,
			d.title" . Lang::$lang . " AS title,
			d.thumb,
			c.name" . Lang::$lang . " AS name 
		  FROM
			`" . self::mTable . "` AS d 
			LEFT JOIN `" . self::cTable . "` AS c 
			  ON c.id = d.category_id 
		  $where 
		  ORDER BY $sorting " . $pager->limit; 
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = Db::run()->pdoQuery($sql)->results();
          $tpl->title = Lang::$word->_MOD_PF_TITLE;
		  $tpl->pager = $pager;
          $tpl->template = 'admin/modules_/portfolio/view/index.tpl.php';
      }

      /**
       * Portfolio::Edit()
       * 
       * @param int $id
       * @return
       */
      public function Edit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_PF_SUB2;
          $tpl->crumbs = ['admin', 'modules', 'portfolio', 'edit'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Portfolio.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
              $tpl->langlist = App::Core()->langlist;
		      $tpl->categories = $this->categoryTree();
			  $tpl->images = Db::run()->select(self::gTable, array("id", "name"), array("parent_id" => $row->id), "ORDER BY sorting")->results();
			  $tpl->custom_fields = Content::rendertCustomFields($id, "portfolio");
              $tpl->template = 'admin/modules_/portfolio/view/index.tpl.php';
          }
      }

      /**
       * Portfolio::Save()
       * 
       * @return
       */
      public function Save()
      {
		  App::Session()->set("foliotoken", Utility::randNumbers(4));
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_PF_NEWITM;
		  $tpl->langlist = App::Core()->langlist;
		  $tpl->categories = $this->categoryTree();
		  $tpl->custom_fields = Content::rendertCustomFields("", "portfolio");
		  
          $tpl->template = 'admin/modules_/portfolio/view/index.tpl.php';
      }
	  
      /**
       * Portfolio::processItem()
       * 
       * @return
       */
      public function processItem()
      {

		  $rules = array(
			  'category_id' => array('required|numeric', Lang::$word->CATEGORY),
			  'is_featured' => array('required|numeric', Lang::$word->_MOD_PF_SUB11),
			  'created_submit' => array('required|date', Lang::$word->CREATED),
			  );
		  $filters['client'] = 'string';
		  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['title_' . $lang->abbr] = array('required|string|min_len,3|max_len,80', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $filters['title_' . $lang->abbr] = 'string';
			  $filters['slug_' . $lang->abbr] = 'string';
			  $filters['description_' . $lang->abbr] = 'string';
			  $filters['keywords_' . $lang->abbr] = 'string';
			  $filters['body_' . $lang->abbr] = 'advanced_tags';
		  }
		  
		  (Filter::$id) ? $this->_updateItem($rules, $filters) : $this->_addItem($rules, $filters);
      }

      /**
       * Portfolio::_updateItem()
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
			  $file = File::upload("file", self::MAXFILE, "zip,pdf,rar,mp3");
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  Content::verifyCustomFields("portfolio");
		  
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
                  'category_id' => $safe->category_id,
				  'is_featured' => $safe->is_featured,
                  'client' => $safe->client,
				  'created' => $safe->created_submit,
				  'images' => Db::run()->select(self::gTable, array("name"), array("parent_id" => Filter::$id))->results('json'),
                  );
              
			  //process thumb 
			  $row = Db::run()->first(self::mTable, array("thumb", "file"), array('id' => Filter::$id));
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::PORTDATA . Filter::$id . '/'; 
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
			  //process file 
			  if (!empty($_FILES['file']['name'])) {; 
				  $fresult = File::process($file, FMODPATH . self::FILEDATA, false);
				  File::deleteFile(FMODPATH . self::FILEDATA . $row->file);
				  $datax['file'] = $fresult['fname'];
			  }
			  
			  Db::run()->update(self::mTable, array_merge($datam, $datax), array("id" => Filter::$id));

			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $result = array();
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("portfolio_id" => Filter::$id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_PF_ITM_UPDATE_OK);
			  Message::msgReply(true, 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Portfolio::_addItem()
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

		  if (!empty($_FILES['thumb']['name'])) {
			  $thumb = File::upload("thumb", self::MAXIMG, "png,jpg,jpeg");
		  }

		  if (!empty($_FILES['file']['name'])) {
			  $file = File::upload("file", self::MAXFILE, "zip,pdf,rar,mp3");
		  }
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  Content::verifyCustomFields("portfolio");
		  
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
                  'category_id' => $safe->category_id,
				  'is_featured' => $safe->is_featured,
                  'client' => $safe->client,
				  'created' => $safe->created_submit,
                  );
              
			  $temp_id = App::Session()->get("foliotoken");
			  File::makeDirectory(FMODPATH . self::PORTDATA . $temp_id . '/thumbs');
			  
			  //process thumb 
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::PORTDATA . $temp_id . '/'; 
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
			  //process file 
			  if (!empty($_FILES['file']['name'])) {; 
				  $fresult = File::process($file, FMODPATH . self::FILEDATA, false);
				  $datax['file'] = $fresult['fname'];
			  }
			  
			  $last_id = Db::run()->insert(self::mTable, array_merge($datam, $datax))->getLastInsertId();

			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $fields = Db::run()->select(Content::cfTable)->results();
				  foreach ($fields as $row) {
					  $dataArray[] = array(
						  'portfolio_id' => $last_id,
						  'field_id' => $row->id,
						  'field_name' => $row->name,
						  'section' => "portfolio",
						  );
				  }
				  Db::run()->insertBatch(Content::cfdTable, $dataArray);
				  
				  foreach ($fl_array as $key => $val) {
					  $cfdata['field_value'] = Validator::sanitize($val);
					  Db::run()->update(Content::cfdTable, $cfdata, array("portfolio_id" => $last_id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  //process gallery 
			  if($rows = Db::run()->select(self::gTable, array("id", "parent_id"), array("parent_id" => App::Session()->get("foliotoken")))->results()) {
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
			  File::renameDirectory(FMODPATH . self::PORTDATA . $temp_id, FMODPATH . self::PORTDATA . $last_id);
				  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_PF_ITM_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  $json['redirect'] = Url::url("/admin/modules", "portfolio/");
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
       * Portfolio::CategoryEdit()
       * 
       * @param int $id
       * @return
       */
      public function CategoryEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_PF_SUB3;
          $tpl->crumbs = ['admin', 'modules', 'portfolio', 'category'];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Portfolio.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
			  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
			  $tpl->langlist = App::Core()->langlist;
              $tpl->template = 'admin/modules_/portfolio/view/index.tpl.php';
          }
      }
	  
      /**
       * Portfolio::CategorySave()
       * 
       * @return
       */
      public function CategorySave()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_PF_SUB3;
		  $tpl->tree = $this->categoryTree();
		  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
		  $tpl->langlist = App::Core()->langlist;
          $tpl->template = 'admin/modules_/portfolio/view/index.tpl.php';
      }

      /**
       * Portfolio::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {
		  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['name_' . $lang->abbr] = array('required|string|min_len,3|max_len,80', Lang::$word->MEN_NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
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
	
			  (Filter::$id) ? Db::run()->update(self::cTable, $datam, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::cTable, $datam)->getLastInsertId();
			  if (Filter::$id) {
				  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_PF_CAT_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
				  Logger::writeLog($message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_PF_CAT_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/modules/portfolio/categories");
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
       * Portfolio::Settings()
       * 
       * @return
       */
      public function Settings()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_PF_SUB4;
		  $tpl->data = $this->Config();
          $tpl->template = 'admin/modules_/portfolio/view/index.tpl.php';
      }

      /**
       * Portfolio::processConfig()
       * 
       * @return
       */
	  public function processConfig()
	  {
	
		  $rules = array(
			  'ipc' => array('required|numeric', Lang::$word->_MOD_PF_SUB5),
			  'fpp' => array('required|numeric', Lang::$word->_MOD_PF_SUB6),
			  'cols' => array('required|numeric', Lang::$word->_MOD_GA_COLS),
			  'show_cats' => array('required|numeric', Lang::$word->_MOD_PF_SUB8),
			  'social' => array('required|numeric', Lang::$word->_MOD_PF_SUB12),
			  'show_sort' => array('required|numeric', Lang::$word->_MOD_PF_SUB9),
			  'show_featured' => array('required|numeric', Lang::$word->_MOD_PF_SUB10),
			  'latest' => array('required|numeric', Lang::$word->_MOD_PF_SUB13),
			  'thumb_w' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_W),
			  'thumb_h' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_H),
			  );
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
	
		  if (empty(Message::$msgs)) {
			  $data = array('portfolio' => array(
					  'ipc' => $safe->ipc,
					  'fpp' => $safe->fpp,
					  'cols' => $safe->cols,
					  'show_cats' => $safe->show_cats,
					  'social' => $safe->social,
					  'show_sort' => $safe->show_sort,
					  'show_featured' => $safe->show_featured,
					  'latest' => $safe->latest,
					  'layout' => $safe->layout,
					  'thumb_w' => $safe->thumb_w,
					  'thumb_h' => $safe->thumb_h,
					  ));
	
			  Message::msgReply(File::writeIni(AMODPATH . 'portfolio/config.ini', $data), 'success', Lang::$word->_MOD_PF_CUPDATED);
			  Logger::writeLog(Lang::$word->_MOD_PF_CUPDATED);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Portfolio::categoryTree()
       * 
       * @return
       */
      public function categoryTree()
      {

		  $row = Db::run()->select(self::cTable, array("id", "name" . Lang::$lang, "slug" . Lang::$lang), null, "ORDER BY sorting")->results();

          return ($row) ? $row : 0; 

      }

      /**
       * Portfolio::getSortCategoryList()
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
	      if($array){
			  foreach ($array as $row) {
				  if ($submenu === false) {
					  $submenu = true;
					  $html .= "<ol class=\"dd-list\">\n";
				  }
				  $html .='<li class="dd-item dd3-item clearfix" data-id="' . $row->id . '"><div class="dd-handle dd3-handle"></div>'
				  . '<div class="dd3-content"><span class="actions"><a data-set=\'{"option":[{"delete": "deleteCategory","title": "' . Validator::sanitize($row->{'name' . Lang::$lang}, "chars") . '","id":' . $row->id . '}],"action":"delete","parent":"li","url":"modules_/portfolio"}\' class="data">' . $icon . '</i></a></span>'
				  . ' <a href="' . Url::url("/admin/modules/portfolio/category", $row->id) . '">' . $row->{'name' . Lang::$lang} . '</a>';
				  $html .= "</li>\n";
			  }
		  }
	
		  if ($submenu === true) {
			  $html .= "</ol>\n";
		  }
		  
		  return $html;
	  }

      /**
       * Portfolio::FrontIndex()
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
		  
		  $conf = App::Portfolio();

          $pager = Paginator::instance();
          $pager->items_total = Db::run()->count(self::mTable, ($conf->show_featured ? 'is_featured = 1' : null));
          $pager->default_ipp = $conf->fpp;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  $featured = $conf->show_featured ? 'WHERE d.is_featured = 1 ' : null;
		  
          $sql = "
		  SELECT 
		    d.id,
			d.created,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			d.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c 
			ON c.id = d.category_id
			$featured
		  ORDER BY $sorting " . $pager->limit; 
		  
		  $rows = Db::run()->pdoQuery($sql)->results();
		  $categories = App::Portfolio()->categoryTree();
		  
		  return array("rows" => $rows, "pager" => $pager, "categories" => $categories);
	  }
	  
      /**
       * Portfolio::FrontIndex()
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
		  $tpl->data = Db::run()->first(Modules::mTable, array("title" . lang::$lang, "info" . lang::$lang, "keywords" . lang::$lang, "description" . lang::$lang), array("modalias" => "portfolio"));

          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "title",
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
          $pager->items_total = Db::run()->count(self::mTable, ($this->show_featured ? 'is_featured = 1' : null));
          $pager->default_ipp = $this->fpp;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  $featured = $this->show_featured ? 'WHERE d.is_featured = 1 ' : null;
		  
          $sql = "
		  SELECT 
		    d.id,
			d.created,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			d.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c 
			ON c.id = d.category_id
			$featured
		  ORDER BY $sorting " . $pager->limit; 
		  
		  $tpl->core = $core;
		  $tpl->rows = Db::run()->pdoQuery($sql)->results();
		  
		  if($tpl->data) {
			  $tpl->title = Url::formatMeta($tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->data->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->data->{'description' . Lang::$lang};
		  }
		  
		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), $tpl->data->{'title' . Lang::$lang}];
		  $tpl->menu = App::Content()->menuTree(true);
		  $tpl->plugins = App::Plugins()->getModulelugins("portfolio");
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
		  $tpl->categories = $this->categoryTree();
		  $tpl->pager = $pager;
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';

	  }

      /**
       * Portfolio::Category()
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
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "portfolio"));
		  $tpl->menu = App::Content()->menuTree(true);
	
		  if (!$tpl->row = Db::run()->first(self::cTable, null, array("slug" . Lang::$lang => $slug))) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Portfolio.class.php, ln.:" . __line__ . "]";
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
					  "client",
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
			  $pager->items_total = Db::run()->count(self::mTable, "category_id = " . $tpl->row->id);
			  $pager->default_ipp = $this->ipc;
			  $pager->path = Url::url(Router::$path, "?");
			  $pager->paginate();
	
			  $sql = "
			  SELECT 
				d.id,
				d.created,
				d.title" . Lang::$lang . " AS title,
				d.slug" . Lang::$lang . " AS slug,
				d.thumb
			  FROM
				`" . self::mTable . "` AS d
				WHERE category_id = ?
			  ORDER BY $sorting " . $pager->limit;
			  $tpl->rows = Db::run()->pdoQuery($sql, array($tpl->row->id))->results();
	
			  $tpl->title = Url::formatMeta($tpl->row->{'name' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['portfolio']), $tpl->row->{'name' . Lang::$lang}];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("portfolio");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->categories = $this->categoryTree();
			  $tpl->core = $core;
			  $tpl->pager = $pager;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }
	  }

      /**
       * Portfolio::Render()
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
		  $tpl->data = Db::run()->first(Modules::mTable, array(
			  "title" . lang::$lang,
			  "info" . lang::$lang,
			  "keywords" . lang::$lang,
			  "description" . lang::$lang), array("modalias" => "portfolio"));
		  $tpl->menu = App::Content()->menuTree(true);
	
		  if (!$tpl->row = Db::run()->first(self::mTable, null, array("slug" . Lang::$lang => $slug))) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Portfolio.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $tpl->title = Url::formatMeta($tpl->row->{'title' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['portfolio']), $tpl->row->{'title' . Lang::$lang}];

			  $tpl->meta = '
			  <meta property="og:type" content="article" />
			  <meta property="og:title" content="' . $tpl->row->{'title' . Lang::$lang} . '" />
			  <meta property="og:image" content="' . self::hasThumb($tpl->row->thumb, $tpl->row->id) . '" />
			  <meta property="og:description" content="' . $tpl->title . '" />
			  <meta property="og:url" content="' . Url::url('/' . $core->modname['portfolio'], $slug) . '" />
			  ';
			  
			  $tpl->plugins = App::Plugins()->getModulelugins("portfolio");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->custom_fields = Content::rendertCustomFieldsFront($tpl->row->id, "portfolio");
			  $tpl->images = Utility::jSonToArray($tpl->row->images);
			  $tpl->core = $core;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }
	  }

      /**
       * Portfolio::LatestPlugin()
       * 
       * @return
       */
      public function LatestPlugin()
      {

          $sql = "
		  SELECT 
		    p.id,
			p.title" . Lang::$lang . " as title,
			p.slug" . Lang::$lang . " as slug,
			p.body" . Lang::$lang . " as body,
			p.thumb,
			p.created
			FROM
			  `" . self::mTable . "` as p
		  ORDER BY RAND() LIMIT 0, " . $this->latest; 
		  $row = Db::Run()->pdoQuery($sql)->results();
		  
		  return ($row) ? $row : 0;
      } 

      /**
       * Portfolio::Simplelugin()
       * 
       * @return
       */
      public function Simplelugin()
      {
		  $featured = $this->show_featured ? 'WHERE d.is_featured = 1 ' : null;
		  
          $sql = "
		  SELECT 
		    d.id,
			d.created,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			body" . Lang::$lang . " AS body,
			d.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS ctitle
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c 
			ON c.id = d.category_id
			$featured
		  ORDER BY d.created DESC LIMIT 0, " . $this->latest; 
		   
		  $row = Db::Run()->pdoQuery($sql, array(1))->results();
		  
		  return ($row) ? $row : 0;
      } 
      
      /**
       * Portfolio::searchResults()
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
		  ORDER BY created DESC 
		  LIMIT 10;";
		  
		  return Db::run()->pdoQuery($sql)->results();
	  }

      /**
       * Portfolio::Sitemap()
       * 
       * @return
       */
      public function Sitemap()
      {
		  
		  return Db::run()->select(self::mTable, array("title" . Lang::$lang . " AS title", "slug" . Lang::$lang . " AS slug"))->results();
	  }
	  
      /**
       * Portfolio::hasThumb()
       * 
	   * @param str $thumb
	   * @param str $id
       * @return
       */
      public static function hasThumb($thumb, $id)
      {

          if($thumb) {
			  return FMODULEURL . self::PORTDATA . $id . '/thumbs/' . $thumb;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
	  
      /**
       * Portfolio::hasImage()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasImage($image, $id)
      {

          if($image) {
			  return FMODULEURL . self::PORTDATA . $id . '/' . $image;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
  }