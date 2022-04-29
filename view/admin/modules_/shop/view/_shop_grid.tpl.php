<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _shop_grid.tpl.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle spaced">
  <div class="columns phone-100">
    <h2><?php echo Lang::$word->_MOD_DS_SUB;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url("/admin/modules/shop", "new/");?>" class="wojo dark small stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_DS_ADD;?></a>
  </div>
  <div class="columns auto">
    <div class="wojo filter buttons">
      <a class="wojo small disabled icon button"><i class="icon grid"></i></a>
      <a href="<?php echo Url::url("/admin/modules/shop");?>" class="wojo small primary icon button"><i class="icon unordered list"></i></a>
    </div>
  </div>
  <div class="columns auto">
    <a data-wdropdown="#dropdown-shopMenu" class="wojo small white icon button">
    <i class="icon vertical ellipsis"></i>
    </a>
    <div class="wojo small dropdown menu top-right" id="dropdown-shopMenu">
      <a class="item" href="<?php echo Url::url("/admin/modules/shop", "variations/");?>"><i class="icon filter"></i>
      <?php echo Lang::$word->_MOD_SP_VARS;?></a>
      <a class="item" href="<?php echo Url::url("/admin/modules/shop", "shipping/");?>"><i class="icon postcard"></i>
      <?php echo Lang::$word->_MOD_SP_SHIPPING;?></a>
      <a class="item" href="<?php echo Url::url("/admin/modules/shop", "categories/");?>"><i class="icon unordered list"></i>
      <?php echo Lang::$word->CATEGORIES;?></a>
      <a class="item" href="<?php echo Url::url("/admin/modules/shop", "payments/");?>"><i class="icon credit card"></i>
      <?php echo Lang::$word->TRX_SALES;?></a>
      <a class="item" href="<?php echo Url::url("/admin/modules/shop", "settings/");?>"><i class="icon sliders horizontal"></i>
      <?php echo Lang::$word->SETTINGS;?></a>
    </div>
  </div>
</div>
<div class="row gutters align center">
  <div class="columns screen-40 tablet-50 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form" class="wojo form">
      <div class="wojo action input">
        <input name="find" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text">
        <button class="wojo small primary inverted icon button">
        <i class="icon find"></i></button>
      </div>
    </form>
  </div>
</div>
<div class="center aligned">
  <div class="wojo divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->SORTING_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
    <?php echo Lang::$word->RESET;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=xsales|DESC");?>" class="item<?php echo Url::setActive("order", "xsales");?>">
    <?php echo Lang::$word->_MOD_SP_SUB6;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=name|DESC");?>" class="item<?php echo Url::setActive("order", "name");?>">
    <?php echo Lang::$word->CATEGORY;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=price|DESC");?>" class="item<?php echo Url::setActive("order", "price");?>">
    <?php echo Lang::$word->PRICE;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=title|DESC");?>" class="item<?php echo Url::setActive("order", "title");?>">
    <?php echo Lang::$word->NAME;?>
    </a>
    <div class="item"><a href="<?php echo Url::sortItems(Url::url(Router::$path), "order");?>" data-content="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
    </div>
  </div>
</div>
<div class="center aligned margin bottom">
  <?php echo Validator::alphaBits(Url::url(Router::$path), "letter");?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small semi caps text"><?php echo Lang::$word->_MOD_DS_NOPROD;?></p>
</div>
<?php else:?>
<div class="wojo mason">
  <?php foreach($this->data as $k => $row):?>
  <?php $k++;?>
  <div class="item" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="wojo card attached">
      <div class="relative">
        <a data-wdropdown="#dropdown-dMenu_<?php echo $k;?>" class="wojo top white right spaced attached icon button"><i class="icon vertical ellipsis"></i></a>
        <div class="wojo small dropdown menu top-right" id="dropdown-dMenu_<?php echo $k;?>">
          <a class="item" href="<?php echo Url::url("/admin/modules/shop/edit", $row->id);?>"><i class="icon pencil"></i>
          <?php echo Lang::$word->EDIT;?></a>
          <a class="item data" data-set='{"option":[{"delete": "deleteItem","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/shop"}'><i class="icon trash"></i>
          <?php echo Lang::$word->DELETE;?></a>
        </div>
      </div>
      <div class="center aligned"><img src="<?php echo Shop::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo rounded large inline image"></div>
      <div class="content center aligned">
        <h4><a href="<?php echo Url::url("/admin/modules/shop/edit", $row->id);?>"><?php echo $row->title;?></a>
        </h4>
        <p><a href="<?php echo Url::url("/admin/modules/shop/category", $row->category_id);?>"><?php echo $row->name;?></a>
        </p>
        <p class="wojo bold text"><?php echo Utility::formatMoney($row->price);?></p>
      </div>
      <div class="footer divided">
        <div class="row align middle">
          <div class="columns">
            <a href="<?php echo Url::url("/admin/modules/shop/history" . $row->id);?>" class="wojo small primary button"><?php echo Lang::$word->TRX_SALES;?>
            <?php echo $row->xsales;?>
            </a>
          </div>
          <div class="columns auto">
            <div class="wojo small basic passive button"><?php echo Lang::$word->COMMENTS;?>
              <?php echo $row->comments;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>