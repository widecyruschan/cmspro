<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _front_layout_modern.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="blog" action="<?php echo FMODULEURL;?>">
  <?php if($this->rows):?>
  <div class="row gutters">
    <?php foreach($this->rows as $row):?>
    <?php $size = Utility::getColumnSize();?>
    <?php $style = ($row->thumb) ? ' style="background-image:url(' . FMODULEURL . Blog::BLOGDATA . $row->id . '/thumbs/' . $row->thumb .')"' : null ;?>
    <div class="columns screen-<?php echo $size;?> tablet-100 mobile-50 phone-100">
      <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>" class="wojo hero rounded image align bottom<?php echo (!$row->thumb) ? ' primary bg' : null;?>"<?php echo $style;?>>
        <article class="full padding center aligned">
          <h4 class="wojo white text"><?php echo $row->title;?></h4>
          <small class="wojo white dimmed text"><?php echo Date::doDate("long_date", $row->created);?></small>
        </article>
      </a>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>