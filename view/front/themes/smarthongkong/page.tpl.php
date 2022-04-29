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
      <!-- <div class="columns screen-100 tablet-100 mobile-100 phone-100 center aligned">
        <?php if($this->data->{'caption' . Lang::$lang}):?>
        <h1><?php echo $this->data->{'caption' . Lang::$lang};?></h1>
        <?php endif;?>
      </div> -->
      <?php if($this->core->showcrumbs):?>
      <div class="columns screen-100 tablet-100 mobile-100 phone-100 center aligned align bottom">
        <div class="wojo white breadcrumb">
         <?php echo Url::crumbsfrontend($this->crumbs ? $this->crumbs : $this->segments, "<i class=\"icon long primary right arrow\"></i>", Lang::$word->HOME);?>
        </div>
      </div>
      <?php endif;?>
    </div>

  </div>
  <figure class="absolute" style="width:100%;">
      <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="126 -26 300 100" width="100%" height="100px">
        <path fill="#FFFFFF" d="M381 3c-33.3 2.7-69.3 39.8-146.6 4.7-44.6-20.3-87.5 14.2-87.5 14.2V74H426V6.8c-11-3.2-25.9-5.3-45-3.8z" opacity=".4"/>
        <path fill="#FFFFFF" d="M384.3 19.9S363.1-.4 314.4 3.7c-33.3 2.7-69.3 39.8-146.6 4.7C153.2 1.8 138.8 1 126 3v71h258.3V19.9z" opacity=".4"/>
        <path fill="#FFFFFF" d="M426 24.4c-19.8-12.8-48.5-25-77.8-15.9-35.2 10.9-64.8 27.4-146.6 4.7-28.1-7.8-54.6-3.5-75.6 3.9V74h300V24.4z"/>
      </svg>
    </figure>
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
  <script>
	<?php echo Validator::cleanOut(json_decode($this->data->jscode));?>
  </script>
  <?php endif;?>
  <?php endif;?>
  <?php if($this->data->is_comments):?>
  <?php include_once(FMODPATH . 'comments/index.tpl.php');?>
  <?php endif;?>
</main>