<?php
  /**
   * Portfolio
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _portfolio_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle spaced">
  <div class="columns phone-100">
    <h2><?php echo Lang::$word->_MOD_PF_SUB;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo dark small stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_PF_ADD;?></a>
  </div>
  <div class="columns auto">
    <div class="wojo filter buttons">
      <a href="<?php echo Url::url(Router::$path, "list");?>" class="wojo primary small icon button"><i class="icon unordered list"></i></a>
      <a class="wojo small disabled icon button"><i class="icon grid"></i></a>
    </div>
  </div>
  <div class="columns auto">
    <a data-wdropdown="#dropdown-portMenu" class="wojo small white icon button">
    <i class="icon vertical ellipsis"></i>
    </a>
    <div class="wojo small dropdown menu top-right" id="dropdown-portMenu">
      <a class="item" href="<?php echo Url::url(Router::$path, "settings/");?>"><i class="icon sliders horizontal"></i>
      <?php echo Lang::$word->SETTINGS;?></a>
      <a class="item" href="<?php echo Url::url(Router::$path, "categories/");?>"><i class="icon unordered list"></i>
      <?php echo Lang::$word->CATEGORIES;?></a>
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
  <div class="wojo small divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->SORTING_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
    <?php echo Lang::$word->RESET;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=hits|DESC");?>" class="item<?php echo Url::setActive("order", "hits");?>">
    <?php echo Lang::$word->HITS;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=category_id|DESC");?>" class="item<?php echo Url::setActive("order", "category_id");?>">
    <?php echo Lang::$word->CATEGORY;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=client|DESC");?>" class="item<?php echo Url::setActive("order", "client");?>">
    <?php echo Lang::$word->_MOD_PF_SUB1;?>
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
  <p class="wojo small semi caps text"><?php echo Lang::$word->_MOD_PF_NOPROJ;?></p>
</div>
<?php else:?>
<div class="wojo mason">
  <?php foreach($this->data as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="wojo card attached">
      <div class="image photo"><img src="<?php echo Portfolio::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo basic rounded image"></div>
      <div class="content center aligned">
        <h4>
          <a href="<?php echo Url::url(Router::$path . '/edit', $row->id);?>"><?php echo $row->title;?></a>
        </h4>
        <p>
          <a href="<?php echo Url::url(Router::$path, "category/" . $row->id);?>"><?php echo $row->name;?></a>
        </p>
        <p class="wojo small text"><?php echo $row->client ? $row->client : '-/-';?></p>
      </div>
      <div class="footer divided center aligned">
        <a class="wojo small primary icon button" href="<?php echo Url::url(Router::$path . "/edit/" . $row->id);?>"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteItem","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/portfolio"}' class="wojo small negative icon button data">
        <i class="icon trash"></i></a>
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