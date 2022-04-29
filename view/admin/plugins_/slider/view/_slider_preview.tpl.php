<?php
  /**
   * Slider
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: _slider_grid.tpl.php, v1.00 2016-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->slides):?>
<div class="wSlider wojoslider-slider wojoslider-full-width" style="max-height:<?php echo $this->data->height;?>px" data-wslider='<?php echo $this->data->settings;?>'>
  <div>
    <?php foreach($this->slides as $row):?>
    <div style="
    <?php if($row->mode == "bg"):?>
        background-position: center center; 
        background-repeat: no-repeat; 
        background-size: cover;
		background-image: url(<?php echo UPLOADURL . '/' . $row->image;?>);
    <?php elseif($row->mode == "tr"):?>
    background-color: transparent; 
    <?php else:?>
        background-color: <?php echo $row->color;?>; 
    <?php endif;?>
    "
		data-in="<?php echo $this->data->transition;?>"
		data-ease-in="<?php echo $this->data->slidesEaseIn;?>"
		data-out="fade"
		data-ease-out="<?php echo $this->data->slidesEaseIn;?>"
        data-time="<?php echo $this->data->slidesTime;?>"
    >
      <?php echo Url::out_url($row->html);?> </div>
    <?php endforeach;?>
  </div>

</div>
<?php endif;?>
<link href="<?php echo THEMEURL;?>/plugins/css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo THEMEURL;?>/plugins/js/slider.js"></script>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {
	$('.wSlider').each(function() {
		var set = $(this).data('wslider');
		$(this).wojoSlider({
			startWidth: set.width,
			startHeight: set.height,
			automaticSlide: set.automaticSlide,
			theme: set.layout,
			hasThumbs: set.thumbs,
			showControls: set.arrows,
			showNavigation: set.buttons,
			showProgressBar: set.showProgressBar,
		});
	});
});
// ]]>
</script>