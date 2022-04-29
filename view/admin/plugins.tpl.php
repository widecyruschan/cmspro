<?php
  /**
   * Plugins
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: plugins.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_plugins')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->

<h2 class="header"><?php echo Lang::$word->META_T28;?></h2>
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
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" value="<?php echo $this->data->{'info_' . $lang->abbr};?>" name="info_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="bodypost" placeholder="<?php echo Lang::$word->CONTENT;?>" name="body_<?php echo $lang->abbr;?>"><?php echo Url::out_url($this->data->{'body_' . $lang->abbr});?></textarea>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field ">
        <label><?php echo Lang::$word->PLG_CLASS;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->PLG_CLASS;?>" value="<?php echo $this->data->alt_class;?>" name="alt_class">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->PLG_SHOWTITLE;?></label>
        <div class="wojo checkbox radio toggle fitted inline">
          <input name="show_title" type="radio" value="1" id="show_title_1" <?php Validator::getChecked($this->data->show_title, 1); ?>>
          <label for="show_title_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio toggle fitted inline">
          <input name="show_title" type="radio" value="0" id="show_title_0" <?php Validator::getChecked($this->data->show_title, 0); ?>>
          <label for="show_title_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->ACTIVE;?></label>
        <div class="wojo checkbox radio toggle fitted inline">
          <input name="active" type="radio" value="1" id="active_1" <?php Validator::getChecked($this->data->active, 1); ?>>
          <label for="active_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio toggle fitted inline">
          <input name="active" type="radio" value="0" id="active_0" <?php Validator::getChecked($this->data->active, 0); ?>>
          <label for="active_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->PAG_JSCODE;?></label>
        <textarea placeholder="<?php echo Lang::$word->PAG_JSCODE;?>" name="jscode"><?php echo json_decode($this->data->jscode);?></textarea>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processPlugin" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->PLG_SUB2;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<h2 class="header"><?php echo Lang::$word->META_T29;?></h2>
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
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" name="info_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <textarea class="altpost" placeholder="<?php echo Lang::$word->CONTENT;?>" name="body_<?php echo $lang->abbr;?>"></textarea>
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
        <div class="field ">
          <label><?php echo Lang::$word->PLG_CLASS;?></label>
          <input type="text" placeholder="<?php echo Lang::$word->PLG_CLASS;?>" name="alt_class">
        </div>
        <div class="field">
          <label><?php echo Lang::$word->PLG_SHOWTITLE;?></label>
          <div class="wojo checkbox radio toggle fitted inline">
            <input name="show_title" type="radio" value="1" id="show_title_1">
            <label for="show_title_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio toggle fitted inline">
            <input name="show_title" type="radio" value="0" id="show_title_0" checked="checked">
            <label for="show_title_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->ACTIVE;?></label>
          <div class="wojo checkbox radio toggle fitted inline">
            <input name="active" type="radio" value="1" id="active_1" checked="checked">
            <label for="active_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio toggle fitted inline">
            <input name="active" type="radio" value="0" id="active_0">
            <label for="active_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->PAG_JSCODE;?></label>
          <textarea placeholder="<?php echo Lang::$word->PAG_JSCODE;?>" name="jscode"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processPlugin" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->PLG_SUB1;?></button>
  </div>
</form>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h2><?php echo Lang::$word->PLG_TITLE;?></h2>
    <p><?php echo Lang::$word->PLG_SUB;?></p>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->PLG_SUB1;?></a>
  </div>
</div>
<div class="row gutters align center">
  <div class="columns screen-40 tablet-50 mobile-100 phone-100">
    <div class="wojo form">
      <div class="wojo icon ajax input">
        <input name="find" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text" data-page="Plugin" data-type="page">
        <i class="icon find"></i>
        <div class="results"></div>
      </div>
    </div>
  </div>
</div>
<div class="center aligned margin bottom"><?php echo Validator::alphaBits(Url::url(Router::$path), "letter");?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->PLG_NOPLG;?></p>
</div>
<?php else:?>
<div class="row grid phone-1 mobile-1 tablet-2 screen-3 gutters">
  <?php foreach ($this->data as $row):?>
  <?php if(Auth::checkPlugAcl($row->plugalias)):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="content">
        <div class="center aligned"><img src="<?php echo $row->icon ? APLUGINURL . $row->icon : SITEURL . '/assets/images/basic_plugin.svg';?>" class="wojo normal inline image" alt="">
          <h6 class="truncate margin top"><?php echo $row->{'title' . Lang::$lang};?></h6>
        </div>
        <div class="row">
          <div class="columns">
            <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo icon primary inverted circular button"><i class="icon pencil"></i></a>
            <a data-set='{"option":[{"<?php echo $row->plugalias ? "delete" : "trash";?>": "<?php echo $row->plugalias ? "deletePlugin" : "trashPlugin";?>","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>}],"action":"<?php echo $row->plugalias ? "delete" : "trash";?>","parent":"#item_<?php echo $row->id;?>"}' class="wojo icon negative inverted circular button data"><i class="icon trash"></i></a>
          </div>
          <?php if($row->hasconfig):?>
          <div class="columns auto">
            <a href="<?php echo Url::url(Router::$path, $row->plugalias);?>" class="wojo icon dark inverted circular button"><i class="icon cogs"></i></a>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <?php endif;?>
  <?php endforeach;?>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php break;?>
<?php endswitch;?>