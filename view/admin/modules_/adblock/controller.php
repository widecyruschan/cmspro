<?php
  /**
   * Adblock
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'adblock/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Campaign == */
      case "deleteCampaign":
          if($row = Db::run()->first(Adblock::mTable, array("id", "plugin_id"), array("id" => Filter::$id))) :
              $res = Db::run()->delete(Adblock::mTable, array("id" => $row->id));
			  if($prow = Db::run()->first(Plugins::mTable, array("id", "plugin_id"), array("plugalias" => $row->plugin_id))):
			     Db::run()->delete(Plugins::mTable, array("id" => $prow->id));
			     Db::run()->delete(Plugins::lTable, array("plug_id" => $prow->id));
			  endif;
			  File::deleteDirectory(FPLUGPATH . $row->plugin_id);
		  endif;
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_AB_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Campaign == */
      case "processCampaign":
          App::Adblock()->processCampaign();
      break;
  endswitch;