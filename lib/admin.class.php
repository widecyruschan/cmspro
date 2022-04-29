<?php
  /**
   * Class Admin
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: admin.class.php, v1.00 2018-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');


  class Admin
  {
	  
      /**
       * Admin::Index()
       * 
       * @return
       */
      public function Index()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->counters = Stats::indexStats();
		  $tpl->stats = Stats::indexSalesStats();
          $tpl->template = 'admin/index.tpl.php';
          $tpl->title = Lang::$word->META_T1;
      }
	  
      /**
       * Admin::Account()
       * 
       * @return
       */
      public function Account()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->M_TITLE];
          $tpl->template = 'admin/myaccount.tpl.php';
          $tpl->data = Db::run()->first(Users::mTable, null, array('id' => App::Auth()->uid));
		  $tpl->custom_fields = Content::rendertCustomFields(App::Auth()->uid, "profile");
          $tpl->title = Lang::$word->M_TITLE;

      }
	  
      /**
       * Admin::Password()
       * 
       * @return
       */
      public function Password()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->M_SUB2];
          $tpl->template = 'admin/mypassword.tpl.php';
          $tpl->title = Lang::$word->M_SUB2;

      }
	  
      /**
       * Admin::updateAccount()
       * 
       * @return
       */
      public function updateAccount()
      {

          $rules = array(
              'email' => array('required|email', Lang::$word->M_EMAIL),
              'fname' => array('required|string|min_len,2|max_len,60', Lang::$word->M_FNAME),
              'lname' => array('required|string|min_len,2|max_len,60', Lang::$word->M_LNAME),
              );

          $upl = Upload::instance(512000, "png,jpg");
          if (!empty($_FILES['avatar']['name']) and empty(Message::$msgs)) {
              $upl->process("avatar", UPLOADS . "/avatars/", "AVT_");
          }

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);
		  Content::verifyCustomFields("profile");

          if (empty(Message::$msgs)) {
              $data = array(
                  'email' => $safe->email,
                  'lname' => $safe->lname,
                  'fname' => $safe->fname);

              if (isset($upl->fileInfo['fname'])) {
                  $data['avatar'] = $upl->fileInfo['fname'];
                  if (Auth::$udata->avatar != "") {
                      File::deleteFile(UPLOADS . "/avatars/" . Auth::$udata->avatar);
                      Auth::$udata->avatar = App::Session()->set('avatar', $upl->fileInfo['fname']);
                  }
              }
              Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
              if (Db::run()->affected()) {
                  Auth::$udata->fname = App::Session()->set('fname', $data['fname']);
                  Auth::$udata->lname = App::Session()->set('lname', $data['lname']);
                  Auth::$udata->email = App::Session()->set('email', $data['email']);
              }
			  
			  // Start Custom Fields
			  $fl_array = Utility::array_key_exists_wildcard($_POST, 'custom_*', 'key-value');
			  if ($fl_array) {
				  $result = array();
				  foreach ($fl_array as $key => $val) {
					$cfdata['field_value'] = Validator::sanitize($val);
					Db::run()->update(Content::cfdTable, $cfdata, array("user_id" => Auth::$udata->uid, "field_name" => str_replace("custom_", "", $key)));
				  }
			  }
			  
              $message = str_replace("[NAME]", "", Lang::$word->M_UPDATED);
              Message::msgReply(true, 'success', $message);
          } else {
              Message::msgSingleStatus();
          }
      }
	  
      /**
       * Admin::updateAdminPassword()
       * 
       * @return
       */
      public function updateAdminPassword()
      {

          $rules = array(
              'password' => array('required|string|min_len,6|max_len,20', Lang::$word->NEWPASS),
              'password2' => array('required|string|min_len,6|max_len,20', Lang::$word->CONPASS),
              );

          $validate = Validator::instance();
          $safe = $validate->doValidate($_POST, $rules);

          if ($_POST['password'] != $_POST['password2']) {
              Message::$msgs['pass'] = Lang::$word->M_PASSMATCH;
          }

          if (empty(Message::$msgs)) {
              $salt = '';
              $hash = App::Auth()->create_hash($safe->password, $salt);
              $data['hash'] = $hash;
              $data['salt'] = $salt;

              Db::run()->update(Users::mTable, $data, array("id" => Auth::$udata->uid));
              Message::msgReply(Db::run()->affected(), 'success', Lang::$word->M_PASSUPD_OK);
          } else {
              Message::msgSingleStatus();
          }
      }
 
      /**
       * Admin::Gateways()
       * 
       * @return
       */
      public function Gateways()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->template = 'admin/gateways.tpl.php';
          $tpl->data = Db::run()->select(Core::gTable)->results();
          $tpl->title = Lang::$word->META_T22;

      }
	  
      /**
       * Admin::GatewayEdit()
       * 
       * @return
       */
	  public function GatewayEdit($id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->GW_TITLE1;
		  $tpl->crumbs = ['admin', 'gateways', 'edit'];
	
		  if (!$row = Db::run()->first(Core::gTable, null, array("id =" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [admin.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->template = 'admin/gateways.tpl.php';
		  }
	  }

      /**
       * Admin::processGateway()
       * 
       * @return
       */
	  public function processGateway()
	  {
	
		  $rules = array(
			  'displayname' => array('required|string|min_len,3|max_len,60', Lang::$word->GW_NAME),
			  'extra' => array('required|string', Lang::$word->GW_NAME),
			  'live' => array('required|numeric', Lang::$word->GW_LIVE),
			  'active' => array('required|numeric', Lang::$word->ACTIVE),
			  'id' => array('required|numeric', "ID"),
			  );
	
		  $filters = array(
			  'extra2' => 'string',
			  'extra3' => 'string',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
		  if (empty(Message::$msgs)) {
			  $data = array(
				  'displayname' => $safe->displayname,
				  'extra' => $safe->extra,
				  'extra2' => $safe->extra2,
				  'extra3' => $safe->extra3,
				  'live' => $safe->live,
				  'active' => $safe->active,
				  );
	
			  Db::run()->update(Core::gTable, $data, array("id" => Filter::$id)); 
			  Message::msgReply(Db::run()->affected(), 'success', Message::formatSuccessMessage($data['displayname'], Lang::$word->GW_UPDATED));
		  } else {
			  Message::msgSingleStatus();
		  }
	  }

      /**
       * Admin::Permissions()
       * 
       * @return
       */
      public function Permissions()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->M_TITLE1];
		  $tpl->data = App::Users()->getRoles();
          $tpl->template = 'admin/permissions.tpl.php';
          $tpl->title = Lang::$word->M_TITLE1;

      }

      /**
       * Admin::Privileges()
       * 
       * @return
       */
      public function Privileges($id)
      {

		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/";
		  $tpl->title = Lang::$word->META_T3;
		  $tpl->crumbs = ['admin', 'permissions', Lang::$word->M_TITLE1];
	
		  if (!$row = Db::run()->first(Users::rTable, null, array('id' => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [admin.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->role = $row;
			  $tpl->result = Utility::groupToLoop(App::Users()->getPrivileges($id), "type");
			  $tpl->template = 'admin/permissions.tpl.php';
		  }

      }

      /**
       * Admin::Backup()
       * 
       * @return
       */
      public function Backup()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->dbdir = UPLOADS . '/backups/';
		  $tpl->data = File::findFiles($tpl->dbdir, array('fileTypes' => array('sql'), 'returnType' => 'fileOnly'));
          $tpl->template = 'admin/backup.tpl.php';
          $tpl->title = Lang::$word->DBM_TITLE;
      }

      /**
       * Admin::System()
       * 
       * @return
       */
      public function System()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->SYS_TITLE];
          $tpl->template = 'admin/system.tpl.php';
          $tpl->title = Lang::$word->SYS_TITLE;

      }

      /**
       * Admin::Utilities()
       * 
       * @return
       */
      public function Utilities()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->ADM_UTIL];
          $tpl->template = 'admin/utilities.tpl.php';
		  $tpl->banned = Db::run()->count(Users::mTable, "active = 'b' AND type = 'member'");
		  $tpl->pending = Db::run()->count(Users::mTable, "active = 't' AND type = 'member'");

		  $css = File::loadFile(THEMEBASE . "/css/color.css");
		  $result = array();
		  if($css) {
			  $data = str_replace(array(":root", "{", "}"), array("", "", ""), $css);
			  $data = trim($data);
			  $data = explode(PHP_EOL, $data);
			  $data = array_map('trim', str_replace(array(" ", ";", "--"), array("", "", ""), $data));
			  foreach($data as $colors) {
				  $row = explode(":", $colors);
				  $result[$row[0]] = $row[1];
			   } 
		  }

		  $tpl->colors = $result;
          $tpl->title = Lang::$word->META_T19;

      }
	  
      /**
       * AdminController::Transactions()
       * 
       * @return
       */
      public function Transactions()
      {
          $data = Stats::getAllStats();
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->crumbs = ['admin', Lang::$word->TRX_PAY];
		  $tpl->data = isset($data[0]) ? $data[0] : null;
		  $tpl->pager = isset($data[1]) ? $data[1] : null;
          $tpl->template = 'admin/transactions.tpl.php';
          $tpl->title = Lang::$word->TRX_PAY;

      }
	  
      /**
       * Admin::Mailer()
       * 
       * @return
       */
      public function Mailer()
      {
		  $type = Validator::get('email') ? "singleMail" : "newsletter";
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->data = Db::run()->first(Content::eTable, null, array("typeid" => $type));
          $tpl->template = 'admin/mailer.tpl.php';
          $tpl->title = Lang::$word->META_T24;
      }
	  
      /**
       * Admin::processMailer()
       * 
       * @return
       */
      public function processMailer()
      {
          $rules = array(
              'subject' => array('required|string|min_len,3|max_len,100', Lang::$word->NL_SUBJECT),
              'recipient' => array('required|string', Lang::$word->NL_RCPT),
              );

		  $filters = array(
			  'body' => 'advanced_tags',
			  );

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);

          $upl = Upload::instance(20971520, "zip,jpg,pdf,doc,docx");
          if (!empty($_FILES['attachment']['name']) and empty(Message::$msgs)) {
              $upl->process("attachment", UPLOADS . "/attachments/", "ATT_");
          }

          if (empty(Message::$msgs)) {
              $body = Validator::cleanOut($safe->body);
              $numSent = 0;
              $failedRecipients = array();

              switch ($safe->recipient) {
                  case "all";
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('active' => 'y', 'type' => 'member'))->results();

                      $replacements = array();
                      $core = App::Core();
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }
                      break;

                  case "newsletter":
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('newsletter' => 1, 'type' => 'member'))->results();

                      $replacements = array();
                      $core = App::Core();
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }

                      break;

                  case "free":
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('membership_id' => 0, 'type' => 'member'))->results();

                      $replacements = array();
                      $core = App::Core();
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }
                      break;

                  case "paid":
                      $mailer = Mailer::sendMail();
                      $mailer->registerPlugin(new Swift_Plugins_AntiFloodPlugin(100, 30));
                      $userrow = Db::run()->select(Users::mTable, array('email', 'CONCAT(fname," ",lname) as name'), array('membership_id <>' => 0, 'and type =' => 'member'))->results();

                      $replacements = array();
                      $core = App::Core();
                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

                          foreach ($userrow as $cols) {
                              $replacements[$cols->email] = array(
                                  '[LOGO]' => Utility::getLogo(),
                                  '[NAME]' => $cols->name,
                                  '[DATE]' => date('Y'),
                                  '[COMPANY]' => $core->company,
                                  '[FB]' => $core->social->facebook,
                                  '[TW]' => $core->social->twitter,
                                  '[ATTACHMENT]' => $attachement,
                                  '[SITEURL]' => SITEURL);
                          }

                          $decorator = new Swift_Plugins_DecoratorPlugin($replacements);
                          $mailer->registerPlugin($decorator);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setFrom(array($core->site_email => $core->company))
								->setBody($body, 'text/html');

                          foreach ($userrow as $row) {
                              $message->setTo(array($row->email => $row->name));
                              $numSent++;
                              $mailer->send($message, $failedRecipients);
                          }
                          unset($row);

                      }
                      break;

                  default:
                      $mailer = Mailer::sendMail();
                      $userrow = Db::run()->pdoQuery("SELECT email, CONCAT(fname,' ',lname) as name FROM `" . Users::mTable . "` WHERE email LIKE '%" . $safe->recipient . "%'")->result();
                      $core = App::Core();

                      if ($userrow) {
                          if (isset($upl->fileInfo['fname'])) {
                              $attachement = '<a href="' . UPLOADURL . '/attachments/' . $upl->fileInfo['fname'] . '">' . Lang::$word->NL_ATTACH . '</a>';
                          } else {
                              $attachement = '';
                          }

						  $newbody = str_replace(array(
							  '[LOGO]',
							  '[NAME]',
							  '[DATE]',
							  '[COMPANY]',
							  '[ATTACHMENT]',
							  '[FB]',
							  '[TW]',
							  '[SITEURL]'), array(
							  Utility::getLogo(),
							  $userrow->name,
							  date('Y'),
							  $core->company,
							  $attachement,
							  $core->social->facebook,
							  $core->social->twitter,
							  SITEURL), $body);

                          $message = (new Swift_Message())
								->setSubject($safe->subject)
								->setTo(array($safe->recipient => $userrow->name))
								->setFrom(array($core->site_email => $core->company))
								->setBody($newbody, 'text/html');

                          $numSent++;
                          $mailer->send($message, $failedRecipients);
                      }
                      break;
              }

              if ($numSent) {
                  $json['type'] = 'success';
                  $json['title'] = Lang::$word->SUCCESS;
                  $json['message'] = $numSent . ' ' . Lang::$word->NL_SENT;
              } else {
                  $json['type'] = 'error';
                  $json['title'] = Lang::$word->ERROR;
                  $res = '';
                  $res .= '<ul>';
                  foreach ($failedRecipients as $failed) {
                      $res .= '<li>' . $failed . '</li>';
                  }
                  $res .= '</ul>';
                  $json['message'] = Lang::$word->NL_ALERT . $res;

                  unset($failed);
              }
              print json_encode($json);
          } else {
              Message::msgSingleStatus();
          }
      }
	  
      /**
       * Admin::Builder()
       * 
	   * @param int $id
	   * @param str $lang
       * @return
       */
	  public function Builder($lang, $id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/builder/";
		  $tpl->title = Lang::$word->META_T9;
		  $tpl->crumbs = ['admin', Lang::$word->ADM_PAGES, 'edit'];
		  
		  $data = json_decode(json_encode(App::Core()->langlist), true);
		  if (!in_array($lang, array_column($data,"abbr")) or !$row = Db::run()->first(Content::pTable, null, array("id" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->plugins = App::Plugins()->getFreePugins(null);
			  $tpl->modules = App::Modules()->getFreeModules(null);
			  $tpl->langlist = App::Core()->langlist;
			  $tpl->template = 'admin/builder.tpl.php';
		  }
	  }
      /**
       * Admin::Builders()
       * 
	   * @param int $id
	   * @param str $lang
       * @return
       */
	  public function Builders($lang, $id)
	  {
		  $tpl = App::View(BASEPATH . 'view/');
		  $tpl->dir = "admin/builders/";
		  $tpl->title = Lang::$word->META_T9;
		  $tpl->crumbs = ['admin', Lang::$word->ADM_PAGES, 'edit'];
		  
		  $data = json_decode(json_encode(App::Core()->langlist), true);
		  if (!in_array($lang, array_column($data,"abbr")) or !$row = Db::run()->first(Content::pTable, null, array("id" => $id))) {
			  $tpl->template = 'admin/error.tpl.php';
			  $tpl->error = DEBUG ? "Invalid ID ($id) detected [Content.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
		  } else {
			  $tpl->data = $row;
			  $tpl->plugins = App::Plugins()->getFreePugins(null);
			  $tpl->modules = App::Modules()->getFreeModules(null);
			  $tpl->langlist = App::Core()->langlist;
			  $tpl->template = 'admin/builders.tpl.php';
		  }
	  }

      /**
       * Admin::Configuration()
       * 
       * @return
       */
	  public function Configuration()
	  {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $tpl->data = App::Core();
          $tpl->template = 'admin/configuration.tpl.php';
          $tpl->title = Lang::$word->META_T14;
	  }

      /**
       * AdminController::Trash()
       * 
       * @return
       */
      public function Trash()
      {

          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
		  $data = Db::run()->select(Core::txTable)->results() ;
		  $tpl->data = Utility::groupToLoop($data, "type");
          $tpl->crumbs = ['admin', Lang::$word->META_T33];
          $tpl->template = 'admin/trash.tpl.php';
          $tpl->title = Lang::$word->META_T33;

      }
	  
      /**
       * AdminController::passReset()
       * 
       * @return
       */
      public function passReset()
      {
		  
          $rules = array('email' => array('required|email', Lang::$word->M_EMAIL));

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);

		  if(!empty($safe->email)) {
			  $row = Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email =' => $safe->email, "and type <>" => "member"));
			  if(!$row) {
				  Message::$msgs['email'] = Lang::$word->LOGIN_R5;
				  $json['title'] = Lang::$word->ERROR;
				  $json['message'] = Lang::$word->LOGIN_R5;
				  $json['type'] = 'error';
			  }
		  }
		  
          if (empty(Message::$msgs)) {
			  $mailer = Mailer::sendMail();
			  $row = Db::run()->first(Users::mTable, array("email", "fname", "lname", "id"), array('email =' => $safe->email, "and type <>" => "member"));
			  $tpl = Db::run()->first(Content::eTable, array("body" . Lang::$lang . " as body", "subject" . Lang::$lang . " as subject"), array('typeid' => 'adminPassReset'));
			  $token = substr(md5(uniqid(rand(), true)), 0, 10);
			  
			  $body = str_replace(array(
				  '[LOGO]',
				  '[NAME]',
				  '[DATE]',
				  '[COMPANY]',
				  '[LINK]',
				  '[IP]',
				  '[FB]',
				  '[TW]',
				  '[SITEURL]'), array(
				  Utility::getLogo(),
				  $row->fname . ' ' . $row->lname,
				  date('Y'),
				  App::Core()->company,
				  Url::url('/password', $token),
				  Url::getIP(),
				  App::Core()->social->facebook,
				  App::Core()->social->twitter,
				  SITEURL), $tpl->body);
				  
				  $msg = (new Swift_Message())
						->setSubject($tpl->subject)
						->setTo(array($row->email => $row->fname . ' ' . $row->lname))
						->setFrom(array(App::Core()->site_email => App::Core()->company))
						->setBody($body, 'text/html');
					  
              Db::run()->update(Users::mTable, array("token" => $token), array('id' => $row->id));
			  if($mailer->send($msg)) {
				  $json['type'] = "success";
				  $json['title'] = Lang::$word->SUCCESS;
				  $json['message'] = Lang::$word->M_PASSWORD_RES_D;
				  print json_encode($json);
			  }
		  } else {
			  $json['type'] = "error";
			  $json['title'] = Lang::$word->ERROR;
			  $json['message'] = Lang::$word->M_EMAIL_R5;
			  print json_encode($json);
		  }
      }
  }