<?php
  /**
   * Adblock
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _adblock_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h2><?php echo Lang::$word->_MOD_AB_TITLE;?></h2>
    <p><?php echo Lang::$word->_MOD_AB_INFO;?></p>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_AB_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_AB_NO_CMP;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-3 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="wojo top right attached simple passive button" data-content="<?php echo Adblock::isOnlineStr($row);?>">
        <span class="wojo <?php echo Adblock::isOnline($row) ? "positive" : "negative";?> ring label"></span>
      </div>
      <div class="content">
        <div class="center aligned"><img src="<?php echo AMODULEURL;?>adblock/view/images/<?php echo $row->image ? "image.png" : "html.png";?>" class="wojo normal inline image" alt="">
          <h6 class="truncate margin top"><?php echo $row->{'title' . Lang::$lang};?></h6>
          <div class="wojo small primary inverted label label">
            <?php echo Lang::$word->_MOD_AB_SUB9;?>
            <?php echo $row->total_views;?>
          </div>
          <div class="wojo small primary inverted label label">
            <?php echo Lang::$word->_MOD_AB_SUB8;?>
            <?php echo $row->total_clicks;?>
          </div>
        </div>
      </div>
      <div class="divided footer center aligned">
        <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo small icon primary button"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteCampaign","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>", "url":"modules_/adblock"}' class="wojo icon small negative button data"><i class="icon trash"></i></a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>