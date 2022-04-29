<?php
  /**
   * Countries
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: countries.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_countries')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2><?php echo Lang::$word->CNT_EDIT;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->name;?>" name="name">
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->CNT_ABBR;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->CNT_ABBR;?>" value="<?php echo $this->data->abbr;?>" name="abbr">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field five wide">
        <label><?php echo Lang::$word->TRX_TAX;?></label>
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->TRX_TAX;?>" value="<?php echo $this->data->vat;?>" name="vat">
          <div class="wojo simple label">%</div>
        </div>
      </div>
      <div class="field five wide">
        <label><?php echo Lang::$word->SORTING;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->SORTING;?>" value="<?php echo $this->data->sorting;?>" name="sorting">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->STATUS;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="1" id="active_1" <?php Validator::getChecked($this->data->active, 1); ?>>
          <label for="active_1"><?php echo Lang::$word->ACTIVE;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="0" id="active_0" <?php Validator::getChecked($this->data->active, 0); ?>>
          <label for="active_0"><?php echo Lang::$word->INACTIVE;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->DEFAULT;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="home" type="radio" value="1" id="home_1" <?php Validator::getChecked($this->data->home, 1); ?>>
          <label for="home_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="home" type="radio" value="0" id="home_0" <?php Validator::getChecked($this->data->home, 0); ?>>
          <label for="home_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/countries");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processCountry" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->CNT_UPDATE;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php default: ?>
<h2><?php echo Lang::$word->CNT_TITLE;?></h2>
<p class="wojo small text"><?php echo Lang::$word->CNT_INFO;?></p>
<?php if(!$this->data):?>
<div class="content-center"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->CNT_NOCOUNTRY;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <table class="wojo basic responsive table" id="editable">
    <thead>
      <tr>
        <th class="center aligned"></th>
        <th><?php echo Lang::$word->NAME;?></th>
        <th><?php echo Lang::$word->CNT_ABBR;?></th>
        <th><?php echo Lang::$word->TAX;?></th>
        <th><?php echo Lang::$word->SORTING;?></th>
        <th class="center aligned"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td class="auto"><span class="wojo small dark inverted label"><?php echo $row->id;?></span></td>
      <td><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>">
        <?php echo $row->name;?></a></td>
      <td><span class="wojo small label"><?php echo $row->abbr;?></span></td>
      <td><span data-editable="true" data-set='{"action": "editTax", "id": <?php echo $row->id;?>}'><?php echo $row->vat;?></span>%</td>
      <td><?php echo $row->sorting;?></td>
      <td class="auto"><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="wojo icon circular primary inverted button"><i class="icon note"></i></a></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>