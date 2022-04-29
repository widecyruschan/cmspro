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

  Bootstrap::Autoloader(array(AMODPATH . 'forms/'));

  //mod_forms
  $sql = "
  ALTER TABLE `" . Forms::mTable . "` 
	ADD COLUMN title_$flag_id VARCHAR (100) NOT NULL AFTER title_en,
	ADD COLUMN subject_$flag_id VARCHAR (150) NOT NULL AFTER subject_en,
	ADD COLUMN sendmessage_$flag_id VARCHAR (200) NOT NULL AFTER sendmessage_en,
	ADD COLUMN sbutton_$flag_id VARCHAR(50) DEFAULT NULL AFTER sbutton_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Forms::mTable . "` SET `title_" . $flag_id . "`=`title_en`");
  Db::run()->pdoQuery("UPDATE `" . Forms::mTable . "` SET `subject_" . $flag_id . "`=`subject_en`");
  Db::run()->pdoQuery("UPDATE `" . Forms::mTable . "` SET `sendmessage_" . $flag_id . "`=`sendmessage_en`");
  Db::run()->pdoQuery("UPDATE `" . Forms::mTable . "` SET `sbutton_" . $flag_id . "`=`sbutton_en`");