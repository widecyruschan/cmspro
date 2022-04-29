<?php
  /**
   * Page
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: page.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data->show_header):?>
<!-- Page Caption & breadcrumbs-->
<div id="pageCaption"<?php echo Content::pageHeading();?>>
  <div class="wojo-grid">
    <div class="row gutters">
      <div class="columns screen-100 tablet-100 mobile-100 phone-100 phone-content-center">
        <?php if($this->data->{'caption' . Lang::$lang}):?>
        <h1><?php echo $this->data->{'caption' . Lang::$lang};?></h1>
        <?php endif;?>
      </div>
      <?php if($this->core->showcrumbs):?>
      <div class="columns screen-100 tablet-100 mobile-100 phone-100 right aligned align bottom">
        <div class="wojo small white breadcrumb">
          <?php echo Url::crumbs($this->crumbs ? $this->crumbs : $this->segments, "/", Lang::$word->HOME);?>
        </div>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>
<?php endif;?>

<!-- Page Content-->
<main<?php echo Content::pageBg();?>>
  <!-- Validate page access-->
  <?php if(Content::validatePage()):?>
  <!-- Run page-->
  <?php echo Content::parseContentData($this->data->{'body' . Lang::$lang});?>
  
  <!-- Parse javascript -->
  <?php if ($this->data->jscode):?>
  <?php echo Validator::cleanOut(json_decode($this->data->jscode));?>
  <?php endif;?>
  <?php endif;?>
  <?php if($this->data->is_comments):?>
  <?php include_once(FMODPATH . 'comments/index.tpl.php');?>
  <?php endif;?>
</main>