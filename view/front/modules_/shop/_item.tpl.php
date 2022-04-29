<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _item.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="shop" action="<?php echo FMODULEURL;?>">
  <div class="row double gutters">
    <div class="columns screen-60 screen-60 mobile-100 phone-100">
      <div class="wojo light bg top attached segment center aligned">
        <?php if($this->images):?>
        <div class="wojo inside carousel" data-wcarousel='{"items":1,"nav":false,"dots":true}'>
          <a href="<?php echo FMODULEURL . Shop::SHOPDATA . $this->row->id. '/' . $this->row->thumb;?>" data-gallery="shop" class="lightbox"><img src="<?php echo Shop::hasThumb($this->row->thumb, $this->row->id);?>" alt=""></a>
          <?php foreach($this->images as $img):?>
          <a href="<?php echo FMODULEURL . Shop::SHOPDATA . $this->row->id. '/' . $img->name;?>" data-gallery="shop" class="lightbox"><img src="<?php echo Shop::hasThumb($img->name, $this->row->id);?>" alt="" class="wojo basic image"></a>
          <?php endforeach;?>
        </div>
        <?php else:?>
        <a href="<?php echo FMODULEURL . Shop::SHOPDATA . $this->row->id. '/' . $this->row->thumb;?>" class="lightbox">
        <img src="<?php echo Shop::hasThumb($this->row->thumb, $this->row->id);?>" alt="<?php echo $this->row->title;?>" class="wojo basic inline image"></a>
        <?php endif;?>
      </div>
    </div>
    <div class="columns screen-40 screen-40 mobile-100 phone-100">
      <div class="wojo stars bottom margin">
        <?php for ($x = 1; $x <= $this->row->stars; $x++):?>
        <span class="star active"><i class="icon small star full"></i></span>
        <?php endfor;?>
        <?php while ($x <= 5):?>
        <span class="star"><i class="icon small star"></i></span>
        <?php $x++;?>
        <?php endwhile;?>
        <small><?php echo $this->row->ratings;?></small>
        <a data-scroll="true" href="#comments" data-offset="10"><small><?php echo str_replace("[X]", $this->row->comments, Lang::$word->_MOD_SP_SUB18);?></small></a>
      </div>
      <h2><?php echo $this->row->{'title' . Lang::$lang};?></h2>
      <p><?php echo Validator::sanitize(Url::out_url($this->row->{'body' . Lang::$lang}), "default", 100);?>...</p>
      <div class="wojo secondary small fluid list">
        <div class="item align middle">
          <div class="content auto"><?php echo Lang::$word->_MOD_SP_WIDTH;?>:</div>
          <div class="content description"><?php echo $this->row->width . $this->conf->length;?></div>
          <div class="content auto"><?php echo Lang::$word->_MOD_SP_HEIGHT;?>:</div>
          <div class="content description"><?php echo $this->row->height . $this->conf->length;?></div>
        </div>
        <div class="item align middle">
          <div class="content auto"><?php echo Lang::$word->_MOD_SP_LENGTH;?>:</div>
          <div class="content description"><?php echo $this->row->length . $this->conf->length;?></div>
          <div class="content auto"><?php echo Lang::$word->_MOD_SP_WEIGHT;?>:</div>
          <div class="content description"><?php echo $this->row->weight . $this->conf->weight;?></div>
        </div>
      </div>
      <p class="wojo small text"><?php echo Lang::$word->PRICE;?>:</p>
      <?php echo Shop::renderBigPrice($this->row->price, $this->row->price_sale, "secondary");?>
      <div class="wojo small divider"></div>
      <?php include FMODPATH . "/shop/snippets/_button_item.tpl.php";?>
      <?php if(!$this->conf->catalog):?>
        <div class="margin top">
          <a id="simpleCart" class="wojo basic primary fluid button" href="<?php echo Url::url('/' . $this->core->modname['shop'], $this->core->modname['shop-cart']);?>">
          <?php echo Lang::$word->_MOD_SP_SUB8;?> (<span><?php echo ($this->totals) ? $this->totals->items : 0;?></span>)</a>
        </div>
      <?php endif;?>
    </div>
  </div>
  <?php echo Url::out_url($this->row->{'body' . Lang::$lang});?>
  <div class="wojo divider"></div>
  <?php if($this->conf->comments):?>
  <?php include_once(FMODPATH . 'comments/index.tpl.php');?>
  <?php endif;?>
</div>