<?php
  /**
   * Slider
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _slider_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_PLG_SL_TITLE1;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo large basic input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->_PLG_SL_AUTOPLAY;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="1" id="autoplay_1" checked="checked">
          <label for="autoplay_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="0" id="autoplay_0">
          <label for="autoplay_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->_PLG_SL_LOOPS;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoloop" type="radio" value="1" id="autoloop_1" checked="checked">
          <label for="autoloop_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoloop" type="radio" value="0" id="autoloop_0">
          <label for="autoloop_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->_PLG_SL_PONHOVER;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplayHoverPause" type="radio" value="1" id="autoplayHoverPause_1"  checked="checked">
          <label for="autoplayHoverPause_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplayHoverPause" type="radio" value="0" id="autoplayHoverPause_0">
          <label for="autoplayHoverPause_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->_PLG_SL_ASPEED;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <input placeholder="<?php echo Lang::$word->_PLG_SL_ASPEED;?>" type="text" value="1000" name="autoplaySpeed">
          <div class="wojo simple label"> ms </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->_PLG_SL_HEIGHT;?></label>
        <input name="height" type="range" min="5" max="100" step="5" value="50" hidden data-suffix=" vh" data-type="labels" data-labels="5,20,50,70,100">
      </div>
    </div>
    <div class="wojo wide auto divider"></div>
    <div class="row grid phone-1 mobile-2 tablet-2 screen-3 gutters" id="layoutMode">
      <div class="columns">
        <div class="wojo attached simple segment center aligned active"><a data-type="basic"><img src="<?php echo APLUGINURL;?>slider/view/images/basic.png" alt=""></a>
          <h6 class="small margin top">Basic</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="standard"><img src="<?php echo APLUGINURL;?>slider/view/images/standard.png" alt=""></a>
          <h6 class="small margin top">Standard</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="dots"><img src="<?php echo APLUGINURL;?>slider/view/images/dots.png" alt=""></a>
          <h6 class="small margin top">Bullets Only</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="dots_right"><img src="<?php echo APLUGINURL;?>slider/view/images/dots_right.png" alt=""></a>
          <h6 class="small margin top">Vertical Bullets Right</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="dots_left"><img src="<?php echo APLUGINURL;?>slider/view/images/dots_left.png" alt=""></a>
          <h6 class="small margin top">Vertical Bullets Left</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="thumbs"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs.png" alt=""></a>
          <h6 class="small margin top">Thumbnails Only</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="thumbs_down"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs_down.png" alt=""></a>
          <h6 class="small margin top">Thumbnails</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="thumbs_left"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs_left.png" alt=""></a>
          <h6 class="small margin top">Thumbnails Left</h6>
        </div>
      </div>
      <div class="columns">
        <div class="wojo attached simple segment center aligned"><a data-type="thumbs_right"><img src="<?php echo APLUGINURL;?>slider/view/images/thumbs_right.png" alt=""></a>
          <h6 class="small margin top">Thumbnails Right</h6>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "slider");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="saveConfig" data-url="plugins_/slider" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_PLG_SL_SUB8;?></button>
  </div>
  <input type="hidden" name="layout" value="basic">
</form>
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