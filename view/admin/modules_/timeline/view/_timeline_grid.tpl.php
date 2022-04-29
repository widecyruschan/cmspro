<?php
  /**
   * Timeline
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _timeline_list.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h2><?php echo Lang::$word->_MOD_TML_TITLE;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_TML_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_TML_NOTML;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-3 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns">
    <div class="wojo attached segment" id="item_<?php echo $row->id;?>">
      <a data-wdropdown="#dropdown-tmMenu_<?php echo $row->id;?>" class="wojo white icon top right spaced attached button">
      <i class="icon vertical ellipsis"></i>
      </a>
      <div class="wojo small dropdown top-right" id="dropdown-tmMenu_<?php echo $row->id;?>">
        <a class="item" href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><i class="icon pencil"></i>
        <?php echo Lang::$word->EDIT;?></a>
        <?php if($row->type == "custom"):?>
        <a class="item" href="<?php echo Url::url(Router::$path, "items/" . $row->id);?>"><i class="icon sliders horizontal"></i>
        <?php echo Lang::$word->ITEMS;?></a>
        <?php endif;?>
        <a class="item action" data-set='{"option":[{"delete": "deleteTimeline","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/timeline"}'><i class="icon trash"></i>
        <?php echo Lang::$word->DELETE;?></a>
      </div>
      <div class="center aligned">
        <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>">
        <img src="<?php echo AMODULEURL . 'timeline/view/images/' . $row->type . '.png';?>" class="wojo inline image">
        </a>
        <h4 class="basic margin top"><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->name;?></a>
        </h4>
        </h4>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>