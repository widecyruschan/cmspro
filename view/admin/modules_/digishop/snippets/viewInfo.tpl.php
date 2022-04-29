<?php
  /**
   * View Payment Info
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: viewInfo.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->data) : Message::invalid("ID" . Filter::$id); return; endif;
?>
<div class="header">
  <h4 class="basic"><?php echo Lang::$word->TRANSACTION;?></h4>
</div>
<div class="body">
  <table class="wojo table">
    <tr>
      <td>ID</td>
      <td><?php echo $this->data->txn_id;?></td>
    </tr>
    <tr>
      <td><?php echo Lang::$word->GATEWAY;?></td>
      <td><?php echo $this->data->pp;?></td>
    </tr>
    <tr>
      <td><?php echo Lang::$word->TRX_TAX;?></td>
      <td><?php echo $this->data->tax;?></td>
    </tr>
    <tr>
      <td><?php echo Lang::$word->TRX_COUPON;?></td>
      <td><?php echo $this->data->coupon;?></td>
    </tr>
    <tr>
      <td><?php echo Lang::$word->CURRENCY;?></td>
      <td><?php echo $this->data->currency;?></td>
    </tr>
    <tr>
      <td><?php echo Lang::$word->DOWNLOADS;?></td>
      <td><?php echo $this->data->downloads;?></td>
    </tr>
    <tr>
      <td>IP</td>
      <td><?php echo $this->data->ip;?></td>
    </tr>
  </table>
</div>
