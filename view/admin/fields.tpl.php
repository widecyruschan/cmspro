<?php
  /**
   * Custom Fields
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: fields.tpl.php, v1.00 2020-05-10 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_fields')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2 class="header"><?php echo Lang::$word->META_T16;?></h2>
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
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->CF_TIP;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->CF_TIP;?>" value="<?php echo $this->data->{'tooltip_' . $lang->abbr};?>" name="tooltip_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="content">
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->SECTION;?></label>
          <select name="section">
            <option value="profile"><?php echo Lang::$word->M_SUB16;?></option>
            <?php echo Utility::loopOptions($this->modlist, "modalias", "title", $this->data->section);?>
          </select>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field five wide">
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
        <div class="field five wide">
          <label><?php echo Lang::$word->CF_REQUIRED;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="required" type="radio" value="1" id="required_1" <?php Validator::getChecked($this->data->required, 1); ?>>
            <label for="required_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="required" type="radio" value="0" id="required_0" <?php Validator::getChecked($this->data->required, 0); ?>>
            <label for="required_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/fields");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processField" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->CF_UPDATE;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<h2 class="header"><?php echo Lang::$word->META_T17;?></h2>
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
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->CF_TIP;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->CF_TIP;?>" name="tooltip_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="content">
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->SECTION;?></label>
          <select name="section">
            <option value="profile"><?php echo Lang::$word->M_SUB16;?></option>
            <?php echo Utility::loopOptions($this->modlist, "modalias", "title");?>
          </select>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field five wide">
          <label><?php echo Lang::$word->PUBLISHED;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="1" id="active_1" checked="checked">
            <label for="active_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="0" id="active_0">
            <label for="active_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field five wide">
          <label><?php echo Lang::$word->CF_REQUIRED;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="required" type="radio" value="1" id="required_1">
            <label for="required_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="required" type="radio" value="0" id="required_0" checked="checked">
            <label for="required_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/fields");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processField" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->CF_ADD;?></button>
  </div>
</form>
<?php break;?>
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h3><?php echo Lang::$word->CF_TITLE;?></h3>
    <p class="wojo small text"><?php echo Lang::$word->CF_INFO;?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small stacked dark button"><i class="icon plus alt"></i><?php echo Lang::$word->CF_ADD;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->CF_NOFIELDS;?></p>
</div>
<?php else:?>
<div class="wojo cards screen-3 tablet-3 mobile-1" id="sortable">
  <?php foreach ($this->data as $row):?>
  <div class="card" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="header">
      <div class="row">
        <div class="columns">
          <div class="wojo simple label draggable"><i class="icon reorder"></i></div>
        </div>
        <div class="columns auto">
          <a data-set='{"option":[{"delete": "deleteField","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id": <?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>"}' class="wojo negative small inverted icon button data"><i class="icon trash"></i></a>
        </div>
      </div>
    </div>
    <div class="padding bottom center aligned">
      <h6>
        <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->{'title' . Lang::$lang};?></a>
      </h6>
      <p class="wojo small text">[<?php echo $row->section;?>]</p>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {
    $("#sortable").sortable({
        ghostClass: "ghost",
        handle: ".label",
        animation: 600,
        onUpdate: function(e) {
            var order = this.toArray();
            $.ajax({
                type: 'post',
                url: "<?php echo ADMINVIEW . '/helper.php';?>",
                dataType: 'json',
                data: {
                    iaction: "sortFields",
                    sorting: order
                }
            });
        }
    });
});
// ]]>
</script>
<?php break;?>
<?php endswitch;?>