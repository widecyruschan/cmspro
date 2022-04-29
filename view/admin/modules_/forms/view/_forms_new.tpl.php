<?php
  /**
   * Forms
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _forms_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_VF_ADD;?></h2>
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
              <label><?php echo Lang::$word->_MOD_VF_SUBJECT;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->_MOD_VF_SUBJECT;?>" name="subject_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->_MOD_VF_SUB3;?><small><?php echo $lang->abbr;?></small></label>
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_VF_SUB3;?>" name="sendmessage_<?php echo $lang->abbr?>">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->_MOD_VF_SUB2;?><small><?php echo $lang->abbr;?></small></label>
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_VF_SUB2;?>" name="sbutton_<?php echo $lang->abbr?>">
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="wojo wide divider"></div>
    <div class="content">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_VF_SUB4;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_VF_SUB4;?>" name="mailto">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_MOD_VF_SUB6;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="captcha" type="radio" value="1" id="captcha_1" checked="checked">
            <label for="captcha_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="captcha" type="radio" value="0" id="captcha_0">
            <label for="captcha_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_VF_SUB5;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_VF_SUB5;?>" class="wojo tags" name="emails">
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "forms/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/forms" data-action="processForm" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_VF_NEW;?></button>
  </div>
</form>