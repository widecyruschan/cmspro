<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _front_layout_classic.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->rows):?>
<div class="wojo basic cards screen-2 tablet-2 mobile-1 phone-1">
  <?php foreach($this->rows as $row):?>
  <div class="card">
    <figure class="wojo rounded image"><img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>"></figure>
    <div class="content">
      <small class="wojo secondary thin text"><?php echo Date::doDate("long_date", $row->created);?></small>
      <h5>
        <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
      </h5>
      <div class="wojo secondary text"><?php echo Validator::sanitize($row->body, "default", 100);?></div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php endif;?>
