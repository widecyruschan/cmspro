<?php
  /**
   * Shop Cart
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-06-29 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));
?>
<?php if(!App::Shop()->catalog):?>
<div class="wojo segment">
  <h4><?php echo Lang::$word->_MOD_SP_CART;?></h4>
  <div id="scartList" class="wojo very relaxed divided fluid list" action="<?php echo FMODULEURL;?>">
    <?php if(!$cartdata = Shop::getCartContent()):?>
    <div class="content">
      <?php echo Message::msgSingleInfo(Lang::$word->_MOD_SP_NOCART);?>
    </div>
    <?php else:?>
    <?php $total = 0;?>
    <?php foreach($cartdata as $xrow):?>
    <?php $total += ($xrow->total * $xrow->items);?>
    <div class="item align middle">
      <img class="wojo small rounded image" src="<?php echo Shop::hasThumb($xrow->thumb, $xrow->pid);?>" alt="">
      <div class="content">
        <div class="truncate"><a href="<?php echo Url::url('/' . App::Core()->modname['shop'], $xrow->slug);?>"><?php echo $xrow->title;?></a>
        </div>
        <div class="wojo semi small text"><?php echo $xrow->items;?> x <?php echo Utility::formatMoney($xrow->total);?></div>
      </div>
      <div class="content auto">
        <a data-id="<?php echo $xrow->id;?>" class="black small left padding deleteItem"><i class="icon trash"></i></a>
      </div>
    </div>
    <?php endforeach;?>
    <div class="item ">
      <div class="content">
        <a href="<?php echo Url::url('/' . App::Core()->modname['shop'], App::Core()->modname['shop-cart']);?>" class="wojo primary right fluid labeled button">
        <span><?php echo Lang::$word->_MOD_SP_CART;?></span><i class="icon basket"></i>
        </a>
      </div>
    </div>
    <div class="item">
      <div class="content center aligned">
        <span class="wojo big demi text">
        <?php echo Utility::formatMoney($total);?>
        <?php if(App::Core()->enable_tax) echo '+ ' . Lang::$word->TAX;?>
        </span>
      </div>
    </div>
    <?php endif;?>
  </div>
</div>
<?php endif;?>