<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _layout_tag.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3 class="margin-bottom"><?php echo Lang::$word->_MOD_AM_SUB79;?>
  <small class="wojo semi primary text"><?php echo $this->segments[2];?></small>
</h3>
<?php if($this->rows):?>
<div class="wojo fluid very relaxed divided list">
  <?php foreach ($this->rows as $row):?>
  <div class="item">
    <div class="content auto">
      <figure class="wojo small rounded image"><img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>"></figure>
    </div>
    <div class="content padding left">
      <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>" class="secondary"><?php echo $row->title;?></a>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>