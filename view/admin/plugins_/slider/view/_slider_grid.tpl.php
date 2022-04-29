<?php
  /**
   * Slider
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _slider_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->_PLG_SL_TITLE;?></h2>
    <p class="wojo small text"><?php echo Lang::$word->_PLG_SL_SUB2;?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_PLG_SL_SUB7;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aigned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold text"><?php echo Lang::$word->_PLG_SL_NOSLIDER;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-2 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="content center aligned">
        <img src="<?php echo APLUGINURL . 'slider/view/images/' . $row->layout;?>.png" class="wojo inline image" alt="">
        <h5><?php echo $row->title;?></h5>
      </div>
      <div class="divided footer center aligned">
        <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo icon small primary button"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteSlider","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>", "url":"plugins_/slider"}' class="wojo icon small negative button data">
        <i class="icon trash"></i>
        </a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>