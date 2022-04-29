<?php
  /**
   * User Notify Template
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _userNotifyTemplate.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<table width="100%" border="0" cellpadding="4" cellspacing="2">
  <thead>
    <tr>
      <th><?php echo Lang::$word->_MOD_DS_SUB3;?></th>
      <th><?php echo Lang::$word->TRX_AMOUNT;?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->items as $row):?>
    <tr>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo $row->title;?>
        <?php echo Shop::hasVariants($row->variant);?></td>
      <td style="border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed"><?php echo Utility::formatMoney($row->price);?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
<p><strong><?php echo Lang::$word->_MOD_SP_SUB43;?></strong>: <?php echo $this->row->address;?></p>
<p><strong><?php echo Lang::$word->_MOD_SP_SUB17;?></strong> :<?php echo $this->row->tracking;?></p>