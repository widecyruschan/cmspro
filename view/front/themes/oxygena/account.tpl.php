<?php
/**
 * Account
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2020
 * @version $Id: account.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<main>
  <div id="dashboard">
    <div class="wojo-grid">
      <div class="row align middle">
        <div class="columns auto">
          <input type="file" name="avatar" data-process="true" data-action="avatar" data-class="rounded small" data-type="image" data-exist="<?php echo UPLOADURL;?>/avatars/<?php echo (Auth::$udata->avatar) ? Auth::$udata->avatar : 'blank.png';?>" accept="image/png, image/jpeg">
        </div>
        <div class="columns padding left">
          <h5 class="wojo white text">
            <?php echo Lang::$word->WELCOMEBACK;?>
            <span class="wojo demi text">
            <?php echo Auth::$udata->name;?>! </span>
          </h5>
          <p class="wojo white dimmed text">
            <?php echo Auth::$udata->email;?>
          </p>
        </div>
      </div>
      <div class="row align middle">
        <div class="columns mobile-100 phone-100">
          <ul class="wojo dash relaxed horizontal list">
            <li class="item<?php if (count($this->segments) == 1) echo ' active';?>">
              <a href="<?php echo Url::url('/' . $this->url);?>">
                <i class="icon membership"></i><?php echo Lang::$word->ADM_MEMBS;?>
              </a>
            </li>
            <li class="item<?php if (in_array('history', $this->segments)) echo ' active';?>">
              <a href="<?php echo Url::url('/' . $this->url, 'history');?>">
                <i class="icon history"></i><?php echo Lang::$word->HISTORY;?>
              </a>
            </li>
            <li class="item<?php if (in_array('settings', $this->segments)) echo ' active';?>">
              <a href="<?php echo Url::url('/' . $this->url, 'settings');?>">
                <i class="icon user profile"></i><?php echo Lang::$word->SETTINGS;?>
              </a>
            </li>
            <?php if(File::is_File(FMODPATH . 'digishop/_dashboard.tpl.php')):?>
            <li class="item<?php if (in_array('digishop', $this->segments)) echo ' active';?>">
              <a href="<?php echo Url::url('/' . $this->url, 'digishop');?>">
                <i class="icon download"></i><?php echo Lang::$word->DOWNLOADS;?>
              </a>
            </li>
            <?php endif;?>
            <?php if(File::is_File(FMODPATH . 'shop/_dashboard.tpl.php')):?>
            <li class="item<?php if (in_array('shop', $this->segments)) echo ' active';?>">
              <a href="<?php echo Url::url('/' . $this->url, 'shop');?>">
                <i class="icon bag"></i><?php echo Lang::$word->_MOD_SP_SUB13;?>
              </a>
            </li>
            <?php endif;?>
          </ul>
        </div>
        <div class="columns auto mobile-100 phone-100">
          <a class="wojo small transparent button" href="<?php echo Url::url('/logout');?>">
            <?php echo Lang::$word->LOGOUT;?>
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php switch(Url::segment($this->segments, 1)): case "history": ?>
  <?php include_once(THEMEBASE . '/_history.tpl.php');?>
  <?php break;?>
  <?php case "settings": ?>
  <?php include_once(THEMEBASE . '/_settings.tpl.php');?>
  <?php break;?>
  <?php case "validate": ?>
  <?php include_once(THEMEBASE . '/_validate.tpl.php');?>
  <?php break;?>
  <?php case "digishop": ?>
  <?php if(File::is_File(FMODPATH . 'digishop/_dashboard.tpl.php')):?>
  <?php include_once(FMODPATH . 'digishop/_dashboard.tpl.php');?>
  <?php endif;?>
  <?php break;?>
  <?php case "shop": ?>
  <?php if(File::is_File(FMODPATH . 'shop/_dashboard.tpl.php')):?>
  <?php include_once(FMODPATH . 'shop/_dashboard.tpl.php');?>
  <?php endif;?>
  <?php break;?>
  <?php default: ?>
  <?php include_once(THEMEBASE . '/_memberships.tpl.php');?>
  <?php break;?>
  <?php endswitch;?>
</main>