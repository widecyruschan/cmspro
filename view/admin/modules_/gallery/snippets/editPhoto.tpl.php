<?php
  /**
   * Edit Photo
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: editPhoto.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="body">
<form method="post" id="modal_form" name="modal_form">
  <div class="wojo small card form">
    <div class="wojo small lang tabs">
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
                <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small></label>
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
              <div class="field">
                <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
                <textarea type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" name="description_<?php echo $lang->abbr?>"><?php echo $this->data->{'description_' . $lang->abbr};?></textarea>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
</form>
</div>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
	$(".wojo.tabs").wTabs();
});
// ]]>
</script>