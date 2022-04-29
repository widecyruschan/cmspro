<?php
  /**
   * Controller
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: controller.php, v1.00 2016-12-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../init.php");
  
  if (!App::Auth()->is_Admin())
      exit;
	  
  Bootstrap::Autoloader(array(APLUGPATH . 'newsletter/'));

  $delete = Validator::post('delete');
  $trash = Validator::post('trash');
  $gAction = Validator::get('action');
  $pAction = Validator::post('action');
  $restore = Validator::post('restore');
  $title = Validator::post('title') ? Validator::sanitize($_POST['title']) : null;

  /* == Delete == */
  switch ($delete):
  endswitch;

  /* == Post Action == */
  switch ($delete):
  endswitch;
  
  /* == Get Actions == */
  switch ($gAction):
	   /* == Export Emails == */
	  case"exportEmails":
		  header("Pragma: no-cache");
		  header('Content-Type: text/csv; charset=utf-8');
		  header('Content-Disposition: attachment; filename=Users.csv');
		  
		  $data = fopen('php://output', 'w');
		  fputcsv($data, array('Email', 'Created'));
		  
		  $result = Newsletter::exportEmails();
		  if($result):
			  foreach ($result as $row) :
				  fputcsv($data, $row);
			  endforeach;
			  fclose($data);
		  endif;
	  break;
  endswitch;
 