<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-07-01 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));
?>
<?php switch(count($this->segments)): case 3: ?>
<!-- Start Shop Category -->
<?php include(FMODPATH . 'shop/_categories.tpl.php');?>
<?php break;?>
<?php case 2: ?>
<!-- Start Shop Checkout -->
<?php if(in_array($this->core->modname['shop-checkout'], $this->segments)):?>
<?php include(FMODPATH . 'shop/_checkout.tpl.php');?>
<!-- Start Shop Cart -->
<?php elseif(in_array($this->core->modname['shop-cart'], $this->segments)):?>
<?php include(FMODPATH . 'shop/_cart.tpl.php');?>
<?php else:?>
<!-- Start Shop Item -->
<?php include(FMODPATH . 'shop/_item.tpl.php');?>
<?php endif;?>
<?php break;?>
<!-- Start Shop default -->
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns">
    <div class="wojo divided horizontal list">
      <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
      <?php echo Lang::$word->RESET;?>
      </a>
      <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","name|DESC"));?>" class="item<?php echo Url::setActive("order", "name");?>">
      <?php echo Lang::$word->CATEGORY;?>
      </a>
      <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","title|DESC"));?>" class="item<?php echo Url::setActive("order", "title");?>">
      <?php echo Lang::$word->NAME;?>
      </a>
      <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","price|DESC"));?>" class="item<?php echo Url::setActive("order", "price");?>">
      <?php echo Lang::$word->PRICE;?>
      </a>
      <a href="<?php echo Url::url(Router::$path, Url::buildUrl("order","created|DESC"));?>" class="item<?php echo Url::setActive("order", "created");?>">
      <?php echo Lang::$word->DATE;?>
      </a>
      <div class="item"><a href="<?php echo Url::sortItems(Url::url(Router::$path), "order", true);?>" data-tooltip="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
      </div>
    </div>
  </div>
  <div class="columns auto">
    <a <?php if(Validator::isGetSet("mode", "grid")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","list")) . '"';?> class="wojo small icon button<?php if(!Validator::isGetSet("mode", "grid")) echo ' primary passive';?>">
    <i class="icon unordered list"></i>
    </a>
    <a <?php if(!Validator::isGetSet("mode", "grid")) echo 'href="' . Url::url(Router::$path, Url::buildUrl("mode","grid")) . '"';?> class="wojo small icon button<?php if(Validator::isGetSet("mode", "grid")) echo ' primary passive';?>">
    <i class="icon grid"></i>
    </a>
  </div>
</div>
<?php if($this->rows):?>
	<?php if(Validator::isGetSet("mode", "grid")):?>
    <?php include_once FMODPATH . 'shop/snippets/_grid.tpl.php';?>
    <?php else:?>
    <?php include_once FMODPATH . 'shop/snippets/_list.tpl.php';?>
    <?php endif;?>
<?php endif;?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php break;?>
<?php endswitch;?>