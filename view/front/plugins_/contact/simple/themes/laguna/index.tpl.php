<?php
  /**
   * Contact
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo form">
  <form id="wojo_form_bcontact" name="wojo_form_bcontact" method="post">
    <div class="wojo fields">
      <div class="field">
        <div class="wojo basic input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->name;?>" name="name">
        </div>
      </div>
      <div class="field">
        <div class="wojo basic input">
          <input type="text" placeholder="<?php echo Lang::$word->M_EMAIL;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->email;?>" name="email">
        </div>
      </div>
    </div>
    <div class="wojo block fields">
      <div class="field">
        <div class="wojo basic input">
          <textarea class="small" placeholder="<?php echo Lang::$word->MESSAGE;?>" name="notes"></textarea>
        </div>
      </div>
      <div class="field">
        <div class="wojo basic input">
          <input name="captcha" placeholder="<?php echo Lang::$word->CAPTCHA;?>" type="text">
          <div class="wojo simple passive button captcha"><?php echo Session::captcha();?></div>
        </div>
      </div>
      <div class="field basic">
        <div class="wojo checkbox">
          <input name="agree" type="checkbox" value="1" id="agree">
          <label for="agree"><a href="<?php echo Url::url('/' . App::Core()->system_slugs->policy[0]->{'slug' . Lang::$lang});?>" class="secondary dashed"><small><?php echo Lang::$word->AGREE;?></small></a>
          </label>
        </div>
      </div>
    </div>
    <button type="button" data-hide="true" data-action="processContact" name="dosubmit" class="wojo primary fluid button"><?php echo Lang::$word->CF_SEND;?></button>
    <input type="hidden" name="subject" value="<?php echo Lang::$word->CF_SUBJECT_1;?>">
  </form>
</div>