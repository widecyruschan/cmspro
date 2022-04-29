<?php
  /**
   * Memberships
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _memberships.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <h4 class="underlined">
    <?php echo Lang::$word->ADM_MEMBS;?>
  </h4>
  <p><?php echo Lang::$word->M_INFO13;?></p>
  <?php if($this->memberships):?>
  <div id="membershipSelect" class="wojo basic simple cards screen-3 tablet-2 mobile-1 phone-1 align center">
    <?php foreach($this->memberships as $row):?>
    <div class="card<?php echo $this->user->membership_id == $row->id ? ' active' : null;?>" id="item_<?php echo $row->id;?>">
      <div class="content">
        <figure class="wojo fluid image margin bottom">
          <?php if($row->thumb):?>
          <img src="<?php echo UPLOADURL;?>/memberships/<?php echo $row->thumb;?>" alt="">
          <?php else:?>
          <img src="<?php echo UPLOADURL;?>/memberships/default.svg" alt="">
          <?php endif;?>
        </figure>
        <h5 class="wojo primary text center aligned">
          <?php echo Utility::formatMoney($row->price);?>
          <?php echo $row->{'title' . Lang::$lang};?>
        </h5>
        <div class="wojo list">
          <div class="item">
            <?php echo Lang::$word->MEM_REC1;?>
            <?php echo ($row->recurring) ? Lang::$word->YES : Lang::$word->NO;?>
          </div>
          <div class="item">
            <?php echo $row->days;?> @<?php echo Date::getPeriodReadable($row->period);?>
          </div>
          <div class="item">
            <span class="wojo tiny secondary text"><?php echo $row->{'description' . Lang::$lang};?></span>
          </div>
        </div>
      </div>
      <div class="footer">
        <?php if($this->user->membership_id != $row->id):?>
        <a class="wojo fluid secondary button add-membership" data-id="<?php echo $row->id;?>"><?php echo ($row->price <> 0) ? Lang::$word->SELECT : Lang::$word->ACTIVATE;?></a>
        <?php endif;?>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <div id="mResult"></div>
  <?php endif;?>
</div>