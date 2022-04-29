<?php
  /**
   * Load Slider Thumb
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: loadThumb.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="columns" id="item_<?php echo $this->data->id;?>" data-id="<?php echo $this->data->id;?>">
  <div class="wojo card attached" data-mode="<?php echo $this->data->mode;?>" data-color="<?php echo $this->data->color;?>" data-image="<?php echo $this->data->image;?>" 
        <?php switch($this->data->mode): case "tr": ?>
        style="background-image:url(<?php echo APLUGINURL . '/slider/view/images/transbg.png';?>);background-repeat: repeat;"
        <?php break;?>
        <?php case "cl": ?>
          style="background-color:<?php echo $this->data->color;?>"
        <?php break;?>
        <?php default: ?>
          style="background-image:url(<?php echo UPLOADURL . '/thumbs/' . basename($this->data->image);?>);background-size: cover; background-position: center center; background-repeat: no-repeat;"
        <?php break;?>
        <?php endswitch;?>
      >
  <div class="wojo simple small icon top left attached button handle"><i class="icon white reorder"></i></div>
  <div class="content">
    <div class="vertical margin"><span  class="wojo white text" data-editable="true" data-set='{"action": "sltitle", "id":<?php echo $this->data->id;?>, "url":"<?php echo APLUGINURL;?>slider/controller.php"}'><?php echo Validator::truncate($this->data->title, 20);?></span></div>
    <div class="wojo fluid buttons eMenu">
      <a class="wojo small icon primary button" data-tooltip="<?php echo Lang::$word->PROP;?>" data-set='{"mode":"prop","id":<?php echo $this->data->id;?>,"type":"<?php echo $this->data->mode;?>"}'>
      <i class="icon select"></i>
      </a>
      <a href="<?php echo Url::url('/admin/plugins/slider/builder', $this->data->id);?>" class="wojo small icon positive button" data-tooltip="<?php echo Lang::$word->EDIT;?>" data-set='{"mode":"edit","id":<?php echo $this->data->id;?>}'>
      <i class="icon note"></i>
      </a>
      <a class="wojo small icon secondary button" data-tooltip="<?php echo Lang::$word->DUPLICATE;?>" data-set='{"mode":"duplicate","id":<?php echo $this->data->id;?>}'>
      <i class="icon copy"></i>
      </a>
      <a class="wojo small icon negative button" data-tooltip="<?php echo Lang::$word->DELETE;?>" data-set='{"mode":"delete","id":<?php echo $this->data->id;?>}'>
      <i class="icon trash"></i>
      </a>
    </div>
    </div>
  </div>
</div>