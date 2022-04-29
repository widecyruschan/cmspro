<?php
  /**
   * Digishop Cart
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));
?>
<div class="wojo segment">
  <h4><?php echo Lang::$word->_MOD_DS_CART;?></h4>
  <div id="cartList" class="wojo very relaxed divided fluid list" action="<?php echo FMODULEURL;?>">
    <?php if(!$cartdata = Digishop::getCartContent()):?>
    <div class="content">
      <?php echo Message::msgSingleInfo(Lang::$word->_MOD_DS_NOCART);?>
    </div>
    <?php else:?>
    <?php $total = 0;?>
    <?php foreach($cartdata as $xrow):?>
    <?php $total += ($xrow->price * $xrow->items);?>
    <div class="item align middle">
      <img class="wojo small rounded image" src="<?php echo Digishop::hasThumb($xrow->thumb, $xrow->pid);?>" alt="">
      <div class="content">
        <div class="truncate"><a href="<?php echo Url::url('/' . App::Core()->modname['digishop'], $xrow->slug);?>"><?php echo $xrow->title;?></a>
        </div>
        <div class="wojo semi small text"><?php echo $xrow->items;?> x <?php echo Utility::formatMoney($xrow->price);?></div>
      </div>
      <div class="content auto">
        <a data-id="<?php echo $xrow->pid;?>" class="black small left padding deleteItem"><i class="icon trash"></i></a>
      </div>
    </div>
    <?php endforeach;?>
    <div class="item">
      <div class="content">
        <a href="<?php echo Url::url('/' . App::Core()->modname['digishop'], App::Core()->modname['digishop-checkout']);?>" class="wojo small primary fluid button">
        <i class="icon basket"></i><?php echo Lang::$word->_MOD_DS_SUB6;?>
        </a>
      </div>
    </div>
    <div class="item">
      <div class="content center aligned">
        <span class="wojo semi large text">
        <?php echo Utility::formatMoney($total);?>
        <?php if(App::Core()->enable_tax) echo '+ ' . Lang::$word->TAX;?>
        </span>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>