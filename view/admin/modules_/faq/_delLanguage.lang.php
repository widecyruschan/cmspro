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

  Bootstrap::Autoloader(array(AMODPATH . 'faq/'));

  //mod_faq
  Db::run()->pdoQuery("
  ALTER TABLE `" . Faq::mTable . "` 
	DROP COLUMN question_$abbr,
	DROP COLUMN answer_$abbr;");

  //mod_faq_categories
  Db::run()->pdoQuery("
  ALTER TABLE `" . Faq::cTable . "` 
	DROP COLUMN name_$abbr;");