<?php
  /**
   * Forms
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _forms_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h2><?php echo Lang::$word->_MOD_VF_TITLE;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_VF_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_VF_NOFORMS;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-3 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="header center aligned divided">
        <h4 class="basic"><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->{'title' . Lang::$lang};?></a>
        </h4>
      </div>
      <div class="content center aligned">
        <a href="<?php echo Url::url(Router::$path, "view/" . $row->id);?>" class="wojo circular positive icon button"><i class="icon desktop"></i></a>
        <a href="<?php echo Url::url(Router::$path, "design/" . $row->id);?>" class="wojo circular icon button"><i class="icon server"></i></a>
        <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="wojo circular primary icon button"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteForm","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/forms"}' class="wojo circular negative icon button data">
        <i class="icon trash"></i></a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>