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
<!DOCTYPE html>
<html lang="<?php echo Core::$language;?>">
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
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<?php if((Utility::in_array_any([$this->core->modname['blog'], $this->core->modname['portfolio'], $this->core->modname['digishop'], $this->core->modname['shop']], $this->segments))):?>
<?php echo $this->meta;?>
<?php endif;?>
<link rel="apple-touch-icon" sizes="57x57" href="/assets/apple-icon-57x57.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="60x60" href="/assets/apple-icon-60x60.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="72x72" href="/assets/apple-icon-72x72.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="76x76" href="/assets/apple-icon-76x76.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="114x114" href="/assets/apple-icon-114x114.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="120x120" href="/assets/apple-icon-120x120.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="144x144" href="/assets/apple-icon-144x144.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="152x152" href="/assets/apple-icon-152x152.png?<?php echo rand()?>">
<link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-icon-180x180.png?<?php echo rand()?>">
<link rel="icon" type="image/png" sizes="192x192"  href="/assets/android-icon-192x192.png?<?php echo rand()?>">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon-32x32.png?<?php echo rand()?>">
<link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon-96x96.png?<?php echo rand()?>">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon-16x16.png?<?php echo rand()?>">
<?php if(in_array(Core::$language, array("he", "ae", "ir"))):?>
  <link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('color_rtl.css', 'base_rtl.css','transition_rtl.css', 'button_rtl.css', 'icon_rtl.css', 'flag_rtl.css', 'image_rtl.css', 'label_rtl.css', 'form_rtl.css', 'input_rtl.css', 'list_rtl.css','card_rtl.css','table_rtl.css','dropdown_rtl.css','statistic_rtl.css','datepicker_rtl.css','message_rtl.css','modal_rtl.css','progress_rtl.css','editor_rtl.css','feed_rtl.css','comment_rtl.css','tooltip_rtl.css','utility_rtl.css','bootstrap_rtl.css','style_rtl.css'), THEMEBASE);?>?ver=<?php echo time();?>" rel="stylesheet" type="text/css">
<?php else:?>
<link href="<?php echo THEMEURL . '/cache/' . Cache::cssCache(array('color.css', 'base.css','transition.css', 'button.css', 'icon.css', 'flag.css', 'image.css', 'label.css', 'form.css', 'input.css', 'list.css','card.css','table.css','dropdown.css','statistic.css','datepicker.css','message.css','modal.css','progress.css','feed.css','comment.css','tooltip.css','editor.css','utility.css','bootstrap.css','style.css'), THEMEBASE);?>?ver=<?php echo time();?>" rel="stylesheet" type="text/css">
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
<div class="wojo-grid">
    <div class="bottom-bar">
      <div class="row align middle small horizontal gutters">
        <div class="columns phone mobile order-1">
          <a href="<?php echo SITEURL;?>/" class="logo"><?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
        </div>
        <div class="columns auto screen-hide tablet-hide phone mobile order-2"> <a href="#" class="menu-mobile"><i class="icon large reorder"></i></a></div>
        <div class="columns auto mobile-100 phone-100 phone mobile order-3">
          <nav class="menu"><?php echo App::Content()->renderMenu($this->menu);?></nav>
        </div>
        <div class="columns auto phone mobile order-4">
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

           
       <?php if($this->core->showlang):?>
                    <!--Lang Switcher-->
        <?php if(count($this->core->langlist) > 1):?>
          <div class="item">
        <div class="columns auto">
          <a data-wdropdown="#dropdown-langChange" class="wojo mini demi caps white icon right text">
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
      </div>
    </div>
  </div>
</header>
