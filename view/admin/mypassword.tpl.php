<?php
  /**
   * My Password
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: mypassword.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<!-- Start password -->
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo segment form">
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->NEWPASS;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input type="text" name="password">
      </div>
    </div>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CONPASS;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <input type="text" name="password2">
      </div>
    </div>
    <div class="center aligned">
      <a href="<?php echo Url::url("/admin/myaccount");?>" class="wojo small simple button"><?php echo Lang::$word->CANCEL;?></a>
      <button type="button" data-action="updatePassword" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->M_PASSUPDATE;?></button>
    </div>
  </div>
</form>