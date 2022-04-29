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

  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));

  //mod_shop
  Db::run()->pdoQuery("
  ALTER TABLE `" . Shop::mTable . "` 
	DROP COLUMN title_$abbr,
	DROP COLUMN slug_$abbr,
	DROP COLUMN body_$abbr,
	DROP COLUMN keywords_$abbr,
	DROP COLUMN description_$abbr;");

  //mod_shop_categories
  Db::run()->pdoQuery("
  ALTER TABLE `" . Shop::cTable . "` 
	DROP COLUMN name_$abbr,
	DROP COLUMN slug_$abbr,
	DROP COLUMN keywords_$abbr,
	DROP COLUMN description_$abbr;");