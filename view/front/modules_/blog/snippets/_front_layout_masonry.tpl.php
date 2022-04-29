<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _front_layout_twocol.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="blog" class="wojo mason two" action="<?php echo FMODULEURL;?>">
  <?php if($this->rows):?>
  <?php foreach($this->rows as $row):?>
  <div class="item">
    <figure class="wojo rounded image">
      <?php if($row->thumb):?>
      <img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>">
      <?php endif;?>
    </figure>
    <div class="wojo rounded full padding<?php echo (!$row->thumb) ? ' primary bg' : null;?>">
      <small class="wojo <?php echo ($row->thumb) ? 'secondary' : 'white dimmed';?> thin text"><?php echo Date::doDate("long_date", $row->created);?></small>
      <h6>
        <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>" class="<?php echo ($row->thumb) ? 'black' : 'white';?>"><?php echo $row->title;?></a>
      </h6>
    </div>
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