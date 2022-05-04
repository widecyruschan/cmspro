<?php
  /**
   * Header
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: header.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
 ?>
<!DOCTYPE html lang="<?php echo Core::$language;?>">
<head>
<meta charset="utf-8">
<title><?php echo $this->title;?></title>
<meta name="keywords" content="<?php echo $this->keywords;?>">
<meta name="description" content="<?php echo $this->description;?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="dcterms.rights" content="<?php echo $this->core->company;?> &copy; All Rights Reserved">
<meta name="robots" content="index">
<meta name="robots" content="follow">
<meta name="revisit-after" content="1 day">
<meta name="generator" content="Powered by tag.digital Limited">
<?php if((Utility::in_array_any([$this->core->modname['blog'], $this->core->modname['portfolio'], $this->core->modname['digishop'], $this->core->modname['shop']], $this->segments))):?>
<?php echo $this->meta;?>
<?php endif;?>
<link rel="shortcut icon" href="<?php echo SITEURL;?>/assets/favicon.ico" type="image/x-icon">
<?php if(in_array(Core::$language, array("he", "ae", "ir"))):?>
<link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('color_rtl.css', 'base_rtl.css','transition_rtl.css', 'button_rtl.css', 'icon_rtl.css', 'flag_rtl.css', 'image_rtl.css', 'label_rtl.css', 'form_rtl.css', 'input_rtl.css', 'list_rtl.css','card_rtl.css','table_rtl.css','dropdown_rtl.css','statistic_rtl.css','datepicker_rtl.css','message_rtl.css','modal_rtl.css','progress_rtl.css','editor_rtl.css','feed_rtl.css','comment_rtl.css','tooltip_rtl.css','utility_rtl.css','style_rtl.css'), THEMEBASE);?>" rel="stylesheet" type="text/css">
<?php else:?>
<link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('color.css', 'base.css','transition.css', 'button.css', 'icon.css', 'flag.css', 'image.css', 'label.css', 'form.css', 'input.css', 'list.css','card.css','table.css','dropdown.css','statistic.css','datepicker.css','message.css','modal.css','progress.css','feed.css','comment.css','tooltip.css','editor.css','utility.css','style.css'), THEMEBASE);?>" rel="stylesheet" type="text/css">
<?php endif;?>
<link href="<?php echo THEMEURL . '/plugins/cache/' . Cache::pluginCssCache(THEMEBASE . '/plugins');?>" rel="stylesheet" type="text/css">
<link href="<?php echo THEMEURL . '/modules/cache/' . Cache::moduleCssCache(THEMEBASE . '/modules');?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>
<script type="text/javascript" src="<?php echo THEMEURL . '/plugins/cache/' . Cache::pluginJsCache(THEMEBASE . '/plugins');?>"></script>
<script type="text/javascript" src="<?php echo THEMEURL . '/modules/cache/' . Cache::moduleJsCache(THEMEBASE . '/modules');?>"></script>
</head>
<body class="page_<?php echo Url::doSeo($this->segments[0]);?>">
<?php if($this->core->ploader):?>
<!-- Page Loader -->
<div id="master-loader">
  <div class="wanimation"></div>
  <div class="curtains left"></div>
  <div class="curtains right"></div>
</div>
<?php endif;?>
<header id="header">
  <div class="top-bar">
    <div class="wojo-grid">
      <div class="row align middle small horizontal gutters">
        <div class="columns">
          <div class="wojo small horizontal list">
            <div class="item align middle"><i class="icon primary email"></i>
              <div class="content wojo white text"><?php echo $this->core->site_email;?></div>
            </div>
            <div class="item align middle"><i class="icon primary building"></i>
              <div class="content wojo white text"><?php echo $this->core->company;?></div>
            </div>
          </div>
        </div>
        <div class="columns auto">
          <div class="wojo icons"> 
            <a class="white"><i class="icon facebook"></i></a>
            <a class="white"><i class="icon twitter"></i></a>
            <a class="white"><i class="icon instagram"></i></a>
            <a class="white"><i class="icon github"></i></a>
          </div>
        </div>
        
        <?php if(File::is_File(FMODPATH . 'digishop/index.tpl.php') or File::is_File(FMODPATH . 'shop/index.tpl.php')):?>
        <div class="columns auto">
          <div class="wojo icons"> 
            <!--digishop cart-->
            <?php if(File::is_File(FMODPATH . 'digishop/index.tpl.php')):?>
              <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $this->core->modname['digishop-checkout']);?>" class="white">
              <i class="icon basket"></i></a>
            <?php endif;?>

            <!--shop cart-->
            <?php if(File::is_File(FMODPATH . 'shop/index.tpl.php')):?>
              <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $this->core->modname['shop-checkout']);?>" class="white">
              <i class="icon bag"></i></a>
            <?php endif;?>
          </div>
        </div>
        <?php endif;?>
        
        <?php if($this->core->showlang):?>
        <!--Lang Switcher-->
        <?php if(count($this->core->langlist) > 1):?>
        <div class="columns auto">
          <a data-wdropdown="#dropdown-langChange" class="wojo demi caps white right text">
          <?php echo Core::$language;?>
          <i class="icon small chevron down"></i>
          </a>
          <div class="wojo small dropdown pointing top-right" id="dropdown-langChange">
            <?php foreach($this->core->langlist as $lang):?>
            <a data-value="<?php echo $lang->abbr;?>" class="item<?php echo (Core::$language == $lang->abbr) ? ' active' : null;?>">
            <?php echo $lang->name;?></a>
            <?php endforeach;?>
          </div>
          </div>
        <?php endif;?>
        
        <!--Lang Switcher End-->
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="wojo-grid">
    <div class="bottom-bar">
      <div class="row align middle small horizontal gutters">
        <div class="columns phone mobile order-1">
          <a href="<?php echo SITEURL;?>/" class="logo"><?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
        </div>
        <div class="columns auto screen-hide tablet-hide phone mobile order-3"> <a href="#" class="menu-mobile"><i class="icon large reorder"></i></a></div>
        <div class="columns auto mobile-100 phone-100 phone mobile order-4">
          <nav class="menu"><?php echo App::Content()->renderMenu($this->menu);?></nav>
        </div>
        <div class="columns auto phone mobile order-2">
          <div class="wojo horizontal list" id="iconList">
            <?php if($this->core->showsearch):?>
            <div class="item">
              <a href="<?php echo Url::url("/" . $this->core->system_slugs->search[0]->{'slug' . Lang::$lang});?>"><i class="icon find"></i></a>
            </div>
            <?php endif;?>
            
            <!--Show Login-->
            <?php if($this->core->showlogin):?>
            <div class="item">
              <?php if(App::Auth()->is_User()):?>
              <a href="<?php echo Url::url("/" . $this->core->system_slugs->account[0]->{'slug' . Lang::$lang});?>" class="phone-hide">
              <?php echo Lang::$word->HI;?>
              <?php echo App::Auth()->name;?>! </a>
              <a href="<?php echo Url::url("/" . $this->core->system_slugs->account[0]->{'slug' . Lang::$lang});?>" class="screen-hide tablet-hide mobile-hide phone-show">
              <i class="icon user"></i></a>
              <?php else:?>
              <a href="<?php echo Url::url("/" . $this->core->system_slugs->login[0]->{'slug' . Lang::$lang});?>"><i class="icon user"></i></a>
              <?php endif;?>
            </div>
            <?php endif;?>
            <!--Show Login End-->
            
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
