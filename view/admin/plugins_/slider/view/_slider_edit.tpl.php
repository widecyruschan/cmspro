<?php
  /**
   * Slider
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _slider_edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h3><?php echo Lang::$word->_PLG_SL_TITLE2;?></h3>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a id="addnew" class="wojo small primary icon button"><i class="icon plus"></i></a>
    <div class="wojo small dark button" data-slide="true" data-trigger="#settings">
      <i class="cogs icon"></i>
      <?php echo Lang::$word->SETTINGS;?>
    </div>
  </div>
</div>
<div id="settings" class="hide-all">
  <!-- Configuration -->
  <form method="post" id="wojo_form" name="wojo_form">
    <div class="wojo form segment">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->NAME;?>
            <i class="icon asterisk"></i></label>
          <div class="wojo large basic input">
            <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->title;?>" name="title">
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->_PLG_SL_AUTOPLAY;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoplay" type="radio" value="1" id="autoplay_1" <?php Validator::getChecked($this->data->autoplay, 1); ?>>
            <label for="autoplay_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoplay" type="radio" value="0" id="autoplay_0" <?php Validator::getChecked($this->data->autoplay, 0); ?>>
            <label for="autoplay_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field five wide">
          <label><?php echo Lang::$word->_PLG_SL_LOOPS;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoloop" type="radio" value="1" id="autoloop_1" <?php Validator::getChecked($this->data->autoloop, 1); ?>>
            <label for="autoloop_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoloop" type="radio" value="0" id="autoloop_0" <?php Validator::getChecked($this->data->autoloop, 0); ?>>
            <label for="autoloop_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->_PLG_SL_PONHOVER;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoplayHoverPause" type="radio" value="1" id="autoplayHoverPause_1" <?php Validator::getChecked($this->data->autoplayHoverPause, 1); ?>>
            <label for="autoplayHoverPause_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoplayHoverPause" type="radio" value="0" id="autoplayHoverPause_0" <?php Validator::getChecked($this->data->autoplayHoverPause, 0); ?>>
            <label for="autoplayHoverPause_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field five wide">
          <label><?php echo Lang::$word->_PLG_SL_ASPEED;?>
            <i class="icon asterisk"></i></label>
          <div class="wojo labeled input">
            <input placeholder="<?php echo Lang::$word->_PLG_SL_ASPEED;?>" type="text" value="<?php echo $this->data->autoplaySpeed;?>" name="autoplaySpeed">
            <div class="wojo simple label"> ms </div>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->_PLG_SL_HEIGHT;?></label>
          <input name="height" type="range" min="5" max="100" step="5" value="<?php echo $this->data->height;?>" hidden data-suffix=" vh" data-type="labels" data-labels="5,20,50,70,100">
        </div>
      </div>
      <div class="wojo wide auto divider"></div>
      <div class="row grid phone-1 mobile-2 tablet-2 screen-3 gutters" id="layoutMode">
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "basic") ? " active" :'';?>"><a data-type="basic"><img src="<?php echo APLUGINURL;?>slider/view/images/basic.png" alt=""></a>
            <h6 class="small margin top">Basic</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "standard") ? " active" :'';?>"><a data-type="standard"><img src="<?php echo APLUGINURL;?>slider/view/images/standard.png" alt=""></a>
            <h6 class="small margin top">Standard</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "dots") ? " active" :'';?>"><a data-type="dots"><img src="<?php echo APLUGINURL;?>slider/view/images/dots.png" alt=""></a>
            <h6 class="small margin top">Bullets Only</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "dots_right") ? " active" :'';?>"><a data-type="dots_right"><img src="<?php echo APLUGINURL;?>slider/view/images/dots_right.png" alt=""></a>
            <h6 class="small margin top">Vertical Bullets Right</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "dots_left") ? " active" :'';?>"><a data-type="dots_left"><img src="<?php echo APLUGINURL;?>slider/view/images/dots_left.png" alt=""></a>
            <h6 class="small margin top">Vertical Bullets Left</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "thumbs") ? " active" :'';?>"><a data-type="thumbs"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs.png" alt=""></a>
            <h6 class="small margin top">Thumbnails Only</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "thumbs_down") ? " active" :'';?>"><a data-type="thumbs_down"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs_down.png" alt=""></a>
            <h6 class="small margin top">Thumbnails</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "thumbs_left") ? " active" :'';?>"><a data-type="thumbs_left"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs_left.png" alt=""></a>
            <h6 class="small margin top">Thumbnails Left</h6>
          </div>
        </div>
        <div class="columns">
          <div class="wojo attached simple segment center aligned<?php echo ($this->data->layout == "thumbs_right") ? " active" :'';?>"><a data-type="thumbs_right"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs_right.png" alt=""></a>
            <h6 class="small margin top">Thumbnails Right</h6>
          </div>
        </div>
      </div>
      <div class="center aligned">
        <a  data-transition="true" data-type="slide up" data-trigger="#settings" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
        <button type="button" data-action="saveConfig" data-url="plugins_/slider" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_PLG_SL_SUB8;?></button>
      </div>
    </div>
    <input type="hidden" name="layout" value="<?php echo $this->data->layout;?>">
    <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
  </form>
</div>
<!-- Slides -->
<div class="row grid screen-5 tablet-3 mobile-2 phone-1 gutters align center wedit" id="sortable">
  <?php if($this->slides):?>
  <?php foreach($this->slides as $rows):?>
  <div class="columns" id="item_<?php echo $rows->id;?>" data-id="<?php echo $rows->id;?>">
    <div class="wojo card attached" data-mode="<?php echo $rows->mode;?>" data-color="<?php echo $rows->color;?>" data-image="<?php echo $rows->image;?>" 
        <?php switch($rows->mode): case "tr": ?>
        style="background-image:url(<?php echo APLUGINURL . '/slider/view/images/transbg.png';?>);background-repeat: repeat;"
        <?php break;?>
        <?php case "cl": ?>
          style="background-color:<?php echo $rows->color;?>"
        <?php break;?>
        <?php default: ?>
          style="background-image:url(<?php echo UPLOADURL . '/thumbs/' . basename($rows->image);?>);background-size: cover; background-position: center center; background-repeat: no-repeat;"
        <?php break;?>
        <?php endswitch;?>
      >
    <div class="wojo simple small icon top left attached button handle"><i class="icon white reorder"></i></div>
    <div class="content">
      <div class="vertical margin"><span  class="wojo white text" data-editable="true" data-set='{"action": "sltitle", "id":<?php echo $rows->id;?>, "url":"<?php echo APLUGINURL;?>slider/controller.php"}'><?php echo Validator::truncate($rows->title, 20);?></span></div>
      <div class="wojo fluid buttons eMenu">
        <a class="wojo small icon primary button" data-tooltip="<?php echo Lang::$word->PROP;?>" data-set='{"mode":"prop","id":<?php echo $rows->id;?>,"type":"<?php echo $rows->mode;?>"}'>
        <i class="icon select"></i>
        </a>
        <a href="<?php echo Url::url('/admin/plugins/slider/builder', $rows->id);?>" class="wojo small icon positive button" data-tooltip="<?php echo Lang::$word->EDIT;?>" data-set='{"mode":"edit","id":<?php echo $rows->id;?>}'>
        <i class="icon note"></i>
        </a>
        <a class="wojo small icon secondary button" data-tooltip="<?php echo Lang::$word->DUPLICATE;?>" data-set='{"mode":"duplicate","id":<?php echo $rows->id;?>}'>
        <i class="icon copy"></i>
        </a>
        <a class="wojo small icon negative button" data-tooltip="<?php echo Lang::$word->DELETE;?>" data-set='{"mode":"delete","id":<?php echo $rows->id;?>}'>
        <i class="icon trash"></i>
        </a>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
</div>
<!-- Slide Source-->
<div class="wojo small form segment hide-all" id="source">
  <a id="closeSource" class="wojo simple top right attached icon button"><i class="icon delete"></i></a>
  <div class="wojo fields align-middle">
    <div class="field two wide labeled">
      <label><?php echo Lang::$word->_PLG_SL_SUB12;?></label>
    </div>
    <div class="field auto">
      <div class="wojo checkbox inline radio fitted">
        <input name="source" type="radio" value="bg" id="source_bg" checked="checked">
        <label for="source_bg">&nbsp;</label>
      </div>
    </div>
    <div data-id="bg_asset" class="field auto hide-all">
      <a class="wojo small primary button bg_image"><?php echo Lang::$word->_PLG_SL_SUB13;?></a>
      <input type="hidden" name="bg_img" value="" id="bg_img">
    </div>
  </div>
  <div class="wojo fields">
    <div class="field two wide labeled">
      <label>Transparent</label>
    </div>
    <div class="field auto">
      <div class="wojo checkbox inline radio fitted">
        <input name="source" type="radio" id="source_tr" value="tr">
        <label for="source_tr">&nbsp;</label>
      </div>
    </div>
  </div>
  <div class="wojo fields">
    <div class="field two wide labeled">
      <label>Solid Color</label>
    </div>
    <div class="field auto">
      <div class="wojo checkbox inline radio fitted">
        <input name="source" type="radio" id="source_cl" value="cl">
        <label for="source_cl">&nbsp;</label>
      </div>
    </div>
    <div data-id="cl_asset" class="auto hide-all">
      <a class="wojo small basic icon button"><i class="icon contrast"></i></a>
      <input type="hidden" id="bg_color" value="">
    </div>
  </div>
</div>
<link href="<?php echo APLUGINURL;?>slider/view/css/slider.css" rel="stylesheet" type="text/css" />
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo APLUGINURL;?>slider/view/js/slider.js"></script>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Slider({
          url: "<?php echo APLUGINURL;?>slider/controller.php",
          aurl: "<?php echo ADMINVIEW;?>",
          surl: "<?php echo SITEURL;?>",
		  turl: "<?php echo THEMEURL;?>",
          lang: {
              canBtn: "<?php echo Lang::$word->CANCEL;?>",
              updBtn: "<?php echo Lang::$word->UPDATE;?>",
          }
	  });
  });
// ]]>
</script>