<?php
  /**
   * Category
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _categories.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo $this->row->{'name' . Lang::$lang};?></h2>
<div class="row gutters align middle">
  <div class="columns">
    <div class="wojo divided horizontal link list"> <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>"> <?php echo Lang::$word->RESET;?> </a> <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","memberships|DESC"));?>" class="item<?php echo Url::setActive("order", "memberships");?>"> <?php echo Lang::$word->MEMBERSHIP;?> </a> <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","title|DESC"));?>" class="item<?php echo Url::setActive("order", "title");?>"> <?php echo Lang::$word->NAME;?> </a> <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","price|DESC"));?>" class="item<?php echo Url::setActive("order", "price");?>"> <?php echo Lang::$word->PRICE;?> </a> <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","created|DESC"));?>" class="item<?php echo Url::setActive("order", "created");?>"> <?php echo Lang::$word->DATE;?> </a>
      <div class="item"><a href="<?php echo Url::sortItems(Url::url(Router::$path), "order", true);?>" data-tooltip="ASC/DESC"><i class="icon triangle unfold more link"></i></a> </div>
    </div>
  </div>
  <div class="columns auto"> 
  <a <?php if(Validator::isGetSet("mode", "list")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","grid")) . '"';?> class="wojo small icon button<?php if(!Validator::isGetSet("mode", "list")) echo ' primary passive';?>"><i class="icon grid"></i></a> 
  <a <?php if(!Validator::isGetSet("mode", "list")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","list")) . '"';?> class="wojo small icon button<?php if(Validator::isGetSet("mode", "list")) echo ' primary passive';?>"><i class="icon unordered list"></i></a> </div>
</div>
<?php if($this->rows):?>
<?php if(Validator::isGetSet("mode", "list")):?>
<?php include(FMODPATH . 'shop/snippets/_list.tpl.php');?>
<?php else:?>
<?php include(FMODPATH . 'shop/snippets/_grid.tpl.php');?>
<?php endif;?>
<?php endif;?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>