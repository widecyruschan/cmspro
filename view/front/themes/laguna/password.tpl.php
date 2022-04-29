<?php
  /**
   * Password
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: password.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<main>
  <div class="wojo-grid">
    <h2><?php echo Lang::$word->NEWPASS;?></h2>
    <div class="wojo form segment">
      <form method="post" id="wojo_form" name="wojo_form">
        <div class="wojo block fields">
          <div class="field">
            <label><?php echo Lang::$word->NEWPASS;?>
              <i class="icon asterisk"></i></label>
            <input placeholder="<?php echo Lang::$word->NEWPASS;?>" name="password" type="password">
          </div>
        </div>
        <div class="wojo fields">
          <div class="field center aligned">
            <button class="wojo primary button" data-action="password" name="dosubmit" type="button"><?php echo Lang::$word->SUBMIT;?></button>
          </div>
        </div>
        <input type="hidden" name="token" value="<?php echo $this->segments[1];?>">
      </form>
    </div>
  </div>
</main>