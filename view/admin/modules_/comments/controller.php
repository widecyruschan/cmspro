<?php
  /**
   * Comments
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: controller.php, v1.00 2020-02-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(AMODPATH . 'comments/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Item == */
      case "deleteComment":
          $res = Db::run()->delete(Comments::mTable, array("id" => Filter::$id));
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_CM_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
  endswitch;
  
  /* == Post Actions == */
  switch ($pAction):
      /* == Process Configuration == */
      case "processConfig":
          App::Comments()->processConfig();
      break;
  endswitch;
  
  /* == Instant Actions == */
  switch ($iAction):
      /* == Approve Comment == */
      case "approve":
          if(Db::run()->update(Comments::mTable, array("active" => 1), array("id" => Filter::$id))):
			  $json['type'] = "success";
			  print json_encode($json);
		  endif;
      break;
  endswitch;