<?php
  /**
   * Reply Form
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: replyForm.tpl.php, v1.00 2020-01-05 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../../../../init.php");
  Bootstrap::Autoloader(array(AMODPATH . 'comments/'));
?>
<?php if(App::Comments()->public_access or App::Auth()->logged_in):?>
<div class="wojo small form segment form hide-all" id="replyform">
  <div class="wojo small block fields">
    <div class="field">
      <?php if(App::Auth()->logged_in):?>
      <input type="hidden" name="replayname" value="<?php echo App::Auth()->uid;?>">
      <?php else:?>
      <input name="replayname" placeholder="<?php echo Lang::$word->NAME;?>" type="text">
      <?php endif;?>
    </div>
    <div class="field">
      <textarea data-counter="<?php echo App::Comments()->char_limit;?>" id="replybody" placeholder="<?php echo Lang::$word->MESSAGE;?>" name="replybody"></textarea>
    </div>
  </div>
  <p class="wojo mini text replybody_counter"><?php echo Lang::$word->_MOD_CM_CHAR . ' <span class="wojo positive text">' . App::Comments()->char_limit . '</span>';?></p>
  <button type="button" name="doReply" class="wojo small primary button"><?php echo Lang::$word->SUBMIT;?></button>
</div>
<?php else:?>
<p id="pError" class="wojo small negative text"><?php echo Lang::$word->_MOD_CM_SUB1;?></p>
<?php endif;?>
