<?php
  /**
   * Resend Notification
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: resendNotification.tpl.php, v1.00 2020-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="body">
  <div class="wojo small form content">
    <?php if(!$this->data):?>
    <?php Message::invalid("ID" . Filter::$id);?>
    <?php else:?>
    <form method="post" id="modal_form" name="modal_form">
      <div class="center aligned">
        <p class="wojo icon text">
          <i class="icon info sign"></i><?php echo Lang::$word->_MOD_DS_INFO;?>
        </p>
      </div>
    </form>
    <?php endif;?>
  </div>
</div>