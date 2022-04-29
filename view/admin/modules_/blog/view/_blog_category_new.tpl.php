<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _blog_category_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_AM_SUB12;?></h2>
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
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->CATSLUG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->CATSLUG;?>" name="slug_<?php echo $lang->abbr;?>">
              </div>
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
        <label><?php echo Lang::$word->_MOD_AM_SUB13;?></label>
        <select id="parent_id" name="parent_id">
          <option value="0"><?php echo Lang::$word->MEN_SUB;?></option>
          <?php echo $this->droplist;?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PUBLISHED;?></label>
        <div class="wojo checkbox toggle fitted inline">
          <input name="active" type="radio" value="1" id="active_1" checked="checked">
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox toggle fitted inline">
          <input name="active" type="radio" value="0" id="active_0">
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo form card" id="mSort">
      <div id="sortlist" class="dd">
        <?php if($this->droplist) : echo $this->sortlist; endif;?>
      </div>
    </div>
    <div class="wojo block fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB15;?></label>
        <div class="row grid phone-1 tablet-2 tablet-4 screen-4 gutters" id="layoutMode">
          <div class="columns">
            <div class="wojo simple attached segment center aligned active">
              <a data-type="1" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/list.svg" alt="">
              </a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned">
              <a data-type="2" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/modern.svg" alt="">
              </a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned">
              <a data-type="3" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/masonry.svg" alt="">
              </a>
            </div>
          </div>
          <div class="columns">
            <div class="wojo simple attached segment center aligned">
              <a data-type="4" class="wojo normal basic image">
              <img src="<?php echo AMODULEURL;?>blog/view/images/classic.svg" alt="">
              </a>
            </div>
          </div>
        </div>
        <input type="hidden" name="layout" value="1">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB17;?></label>
        <input name="perpage" type="range" min="5" max="20" step="1" value="10" hidden data-suffix=" itm">
      </div>
    </div>
    <div class="wojo wide auto divider"></div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_AM_SUB16;?></label>
        <div class="scrollbox h400" id="cIcons">
          <?php include(ADMINBASE . "/snippets/icons.tpl.php");?>
        </div>
        <input name="icon" type="hidden">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules/blog");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/blog" data-action="processCategory" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_AM_SUB14;?></button>
  </div>
</form>
<script src="<?php echo SITEURL;?>/assets/nestable.js"></script>