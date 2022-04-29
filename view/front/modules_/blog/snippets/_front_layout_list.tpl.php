<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _front_layout_list.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="blog" class="row gutters">
  <?php if($this->rows):?>
  <?php foreach($this->rows as $row):?>
  <div class="columns screen-40 tablet-40 mobile-50 phone-100">
    <figure class="wojo rounded image"><img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>"></figure>
  </div>
  <div class="columns screen-60 tablet-60 mobile-50 phone-100">
    <small class="wojo thin text"><?php echo Date::doDate("long_date", $row->created);?></small>
    <h5 class="basic">
      <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
    </h5>
    <p class="wojo small text">
      <?php echo Lang::$word->IN;?>: <a class="black" href="<?php echo Url::url('/' . $this->core->modname['blog'] . '/' . $this->core->modname['blog-cat'], $row->cslug);?>">
      <?php echo $row->ctitle;?>
      </a>
    </p>
    <div class="wojo secondary text"><?php echo Validator::sanitize($row->body, "default", 100);?></div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>