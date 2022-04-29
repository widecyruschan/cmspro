<?php
  /**
   * Add Language
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _delLanguage.lang.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  Bootstrap::Autoloader(array(AMODPATH . 'forms/'));

  //mod_forms
  Db::run()->pdoQuery("
  ALTER TABLE `" . Forms::mTable . "` 
	DROP COLUMN title_$abbr,
	DROP COLUMN subject_$abbr,
	DROP COLUMN sendmessage_$abbr,
	DROP COLUMN sbutton_$abbr;");