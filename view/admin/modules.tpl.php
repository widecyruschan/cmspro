<?php
  /**
   * Modules
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: modules.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_modules')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<h2 class="header"><?php echo Lang::$word->META_T30;?></h2>
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
            <div class="field five wide">
              <label><?php echo Lang::$word->NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo huge fluid input">
                <input type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" value="<?php echo $this->data->{'info_' . $lang->abbr};?>" name="info_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->METAKEYS;?><small><?php echo $lang->abbr;?></small></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METAKEYS;?>" name="keywords_<?php echo $lang->abbr;?>"><?php echo $this->data->{'keywords_' . $lang->abbr};?></textarea>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->METADESC;?><small><?php echo $lang->abbr;?></small></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->METADESC;?>" name="description_<?php echo $lang->abbr;?>"><?php echo $this->data->{'description_' . $lang->abbr};?></textarea>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processModule" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->MDL_SUB1;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<h2><?php echo Lang::$word->MDL_TITLE;?></h2>
<p><?php echo Lang::$word->MDL_SUB;?></p>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->MDL_NOMOD;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-3 gutters">
  <?php foreach ($this->data as $row):?>
  <?php if(Auth::checkModAcl($row->modalias)):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="content">
        <div class="center aligned">
          <img src="<?php echo $row->icon ? AMODULEURL . $row->icon : SITEURL . '/assets/images/basic_plugin.svg';?>" class="wojo normal inline image" alt="">
          <h6 class="truncate margin top"><?php echo $row->{'title' . Lang::$lang};?></h6>
        </div>
        <div class="row">
          <div class="columns">
            <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo icon inverted primary circular button"><i class="icon pencil"></i></a>
            <a data-set='{"option":[{"delete":"deleteModule","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>"}' class="wojo icon inverted negative circular button data">
            <i class="icon trash"></i>
            </a>
          </div>
          <div class="columns auto">
            <a href="<?php echo Url::url(Router::$path, $row->modalias);?>" class="wojo icon dark inverted circular button"><i class="icon cogs"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif;?>
  <?php endforeach;?>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>