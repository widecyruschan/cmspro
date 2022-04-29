<?php
  /**
   * Gmaps
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-12-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'gmaps/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Map == */
      case "deleteMap":
          if($row = Db::run()->first(Gmaps::mTable, array("id", "plugin_id"), array("id" => Filter::$id))) :
              $res = Db::run()->delete(Gmaps::mTable, array("id" => $row->id));
			  if($prow = Db::run()->first(Plugins::mTable, array("id", "plugin_id"), array("plugalias" => $row->plugin_id))):
			     Db::run()->delete(Plugins::mTable, array("id" => $prow->id));
			     Db::run()->delete(Plugins::lTable, array("plug_id" => $prow->id));
			  endif;
			  File::deleteDirectory(FPLUGPATH . $row->plugin_id);
		  endif;
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_GM_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
  endswitch;

  /* == Get Actions == */
  switch ($gAction):
      /* == Load Map == */
      case "loadMap":
           $row = Db::run()->select(Gmaps::mTable, null, array("id" => Filter::$id))->result();
		   print json_encode($row);
      break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Map == */
      case "processMap":
           App::Gmaps()->processMap();
      break;
  endswitch;