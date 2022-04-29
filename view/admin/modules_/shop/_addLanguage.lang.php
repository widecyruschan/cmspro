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

  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));

  //mod_shop
  $sql = "
  ALTER TABLE `" . Shop::mTable . "` 
	ADD COLUMN title_$flag_id VARCHAR (100) NOT NULL AFTER title_en,
	ADD COLUMN slug_$flag_id VARCHAR (100) NOT NULL AFTER slug_en,
	ADD COLUMN body_$flag_id TEXT AFTER body_en,
	ADD COLUMN keywords_$flag_id VARCHAR(200) DEFAULT NULL AFTER keywords_en,
	ADD COLUMN description_$flag_id TEXT AFTER description_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Shop::mTable . "` SET `title_" . $flag_id . "`=`title_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::mTable . "` SET `slug_" . $flag_id . "`=`slug_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::mTable . "` SET `body_" . $flag_id . "`=`body_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::mTable . "` SET `keywords_" . $flag_id . "`=`keywords_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::mTable . "` SET `description_" . $flag_id . "`=`description_en`");
  
  //mod_shop_categories
  $sql = "
  ALTER TABLE `" . Shop::cTable . "` 
	ADD COLUMN name_$flag_id VARCHAR (100) NOT NULL AFTER name_en,
	ADD COLUMN slug_$flag_id VARCHAR (100) NOT NULL AFTER slug_en,
	ADD COLUMN keywords_$flag_id VARCHAR(200) DEFAULT NULL AFTER keywords_en,
	ADD COLUMN description_$flag_id TEXT AFTER description_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Shop::cTable . "` SET `name_" . $flag_id . "`=`name_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::cTable . "` SET `slug_" . $flag_id . "`=`slug_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::cTable . "` SET `keywords_" . $flag_id . "`=`keywords_en`");
  Db::run()->pdoQuery("UPDATE `" . Shop::cTable . "` SET `description_" . $flag_id . "`=`description_en`");