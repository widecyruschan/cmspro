<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _shop_payments.tpl.php, v1.00 2019-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_SP_SUB1;?></h2>
<div class="wojo card" id="pData">
  <div class="header">
    <div class="row gutters align middle">
      <div class="columns">
        <a data-wdropdown="#dropdown-timeRange" class="wojo white icon circular button" id="timeRange">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo small dropdown pointing menu top-left" id="dropdown-timeRange">
          <a class="item" data-value="all"><?php echo Lang::$word->ALL;?></a>
          <a class="item" data-value="day"><?php echo Lang::$word->TODAY;?></a>
          <a class="item" data-value="week"><?php echo Lang::$word->THIS_WEEK;?></a>
          <a class="item" data-value="month"><?php echo Lang::$word->THIS_MONTH;?></a>
          <a class="item" data-value="year"><?php echo Lang::$word->THIS_YEAR;?></a>
        </div>
      </div>
      <div class="columns auto">
        <div id="legend" class="wojo small horizontal list">
        </div>
      </div>
    </div>
  </div>
  <div class="content h400" id="payment_chart"></div>
</div>
<div class="wojo form segment">
  <form method="get" id="wojo_form" action="<?php echo Url::url(Router::$path);?>" name="wojo_form">
    <div class="row align center middle gutters">
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo icon input">
          <input name="fromdate" type="text" placeholder="<?php echo Lang::$word->FROM;?>" readonly id="fromdate">
          <i class="icon calendar alt"></i>
        </div>
      </div>
      <div class="columns screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo action input">
          <input name="enddate" type="text" placeholder="<?php echo Lang::$word->TO;?>" readonly id="enddate">
          <button id="doDates" class="wojo icon primary inverted button"><i class="icon find"></i></button>
        </div>
      </div>
      <div class="columns auto phone-hide">
        <a href="<?php echo Url::url(Router::$path);?>" class="wojo icon button"><i class="icon refresh"></i></a>
      </div>
      <div class="columns auto phone-hide">
        <a href="<?php echo AMODULEURL;?>shop/controller.php?action=transactions<?php echo Url::query();?>" class="wojo primary icon button"><i class="icon wysiwyg table"></i></a>
      </div>
    </div>
  </form>
  <?php if($this->data):?>
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th data-sort="string"><?php echo Lang::$word->USER;?></th>
        <th data-sort="string"><?php echo Lang::$word->_MOD_DS_SUB3;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_AMOUNT;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
        <th class="disabled">&nbsp;</th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td><a class="inverted" href="<?php echo Url::url("/admin/users/edit", $row->user_id);?>"><?php echo $row->name;?></a></td>
      <td><a class="inverted" href="<?php echo Url::url("/admin/modules/shop/edit", $row->item_id);?>"><?php echo $row->title;?></a>
        <span class="wojo demi text"><?php echo Shop::hasVariants($row->variant);?></span></td>
      <td><?php echo $row->total;?></td>
      <td><?php echo Date::doDate("short_date", $row->created);?></td>
      <td class="collapsing"><a data-set='{"option":[{"delete": "deletePayment","title": "<?php echo $row->title;?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/shop"}' class="wojo small circular negative icon button data"><i class="icon trash"></i></a></td>
    </tr>
    <?php endforeach;?>
  </table>
  <div class="wojo small primary passive button"><?php echo Lang::$word->TRX_TOTAMT;?>
    <?php echo Utility::formatMoney(Stats::doArraySum($this->data, "total"));?></div>
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