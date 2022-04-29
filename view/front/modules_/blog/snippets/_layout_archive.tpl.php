<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _layout_archive.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->_MOD_AM_SUB42;?>
  <small class="wojo semi primary text"><?php echo Date::doDate("yyyy, MMMM", $this->segments[2]);?></small></h3>
<?php if(!$this->rows):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small semi caps text"><?php echo Lang::$word->_MOD_AM_SUB48;?></p>
</div>
<?php else:?>
<div class="wojo divider"></div>
<div class="wojo fluid very relaxed divided list">
  <?php foreach ($this->rows as $row):?>
  <div class="item align middle">
    <div class="content">
      <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>" class="secondary"><?php echo $row->title;?></a>
    </div>
    <div class="content auto">
      <span class="wojo small primary label"><?php echo Date::doDate("dd", $row->created);?></span>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>