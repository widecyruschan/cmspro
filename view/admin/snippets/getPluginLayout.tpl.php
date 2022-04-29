<?php
  /**
   * Edit Role
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: getPluginLayout.tpl.php, v1.00 2020-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="poplayout mnw260">
  <form class="layform" name="layform">
    <?php if($this->data):?>
    <div data-section="<?php echo $this->section;?>" class="wojo very relaxed list">
      <?php foreach($this->data as $row):?>
      <div class="item">
        <div class="content">
          <div class="wojo small text header" data-id="<?php echo $row->id;?>"><?php echo $row->title;?></div>
          <div class="description margin-top">
            <input type="range" min="1" max="10" step="1" type="text" name="space[<?php echo $row->id;?>]" value="<?php echo $row->space;?>" hidden data-suffix=" sp" class="rangeslider" data-type="labels" data-labels="1,2,4,6,8,10">
          </div>
        </div>
      </div>
      <div class="wojo space divider"></div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
  </form>
<div class="wojo double divider"></div>
  <div class="center aligned">
    <button class="wojo small primary button update"><?php echo Lang::$word->UPDATE;?></button>
  </div>
</div>