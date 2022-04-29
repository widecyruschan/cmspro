<?php
  /**
   * Module Index
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: mod_index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<main>
  <!-- Module Caption & breadcrumbs-->
  <?php if(File::is_file(FMODPATH . $this->core->moddir[$this->segments[0]] . '/themes/' . $this->core->theme . '/snippets/header.tpl.php')):?>
  <?php include(FMODPATH . $this->core->moddir[$this->segments[0]] . '/themes/' . $this->core-> theme . '/snippets/header.tpl.php');?>
  <?php else:?>
  <div id="moduleCaption" class="<?php echo $this->core->moddir[$this->segments[0]];?>">
    <div class="wojo-grid">
      <div class="row gutters">
        <div class="columns screen-100 tablet-100 mobile-100 phone-100 center aligned">
          <?php if(isset($this->data->{'title' . Lang::$lang})):?>
          <h1 class="wojo white text"><?php echo $this->data->{'title' . Lang::$lang};?></h1>
          <?php endif;?>
          <?php if(isset($this->data->{'info' . Lang::$lang})):?>
          <p class="wojo white text"><?php echo $this->data->{'info' . Lang::$lang};?></p>
          <?php endif;?>
        </div>
        <?php if($this->core->showcrumbs):?>
        <div class="columns screen-100 tablet-100 mobile-100 phone-100 center aligned align self bottom">
          <div class="wojo small white breadcrumb">
            <?php echo Url::crumbs($this->crumbs ? $this->crumbs : $this->segments, "<i class=\"icon primary long arrow right\"></i>", Lang::$word->HOME);?>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
    <figure class="absolute">
      <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="126 -26 300 100" width="100%" height="100px">
        <path fill="#FFFFFF" d="M381 3c-33.3 2.7-69.3 39.8-146.6 4.7-44.6-20.3-87.5 14.2-87.5 14.2V74H426V6.8c-11-3.2-25.9-5.3-45-3.8z" opacity=".4"/>
        <path fill="#FFFFFF" d="M384.3 19.9S363.1-.4 314.4 3.7c-33.3 2.7-69.3 39.8-146.6 4.7C153.2 1.8 138.8 1 126 3v71h258.3V19.9z" opacity=".4"/>
        <path fill="#FFFFFF" d="M426 24.4c-19.8-12.8-48.5-25-77.8-15.9-35.2 10.9-64.8 27.4-146.6 4.7-28.1-7.8-54.6-3.5-75.6 3.9V74h300V24.4z"/>
      </svg>
    </figure>
  </div>
  <?php endif;?>
  <?php if ($this->layout->topWidget): ?>
  <!-- Top Widgets -->
  <div id="topwidget">
    <?php include(THEMEBASE . "/top_widget.tpl.php");?>
  </div>
  <!-- Top Widgets /-->
  <?php endif;?>
  <?php switch(true): case $this->layout->leftWidget and $this->layout->rightWidget: ?>
  <!-- Left and Right Layout -->
  <div class="wojo-grid">
    <div class="row horizontal gutters">
      <div class="columns screen-20 tablet-25 mobile-100 phone-100">
        <?php include(THEMEBASE . "/left_widget.tpl.php");?>
      </div>
      <div class="columns screen-60 tablet-50 mobile-100 phone-100">
        <?php include_once(Modules::render($this->segments[0]));?>
      </div>
      <div class="columns screen-20 tablet-25 mobile-100 phone-100">
        <?php include(THEMEBASE . "/right_widget.tpl.php");?>
      </div>
    </div>
  </div>
  <!-- Left and Right Layout /-->
  <?php break;?>
  <?php case $this->layout->leftWidget: ?>
  <!-- Left Layout -->
  <div class="wojo-grid">
    <div class="row horizontal gutters">
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <?php include(THEMEBASE . "/left_widget.tpl.php");?>
      </div>
      <div class="columns screen-70 tablet-60 mobile-100 phone-100">
        <?php include_once(Modules::render($this->segments[0]));?>
      </div>
    </div>
  </div>
  <!-- Left Layout /-->
  <?php break;?>
  <?php case $this->layout->rightWidget: ?>
  <!-- Right Layout -->
  <div class="wojo-grid">
    <div class="row horizontal gutters">
      <div class="columns screen-70 tablet-60 mobile-100 phone-100">
        <?php include_once(Modules::render($this->segments[0]));?>
      </div>
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <?php include(THEMEBASE . "/right_widget.tpl.php");?>
      </div>
    </div>
  </div>
  <!-- Right Layout /-->
  <?php break;?>
  <?php default:?>
  <!-- Full Layout -->
  <div class="wojo-grid">
    <?php include_once(Modules::render($this->segments[0]));?>
  </div>
  <!-- Full Layout /-->
  <?php break;?>
  <?php endswitch;?>
  <?php if ($this->layout->bottomWidget): ?>
  <!-- Bottom Widgets -->
  <div id="bottomwidget">
    <?php include(THEMEBASE . "/bottom_widget.tpl.php");?>
  </div>
  <!-- Bottom Widgets /-->
  <?php endif;?>
</main>
