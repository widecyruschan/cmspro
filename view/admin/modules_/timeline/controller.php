<?php
  /**
   * Timeline
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'timeline/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Timeline == */
      case "deleteTimeline":
          if($row = Db::run()->first(Timeline::mTable, array("id", "plugin_id"), array("id" => Filter::$id))) :
              $res = Db::run()->delete(Timeline::mTable, array("id" => $row->id));
			  Db::run()->delete(Timeline::dTable, array("tid" => $row->id));
			  Db::run()->delete(Plugins::mTable, array("plugalias" => $row->plugin_id));
			  Db::run()->delete(Modules::mTable, array("parent_id" => Filter::$id, "modalias" => "timeline"));
			  File::deleteDirectory(FPLUGPATH . $row->plugin_id);
		  endif;
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_TML_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
      /* == Delete Item == */
      case "deleteItem":
          $res = Db::run()->delete(Timeline::dTable, array("id" => Filter::$id));
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_TML_DELI_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Timeline == */
      case "processTimeline":
          App::Timeline()->processTimeline();
      break;
      /* == Process Item == */
      case "processItem":
          App::Timeline()->processItem();
      break;
  endswitch;