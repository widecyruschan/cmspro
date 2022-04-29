<?php
  /**
   * Membership Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _memberships_edit.tpl.php, v1.00 2020-07-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->META_T5;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form card">
    <div class="wojo lang tabs">
      <ul class="nav">
        <?php foreach($this->langlist as $lang):?>
        <li<?php echo ($lang->abbr == $this->core->lang) ? ' class="active"' : null;?>><a class="lang-color <?php echo Utility::colorToWord($lang->color);?>" data-tab="lang_<?php echo $lang->abbr;?>"><span class="flag icon <?php echo $lang->abbr;?>"></span><?php echo $lang->name;?></a>
        </li>
        <?php endforeach;?>
      </ul>
      <div class="tab gutters">
        <?php foreach($this->langlist as $lang):?>
        <div data-tab="lang_<?php echo $lang->abbr;?>" class="item">
          <div class="wojo fields">
            <div class="field five wide">
              <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" value="<?php echo $this->data->{'description_' . $lang->abbr};?>" name="description_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="wojo segment form">
    <div class="row">
      <div class="columns screen-70 tablet-70 mobile-100 phone-100">
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->MEM_PRICE;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <div class="wojo labeled input">
              <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
              <input type="text" placeholder="<?php echo Lang::$word->MEM_PRICE;?>" value="<?php echo $this->data->price;?>" name="price">
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->MEM_DAYS;?>
              <i class="icon asterisk"></i></label>
          </div>
          <div class="field">
            <div class="wojo input">
              <input type="text" placeholder="<?php echo Lang::$word->MEM_DAYS;?>" value="<?php echo $this->data->days;?>" name="days">
              <select name="period">
                <?php echo Utility::loopOptionsSimpleAlt(Date::getMembershipPeriod(), $this->data->period);?>
              </select>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->MEM_PRIVATE;?></label>
          </div>
          <div class="field">
            <div class="wojo checkbox radio fitted inline">
              <input name="private" type="radio" value="1" id="private_1" <?php Validator::getChecked($this->data->private, 1); ?>>
              <label for="private_1"><?php echo Lang::$word->YES;?></label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="private" type="radio" value="0" id="private_0" <?php Validator::getChecked($this->data->private, 0); ?>>
              <label for="private_0"><?php echo Lang::$word->NO;?></label>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->MEM_REC;?></label>
          </div>
          <div class="field">
            <div class="wojo checkbox radio fitted inline">
              <input name="recurring" type="radio" value="1" id="recurring_1" <?php Validator::getChecked($this->data->recurring, 1); ?>>
              <label for="recurring_1"><?php echo Lang::$word->YES;?></label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="recurring" type="radio" value="0" id="recurring_0" <?php Validator::getChecked($this->data->recurring, 0); ?>>
              <label for="recurring_0"><?php echo Lang::$word->NO;?></label>
            </div>
          </div>
        </div>
        <div class="wojo fields align middle">
          <div class="field four wide labeled">
            <label><?php echo Lang::$word->PUBLISHED;?></label>
          </div>
          <div class="field">
            <div class="wojo checkbox radio fitted inline">
              <input name="active" type="radio" value="1" id="active_1" <?php Validator::getChecked($this->data->active, 1); ?>>
              <label for="active_1"><?php echo Lang::$word->YES;?></label>
            </div>
            <div class="wojo checkbox radio fitted inline">
              <input name="active" type="radio" value="0" id="active_0" <?php Validator::getChecked($this->data->active, 0); ?>>
              <label for="active_0"><?php echo Lang::$word->NO;?></label>
            </div>
          </div>
        </div>
      </div>
      <div class="columns screen-30 tablet-30 mobile-100 phone-100">
        <input type="file" name="thumb" data-type="image" data-exist="<?php echo ($this->data->thumb) ? UPLOADURL . '/memberships/' . $this->data->thumb : UPLOADURL . '/default.png';?>" accept="image/png, image/jpeg">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/memberships");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processMembership" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->MEM_SUB2;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
