<?php
  /**
   * Core Class
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: core.class.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */

  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Core
  {

      const sTable = "settings";
	  const txTable = "trash";
	  const gTable = "gateways";
	  const cjTable = "cronjobs";
	  
      public static $language;

	  public $_url;
      public $_urlParts;

      /**
       * Core::__construct()
       * 
       * @return
       */
      public function __construct()
      {
          $this->getSettings();
          ($this->dtz) ? ini_set('date.timezone', $this->dtz) : date_default_timezone_set('UTC');
		  Locale::setDefault($this->locale);
      }

      /**
       * Core::getSettings()
       * 
       * @return
       */
      private function getSettings()
      {
          $row = Db::run()->select(self::sTable, null, array('id' => 1))->result();

          $this->site_name = $row->site_name;
		  $this->company = $row->company;
          $this->site_dir = $row->site_dir;
          $this->site_email = $row->site_email;
          $this->logo = $row->logo;
		  $this->plogo = $row->plogo;
          $this->short_date = $row->short_date;
          $this->long_date = $row->long_date;
		  $this->calendar_date = $row->calendar_date;
          $this->time_format = $row->time_format;
          $this->dtz = $row->dtz;
          $this->locale = $row->locale;
          $this->lang = $row->lang;
          $this->weekstart = $row->weekstart;
          $this->theme = $row->theme;
          $this->perpage = $row->perpage;
		  
		  $this->showlang = $row->showlang;
		  $this->showlogin = $row->showlogin;
		  $this->showcrumbs = $row->showcrumbs;
		  $this->showsearch = $row->showsearch;
		  
		  $this->ploader = $row->ploader;

          $this->offline = $row->offline;
          $this->offline_msg = $row->offline_msg;
          $this->offline_d = $row->offline_d;
          $this->offline_t = $row->offline_t;
		  $this->offline_info = $row->offline_info;
          $this->eucookie = $row->eucookie;
          $this->backup = $row->backup;
          $this->currency = $row->currency;
          $this->file_ext = $row->file_ext;
          $this->file_size = $row->file_size;
		  
		  $this->avatar_w = $row->avatar_w;
		  $this->avatar_h = $row->avatar_h;
		  $this->thumb_h = $row->thumb_h;
		  $this->thumb_w = $row->thumb_w;
		  $this->img_w = $row->img_w;
		  $this->img_h = $row->img_h;
		  
		  $this->enable_tax = $row->enable_tax;
		  
		  $this->reg_verify = $row->reg_verify;
		  $this->auto_verify = $row->auto_verify;
		  $this->notify_admin = $row->notify_admin;

          $this->mailer = $row->mailer;
          $this->smtp_host = $row->smtp_host;
          $this->smtp_user = $row->smtp_user;
          $this->smtp_pass = $row->smtp_pass;
          $this->smtp_port = $row->smtp_port;
          $this->sendmail = $row->sendmail;
          $this->is_ssl = $row->is_ssl;
		  
		  $this->slugs = json_decode($row->url_slugs);
		  $this->system_slugs = json_decode($row->system_slugs);
		  
		  $this->moddir = (array)$this->slugs->moddir;
		  $this->modname = (array)$this->slugs->module;
		  $this->pageslug = $this->slugs->pagedata->page;
		  
		  $this->langlist = json_decode($row->lang_list);
		  $this->social = json_decode($row->social_media);
		  
		  $this->ytapi = $row->ytapi;
		  $this->mapapi = $row->mapapi;
		  $this->analytics = $row->analytics;

		  $this->flood = $row->flood;
		  $this->attempt = $row->attempt;
		  $this->logging = $row->logging;
		  
		  $this->inv_info = $row->inv_info;
		  $this->inv_note = $row->inv_note;
		  
          $this->wojov = $row->wojov;
          $this->wojon = $row->wojon;

      }

      /**
       * Core::processConfig()
       * 
       * @return
       */
      public function processConfig()
      {

		  $rules = array(
			  'site_name' => array('required|string|min_len,2|max_len,80', Lang::$word->CG_SITENAME),
			  'company' => array('required|string|min_len,2|max_len,80', Lang::$word->CG_COMPANY),
			  'site_email' => array('required|email', Lang::$word->CG_WEBEMAIL),
			  'theme' => array('required|string', Lang::$word->CG_THEME),
			  'perpage' => array('required|numeric', Lang::$word->CG_PERPAGE),
			  'thumb_w' => array('required|numeric', Lang::$word->CG_TH_WH),
			  'thumb_h' => array('required|numeric', Lang::$word->CG_TH_WH),
			  'img_w' => array('required|numeric', Lang::$word->CG_IM_WH),
			  'img_h' => array('required|numeric', Lang::$word->CG_IM_WH),
			  'avatar_w' => array('required|numeric', Lang::$word->CG_AV_WH),
			  'avatar_h' => array('required|numeric', Lang::$word->CG_AV_WH),
			  'long_date' => array('required|string', Lang::$word->CG_LONGDATE),
			  'short_date' => array('required|string', Lang::$word->CG_SHORTDATE),
			  'calendar_date' => array('required|string', Lang::$word->CG_CALDATE),
			  'time_format' => array('required|string', Lang::$word->CG_TIMEFORMAT),
			  'dtz' => array('required|string', Lang::$word->CG_DTZ),
			  'locale' => array('required|string', Lang::$word->CG_LOCALES),
			  'weekstart' => array('required|numeric', Lang::$word->CG_WEEKSTART),
			  'lang' => array('required|string|min_len,2|max_len,2', Lang::$word->CG_LANG),
			  'ploader' => array('required|numeric', Lang::$word->CG_PLOADER),
			  'eucookie' => array('required|numeric', Lang::$word->CG_EUCOOKIE),
			  'offline' => array('required|numeric', Lang::$word->CG_OFFLINE_M),
			  'showlang' => array('required|numeric', Lang::$word->CG_LANG_SHOW),
			  'showlogin' => array('required|numeric', Lang::$word->CG_LOGIN_SHOW),
			  'showsearch' => array('required|numeric', Lang::$word->CG_SEARCH_SHOW),
			  'showcrumbs' => array('required|numeric', Lang::$word->CG_CRUMBS_SHOW),
			  'currency' => array('required|string|min_len,3|max_len,6', Lang::$word->CG_CURRENCY),
			  'enable_tax' => array('required|numeric', Lang::$word->CG_ETAX),
			  'file_size' => array('required|numeric|min_len,1|max_len,3', Lang::$word->CG_FILESIZE),
			  'file_ext' => array('required|string', Lang::$word->CG_FILETYPE),
			  'reg_verify' => array('required|numeric', Lang::$word->CG_REGVERIFY),
			  'auto_verify' => array('required|numeric', Lang::$word->CG_AUTOVERIFY),
			  'notify_admin' => array('required|numeric', Lang::$word->CG_NOTIFY_ADMIN),
			  'flood' => array('required|numeric|min_len,1|max_len,3', Lang::$word->CG_LOGIN_TIME),
			  'attempt' => array('required|numeric|min_len,1|max_len,1', Lang::$word->CG_LOGIN_ATTEMPT),
			  'logging' => array('required|numeric', Lang::$word->CG_LOG_ON),
			  'mailer' => array('required|string|min_len,3|max_len,5', Lang::$word->CG_MAILER),
			  'is_ssl' => array('required|numeric', Lang::$word->CG_SMTP_SSL),
			  );
	
		  $filters = array(
		      'site_dir' => 'string',
			  'twitter' => 'string',
			  'facebook' => 'string',
			  'offline_d_submit' => 'string',
			  'offline_t' => 'string',
			  'inv_info' => 'basic_tags',
			  'inv_note' => 'basic_tags',
			  'offline_info' => 'basic_tags',
			  'offline_msg' => 'basic_tags',
			  'analytics' => 'string',
			  'ytapi' => 'string',
			  'mapapi' => 'string',
			  );

  		switch ($_POST['mailer']) {
  			case "SMTP":
  				$rules['smtp_host'] = ['required|string', Lang::$word->CG_SMTP_HOST];
				$rules['smtp_user'] = ['required|string', Lang::$word->CG_SMTP_USER];
				$rules['smtp_pass'] = ['required|string', Lang::$word->CG_SMTP_PASS];
				$rules['smtp_port'] = ['required|numeric', Lang::$word->CG_SMTP_PORT];
  				break;

  			case "SMAIL":
  				$rules['sendmail'] = ['required|string', Lang::$word->CG_SMAILPATH];
  				break;
  		}
		
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

		  if (!empty($_FILES['logo']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg,svg");
			  $upl->process("logo", UPLOADS . "/", false, false, false);
		  }

		  if (!empty($_FILES['plogo']['name']) and empty(Message::$msgs)) {
			  $upl = Upload::instance(3145728, "png,jpg");
			  $upl->process("plogo", UPLOADS . "/", false, false, false);
		  }
		  
		  if (empty(Message::$msgs)) {
			  $smedia['facebook'] = $safe->facebook;
			  $smedia['twitter'] = $safe->twitter;
			  
			  $data = array(
				  'site_name' => $safe->site_name,
				  'company' => $safe->company,
				  'site_email' => $safe->site_email,
				  'site_dir' => $safe->site_dir,
				  'theme' => $safe->theme,
				  'perpage' => $safe->perpage,
				  'thumb_w' => $safe->thumb_w,
				  'thumb_h' => $safe->thumb_h,
				  'img_w' => $safe->img_w,
				  'img_h' => $safe->img_h,
				  'avatar_w' => $safe->avatar_w,
				  'avatar_h' => $safe->avatar_h,
				  'long_date' => $safe->long_date,
				  'short_date' => $safe->short_date,
				  'calendar_date' => $safe->calendar_date,
				  'time_format' => $safe->time_format,
				  'weekstart' => $safe->weekstart,
				  'lang' => $safe->lang,
				  'dtz' => $safe->dtz,
				  'locale' => $safe->locale,
				  'ploader' => $safe->ploader,
				  'eucookie' => $safe->eucookie,
				  'offline' => $safe->offline,
				  'offline_msg' => $safe->offline_msg,
				  'offline_d' => Db::toDate($safe->offline_d_submit),
				  'offline_t' => $safe->offline_t,
				  'offline_info' => $safe->offline_info,
				  'showlang' => $safe->showlang,
				  'showlogin' => $safe->showlogin,
				  'showsearch' => $safe->showsearch,
				  'showcrumbs' => $safe->showcrumbs,
				  'currency' => $safe->currency,
				  'enable_tax' => $safe->enable_tax,
				  'file_size' => ($safe->file_size * pow(1024,2)),
				  'file_ext' => $safe->file_ext,
				  'reg_verify' => $safe->reg_verify,
				  'auto_verify' => $safe->auto_verify,
				  'notify_admin' => $safe->notify_admin,
				  'flood' => ($safe->flood * 60),
				  'attempt' => $safe->attempt,
				  'logging' => $safe->logging,
				  'analytics' => $safe->analytics,
				  'mailer' => $safe->mailer,
				  'sendmail' => $safe->sendmail,
				  'smtp_host' => $safe->smtp_host,
				  'smtp_user' => $safe->smtp_user,
				  'smtp_pass' => $safe->smtp_pass,
				  'smtp_port' => $safe->smtp_port,
				  'is_ssl' => $safe->is_ssl,
				  'inv_info' => $safe->inv_info,
				  'inv_note' => $safe->inv_note,
				  'social_media' => json_encode($smedia),
				  'ytapi' => $safe->ytapi,
				  'mapapi' => $safe->mapapi,
				  );

			  if (!empty($_FILES['logo']['name'])) {
				  $data['logo'] = $upl->fileInfo['fname'];
			  }
			  
			  if (!empty($_FILES['plogo']['name'])) {
				  $data['plogo'] = $upl->fileInfo['fname'];
			  }
			  
			  if (Validator::post('dellogo')) {
				  $data['logo'] = "NULL";
			  }
			  if (Validator::post('dellogop')) {
				  $data['plogo'] = "NULL";
			  }
			  
			  Db::run()->update(self::sTable, $data, array('id' => 1));
			  Message::msgReply(Db::run()->affected(), 'success', Lang::$word->CG_UPDATED);
		  } else {
			  Message::msgSingleStatus();
		  }
      }

      /**
       * Core::processSlugs()
       *
       * @return
       */
      public static function processSlugs()
      {
		  $rules = array(
			  'digishop' => array('required|alpha|min_len,3|max_len,60', "digishop"),
			  'blog' => array('required|string|alpha|min_len,3|max_len,60', "blog"),
			  'portfolio' => array('required|alpha|min_len,3|max_len,60', "portfolio"),
			  'gallery' => array('required|alpha|min_len,3|max_len,60', "gallery"),
			  'shop' => array('required|alpha|min_len,3|max_len,60', "shop"),
			  'page' => array('required|alpha|min_len,3|max_len,60', "page"),
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  
		  if (empty(Message::$msgs)) {
			  $array = array (
				'moddir' => 
				  array (
					$safe->digishop => 'digishop',
					$safe->blog => 'blog',
					$safe->portfolio => 'portfolio',
					$safe->gallery => 'gallery',
					$safe->shop => 'shop',
				  ),
				'pagedata' => 
					array (
					  'page' => $safe->page,
					),
				'module' => 
					array (
					  'digishop' => $safe->digishop,
					  'digishop-cat' => 'category',
					  'digishop-checkout' => 'checkout',
					  'blog' => $safe->blog,
					  'blog-cat' => 'category',
					  'blog-search' => 'search',
					  'blog-archive' => 'archive',
					  'blog-author' => 'author',
					  'blog-tag' => 'tag',
					  'portfolio' => $safe->portfolio,
					  'portfolio-cat' => 'category',
					  'gallery' => $safe->gallery,
					  'gallery-album' => 'album',
					  'shop' => $safe->shop,
					  'shop-cat' => 'category',
					  'shop-cart' => 'cart',
					  'shop-checkout' => 'checkout'
					),
			  );
				
			  $data['url_slugs'] = json_encode($array);

			  Db::run()->update(self::sTable, $data, array("id" => 1)); 
			  Message::msgReply(Db::run()->affected(), 'success', Lang::$word->UTL_SLUGS_OK);
		  } else {
			  Message::msgSingleStatus();
		  }
      }

      /**
       * Core::processColors()
       *
       * @return
       */
      public static function processColors()
      {
		  $rules = array(
			  'body-color' => array('required|string', "Body Bg Color"),
			  'body-bg-color' => array('required|string', "Body Bg Color"),
			  'primary-color' => array('required|string', "Primary"),
			  'primary-color-hover' => array('required|string', "Primary Hover"),
			  'primary-color-active' => array('required|string', "Primary Active"),
			  'primary-color-inverted' => array('required|string', "Primary Inverted"),
			  'primary-color-shadow' => array('required|string', "Primary Shadow"),
		      'secondary-color' => array('required|string', "Secondary"),
			  'secondary-color-hover' => array('required|string', "Secondary Hover"),
			  'secondary-color-active' => array('required|string', "Secondary Active"),
			  'secondary-color-inverted' => array('required|string', "Secondary Inverted"),
			  'secondary-color-shadow' => array('required|string', "Secondary Shadow"),
			  'positive-color' => array('required|string', "Positive"),
			  'positive-color-hover' => array('required|string', "Positive Hover"),
			  'positive-color-active' => array('required|string', "Positive Active"),
			  'positive-color-inverted' => array('required|string', "Positive Inverted"),
			  'positive-color-shadow' => array('required|string', "Positive Shadow"),
			  'negative-color' => array('required|string', "Negative"),
			  'negative-color-hover' => array('required|string', "Negative Hover"),
			  'negative-color-active' => array('required|string', "Negative Active"),
			  'negative-color-inverted' => array('required|string', "Negative Inverted"),
			  'negative-color-shadow' => array('required|string', "Negative Shadow"),
			  'alert-color' => array('required|string', "Alert"),
			  'alert-color-hover' => array('required|string', "Alert Hover"),
			  'alert-color-active' => array('required|string', "Alert Active"),
			  'alert-color-inverted' => array('required|string', "Alert Inverted"),
			  'alert-color-shadow' => array('required|string', "Alert Shadow"),
			  'info-color' => array('required|string', "Info"),
			  'info-color-hover' => array('required|string', "Info Hover"),
			  'info-color-active' => array('required|string', "Info Active"),
			  'info-color-inverted' => array('required|string', "Info Inverted"),
			  'info-color-shadow' => array('required|string', "Info Shadow"),
			  'light-color' => array('required|string', "Light"),
			  'light-color-hover' => array('required|string', "Light Hover"),
			  'light-color-active' => array('required|string', "Light Active"),
			  'light-color-inverted' => array('required|string', "Light Inverted"),
			  'light-color-shadow' => array('required|string', "Light Shadow"),
			  'dark-color' => array('required|string', "Dark"),
			  'dark-color-hover' => array('required|string', "Dark Hover"),
			  'dark-color-active' => array('required|string', "Dark Active"),
			  'dark-color-inverted' => array('required|string', "Dark Inverted"),
			  'dark-color-shadow' => array('required|string', "Dark Shadow"),
			  'grey-color' => array('required|string', "Grey"),
			  'grey-color-100' => array('required|string', "Grey 100"),
			  'grey-color-300' => array('required|string', "Grey 300"),
			  'grey-color-500' => array('required|string', "Grey 500"),
			  'grey-color-700' => array('required|string', "Grey 700"),
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  
		  if (empty(Message::$msgs)) {
			  $data = "
				  :root {
				   --body-color: " . $safe->{'body-color'} . ";
				   --body-bg-color: " . $safe->{'body-bg-color'} . ";
				   --primary-color: " . $safe->{'primary-color'} . ";
				   --primary-color-hover: " . $safe->{'primary-color-hover'} . ";
				   --primary-color-active: " . $safe->{'primary-color-active'} . ";
				   --primary-color-inverted: " . $safe->{'primary-color-inverted'} . ";
				   --primary-color-shadow: " . $safe->{'primary-color-shadow'} . ";
				   --secondary-color: " . $safe->{'secondary-color'} . ";
				   --secondary-color-hover: " . $safe->{'secondary-color-hover'} . ";
				   --secondary-color-active: " . $safe->{'secondary-color-active'} . ";
				   --secondary-color-inverted: " . $safe->{'secondary-color-inverted'} . ";
				   --secondary-color-shadow: " . $safe->{'secondary-color-shadow'} . ";
				   --positive-color: " . $safe->{'positive-color'} . ";
				   --positive-color-hover: " . $safe->{'positive-color-hover'} . ";
				   --positive-color-active: " . $safe->{'positive-color-active'} . ";
				   --positive-color-inverted: " . $safe->{'positive-color-inverted'} . ";
				   --positive-color-shadow: " . $safe->{'positive-color-shadow'} . ";
				   --negative-color: " . $safe->{'negative-color'} . ";
				   --negative-color-hover: " . $safe->{'negative-color-shadow'} . ";
				   --negative-color-active: " . $safe->{'negative-color-shadow'} . ";
				   --negative-color-inverted: " . $safe->{'negative-color-shadow'} . ";
				   --negative-color-shadow: " . $safe->{'negative-color-shadow'} . ";
				   --alert-color: " . $safe->{'alert-color'} . ";
				   --alert-color-hover: " . $safe->{'alert-color-shadow'} . ";
				   --alert-color-active: " . $safe->{'alert-color-shadow'} . ";
				   --alert-color-inverted: " . $safe->{'alert-color-shadow'} . ";
				   --alert-color-shadow: " . $safe->{'alert-color-shadow'} . ";
				   --info-color: " . $safe->{'info-color'} . ";
				   --info-color-hover: " . $safe->{'info-color-shadow'} . ";
				   --info-color-active: " . $safe->{'info-color-shadow'} . ";
				   --info-color-inverted: " . $safe->{'info-color-shadow'} . ";
				   --info-color-shadow: " . $safe->{'info-color-shadow'} . ";
				   --light-color: " . $safe->{'light-color'} . ";
				   --light-color-hover: " . $safe->{'light-color-shadow'} . ";
				   --light-color-active: " . $safe->{'light-color-shadow'} . ";
				   --light-color-inverted: " . $safe->{'light-color-shadow'} . ";
				   --light-color-shadow: " . $safe->{'light-color-shadow'} . ";
				   --dark-color: " . $safe->{'dark-color'} . ";
				   --dark-color-hover: " . $safe->{'dark-color-shadow'} . ";
				   --dark-color-active: " . $safe->{'dark-color-shadow'} . ";
				   --dark-color-shadow: " . $safe->{'dark-color-shadow'} . ";
				   --dark-color-inverted: " . $safe->{'dark-color-shadow'} . ";
				   --black-color: #000;
				   --white-color: #fff;
				   --shadow-color: rgba(136, 152, 170, .15);
				   --grey-color: " . $safe->{'grey-color'} . ";
				   --grey-color-100: " . $safe->{'grey-color-100'} . ";
				   --grey-color-300: " . $safe->{'grey-color-300'} . ";
				   --grey-color-500: " . $safe->{'grey-color-500'} . ";
				   --grey-color-700: " . $safe->{'grey-color-700'} . ";
				  }
			  ";

			  $filename = THEMEBASE . "/css/color.css";
			  $file = THEMEURL . "/css/color.css";
			  
			  if (is_writable($filename)) {
				  File::writeToFile($filename, trim($data));
				  File::deleteFile(THEMEBASE . "/cache/master_main_ltr.css");
				  Message::msgReply($file, 'success', Message::formatSuccessMessage($file, Lang::$word->UTL_COLOR_OK));
			  } else {
				  Message::msgReply($file, 'error', Message::formatErrorMessage($file, Lang::$word->UTL_MAP_ERROR));
			  }
		  } else {
			  Message::msgSingleStatus();
		  }
      }
	  
      /**
       * Core::buildLangList()
       *
       * @return
       */
      public static function buildLangList()
      {
          $result = Db::run()->select(Lang::lTable)->results('json');
		  Db::run()->update(Core::sTable, array("lang_list" => $result), array("id" => 1));
      }
	  
      /**
       * Core::restoreFromTrash()
       *
       * @return
       */
      public static function restoreFromTrash($array, $table)
      {
          if ($array) {
              $mapped = array_map(function($k) {
				  return "`".$k."` = ?";
				  },array_keys((array)$array
				  ));
              $stmt = Db::run()->prepare("INSERT INTO `" . $table . "` SET ".implode(", ",$mapped));
              $stmt->execute(array_values((array)$array));
			  
              $json['type'] = "success";
              print json_encode($json);
          }
      }
	  
      /**
       * Core::install()
       *
       * @return
       */
      public function install()
      {
		  File::makeDirectory(BASEPATH . 'temp_update/');
		  File::deleteRecrusive(BASEPATH . 'temp_update/');

		  if (empty($_FILES['installer']['name'])) {
			  Message::$msgs['installer'] = Lang::$word->UTL_INSTALL_E;
		  } else {
			  preg_match('/[0-9]+/', ini_get('post_max_size'), $match);
			  if(Validator::compareNumbers(round($_FILES['installer']['size'] / 1024 / 1024, 1), $match[0], ">")) {
				  Message::$msgs['installer'] = Lang::$word->FU_ERROR10 . ' ' . ini_get('post_max_size');
			  } else {
				  $file = File::upload("installer", 52428800, "zip");
			  }
		  }
		  
		  if (empty(Message::$msgs)) {
			  File::process($file, BASEPATH . 'temp_update/', false, "temp_install.zip");
			  $path = BASEPATH . 'temp_update/temp_install.zip';
			  
			  $zip = new ZipArchive;
			  $res = $zip->open($path);
			  
			  if ($res === true) {
				  $zip->extractTo(BASEPATH . 'temp_update/');
				  $zip->close();
				  
				  $json_file = File::loadFile(BASEPATH . 'temp_update/package.json');
				  
				  if($json_file) {
					  $package = json_decode($json_file);
					  
					  // check if already exists
					  if(Db::run()->exist($package->sql)) {
						  $json['type'] = "error";
						  $json['title'] = Lang::$word->ERROR;
						  $json['message'] = $package->name . " already exists. Install can not continue.";
					  // validate version
					  } elseif(Validator::compareNumbers($package->ver, App::Core()->wojov, "<")) {
						  $json['type'] = "error";
						  $json['title'] = Lang::$word->ERROR;
						  $json['message'] = "This package is not compatible with CMS PRO v." . App::Core()->wojov;
					  // all checks out god to go
					  } else {
						  if(File::exists(BASEPATH . 'temp_update/install.sql')) {
							  $sqldata = File::parseSql(BASEPATH . 'temp_update/install.sql');
							  foreach($sqldata as $sql) {
								  Db::run()->pdoQuery($sql);
							  }
							  
							  File::deleteFile(BASEPATH . 'temp_update/install.sql');
						  } 
						  
						  File::deleteFile(BASEPATH . 'temp_update/temp_install.zip');
						  
						  $json['type'] = "success";
						  $json['title'] = Lang::$word->SUCCESS;
						  $json['message'] = $package->name . " v." . $package->ver . " is successfuly installed.";

						  File::copyDirectory(BASEPATH . 'temp_update', BASEPATH);
						  File::deleteRecrusive(BASEPATH . 'temp_update/');
						  File::deleteFile(BASEPATH . 'install.php');

						  //install languages
						  if($package->lang) {
							  if ($langdata = Db::run()->select(Lang::lTable, array("abbr"), array("abbr <>" => "en" ))->results()) {
								  foreach ($langdata as $lang) {
									  $flag_id = $lang->abbr;
									  include_once(BASEPATH . $package->lang);
								  }
							  }
						  }
						  
						  File::deleteFile(BASEPATH . 'package.json');
					  }
				  } else {
					  $json['type'] = "error";
					  $json['title'] = Lang::$word->ERROR;
					  $json['message'] = "Can not read package";
				  }
			  } else {
				  $json['type'] = "error";
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = "Can not open zip archive";
			  }
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
      }
  }