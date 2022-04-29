<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: controller.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once ("../../../../init.php");

  Bootstrap::Autoloader(array(APLUGPATH . 'newsletter/'));

  $action = Validator::request('action');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Actions == */
  switch ($action):
      /* == Process == */
      case "processNewsletter":
          App::Newsletter()->process();
      break;
  endswitch;