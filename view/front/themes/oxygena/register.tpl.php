<?php
  /**
   * Register
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: register.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<header id="loginHeader">
<div class="row">
<div class="columns screen-33 tablet-hide mobile-hide phone-hide">
  <a href="<?php echo SITEURL;?>/" class="white logo">
    <?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
</div>
<div class="columns screen-hide tablet-100 mobile-100 phone-100">
  <a href="<?php echo SITEURL;?>/" class="dark logo">
    <?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
</div>
</header>
<main>
  <div class="row fullsize">
    <div id="sOverlay" class="columns relative fullsize flex-block screen-33 tablet-hide mobile-hide phone-hide">
      <div class="wSlider" style="height:100vh" data-wslider='{<?php echo (in_array(Core::$language, array("he", "ae", "ir"))) ? '"rtl":true,' : null;?>"items":1,"autoloop":true,"arrows":false,"buttons":false,"autoplay":true,"autoplaySpeed":"500", "autoplayHoverPause":false}'>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-1.jpg);height:100vh"></div>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-2.jpg);height:100vh"></div>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-3.jpg);height:100vh"></div>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-4.jpg);height:100vh"></div>
      </div>
    </div>
    <div class="columns align center self middle tablet-100 mobile-100 phone-100">
      <div class="wojo-grid">
        <div class="row align center">
          <div class="columns screen-50 tablet-80 mobile-100 phone-100">
            <div id="regForm">
              <form method="post" id="reg_form" name="reg_form">
                <h3 class="wojo primary text"><?php echo Lang::$word->M_SUB30;?> <span class="wojo semi text"><?php echo $this->core->company;?></span></h3>
                <p><?php echo Lang::$word->M_SUB23;?></p>
                <div class="wojo form">
                  <div class="wojo block fields">
                    <div class="field">
                      <label><?php echo Lang::$word->M_EMAIL;?>
                        <i class="icon asterisk"></i></label>
                      <input name="email" type="email" placeholder="<?php echo Lang::$word->M_EMAIL;?>">
                    </div>
                    <div class="field">
                      <label><?php echo Lang::$word->M_PASSWORD;?>
                        <i class="icon asterisk"></i></label>
                      <input type="password" name="password" placeholder="********">
                    </div>
                  </div>
                  <div class="wojo fields">
                    <div class="field">
                      <label><?php echo Lang::$word->M_FNAME;?>
                        <i class="icon asterisk"></i></label>
                      <input name="fname" type="text" placeholder="<?php echo Lang::$word->M_FNAME;?>">
                    </div>
                    <div class="field">
                      <label><?php echo Lang::$word->M_LNAME;?>
                        <i class="icon asterisk"></i></label>
                      <input name="lname" type="text" placeholder="<?php echo Lang::$word->M_LNAME;?>">
                    </div>
                  </div>
                  <?php echo $this->custom_fields;?>
                  <?php if($this->core->enable_tax):?>
                  <div class="wojo block fields">
                    <div class="field">
                      <label><?php echo Lang::$word->M_ADDRESS;?>
                        <i class="icon asterisk"></i></label>
                      <input type="text" name="address" placeholder="<?php echo Lang::$word->M_ADDRESS;?>">
                    </div>
                  </div>
                  <div class="wojo fields">
                    <div class="field">
                      <label><?php echo Lang::$word->M_CITY;?>
                        <i class="icon asterisk"></i></label>
                      <input type="text" name="city" placeholder="<?php echo Lang::$word->M_CITY;?>">
                    </div>
                    <div class="field">
                      <label><?php echo Lang::$word->M_STATE;?>
                        <i class="icon asterisk"></i></label>
                      <input type="text" name="state" placeholder="<?php echo Lang::$word->M_STATE;?>">
                    </div>
                  </div>
                  <div class="wojo fields">
                    <div class="field three wide">
                      <label>
                        <?php echo Lang::$word->M_ZIP;?>
                        <i class="icon asterisk"></i></label>
                      <input type="text" name="zip">
                    </div>
                    <div class="field">
                      <label>
                        <?php echo Lang::$word->M_COUNTRY;?>
                        <i class="icon asterisk"></i></label>
                      <select name="country">
                        <?php echo Utility::loopOptions($this->clist, "abbr", "name");?>
                      </select>
                    </div>
                  </div>
                  <?php endif;?>
                  <div class="wojo block fields">
                    <div class="field">
                      <label><?php echo Lang::$word->CAPTCHA;?>
                        <i class="icon asterisk"></i></label>
                      <div class="wojo labeled input">
                        <input placeholder="<?php echo Lang::$word->CAPTCHA;?>" name="captcha" type="text">
                        <span class="wojo simple label">
                        <?php echo Session::captcha();?>
                        </span>
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
                  <div class="wojo fields align middle">
                    <div class="field"><span class="wojo small secondary text"><?php echo Lang::$word->M_SUB31;?></span>
                      <a href="<?php echo Url::url('/' . $this->core->system_slugs->login[0]->{'slug' . Lang::$lang});?>"><span class="wojo small text"><?php echo Lang::$word->LOGIN;?>.</span></a>
                    </div>
                    <div class="field auto">
                      <button class="wojo primary button" data-action="register" name="dosubmit" type="button"><?php echo Lang::$word->M_SUB24;?></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<p id="loginFooter">Copyright &copy;<?php echo date('Y') . ' '. $this->core->company;?> Powered by <a href="http://tag.digital" target="_blank">tag.digital Limited</a></p>