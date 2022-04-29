<?php
  /**
   * Shop Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: Shop.class.php, v5.00 2020-04-03 18:12:05 gewa Exp $
   */
  
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Shop
  {
      const mTable = "mod_shop";
	  const cTable = "mod_shop_categories";
	  const rTable = "mod_shop_related_categories";
	  const gTable = "mod_shop_gallery";
	  const qTable = "mod_shop_cart";
	  const qxTable = "mod_shop_cart_shipping";
	  const vTable = "mod_shop_variations";
	  const vdTable = "mod_shop_variations_data";
	  const shTable = "mod_shop_shipping";
	  const soTable = "mod_shop_shipping_options";
	  const xTable = "mod_shop_payments";
	  const wTable = "mod_shop_wishlist";
	  
	  const SHOPDATA = 'shop/data/';
	  const MAXIMG = 5242880;
	  
	  
      /**
       * Shop::__construct()
       * 
       * @return
       */
      public function __construct()
      {
		  $this->Config();
	  }
	  
      /**
       * Shop::Config()
       * 
       * @return
       */
      private function Config()
      {

          $row = File::readIni(AMODPATH . 'shop/config.ini');
		  $shipping = File::readIni(AMODPATH . 'shop/config.shipping.ini');
		  
		  
		  $this->fpp = $row->shop->fpp;
		  $this->ipp = $row->shop->ipp;
		  $this->weight = $row->shop->weight;
		  $this->length = $row->shop->length;
		  $this->like = $row->shop->like;
		  $this->cols = $row->shop->cols;
		  $this->comments = $row->shop->comments;
		  $this->catcount = $row->shop->catcount;
		  $this->thumb_w = $row->shop->thumb_w;
		  $this->thumb_h = $row->shop->thumb_h;
		  $this->layout = $row->shop->layout;
		  $this->auto_approve = $row->shop->auto_approve;
		  $this->catalog = $row->shop->catalog;
		  $this->blacklist_words = $row->shop->blacklist_words;
		  $this->cdateformat = $row->shop->cdateformat;
		  $this->char_limit = $row->shop->char_limit;
		  $this->comperpage = $row->shop->comperpage;
		  $this->email_req = $row->shop->email_req;
		  $this->notify_new = $row->shop->notify_new;
		  $this->public_access = $row->shop->public_access;
		  $this->show_captcha = $row->shop->show_captcha;
		  $this->show_counter = $row->shop->show_counter;
		  $this->show_username = $row->shop->show_username;
		  $this->show_www = $row->shop->show_www;
		  $this->sorting = $row->shop->sorting;
		  $this->username_req = $row->shop->username_req;
		  
          //$this->allow_free_shipping = $row->shop->allow_free_shipping;
          $this->allow_international_shipping = $row->shop->allow_international_shipping;

          $this->allow_free_shipping_over = $shipping->shipping->allow_free_shipping_over;
          $this->discount_shipping = $shipping->shipping->discount_shipping;
          $this->handling_charge = $shipping->shipping->handling_charge;
		  
		  if(isset($shipping->shipping->shipping_opt_1_name)){
			  $this->shipping_opt_1_name = $shipping->shipping->shipping_opt_1_name;
			  $this->shipping_opt_1_desc = $shipping->shipping->shipping_opt_1_desc;
			  $this->shipping_opt_1_active = $shipping->shipping->shipping_opt_1_active;			  
		  }

		  if(isset($shipping->shipping->shipping_opt_2_name)){
			  $this->shipping_opt_2_name = $shipping->shipping->shipping_opt_2_name;
			  $this->shipping_opt_2_desc = $shipping->shipping->shipping_opt_2_desc;
			  $this->shipping_opt_2_active = $shipping->shipping->shipping_opt_2_active;			  
		  }

		  if(isset($shipping->shipping->shipping_opt_3_name)){
			  $this->shipping_opt_3_name = $shipping->shipping->shipping_opt_3_name;
			  $this->shipping_opt_3_desc = $shipping->shipping->shipping_opt_3_desc;
			  $this->shipping_opt_3_active = $shipping->shipping->shipping_opt_3_active;			  
		  }

		  
          return ($row) ? $this : 0;
      }
	  
      /**
       * Shop::AdminIndex()
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
                  "price",
                  "xsales",
                  "name"))) {
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
			d.category_id,
			d.title" . Lang::$lang . " AS title,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'shop') as comments,
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
		  $where 
		  GROUP BY d.id
		  ORDER BY $sorting " . $pager->limit; 
		  
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = Db::run()->pdoQuery($sql)->results();
          $tpl->title = Lang::$word->_MOD_SP_TITLE;
		  $tpl->pager = $pager;
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php'; 
	  }

      /**
       * Shop::processItem()
       * 
       * @return
       */
      public function processItem()
      {

		  $rules = array(
			  'price' => array('required|numeric', Lang::$word->PRICE),
			  'price_sale' => array('required|numeric', Lang::$word->_MOD_SP_PSALE),
			  'quantity' => array('required|numeric', Lang::$word->_MOD_SP_QTY),
			  'label' => array('required|string', Lang::$word->_MOD_SP_LABEL),
			  'date_available_submit' => array('required|date', Lang::$word->_MOD_SP_DAVAIL),
			  );

		  $filters = array(
			  'weight' => 'numbers',
			  'length' => 'numbers',
			  'width' => 'numbers',
			  'height' => 'numbers',
			  'points' => 'numbers',
			  'date_available_submit' => 'string',
			  'stock_id' => 'string',
			  );
			  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['title_' . $lang->abbr] = array('required|string|min_len,3|max_len,80', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $filters['title_' . $lang->abbr] = 'string';
			  $filters['slug_' . $lang->abbr] = 'string';
			  $filters['description_' . $lang->abbr] = 'string';
			  $filters['keywords_' . $lang->abbr] = 'string';
			  $filters['body_' . $lang->abbr] = 'advanced_tags';
		  }

          if (!array_key_exists('shipping_opt', $_POST)) {
              Message::$msgs['categories'] = LANG::$word->_MOD_SP_SHIPPING_OPT_EMPTY;
          }

          if (array_key_exists('shipping_opt', $_POST)) {
			  foreach ($_POST['shipping_opt'] as $shpopt) {
				 if (empty($shpopt)) {
					  Message::$msgs['variant'] = LANG::$word->_MOD_SP_VAR_SHIP_EMPTY;
				  }
			  }
          }
		  
          if (!array_key_exists('categories', $_POST)) {
              Message::$msgs['categories'] = LANG::$word->_MOD_SP_INFO1;
          }
		  
          if (array_key_exists('variant', $_POST)) {
			  foreach ($_POST['variant'] as $var) {
				 if (empty($var['value']) || !is_numeric($var['price']) || empty($var['qty'])) {
					 Message::$msgs['variant'] = LANG::$word->_MOD_SP_VAR_OPT_EMPTY;
				  }
			  }
          }
		  
		  (Filter::$id) ? $this->_updateItem($rules, $filters) : $this->_addItem($rules, $filters);
      }
	  
      /**
       * Shop::_addItem()
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
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  Content::verifyCustomFields("shop");
		  
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
                  'price' => $safe->price,
				  'price_sale' => $safe->price_sale,
				  'stock_id' => $safe->stock_id,
				  'label' => $safe->label,
				  'weight' => empty($safe->weight) ? 0 : $safe->weight,
				  'length' => empty($safe->length) ? 0 : $safe->length,
				  'width' => empty($safe->width) ? 0 : $safe->width,
				  'height' => empty($safe->height) ? 0 : $safe->height,
				  'subtract' => isset($_POST['subtract']) ? 1 : 0,
				  'date_available' => $safe->date_available_submit,
				  'quantity' => $safe->quantity,
				  'points' => $safe->points,
				  'date_modified' => Db::toDate(),
                  'active' => $safe->active,
                  );

			  $temp_id = App::Session()->get("shoptoken");
			  File::makeDirectory(FMODPATH . self::SHOPDATA . $temp_id . '/thumbs');
			  
			  //process thumb 
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::SHOPDATA . $temp_id . '/'; 
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

			  // Start variants
			  if (array_key_exists('variant', $_POST)) {
				  $variants = array();
				  $i = 1;
				  foreach ($_POST['variant'] as $row) {
					  if(array_key_exists("title", $row)){
						  $row['id'] = $i;
						  $row['price'] = $i;
						  $variants[$row["title"]][] = $row;
					  } else {
						  $variants[""][] = $row;
					  }
					  $i++;
				  }
				  $datax['variation_data'] = json_encode($variants);
			  } else {
				  $datax['variation_data'] = "NULL";
			  }
			  
			  $last_id = Db::run()->insert(self::mTable, array_merge($datam, $datax))->getLastInsertId();

			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $fields = Db::run()->select(Content::cfTable)->results();
				  foreach ($fields as $row) {
					  $dataArray[] = array(
						  'shop_id' => $last_id,
						  'field_id' => $row->id,
						  'field_name' => $row->name,
						  'section' => "shop",
						  );
				  }
				  Db::run()->insertBatch(Content::cfdTable, $dataArray);
				  
				  foreach ($fl_array as $key => $val) {
					  $cfdata['field_value'] = Validator::sanitize($val);
					  Db::run()->update(Content::cfdTable, $cfdata, array("shop_id" => $last_id, "field_name" => str_replace("custom_", "", $key)));
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
			  if($rows = Db::run()->select(self::gTable, array("id", "parent_id"), array("parent_id" => App::Session()->get("shoptoken")))->results()) {
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

			  // Process Shipping Options
			  if (isset($_POST['shipping_opt'])) {
				  foreach ($_POST['shipping_opt'] as $soid => $sov) {
					  $sdataArray[] = array(
						  'product_id' => $last_id,
						  'shipping_id' => intval($soid),
						  'value' => floatval($sov),
						  );
				  }
				  Db::run()->insertBatch(self::soTable, $sdataArray);
			  }
			  
			  //rename temp folder 
			  File::renameDirectory(FMODPATH . self::SHOPDATA . $temp_id, FMODPATH . self::SHOPDATA . $last_id);
			  
			  if ($last_id) {
				  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_SP_ITM_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = $message;
				  $json['redirect'] = Url::url("/admin/modules", "shop/");
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
       * Shop::_updateItem()
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


		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  Content::verifyCustomFields("shop");
		  
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
                  'price' => $safe->price,
				  'price_sale' => $safe->price_sale,
				  'label' => $safe->label,
				  'stock_id' => $safe->stock_id,
				  'weight' => empty($safe->weight) ? 0 : $safe->weight,
				  'length' => empty($safe->length) ? 0 : $safe->length,
				  'width' => empty($safe->width) ? 0 : $safe->width,
				  'height' => empty($safe->height) ? 0 : $safe->height,
				  'subtract' => isset($_POST['subtract']) ? 1 : 0,
				  'date_available' => $safe->date_available_submit,
				  'quantity' => $safe->quantity,
				  'points' => $safe->points,
                  'active' => $safe->active,
				  'images' => Db::run()->select(self::gTable, array("name"), array("parent_id" => Filter::$id))->results('json'),
                  );
				  
			  //process thumb 
			  $row = Db::run()->first(self::mTable, array("thumb"), array('id' => Filter::$id));
			  if (!empty($_FILES['thumb']['name'])) {
				  $thumbpath = FMODPATH . self::SHOPDATA . Filter::$id . '/'; 
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

			  // Start variants
			  if (array_key_exists('variant', $_POST)) {
				  $variants = array();
				  $i = 1;
				  foreach ($_POST['variant'] as $row) {
					  if(array_key_exists("title", $row)){
						  $row['id'] = $i;
						  $variants[$row["title"]][] = $row;
					  } else {
						  $variants[""][] = $row;
					  }
					  $i++;
				  }
				  $datax['variation_data'] = json_encode($variants);
			  } else {
				  $datax['variation_data'] = "NULL";
			  }
			  
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $result = array();
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("shop_id" => Filter::$id, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
			  //process related categories 
			  Db::run()->delete(self::rTable, array('item_id' => Filter::$id));
			  foreach ($_POST['categories'] as $item) {
				  $dataArray[] = array(
					  'item_id' => Filter::$id,
					  'category_id' => $item
					  );
			  }
			  Db::run()->insertBatch(self::rTable, $dataArray);

			  // Process Shipping Options
			  if (isset($_POST['shipping_opt'])) {
				  Db::run()->delete(self::soTable, array('product_id' => Filter::$id));
				  foreach ($_POST['shipping_opt'] as $soid => $sov) {
					  $sdataArray[] = array(
						  'product_id' => Filter::$id,
						  'shipping_id' => intval($soid),
						  'value' => floatval($sov),
						  );
				  }
				  Db::run()->insertBatch(self::soTable, $sdataArray);
			  }
				  
			  Db::run()->update(self::mTable, array_merge($datam, $datax), array("id" => Filter::$id));

			  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_SP_ITM_UPDATE_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
			  Logger::writeLog($message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Shop::Save()
       * 
       * @return
       */
      public function Save()
      {
		  App::Session()->set("shoptoken",Utility::randNumbers(4));
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T8;
		  $tpl->langlist = App::Core()->langlist;
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->custom_fields = Content::rendertCustomFields("", "shop");
		  $tpl->shipping = $this->shippingOptions();
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
      }
	  
      /**
       * Shop::Edit()
       * 
       * @param int $id
       * @return
       */
      public function Edit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T6;
          $tpl->crumbs = ['admin', 'modules', 'shop', 'edit'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Shop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
              $tpl->langlist = App::Core()->langlist;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCatCheckList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->categories);
			  $tpl->images = Db::run()->select(self::gTable, array("id", "name"), array("parent_id" => $row->id), "ORDER BY sorting")->results();
			  $tpl->custom_fields = Content::rendertCustomFields($row->id, "shop");
			  $tpl->shipping = $this->shippingOptions($row->id);
			  $tpl->variations = json_decode($tpl->data->variation_data);
              $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
          }
      }
	  
      /**
       * Shop::CategorySave()
       * 
       * @return
       */
      public function CategorySave()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T4;
		  $tpl->tree = $this->categoryTree();
		  $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
		  $tpl->langlist = App::Core()->langlist;
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
      }

      /**
       * Shop::CategoryEdit()
       * 
       * @param int $id
       * @return
       */
      public function CategoryEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T4;
          $tpl->crumbs = ['admin', 'modules', 'shop', 'category'];

          if (!$row = Db::run()->first(self::cTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Shop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
			  $tpl->tree = $this->categoryTree();
		      $tpl->droplist = self::getCategoryDropList($tpl->tree, 0, 0,"&#166;&nbsp;&nbsp;&nbsp;&nbsp;", $row->parent_id);
		      $tpl->sortlist = $this->getSortCategoryList($tpl->tree);
              $tpl->langlist = App::Core()->langlist;
              $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
          }
      }

      /**
       * Shop::processCategory()
       * 
       * @return
       */
	  public function processCategory()
	  {

		  $rules = array(
			  'parent_id' => array('required|numeric', Lang::$word->_MOD_SP_CATPARENT),
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
				  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_SP_CAT_UPDATE_OK);
				  Message::msgReply(Db::run()->affected(), 'success', $message);
				  Logger::writeLog($message);
			  } else {
				  if ($last_id) {
					  $message = Message::formatSuccessMessage($datam['name' . Lang::$lang], Lang::$word->_MOD_SP_CAT_ADDED_OK);
					  $json['type'] = "success";
					  $json['title'] = Lang::$word->SUCCESS;
					  $json['message'] = $message;
					  $json['redirect'] = Url::url("/admin/modules/shop/categories");
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
       * Shop::processShipping()
       * 
       * @return
       */
	  public function processShipping()
	  {
	
		  $rules = array(
			  'tracking' => array('required|string', Lang::$word->_MOD_SP_SUB17),
			  'user_id' => array('required|numeric', "User ID"),
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'tracking' => $safe->tracking,
				  'shipped' => Db::toDate(),
				  'status' => 1,
				  );
			  
			  Db::run()->update(self::shTable, $data, array("id" => Filter::$id)); 
			  
			  if (Validator::post('notify') && intval($_POST['notify']) == 1) {
				  $user = Db::run()->first(Users::mTable, array("email", "CONCAT(fname,' ',lname) as name"), array("id" => $safe->user_id)); 
				  $mailer = Mailer::sendMail();
				  $core = App::Core();
				  $etpl = Db::run()->first(Content::eTable, array("body" . Lang::$lang, "subject" . Lang::$lang), array('typeid' => 'shopShipping'));
				  
				  $tpl = App::View(AMODPATH . 'shop/snippets/'); 
				  $tpl->row = Db::run()->first(self::shTable, null, array("id" => Filter::$id)); 
				  $tpl->items = json_decode($tpl->row->items);
				  $tpl->template = '_userShippingTemplate.tpl.php'; 
					
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
					  $user->name,
					  date('Y'),
					  $core->company,
					  $core->site_name,
					  $tpl->render(),
					  Url::url('/' . $core->system_slugs->account[0]->{'slug' . Lang::$lang}, "shop"),
					  $core->social->facebook,
					  $core->social->twitter,
					  SITEURL), $etpl->{'body' . Lang::$lang}); 
					  
				  $msg = (new Swift_Message())
						->setSubject($etpl->{'subject' . Lang::$lang})
						->setTo(array($user->email => $user->name))
						->setFrom(array($core->site_email => $core->company))
						->setBody($body, 'text/html'
						);
			  }
			  if ($mailer->send($msg)) {
				  //$message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_SP_ITM_ADDED_OK);
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = Lang::$word->_MOD_SP_SHIPPING_OK;
				  $json['redirect'] = Url::url("/admin/modules/shop", "shipping/");
			  } else {
				  $json['type'] = "alert";
				  $json['title'] = Lang::$word->ALERT;
				  $json['message'] = Lang::$word->NOPROCCESS;
			  }
			  print json_encode($json);
			  
			  //Message::msgReply(Db::run()->affected(), 'success', Lang::$word->_MOD_SP_SHIPPING_OK);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Shop::Settings()
       * 
       * @return
       */
      public function Settings()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T3;
		  $tpl->data = $this->Config();
		  $tpl->shipping = $this->shippingOptions(null, false);
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
      }
	  
      /**
       * Shop::Variations()
       * 
       * @return
       */
      public function Variations()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T7;
		  $tpl->data = Db::run()->select(self::vTable, null, array("parent_id" => 0), "ORDER BY sorting")->results();
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
      }

      /**
       * Shop::VariationSave()
       * 
       * @return
       */
      public function VariationSave()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->crumbs = ['admin', 'modules', 'shop', 'variations', 'new'];
          $tpl->title = Lang::$word->_MOD_SP_META_T7;
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
      }
	  
      /**
       * Shop::VariationEdit()
       * 
       * @return
       */
      public function VariationEdit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T7;
          $tpl->crumbs = ['admin', 'modules', 'shop', 'variations', 'edit'];

          if (!$row = Db::run()->first(self::vTable, null, array("parent_id" => 0, "id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Shop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->row = $row;
			  $tpl->data = Db::run()->select(self::vTable, null, array("parent_id" => $id))->results();
              $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
          }
      }

      /**
       * Shop::processVariation()
       * 
       * @return
       */
      public function processVariation()
      {

		  $rules = array(
			  'title' => array('required|string', Lang::$word->TITLE),
			  );
			  
		  $filters = array('title' => 'trim|string');

          if (!array_key_exists('name', $_POST)) {
              Message::$msgs['name'] = LANG::$word->_MOD_SP_VAR_OPT_ONE;
          }

          if (array_key_exists('name', $_POST)) {
              if (!array_filter($_POST['name'])) {
                  Message::$msgs['name'] = LANG::$word->_MOD_SP_VAR_OPT_ONE;
              }
          }
          (Filter::$id) ? $this->_updateVariation($rules, $filters) : $this->_addVariation($rules, $filters);
      }
	  
      /**
       * Shop::_updateVariation()
       * 
       * @param array $rules
	   * @param array $filters
       * @return
       */
      private function _updateVariation($rules, $filters)
      {
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
			  Db::run()->delete(self::vTable, array('parent_id' => Filter::$id));
			  Db::run()->update(self::vTable, array("name" => $safe->title), array("id" => Filter::$id));
			  
			  $result = array_filter($_POST['name']);

			  foreach ($result as $item):
				  $dataArray[] = array(
					  'parent_id' => Filter::$id,
					  'name' => Validator::sanitize($item)
					  );
			  endforeach;
			  Db::run()->insertBatch(self::vTable, $dataArray);
			  
			  $message = Message::formatSuccessMessage($safe->title, Lang::$word->_MOD_SP_VAR_UPDATE_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Shop::_addVariation()
       * 
       * @param array $rules
	   * @param array $filters
       * @return
       */
      private function _addVariation($rules, $filters)
      {
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

          if (empty(Message::$msgs)) {
			  $last_id = Db::run()->insert(self::vTable, array("name" => $safe->title))->getLastInsertId();
			  
			  $result = array_filter($_POST['name']);

			  foreach ($result as $item):
				  $dataArray[] = array(
					  'parent_id' => $last_id,
					  'name' => Validator::sanitize($item)
					  );
			  endforeach;
			  Db::run()->insertBatch(self::vTable, $dataArray);
			  
			  $message = Message::formatSuccessMessage($safe->title, Lang::$word->_MOD_SP_VAR_ADDED_OK);
			  Message::msgReply(Db::run()->affected(), 'success', $message);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Shop::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {

		  $rules = array(
			  'allow_free_shipping_over' => array('required|numeric', Lang::$word->_MOD_SP_FREE_SHIPPING_OVER),
			  'discount_shipping' => array('required|numeric', Lang::$word->_MOD_SP_DISCOUNT_SHIPPING),
			  'handling_charge' => array('required|numeric', Lang::$word->_MOD_SP_HANDLING_CHARGE),
			  'like' => array('required|numeric', Lang::$word->_MOD_SP_LIKE),
			  'comments' => array('required|numeric', Lang::$word->_MOD_SP_COMMENTS),
			  //'allow_free_shipping' => array('required|numeric', Lang::$word->_MOD_SP_FREE_SHIPPING),
			  'auto_approve' => array('required|numeric', Lang::$word->_MOD_SP_SUB32),
			  'catalog' => array('required|numeric', Lang::$word->_MOD_SP_SUB47),
			  'cdateformat' => array('required|string', Lang::$word->_MOD_SP_SUB36),
			  'char_limit' => array('required|numeric', Lang::$word->_MOD_SP_SUB37),
			  'comperpage' => array('required|numeric', Lang::$word->_MOD_SP_CPP),
			  'email_req' => array('required|numeric', Lang::$word->_MOD_SP_SUB30),
			  'fpp' => array('required|numeric', Lang::$word->_MOD_SP_LP),
			  'ipp' => array('required|numeric', Lang::$word->_MOD_SP_IPC),
			  'layout' => array('required|numeric', Lang::$word->_MOD_SP_SUB2),
			  'notify_new' => array('required|numeric', Lang::$word->_MOD_SP_SUB31),
			  'public_access' => array('required|numeric', Lang::$word->_MOD_SP_SUB29),
			  'show_captcha' => array('required|numeric', Lang::$word->_MOD_SP_SUB25),
			  'show_counter' => array('required|numeric', Lang::$word->_MOD_SP_SUB23),
			  'show_username' => array('required|numeric', Lang::$word->_MOD_SP_SUB27),
			  'show_www' => array('required|numeric', Lang::$word->_MOD_SP_SUB26),
			  'sorting' => array('required|string', Lang::$word->_MOD_SP_SUB34),
			  'username_req' => array('required|numeric', Lang::$word->_MOD_SP_SUB24),
			  'weight' => array('required|string', Lang::$word->_MOD_SP_SUB41),
			  'length' => array('required|string', Lang::$word->_MOD_SP_SUB40),
			  'thumb_w' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_W),
			  'thumb_h' => array('required|numeric|min_len,3|max_len,3', Lang::$word->THUMB_H),
			  );
			  
		  $filters = array('blacklist_words' => 'trim|string');

          if (!array_key_exists('shipping_opt', $_POST)) {
              Message::$msgs['shipping_opt'] = LANG::$word->_MOD_SP_SHIPPING_OPT_EMPTY;
          }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $all_ids = $used_ids = $free_ids = array();
			  $active_opts = 0;
			  
              foreach ($_POST['shipping_opt'] as $shopid => $shopt) {
                  $used_ids[] = $shopid;
              }
              $all_ids = range(1, max($used_ids));
              $free_ids = array_diff($all_ids, $used_ids);

              $sdata = array('shipping' => array(
                      'allow_free_shipping_over' => $safe->allow_free_shipping_over,
                      'discount_shipping' => $safe->discount_shipping,
                      'handling_charge' => $safe->handling_charge,

                      ));
					  
              foreach ($_POST['shipping_opt'] as $shopid => $shopt) {
                  if (is_int($shopid)) {
                      $sdata['shipping']['shipping_opt_' . $shopid . '_name'] = empty($shopt['name']) ? 'Basic ' . $shopid : $shopt['name'];
					  $sdata['shipping']['shipping_opt_' . $shopid . '_desc'] = empty($shopt['desc']) ? 'Descritpion ' . $shopid : $shopt['desc'];
                      $sdata['shipping']['shipping_opt_' . $shopid . '_active'] = $shopt['active'] > 0 ? 1 : 0;
                  } else {
                      $newid = count($free_ids) ? array_pop($free_ids) : $active_opts + 1;
                      $sdata['shipping']['shipping_opt_' . $newid . '_name'] = empty($shopt['name']) ? 'Basic ' . $shopid : $shopt['name'];
					  $sdata['shipping']['shipping_opt_' . $newid . '_desc'] = empty($shopt['desc']) ? 'Descritpion ' . $shopid : $shopt['desc'];
                      $sdata['shipping']['shipping_opt_' . $newid . '_active'] = $shopt['active'] > 0 ? 1 : 0;
                  }
				  $active_opts++;
              }

			  $data = array('shop' => array(
					  'auto_approve' => $safe->auto_approve,
					  'catalog' => $safe->catalog,
					  'cdateformat' => $safe->cdateformat,
					  'char_limit' => $safe->char_limit,
					  'comperpage' => $safe->comperpage,
					  'email_req' => $safe->email_req,
					  'fpp' => $safe->fpp,
					  'ipp' => $safe->ipp,
					  'catcount' => 1,
					  'layout' => $safe->layout,
					  'comments' => $safe->comments,
					  'allow_international_shipping' => 1,
					  'cols' => 3,
					  'like' => $safe->like,
					  'notify_new' => $safe->notify_new,
					  'public_access' => $safe->public_access,
					  'show_captcha' => $safe->show_captcha,
					  'show_counter' => $safe->show_counter,
					  'show_username' => $safe->show_username,
					  'show_www' => $safe->show_www,
					  'sorting' => $safe->sorting,
					  'username_req' => $safe->username_req,
					  'blacklist_words' => $safe->blacklist_words,
					  //'allow_free_shipping' => $safe->allow_free_shipping,
					  'weight' => $safe->weight,
					  'length' => $safe->length,
					  'thumb_w' => $safe->thumb_w,
					  'thumb_h' => $safe->thumb_h,
					  ));
					  
			  File::writeIni(AMODPATH . 'shop/config.ini', $data)	;  
			  Message::msgReply(File::writeIni(AMODPATH . 'shop/config.shipping.ini', $sdata), 'success', Lang::$word->_MOD_SP_CONF_UPDATE_OK);
			  Logger::writeLog(Lang::$word->_MOD_SP_CONF_UPDATE_OK);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Shop::Payments()
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
          $tpl->title = Lang::$word->_MOD_SP_META_T9;
          $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
		  
      }

      /**
       * Shop::salesChart()
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
       * Shop::allPayments()
       * 
       * @return
       */
      public static function allPayments($fromdate = '', $enddate = '')
      {

		  $enddate = (isset($enddate) && $enddate) <> "" ? Validator::sanitize(Db::toDate($enddate, false)) : date("Y-m-d");
		  $fromdate = isset($fromdate) ? Validator::sanitize(Db::toDate($fromdate, false)) : null;
		  
          if (isset($fromdate) && $enddate <> "") {
              $where = "WHERE p.created BETWEEN '" . trim($fromdate) . "' AND '" . trim($enddate) . " 23:59:59'";
          } else {
              $where = null;
          }
		  
          $sql = "
		  SELECT 
		    p.txn_id,
			CONCAT(u.fname,' ',u.lname) as name,
			m.title" . Lang::$lang . " as title,
			p.variant,
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
       * Shop::History()
       * 
	   * @param int $id
       * @return
       */
      public function History($id)
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T1;
		  $tpl->crumbs = ['admin', 'modules', 'shop', 'history'];
		  
		  if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Shop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
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
			  $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
		  }
      }

      /**
       * Shop::itemChart()
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
       * Shop::itemPayments()
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
			p.variant,
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
       * Shop::Shipping()
       * 
       * @return
       */
      public static function Shipping()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T10;
		  $tpl->crumbs = ['admin', 'modules', 'shop', 'shipping'];

		  $name = Validator::get('name') ? Validator::sanitize(Validator::get('name'), "search") : null;
		  $search = "%$name%";
		  
          if (Validator::get('name')) {
              $counter = Db::run()->count(false, false, "SELECT COUNT(*) FROM `" . self::shTable . "` WHERE `user` LIKE '%" . $name . "%'");
              $where = "WHERE sh.user LIKE ?";
          } else {
			  $counter = Db::run()->count(self::shTable);
              $where = null;
          }

          $pager = Paginator::instance();
          $pager->items_total = $counter;
          $pager->default_ipp = App::Core()->perpage;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate();
		  
          $sql = "
		  SELECT 
			sh.* 
		  FROM `" . self::shTable . "` as sh 
		  $where
		  ORDER BY sh.created DESC, status DESC" . $pager->limit . ";";
		  
		  $tpl->data = Db::run()->pdoQuery($sql, array($search))->results();
		  $tpl->pager = $pager;
		  $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
      }

      /**
       * Shop::ShippingView()
       * 
       * @param integer $id
       * @return
       */
      public static function ShippingView($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_SP_META_T6;
          $tpl->crumbs = ['admin', 'modules', 'shop', 'shipping', 'view'];

          if (!$row = Db::run()->first(self::shTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Shop.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->row = $row;
			  $tpl->items = json_decode($row->items);
              $tpl->template = 'admin/modules_/shop/view/index.tpl.php';
          }
	  }
	  
      /**
       * Shop::getSortCategoryList()
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
				 . ' <a href="' . Url::url("/admin/modules/shop/category", $row['id']) . '">' . $row['name'] . '</a>' 
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
       * Shop::getCatCheckList()
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
       * Shop::getCategoryDropList()
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
       * Shop::categoryTree()
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
       * Shop::FrontHome()
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
				  "created",
                  "name"))) {
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
          $pager->default_ipp = App::Shop()->fpp;
          $pager->path = Url::url(Router::$path, "?");
          $pager->paginate(); 

          $sql = "
		  SELECT 
		    d.id,
			d.created,
			d.price,
			d.price_sale,			
			d.subtract,
			d.label,
			d.ratings,
			d.quantity,
			d.variation_data,
			FORMAT((d.likes/d.ratings),0) as stars,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			d.body" . Lang::$lang . " AS body,
			d.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS name,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'shop') as comments
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = d.category_id
		  WHERE d.active = ?  
		  GROUP BY d.id
		  ORDER BY $sorting " . $pager->limit; 
		  
		  $rows = Db::run()->pdoQuery($sql, array(1))->results();
		  
		  return array("rows" => $rows, "pager" => $pager, "conf" => App::Shop());
		  
	  }
	  
      /**
       * Shop::FrontIndex()
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
		  $tpl->data = Db::run()->first(Modules::mTable, array("title" . lang::$lang, "info" . lang::$lang, "keywords" . lang::$lang, "description" . lang::$lang), array("modalias" => "shop"));

          if (isset($_GET['order']) and count(explode("|", $_GET['order'])) == 2) {
              list($sort, $order) = explode("|", $_GET['order']);
              $sort = Validator::sanitize($sort, "default", 16);
              $order = Validator::sanitize($order, "default", 4);
              if (in_array($sort, array(
                  "title",
                  "price",
				  "created",
                  "name"))) {
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
			d.price_sale,			
			d.subtract,
			d.label,
			d.ratings,
			d.quantity,
			d.variation_data,
			FORMAT((d.likes/d.ratings),0) as stars,
			d.title" . Lang::$lang . " AS title,
			d.slug" . Lang::$lang . " AS slug,
			d.body" . Lang::$lang . " AS body,
			d.thumb,
			c.slug" . Lang::$lang . " AS cslug,
			c.name" . Lang::$lang . " AS name,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'shop') as comments
		  FROM
			`" . self::mTable . "` AS d
			LEFT JOIN `" . self::cTable . "` AS c
			ON c.id = d.category_id
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
		  $tpl->plugins = App::Plugins()->getModulelugins("shop");
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
		  $tpl->pager = $pager;
		  $tpl->conf = $this;
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  
	  }

      /**
       * Shop::Render()
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
			  "description" . lang::$lang), array("modalias" => "shop"));
		  $tpl->menu = App::Content()->menuTree(true);
		  
		  $sql = "
		  SELECT 
			d.*, 
			d.title" . Lang::$lang . " AS title,
			FORMAT((d.likes/d.ratings),0) as stars,
			(SELECT 
			  COUNT(parent_id) 
			FROM
			  `" . Modules::mcTable . "`
			WHERE `" . Modules::mcTable . "`.parent_id = d.id 
			  AND section = 'shop') as comments
		  FROM
			`" . self::mTable . "` AS d
		  WHERE slug" . Lang::$lang . " = ?
		  AND d.active = ? 
		  GROUP BY d.id;";
	
		  if (!$tpl->row = Db::run()->pdoQuery($sql, array($slug, 1))->result()) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Shop.class.php, ln.:" . __line__ . "]";
			  } else {
				  $tpl->template = 'front/themes/' . $core->theme . '/404.tpl.php';
			  }
		  } else {
			  $tpl->title = Url::formatMeta($tpl->row->{'title' . Lang::$lang}, $tpl->data->{'title' . Lang::$lang});
			  $tpl->keywords = $tpl->row->{'keywords' . Lang::$lang};
			  $tpl->description = $tpl->row->{'description' . Lang::$lang};
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['shop']), $tpl->row->{'title' . Lang::$lang}];

			  $tpl->meta = '
			  <meta property="og:type" content="article" />
			  <meta property="og:title" content="' . $tpl->row->{'title' . Lang::$lang} . '" />
			  <meta property="og:image" content="' . self::hasThumb($tpl->row->thumb, $tpl->row->id) . '" />
			  <meta property="og:description" content="' . $tpl->title . '" />
			  <meta property="og:url" content="' . Url::url('/' . $core->modname['shop'], $slug) . '" />
			  ';
			  
			  $tpl->plugins = array();
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  $tpl->totals = Shop::getCartSimpleTotal();
			  //$tpl->custom_fields = Content::rendertCustomFieldsFront($tpl->row->id, "shop");
			  $tpl->images = Utility::jSonToArray($tpl->row->images);
			  
			  $tpl->conf = $this;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }
	  }
	  
	  /**
	   * Shop::renderCategories()
	   * 
	   * @return
	   */
	  public function renderCategories($array, $parent_id = 0, $menuid = 'shopcats', $class = 'vertical-menu')
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
	
					  $url = Url::Url('/' . App::Core()->modname['shop'] . '/' . App::Core()->modname['shop-cat'], $row['slug'] . Url::buildQuery());
	
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
       * Shop::catList()
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
		  WHERE c.active = ?
		  GROUP BY c.id
		  ORDER BY parent_id, sorting;";

		  $menu = array();
		  $result = array();
		  
		  if($data = Db::run()->pdoQuery($sql, array(1, 1))->results()) {
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
       * Shop::searchResults()
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
       * Shop::Sitemap()
       * 
       * @return
       */
      public function Sitemap()
      {
		  
		  return Db::run()->select(self::mTable, array("title" . Lang::$lang . " AS title", "slug" . Lang::$lang . " AS slug"), array("active" => 1))->results();
	  }
	  
      /**
       * Shop::getFreeVariations()
       * 
	   * @param int $names
       * @return
       */
	
      public function getFreeVariations($names)
      {
		  
		  $and = $names ? "AND name NOT IN (" . $names . ")" : null;

		  $sql = "
		  SELECT 
			id,
			name
		  FROM
			`" . self::vTable . "` 
		  WHERE parent_id = ?
			$and
		  ORDER BY sorting;";
		  $row = Db::run()->pdoQuery($sql, array(0))->results();  
		  
		  return ($row) ? $row : 0;
      }
	  
      /**
       * Shop::shippingOptions()
       *
	   * @param int $product_id
	   * @param bool $activeOnly
       * @return
       */
      public function shippingOptions($product_id = null, $activeOnly = true)
      {

          if ($product_id) {
              $options = array();
			  
              $query = Db::run()->select(self::soTable, null, array("product_id" => $product_id));
			  foreach ($query->results() as $row) {
				  $options[$row->shipping_id] = $row->value;
			  }
          }

          $row_shipping = File::readIni(AMODPATH . 'shop/config.shipping.ini');
          $opts = array();

          foreach ($row_shipping->shipping as $shp_cnf => $val) {
              if (strpos($shp_cnf, 'shipping_opt_') === 0) {
                  $id = str_replace(array('shipping_opt_', '_name'), '', $shp_cnf);

                  if (isset($row_shipping->shipping->{'shipping_opt_' . $id . '_active'})) {
                      if ($row_shipping->shipping->{'shipping_opt_' . $id . '_active'} == 1 || $activeOnly == false) {
                          $opts['shipping_opt_' . $id] = array(
                              'id' => $id,
                              'name' => $row_shipping->shipping->{'shipping_opt_' . $id . '_name'},
							  'desc' => $row_shipping->shipping->{'shipping_opt_' . $id . '_desc'},
                              'value' => isset($options[$id]) ? $options[$id] : null,
                              'active' => $row_shipping->shipping->{'shipping_opt_' . $id . '_active'});
                      }
                  }
              }
          }

          return json_decode(json_encode($opts));
      }

      /**
       * Shop::Category()
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
			  "description" . lang::$lang), array("modalias" => "shop"));
		  $tpl->menu = App::Content()->menuTree(true);
	
		  if (!$tpl->row = Db::run()->first(self::cTable, null, array("slug" . Lang::$lang => $slug))) {
			  if (DEBUG) {
				  $tpl->template = 'admin/error.tpl.php';
				  $tpl->error = "Invalid slug ($slug) detected [Shop.class.php, ln.:" . __line__ . "]";
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
					  "name",
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
				d.price_sale,
				d.quantity,
				d.subtract,
				d.label,
				d.ratings,
				d.variation_data,
				FORMAT((d.likes/d.ratings),0) as stars,
				d.title" . Lang::$lang . " AS title,
				d.slug" . Lang::$lang . " AS slug,
				d.thumb,
				d.likes,
				c.slug" . Lang::$lang . " AS cslug,
				c.name" . Lang::$lang . " AS name,
				(SELECT 
				  COUNT(parent_id) 
				FROM
				  `" . Modules::mcTable . "`
				WHERE `" . Modules::mcTable . "`.parent_id = d.id 
				  AND section = 'shop') as comments
			  FROM
				`" . self::mTable . "` AS d
				LEFT JOIN `" . self::cTable . "` AS c
				  ON c.id = d.category_id
				INNER JOIN `" . self::rTable . "` AS rc 
				  ON d.id = rc.item_id
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
			  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['shop']), $tpl->row->{'name' . Lang::$lang}];
	
			  $tpl->plugins = App::Plugins()->getModulelugins("shop");
			  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  
			  $tpl->pager = $pager;
			  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
		  }

	  }

      /**
       * Shop::Cart()
       * 
       * @return
       */
	  public function Cart()
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
			  "description" . lang::$lang), array("modalias" => "shop"));
		  $tpl->menu = App::Content()->menuTree(true);

		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['shop']), $core->modname['shop-cart']];
		  $tpl->plugins = array();
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
			  
		  $tpl->core = $core;
		  $tpl->conf = $this;
		  $tpl->rows = Shop::getCartContent();
		  if($tpl->rows) {
			  $tpl->totals = Shop::getCartTotal();
			  $tpl->shipping = Db::run()->first(self::qxTable, null, array("user_id" => App::Auth()->sesid));
			  $tpl->shipping_opt = ($this->allow_free_shipping_over > 0 and $tpl->totals->grand > $this->allow_free_shipping_over) 
			  ? 'free' : Shop::shippingList($this->shippingOptions(), $tpl->totals->products, $tpl->totals->grand);
			  $tpl->tax = Membership::calculateTax();
		  }
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
	  }

      /**
       * Shop::Checkout()
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
			  "description" . lang::$lang), array("modalias" => "shop"));
		  $tpl->menu = App::Content()->menuTree(true);

		  $tpl->crumbs = [array(0 =>Lang::$word->HOME, 1 => ''), array(0 => $tpl->data->{'title' . Lang::$lang}, 1 => $core->modname['shop']), $core->modname['shop-checkout']];
		  $tpl->plugins = array();
		  $tpl->layout = Plugins::moduleLayout($tpl->plugins);
		  
		  $tpl->core = $core;
		  $tpl->conf = $this;
		  $tpl->rows = Shop::getCartContent();

		  if($tpl->rows) {
			  $tpl->totals = Shop::getCartTotal();
			  $tpl->shipping = Db::run()->first(self::qxTable, null, array("user_id" => App::Auth()->sesid));
			  $tpl->shipping_opt = ($this->allow_free_shipping_over > 0 and $tpl->totals->grand > $this->allow_free_shipping_over) 
			  ? 'free' : Shop::shippingList($this->shippingOptions(), $tpl->totals->products, $tpl->totals->grand);
			  $tpl->tax = Membership::calculateTax();
			  $tpl->countries = App::Content()->getCountryList();
			  $tpl->gateways = Db::run()->select(Core::gTable, null, array("active" => 1))->results();
		  }
		  
		  $tpl->template = 'front/themes/' . $core->theme . '/mod_index.tpl.php';
	  }
	  
      /**
       * Shop::shippingList()
       * 
	   * @param arr $shippingopts
	   * @param str $ids
       * @return
       */
      public static function shippingList($shippingopts, $ids)
      {

		  $data = Db::run()->pdoQuery("SELECT * FROM " . self::soTable . " WHERE product_id IN($ids)")->results();
		  if($data) {
			  foreach ($data as $row) {
				  $shippingopts->{'shipping_opt_' . $row->shipping_id}->value += $row->value;
			  }
		  }
		  return $shippingopts;
		  
      }
	  
      /**
       * Shop::hasVariants()
       * 
	   * @param str $string
       * @return
       */
      public static function hasVariants($string)
      {
		  $html = '';
		  $vars = json_decode($string);
		  if($vars) {
			  $html .= '<p>';
				foreach($vars as $name => $var) {
				$html .= '<small>';
				$html .= '<b>';
				$html .= $name . ' </b>: ' . $var . ' ';
                $html .= '</small>';
				}
			  $html .= '</p>';
          }
		  return $html;
      }
	  
      /**
       * Shop::renderPrice()
       * 
       * @param float $price
	   * @param float $sprice
	   * @param str $color
       * @return
       */
      public static function renderPrice($price, $sprice, $color = '')
      {
		  
		  
		  return ($sprice > 0 and $sprice < $price) ? 
		  Utility::formatMoney($sprice) . ' <small class="wojo strike ' . $color . ' text">' . Utility::formatMoney($price) . '</small>' :
		  Utility::formatMoney($price);
      }

      /**
       * Shop::renderBigPrice()
       * 
       * @param float $price
	   * @param float $sprice
	   * @param str $color
       * @return
       */
      public static function renderBigPrice($price, $sprice, $color = '')
      {
		  
		  
		  return ($sprice > 0 and $sprice < $price) ? 
		  '<div class="wojo big text">' . Utility::formatMoney($sprice) . ' <span class="wojo normal text strike ' . $color . '">' . Utility::formatMoney($price) . '</span></div>' :
		  '<div class="wojo big text">' . Utility::formatMoney($price) . '</div>';
      }
	  
      /**
       * Shop::getCartContent()
       * 
       * @param int $uid
       * @return
       */
	  public static function getCartContent($uid = '')
	  {
	
		  $sql = "
		  SELECT 
			c.totalprice,
			c.total,
			Max(c.tax) as tax,
			Max(c.id) as id,
			Max(c.variants) as variants,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			p.slug" . Lang::$lang . " AS slug,
			p.price,
			p.thumb,
			COUNT(*) AS items 
		  FROM
			`" . self::qTable . "` AS c 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = c.product_id 
		  WHERE c.user_id = ?
		  GROUP BY c.product_id, c.totalprice, c.total
		  ORDER BY c.product_id DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->results();
	
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Shop::getCartTotal()
       * 
	   * @param int $uid
       * @return
       */
	  public static function getCartTotal($uid = '')
	  {
	
		  $sql = "
		  SELECT 
		    order_id,
			cart_id,
			GROUP_CONCAT(DISTINCT product_id SEPARATOR ',') AS products,
			SUM(totalprice) as grand,
			SUM(total) as sub,
			SUM(totaltax) as tax,
			COUNT(id) AS items 
		  FROM
			`" . self::qTable . "`
		  WHERE user_id = ?
		  GROUP BY user_id, order_id, cart_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array($uid ? $uid : App::Auth()->sesid))->result();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Shop::getCartSimpleTotal()
       * 
       * @return
       */
	  public static function getCartSimpleTotal()
	  {
	
		  $sql = "
		  SELECT 
			SUM(totalprice) as grand,
			COUNT(id) AS items 
		  FROM
			`" . self::qTable . "`
		  WHERE user_id = ?
		  GROUP BY user_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->sesid))->result();
	
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Shop::userHistory()
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
		  
			  $tpl->history = $this->userProducts();
              $tpl->data = $row;
			  $tpl->url = $core->system_slugs->account[0]->{'slug' . Lang::$lang};
			  Content::$pagedata = $row;
              $tpl->template = 'front/themes/' . $core->theme . '/account.tpl.php';
          } 
	  }

      /**
       * Shop::userWishlist()
       * 
       * @return
       */
	  public function userWishlist()
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
		  
			  $tpl->wishlist = $this->processWishlist();
              $tpl->data = $row;
			  $tpl->url = $core->system_slugs->account[0]->{'slug' . Lang::$lang};
			  Content::$pagedata = $row;
              $tpl->template = 'front/themes/' . $core->theme . '/account.tpl.php';
          } 
	  }

      /**
       * Shop::processWishlist()
       * 
       * @return
       */
	  public function processWishlist()
	  {


		  $new = App::Session()->get('shop_wishlist');

		  if ($new) {
			  $old_wishlist = Db::Run()->select(self::wTable, array("id"), array("user_id" => App::Auth()->uid))->results();
			  $old = array_reduce($old_wishlist, function ($result, $current)
			  {
				  $result[] = current($current); 
				  return $result; 
			  }, array());
			  
			  $new_wishlist = $new ? array_unique(array_merge($old, $new)) : null;
		  
			  Db::run()->delete(self::wTable, array('user_id' => App::Auth()->uid));
			  
			  foreach ($new_wishlist as $item) {
				  $dataArray[] = array(
					  'user_id' => App::Auth()->uid, 
					  'product_id' => $item
				  );
			  }
			  
			  Db::run()->insertBatch(self::wTable, $dataArray);
			  App::Session()->remove('shop_wishlist');
		  }

		  $sql = "
		  SELECT 
		    w.id,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			p.slug" . Lang::$lang . " AS slug,
			p.price,
			p.price_sale,
			p.quantity,
			p.label,
			p.variation_data,
			p.thumb
		  FROM
			`" . self::wTable . "` AS w 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = w.product_id 
		  WHERE w.user_id = ?
		  AND p.active = ? 
		  GROUP BY p.id
		  ORDER BY w.created DESC;";
		  
		  return  Db::run()->pdoQuery($sql, array(App::Auth()->uid, 1))->results();
	  }
	  
      /**
       * Shop::userProducts()
       * 
       * @return
       */
	  public static function userProducts()
	  {
	
		  $sql = "
		  SELECT 
			x.txn_id,
			x.amount,
			x.total,
			x.tax,
			x.variant,
			x.created,
			s.total,
			s.name,
			s.tracking,
			s.shipped,
			s.status,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			p.slug" . Lang::$lang . " AS slug,
			p.thumb,
			COUNT(*) AS items 
		  FROM
			`" . self::xTable . "` AS x 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = x.item_id 
			LEFT JOIN `" . self::shTable . "` AS s 
			  ON s.transaction_id = x.txn_id 
		  WHERE x.user_id = ?
		  GROUP BY x.item_id, x.total
		  ORDER BY x.item_id DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid))->results();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Shop::Invoice()
       * 
	   * @param str $txnid
       * @return
       */
	  public function Invoice($txnid)
	  {
		  
		  $sql = "
		  SELECT 
			x.txn_id,
			x.amount,
			x.total,
			x.tax,
			x.variant,
			x.created,
			p.id AS pid,
			p.title" . Lang::$lang . " AS title,
			COUNT(*) AS items 
		  FROM
			`" . self::xTable . "` AS x 
			LEFT JOIN `" . self::mTable . "` AS p 
			  ON p.id = x.item_id 
		  WHERE x.user_id = ?
		  AND x.txn_id = ?
		  GROUP BY x.item_id, x.total
		  ORDER BY x.item_id DESC;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, Utility::decode($txnid)))->results();
		  
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Shop::invoiceTotal()
       * 
	   * @param str $txnid
       * @return
       */
	  public function invoiceTotal($txnid)
	  {

		  $sql = "
		  SELECT 
			DATE_FORMAT(MAX(created), '%Y%m%d - %H%m') AS invid,
			created,
			currency,
			SUM(total) as grand,
			SUM(amount) as sub,
			SUM(tax) as tax,
			COUNT(id) AS items 
		  FROM
			`" . self::xTable . "`
		  WHERE user_id = ?
		  AND txn_id = ?
		  GROUP BY user_id;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, Utility::decode($txnid)))->result();
	
		  return ($row) ? $row : 0;
	  }

      /**
       * Shop::shippingTotal()
       * 
	   * @param str $txnid
       * @return
       */
	  public function shippingTotal($txnid)
	  {

		  $sql = "
		  SELECT 
			shipping,
			address,
			total 
		  FROM
			`" . self::shTable . "`
		  WHERE user_id = ?
		  AND transaction_id = ?;";
		  
		  $row = Db::run()->pdoQuery($sql, array(App::Auth()->uid, Utility::decode($txnid)))->result();
	
		  return ($row) ? $row : 0;
	  }
	  
      /**
       * Shop::getVariantFromJson()
       * 
       * @param array $array
	   * @param array $values
       * @return
       */
      public static function getVariantFromJson($array, $values)
      {
		  $result = array();
		  if (is_array($array)) {
			  foreach ($array as $key => $value) {
				  foreach ($value as $i => $row) {
					  if (in_array($row['id'], $values)) {
						  $result[] = $value[$i];
					  }
				  }
			  }
		  }
		  return $result;
      }

      /**
       * Shop::formatVariantFromJson()
       * 
       * @param array $array
	   * @param array $values
       * @return
       */
      public static function formatVariantFromJson($array)
      {
		  $result = array();
		  if (is_array($array)) {
			  foreach ($array as $key => $value) {
				  $itemName = $value->title;
                  if (!array_key_exists($itemName, $result)) {
                      $result[$itemName] = array();
                  }
				  $result[$itemName] = $value->value;

			  }
		  }
		  return json_encode($result);
      }
			  
      /**
       * Shop::itemLabel()
       * 
       * @return
       */
      public static function itemLabel()
      {

          $array = array(
			  "normal" => Lang::$word->DEFAULT,
			  "new" => Lang::$word->_MOD_SP_NEWARR,
			  "soon" => Lang::$word->_MOD_SP_SOON,
			  "sold" => Lang::$word->_MOD_SP_SOLDOUT
		  );
		  
		  return $array;
      }
	  
      /**
       * Shop::weightClass()
       * 
       * @return
       */
      public static function weightClass()
      {

          $array = array(
			  "gr" => "Gram",
			  "kg" => "Kilogram",
			  "oz" => "Ounce",
			  "lb" => "Pound"
		  );
		  
		  return $array;
      }
	  
      /**
       * Shop::lenghtClass()
       * 
       * @return
       */
      public static function lenghtClass()
      {

          $array = array(
			  "cm" => "Centimeter",
			  "mm" => "Millimeter",
			  "in" => "Inch"
		  );
		  
		  return $array;
      }
	  
      /**
       * Shop::hasThumb()
       * 
	   * @param str $thumb
	   * @param str $id
       * @return
       */
      public static function hasThumb($thumb, $id)
      {

          if($thumb) {
			  return FMODULEURL . self::SHOPDATA . $id . '/thumbs/' . $thumb;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
	  
      /**
       * Shop::hasImage()
       * 
	   * @param str $image
	   * @param str $id
       * @return
       */
      public static function hasImage($image, $id)
      {

          if($image) {
			  return FMODULEURL . self::SHOPDATA . $id . '/' . $image;
		  } else {
			  return UPLOADURL . '/blank.jpg';
		  }
      }
  }