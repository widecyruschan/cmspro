<?php
  /**
   * Adblock
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _adblock_new.tpl.php, v1.00 2020-04-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_AB_ADD;?></h2>
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
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="content">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_AB_SUB;?>
            <i class="icon asterisk"></i></label>
          <div class="wojo icon input">
            <input id="datefrom" data-rangeto="#dateto" name="start_date" type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB10;?>" value="<?php echo Date::doDate("calendar", Date::today());?>" readonly class="datepick">
            <i class="icon date"></i>
            <input id="dateto" data-rangefrom="#datefrom" name="end_date" type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB11;?>" value="" readonly class="datepick">
            <i class="icon date"></i>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_MOD_AB_SUB1;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB1;?>" name="max_views">
        </div>
      </div>
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_AB_SUB2;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB2;?>" name="max_clicks">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_MOD_AB_SUB3;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB3;?>" name="min_ctr">
        </div>
      </div>
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_MOD_AB_SUB12;?></label>
          <div class="wojo checkbox toggle fitted inline">
            <input name="btype" type="radio" value="yes" id="btype_yes" checked="checked">
            <label for="btype_yes"><?php echo Lang::$word->_MOD_AB_SUB4;?></label>
          </div>
          <div class="wojo checkbox toggle fitted inline">
            <input name="btype" type="radio" value="no" id="btype_no">
            <label for="btype_no"><?php echo Lang::$word->_MOD_AB_SUB7;?></label>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field" id="imgType">
          <label><?php echo Lang::$word->_MOD_AB_SUB4;?>
            <i class="icon asterisk"></i></label>
          <input type="file" data-buttonText="<?php echo Lang::$word->BROWSE;?>" name="image" id="image" class="filestyle" data-input="false">
          <div class="vertical margin">
            <label class="label"><?php echo Lang::$word->_MOD_AB_SUB5;?>
              <i class="icon asterisk"></i></label>
            <input type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB5;?>" name="image_link">
          </div>
          <label><?php echo Lang::$word->_MOD_AB_SUB6;?>
            <i class="icon asterisk"></i></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_AB_SUB6;?>" name="image_alt">
        </div>
        <div class="field hide-all" id="htmlType">
          <label><?php echo Lang::$word->_MOD_AB_SUB7;?>
            <i class="icon asterisk"></i></label>
          <textarea name="html" placeholder="<?php echo Lang::$word->_MOD_AB_SUB7;?>"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "adblock/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/adblock" data-action="processCampaign" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_AB_NEW;?></button>
  </div>
  <input type="hidden" name="banner_type" value="yes">
</form>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
    $("input[name=btype]").on('change', function() {
		if($(this).val() === "no") {
			$("#imgType").hide();
			$("#htmlType").show();
		} else {
			$("#imgType").show();
			$("#htmlType").hide();
		}
		$("input[name=banner_type]").val($(this).val())
   });
});
// ]]>
</script>