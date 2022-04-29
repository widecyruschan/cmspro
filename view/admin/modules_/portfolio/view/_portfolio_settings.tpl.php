<?php
  /**
   * Portfolio
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _portfolio_settings.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_PF_SUB4;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->THUMB_W;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <input placeholder="<?php echo Lang::$word->THUMB_W;?>" value="<?php echo $this->data->thumb_w;?>" name="thumb_w" type="text">
          <div class="wojo simple label"> px </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->THUMB_H;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <input placeholder="<?php echo Lang::$word->THUMB_H;?>" value="<?php echo $this->data->thumb_h;?>" name="thumb_h" type="text">
          <div class="wojo simple label"> px </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB8;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_cats" type="radio" value="1" id="show_cats_1" <?php Validator::getChecked($this->data->show_cats, 1); ?>>
          <label for="show_cats_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_cats" type="radio" value="0" id="show_cats_0" <?php Validator::getChecked($this->data->show_cats, 0); ?>>
          <label for="show_cats_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB9;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_sort" type="radio" value="1" id="show_sort_1" <?php Validator::getChecked($this->data->show_sort, 1); ?>>
          <label for="show_sort_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_sort" type="radio" value="0" id="show_sort_0" <?php Validator::getChecked($this->data->show_sort, 0); ?>>
          <label for="show_sort_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB10;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_featured" type="radio" value="1" id="show_featured_1" <?php Validator::getChecked($this->data->show_featured, 1); ?>>
          <label for="show_featured_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_featured" type="radio" value="0" id="show_featured_0" <?php Validator::getChecked($this->data->show_featured, 0); ?>>
          <label for="show_featured_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB12;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="social" type="radio" value="1" id="social_1" <?php Validator::getChecked($this->data->social, 1); ?>>
          <label for="social_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="social" type="radio" value="0" id="social_0" <?php Validator::getChecked($this->data->social, 0); ?>>
          <label for="social_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB13;?></label>
        <input name="latest" type="range" min="1" max="20" step="5" value="<?php echo $this->data->latest;?>" hidden data-suffix=" itm" data-type="labels" data-labels="1,5,10,15,20">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB5;?></label>
        <input name="ipc" type="range" min="1" max="20" step="5" value="<?php echo $this->data->ipc;?>" hidden data-suffix=" itm" data-type="labels" data-labels="1,5,10,15,20">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB6;?></label>
        <input name="fpp" type="range" min="1" max="20" step="5" value="<?php echo $this->data->fpp;?>" hidden data-suffix=" itm" data-type="labels" data-labels="1,5,10,15,20">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GA_COLS;?>
          <i class="icon asterisk"></i></label>
        <input name="cols" type="range" min="2" max="6" step="1" value="<?php echo $this->data->cols;?>" hidden data-suffix=" cols" data-type="labels" data-labels="2,4,6">
      </div>
    </div>
    <div class="wojo auto wide divider"></div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB7;?></label>
        <div class="row grid phone-1 mobile-2 tablet-2 screen-2 gutters" id="layoutMode">
          <div class="columns center aligned">
            <div class="wojo simple attached segment<?php echo ($this->data->layout == "grid") ? " active" :'';?>"><a data-type="grid"><img src="<?php echo AMODULEURL;?>portfolio/view/images/grid.png" alt=""></a>
              <p class="">Grid</p>
            </div>
          </div>
          <div class="columns center aligned">
            <div class="wojo simple attached segment<?php echo ($this->data->layout == "list") ? " active" :'';?>"><a data-type="list"><img src="<?php echo AMODULEURL;?>portfolio/view/images/list.png" alt=""></a>
              <p class="">List</p>
            </div>
          </div>
        </div>
        <input type="hidden" name="layout" value="<?php echo $this->data->layout;?>">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "portfolio/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/portfolio" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>