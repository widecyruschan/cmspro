<?php
  /**
   * Portfolio
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _portfolio_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_PF_SUB2;?></h2>
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
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->ITEMSLUG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo large basic input">
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
        <label><?php echo Lang::$word->_MOD_PF_SUB1;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_PF_SUB1;?>" name="client">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->CATEGORY;?></label>
        <select name="category_id">
          <?php echo Utility::loopOptions($this->categories, "id", "name" . Lang::$lang);?>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->FILE;?></label>
        <input type="file" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="file" id="file" class="filestyle" data-input="false" data-badge="true">
        <div class="margin top">
          <label class="label"><?php echo Lang::$word->CREATED;?></label>
          <div class="wojo icon input">
            <input name="created" type="text" placeholder="<?php echo Lang::$word->CREATED;?>" value="<?php echo Date::doDate("calendar", Date::today());?>" readonly class="datepick">
            <i class="icon date"></i>
          </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->MAINIMAGE;?></label>
        <input type="file" name="thumb" data-type="image" accept="image/png, image/jpeg">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_PF_SUB11;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="is_featured" type="radio" value="1" id="is_featured_1" checked="checked">
          <label for="is_featured_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="is_featured" type="radio" value="0" id="is_featured_0">
          <label for="is_featured_0"><?php echo Lang::$word->NO;?></label>
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
      <input type="file" name="images" id="images"  data-input="false" data-buttonText="<?php echo Lang::$word->MULTIPLE;?>" data-fields='{"action":"processImages","id":<?php echo App::Session()->get("foliotoken");?>}' class="filestyle" multiple>
      <div class="scrollbox margin top h300">
        <div class="row grid phone-1 mobile-2 tablet-3 screen-5 gutters" id="sortable"></div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "portfolio/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/portfolio" data-action="processItem" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_PF_NEWITM;?></button>
  </div>
</form>