<?php
  /**
   * Email Templates
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: templates.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_email')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2 class="header"><?php echo Lang::$word->META_T11;?></h2>
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
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'name_' . $lang->abbr};?>" name="name_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" value="<?php echo $this->data->{'subject_' . $lang->abbr};?>" name="subject_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="basic field">
              <textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"><?php echo str_replace("[SITEURL]", SITEURL, $this->data->{'body_' . $lang->abbr});?></textarea>
              <p class="wojo small icon negative text">
                <i class="icon negative info sign"></i>
                <?php echo Lang::$word->NOTEVAR;?></p>
            </div>
          </div>
          <div class="wojo divider"></div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->ET_DESC;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo small input">
                <input type="text" placeholder="<?php echo Lang::$word->ET_DESC;?>" value="<?php echo $this->data->{'help_' . $lang->abbr};?>" name="help_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/templates");?>" class="wojo wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processTemplate" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->ET_UPDATE;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php default: ?>
<h2><?php echo Lang::$word->ET_TITLE;?></h2>
<p class="wojo small text"><?php echo Lang::$word->ET_SUB;?></p>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->ET_INFO;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th class="disabled center aligned"></th>
        <th data-sort="string"><?php echo Lang::$word->ET_NAME;?></th>
        <th data-sort="string"><?php echo Lang::$word->ET_SUBJECT;?></th>
        <th class="disabled center aligned"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td class="auto"><span class="wojo small simple label"><?php echo $row->id;?></span></td>
      <td><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="inverted">
        <?php echo $row->{'name' . Lang::$lang};?></a></td>
      <td><?php echo $row->{'subject' . Lang::$lang};?></td>
      <td class="auto"><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="wojo icon primary inverted circular button"><i class="icon note"></i></a></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>