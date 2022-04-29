<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _digishop_list.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle spaced">
  <div class="columns phone-100">
    <h2><?php echo Lang::$word->_MOD_DS_SUB;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url("/admin/modules/digishop", "new/");?>" class="wojo dark small stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_DS_ADD;?></a>
  </div>
  <div class="columns auto">
    <div class="wojo filter buttons">
      <a class="wojo small disabled icon button"><i class="icon unordered list"></i></a>
      <a href="<?php echo Url::url("/admin/modules/digishop");?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
    </div>
  </div>
  <div class="columns auto">
    <a data-wdropdown="#dropdown-digiMenu" class="wojo small white icon button">
    <i class="icon vertical ellipsis"></i>
    </a>
    <div class="wojo small dropdown menu top-right" id="dropdown-digiMenu">
      <a class="item" href="<?php echo Url::url("/admin/modules/digishop", "settings/");?>"><i class="icon sliders horizontal"></i>
      <?php echo Lang::$word->SETTINGS;?></a>
      <a class="item" href="<?php echo Url::url("/admin/modules/digishop", "categories/");?>"><i class="icon unordered list"></i>
      <?php echo Lang::$word->CATEGORIES;?></a>
      <a class="item" href="<?php echo Url::url("/admin/modules/digishop", "payments/");?>"><i class="icon credit card"></i>
      <?php echo Lang::$word->TRX_SALES;?></a>
    </div>
  </div>
</div>
<div class="row gutters align center">
  <div class="columns screen-40 tablet-50 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form" class="wojo form">
      <div class="wojo action input">
        <input name="find" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text">
        <button class="wojo small icon primary inverted button">
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
    <a href="<?php echo Url::url(Router::$path, "?order=memberships|DESC");?>" class="item<?php echo Url::setActive("order", "memberships");?>">
    <?php echo Lang::$word->MEMBERSHIP;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=category_id|DESC");?>" class="item<?php echo Url::setActive("order", "category_id");?>">
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
<?php foreach($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="header">
    <div class="row horizontal gutters align top">
      <div class="columns auto"><img src="<?php echo Digishop::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo normal image"></div>
      <div class="columns">
        <p class="wojo basic small text">
          <a href="<?php echo Url::url("/admin/modules/digishop/category", $row->category_id);?>"><?php echo $row->name;?></a>
        </p>
        <h4>
          <a href="<?php echo Url::url("/admin/modules/digishop/edit", $row->id);?>"><?php echo $row->title;?></a>
        </h4>
        <p class="wojo demi text"><?php echo Utility::formatMoney($row->price);?></p>
      </div>
    </div>
  </div>
  <div class="footer divided">
    <div class="row align middle">
      <div class="columns">
        <div class="wojo horizontal small divided responsive list">
          <div class="item"><?php echo Lang::$word->COMMENTS;?>
            <span class="description"><?php echo $row->comments;?></span>
          </div>
          <div class="item"><?php echo Lang::$word->TRX_SALES;?>
            <span class="description"><?php echo ($row->xsales > 0) ? $row->xsales : '-/-';?></span>
          </div>
          <div class="item"><?php echo Lang::$word->MEMBERSHIP;?>
            <span class="description"><?php echo $row->memberships ? $row->memberships : '-/-';?></span>
          </div>
          <div class="item"><?php echo Lang::$word->LIKES;?>
            <span class="description"><?php echo $row->likes;?></span>
          </div>
        </div>
      </div>
      <div class="columns auto">
        <a data-wdropdown="#prodDrop_<?php echo $row->id;?>" class="wojo small primary inverted icon circular button">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="prodDrop_<?php echo $row->id;?>">
          <a class="item" href="<?php echo Url::url("/admin/modules/digishop/edit", $row->id);?>"><i class="icon pencil"></i>
          <?php echo Lang::$word->EDIT;?></a>
          <a class="item" href="<?php echo Url::url("/admin/modules/digishop/history", $row->id);?>"><i class="icon history"></i>
          <?php echo Lang::$word->HISTORY;?></a>
          <div class="divider"></div>
          <a data-set='{"option":[{"delete":"deleteItem","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id": "<?php echo $row->id;?>"}],"url":"modules_/digishop", "action":"delete", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
          <i class="icon trash"></i><?php echo Lang::$word->DELETE;?>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>