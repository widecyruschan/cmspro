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

  if (!App::Auth()->is_Admin()) {
	  Url::redirect(SITEURL . '/admin/login/'); 
	  exit; 
  }
 ?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title><?php echo $this->title;?></title>
<?php if(in_array(Core::$language, array("he", "ae", "ir"))):?>
<link href="<?php echo ADMINVIEW . '/cache/' . Cache::cssCache(array('base_rtl.css','transition_rtl.css','label_rtl.css','form_rtl.css','dropdown_rtl.css','input_rtl.css','button_rtl.css','message_rtl.css','image_rtl.css','list_rtl.css','table_rtl.css','icon_rtl.css','card_rtl.css','modal_rtl.css','editor_rtl.css','tooltip_rtl.css','menu_rtl.css','progress_rtl.css','utility_rtl.css','style_rtl.css'), ADMINBASE);?>?ver=<?php echo time();?>" rel="stylesheet" type="text/css" />
<?php else:?>
<link href="<?php echo ADMINVIEW . '/cache/' . Cache::cssCache(array('base.css','transition.css','label.css','form.css','dropdown.css','input.css','button.css','message.css','image.css','list.css','table.css','icon.css','flags.css','card.css','modal.css','editor.css','tooltip.css','menu.css','progress.css','utility.css','bootstrap.css','style.css'), ADMINBASE);?>?ver=<?php echo time();?>" rel="stylesheet" type="text/css" />
<?php endif;?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/global.js"></script>
</head>
<body data-theme="<?php echo Session::cookieExists("CMSA_THEME", "dark") ? "dark" : "light";?>">
<?php if($this->core->ploader):?>
<div id="master-loader">
  <div class="wanimation"></div>
  <div class="curtains left"></div>
  <div class="curtains right"></div>
