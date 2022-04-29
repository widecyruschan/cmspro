<?php
  /**
   * Button List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _button_list.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if ($row->quantity == 0 or $row->label == "sold" or $row->label == "soon"):?>
<a data-id="<?php echo $row->id;?>" class="wojo rounded secondary small button add-shop-wish" data-layout="list">
<i class="icon heart"></i>
<?php echo Lang::$word->_MOD_SP_WISH;?></a>
<?php else :?>
<?php if(!$this->conf->catalog):?>
	<?php if($row->variation_data):?>
    <a data-option='{"id":<?php echo $row->id;?>, "variant":true, "type":"normal"}' class="wojo small primary rounded right button add-shopv"><?php echo Lang::$word->_MOD_SP_ADDCART;?>
    <i class="icon chevron down"></i></a>
    <?php else:?>
    <a data-option='{"id":<?php echo $row->id;?>, "variant":false, "type":"normal"}' class="wojo rounded primary small button add-shop"><?php echo Lang::$word->_MOD_SP_ADDCART;?></a>
    <?php endif;?>
<?php endif;?>
<a data-id="<?php echo $row->id;?>" class="wojo rounded secondary small button add-shop-wish" data-layout="list">
<i class="icon heart"></i>
<?php echo Lang::$word->_MOD_SP_WISH;?></a>
<?php endif;?>
