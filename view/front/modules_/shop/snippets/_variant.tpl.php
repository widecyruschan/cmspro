<?php
  /**
   * Variations
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _variant.tpl.php, v1.00 2019-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<div class="row grid screen-2 tablet-2 mobile-2 phone-1 gutters">
  <?php $i = 0;?>
  <?php foreach($this->data as $section => $rows):?>
  <?php $i++;?>
  <div class="columns">
    <div class="wojo attached simple segment">
      <h4>
        <?php echo $section;?>
      </h4>
      <div class="wojo relaxed fluid list" data-id="<?php echo $i;?>">
        <?php foreach($rows as $row):?>
        <div class="item">
          <a class="wojo fluid primary basic button add-var" data-id="<?php echo $row->id;?>">
          <?php echo $row->value;?>&nbsp;<small>(<?php echo Utility::formatMoney($row->price);?>)</small></a>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