</div>
<?php endif;?>
<header>
  <div class="wojo-grid">
    <div class="row horizontal small gutters align middle">
      <div class="columns">
        <a href="<?php echo Url::url("/admin");?>" class="logo">
        <?php echo (App::Core()->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="' . $this->core->company . '">': $this->core->company;?>
        </a>
      </div>
      <div class="columns auto">
        <div class="wojo buttons" data-wdropdown="#dropdown-uMenu" id="uName">
          <div class="wojo transparent button"><?php echo App::Auth()->name;?></div>
          <div class="wojo primary inverted icon button"><?php echo Utility::getInitials(App::Auth()->name);?></div>
        </div>
        <div class="wojo small dropdown top-left" id="dropdown-uMenu">
          <div class="wojo small circular center image">
            <img src="<?php echo UPLOADURL;?>/avatars/<?php echo (App::Auth()->avatar) ? App::Auth()->avatar : "blank.svg";?>" alt="">
          </div>
          <h5 class="wojo small dimmed text center aligned"><?php echo App::Auth()->name;?></h5>
          <a class="item" href="<?php echo Url::url("/admin/myaccount");?>"><i class="icon user"></i>
          <?php echo Lang::$word->M_MYACCOUNT;?></a>
          <a class="item" href="<?php echo Url::url("/admin/mypassword");?>"><i class="icon lock"></i>
          <?php echo Lang::$word->M_SUB2;?></a>
          <a class="item" href="http://ckb.wojoscripts.com" target="_blank"><i class="icon help"></i>
          <?php echo Lang::$word->HELP;?></a>
          <a class="atheme-switch item" data-mode="<?php echo Session::cookieExists("CMSA_THEME", "dark") ? "dark" : "light";?>"><i class="icon contrast"></i><span><?php echo Session::cookieExists("CMSA_THEME", "dark") ? "Light" : "Dark";?></span></a>
          <div class="divider"></div>
          <a class="item" href="<?php echo Url::url("/admin/logout");?>"><i class="icon power"></i>
          <?php echo Lang::$word->LOGOUT;?></a>
        </div>
      </div>
      <?php if (Auth::checkAcl("owner")):?>
      <div class="columns auto">
        <a data-wdropdown="#dropdown-aMenu" class="wojo transparent icon button">
        <i class="icon horizontal ellipsis"></i>
        </a>
        <div class="wojo small dropdown menu top-<?php echo (in_array(Core::$language, array("he", "ae", "ir"))) ? 'left' : 'right';?>" id="dropdown-aMenu">
          <a class="item" href="<?php echo Url::url("/admin/permissions");?>"><i class="icon lock"></i>
          <span class="padding-left"><?php echo Lang::$word->ADM_PERMS;?></span></a>
          <a class="item" href="<?php echo Url::url("/admin/transactions");?>"><i class="icon wallet"></i>
          <span class="padding-left"><?php echo Lang::$word->ADM_TRANS;?></span></a>
          <a class="item" href="<?php echo Url::url("/admin/utilities");?>"><i class="icon sliders vertical alt"></i>
          <span class="padding-left"><?php echo Lang::$word->ADM_UTIL;?></span></a>
          <a class="item" href="<?php echo Url::url("/admin/system");?>"><i class="icon laptop"></i>
          <span class="padding-left"><?php echo Lang::$word->SYS_TITLE;?></span></a>
          <a class="item" href="<?php echo Url::url("/admin/gateways");?>"><i class="icon credit card"></i>
          <span class="padding-left"><?php echo Lang::$word->ADM_GATE;?></span></a>
          <a class="item" href="<?php echo Url::url("/admin/trash");?>"><i class="icon trash"></i>
          <span class="padding-left"><?php echo Lang::$word->ADM_TRASH;?></span></a>
        </div>
      </div>
      <?php endif;?>
      <div class="columns auto hide-all" id="mobileToggle">
        <a class="wojo transparent icon button menu-mobile"><i class="icon white reorder"></i></a>
      </div>
    </div>
  </div>
</header>
<div class="navbar">
  <div class="wojo-grid">
    <nav class="wojo menu">
      <ul>
        <li<?php if (Utility::in_array_any(["templates","menus","pages","languages","fields","coupons"], $this->segments)) echo ' class="active"';?>>
          <a href="#">
          <img src="<?php echo ADMINVIEW;?>/images/content.svg">
          <span><?php echo Lang::$word->ADM_CONTENT;?></span>
          <i class="icon chevron down"></i>
          </a>
          <ul>
            <?php if (Auth::hasPrivileges('manage_menus')):?>
            <li>
              <a<?php if (in_array("menus", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/menus");?>"><span><?php echo Lang::$word->ADM_MENUS;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_pages')):?>
            <li>
              <a<?php if (in_array("pages", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/pages");?>"><span><?php echo Lang::$word->ADM_PAGES;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_coupons')):?>
            <li>
              <a<?php if (in_array("coupons", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/coupons");?>"><span><?php echo Lang::$word->ADM_COUPONS;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_languages')):?>
            <li>
              <a<?php if (in_array("languages", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/languages");?>"><span><?php echo Lang::$word->ADM_LNGMNG;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_fields')):?>
            <li>
              <a<?php if (in_array("fields", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/fields");?>"><span><?php echo Lang::$word->ADM_CFIELDS;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_email')):?>
            <li>
              <a<?php if (in_array("templates", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/templates");?>"><span><?php echo Lang::$word->ADM_EMTPL;?></span></a>
            </li>
            <?php endif;?>
          </ul>
        </li>
        <?php if (Auth::hasPrivileges('manage_users')):?>
        <li<?php if (in_array("users", $this->segments)) echo ' class="active"';?>>
          <a href="<?php echo Url::Url("/admin/users");?>"><img src="<?php echo ADMINVIEW;?>/images/users.svg"><span><?php echo Lang::$word->ADM_USERS;?></span></a>
        </li>
        <?php endif;?>
        <?php if (Auth::hasPrivileges('manage_layout')):?>
        <li<?php if (in_array("layout", $this->segments)) echo ' class="active"';?>>
          <a href="<?php echo Url::Url("/admin/layout");?>"><img src="<?php echo ADMINVIEW;?>/images/layout.svg"><span><?php echo Lang::$word->ADM_LAYOUT;?></span></a>
        </li>
        <?php endif;?>
        <?php if (Auth::hasPrivileges('manage_memberships')):?>
        <li<?php if (in_array("memberships", $this->segments)) echo ' class="active"';?>>
          <a href="<?php echo Url::Url("/admin/memberships");?>"><img src="<?php echo ADMINVIEW;?>/images/memberships.svg"><span><?php echo Lang::$word->ADM_MEMBS;?></span></a>
        </li>
        <?php endif;?>
        <li<?php if (in_array("modules", $this->segments)) echo ' class="active"';?>>
          <a href="<?php echo Url::Url("/admin/modules");?>"><img src="<?php echo ADMINVIEW;?>/images/modules.svg"><span><?php echo Lang::$word->MODULES;?></span></a>
        </li>
        <li<?php if (in_array("plugins", $this->segments)) echo ' class="active"';?>>
          <a href="<?php echo Url::Url("/admin/plugins");?>"><img src="<?php echo ADMINVIEW;?>/images/plugins.svg"><span><?php echo Lang::$word->PLUGINS;?></span></a>
        </li>
        <li<?php if (Utility::in_array_any(["backup", "manager", "mailer", "countries", "configuration"], $this->segments)) echo ' class="active"';?>>
          <a href="#">
          <img src="<?php echo ADMINVIEW;?>/images/settings.svg">
          <span><?php echo Lang::$word->ADM_CONFIG;?></span>
          <i class="icon chevron down"></i>
          </a>
          <ul>
            <?php if (Auth::checkAcl("owner")):?>
            <li>
              <a<?php if (in_array("configuration", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/configuration");?>"><span><?php echo Lang::$word->ADM_SYSTEM;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_backup')):?>
            <li>
              <a<?php if (in_array("backup", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/backup");?>"><span><?php echo Lang::$word->ADM_BACKUP;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_files')):?>
            <li>
              <a<?php if (in_array("manager", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/manager");?>"><span><?php echo Lang::$word->ADM_FM;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_newsletter')):?>
            <li>
              <a<?php if (in_array("mailer", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/mailer");?>"><span><?php echo Lang::$word->ADM_NEWSL;?></span></a>
            </li>
            <?php endif;?>
            <?php if (Auth::hasPrivileges('manage_countries')):?>
            <li>
              <a<?php if (in_array("countries", $this->segments)) echo ' class="active"';?> href="<?php echo Url::Url("/admin/countries");?>"><span><?php echo Lang::$word->ADM_CNTR;?></span></a>
            </li>
            <?php endif;?>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<div class="colorbar">
  <?php for ($i = 1; $i <= 7; $i++):?>
  <div></div>
  <?php endfor;?>
</div>
<main>
<div class="wojo-grid">
<div class="wojo small breadcrumb">
  <?php echo Url::crumbs($this->crumbs ? $this->crumbs : $this->segments, "//", Lang::$word->HOME);?>
</div>