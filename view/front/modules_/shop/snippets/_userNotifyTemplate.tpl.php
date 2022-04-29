<?php
  /**
   * User Notify Template
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: _userNotifyTemplate.tpl.php, v1.00 2019-07-05 10:12:05 gewa Exp $
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
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $row->title;?>
        <?php if($row->variants):?>
        <p>
          <?php $vars = json_decode($row->variants);?>
          <?php foreach($vars as $var):?>
          <small>
          <b>
          <?php echo $var->title;?></b>: <?php echo $var->value;?></small>
          <?php endforeach;?>
        </p>
        <?php endif;?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatNumber($row->total);?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $row->items;?></td>
      <td align="right" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatNumber($row->total * $row->items);?></td>
    </tr>
    <?php endforeach;?>
    <tr>
      <td colspan="4" align="right" valign="top"><strong><?php echo Lang::$word->TRX_SUBTOTAL;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong><?php echo Utility::formatMoney($this->totals->sub);?></strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right" valign="top"><strong><?php echo Lang::$word->TRX_TAX;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong><?php echo ($this->totals->tax > 0) ? Utility::formatMoney($this->totals->tax) : "--";?></strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right" valign="top"><strong><?php echo Lang::$word->_MOD_SP_SHIPPING;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong><?php echo ($this->shipping) ? Utility::formatMoney($this->shipping->total) : "--";?></strong></td>
    </tr>
    <tr>
      <td colspan="4" align="right" valign="top"><strong style="color:#F00"><?php echo Lang::$word->TRX_GRTOTAL;?>:</strong></td>
      <td align="right" valign="top" style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><strong style="color:#F00"><?php echo  Utility::formatMoney(($this->shipping) ? $this->shipping->total + $this->totals->grand : $this->totals->grand);?></strong></td>
    </tr>
  </tbody>
</table>