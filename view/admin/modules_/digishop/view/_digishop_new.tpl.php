<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _digishop_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_DS_META_T7;?></h2>
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
            <div class="field">
              <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->ITEMSLUG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->ITEMSLUG;?>" name="slug_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"></textarea>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->METAKEYS;?><small><?php echo $lang->abbr;?></small></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords_<?php echo $lang->abbr;?>"></textarea>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->METADESC;?><small><?php echo $lang->abbr;?></small></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description_<?php echo $lang->abbr;?>"></textarea>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PRICE;?></label>
        <div class="wojo labeled input">
          <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
          <input type="text" placeholder="<?php echo Lang::$word->PRICE;?>" name="price">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PAG_MEMLVL;?></label>
        <a data-wdropdown="#membership_id" class="wojo light right button"><?php echo Lang::$word->M_SUB8;?>
        <i class="icon chevron down"></i></a>
        <div class="wojo static dropdown small pointing top-left" id="membership_id">
          <div class="mw400">
            <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
              <?php echo Utility::loopOptionsMultiple($this->membership_list, "id", "title" . Lang::$lang, '', "membership_id");?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CATEGORIES;?></label>
        <div class="wojo basic segment">
          <div class="scrollbox h300">
            <div class="wojo relaxed divided list">
              <?php echo $this->droplist;?>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->MAINIMAGE;?></label>
        <input type="file" name="thumb" data-class="left" data-type="image" accept="image/png, image/jpeg">
        <div class="vertical margin">
          <label class="label"><?php echo Lang::$word->BGIMG;?></label>
          <input type="file" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="poster" id="poster" class="filestyle" data-input="false" data-badge="true">
        </div>
        <label><?php echo Lang::$word->FILE;?></label>
        <input type="file" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="file" id="file" class="filestyle" data-input="false" data-badge="true">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->DOWNLOADS;?></label>
        <div class="wojo icon input">
          <i class="icon download"></i>
          <input type="text" placeholder="<?php echo Lang::$word->DOWNLOADS;?>" value="-1" name="downloads">
        </div>
        <p class="wojo small text"><strong>-1</strong> <?php echo Lang::$word->_MOD_DS_SUB13;?></p>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB11;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="1" id="active_1" checked="checked">
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="0" id="_0">
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo simple segment">
      <h5><?php echo Lang::$word->CF_TITLE;?></h5>
      <?php echo $this->custom_fields;?></div>
  </div>
  <div class="wojo form segment">
    <div class="field">
      <label><?php echo Lang::$word->IMAGES;?></label>
      <input type="file" name="images" id="images"  data-input="false" data-buttonText="<?php echo Lang::$word->MULTIPLE;?>" data-fields='{"action":"processImages","id":<?php echo App::Session()->get("digitoken");?>}' class="filestyle" multiple>
      <div class="scrollbox margin top h300">
        <div class="row grid phone-1 mobile-2 tablet-3 screen-5 gutters" id="sortable"></div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "digishop/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/digishop" data-action="processItem" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_DS_ADD;?></button>
  </div>
</form>