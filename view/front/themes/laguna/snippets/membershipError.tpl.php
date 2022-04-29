<?php
  /**
   * Membership Error
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: membershipError.tpl.php, v1.00 2020-06-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <div class="vertical padding">
    <div class="wojo negative relaxed icon message">
      <i class="icon big white lock"></i>
      <div class="content">
        <h1 class="wojo white basic text"><?php echo Lang::$word->FRT_MERROR;?></h1>
      </div>
    </div>
    <p><?php echo Lang::$word->FRT_MERROR_2;?></p>
    <?php if($data):?>
    <ul class="wojo list">
      <?php foreach ($data as $row):?>
      <li><?php echo $row->title;?></li>
      <?php endforeach;?>
    </ul>
    <?php endif;?>
  </div>
</div>