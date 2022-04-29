<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _shop_shipping.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments, 4)): case "view": ?>
<h2><?php echo Lang::$word->_MOD_SP_SUB33;?>
  <small>(<?php echo $this->row->user;?>)</small></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB38;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_SUB38;?>" value="<?php echo $this->row->transaction_id;?>" name="transaction_id" readonly>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB42;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_SUB42;?>" value="<?php echo $this->row->invoice_id;?>" name="invoice_id" readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->row->user;?>" name="user" readonly>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SHIPPING;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_SHIPPING;?>" value="<?php echo $this->row->name;?> @<?php echo Utility::formatMoney($this->row->shipping);?>" name="name" readonly>
      </div>
    </div>
    <table class="wojo basic responsive table">
      <thead>
        <tr>
          <th><?php echo Lang::$word->_MOD_DS_SUB3;?></th>
          <th><?php echo Lang::$word->TRX_AMOUNT;?></th>
          <th><?php echo Lang::$word->_MOD_SP_VARIATIONS;?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->items as $row):?>
        <tr>
          <td><?php echo $row->title;?></td>
          <td><?php echo Utility::formatMoney($row->price);?></td>
          <td><?php echo Shop::hasVariants($row->variant);?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB43;?></label>
        <textarea placeholder="<?php echo Lang::$word->_MOD_SP_SUB43;?>" name="address" readonly><?php echo $this->row->address;?></textarea>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB44;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_SUB43;?>" value="<?php echo $this->row->status ? Date::doDate("short_date", $this->row->shipped) : Lang::$word->PENDING;?>" name="shipped" readonly>
        <div class="vertical margin">
          <label class="label"><?php echo Lang::$word->_MOD_SP_SUB17;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_SUB17;?>" value="<?php echo $this->row->tracking;?>" name="tracking">
        </div>
        <label><?php echo Lang::$word->CREATED;?></label>
        <?php echo Date::doDate("short_date", $this->row->created);?>
      </div>
    </div>
    <?php if($this->row->status == 0):?>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_SUB46;?></label>
        <div class="wojo checkbox fitted inline">
          <input name="notify" type="checkbox" value="1" id="notify_1" checked="checked">
          <label for="notify_1"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
  <div class="center aligned">
  <a href="<?php echo Url::url("/admin/modules", "shop/shipping/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
  <?php if($this->row->status == 0):?>
  <button type="button" data-url="modules_/shop" data-action="processShipping" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_SP_SUB45;?></button>
  <?php endif;?>
  <input type="hidden" name="id" value="<?php echo $this->row->id;?>">
  <input type="hidden" name="user_id" value="<?php echo $this->row->user_id;?>">
</form>
<?php break;?>
<?php default: ?>
<h2><?php echo Lang::$word->_MOD_SP_SUB20;?></h2>
<form method="get" id="wojo_form" action="<?php echo Url::url(Router::$path);?>" name="wojo_form" class="wojo form">
  <div class="row align middle center gutters">
    <div class="columns screen-30 phone-100">
      <div class="wojo icon action input">
        <i class="icon user"></i>
        <input name="name" type="text" placeholder="<?php echo Lang::$word->_MOD_SP_SUB21;?>" autocomplete="off">
        <button class="wojo primary icon button"><i class="icon find"></i></button>
      </div>
    </div>
    <div class="columns auto phone-hide">
      <a href="<?php echo Url::url(Router::$path);?>" class="wojo icon button"><i class="icon refresh"></i></a>
    </div>
  </div>
</form>
<?php if($this->data):?>
<div class="wojo segment">
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th data-sort="string"><?php echo Lang::$word->USER;?></th>
        <th data-sort="string"><?php echo Lang::$word->_MOD_SP_SHIPPING;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_AMOUNT;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
        <th class="disabled">&nbsp;</th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td><a class="inverted" href="<?php echo Url::url("/admin/users/edit", $row->user_id);?>"><?php echo $row->user;?></a></td>
      <td><?php echo $row->name;?></td>
      <td><?php echo Utility::formatMoney($row->total);?></td>
      <td><?php echo Date::doDate("short_date", $row->created);?></td>
      <td class="right aligned"><?php if($row->status == 0):?>
        <span data-tooltip="<?php echo Lang::$word->_MOD_SP_SUB14;?>" class="wojo simple circular icon button"><i class="icon ban"></i></span>
        <?php else:?>
        <a data-tooltip="<?php echo Lang::$word->_MOD_SP_SUB15 . ': ' . Date::doDate("short_date", $row->shipped);?>" class="wojo simple positive circular icon button"><i class="icon check"></i></a>
        <?php endif;?>
        <a href="<?php echo Url::url(Router::$path, "view/" . $row->id);?>" class="wojo icon primary button"><i class="icon note"></i></a></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php break;?>
<?php endswitch;?>