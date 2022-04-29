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

  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));

  //mod_blog
  $sql = "
  ALTER TABLE `" . Blog::mTable . "` 
	ADD COLUMN title_$flag_id VARCHAR (100) NOT NULL AFTER title_en,
	ADD COLUMN slug_$flag_id VARCHAR (100) NOT NULL AFTER slug_en,
	ADD COLUMN tags_$flag_id VARCHAR (150) DEFAULT NULL AFTER tags_en,
	ADD COLUMN body_$flag_id TEXT AFTER body_en,
	ADD COLUMN keywords_$flag_id VARCHAR(200) DEFAULT NULL AFTER keywords_en,
	ADD COLUMN description_$flag_id TEXT AFTER description_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Blog::mTable . "` SET `title_" . $flag_id . "`=`title_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::mTable . "` SET `slug_" . $flag_id . "`=`slug_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::mTable . "` SET `tags_" . $flag_id . "`=`tags_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::mTable . "` SET `body_" . $flag_id . "`=`body_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::mTable . "` SET `keywords_" . $flag_id . "`=`keywords_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::mTable . "` SET `description_" . $flag_id . "`=`description_en`");
  
  //mod_blog_categories
  $sql = "
  ALTER TABLE `" . Blog::cTable . "` 
	ADD COLUMN name_$flag_id VARCHAR (100) NOT NULL AFTER name_en,
	ADD COLUMN slug_$flag_id VARCHAR (100) NOT NULL AFTER slug_en,
	ADD COLUMN keywords_$flag_id VARCHAR(200) DEFAULT NULL AFTER keywords_en,
	ADD COLUMN description_$flag_id TEXT AFTER description_en;";
  Db::run()->pdoQuery($sql);

  Db::run()->pdoQuery("UPDATE `" . Blog::cTable . "` SET `name_" . $flag_id . "`=`name_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::cTable . "` SET `slug_" . $flag_id . "`=`slug_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::cTable . "` SET `keywords_" . $flag_id . "`=`keywords_en`");
  Db::run()->pdoQuery("UPDATE `" . Blog::cTable . "` SET `description_" . $flag_id . "`=`description_en`");

  //mod_blog_tags
  $sql = "
  ALTER TABLE `" . Blog::tTable . "` 
	ADD COLUMN tagname_$flag_id VARCHAR (60) NOT NULL AFTER tagname_en;";
  Db::run()->pdoQuery($sql);
  
  Db::run()->pdoQuery("UPDATE `" . Blog::tTable . "` SET `tagname_" . $flag_id . "`=`tagname_en`");