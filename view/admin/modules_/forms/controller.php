<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'forms/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Gallery == */
      case "deleteForm":
		  $res = Db::run()->delete(Forms::mTable, array("id" => Filter::$id));
		  Db::run()->delete(Modules::mTable, array("parent_id" => Filter::$id, "modalias" => "forms"));
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_VF_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
  endswitch;

  /* == Get Actions == */
  switch ($gAction):
      /* == Load Form == */
      case "loadForm":
		  $tpl = App::View(AMODPATH . 'forms/snippets/'); 
		  $tpl->template = 'renderFileds.tpl.php';
		  $tpl->data = App::Forms()->renderForm(Filter::$id);
		  $json['type'] = "success";
		  $json['html'] = $tpl->render();
          print json_encode($json);
      break;

      /* == Import Select == */
      case "importSelect":
		  $tpl = App::View(AMODPATH . 'forms/snippets/'); 
		  $tpl->template = 'importSelect.tpl.php'; 
		  $tpl->items = trim($_GET['items']);
          print $tpl->render();
      break;
	  
      /* == Edit Field == */
      case "editField":
	      $type = Validator::sanitize($_GET['name'], "db");
		  $tpl = App::View(AMODPATH . 'forms/snippets/'); 
		  $tpl->template = 'editField.tpl.php'; 
		  $tpl->data = Db::run()->first(Forms::fTable, null, array("name" => $type));
		  $json['type'] = "success";
		  $json['html'] = $tpl->render();
          print json_encode($json);
      break;
	  
      /* == Add Field == */
      case "addField":
	      $type = Validator::sanitize($_GET['name'], "db");
		  $tpl = App::View(AMODPATH . 'forms/snippets/'); 
		  $tpl->template = 'addField.tpl.php'; 
		  $tpl->id = Utility::randomString(12);
		  $tpl->labeltype = intval($_GET['labeltype']);
		  
		  Db::run()->insert(Forms::fTable, array("form_id" => Filter::$id, "sorting" => 5000, "name" => $tpl->id, "options" => json_encode(Forms::fieldOptions($type))));
		  $tpl->data = Db::run()->first(Forms::fTable, null, array("id" => Db::run()->getLastInsertId()));
		  $json['type'] = "success";
		  $json['html'] = $tpl->render();
          print json_encode($json);
      break;
  endswitch;

  /* == Instant Actions == */
  switch ($iAction):
      /* == Sort Fields == */
      case "sortItems":
		  $i = 0;
		  $query = "UPDATE `" . Forms::fTable . "` SET `sorting` = CASE ";
		  $idlist = '';
		  foreach ($_POST['sorting'] as $item):
			  $i++;
			  $query .= " WHEN id = " . $item . " THEN " . $i . " ";
			  $idlist .= $item . ',';
		  endforeach;
		  $idlist = substr($idlist, 0, -1);
		  $query .= "
				  END
				  WHERE id IN (" . $idlist . ")";
		  Db::run()->pdoQuery($query);
      break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Form == */
      case "processForm":
          App::Forms()->processForm();
      break;

      /* == Delete Field == */
      case "deleteField":
          Db::run()->delete(Forms::fTable, array("name" => Validator::sanitize($_POST['name'], "db")));
          break;
		  
      /* == Save Field == */
      case "saveField":
		  App::Forms()->saveField();
      break;
  endswitch;