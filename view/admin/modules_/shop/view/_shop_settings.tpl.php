<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _SP_edit.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_SP_META_T3;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_LIKE;?></label>
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
        <label><?php echo Lang::$word->_MOD_SP_COMMENTS;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="comments" type="radio" value="1" id="comments_1" <?php Validator::getChecked($this->data->comments, 1); ?>>
          <label for="comments_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="comments" type="radio" value="0" id="comments_0" <?php Validator::getChecked($this->data->comments, 0); ?>>
          <label for="comments_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB32;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="auto_approve" type="radio" value="1" id="auto_approve_1" <?php Validator::getChecked($this->data->auto_approve, 1); ?>>
          <label for="auto_approve_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="auto_approve" type="radio" value="0" id="auto_approve_0" <?php Validator::getChecked($this->data->auto_approve, 0); ?>>
          <label for="auto_approve_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB2;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="layout" type="radio" value="1" id="layout_1" <?php Validator::getChecked($this->data->layout, 1); ?>>
          <label for="layout_1"><?php echo Lang::$word->LIST;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="layout" type="radio" value="0" id="layout_0" <?php Validator::getChecked($this->data->layout, 0); ?>>
          <label for="layout_0"><?php echo Lang::$word->GRID;?></label>
        </div>
      </div>
    </div>
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
      <div class="field">
        <label>
          <?php echo Lang::$word->_MOD_SP_SUB40;?></label>
        <select name="length">
          <?php echo Utility::loopOptionsSimpleAlt(Shop::lenghtClass(), $this->data->length);?>
        </select>
      </div>
      <div class="field">
        <label>
          <?php echo Lang::$word->_MOD_SP_SUB41;?></label>
        <select name="weight">
          <?php echo Utility::loopOptionsSimpleAlt(Shop::weightClass(), $this->data->weight);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB47;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="catalog" type="radio" value="1" id="catalog_1" <?php Validator::getChecked($this->data->catalog, 1); ?>>
          <label for="catalog_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="catalog" type="radio" value="0" id="catalog_0" <?php Validator::getChecked($this->data->catalog, 0); ?>>
          <label for="catalog_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_LP;?></label>
        <input name="fpp" type="range" min="5" max="20" step="1" value="<?php echo $this->data->fpp;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_IPC;?></label>
        <input name="ipp" type="range" min="5" max="20" step="1" value="<?php echo $this->data->ipp;?>" hidden data-suffix=" itm">
      </div>
    </div>
    <div class="wojo space divider"></div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB23;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_counter" type="radio" value="1" id="show_counter_1" <?php Validator::getChecked($this->data->show_counter, 1); ?>>
          <label for="show_counter_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_counter" type="radio" value="0" id="show_counter_0" <?php Validator::getChecked($this->data->show_counter, 0); ?>>
          <label for="show_counter_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB24;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="username_req" type="radio" value="1" id="username_req_1" <?php Validator::getChecked($this->data->username_req, 1); ?>>
          <label for="username_req_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="username_req" type="radio" value="0" id="username_req_0" <?php Validator::getChecked($this->data->username_req, 0); ?>>
          <label for="username_req_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB25;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_captcha" type="radio" value="1" id="show_captcha_1" <?php Validator::getChecked($this->data->show_captcha, 1); ?>>
          <label for="show_captcha_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_captcha" type="radio" value="0" id="show_captcha_0" <?php Validator::getChecked($this->data->show_captcha, 0); ?>>
          <label for="show_captcha_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB26;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_www" type="radio" value="1" id="show_www_1" <?php Validator::getChecked($this->data->show_www, 1); ?>>
          <label for="show_www_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_www" type="radio" value="0" id="show_www_0" <?php Validator::getChecked($this->data->show_www, 0); ?>>
          <label for="show_www_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB27;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_username" type="radio" value="1" id="show_username_1" <?php Validator::getChecked($this->data->show_username, 1); ?>>
          <label for="show_username_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_username" type="radio" value="0" id="show_username_0" <?php Validator::getChecked($this->data->show_username, 0); ?>>
          <label for="show_username_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB31;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="notify_new" type="radio" value="1" id="notify_new_1" <?php Validator::getChecked($this->data->notify_new, 1); ?>>
          <label for="notify_new_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="notify_new" type="radio" value="0" id="notify_new_0" <?php Validator::getChecked($this->data->notify_new, 0); ?>>
          <label for="notify_new_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB29;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="public_access" type="radio" value="1" id="public_access_1" <?php Validator::getChecked($this->data->public_access, 1); ?>>
          <label for="public_access_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="public_access" type="radio" value="0" id="public_access_0" <?php Validator::getChecked($this->data->public_access, 0); ?>>
          <label for="public_access_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB30;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="email_req" type="radio" value="1" id="email_req_1" <?php Validator::getChecked($this->data->email_req, 1); ?>>
          <label for="email_req_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="email_req" type="radio" value="0" id="email_req_0" <?php Validator::getChecked($this->data->email_req, 0); ?>>
          <label for="email_req_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB34;?></label>
        <select name="sorting">
          <option value="DESC" <?php Validator::getSelected($this->data->sorting, "DESC"); ?>><?php echo Lang::$word->_MOD_SP_SUB35;?></option>
          <option value="ASC" <?php Validator::getSelected($this->data->sorting, "ASC"); ?>><?php echo Lang::$word->_MOD_SP_SUB35_1;?></option>
        </select>
        <div class="vertical margin">
          <label class="label"><?php echo Lang::$word->_MOD_SP_SUB37;?></label>
          <input name="char_limit" type="range" min="10" max="300" step="10" value="<?php echo $this->data->char_limit;?>" hidden data-suffix=" char">
        </div>
        <label><?php echo Lang::$word->_MOD_SP_CPP;?></label>
        <input name="comperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->comperpage;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB36;?></label>
        <select name="cdateformat">
          <?php echo Date::getShortDate($this->data->cdateformat);?>
          <?php echo Date::getLongDate($this->data->cdateformat);?>
        </select>
        <div class="top margin">
          <label class="label"><?php echo Lang::$word->_MOD_SP_SUB39;?></label>
          <textarea placeholder="<?php echo Lang::$word->_MOD_SP_SUB39;?>" name="blacklist_words"><?php echo $this->data->blacklist_words;?></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <h4>
      <?php echo Lang::$word->_MOD_SP_SHIPOPTS;?>
    </h4>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_FREE_SHIPPING_OVER;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
          <input placeholder="<?php echo Lang::$word->_MOD_SP_FREE_SHIPPING_OVER;?>" value="<?php echo $this->data->allow_free_shipping_over;?>" name="allow_free_shipping_over" type="text">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_DISCOUNT_SHIPPING;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <input placeholder="<?php echo Lang::$word->_MOD_SP_DISCOUNT_SHIPPING;?>" value="<?php echo $this->data->discount_shipping;?>" name="discount_shipping" type="text">
          <div class="wojo simple label"> % </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_HANDLING_CHARGE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
          <input placeholder="<?php echo Lang::$word->_MOD_SP_HANDLING_CHARGE;?>" value="<?php echo $this->data->handling_charge;?>" name="handling_charge" type="text">
        </div>
      </div>
    </div>
    <div id="shop-shipping-options">
      <?php if($this->shipping):?>
      <?php foreach($this->shipping as $shpid => $row):?>
      <div class="shop-shipping-wrapper">
        <h4>
          <?php echo $row->id;?>.</h4>
        <div class="wojo fields align middle">
          <div class="field">
            <label><?php echo Lang::$word->NAME;?></label>
            <input placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $row->name;?>" name="shipping_opt[<?php echo $row->id;?>][name]" type="text">
            <input placeholder="<?php echo Lang::$word->DESCRIPTION;?>" value="<?php echo $row->desc;?>" name="shipping_opt[<?php echo $row->id;?>][desc]" type="text">
          </div>
          <div class="field">
            <label><?php echo Lang::$word->ACTIVE;?></label>
            <div class="wojo checkbox radio fitted inline">
              <input name="shipping_opt[<?php echo $row->id;?>][active]" type="radio" value="1" id="active_<?php echo $row->id;?>1" <?php Validator::getChecked($row->active, 1); ?>>
              <label for="active_<?php echo $row->id;?>1"><?php echo Lang::$word->YES;?></label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="shipping_opt[<?php echo $row->id;?>][active]" type="radio" value="0" id="active_<?php echo $row->id;?>0" <?php Validator::getChecked($row->active, 0); ?>>
              <label for="active_<?php echo $row->id;?>0"><?php echo Lang::$word->NO;?></label>
            </div>
          </div>
          <div class="field">
            <a class="wojo small negative fluid button removeShipping"><?php echo Lang::$word->REMOVE;?></a>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
    <div class="wojo fields">
      <div class="field">
        <a id="addShippOption" class="wojo small dark button"><?php echo Lang::$word->_MOD_SP_ADDSHIP;?></a>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "shop/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/shop" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_SP_UPDATECONF;?></button>
  </div>
</form>
<div id="shop-shipping-option-prototype" class=" hide-all">
  <div class="shop-shipping-wrapper">
    <h4>1.</h4>
    <div class="wojo fields align middle">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?></label>
        <input placeholder="<?php echo Lang::$word->NAME;?>" value="" name="shipping_opt_name" type="text">
        <input placeholder="<?php echo Lang::$word->DESCRIPTION;?>" value="" name="shipping_opt_desc" type="text">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->ACTIVE;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="shipping_opt_active_0" type="radio" value="1" checked="checked">
          <label for="active_0"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="shipping_opt_active_1" type="radio" value="0">
          <label for="active_1"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <a class="wojo negative small fluid button removeShipping"><?php echo Lang::$word->REMOVE;?></a>
      </div>
    </div>
  </div>
</div>