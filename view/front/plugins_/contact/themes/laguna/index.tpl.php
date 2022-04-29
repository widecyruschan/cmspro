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
  <form id="wojo_form" name="wojo_form" method="post">
    <div class="wojo fields">
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->name;?>" name="name">
      </div>
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->M_EMAIL;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->email;?>" name="email">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <input type="text" placeholder="<?php echo Lang::$word->M_PHONE;?>" name="phone">
      </div>
      <div class="field">
        <select name="subject">
          <option value=""><?php echo Lang::$word->CF_SUBJECT_1;?></option>
          <option value="<?php echo Lang::$word->CF_SUBJECT_2;?>"><?php echo Lang::$word->CF_SUBJECT_2;?></option>
          <option value="<?php echo Lang::$word->CF_SUBJECT_3;?>"><?php echo Lang::$word->CF_SUBJECT_3;?></option>
          <option value="<?php echo Lang::$word->CF_SUBJECT_4;?>"><?php echo Lang::$word->CF_SUBJECT_4;?></option>
          <option value="<?php echo Lang::$word->CF_SUBJECT_5;?>"><?php echo Lang::$word->CF_SUBJECT_5;?></option>
          <option value="<?php echo Lang::$word->CF_SUBJECT_6;?>"><?php echo Lang::$word->CF_SUBJECT_6;?></option>
          <option value="<?php echo Lang::$word->CF_SUBJECT_7;?>"><?php echo Lang::$word->CF_SUBJECT_7;?></option>
        </select>
      </div>
    </div>
    <div class="wojo block fields">
      <div class="field">
        <textarea class="small" placeholder="<?php echo Lang::$word->MESSAGE;?>" name="notes"></textarea>
      </div>
      <div class="field">
        <div class="wojo right labeled fluid input">
          <input name="captcha" placeholder="<?php echo Lang::$word->CAPTCHA;?>" type="text">
          <div class="wojo simple passive button captcha"><?php echo Session::captcha();?></div>
        </div>
      </div>
      <div class="field">
        <div class="wojo checkbox">
          <input name="agree" type="checkbox" value="1" id="agree">
          <label for="agree"><a href="<?php echo Url::url('/' . App::Core()->system_slugs->policy[0]->{'slug' . Lang::$lang});?>" class="secondary dashed"><small><?php echo Lang::$word->AGREE;?></small></a>
          </label>
        </div>
      </div>
    </div>
    <div class="field">
      <button type="button" data-hide="true" data-action="processContact" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->CF_SEND;?></button>
    </div>
  </form>
</div>