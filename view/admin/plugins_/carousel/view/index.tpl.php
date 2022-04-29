<?php
  /**
   * Carousel
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkPlugAcl('carousel')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "edit": ?>
<!-- Start edit -->
<h2 class="header"><?php echo Lang::$word->_PLG_CRL_TITLE2;?></h2>
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
              <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"><?php echo Url::out_url($this->data->{'body_' . $lang->abbr});?></textarea>
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
        <label><?php echo Lang::$word->_PLG_CRL_SUB11;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="dots" type="radio" value="1" id="dots_1" <?php Validator::getChecked($this->data->dots, 1); ?>>
          <label for="dots_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="dots" type="radio" value="0" id="dots_0" <?php Validator::getChecked($this->data->dots, 0); ?>>
          <label for="dots_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_CRL_SUB12;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="nav" type="radio" value="1" id="nav_1" <?php Validator::getChecked($this->data->nav, 1); ?>>
          <label for="nav_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="nav" type="radio" value="0" id="nav_0" <?php Validator::getChecked($this->data->nav, 0); ?>>
          <label for="nav_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_CRL_SUB7;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="1" id="autoplay_1" <?php Validator::getChecked($this->data->autoplay, 1); ?>>
          <label for="autoplay_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="0" id="autoplay_0" <?php Validator::getChecked($this->data->autoplay, 0); ?>>
          <label for="autoplay_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_CRL_SUB14;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo icon input">
          <input placeholder="4" value="<?php echo $this->settings->responsive->{1024}->items;?>" type="text" name="large">
          <i class="icon desktop"></i>
        </div>
        <div class="wojo icon input">
          <input placeholder="2" value="<?php echo $this->settings->responsive->{769}->items;?>" type="text" name="medium">
          <i class="icon tablet"></i>
        </div>
        <div class="wojo icon input">
          <input placeholder="1" value="<?php echo $this->settings->responsive->{0}->items;?>" type="text" name="small">
          <i class="icon smartphone"></i>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_CRL_SUB8;?>
        </label>
        <div class="wojo labeled input">
          <input placeholder="<?php echo Lang::$word->_PLG_CRL_SUB8;?>" value="<?php echo $this->data->margin;?>" type="text" name="margin">
          <div class="wojo simple label"> px </div>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_CRL_SUB13;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="loop" type="radio" value="1" id="loop_1" <?php Validator::getChecked($this->settings->loop, 1); ?>>
          <label for="loop_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="loop" type="radio" value="0" id="loop_0" <?php Validator::getChecked($this->settings->loop, 0); ?>>
          <label for="loop_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "carousel");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/carousel" data-action="processPlayer" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<h2 class="header"><?php echo Lang::$word->_PLG_CRL_SUB2;?></h2>
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
              <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"></textarea>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="wojo form card">
    <div class="content">
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_PLG_CRL_SUB11;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="dots" type="radio" value="1" id="dots_1" checked="checked">
            <label for="dots_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="dots" type="radio" value="0" id="dots_0">
            <label for="dots_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_PLG_CRL_SUB12;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="nav" type="radio" value="1" id="nav_1">
            <label for="nav_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="nav" type="radio" value="0" id="nav_0" checked="checked">
            <label for="nav_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_PLG_CRL_SUB7;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoplay" type="radio" value="1" id="autoplay_1" checked="checked">
            <label for="autoplay_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="autoplay" type="radio" value="0" id="autoplay_0">
            <label for="autoplay_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->_PLG_CRL_SUB14;?>
            <i class="icon asterisk"></i></label>
          <div class="wojo icon input">
            <input placeholder="4" value="5" type="text" name="large">
            <i class="icon desktop"></i>
          </div>
          <div class="wojo  icon input">
            <input placeholder="2" value="3" type="text" name="medium">
            <i class="icon tablet"></i>
          </div>
          <div class="wojo  icon input">
            <input placeholder="1" value="1" type="text" name="small">
            <i class="icon smartphone"></i>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_PLG_CRL_SUB8;?>
          </label>
          <div class="wojo labeled input">
            <input placeholder="<?php echo Lang::$word->_PLG_CRL_SUB8;?>" type="text" name="margin">
            <div class="wojo simple label"> px </div>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->_PLG_CRL_SUB13;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="loop" type="radio" value="1" id="loop_1">
            <label for="loop_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="loop" type="radio" value="0" id="loop_0" checked="checked">
            <label for="loop_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "carousel");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/carousel" data-action="processPlayer" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h3><?php echo Lang::$word->_PLG_CRL_TITLE;?></h3>
    <p class="wojo small text"><?php echo Lang::$word->_PLG_CRL_SUB1;?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_PLG_CRL_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aigned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold text"><?php echo Lang::$word->_PLG_CRL_NOPLAY;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-2 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="content center aligned">
        <img src="<?php echo APLUGINURL;?>carousel/view/images/horizontal.png" class="wojo inline image" alt="">
        <h5><?php echo $row->{'title' . Lang::$lang};?></h5>
      </div>
      <div class="divided footer center aligned">
        <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo icon small primary button"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deletePlayer","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>", "url":"plugins_/carousel"}' class="wojo icon small negative button data">
        <i class="icon trash"></i>
        </a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>