<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: header.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="moduleCaption" class="<?php echo $this->core->moddir[$this->segments[0]];?>">
  <div class="wrapper">
    <div class="wojo-grid">
      <div class="row gutters">
        <div class="columns screen-100 tablet-100 mobile-100 phone-100 phone-content-center">
          <?php if(isset($this->data->{'title' . Lang::$lang})):?>
          <h1 class="wojo white huge text"><?php echo $this->data->{'title' . Lang::$lang};?></h1>
          <?php endif;?>
          <?php if(isset($this->data->{'info' . Lang::$lang})):?>
          <p class="wojo medium dimmed thin white text"><?php echo $this->data->{'info' . Lang::$lang};?></p>
          <?php endif;?>
        </div>
        <?php if($this->core->showcrumbs):?>
        <div class="columns screen-100 tablet-100 mobile-100 phone-100 content-right  phone-content-left align-self-bottom">
          <div class="wojo small white breadcrumb">
            <?php echo Url::crumbs($this->crumbs ? $this->crumbs : $this->segments, "/", Lang::$word->HOME);?>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>
  <figure class="absolute" style="right: 0;bottom: 0;left: 0;">
    <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" width="100%" height="140px" viewBox="20 -20 300 100"  xml:space="preserve">
      <path d="M30.913 43.944s42.911-34.464 87.51-14.191c77.31 35.14 113.304-1.952 146.638-4.729 48.654-4.056 69.94 16.218 69.94 16.218v54.396H30.913V43.944z" class="wojo white fill" opacity=".4"/>
      <path d="M-35.667 44.628s42.91-34.463 87.51-14.191c77.31 35.141 113.304-1.952 146.639-4.729 48.653-4.055 69.939 16.218 69.939 16.218v54.396H-35.667V44.628z" class="wojo white fill" opacity=".4"/>
      <path d="M-34.667 62.998s56-45.667 120.316-27.839C167.484 57.842 197 41.332 232.286 30.428c53.07-16.399 104.047 36.903 104.047 36.903l1.333 36.667-372-2.954-.333-38.046z" class="wojo white fill"/>
    </svg>
  </figure>
</div>