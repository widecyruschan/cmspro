<?php
  /**
   * Item Template
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: itemTemplate.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<table width="100%" border="0" cellpadding="4" cellspacing="2">
  <thead>
    <tr>
      <td width="20"><strong>#</strong></td>
      <td><strong><?php echo Lang::$word->_MOD_DS_SUB3;?></strong></td>
      <td><strong><?php echo Lang::$word->TRX_TAX;?></strong></td>
      <td><strong><?php echo Lang::$word->TRX_COUPON;?></strong></td>
      <td><strong><?php echo Lang::$word->TRX_AMOUNT;?></strong></td>
      <td><strong><?php echo Lang::$word->QUANTITY;?></strong></td>
      <td align="right"><strong><?php echo Lang::$word->TRX_TOTAMT;?></strong></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $this->row->id;?>.</td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $this->row->title;?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatMoney($this->row->tax);?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatMoney($this->row->coupon);?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatMoney($this->row->amount);?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $this->row->qty;?></td>
      <td align="right" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatMoney($this->row->total);?></td>
    </tr>
    <tr>
      <td colspan="6" align="right" valign="top"><strong style="color:#F00"><?php echo Lang::$word->TRX_GRTOTAL;?>:</strong></td>
      <td align="right" valign="top"><strong style="color:#F00"><?php echo Utility::formatMoney($this->row->total);?></strong></td>
    </tr>
  </tbody>
</table>