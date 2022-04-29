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
  
  Bootstrap::Autoloader(array(APLUGPATH . 'poll/'));
  $action = Validator::request('action');

  /* == Actions == */
  switch ($action):
      /* == Vote == */
      case "vote":
          if(Filter::$id) :
		      if(App::Poll()->updatePollResult(Filter::$id)):
				  $json['type'] = "success";
			  else:
				  $json['type'] = "error";
			  endif;
		  else:
			  $json['type'] = "error";
		  endif;
		  print json_encode($json);
      break;
  endswitch;