<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _blog_settings.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_AM_SUB18;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB19;?></label>
        <input name="fperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->fperpage;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB20;?></label>
        <input name="latestperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->latestperpage;?>" hidden data-suffix=" itm">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB21;?></label>
        <input name="popperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->popperpage;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB22;?></label>
        <input name="comperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->comperpage;?>" hidden data-suffix=" itm">
      </div>
    </div>
    <div class="wojo space divider"></div>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB23;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB24;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB25;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB26;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB27;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB28;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="upost" type="radio" value="1" id="upost_1" <?php Validator::getChecked($this->data->upost, 1); ?>>
          <label for="upost_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="upost" type="radio" value="0" id="upost_0" <?php Validator::getChecked($this->data->upost, 0); ?>>
          <label for="upost_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB29;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB30;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB31;?></label>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB32;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="auto_approve" type="radio" value="1" id="auto_approve_1" <?php Validator::getChecked($this->data->auto_approve, 1); ?>>
          <label for="auto_approve_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="auto_approve" type="radio" value="0" id="auto_approve_0" <?php Validator::getChecked($this->data->auto_approve, 0); ?>>
          <label for="auto_approve_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB33;?></label>
        <div class="row grid phone-1 tablet-2 tablet-4 screen-4 gutters" id="layoutMode">
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->flayout, 1); ?>">
              <a data-type="1" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/list.svg" alt="">
              </a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->flayout, 2); ?>">
              <a data-type="2" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/modern.svg" alt="">
              </a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->flayout, 3); ?>">
              <a data-type="3" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/masonry.svg" alt="">
              </a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->flayout, 4); ?>">
              <a data-type="4" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/classic.svg" alt="">
              </a>
            </div>
          </div>
        </div>
        <input type="hidden" name="flayout" value="<?php echo $this->data->flayout;?>">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB34;?></label>
        <select name="sorting">
          <option value="DESC" <?php Validator::getSelected($this->data->sorting, "DESC"); ?>><?php echo Lang::$word->_MOD_AM_SUB35;?></option>
          <option value="ASC" <?php Validator::getSelected($this->data->sorting, "ASC"); ?>><?php echo Lang::$word->_MOD_AM_SUB35_1;?></option>
        </select>
        <div class="wojo big space divider"></div>
        <label><?php echo Lang::$word->_MOD_AM_SUB37;?></label>
        <input name="char_limit" type="range" min="10" max="300" step="10" value="<?php echo $this->data->char_limit;?>" hidden data-suffix=" char">
        <div class="wojo huge space divider"></div>
        <label><?php echo Lang::$word->_MOD_AM_SUB38;?></label>
        <input name="cperpage" type="range" min="5" max="20" step="1" value="<?php echo $this->data->cperpage;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB36;?></label>
        <select name="cdateformat" class="wojo fluid dropdown">
          <?php echo Date::getShortDate($this->data->cdateformat);?>
          <?php echo Date::getLongDate($this->data->cdateformat);?>
        </select>
        <div class="wojo space divider"></div>
        <label><?php echo Lang::$word->_MOD_AM_SUB39;?></label>
        <textarea placeholder="<?php echo Lang::$word->_MOD_AM_SUB39;?>" name="blacklist_words"><?php echo $this->data->blacklist_words;?></textarea>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "blog/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/blog" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>