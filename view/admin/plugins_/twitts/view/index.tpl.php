<?php
  /**
   * Twitts
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkPlugAcl('twitts')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<h2><?php echo Lang::$word->_PLG_TW_TITLE;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_KEY;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_TW_KEY;?>" value="<?php echo App::Twitts()->consumer_key;?>" name="consumer_key">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_SECRET;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_TW_SECRET;?>" value="<?php echo App::Twitts()->consumer_secret;?>" name="consumer_secret">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_TOKEN;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_TW_TOKEN;?>" value="<?php echo App::Twitts()->access_token;?>" name="access_token">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_TSECRET;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_TW_TSECRET;?>" value="<?php echo App::Twitts()->access_secret;?>" name="access_secret">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_USER;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_TW_USER;?>" value="<?php echo App::Twitts()->username;?>" name="username">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_SHOW_IMG;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_image" type="radio" value="1" id="show_image_1" <?php Validator::getChecked(App::Twitts()->show_image, 1); ?>>
          <label for="show_image_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_image" type="radio" value="0" id="show_image_0" <?php Validator::getChecked(App::Twitts()->show_image, 0); ?>>
          <label for="show_image_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_COUNT;?></label>
        <input name="counter" type="range" min="1" max="20" step="1" value="<?php echo App::Twitts()->counter;?>" hidden data-suffix=" itm">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_TRANS;?></label>
        <input name="speed" type="range" min="100" max="1200" step="100" value="<?php echo App::Twitts()->speed;?>" hidden data-suffix=" ms">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_TW_TRANS_T;?></label>
        <input name="timeout" type="range" min="1000" max="15000" step="1000" value="<?php echo App::Twitts()->timeout;?>" hidden data-suffix=" ms">
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/twitts" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>