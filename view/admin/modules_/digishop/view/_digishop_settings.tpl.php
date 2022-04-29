<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _digishop_settings.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_DS_META_T3;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_FILEDIR;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_DS_FILEDIR;?>" value="<?php echo $this->data->filedir;?>" name="filedir">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_FREEDOWN;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="allow_free" type="radio" value="yes" id="allow_free_1" <?php Validator::getChecked($this->data->allow_free, "yes"); ?>>
          <label for="allow_free_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="allow_free" type="radio" value="no" id="allow_free_0" <?php Validator::getChecked($this->data->allow_free, "no"); ?>>
          <label for="allow_free_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_COUNTER;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="catcount" type="radio" value="1" id="catcount_1" <?php Validator::getChecked($this->data->catcount, 1); ?>>
          <label for="catcount_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="catcount" type="radio" value="0" id="catcount_0" <?php Validator::getChecked($this->data->catcount, 0); ?>>
          <label for="catcount_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_LIKE;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="like" type="radio" value="1" id="like_1" <?php Validator::getChecked($this->data->like, 1); ?>>
          <label for="like_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="like" type="radio" value="0" id="like_0" <?php Validator::getChecked($this->data->like, 0); ?>>
          <label for="like_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_COMMENTS;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="comments" type="radio" value="1" id="comments_1" <?php Validator::getChecked($this->data->comments, 1); ?>>
          <label for="comments_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="comments" type="radio" value="0" id="comments_0" <?php Validator::getChecked($this->data->comments, 0); ?>>
          <label for="comments_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->THUMB_W;?>
          <i class="icon asterisk"></i></label>
        <input name="thumb_w" type="range" min="300" max="800" step="10" value="<?php echo $this->data->thumb_w;?>" hidden data-suffix=" px">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->THUMB_H;?>
          <i class="icon asterisk"></i></label>
        <input name="thumb_h" type="range" min="300" max="800" step="10" value="<?php echo $this->data->thumb_h;?>" hidden data-suffix=" px">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_IPR;?>
          <i class="icon asterisk"></i></label>
        <input name="cols" type="range" min="1" max="4" step="1" value="<?php echo $this->data->cols;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_LP;?></label>
        <input name="fpp" type="range" min="1" max="20" step="1" value="<?php echo $this->data->fpp;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_DS_IPC;?></label>
        <input name="ipp" type="range" min="1" max="20" step="1" value="<?php echo $this->data->ipp;?>" hidden data-suffix=" itm">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "digishop/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/digishop" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>