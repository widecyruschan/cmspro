<?php
  /**
   * User Notify Template
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _userNotifyTemplate.tpl.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<table width="100%" border="0" cellpadding="4" cellspacing="2">
  <thead>
    <tr>
      <td width="20"><strong>#</strong></td>
      <td><strong><?php echo Lang::$word->_MOD_DS_SUB3;?></strong></td>
      <td><strong><?php echo Lang::$word->TRX_AMOUNT;?></strong></td>
      <td><strong><?php echo Lang::$word->QUANTITY;?></strong></td>
      <td align="right"><strong><?php echo Lang::$word->TRX_TOTAMT;?></strong></td>
    </tr>
  </thead>
  <tbody>
    <?php foreach($this->rows as $row):?>
    <tr>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $row->pid;?>.</td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $row->title;?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatNumber($row->price);?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $row->items;?></td>
      <td align="right" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatNumber($row->price * $row->items);?></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td colspan="4" align="right" valign="top"><strong><?php echo Lang::$word->TRX_SUBTOTAL;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong><?php echo Utility::formatNumber($this->totals->sub);?></strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right" valign="top"><strong><?php echo Lang::$word->TRX_TAX;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong><?php echo Utility::formatNumber($this->tax * $this->totals->grand);?></strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right" valign="top"><strong style="color:#F00"><?php echo Lang::$word->TRX_GRTOTAL;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong style="color:#F00"><?php echo Utility::formatMoney($this->tax * $this->totals->grand + $this->totals->grand);?></strong></td>
    </tr>
  </tbody>
</table>