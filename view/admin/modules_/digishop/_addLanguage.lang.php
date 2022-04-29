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

  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));

  //mod_digishop
  $sql = "
  ALTER TABLE `" . Digishop::mTable . "` 
	ADD COLUMN title_$flag_id VARCHAR (100) NOT NULL AFTER title_en,
	ADD COLUMN slug_$flag_id VARCHAR (100) NOT NULL AFTER slug_en,
	ADD COLUMN body_$flag_id TEXT AFTER body_en,
	ADD COLUMN keywords_$flag_id VARCHAR(200) DEFAULT NULL AFTER keywords_en,
	ADD COLUMN description_$flag_id TEXT AFTER description_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Digishop::mTable . "` SET `title_" . $flag_id . "`=`title_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::mTable . "` SET `slug_" . $flag_id . "`=`slug_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::mTable . "` SET `body_" . $flag_id . "`=`body_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::mTable . "` SET `keywords_" . $flag_id . "`=`keywords_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::mTable . "` SET `description_" . $flag_id . "`=`description_en`");

  //mod_digishop_categories
  $sql = "
  ALTER TABLE `" . Digishop::cTable . "` 
	ADD COLUMN name_$flag_id VARCHAR (100) NOT NULL AFTER name_en,
	ADD COLUMN slug_$flag_id VARCHAR (100) NOT NULL AFTER slug_en,
	ADD COLUMN keywords_$flag_id VARCHAR(200) DEFAULT NULL AFTER keywords_en,
	ADD COLUMN description_$flag_id TEXT AFTER description_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Digishop::cTable . "` SET `name_" . $flag_id . "`=`name_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::cTable . "` SET `slug_" . $flag_id . "`=`slug_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::cTable . "` SET `keywords_" . $flag_id . "`=`keywords_en`");
  Db::run()->pdoQuery("UPDATE `" . Digishop::cTable . "` SET `description_" . $flag_id . "`=`description_en`");