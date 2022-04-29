<?php
  /**
   * Gmaps
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _gmaps_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_GM_TITLE2;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_SUB;?>
          <i class="icon asterisk"></i></label>
        <select name="type">
          <?php echo Utility::loopOptionsSimpleAlt($this->mtype);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_SUB1;?></label>
        <input name="zoom" type="range" min="1" max="20" step="1" value="14" hidden data-suffix=" lvl" data-type="labels" data-labels="1,5,10,15,20">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_SUB1_1;?></label>
        <input name="minmaxzoom" type="range" min="1" max="20" step="1" value="1" hidden data-suffix=" lvl" data-type="labels" data-labels="1,5,10,15,20">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_SUB3;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="streetview" type="radio" value="1" id="streetview_1" checked="checked">
          <label for="streetview_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="streetview" type="radio" value="0" id="streetview_0">
          <label for="streetview_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_SUB2;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="type_control" type="radio" value="1" id="type_control_1">
          <label for="type_control_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="type_control" type="radio" value="0" id="type_control_0" checked="checked">
          <label for="type_control_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->M_ADDRESS;?>
          <i class="icon asterisk"></i></label>
        <textarea placeholder="<?php echo Lang::$word->M_ADDRESS;?>" name="body"></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_PINS;?></label>
        <div class="scrollbox h200">
          <div class="row grid phone-1 mobile-2 tablet-3 screen-4 small gutters" id="pinMode">
            <?php foreach($this->pins as $k => $row):?>
            <div class="columns<?php echo ($k == 0) ? " highlite" :'';?>">
              <a data-type="<?php echo $row;?>"><img src="<?php echo FMODULEURL;?>gmaps/view/images/pins/<?php echo $row;?>" alt="" class="wojo inline image"></a>
            </div>
            <?php endforeach;?>
            <?php unset($row);?>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GM_SUB4;?></label>
        <div class="row grid phone-1 mobile-2 tablet-3 screen-4 gutters" id="layoutMode">
          <?php foreach($this->styles as $row):?>
          <div class="columns">
            <div class="wojo fitted simple attached segment<?php echo ("basic" == pathinfo($row, PATHINFO_FILENAME)) ? " active" :'';?>"><a data-type="<?php echo pathinfo($row, PATHINFO_FILENAME);?>"><img src="<?php echo AMODULEURL;?>gmaps/view/images/styles/<?php echo $row;?>" alt=""></a>
            </div>
          </div>
          <?php endforeach;?>
          <?php unset($row);?>
        </div>
      </div>
    </div>
    <div class="wojo auto wide divider"></div>
    <div class="wojo fields">
      <div class="field">
        <div class="wojo action icon input">
          <i class="icon small find"></i>
          <input name="address" placeholder="<?php echo Lang::$word->_MOD_GM_SUB5;?>" type="text">
          <button type="button" name="find_address" class="wojo small primary inverted button"><?php echo Lang::$word->FIND;?></button>
        </div>
        <div class="wojo space divider"></div>
        <div class="wojo basic attached segment h400" id="google_map"></div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "gmaps/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/gmaps" data-action="processMap" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_GM_SUB7;?></button>
  </div>
  <input type="hidden" name="layout" value="basic">
  <input type="hidden" name="lat" value="43.6532">
  <input type="hidden" name="lng" value="-79.3832">
  <input type="hidden" name="pin" value="basic">
</form>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?php echo App::Core()->mapapi;?>"></script>
<script src="<?php echo AMODULEURL;?>gmaps/view/js/gmaps.js"></script>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Gmaps({
		  url: "<?php echo AMODULEURL;?>gmaps/controller.php",
		  murl: "<?php echo AMODULEURL;?>gmaps/",
		  furl: "<?php echo FMODULEURL;?>gmaps/",
	  });
  });
// ]]>
</script>