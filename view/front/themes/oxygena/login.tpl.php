<?php
  /**
   * Login
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: login.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<header id="loginHeader">
<div class="row">
<div class="columns screen-33 tablet-30 mobile-hide phone-hide">
  <a href="<?php echo SITEURL;?>/" class="white logo">
    <?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
</div>
<div class="columns screen-hide tablet-hide mobile-100 phone-100">
  <a href="<?php echo SITEURL;?>/" class="dark logo">
    <?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
</div>
</header>
<main>
  <div class="row fullsize align middle">
    <div id="sOverlay" class="columns relative fullsize align middle flex-block screen-33 tablet-30 mobile-hide phone-hide">
      <div class="wSlider" style="height:100vh" data-wslider='{<?php echo (in_array(Core::$language, array("he", "ae", "ir"))) ? '"rtl":true,' : null;?>"items":1,"autoloop":true,"arrows":false,"buttons":false,"autoplay":true,"autoplaySpeed":"500", "autoplayHoverPause":false}'>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-1.jpg);height:100vh"></div>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-2.jpg);height:100vh"></div>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-3.jpg);height:100vh"></div>
        <div class="holder" style="background-position: top center;background-repeat: no-repeat;background-size: cover;background-image: url(<?php echo ADMINVIEW;?>/images/sidebar-4.jpg);height:100vh"></div>
      </div>
    </div>
    <div class="columns align middle center tablet-70 mobile-100 phone-100">
      <div class="wojo-grid">
        <div class="row align center">
          <div class="columns screen-50 tablet-80 mobile-100 phone-100">
            <div id="loginForm">
              <form method="post" id="login_form" name="wojo_form">
                <h3 class="wojo primary text"><?php echo Lang::$word->WELCOME;?>
                  <span class="wojo semi text"><?php echo Lang::$word->BACK;?></span></h3>
                <p><?php echo Lang::$word->M_SUB19;?></p>
                <div class="wojo form">
                  <div class="wojo block fields">
                    <div class="field">
                      <label><?php echo Lang::$word->M_EMAIL;?></label>
                      <input placeholder="<?php echo Lang::$word->M_EMAIL;?>" name="email" type="text">
                    </div>
                    <div class="field">
                      <div class="flex align spaced">
                        <label class="label"><?php echo Lang::$word->M_PASSWORD;?></label>
                        <span class="wojo mini text"><a id="passreset" class="secondary dashed"><?php echo Lang::$word->M_PASSWORD_RES;?>?</a>
                        </span>
                      </div>
                      <input placeholder="********" name="password" type="password">
                    </div>
                  </div>
                  <div class="wojo fields">
                    <div class="field align middle">
                      <p class="wojo small text"><?php echo Lang::$word->M_SUB20;?>
                        <a href="<?php echo Url::url('/' . App::Core()->system_slugs->register[0]->{'slug' . Lang::$lang});?>"><?php echo Lang::$word->M_SUB21;?>.</a>
                      </p>
                    </div>
                    <div class="field right aligned">
                      <button id="doLogin" class="wojo primary relaxed button" name="submit" type="button"><?php echo Lang::$word->LOGIN;?></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div id="passForm" class="hide-all">
              <form method="post" id="pass_form" name="pass_form">
                <h3 class="wojo primary text"><?php echo Lang::$word->M_SUB27;?>
                  <span class="wojo semi text"><?php echo Lang::$word->M_SUB27_1;?></span></h3>
                <p><?php echo Lang::$word->M_SUB28;?></p>
                <div class="wojo form">
                  <div class="wojo block fields">
                    <div class="field">
                      <label><?php echo Lang::$word->M_EMAIL;?></label>
                      <input placeholder="<?php echo Lang::$word->M_EMAIL;?>" name="pemail" type="email">
                    </div>
                  </div>
                  <div class="wojo fields">
                    <div class="field align middle">
                      <p class="wojo small text">
                        <a id="backToLogin"><?php echo Lang::$word->M_SUB14;?></a>
                      </p>
                    </div>
                    <div class="field right aligned">
                      <button id="doPassword" class="wojo primary relaxed button" name="submit" type="button"><?php echo Lang::$word->M_SUB29;?></button>
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
