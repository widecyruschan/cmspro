<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _blog_list.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->_MOD_AM_TITLE;?></h2>
  </div>
  <div class="columns auto mobile-100 phone-100">
  <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_AM_NEW;?></a>
    <a data-wdropdown="#dropdown-blogMenu" class="wojo small white icon button">
    <i class="icon vertical ellipsis"></i>
    </a>
    <div class="wojo small dropdown menu top-right" id="dropdown-blogMenu">
      <a class="item" href="<?php echo Url::url(Router::$path, "settings/");?>"><i class="icon sliders horizontal"></i>
      <span class="padding-left"><?php echo Lang::$word->SETTINGS;?></span></a>
      <a class="item" href="<?php echo Url::url(Router::$path, "categories/");?>"><i class="icon unordered list"></i>
      <span class="padding-left"><?php echo Lang::$word->CATEGORIES;?></span></a>
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
    <a href="<?php echo Url::url(Router::$path, "?order=memberships|DESC");?>" class="item<?php echo Url::setActive("order", "memberships");?>">
    <?php echo Lang::$word->MEMBERSHIP;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=active|DESC");?>" class="item<?php echo Url::setActive("order", "active");?>">
    <?php echo Lang::$word->PUBLISHED;?>
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
  <p class="wojo small thick caps text"><?php echo Lang::$word->_MOD_AM_NOARTICLE;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="header">
    <div class="row horizontal gutters align top">
      <div class="columns auto center aligned phone-100"><img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo normal inline rounded image"></div>
      <div class="columns phone-100">
        <p class="wojo small text">
          <a class="grey" href="<?php echo Url::url("/admin/modules/blog/category",  $row->category_id);?>"><?php echo $row->name;?></a>
        </p>
        <h4>
          <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->title;?></a>
        </h4>
      </div>
    </div>
  </div>
  <div class="footer divided">
    <div class="row align middle">
      <div class="columns phone-100">
        <div class="wojo horizontal small divided responsive list">
          <div class="item">
            <?php echo Lang::$word->COMMENTS;?>
            <span class="description"><?php echo $row->comments;?></span>
          </div>
          <div class="item">
            <?php echo Lang::$word->HITS;?>
            <span class="description"><?php echo $row->hits;?></span>
          </div>
          <div class="item">
            <?php echo Lang::$word->LIKES;?>
            <span class="description">+<?php echo $row->like_up;?> -<?php echo $row->like_down;?></span>
          </div>
          <div class="item">
            <?php echo Lang::$word->MEMBERSHIP;?>
            <span class="description"><?php echo $row->memberships ? $row->memberships : '-/-';?></span>
          </div>
          <div class="item">
            <?php echo Lang::$word->PUBLISHED;?>
            <span class="description"><?php echo Utility::isPublished($row->active);?></span>
          </div>
        </div>
      </div>
      <div class="columns auto phone-100">
        <a class="wojo small primary inverted icon button" href="<?php echo Url::url("/admin/modules/blog/edit", $row->id);?>"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteItem","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/blog"}' class="wojo small inverted negative icon button data">
        <i class="icon trash"></i></a>
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