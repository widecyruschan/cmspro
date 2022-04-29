<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: (_shop_new.tpl.php, v1.00 2020-04-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_SP_META_T7;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form card">
    <div class="wojo lang tabs">
      <ul class="nav">
        <?php foreach($this->langlist as $lang):?>
        <li<?php echo ($lang->abbr == $this->core->lang) ? ' class="active"' : null;?>><a class="lang-color <?php echo Utility::colorToWord($lang->color);?>" data-tab="lang_<?php echo $lang->abbr;?>"><span class="flag icon <?php echo $lang->abbr;?>"></span><?php echo $lang->name;?></a>
        </li>
        <?php endforeach;?>
      </ul>
      <div class="tab gutters">
        <?php foreach($this->langlist as $lang):?>
        <div data-tab="lang_<?php echo $lang->abbr;?>" class="item">
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->NAME;?>
                <i class="icon asterisk"></i></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->ITEMSLUG;?></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->ITEMSLUG;?>" name="slug_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"></textarea>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->METAKEYS;?></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords_<?php echo $lang->abbr;?>"></textarea>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->METADESC;?></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description_<?php echo $lang->abbr;?>"></textarea>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PRICE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
          <input type="text" placeholder="<?php echo Lang::$word->PRICE;?>" name="price">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_PSALE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_PSALE;?>" name="price_sale">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_QTY;?>
          <i class="icon asterisk"></i></label>
        <div class="row horizontal gutters align middle">
          <div class="columns">
            <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_QTY;?>" name="quantity">
          </div>
          <div class="columns auto">
            <div class="wojo checkbox toggle fitted inline">
              <input name="subtract" type="checkbox" value="1" id="subtract">
              <label for="subtract"><?php echo Lang::$word->_MOD_SP_SUBSTOCK;?></label>
            </div>
          </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_STOCKID;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_STOCKID;?>"  name="stock_id">
      </div>
    </div>
    <div class="wojo fields">
      <div class="basic field">
        <label><?php echo Lang::$word->CATEGORIES;?></label>
        <div class="wojo simple segment">
          <div class="scrollbox h300">
            <div class="wojo relaxed divided list">
              <?php echo $this->droplist;?>
            </div>
          </div>
        </div>
      </div>
      <div class="basic field">
        <div class="margin bottom">
          <label class="label"><?php echo Lang::$word->MAINIMAGE;?></label>
          <input type="file" name="thumb" data-class="square" data-type="image" accept="image/png, image/jpeg">
        </div>
        <div class="wojo fields">
          <div class="field">
            <label><?php echo Lang::$word->_MOD_SP_WIDTH;?></label>
            <div class="wojo labeled input">
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_WIDTH;?>" name="width">
              <div class="wojo simple label"><?php echo App::Shop()->length;?></div>
            </div>
          </div>
          <div class="field">
            <label><?php echo Lang::$word->_MOD_SP_HEIGHT;?></label>
            <div class="wojo labeled input">
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_HEIGHT;?>" name="height">
              <div class="wojo simple label"><?php echo App::Shop()->length;?></div>
            </div>
          </div>
        </div>
        <div class="wojo fields">
          <div class="field">
            <label><?php echo Lang::$word->_MOD_SP_WEIGHT;?></label>
            <div class="wojo labeled input">
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_WEIGHT;?>" name="weight">
              <div class="wojo simple label"><?php echo App::Shop()->weight;?></div>
            </div>
          </div>
          <div class="field">
            <label><?php echo Lang::$word->_MOD_SP_LENGTH;?></label>
            <div class="wojo labeled input">
              <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_LENGTH;?>" name="length">
              <div class="wojo simple label"><?php echo App::Shop()->length;?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <h4>
      <?php echo Lang::$word->_MOD_SP_SHIPOPTS;?>
    </h4>
    <?php if($this->shipping):?>
    <?php foreach ($this->shipping as $srow) :?>
    <div class="wojo fields align middle">
      <div class="field four wide labeled">
        <label>
          <?php echo $srow->name;?></label>
      </div>
      <div class="field">
        <div class="wojo labeled input">
          <div class="wojo simple label"><?php echo Utility::currencySymbol();?></div>
          <input type="text" placeholder="<?php echo Lang::$word->PRICE;?>" value="<?php echo $this->shipping->{'shipping_opt_' . $srow->id}->value;?>" name="shipping_opt[<?php echo $srow->id;?>]">
        </div>
      </div>
    </div>
    <?php endforeach;?>
    <?php endif;?>
  </div>
  <a class="wojo icon dark medium semi right text" data-trigger="#uVariants" data-slide="true"><?php echo Lang::$word->_MOD_SP_VARIATIONS;?>
  <i class="icon chevron down"></i>
  </a>
  <div class="hide-all" id="uVariants">
    <a class="wojo small primary button newVariant"><i class="icon plus"></i>
    <?php echo Lang::$word->_MOD_SP_SUB22;?></a>
    <div id="varSets" class="row grid gutters screen-2 tablet-1 mobile-1 phone-1 gutters margin top"></div>
  </div>
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->ACTIVE;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="1" id="active_1" checked="checked">
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="active" type="radio" value="0" id="active_0">
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label>
          <?php echo Lang::$word->_MOD_SP_LABEL;?></label>
        <select name="label">
          <?php echo Utility::loopOptionsSimpleAlt(Shop::itemLabel());?>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_DAVAIL;?></label>
        <div class="wojo icon input">
          <input name="date_available" type="text" placeholder="<?php echo Lang::$word->_MOD_SP_DAVAIL;?>" value="<?php echo Date::doDate("calendar", Date::today());?>" readonly class="datepick">
          <i class="icon calendar alt"></i>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_SP_REWPOINT;?></label>
        <div class="wojo fluid input">
          <input type="text" placeholder="<?php echo Lang::$word->_MOD_SP_REWPOINT;?>" value="0" name="points">
        </div>
      </div>
    </div>
    <div class="wojo simple segment">
      <h5><?php echo Lang::$word->CF_TITLE;?></h5>
      <?php echo $this->custom_fields;?></div>
  </div>
  <div class="wojo form segment">
    <div class="field">
      <label><?php echo Lang::$word->IMAGES;?></label>
      <input type="file" name="images" id="images"  data-input="false" data-buttonText="<?php echo Lang::$word->MULTIPLE;?>" data-fields='{"action":"processImages","id":<?php echo App::Session()->get("shoptoken");?>}' class="filestyle" multiple>
      <div class="scrollbox margin top h300">
        <div class="row grid phone-1 mobile-2 tablet-3 screen-5 gutters" id="sortable"></div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "shop/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/shop" data-action="processItem" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_SP_ADD;?></button>
  </div>
</form>
<div id="shop-variant-option-prototype" class="hide-all">
  <div class="wojo small fields align bottom variantSection" data-id="0">
    <div class="field">
      <label><?php echo Lang::$word->NAME;?>
        <i class="icon asterisk"></i></label>
      <input name="variant_name" type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo Lang::$word->NAME;?>">
    </div>
    <div class="field">
      <label><?php echo Lang::$word->PRICE;?>
        <i class="icon asterisk"></i></label>
      <input name="variant_price" type="text" placeholder="<?php echo Lang::$word->PRICE;?>" value="1.00">
    </div>
    <div class="field">
      <label><?php echo Lang::$word->_MOD_SP_QTY;?>
        <i class="icon asterisk"></i></label>
      <input name="variant_qty" type="text" placeholder="<?php echo Lang::$word->_MOD_SP_QTY;?>" value="1">
    </div>
    <div class="auto field">
      <a class="wojo small negative icon fluid button removeVariant"><i class="icon trash"></i></a>
      <input type="hidden" name="variant_title" value="name">
      <input type="hidden" name="variant_id" value="0">
    </div>
  </div>
</div>