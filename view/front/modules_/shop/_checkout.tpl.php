<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _checkout.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="shop" class="wojo-grid" action="<?php echo FMODULEURL;?>">
  <?php if(!$this->rows):?>
  <div class="row align center">
    <div class="columns screen-50">
      <div class="center aligned">
        <figure class="wojo normal basic image margin bottom">
          <img src="<?php echo UPLOADURL;?>/builder/cart.svg">
        </figure>
        <h4><?php echo Lang::$word->_MOD_SP_CARTE;?></h4>
        <p><?php echo Lang::$word->_MOD_SP_CARTE1;?></p>
        <a class="wojo primary rounded button" href="<?php echo Url::url('/' . $this->core->modname['shop']);?>"><?php echo Lang::$word->_MOD_SP_SUB3;?></a>
      </div>
    </div>
  </div>
  <?php else:?>
  <div class="row gutters">
    <div class="columns screen-65 tablet-60 mobile-100 phone-100">
      <h4><?php echo Lang::$word->_MOD_SP_SUB12;?></h4>
      <div class="wojo divider"></div>
      <div class="wojo form" id="sCheckout">
        <form id="wojo_form" name="wojo_form" method="post">
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->M_FNAME;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_FNAME;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->fname;?>" name="fname">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->M_LNAME;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_LNAME;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->lname;?>" name="lname">
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->M_EMAIL;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_EMAIL;?>" value="<?php if (App::Auth()->is_User()) echo App::Auth()->email;?>" name="email">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->M_PHONE;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_PHONE;?>" name="phone">
            </div>
          </div>
          <div class="wojo fields">
            <div class="field six wide">
              <label><?php echo Lang::$word->M_ADDRESS;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_ADDRESS;?>" value="<?php if (App::Auth()->is_User()) echo Auth::$userdata->address;?>" name="address">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->M_STATE;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_STATE;?>" value="<?php if (App::Auth()->is_User()) echo Auth::$userdata->state;?>" name="state">
            </div>
          </div>
          <div class="wojo fields">
            <div class="field wide">
              <label><?php echo Lang::$word->M_CITY;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_CITY;?>" value="<?php if (App::Auth()->is_User()) echo Auth::$userdata->city;?>" name="city">
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->M_COUNTRY;?>
                <i class="icon asterisk"></i></label>
              <select name="country">
                <?php echo Utility::loopOptions($this->countries, "abbr", "name", App::Auth()->country);?>
              </select>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->M_ZIP;?>
                <i class="icon asterisk"></i></label>
              <input type="text" placeholder="<?php echo Lang::$word->M_ZIP;?>" value="<?php if (App::Auth()->is_User()) echo Auth::$userdata->zip;?>" name="zip">
            </div>
          </div>
        </form>
      </div>
      <div class="wojo divider"></div>
      <?php if(!App::Auth()->is_User()):?>
      <?php echo Message::msgSingleError(Lang::$word->_MOD_DS_SUB10);?>
      <?php else:?>
      <?php if($this->gateways):?>
      <div class="wojo very relaxed divided fluid list">
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
      </div>
      <?php endif;?>
      <?php endif;?>
      <div id="shCheckout"></div>
    </div>
    <div class="columns screen-35 tablet-40 mobile-100 phone-100">
      <div class="wojo top attached card">
        <div class="header divided">
          <h5 class="basic"><?php echo Lang::$word->_MOD_SP_SUB4;?></h5>
        </div>
        <div class="wojo relaxed divided fluid list">
          <?php foreach($this->rows as $row):?>
          <div class="item align middle" data-id="<?php echo $row->id;?>">
            <div class="wojo small basic image">
              <img src="<?php echo Shop::hasThumb($row->thumb, $row->pid);?>" alt="">
            </div>
            <div class="content">
              <span class="wojo semi text"><small class="wojo secondary text"><?php echo $row->items;?>x</small>
              <?php echo $row->title;?></span>
              <div class="meta">
                <?php if($row->variants):?>
                <?php $vars = json_decode($row->variants);?>
                <?php foreach($vars as $var):?>
                <small>
                <b>
                <?php echo $var->title;?></b>: <?php echo $var->value;?></small>
                <?php endforeach;?>
                <?php endif;?>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
        <div class="wojo small divider"></div>
        <div class="content">
          <div class="wojo small relaxed fluid list">
            <div class="item align middle">
              <div class="content"><span class="wojo secondary text"><?php echo Lang::$word->_MOD_SP_SUB10;?> (<?php echo $this->totals->items;?>)</span></div>
              <div class="content auto wojo demi text"><?php echo Utility::formatMoney($this->totals->sub);?></div>
            </div>
            <div class="item align middle">
              <div class="content"><span class="wojo bld text"><?php echo Lang::$word->_MOD_SP_SUB9;?></span></div>
            </div>
          </div>
          <div class="wojo small very relaxed fluid list" id="sid">
            <?php if($this->shipping_opt == "free"):?>
            <div class="item">
              <div class="content auto">
                <div class="wojo checkbox radio fitted inline">
                  <input name="shipping" type="radio" value="0" id="shipping_0" checked="checked">
                  <label for="shipping_0"></label>
                </div>
              </div>
              <div class="content"><?php echo Lang::$word->_MOD_SP_FREE_SHIPPING;?>
                <p class="wojo small text"><?php echo Lang::$word->_MOD_SP_FREE_SHIPPING_INFO;?></p>
              </div>
            </div>
            <?php else:?>
            <?php foreach($this->shipping_opt as $so):?>
            <div class="item">
              <div class="content auto">
                <div class="wojo checkbox radio fitted inline">
                  <input name="shipping" type="radio" value="<?php echo $so->value;?>" id="shipping_<?php echo $so->id;?>" <?php echo ($this->shipping) ? Validator::getChecked($this->shipping->shipping_id, $so->id) : "";?>>
                  <label for="shipping_<?php echo $so->id;?>"></label>
                </div>
              </div>
              <div class="content"><?php echo Utility::formatMoney($so->value);?> - <?php echo $so->name;?>
                <p class="wojo small text"><?php echo $so->desc;?></p>
              </div>
            </div>
            <?php endforeach;?>
            <?php endif;?>
          </div>
          <div class="wojo small divider"></div>
          <div class="wojo small relaxed fluid list">
            <div class="item align middle">
              <div class="content"><span class="wojo secondary text"><?php echo Lang::$word->TRX_TAX;?></span></div>
              <div class="content auto wojo demi text"><?php echo ($this->totals->tax > 0) ? Utility::formatMoney($this->totals->tax) : "--";?></div>
            </div>
            <div class="item align middle">
              <div class="content"><span class="wojo secondary text"><?php echo Lang::$word->_MOD_SP_SHIPPING;?></span></div>
              <div class="content auto wojo demi text" id="shipping_c"><?php echo ($this->shipping) ? Utility::formatMoney($this->shipping->total) : "--";?></div>
            </div>
            <div class="item align middle">
              <div class="content"><span class="wojo secondary text"><?php echo Lang::$word->TRX_GRTOTAL;?></span></div>
              <div class="content auto wojo demi text" id="grand_c"><?php echo  Utility::formatMoney(($this->shipping) ? $this->shipping->total + $this->totals->grand : $this->totals->grand);?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>