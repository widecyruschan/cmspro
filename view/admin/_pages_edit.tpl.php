<?php
  /**
   * Pages
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _pages_list.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->META_T9;?></h2>
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
              <label><?php echo Lang::$word->PAG_NAME;?><small><?php echo $lang->abbr;?></small>
                <i class="icon asterisk"></i></label>
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->{'title_' . $lang->abbr};?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->PAG_SLUG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo basic large input">
                <input type="text" placeholder="<?php echo Lang::$word->PAG_SLUG;?>" value="<?php echo $this->data->{'slug_' . $lang->abbr};?>" name="slug_<?php echo $lang->abbr;?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->PAG_CAPTION;?><small><?php echo $lang->abbr;?></small></label>
              <input type="text" placeholder="<?php echo Lang::$word->PAG_CAPTION;?>" value="<?php echo $this->data->{'caption_' . $lang->abbr};?>" name="caption_<?php echo $lang->abbr;?>">
            </div>
            <div class="field">
              <label><?php echo Lang::$word->BGIMG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo action input">
                <input id="bg_<?php echo $lang->abbr;?>" placeholder="<?php echo Lang::$word->BGIMG;?>" name="custom_bg_<?php echo $lang->abbr;?>" type="text" value="<?php echo $this->data->{'custom_bg_' . $lang->abbr};?>" readonly>
                <div class="wojo small simple primary button removebg">
                  <?php echo Lang::$word->REMOVE;?>
                </div>
                <div class="filepicker wojo small icon basic button" data-parent="#bg_<?php echo $lang->abbr;?>" data-ext="images"><i class="open folder icon"></i></div>
              </div>
            </div>
          </div>
          <?php if($this->data->page_type == "normal" or $this->data->page_type == "home" or $this->data->page_type == "policy"):?>
          <div class="wojo fields">
            <div class="field">
              <a class="wojo light button" href="<?php echo Url::url("/admin/builder/" . $lang->abbr, $this->data->id);?>"><i class="icon sliders horizontal"></i>
              <?php echo Lang::$word->PAG_SUB5;?></a>&nbsp;&nbsp;&nbsp;
              <a class="wojo light button" href="<?php echo Url::url("/admin/newbuilder/" . $lang->abbr, $this->data->id);?>"><i class="icon sliders horizontal"></i>
              <?php echo Lang::$word->PAG_SUB5;?></a>
              <?php /*?><textarea class="bodypost" name="body_<?php echo $lang->abbr;?>"><?php echo Url::out_url($this->data->{'body_' . $lang->abbr});?></textarea><?php */?>
            </div>
          </div>
          <?php endif;?>
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
    <div class="content">
      <div class="row gutters">
        <div class="columns screen-50 mobile-100">
          <div class="wojo block fields">
            <div class="field">
              <label><?php echo Lang::$word->PAG_ACCLVL;?></label>
              <select name="access" id="access_id" data-id="<?php echo $this->data->id;?>" class="access_id">
                <?php echo Utility::loopOptionsSimpleAlt($this->access_list, $this->data->access);?>
              </select>
            </div>
            <div class="field">
              <label><?php echo Lang::$word->PAG_JSCODE;?></label>
              <textarea class="small" placeholder="<?php echo Lang::$word->PAG_JSCODE;?>" name="jscode"><?php echo json_decode($this->data->jscode);?></textarea>
            </div>
          </div>
        </div>
        <div class="columns screen-50 mobile-100">
          <div class="wojo block fields">
            <div class="field">
              <label><?php echo Lang::$word->PAG_MEMLVL;?></label>
              <div id="membership">
                <?php if($this->data->membership_id == 0):?>
                <input disabled="disabled" type="text" value="<?php echo Lang::$word->PAG_NOMEM_REQ;?>" name="na">
                <?php else:?>
                <a data-wdropdown="#membership_id" class="wojo white right fluid button"><?php echo Lang::$word->ADM_MEMBS;?>
                <i class="icon chevron down"></i></a>
                <div class="wojo static dropdown small pointing top-left" id="membership_id">
                  <div class="row grid phone-1 mobile-1 tablet-2 screen-2">
                    <?php echo Utility::loopOptionsMultiple($this->membership_list, "id", "title" . Lang::$lang, $this->data->membership_id, "membership_id");?>
                  </div>
                </div>
                <?php endif;?>
              </div>
            </div>
            <div class="field" id="modshow">
              <input type="hidden" name="module_data" value="0">
            </div>
          </div>
        </div>
      </div>
      <div class="wojo fields">
        <div class="field">
          <label><?php echo Lang::$word->PUBLISHED;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="1" id="active_1" <?php Validator::getChecked($this->data->active, 1); ?>>
            <label for="active_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="active" type="radio" value="0" id="active_0" <?php Validator::getChecked($this->data->active, 0); ?>>
            <label for="active_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <div class="field">
          <label><?php echo Lang::$word->PAG_NOHEAD;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="show_header" type="radio" value="1" id="show_header_1" <?php Validator::getChecked($this->data->show_header, 1); ?>>
            <label for="show_header_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="show_header" type="radio" value="0" id="show_header_0" <?php Validator::getChecked($this->data->show_header, 0); ?>>
            <label for="show_header_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <?php if($this->data->page_type == "normal"):?>
        <div class="field">
          <label><?php echo Lang::$word->PAG_MDLCOMMENT;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="is_comments" type="radio" value="1" id="is_comments_1" <?php Validator::getChecked($this->data->is_comments, 1); ?>>
            <label for="is_comments_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="is_comments" type="radio" value="0" id="is_comments_0" <?php Validator::getChecked($this->data->is_comments, 0); ?>>
            <label for="is_comments_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <?php else:?>
        <input type="hidden" name="is_comments" value="0">
        <?php endif;?>
        <?php if(App::Auth()->usertype == "owner"):?>
        <div class="field">
          <label><?php echo Lang::$word->PAG_PGADM;?></label>
          <div class="wojo checkbox radio fitted inline">
            <input name="is_admin" type="radio" value="1" id="is_admin_1" <?php Validator::getChecked($this->data->is_admin, 1); ?>>
            <label for="is_admin_1"><?php echo Lang::$word->YES;?></label>
          </div>
          <div class="wojo checkbox radio fitted inline">
            <input name="is_admin" type="radio" value="0" id="is_admin_0" <?php Validator::getChecked($this->data->is_admin, 0); ?>>
            <label for="is_admin_0"><?php echo Lang::$word->NO;?></label>
          </div>
        </div>
        <?php else:?>
        <input type="hidden" name="is_admin" value="<?php echo $this->data->is_admin;?>">
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/pages");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-action="processPage" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->PAG_SUB3;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<script src="<?php echo ADMINVIEW;?>/js/page.js"></script>
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Page({
		  url: "<?php echo ADMINVIEW;?>/helper.php",
		  clang :"<?php echo Lang::$lang;?>",
		  lang :{
			  nomemreq :"<?php echo Lang::$word->PAG_NOMEM_REQ;?>",
			  select :"<?php echo Lang::$word->ADM_MEMBS;?>",
		  }
	  });
  });
// ]]>
</script>