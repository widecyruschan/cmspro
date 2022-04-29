<?php
  /**
   * Upcoming Event
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkPlugAcl('upevent')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<h3><?php echo Lang::$word->_PLG_UE_TITLE1;?></h3>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="row align center">
    <div class="columns screen-50 tablet-100 mobile-100 phone-100">
      <div class="wojo form segment">
        <div class="wojo block fields">
          <div class="field">
            <label><?php echo Lang::$word->_PLG_UE_SELECT;?></label>
            <?php if($this->events):?>
            <a data-dropdown="#event_id" class="wojo light right fluid button"><?php echo Lang::$word->SELECT;?>
            <i class="icon chevron down"></i></a>
            <div class="wojo static dropdown small pointing top-left" id="event_id">
              <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
                <?php echo Utility::loopOptionsMultiple($this->events, "id", "title" . Lang::$lang, $this->data->event_id, "event_id");?>
              </div>
            </div>
            <?php else:?>
            <?php echo Lang::$word->_PLG_UE_NOEVENT;?>
            <?php endif;?>
          </div>
        </div>
      </div>
      <div class="center aligned">
        <a href="<?php echo Url::url("/admin/plugins");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
        <button type="button" data-url="plugins_/upevent" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
      </div>
    </div>
  </div>
</form>