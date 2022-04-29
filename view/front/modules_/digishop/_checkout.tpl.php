<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _checkout.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="digishop" action="<?php echo FMODULEURL;?>">
  <div class="row gutters">
    <div class="columns screen-60 tablet-50 mobile-100 phone-100">
      <h2><?php echo Lang::$word->_MOD_DS_SUB7;?></h2>
      <?php if(!$this->rows):?>
      <?php echo Message::msgSingleInfo(Lang::$word->_MOD_DS_NOCART);?>
      <?php else:?>
      <?php foreach($this->rows as $row):?>
      <div class="wojo card">
        <div class="row">
          <div class="columns auto screen-30 phone-100"><img src="<?php echo Digishop::hasThumb($row->thumb, $row->pid);?>" alt="" class="wojo rounded image"></div>
          <div class="columns full padding phone-100">
            <h5>
              <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>" class="secondary"><?php echo $row->title;?></a>
            </h5>
            <span class="wojo medium semi text"><?php echo $row->items;?> x <?php echo Utility::formatMoney($row->price);?>
            <small>
            <?php if($this->core->enable_tax and $row->price > 0) echo '+ ' . Lang::$word->TAX;?>
            </small></span>
          </div>
        </div>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
    <div class="columns screen-40 tablet-50 mobile-100 phone-100">
      <h4><?php echo Lang::$word->_MOD_DS_SUB8;?></h4>
      <?php if($this->rows):?>
      <div class="wojo segment">
        <div class="wojo very relaxed divided fluid list">
          <div class="item">
            <div class="content"><?php echo Lang::$word->_MOD_DS_SUB9;?></div>
            <div class="content auto"><?php echo $this->totals->sub;?></div>
          </div>
          <div class="item">
            <div class="content"><?php echo Lang::$word->TRX_TAX;?></div>
            <div class="content auto"><?php echo Utility::formatNumber($this->totals->sub * $this->tax);?></div>
          </div>
          <div class="item highlite">
            <div class="content"><span class="header"><?php echo Lang::$word->TRX_GRTOTAL;?></span></div>
            <div class="content auto"><span class="header"><?php echo Utility::formatMoney($this->tax * $this->totals->grand + $this->totals->grand);?></span></div>
          </div>
          <?php if(!App::Auth()->is_User()):?>
          <?php echo Message::msgSingleError(Lang::$word->_MOD_DS_SUB10);?>
          <?php else:?>
          <?php if($this->gateways):?>
          <?php foreach($this->gateways as $grow):?>
          <div class="item align middle">
            <div class="content">
              <div class="wojo checkbox radio fitted inline">
                <input name="gateway" type="radio" value="<?php echo $grow->id;?>" id="g_<?php echo $grow->id;?>">
                <label for="g_<?php echo $grow->id;?>"><?php echo $grow->displayname;?></label>
              </div>
            </div>
            <div class="content auto"><img src="<?php echo SITEURL;?>/gateways/<?php echo $grow->dir;?>/logo_large.png" alt="" class="wojo small avatar image"></div>
          </div>
          <?php endforeach;?>
          <?php endif;?>
          <?php endif;?>
        </div>
      </div>
      <?php endif;?>
      <div id="dCheckout"></div>
    </div>
  </div>
</div>