<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _shop_vriations.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments, 4)): case "edit": ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->_MOD_SP_META_T7;?>
      <small>(<?php echo $this->row->name;?>)</small></h2>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a id="addOption" class="wojo small dark stacked  button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_SP_NEW_O;?></a>
  </div>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->TITLE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo large basic input">
          <input type="text" placeholder="<?php echo Lang::$word->TITLE;?>" value="<?php echo $this->row->name;?>" name="title">
        </div>
      </div>
    </div>
    <div id="varList" class="row grid screen-4 tablet-4 mobile-1 phone-1 gutters">
      <?php if($this->data):?>
      <?php foreach($this->data as $row):?>
      <div class="columns">
        <div class="wojo action input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $row->name;?>" name="name[]">
          <a class="wojo small simple negative icon button delOption"><i class="icon trash"></i></a>
        </div>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "shop/variations/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/shop" data-action="processVariation" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_SP_UPDATEVAR;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->row->id;?>">
</form>
<div id="shop-option-clone" class="hide-all">
  <div class="columns">
    <div class="wojo action input">
      <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="" name="name[]">
      <a class="wojo small simple negative icon button delOption"><i class="icon trash"></i></a>
    </div>
  </div>
</div>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->_MOD_SP_META_T7;?></h2>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a id="addOption" class="wojo dark small stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_SP_NEW_O;?></a>
  </div>
</div>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->TITLE;?>
          <i class="icon asterisk"></i></label>
        <div class="wojo large basic input">
          <input type="text" placeholder="<?php echo Lang::$word->TITLE;?>"  name="title">
        </div>
      </div>
    </div>
    <div id="varList" class="row grid screen-4 tablet-4 mobile-1 phone-1 gutters">
      <div class="columns">
        <div class="wojo input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name[]">
          <a class="wojo small simple negative icon button delOption"><i class="icon trash"></i></a>
        </div>
      </div>
      <div class="columns">
        <div class="wojo action input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name[]">
          <a class="wojo small simple negative icon button delOption"><i class="icon trash"></i></a>
        </div>
      </div>
      <div class="columns">
        <div class="wojo action input">
          <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="name[]">
          <a class="wojo small simple negative icon button delOption"><i class="icon trash"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "shop/variations/");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/shop" data-action="processVariation" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_SP_NEWEVAR;?></button>
  </div>
</form>
<div id="shop-option-clone" class="hide-all">
  <div class="columns">
    <div class="wojo action input">
      <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="" name="name[]">
      <a class="wojo small simple negative icon button delOption"><i class="icon trash"></i></a>
    </div>
  </div>
</div>
<?php break;?>
<?php default: ?>
<div class="row gutters align-middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->_MOD_SP_TITLE1;?></h2>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i>
    <?php echo Lang::$word->_MOD_SP_NEW_F;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_SP_NOFILTER;?></p>
</div>
<?php else:?>
<div class="row grid screen-4 tablet-2 mobile-1 phone-1 gutters" id="sortable-f">
  <?php foreach ($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="wojo attached segment">
      <div class="wojo simple small icon top left attached button handle"><i class="icon reorder"></i></div>
      <h5 class="content-center">
        <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="inverted"><?php echo $row->name;?></a>
      </h5>
      <div class="wojo small icon bottom simple right attached button">
        <a data-set='{"option":[{"delete": "deleteVariant","title": "<?php echo Validator::sanitize($row->name, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete", "url":"modules_/shop","parent":"#item_<?php echo $row->id;?>"}' class="data">
        <i class="icon negative trash"></i>
        </a>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>