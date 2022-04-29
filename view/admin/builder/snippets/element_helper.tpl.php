<?php
  /**
   * Element Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: element_helper.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="element-helper" class="hide-all">
  <div class="header">
    <i class="icon white note"></i>
    <h3 class="handle"> Element Editor</h3>
    <a class="close-editor"><i class="icon white delete"></i></a>
  </div>
  <div class="wojo form wrapper scrollbox" id="eleditor">
    <a class="wojo small circular icon button elementRestore" data-tooltip="Restore" data-position="left center"><i class="icon undo"></i></a>
    <div data-field="elementButton" class="eltype wojo small form">
      <h4>Edit Button</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Button text</label>
          <div class="wojo small icon input">
            <i class="icon wysiwyg type"></i>
            <input id="buttonText"  placeholder="Type something…" value="" type="text">
          </div>
        </div>
        <div class="field">
          <label>Button Size</label>
          <div class="center aligned">
            <button name="buttonSize" type="button" class="wojo mini basic button" data-value="mini">Mini</button>
            <button name="buttonSize" type="button" class="wojo mini basic button" data-value="small">Small</button>
            <button name="buttonSize" type="button" class="wojo mini basic button" data-value="">Default</button>
            <button name="buttonSize" type="button" class="wojo mini basic button" data-value="big">Big</button>
          </div>
        </div>
        <div class="field">
          <label>Button Color</label>
          <div class="center aligned">
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="">default</button>
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="primary">primary</button>
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="secondary">secondary</button>
            <div class="wojo small space divider"></div>
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="positive">positive</button>
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="negative">negative</button>
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="white">white</button>
            <button name="buttonColor" type="button" class="wojo mini basic button" data-value="basic">basic</button>
          </div>
        </div>
      </div>
      <div class="wojo small fields">
        <div class="field">
          <label>Button Style</label>
          <button name="buttonStyle" type="button" class="wojo mini basic button" data-value="">&nbsp;</button>
          <button name="buttonStyle" type="button" class="wojo mini basic button rounded" data-value="rounded">&nbsp;</button>
          <button name="buttonStyle" type="button" class="wojo basic icon button circular" data-value="circular"></button>
        </div>
        <div class="field">
          <label>Button Width</label>
          <button name="buttonWidth" type="button" class="wojo mini basic button" data-tooltip="Auto" data-value="">A</button>
          <button name="buttonWidth" type="button" class="wojo mini basic button" data-tooltip="Fluid" data-value="fluid">F</button>
        </div>
      </div>
      <div class="wojo small fields">
        <div class="field">
          <label>Icon Spin</label>
          <button name="buttonSpin" type="button" class="wojo mini basic icon button" data-value="1"><i class="icon check"></i></button>
          <button name="buttonSpin" type="button" class="wojo mini basic icon button" data-value="0"><i class="icon close"></i></button>
        </div>
        <div class="field">
          <label>Icon Position</label>
          <button name="buttonIcon" type="button" class="wojo mini basic icon button" data-value="">
          <i class="icon chevron left"></i>
          </button>
          <button name="buttonIcon" type="button" class="wojo mini basic icon button" data-value="right">
          <i class="icon chevron right"></i></button>
        </div>
      </div>
      <div class="wojo block small fields">
        <div class="field">
          <label>Button Type</label>
          <button name="buttonType" type="button" class="wojo mini basic button" data-value="a">Link</button>
          <button name="buttonType" type="button" class="wojo mini basic button active" data-value="button">Button</button>
        </div>
      </div>
    </div>
    <div data-field="elementLabel" class="eltype wojo small form">
      <h4>Edit Label</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Label Text</label>
          <div class="wojo small icon input">
            <i class="icon wysiwyg type"></i>
            <input id="labelText"  placeholder="Type something…" value="" type="text">
          </div>
        </div>
        <div class="field">
          <label>Label Size</label>
          <div class="center aligned">
            <button name="labelSize" type="button" class="wojo mini basic button" data-value="mini">Mini</button>
            <button name="labelSize" type="button" class="wojo mini basic button" data-value="small">Small</button>
            <button name="labelSize" type="button" class="wojo mini basic button" data-value="">Default</button>
            <button name="labelSize" type="button" class="wojo mini basic button" data-value="big">Big</button>
          </div>
        </div>
        <div class="field">
          <label>Label Color</label>
          <div class="center aligned">
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="">default</button>
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="primary">primary</button>
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="secondary">secondary</button>
            <div class="wojo small space divider"></div>
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="positive">positive</button>
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="negative">negative</button>
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="white">white</button>
            <button name="labelColor" type="button" class="wojo mini basic button" data-value="basic">basic</button>
          </div>
        </div>
      </div>
      <div class="wojo small fields">
        <div class="field">
          <label>Label Style</label>
          <button name="labelStyle" type="button" class="wojo mini basic button" data-value="">&nbsp;</button>
          <button name="labelStyle" type="button" class="wojo mini basic button rounded" data-value="rounded">&nbsp;</button>
          <button name="labelStyle" type="button" class="wojo basic icon button circular" data-value="circular"></button>
        </div>
      </div>
    </div>
    <div data-field="elementLink" class="eltype wojo small form">
      <h4>Edit Link</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Link</label>
          <div class="wojo small action input">
            <input id="elementLink"  placeholder="http://" value="" type="text">
            <div class="wojo simple icon button" data-wdropdown="#linkDrop">
              <i class="icon ellipsis vertical"></i></div>
            <div class="wojo dropdown small menu pointing top-right" id="linkDrop">
              <a class="item" data-value="">none</a>
              <div class="basic divider"></div>
              <div class="scrolling"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div data-field="elementIconAssets" class="eltype wojo small form">
      <div class="wojo block small fields">
        <div class="field">
          <label>Icon Color</label>
          <div class="center aligned">
            <button name="iconColor" type="button" class="wojo circular icon button" data-value=""></button>
            <button name="iconColor" type="button" class="wojo circular icon button primary" data-value="primary"></button>
            <button name="iconColor" type="button" class="wojo circular icon button secondary" data-value="secondary"></button>
            <button name="iconColor" type="button" class="wojo circular icon button positive" data-value="positive"></button>
            <button name="iconColor" type="button" class="wojo circular icon button negative" data-value="negative"></button>
          </div>
        </div>
        <div class="field">
          <label>Icon Style</label>
          <div class="center aligned">
            <button name="iconStyle" type="button" class="wojo simple small icon button" data-value="circular"><i class="icon user circular"></i></button>
            <button name="iconStyle" type="button" class="wojo simple small icon button" data-value="rounded"><i class="icon user rounded"></i></button>
            <button name="iconType" type="button" class="wojo simple small icon button" data-value="inverted"><i class="icon user inverted"></i></button>
            <button name="iconType" type="button" class="wojo simple small icon button" data-value="normal"><i class="icon user"></i></button>
          </div>
        </div>
        <div class="field">
          <label>Icon Size</label>
          <div class="center aligned">
            <input class="rangers" name="iconSize" type="text" min="-10" max="20" step="5" value="0" hidden data-suffix=" size">
          </div>
        </div>
      </div>
    </div>
    <div data-field="elementIcon" class="eltype wojo small form">
      <h4>Icon</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Icons</label>
          <div id="elementIcon" style="height:400px" class="scrollbox">
            <?php include("icons.tpl.php");?>
          </div>
        </div>
      </div>
    </div>
    <div data-field="elementMap" class="eltype wojo small form">
      <h4>Maps</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Google Map Url</label>
          <textarea name="elementMapUrl"></textarea>
        </div>
        <div class="field">
          <button name="elementMap" type="button" class="wojo primary button">Update</button>
        </div>
        <div class="field">
          <p class="wojo small secondary icon text middle"><i class="icon question sign"></i>Google map embed html code.</p>
        </div>
      </div>
    </div>
    <div data-field="elementVideo" class="eltype wojo small form">
      <h4>Video</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Vimeo/Youtube/Dailymotion Url</label>
          <input type="text" name="elementVideoUrl" value="">
        </div>
        <div class="field">
          <button name="elementVideo" type="button" class="wojo primary button">Update</button>
        </div>
        <div class="field">
          <p class="wojo small secondary icon text middle"><i class="icon question sign"></i>Youtube, dailymotion or vimeo url.</p>
        </div>
      </div>
    </div>
    <div data-field="elementSound" class="eltype wojo small form">
      <h4>Soundcloud</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Soundcloud Url</label>
          <input type="text" name="elementSoundUrl" value="">
        </div>
        <div class="field">
          <button name="elementSound" type="button" class="wojo primary button">Update</button>
        </div>
        <div class="field">
          <p class="wojo small secondary icon text middle"><i class="icon question sign"></i>Soundcloud share url.</p>
        </div>
      </div>
    </div>
    <div data-field="elementImage" class="eltype wojo small form">
      <h4>Image</h4>
      <div class="wojo block small fields">
        <div class="field">
          <label>Image Title</label>
          <input type="text" name="elementImageTitle" value="">
        </div>
        <div class="field">
          <label>Image Description</label>
          <input type="text" name="elementImageDesc" value="">
        </div>
        <div class="field">
          <label>Open in lightbox</label>
          <div class="wojo checkbox toggle fitted inline">
            <input name="imageLightbox" type="checkbox" value="1" id="imageLightbox">
            <label for="imageLightbox"><?php echo Lang::$word->YES;?></label>
          </div>
        </div>
        <div class="wojo divider"></div>
        <div class="field">
          <label>Image Style</label>
          <div class="row small horizontal gutters" id="imageStyles">
            <div class="columns"><span data-value="basic"><img src="<?php echo ADMINVIEW;?>/builder/images/blank_image.png" class="wojo basic image"></span>
            </div>
            <div class="columns"><span data-value="rounded"><img src="<?php echo ADMINVIEW;?>/builder/images/blank_image.png" class="wojo rounded image"></span>
            </div>
            <div class="columns"><span data-value="circular"><img src="<?php echo ADMINVIEW;?>/builder/images/blank_image.png" class="wojo circular image"></span>
            </div>
            <div class="columns"><span data-value="shadow"><img src="<?php echo ADMINVIEW;?>/builder/images/blank_image.png" class="wojo shadow image"></span>
            </div>
          </div>
        </div>
        <div class="wojo divider"></div>
        <div class="field">
          <label>Image Classes</label>
          <div class="wojo small action input">
            <input type="text" name="class_image">
            <a class="wojo small primary icon button" id="addImageClass"><i class="icon plus"></i></a>
          </div>
        </div>
        <div id="imageClasses" class="field"></div>
        <div class="wojo divider"></div>
      </div>
      <div class="field">
        <label>Image Filter</label>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Grayscale</span></div>
          <div class="columns screen-70">
            <input class="rangers image_gs" name="image_gs" type="text" min="0" max="100" step="1" value="0" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Blur</span></div>
          <div class="columns screen-70">
            <input class="rangers image_blur" name="image_blur" type="text" min="0" max="10" step="1" value="0" hidden data-suffix=" px">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Brightness</span></div>
          <div class="columns screen-70">
            <input class="rangers image_br" name="image_br" type="text" min="0" max="200" step="1" value="100" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Contrast</span></div>
          <div class="columns screen-70">
            <input class="rangers image_ct" name="image_ct" type="text" min="0" max="200" step="1" value="100" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Hue</span></div>
          <div class="columns screen-70">
            <input class="rangers image_hue" name="image_hue" type="text" min="0" max="360" step="1" value="0" hidden data-suffix=" &deg;">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Opacity</span></div>
          <div class="columns screen-70">
            <input class="rangers image_opacity" name="image_opacity" type="text" min="0" max="100" step="1" value="100" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Invert</span></div>
          <div class="columns screen-70">
            <input class="rangers image_invert" name="image_invert" type="text" min="0" max="100" step="1" value="0" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Saturate</span></div>
          <div class="columns screen-70">
            <input class="rangers image_saturate" name="image_saturate" type="text" min="0" max="500" step="1" value="100" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Sepia</span></div>
          <div class="columns screen-70">
            <input class="rangers image_sepia" name="image_sepia" type="text" min="0" max="100" step="1" value="0" hidden data-suffix=" %">
          </div>
        </div>
        <div class="row small gutters align middle">
          <div class="columns screen-30"><span class="wojo tiny semi text">Reset Filter</span></div>
          <div class="columns screen-70 content-right">
            <button name="imageFilterReset" type="button" class="wojo small primary circular icon button"><i class="icon refresh"></i></button>
          </div>
        </div>
      </div>
      <div class="wojo divider"></div>
      <div class="field">
        <label>Replace Image</label>
        <div id="imageWrap"><a>NO IMAGE</a>
        </div>
      </div>
    </div>
  </div>
  <div data-field="elementUrl" class="eltype wojo small form">
    <h4>Link</h4>
    <div class="wojo block small fields">
      <div class="field">
        <label>Url Title</label>
        <input type="text" name="elementUrlTitle" value="">
      </div>
      <div class="field">
        <label>Url</label>
        <input id="elementUrl" placeholder="http://" value="" type="url">
      </div>
      <div class="field">
        <label>Open in new tab</label>
        <div class="wojo checkbox toggle fitted inline">
          <input name="urlTrget" type="checkbox" value="1" id="urlTrget">
          <label for="urlTrget"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
