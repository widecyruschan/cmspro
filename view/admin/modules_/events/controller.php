<?php
  /**
   * Events
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
	  
  Bootstrap::Autoloader(array(AMODPATH . 'events/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $iAction = Validator::post('iaction');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
      /* == Delete Event == */
      case "deleteEvent":
          $res = Db::run()->delete(Events::mTable, array("id" => Filter::$id));
		  
		  $message = str_replace("[NAME]", $title, Lang::$word->_MOD_EM_DEL_OK);
          Message::msgReply($res, 'success', $message);
		  Logger::writeLog($message);
          break;
  endswitch;

  /* == Post Actions == */
  switch ($pAction):
      /* == Process Event == */
      case "processEvent":
          App::Events()->processEvent();
      break;
      /* == Get Events == */
      case "events":
		  if(empty($_GET['year']) or empty($_GET['year'])):
			  $year = Date::doDate("yyyy", Date::today());
			  $month = Date::doDate("MM", Date::today());
		  else:
			  $year = Validator::sanitize($_GET['year'], "time");
			  $month = Validator::sanitize($_GET['month'], "time"); 
		  endif;
			  $json['events'] = App::Events()->getCalendar($year, $month);
		  print json_encode($json);
      break;
  endswitch;
  
  /* == Get Actions == */
  switch ($gAction):
      /* == Get Events == */
      case "events":
		  if(empty($_GET['year']) or empty($_GET['year'])):
			  $year = Date::doDate("yyyy", Date::today());
			  $month = Date::doDate("MM", Date::today());
		  else:
			  $year = Validator::sanitize($_GET['year'], "time");
			  $month = Validator::sanitize($_GET['month'], "time"); 
		  endif;
			  $json['events'] = App::Events()->getCalendar($year, $month);
		  print json_encode($json);
      break;
  endswitch;