<?php
  /**
   * Header
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: header.tpl.php, v1.00 2018-10-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title><?php echo $this->title;?></title>
<meta name="keywords" content="<?php echo $this->keywords;?>">
<meta name="description" content="<?php echo $this->description;?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="dcterms.rights" content="<?php echo App::Core()->company;?> &copy; All Rights Reserved">
<meta name="robots" content="index">
<meta name="robots" content="follow">
<meta name="revisit-after" content="1 day">
<meta name="generator" content="Powered by tag.digital Limited">
<link rel="shortcut icon" href="<?php echo SITEURL;?>/assets/favicon.ico" type="image/x-icon">
<?php if(in_array(Core::$language, array("ar", "he"))):?>
<link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('color.css','base_rtl.css','transition_rtl.css', 'button_rtl.css', 'divider_rtl.css', 'icon_rtl.css', 'flag_rtl.css', 'image_rtl.css', 'label_rtl.css', 'form_rtl.css', 'input_rtl.css', 'list_rtl.css','card_rtl.css','table_rtl.css','dropdown_rtl.css','statistic_rtl.css','datepicker_rtl.css','message_rtl.css','modal_rtl.css','progress_rtl.css','feed_rtl.css','comment_rtl.css','utility_rtl.css','style_rtl.css'), THEMEBASE);?>" rel="stylesheet" type="text/css">
<?php else:?>
<link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('color.css','base.css','transition.css', 'button.css', 'icon.css', 'flag.css', 'image.css', 'label.css', 'form.css', 'input.css', 'list.css','card.css','table.css','dropdown.css','statistic.css','datepicker.css','message.css','modal.css','progress.css','feed.css','comment.css','utility.css','style.css'), THEMEBASE);?>" rel="stylesheet" type="text/css">
<?php endif;?>
<link href="<?php echo THEMEURL . '/plugins/cache/' . Cache::pluginCssCache(THEMEBASE . '/plugins');?>" rel="stylesheet" type="text/css">
<link href="<?php echo THEMEURL . '/modules/cache/' . Cache::moduleCssCache(THEMEBASE . '/modules');?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>
<script type="text/javascript" src="<?php echo THEMEURL . '/plugins/cache/' . Cache::pluginJsCache(THEMEBASE . '/plugins');?>"></script>
<script type="text/javascript" src="<?php echo THEMEURL . '/modules/cache/' . Cache::moduleJsCache(THEMEBASE . '/modules');?>"></script>
</head>
<body id="fullpage" class="<?php echo $this->pageclass;?>">