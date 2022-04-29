<?php
  /**
   * View Variants Info
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: viewVariants.tpl.php, v1.00 2020-05-06 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="header">
  <h5><?php echo Lang::$word->_MOD_SP_SUB22;?></h5>
</div>
<div class="body">
  <?php if(!$this->data):?>
  <p class="wojo alert message"><?php echo Lang::$word->_MOD_SP_NO_VARS;?></p>
  <?php else:?>
  <div class="wojo full cards phone-1 mobile-1 tablet-2 screen-2" id="result">
    <?php foreach ($this->data as $row):?>
    <div class="card">
      <div class="content">
        <h5 class="center aligned"><a data-id="<?php echo $row->id;?>"><?php echo $row->name;?></a></h5>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>