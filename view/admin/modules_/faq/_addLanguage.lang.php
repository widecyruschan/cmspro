<?php
  /**
   * Add Language
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _addLanguage.lang.php, v1.00 2020-04-20 18:20:24 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  Bootstrap::Autoloader(array(AMODPATH . 'faq/'));

  //mod_faq
  $sql = "
  ALTER TABLE `" . Faq::mTable . "` 
	ADD COLUMN question_$flag_id VARCHAR (100) NOT NULL AFTER question_en,
	ADD COLUMN answer_$flag_id TEXT AFTER answer_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Faq::mTable . "` SET `question_" . $flag_id . "`=`question_en`");
  Db::run()->pdoQuery("UPDATE `" . Faq::mTable . "` SET `answer_" . $flag_id . "`=`answer_en`");

  //mod_faq_categories
  $sql = "
  ALTER TABLE `" . Faq::cTable . "` 
	ADD COLUMN name_$flag_id VARCHAR (50) NOT NULL AFTER name_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Faq::cTable . "` SET `name_" . $flag_id . "`=`name_en`");