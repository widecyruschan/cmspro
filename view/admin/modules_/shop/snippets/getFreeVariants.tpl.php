<?php
  /**
   * Get Variants
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: getFreeVariants.tpl.php, v1.00 2020-05-06 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<div class="columns" data-name="<?php echo Validator::sanitize($this->row->name, "chars");?>">
  <div class="wojo small form bottom attached segment">
    <div class="wojo fields">
      <div class="field">
        <h4><?php echo $this->row->name;?></h4>
      </div>
      <div class="field auto">
        <a class="wojo positive small icon button addOption" data-name="<?php echo $this->row->name;?>"><i class="icon plus"></i></a>
      </div>
    </div>
    <?php foreach($this->data as $row):?>
    <?php $n = Utility::randNumbers(4);?>
    <div class="wojo small fields align bottom variantSection" data-id="<?php echo $n;?>">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input name="variant[<?php echo $n;?>][value]" type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $row->name;?>">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PRICE;?>
          <i class="icon asterisk"></i></label>
        <input name="variant[<?php echo $n;?>][price]" type="text" placeholder="<?php echo Lang::$word->PRICE;?>" value="1.00">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_QTY;?>
          <i class="icon asterisk"></i></label>
        <input name="variant[<?php echo $n;?>][qty]" type="text" placeholder="<?php echo Lang::$word->_MOD_SP_QTY;?>" value="1">
      </div>
      <div class="auto field">
        <a class="wojo small negative icon fluid button removeVariant"><i class="icon trash"></i></a>
        <input type="hidden" name="variant[<?php echo $n;?>][title]" value="<?php echo $this->row->name;?>">
        <input type="hidden" name="variant[<?php echo $n;?>][id]" value="<?php echo $n;?>">
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>