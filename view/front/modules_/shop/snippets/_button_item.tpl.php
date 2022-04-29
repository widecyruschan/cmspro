<?php
  /**
   * Button Item
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _button_item.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if ($this->row->quantity == 0 or $this->row->label == "sold" or $this->row->label == "soon"):?>
<a data-id="<?php echo $this->row->id;?>" class="wojo rounded fluid secondary button add-shop-wish" data-layout="list">
<i class="icon heart"></i>
<?php echo Lang::$word->_MOD_SP_WISH;?></a>
<?php else :?>
<?php if(!$this->conf->catalog):?>
	<?php if($this->row->variation_data):?>
    <p><a data-option='{"id":<?php echo $this->row->id;?>, "variant":true, "type":"simple"}' class="wojo fluid primary rounded right button add-shopv"><?php echo Lang::$word->_MOD_SP_ADDCART;?>
      <i class="icon chevron down"></i></a>
    </p>
    <?php else:?>
    <p><a data-option='{"id":<?php echo $this->row->id;?>, "variant":false, "type":"simple"}' class="wojo rounded fluid primary button add-shop"><?php echo Lang::$word->_MOD_SP_ADDCART;?></a>
    </p>
    <?php endif;?>
<?php endif;?>
<a data-id="<?php echo $this->row->id;?>" class="wojo rounded fluid secondary button add-shop-wish" data-layout="list">
<i class="icon heart"></i>
<?php echo Lang::$word->_MOD_SP_WISH;?></a>
<?php endif;?>
