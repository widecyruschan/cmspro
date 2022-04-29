<?php
  /**
   * Timeline
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _timeline_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_TML_NEW;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_LMODE;?></label>
        <select name="colmode">
          <?php echo Utility::loopOptionsSimpleAlt($this->layoutlist);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB3;?></label>
        <input name="limiter" type="range" min="5" max="50" step="5" value="5" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB4;?></label>
        <input name="maxitems" type="range" min="0" max="20" step="1" value="0" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB5;?></label>
        <input name="showmore" type="range" min="0" max="20" step="1" value="0" hidden data-suffix=" itm">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB9;?></label>
        <select name="type">
          <?php echo Utility::loopOptionsSimpleAlt($this->typelist);?>
        </select>
      </div>
      <div class="field">
      </div>
    </div>
    <div id="rssconf" class="hide-all">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_TML_SUB8;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_TML_SUB8;?>" name="rssurl">
        </div>
        <div class="field">
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "timeline/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/timeline" data-action="processTimeline" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_TML_NEW;?></button>
  </div>
</form>
