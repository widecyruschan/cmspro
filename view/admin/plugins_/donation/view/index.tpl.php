<?php
  /**
   * Donation
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkPlugAcl('donation')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "edit": ?>
<!-- Start edit -->
<h2><?php echo Lang::$word->_PLG_DP_SUB4;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_SUB1;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo large basic input">
          <input type="text" placeholder="<?php echo Lang::$word->_PLG_DP_SUB1;?>" value="<?php echo $this->data->title;?>" name="title">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_TARGET;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <div class="wojo simple label">
            <?php echo Utility::currencySymbol();?>
          </div>
          <input type="text" placeholder="<?php echo Lang::$word->_PLG_DP_TARGET;?>" value="<?php echo $this->data->target_amount;?>" name="target_amount">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_SUB3;?>
          <i class="icon asterisk"></i></label>
        <select name="redirect_page">
          <?php echo Utility::loopOptions($this->pagelist, "id", "title" . Lang::$lang, $this->data->redirect_page);?>
        </select>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "donation");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/donation" data-action="processDonate" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<h3><?php echo Lang::$word->_PLG_DP_SUB;?></h3>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_SUB1;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo large basic input">
          <input type="text" placeholder="<?php echo Lang::$word->_PLG_DP_SUB1;?>" name="title">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_TARGET;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo labeled input">
          <div class="wojo simple label">
            <?php echo Utility::currencySymbol();?>
          </div>
          <input type="text" placeholder="<?php echo Lang::$word->_PLG_DP_TARGET;?>" name="target_amount">
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_SUB2;?>
          <i class="icon asterisk"></i></label>
        <a data-dropdown="#gateways" class="wojo light right button"><?php echo Lang::$word->SELECT;?>
        <i class="icon chevron down"></i></a>
        <div class="wojo static dropdown small pointing top-left" id="gateways">
          <div style="max-width:400px">
            <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
              <?php echo Utility::loopOptionsMultiple($this->gateways, "id", "name", false, "gateways");?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_DP_SUB3;?>
          <i class="icon asterisk"></i></label>
        <select name="redirect_page">
          <?php echo Utility::loopOptions($this->pagelist, "id", "title" . Lang::$lang);?>
        </select>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "donation");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/donation" data-action="processDonate" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h3><?php echo Lang::$word->_PLG_DP_TITLE;?></h3>
    <p class="wojo small text"><?php echo Lang::$word->_PLG_DP_INFO;?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_PLG_DP_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="centter aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold text"><?php echo Lang::$word->_PLG_DP_NODON;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-2 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <a data-content="<?php echo Lang::$word->EXPORT;?>" href="<?php echo APLUGINURL;?>donation/controller.php?action=exportDonations&amp;id=<?php echo $row->id;?>" class="wojo top right icon simple attached button"><i class="icon wysiwyg table"></i></a>
      <div class="content">
        <h4><?php echo $row->title;?></h4>
        <p><?php echo Lang::$word->_PLG_DP_TARGET;?>: <span class="wojo negative text"><?php echo Utility::formatMoney($row->total);?></span> / <span class="wojo positive text"><?php echo Utility::formatMoney($row->target_amount);?></span></p>
      </div>
      <div class="footer divided center aligned">
        <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo icon small primary button"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteDonation","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>", "url":"plugins_/donation"}' class="wojo icon small negative button data">
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