<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _shop_history.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns">
    <h3><?php echo Lang::$word->_MOD_SP_META_T1;?>
      <small>// <?php echo $this->data->{'title' . Lang::$lang};?></small></h3>
  </div>
  <div class="column auto"><a href="<?php echo AMODULEURL . 'shop/controller.php?action=itemPayments&amp;id=' . $this->data->id;?>" class="wojo small dark stacked button"><i class="icon wysiwyg table"></i><?php echo Lang::$word->EXPORT;?></a>
  </div>
</div>
<div class="wojo segment">
  <div class="right aligned">
    <div id="legend" class="wojo small horizontal list"></div>
  </div>
  <div id="payment_chart" class="h300;"></div>
</div>
<?php if($this->plist):?>
<div class="wojo segment">
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th data-sort="string"><?php echo Lang::$word->USER;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_AMOUNT;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_TAX;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_COUPON;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_TOTAMT;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
      </tr>
    </thead>
    <?php foreach ($this->plist as $row):?>
    <tr>
      <td><a class="inverted" href="<?php echo Url::url("/admin/users/edit", $row->user_id);?>"><?php echo $row->name;?></a></td>
      <td><?php echo $row->amount;?></td>
      <td><?php echo $row->tax;?></td>
      <td><?php echo $row->coupon;?></td>
      <td><?php echo $row->total;?></td>
      <td data-sort-value="<?php echo strtotime($row->created);?>"><?php echo Date::doDate("short_date", $row->created);?></td>
    </tr>
    <?php endforeach;?>
  </table>
   <div class="wojo small passive primary button"><?php echo Lang::$word->TRX_TOTAMT;?> <?php echo Utility::formatMoney(Stats::doArraySum($this->plist, "total"));?></div>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/morris.min.js"></script> 
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/raphael.min.js"></script> 