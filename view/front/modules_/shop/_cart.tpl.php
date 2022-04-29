<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _checkout.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="shop" class="wojo-grid" action="<?php echo FMODULEURL;?>">
  <?php if(!$this->rows):?>
  <div class="row align center">
    <div class="columns screen-50">
      <div class="center aligned">
        <figure class="wojo normal image margin bottom">
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
      <div class="row align middle">
        <div class="columns">
          <h4><?php echo Lang::$word->_MOD_SP_SUB8;?></h4>
        </div>
        <div class="columns auto"><?php echo $this->totals->items;?>
          <?php echo Lang::$word->ITEMS;?></div>
      </div>
      <div class="wojo very relaxed divided fluid list">
        <?php foreach($this->rows as $row):?>
        <div class="wojo item align middle" data-id="<?php echo $row->id;?>">
          <div class="wojo normal basic rounded image">
            <img src="<?php echo Shop::hasThumb($row->thumb, $row->pid);?>" alt="<?php echo $row->title;?>">
          </div>
          <div class="middle aligned content">
            <h5>
              <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>" class="secondary"><?php echo $row->title;?></a>
            </h5>
            <div class="meta">
              <?php if($row->variants):?>
              <?php $vars = json_decode($row->variants);?>
              <?php foreach($vars as $var):?>
              <small>
              <b>
              <?php echo $var->title;?></b>: <?php echo $var->value;?></small>
              <?php endforeach;?>
              <?php endif;?>
              <p class="wojo semi text">
                <?php echo $row->items;?> x <?php echo Utility::formatMoney($row->total);?>
                <small>
                <?php if($this->core->enable_tax and $row->price > 0) echo '+ ' . Lang::$word->TAX;?>
                </small>
              </p>
            </div>
            <div class="wojo form small fluid list">
              <div class="item">
                <div class="content">
                  <a class="secondary deleteCartItem" data-id="<?php echo $row->id;?>"><i class="icon trash"></i>
                  <?php echo Lang::$word->REMOVE;?>
                  </a>
                </div>
                <div class="content auto">
                  <select data-id="<?php echo $row->id;?>" name="qty">
                    <?php echo Utility::doRange(1, 10, 1, $row->items);?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
    <div class="columns screen-35 tablet-40 mobile-100 phone-100">
      <div class="wojo attached card">
        <div class="header divided">
          <h5 class="basic"><?php echo Lang::$word->_MOD_SP_SUB4;?></h5>
        </div>
        <div class="content">
          <div class="wojo small relaxed fluid list">
            <div class="item">
              <div class="content"><span class="wojo secondary text"><?php echo Lang::$word->_MOD_SP_SUB10;?> (<?php echo $this->totals->items;?>)</span></div>
              <div class="content auto wojo demi text"><?php echo Utility::formatMoney($this->totals->sub);?></div>
            </div>
            <div class="item">
              <div class="content"><span class="wojo secondary text"><?php echo Lang::$word->_MOD_SP_SUB9;?></span></div>
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
            <div class="item align middle">
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
        <div class="footer">
          <button type="button" data-url="<?php echo Url::url('/' . App::Core()->modname['shop'], App::Core()->modname['shop-checkout']);?>" class="wojo primary fluid button" id="checkout"><?php echo Lang::$word->_MOD_SP_SUB11;?></button>
        </div>
      </div>
    </div>
  </div>
  <?php endif;?>
</div>