<?php
  /**
   * Login
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: login.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<main>
  <div class="wojo-grid">
    <div class="row fullsize align center middle">
      <div class="columns screen-50 tablet-70 mobile-100 phone-100">
        <div class="center aligned">
          <a href="<?php echo SITEURL;?>/" class="logo">
          <?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
        </div>
        <div id="loginForm">
          <form method="post" id="login_form" name="wojo_form">
            <h3 class="divided center aligned"><?php echo Lang::$word->WELCOME;?>
              <span class="wojo semi primary text"><?php echo Lang::$word->BACK;?>!</span></h3>
            <p class="center aligned"><?php echo Lang::$word->M_SUB19;?></p>
            <div class="wojo form">
              <div class="wojo block fields">
                <div class="field">
                  <label><?php echo Lang::$word->M_EMAIL;?></label>
                  <div class="wojo icon input">
                    <i class="icon email"></i>
                    <input placeholder="<?php echo Lang::$word->M_EMAIL;?>" name="email" type="text">
                  </div>
                </div>
                <div class="field">
                  <div class="flex align spaced">
                    <label class="label"><?php echo Lang::$word->M_PASSWORD;?></label>
                    <span class="wojo mini text"><a id="passreset" class="black dashed"><?php echo Lang::$word->M_PASSWORD_RES;?>?</a>
                    </span>
                  </div>
                  <div class="wojo icon input">
                    <i class="icon lock"></i>
                    <input placeholder="********" name="password" type="password">
                  </div>
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
            <h3 class="divided center aligned"><?php echo Lang::$word->M_SUB27;?>
              <span class="wojo semi primary text"><?php echo Lang::$word->M_SUB27_1;?></span></h3>
            <p class="center aligned"><?php echo Lang::$word->M_SUB28;?></p>
            <div class="wojo form">
              <div class="wojo block fields">
                <div class="field">
                  <label><?php echo Lang::$word->M_EMAIL;?></label>
                  <div class="wojo icon input">
                    <i class="icon lock"></i>
                    <input placeholder="<?php echo Lang::$word->M_EMAIL;?>" name="pemail" type="email">
                  </div>
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
        <p class="wojo small text center aligned">Copyright &copy;<?php echo date('Y') . ' '. $this->core->company;?> Powered by <a href="http://tag.digital" target="_blank">tag.digital Limited</a></p>
      </div>
    </div>
  </div>
</main>