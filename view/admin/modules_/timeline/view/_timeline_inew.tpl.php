<?php
  /**
   * Timeline
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _timeline_inew.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_TML_SUB11;?></h2>
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
          <div class="wojo block fields">
            <div class="field">
              <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>"  name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field">
              <div id="bodyfield">
                <textarea class="altpost" name="body_<?php echo $lang->abbr;?>"></textarea>
              </div>
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
        <label><?php echo Lang::$word->_MOD_TML_SUB14;?></label>
        <select name="type" id="tmType">
          <option value="blog_post"><?php echo Lang::$word->_MOD_TML_TYPE_B;?></option>
          <option value="iframe"><?php echo Lang::$word->_MOD_TML_TYPE_I;?></option>
          <option value="gallery"><?php echo Lang::$word->_MOD_TML_TYPE_G;?></option>
        </select>
      </div>
      <div class="field">
      </div>
    </div>
    <div class="hide-all" id="iframe">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_TML_IURL;?></label>
          <div class="wojo labeled input">
            <div class="wojo simple label"> http: </div>
            <input placeholder="<?php echo Lang::$word->_MOD_TML_IURL;?>" type="text" name="dataurl">
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_MOD_TML_IHEIGHT;?></label>
          <div class="wojo labeled input">
            <input placeholder="<?php echo Lang::$word->_MOD_TML_IHEIGHT;?>" value="300" type="text" name="height">
            <div class="wojo simple label">px</div>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_TML_RMORE;?></label>
        <div class="wojo labeled input">
          <div class="wojo simple label"> http: </div>
          <input placeholder="<?php echo Lang::$word->_MOD_TML_RMORE;?>" type="text" name="readmore">
        </div>
      </div>
    </div>
    <div id="imgfield">
      <a class="multipick wojo primary button"><i class="open folder icon"></i><?php echo Lang::$word->_MOD_TML_SUB16;?></a>
      <div class="row phone-1 mobile-2 tablet-3 screen-4 gutters margin top" id="sortable"></div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules/timeline/items", $this->row->id);?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/timeline" data-action="processItem" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_TML_SUB17;?></button>
  </div>
  <input type="hidden" name="tid" value="<?php echo $this->row->id;?>">
</form>