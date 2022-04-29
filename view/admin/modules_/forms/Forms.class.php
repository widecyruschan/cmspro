<?php
  /**
   * Forms
   *
   * @package wojo:cms
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: Fors.class.php, v5.00 2020-03-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  class Forms
  {
      const mTable = "mod_forms";
      const fTable = "mod_forms_fields";
	  const DATAFILES = 'forms/datafiles/';
	  	  

      /**
       * Forms::__construct()
       * 
       * @return
       */
      public function __construct(){}
	  

      /**
       * Forms::AdminIndex()
       * 
       * @return
       */
      public function AdminIndex()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->data = $this->getForms();
          $tpl->title = Lang::$word->_MOD_VF_TITLE;
          $tpl->template = 'admin/modules_/forms/view/index.tpl.php';
      }

      /**
       * Forms::Edit()
       * 
       * @param int $id
       * @return
       */
      public function Edit($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_VF_SUB1;
          $tpl->crumbs = ['admin', 'modules', 'forms', 'edit'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Forms.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
              $tpl->langlist = App::Core()->langlist;
              $tpl->template = 'admin/modules_/forms/view/index.tpl.php';
          }
      }
	  
      /**
       * Forms::Save()
       * 
       * @return
       */
      public function Save()
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_VF_ADD;
		  $tpl->langlist = App::Core()->langlist;
          $tpl->template = 'admin/modules_/forms/view/index.tpl.php';
      }

      /**
       * Forms::Design()
       * 
       * @param int $id
       * @return
       */
      public function Design($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_VF_TITLE1;
          $tpl->crumbs = ['admin', 'modules', 'forms', 'design'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Forms.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->data = $row;
              $tpl->template = 'admin/modules_/forms/view/index.tpl.php';
			  $tpl = App::View(BASEPATH . 'view/');
			  $tpl->dir = "admin/";
          }
      }

      /**
       * Forms::View()
       * 
       * @param int $id
       * @return
       */
      public function View($id)
      {
          $tpl = App::View(BASEPATH . 'view/');
          $tpl->dir = "admin/";
          $tpl->title = Lang::$word->_MOD_VF_TITLE2;
          $tpl->crumbs = ['admin', 'modules', 'forms', 'preview'];

          if (!$row = Db::run()->first(self::mTable, null, array("id" => $id))) {
              $tpl->template = 'admin/error.tpl.php';
              $tpl->error = DEBUG ? "Invalid ID ($id) detected [Forms.class.php, ln.:" . __line__ . "]" : Lang::$word->META_ERROR;
          } else {
              $tpl->row = $row;
			  $tpl->data = $this->renderForm($row->id);
              $tpl->template = 'admin/modules_/forms/view/index.tpl.php';
			  $tpl = App::View(BASEPATH . 'view/');
			  $tpl->dir = "admin/";
          }
      }
	  
      /**
       * Forms::processForm()
       * 
       * @return
       */
      public function processForm()
      {

		  $rules = array(
			  'mailto' => array('required|email', Lang::$word->_MOD_VF_SUB4),
			  'captcha' => array('required|numeric', Lang::$word->_MOD_VF_SUB6),
			  );
		  $filters['emails'] = 'string|trim';
		  
		  foreach (App::Core()->langlist as $lang) {
			  $rules['title_' . $lang->abbr] = array('required|string|min_len,3|max_len,80', Lang::$word->NAME . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $rules['subject_' . $lang->abbr] = array('required|string|min_len,3|max_len,150', Lang::$word->_MOD_VF_SUBJECT . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $rules['sendmessage_' . $lang->abbr] = array('required|string|min_len,3|max_len,200', Lang::$word->_MOD_VF_SUB3 . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $rules['sbutton_' . $lang->abbr] = array('required|string|min_len,3|max_len,50', Lang::$word->_MOD_VF_SUB2 . ' <span class="flag icon ' . $lang->abbr . '"></span>');
			  $filters['title_' . $lang->abbr] = 'string';
			  $filters['subject_' . $lang->abbr] = 'string';
			  $filters['sendmessage_' . $lang->abbr] = 'string';
			  $filters['sbutton_' . $lang->abbr] = 'string';
		  }

		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
			  foreach (App::Core()->langlist as $i => $lang) {
                  $datam['title_' . $lang->abbr] = $safe->{'title_' . $lang->abbr};
                  $datam['subject_' . $lang->abbr] = $safe->{'subject_' . $lang->abbr};
				  $datam['sendmessage_' . $lang->abbr] = $safe->{'sendmessage_' . $lang->abbr};
				  $datam['sbutton_' . $lang->abbr] = $safe->{'sbutton_' . $lang->abbr};
			  }
              $datax = array(
                  'mailto' => $safe->mailto,
                  'captcha' => $safe->captcha,
				  'emails' => $safe->emails,
                  );

			  foreach (App::Core()->langlist as $i => $lang) {
				  $dataf['title_' . $lang->abbr] = $safe->{'title_' . $lang->abbr};
			  }
					   
              $data = array_merge($datam, $datax);
              (Filter::$id) ? Db::run()->update(self::mTable, $data, array("id" => Filter::$id)) : $last_id = Db::run()->insert(self::mTable, $data)->getLastInsertId();
			  
              if (Filter::$id) {
				  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_VF_UPDATE_OK);
                  Message::msgReply(Db::run()->affected(), 'success', $message);
				  Db::run()->update(Modules::mTable, $dataf, array("parent_id" => Filter::$id, "modalias" => "forms"));
				  Logger::writeLog($message);
              } else {
                  if ($last_id) {
					  $datap = array(
						  'modalias' => "forms",
						  'parent_id' => $last_id,
						  'icon' => "forms/thumb.svg",
						  'is_builder' => 1,
						  'active' => 1,
						  );
					  Db::run()->insert(Modules::mTable, array_merge($dataf, $datap));
					  
					  $message = Message::formatSuccessMessage($datam['title' . Lang::$lang], Lang::$word->_MOD_VF_ADDED_OK);
                      $json['type'] = "success";
                      $json['title'] = Lang::$word->SUCCESS;
                      $json['message'] = $message;
                      $json['redirect'] = Url::url("/admin/modules/forms/design", $last_id);
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
       * Forms::saveField()
       * 
       * @return
       */
      public function saveField()
      {

		  $rules = array(
			  'id' => array('required|string', 'Invalid ID detected'),
			  'type' => array('required|string', 'Invalid Type detected'),
			  );
			  
		  $filters = array(
			  'label' => 'string',
			  'dvalue' => 'string',
			  'tooltip' => 'string',
			  'validation' => 'string',
			  );
		  
          switch($_POST['type']) {
			  case "long_text":
			  case "range":
				  $filters['min_len'] = 'numbers';
				  $filters['max_len'] = 'numbers';
			  break;
			  case "dropdown":
			  case "radio":
			  case "checkbox":
				  $filters['items'] = 'trim';
			  break;
			  case "upload":
				  $filters['filesize'] = 'numbers';
			  break;
			  case "html":
				  $filters['dvalue'] = 'advanced_tags';
			  break;
		  }
		  
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
		  $safe = $validate->doFilter($_POST, $filters);
		  
          if (empty(Message::$msgs)) {
              $data = array(
                  'label' => $safe->label,
				  'type' => $safe->type,
                  'dvalue' => $safe->dvalue,
				  'tooltip' => $safe->tooltip,
				  'validation' => $safe->validation,
				  'required' => (empty($_POST['required'])) ? 0 : 1,
                  );

			  switch($safe->type) {
				  case "long_text":
				  case "range":
					  $data['min_len'] = $safe->min_len;
					  $data['max_len'] = $safe->max_len;
				  break;
				  case "dropdown":
				      $data['selected'] = $safe->dvalue;
					  $data['items'] = preg_split('/\r\n|[\r\n]/', $safe->items);
					  $data['multiple'] = (empty($_POST['multiple'])) ? 0 : 1;
				  break;
				  case "radio":
				  case "checkbox":
					  $data['items'] = preg_split('/\r\n|[\r\n]/', $safe->items);
					  $data['inline'] = (empty($_POST['inline'])) ? 0 : 1;
				  break;
				  case "upload":
					  $data['filesize'] = (empty($safe->filesize)) ? 5 : $safe->filesize;
					  $data['dvalue'] = (empty($safe->dvalue)) ? "zip,rar,pdf" : $safe->dvalue;
				  break;
				  case "image":
					  $data['dvalue'] = ($safe->dvalue == "normal") ? "" : $safe->dvalue;
				  break;
			  }
		  
              Db::run()->update(self::fTable, array("options" => json_encode($data)), array("name" => $safe->id));
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Forms::getForms()
       * 
       * @return
       */
      public function getForms()
      {
		  $row = Db::run()->select(self::mTable, "*", null, "ORDER BY title" . Lang::$lang)->results();

          return ($row) ? $row : 0;
      }

      /**
       * Forms::renderForm()
       * 
	   * @param int $id
       * @return
       */
      public function renderForm($id)
      {
		  $row = Db::run()->select(self::fTable, "*", array("form_id" => $id, "is_system" => 0), "ORDER BY sorting")->results();

          return ($row) ? $row : 0;
      }

      /**
       * Forms::Render()
       * 
	   * @param int $id
       * @return
       */
      public function Render($id)
      {
		  $data = array();
		  $result = array();
		  $row = Db::run()->first(self::mTable, null, array("id" => $id));
		  
		  if($row) {
			  $result = Db::run()->select(self::fTable, "*", array("form_id" => $row->id, "is_system" => 0), "ORDER BY sorting")->results();
		  }

          return ($row) ? $data = ['row' => $row, 'fields' => $result] : 0;
      }
	  
      /**
       * Forms::Submit()
       * 
	   * @param int $id
       * @return
       */
	  public function Submit($id)
	  {
		  if ($data = $this->renderForm($id)) {
			  $form = Db::run()->first(self::mTable, null, array("id" => $id));
			  $options = array();
			  foreach ($data as $rows) {
				  $options[$rows->name][] = Utility::jSonToArray($rows->options);
			  }
	
			  foreach ($options as $field => $row) {
				  if ($row[0]->required) {
					  switch ($row[0]->type) {
						  case "name":
							  $rules['fname_' . $field] = array('required|string', Lang::$word->M_FNAME);
							  $rules['lname_' . $field] = array('required|string', Lang::$word->M_LNAME);
	
							  break;
	
						  case "email":
							  $rules[$field] = array('required|email', $row[0]->label);
							  break;
	
						  case "phone":
							  $rules['phone1_' . $field] = array('required|numeric', $row[0]->label);
							  $rules['phone2_' . $field] = array('required|numeric', $row[0]->label);
							  $rules['phone3_' . $field] = array('required|numeric', $row[0]->label);
							  break;
	
						  case "address":
							  $rules['address1_' . $field] = array('required|string', Lang::$word->M_ADDRESS);
							  $rules['city_' . $field] = array('required|string', Lang::$word->M_CITY);
							  $rules['state_' . $field] = array('required|string', Lang::$word->M_STATE);
							  $rules['zip_' . $field] = array('required|string', Lang::$word->M_ZIP);
							  $rules['country_' . $field] = array('required|string', Lang::$word->M_COUNTRY);
							  break;
	
						  case "upload":
							  if (empty($_FILES[$field]['name'])) {
								  Message::$msgs[$field] = $row[0]->label;
							  } else {
								  $file[$field] = File::upload($field, App::Core()->file_size, App::Core()->file_ext);
							  }
							  break;
	
						  case "checkbox":
							  if (empty($_POST[$field])) {
								  Message::$msgs[$field] = $row[0]->label;
							  }
							  break;
	
						  default:
							  $min = (isset($row[0]->min_len) ? "|min_len," . $row[0]->min_len : null);
							  $max = (isset($row[0]->max_len) ? "|max_len," . $row[0]->max_len : null);
							  $rules[$field] = array('required|' . $row[0]->validation . $min . $max, $row[0]->label);
	
							  if (!empty($_FILES[$field]['name'])) {
								  $file[$field] = File::upload($field, App::Core()->file_size, App::Core()->file_ext);
							  }
							  break;
					  }
	
				  }
			  }
			  if($form->captcha) {
				  if (App::Session()->get('wcaptcha') != $_POST['captcha'])
					  Message::$msgs['captcha'] = Lang::$word->CAPTCHA; 
			  }
	
		  } else {
			  Message::$msgs['id'] = "Invald Form Detected";
		  }
	
		  $validate = Validator::instance();
		  $safe = $validate->doValidate($_POST, $rules);
	
		  if (empty(Message::$msgs)) {
			  $html = '<table style="width:100%;border:1px solid #ccc; border-spacing: 16px;text-align:left">';
			  foreach ($options as $field => $row) {
				  switch ($row[0]->type) {
					  case "short_text":
					  case "long_text":
					  case "email":
					  case "date":
					  case "time":
					  case "color":
					  case "range":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>' . $safe->$field . '</td>
								</tr>';
						  break;
	
					  case "dropdown":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>' . (($row[0]->multiple) ? Utility::implodeFields($_POST[$field]) : $safe->$field) . '</td>
								</tr>';
						  break;
	
					  case "radio":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>' . (empty($_POST[$field]) ? null : $_POST[$field]) . '</td>
								</tr>';
						  break;
	
					  case "checkbox":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</td>
								  <td>' . (empty($_POST[$field]) ? null : Utility::implodeFields($_POST[$field])) . '</th>
								</tr>';
						  break;
	
					  case "upload":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>';
						  if (!empty($_FILES[$field]['name'])) {
							  $fresult[$field] = File::process($file[$field], FMODPATH . self::DATAFILES, 'FILE_', false, false);
							  $html .= '<a href="' . FMODULEURL . self::DATAFILES . $fresult[$field]['fname'] . '">' . $fresult[$field]['fname'] . '</a>';
						  }
						  $html .= '
								  </td>
								</tr>';
						  break;
	
					  case "name":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>' . $safe->{'fname_' . $field} . ' ' . $safe->{'lname_' . $field} . '</td>
								</tr>';
						  break;
	
					  case "phone":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>' . $safe->{'phone1_' . $field} . '-' . $safe->{'phone2_' . $field} . '-' . $safe->{'phone3_' . $field} . '</td>
								</tr>';
						  break;
	
					  case "address":
						  $html .= '
								<tr>
								  <th>' . $row[0]->label . '</th>
								  <td>' . $safe->{'address1_' . $field} . '<br>
								  ' . $safe->{'address2_' . $field} . '<br>
								  ' . $safe->{'city_' . $field} . ', ' . $safe->{'state_' . $field} . '<br>
								  ' . $safe->{'zip_' . $field} . ', ' . $safe->{'country_' . $field} . '
								   </td>
								</tr>';
						  break;
	
					  default:
						  $html .= '';
						  break;
				  }
	
			  }
			  unset($row);
			  $html .= '</table>';
	
			  $mailer = Mailer::sendMail();
			  $tpl = Db::run()->first(Content::eTable, array("body" . Lang::$lang . " as body", "subject" . Lang::$lang . " as subject"), array('typeid' => 'visualFormAdmin'));
			  $core = App::Core();
	
			  $body = str_replace(array(
				  '[LOGO]',
				  '[DATE]',
				  '[COMPANY]',
				  '[FORMNAME]',
				  '[FORMDATA]',
				  '[FB]',
				  '[TW]',
				  '[SITEURL]'), array(
				  Utility::getLogo(),
				  date('Y'),
				  $core->company,
				  $form->{'title' . Lang::$lang},
				  $html,
				  $core->social->facebook,
				  $core->social->twitter,
				  SITEURL), $tpl->body);

			  $msg = (new Swift_Message())
					->setSubject($form->{'subject' . Lang::$lang})
					->setTo(array($form->mailto => $core->company))
					->setFrom(array($core->site_email => $core->company))
					->setBody($body, 'text/html');
	
			  if ($form->emails) {
				  $emails = explode(",", $form->emails);
				  foreach($emails as $mail) {
					  $msg->setCc($mail);
				  }
			  }
			  $mailer->send($msg);

			  $json['type'] = 'success';
			  $json['title'] = Lang::$word->SUCCESS;
			  $json['message'] = $form->{'sendmessage' . Lang::$lang};
			  print json_encode($json);
		  } else {
			  Message::msgSingleStatus();
		  }
	  }
	  
      /**
       * Forms::fieldOptions()
       * 
       * @return
       */
	  public static function fieldOptions($type)
	  {
		  $array = array(
			  "label" => "Untitled",
			  "type" => $type,
			  "dvalue" => "",
			  "validation" => "",
			  "required" => 0,
			  "tooltip" => "",
			  "inline" => 1,
			  "min_len" => "1",
			  "max_len" => "5",
			  "selected" => "",
			  "multiple" => "",
			  "filesize" => 5,
			  "special" => ($type == "phone" or $type == "name" or $type == "address") ? 1 : 0,
			  "items" => array(
					  "choice1",
					  "choice2",
					  "choice3",
				  ));
				  
          return $array;
	  }

      /**
       * Forms::fieldValidation()
       * 
       * @return
       */
	  public static function fieldValidation()
	  {
		  $array = array(
			  "" => "None",
			  "string" => "String",
			  "alpha" => "Alpha",
			  "alpha_numeric" => "Alpha Numeric",
			  "numeric" => "Numeric",
			  "integer" => "Integer",
			  "valid_url" => "Url",
			  "valid_ip" => "IP Address",
			  );
				  
          return $array;
	  }
	  
      /**
       * Forms::sizeValidation()
       * 
       * @return
       */
	  public static function sizeValidation()
	  {
		  $array = array(
			  "normal" => "Normal",
			  "small" => "Small",
			  "large" => "Large",
			  "big" => "Big",
			  "huge" => "Huge",
			  );
				  
          return $array;
	  }
  }
