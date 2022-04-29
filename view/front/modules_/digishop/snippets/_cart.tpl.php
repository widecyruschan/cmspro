<?php
  /**
   * Cart
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _cart.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if(!$this->data):?>
<div class="content">
  <?php echo Message::msgSingleInfo(Lang::$word->_MOD_DS_NOCART);?>
</div>
<?php else:?>
<?php $total = 0;?>
<?php foreach($this->data as $xrow):?>
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
<div class="item align middle">
  <div class="content">
    <a href="<?php echo Url::url('/' . App::Core()->modname['digishop'], App::Core()->modname['digishop-checkout']);?>" class="wojo small primary button">
    <i class="icon basket"></i><?php echo Lang::$word->_MOD_DS_SUB6;?>
    </a>
  </div>
  <div class="content auto">
    <span class="wojo semi big secondary text">
    <?php echo Utility::formatMoney($total);?>
    <?php if(App::Core()->enable_tax) echo '+ ' . Lang::$word->TAX;?>
    </span>
  </div>
</div>
<?php endif;?>