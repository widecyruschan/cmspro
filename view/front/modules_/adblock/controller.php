<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: controller.php, v1.00 2016-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  Bootstrap::Autoloader(array(AMODPATH . 'adblock/'));
  $action = Validator::request('action');

  /* == Actions == */
  switch ($action):
      /* == Capture Click == */
      case "click":
          if(Filter::$id) :
			  Db::run()->pdoQuery("
				  UPDATE `" . AdBlock::mTable . "` 
				  SET total_clicks = total_clicks + 1
				  WHERE id = " . Filter::$id . "
			  ");
		  endif;
      break;
  endswitch;