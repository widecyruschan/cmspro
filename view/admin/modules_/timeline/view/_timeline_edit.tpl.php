<?php
  /**
   * Timeline
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _timeline_edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_TML_SUB;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->name;?>" name="name">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_LMODE;?></label>
        <select name="colmode">
          <?php echo Utility::loopOptionsSimpleAlt($this->layoutlist, $this->data->colmode);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB3;?></label>
        <input name="limiter" type="range" min="5" max="50" step="5" value="<?php echo $this->data->limiter;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB4;?></label>
        <input name="maxitems" type="range" min="0" max="20" step="1" value="<?php echo $this->data->maxitems;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB5;?></label>
        <input name="showmore" type="range" min="0" max="20" step="1" value="<?php echo $this->data->showmore;?>" hidden data-suffix=" itm">
      </div>
    </div>
    <?php if($this->data->type == "rss"):?>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_SUB8;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_TML_SUB8;?>" value="<?php echo $this->data->rssurl;?>" name="rssurl">
      </div>
    </div>
    <?php endif;?>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "timeline/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/timeline" data-action="processTimeline" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_TML_SUB2;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
  <input type="hidden" name="type" value="<?php echo $this->data->type;?>">
</form>