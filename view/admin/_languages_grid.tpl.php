<?php
  /**
   * Language Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _languages_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h3><?php echo Lang::$word->LG_TITLE;?></h3>
    <?php echo Lang::$word->LG_SUB;?>
  </div>
  <div class="columns auto mobile-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->LG_SUB5;?></a>
  </div>
</div>
<div class="row grid phone-1 tablet-2 mobile-1 screen-2 gutters">
  <?php foreach ($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo card">
      <img src="<?php echo ADMINVIEW;?>/images/langbg.jpg">
      <div class="divided footer">
        <div class="row align middle small horizontal gutters">
          <div class="columns">
            <div class="wojo white buttons">
              <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo button">
              <span class="flag icon <?php echo $row->abbr;?>"></span>
              <?php echo $row->name;?></a>
              <a href="<?php echo Url::url(Router::$path . "/translate", $row->id);?>" class="wojo icon button">
              <i class="icon positive chat"></i>
              </a>
              <a data-set='{"option":[{"delete": "deleteLanguage","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id": <?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>"}' class="wojo icon button data"><i class="icon negative trash"></i></a>
            </div>
          </div>
          <div class="columns auto">
            <a data-id="<?php echo $row->id;?>" class="wojo icon button fcpick lang-color <?php echo Utility::colorToWord($row->color);?>"><i class="icon contrast"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>