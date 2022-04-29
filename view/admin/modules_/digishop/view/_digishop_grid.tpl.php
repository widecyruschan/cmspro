<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _digishop_grid.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle spaced">
  <div class="columns phone-100">
    <h2><?php echo Lang::$word->_MOD_DS_SUB;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo dark small stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_DS_ADD;?></a>
  </div>
  <div class="columns auto">
    <div class="wojo filter buttons">
      <a href="<?php echo Url::url(Router::$path, "list");?>" class="wojo primary small icon button"><i class="icon unordered list"></i></a>
      <a class="wojo small disabled icon button"><i class="icon grid"></i></a>
    </div>
  </div>
  <div class="columns auto">
    <a data-wdropdown="#dropdown-digiMenu" class="wojo small white icon button">
    <i class="icon vertical ellipsis"></i>
    </a>
    <div class="wojo small dropdown menu top-right" id="dropdown-digiMenu">
      <a class="item" href="<?php echo Url::url(Router::$path, "settings/");?>"><i class="icon sliders horizontal"></i>
      <?php echo Lang::$word->SETTINGS;?></a>
      <a class="item" href="<?php echo Url::url(Router::$path, "categories/");?>"><i class="icon unordered list"></i>
      <?php echo Lang::$word->CATEGORIES;?></a>
      <a class="item" href="<?php echo Url::url(Router::$path, "payments/");?>"><i class="icon credit card"></i>
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
<div class="wojo full cards screen-3 tablet-3 mobile-2 phone-1">
  <?php foreach($this->data as $k => $row):?>
  <?php $k++;?>
  <div class="card" id="item_<?php echo $row->id;?>">
    <div class="image photo">
      <a data-wdropdown="#dropdown-dMenu_<?php echo $k;?>" class="wojo top right circular spaced attached white icon button"><i class="icon vertical ellipsis"></i></a>
      <div class="wojo small dropdown menu top-right" id="dropdown-dMenu_<?php echo $k;?>">
        <a class="item" href="<?php echo Url::url(Router::$path . "/edit/" . $row->id);?>"><i class="icon pencil"></i>
        <?php echo Lang::$word->EDIT;?></a>
        <a class="item data" data-set='{"option":[{"delete": "deleteItem","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/digishop"}'><i class="icon trash"></i>
        <?php echo Lang::$word->DELETE;?></a>
      </div>
      <img src="<?php echo Digishop::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo top rounded image"></div>
    <div class="content center aligned">
      <h4><a href="<?php echo Url::url(Router::$path . '/edit', $row->id);?>"><?php echo $row->title;?></a>
      </h4>
      <p><a href="<?php echo Url::url(Router::$path, "category/" . $row->category_id);?>"><?php echo $row->name;?></a>
      </p>
      <p class="wojo small text"><?php echo $row->memberships ? $row->memberships : '-/-';?></p>
      <p class="wojo bold text"><?php echo Utility::formatMoney($row->price);?></p>
    </div>
    <div class="footer divided">
      <div class="row align middle">
        <div class="columns">
          <a href="<?php echo Url::url(Router::$path, "history/" . $row->id);?>" class="wojo small primary button"><?php echo Lang::$word->TRX_SALES;?>
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
  <?php endforeach;?>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
