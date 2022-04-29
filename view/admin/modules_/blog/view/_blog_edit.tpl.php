<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _blog_edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_DS_META_T6;?></h2>
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
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->ITEMSLUG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->ITEMSLUG;?>" value="<?php echo $this->data->{'slug_' . $lang->abbr};?>" name="slug_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"><?php echo Url::out_url($this->data->{'body_' . $lang->abbr});?></textarea>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->METAKEYS;?><small><?php echo $lang->abbr;?></small></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords_<?php echo $lang->abbr;?>"><?php echo $this->data->{'keywords_' . $lang->abbr};?></textarea>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->METADESC;?><small><?php echo $lang->abbr;?></small></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description_<?php echo $lang->abbr;?>"><?php echo $this->data->{'description_' . $lang->abbr};?></textarea>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->_MOD_AM_SUB2;?><small><?php echo $lang->abbr;?></small></label>
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_AM_SUB2;?>" class="wojo tags" value="<?php echo $this->data->{'tags_' . $lang->abbr};?>" name="tags_<?php echo $lang->abbr?>">
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
        <label><?php echo Lang::$word->PAG_MEMLVL;?></label>
        <a data-wdropdown="#membership_id" class="wojo light right button"><?php echo Lang::$word->M_SUB8;?>
        <i class="icon chevron down"></i></a>
        <div class="wojo static dropdown small pointing top-left" id="membership_id">
          <div class="mw400">
            <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
              <?php echo Utility::loopOptionsMultiple($this->membership_list, "id", "title" . Lang::$lang, $this->data->membership_id, "membership_id");?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->CATEGORIES;?></label>
        <div class="wojo attached segment">
          <div class="scrollbox h300">
            <div class="wojo relaxed divided list">
              <?php echo $this->droplist;?>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->MAINIMAGE;?></label>
        <input type="file" name="thumb" data-type="image" data-exist="<?php echo Blog::hasThumb($this->data->thumb, $this->data->id);?>" accept="image/png, image/jpeg">
        <div class="vertical margin">
          <label class="label"><?php echo Lang::$word->_MOD_AM_SUB1;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_AM_SUB1;?>" value="<?php echo $this->data->caption;?>" name="caption">
        </div>
        <label><?php echo Lang::$word->FILE;?></label>
        <div class="row horizontal gutters">
          <div class="columns auto">
            <input type="file" data-input="false" data-badge="true" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="file" id="file" class="filestyle">
          </div>
          <div class="columns">
            <a id="removeFile" class="wojo negative icon button"><i class="icon close"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB3;?></label>
        <div class="row grid phone-1 tablet-2 screen-4 gutters" id="layoutMode">
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->layout, 1); ?>">
              <a data-type="1"><img src="<?php echo AMODULEURL;?>blog/view/images/align_left.png" alt=""></a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->layout, 2); ?>">
              <a data-type="2"><img src="<?php echo AMODULEURL;?>blog/view/images/align_right.png" alt=""></a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->layout, 3); ?>">
              <a data-type="3"><img src="<?php echo AMODULEURL;?>blog/view/images/align_top.png" alt=""></a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned <?php Validator::getActive($this->data->layout, 4); ?>">
              <a data-type="4"><img src="<?php echo AMODULEURL;?>blog/view/images/align_bottom.png" alt=""></a>
            </div>
          </div>
        </div>
        <input type="hidden" name="layout" value="<?php echo $this->data->layout;?>">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB6;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_created" type="radio" value="1" id="show_created_1" <?php Validator::getChecked($this->data->show_created, 1); ?>>
          <label for="show_created_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_created" type="radio" value="0" id="show_created_0" <?php Validator::getChecked($this->data->show_created, 0); ?>>
          <label for="show_created_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB7;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_author" type="radio" value="1" id="show_author_1" <?php Validator::getChecked($this->data->show_author, 1); ?>>
          <label for="show_author_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_author" type="radio" value="0" id="show_author_0" <?php Validator::getChecked($this->data->show_author, 0); ?>>
          <label for="show_author_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB8;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_ratings" type="radio" value="1" id="show_ratings_1" <?php Validator::getChecked($this->data->show_ratings, 1); ?>>
          <label for="show_ratings_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_ratings" type="radio" value="0" id="show_ratings_0" <?php Validator::getChecked($this->data->show_ratings, 0); ?>>
          <label for="show_ratings_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB9;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_comments" type="radio" value="1" id="show_comments_1" <?php Validator::getChecked($this->data->show_comments, 1); ?>>
          <label for="show_comments_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_comments" type="radio" value="0" id="show_comments_0" <?php Validator::getChecked($this->data->show_comments, 0); ?>>
          <label for="show_comments_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB10;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_like" type="radio" value="1" id="show_like_1" <?php Validator::getChecked($this->data->show_like, 1); ?>>
          <label for="show_like_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_like" type="radio" value="0" id="show_like_0" <?php Validator::getChecked($this->data->show_like, 0); ?>>
          <label for="show_like_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB11;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_sharing" type="radio" value="1" id="show_sharing_1" <?php Validator::getChecked($this->data->show_sharing, 1); ?>>
          <label for="show_sharing_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_sharing" type="radio" value="0" id="show_sharing_0" <?php Validator::getChecked($this->data->show_sharing, 0); ?>>
          <label for="show_sharing_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->FM_LASTM;?></label>
        <input name="time_start" type="text" placeholder="<?php echo Lang::$word->FM_LASTM;?>" value="<?php echo Date::doDate("long_date", $this->data->modified);?>" disabled>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
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
  <div class="wojo form segment">
    <div class="field">
      <label><?php echo Lang::$word->IMAGES;?></label>
      <input type="file" name="images" id="images"  data-input="false" data-buttonClass="secondary" data-buttonText="<?php echo Lang::$word->MULTIPLE;?>" data-fields='{"action":"processImages","id":<?php echo $this->data->id;?>}' class="filestyle" multiple>
      <div class="scrollbox margin top h300">
        <div class="row grid phone-1 mobile-2 tablet-3 screen-5 gutters" id="sortable">
          <?php if($this->images):?>
          <?php foreach ($this->images as $i => $irow):?>
          <div class="columns" id="item_<?php echo $irow->id;?>" data-id="<?php echo $irow->id;?>">
            <div class="wojo attached fitted segment center aligned"><img src="<?php echo Blog::hasThumb($irow->name, $this->data->id);?>" alt="" class="wojo normal center image">
              <a data-set='{"option":[{"delete": "deleteImage","id":<?php echo $irow->id;?>}], "url":"/modules_/blog/controller.php","action":"delete", "parent":"#item_<?php echo $irow->id;?>"}' class="wojo small icon white middle attached button data">
              <i class="icon trash"></i></a>
            </div>
          </div>
          <?php endforeach;?>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "blog/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/blog" data-action="processItem" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_AM_UPDATEITM;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>