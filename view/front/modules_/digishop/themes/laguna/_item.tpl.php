<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _item.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="underlined"><?php echo $this->row->{'title' . Lang::$lang};?></h2>
<div id="digishop" action="<?php echo FMODULEURL;?>">
  <div class="row gutters">
    <div class="columns screen-50 tablet-100 mobile-100 phone-100">
      <?php if($this->images):?>
      <div class="wojo carousel" data-wcarousel='{"items":1,"nav":false,"dots":true}'>
        <a href="<?php echo FMODULEURL . Digishop::DIGIDATA . $this->row->id. '/' . $this->row->thumb;?>" data-gallery="digishop" class="wojo rounded image lightbox"><img src="<?php echo Digishop::hasThumb($this->row->thumb, $this->row->id);?>" alt=""></a>
        <?php foreach($this->images as $img):?>
        <a href="<?php echo FMODULEURL . Digishop::DIGIDATA . $this->row->id. '/' . $img->name;?>" data-gallery="digishop" class="wojo rounded image lightbox"><img src="<?php echo Digishop::hasThumb($img->name, $this->row->id);?>" alt="" class="wojo image"></a>
        <?php endforeach;?>
      </div>
      <?php else:?>
      <div class="wojo rounded image">
        <a href="<?php echo FMODULEURL . Digishop::DIGIDATA . $this->row->id. '/' . $this->row->thumb;?>" class="lightbox">
        <img src="<?php echo Digishop::hasThumb($this->row->thumb, $this->row->id);?>" alt="<?php echo $this->row->{'title' . Lang::$lang};?>">
        </a>
      </div>
      <?php endif;?>
    </div>
    <div class="columns screen-50 tablet-100 mobile-100 phone-100">
      <p class="wojo big demi text"><?php echo Utility::formatMoney($this->row->price);?></p>
      <div class="wojo fluid list margin bottom">
        <div class="item">
          <div class="content auto"><span class="wojo semi text"><?php echo Lang::$word->MEM_SUB3;?>:</span></div>
          <div class="content description"><?php echo $this->row->memberships ? $this->row->memberships : '-/-';?></div>
        </div>
        <?php echo $this->custom_fields;?>
        <div class="item">
          <div class="content auto"><span class="wojo semi text"><?php echo Lang::$word->LIKES;?>:</span></div>
          <div class="content description">
            <?php if($this->conf->like):?>
            <a data-digishop-like="<?php echo $this->row->id;?>" data-digishop-total="<?php echo $this->row->likes;?>" class="digishopLike"><i class="icon thumbs up"></i></a>
            <?php endif;?>
            <span class="likeTotal"><?php echo $this->row->likes;?></span></div>
        </div>
      </div>
      <?php include(FMODPATH . 'digishop/themes/laguna/snippets/_singleButton.tpl.php');?>
    </div>
  </div>
</div>
<?php echo Url::out_url($this->row->{'body' . Lang::$lang});?>
<div class="wojo divider"></div>
<?php if($this->conf->comments):?>
<?php include_once(FMODPATH . 'comments/index.tpl.php');?>
<?php endif;?>