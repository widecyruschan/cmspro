<?php
  /**
   * Comments
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkModAcl('comments')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "settings": ?>
<h2><?php echo Lang::$word->_MOD_CM_TITLE1;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_SORTING;?>
          <i class="icon asterisk"></i></label>
        <select name="sorting">
          <option value="DESC" <?php echo Validator::getSelected($this->data->sorting, "DESC");?>>--- <?php echo Lang::$word->_MOD_CM_SORTING_T;?> ---</option>
          <option value="ASC" <?php echo Validator::getSelected($this->data->sorting, "ASC");?>>--- <?php echo Lang::$word->_MOD_CM_SORTING_B;?> ---</option>
        </select>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_DATE;?>
          <i class="icon asterisk"></i></label>
        <select name="dateformat">
          <?php echo Date::getShortDate($this->data->dateformat);?>
          <?php echo Date::getLongDate($this->data->dateformat);?>
        </select>
      </div>
      <div class="field auto">
        <label><?php echo Lang::$word->_MOD_CM_TSINCE;?></label>
        <div class="wojo checkbox toggle fitted inline">
          <input name="timesince" type="checkbox" value="1" id="timesince" <?php Validator::getChecked($this->data->timesince, 1); ?>>
          <label for="timesince"><?php echo Lang::$word->YES;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>
          <?php echo Lang::$word->_MOD_CM_CHAR;?>
        </label>
        <input name="char_limit" type="range" min="20" max="400" step="10" value="<?php echo $this->data->char_limit;?>" hidden data-suffix=" char" data-type="labels" data-labels="20,50,100,200,400">
      </div>
      <div class="field">
        <label>
          <?php echo Lang::$word->_MOD_CM_PERPAGE;?>
        </label>
        <input name="perpage" type="range" min="5" max="50" step="5" value="<?php echo $this->data->perpage;?>" hidden data-suffix=" itm" data-type="labels" data-labels="5,20,35,50">
      </div>
    </div>
    <div class="wojo auto wide divider"></div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_UNAME_R;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="username_req" type="radio" value="1" id="username_req_1" <?php Validator::getChecked($this->data->username_req, 1); ?>>
          <label for="username_req_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="username_req" type="radio" value="0" id="username_req_0" <?php Validator::getChecked($this->data->username_req, 0); ?>>
          <label for="username_req_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_RATING;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="rating" type="radio" value="1" id="rating_1" <?php Validator::getChecked($this->data->rating, 1); ?>>
          <label for="rating_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="rating" type="radio" value="0" id="rating_0" <?php Validator::getChecked($this->data->rating, 0); ?>>
          <label for="rating_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_CAPTCHA;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_captcha" type="radio" value="1" id="show_captcha_1" <?php Validator::getChecked($this->data->show_captcha, 1); ?>>
          <label for="show_captcha_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_captcha" type="radio" value="0" id="show_captcha_0" <?php Validator::getChecked($this->data->show_captcha, 0); ?>>
          <label for="show_captcha_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_REG_ONLY;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="public_access" type="radio" value="1" id="public_access_1" <?php Validator::getChecked($this->data->public_access, 1); ?>>
          <label for="public_access_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="public_access" type="radio" value="0" id="public_access_0" <?php Validator::getChecked($this->data->public_access, 0); ?>>
          <label for="public_access_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_AA;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="auto_approve" type="radio" value="1" id="auto_approve_1" <?php Validator::getChecked($this->data->auto_approve, 1); ?>>
          <label for="auto_approve_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="auto_approve" type="radio" value="0" id="auto_approve_0" <?php Validator::getChecked($this->data->auto_approve, 0); ?>>
          <label for="auto_approve_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_NOTIFY;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="notify_new" type="radio" value="1" id="notify_new_1" <?php Validator::getChecked($this->data->notify_new, 1); ?>>
          <label for="notify_new_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="notify_new" type="radio" value="0" id="notify_new_0" <?php Validator::getChecked($this->data->notify_new, 0); ?>>
          <label for="notify_new_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_CM_WORDS;?></label>
        <textarea placeholder="<?php echo Lang::$word->_MOD_CM_WORDS;?>" name="blacklist_words"><?php echo $this->data->blacklist_words;?></textarea>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules/comments");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/comments" data-action="processConfig" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>
<?php break;?>
<?php default: ?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->_MOD_CM_TITLE2;?></h2>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "settings/");?>" class="wojo icon button"><i class="icon cogs"></i>
    </a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->_MOD_CM_SUB3;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="content">
    <div class="row">
      <div class="columns">
        <p class="wojo semi medium text">
          <?php echo ($row->uname)? $row->uname : $row->username;?>
        </p>
        <div class="wojo small text"><?php echo $row->body;?></div>
        <span class="wojo tiny demi caps text">
        <?php echo Date::doDate("long_date", $row->created);?>
        </span>
      </div>
      <div class="columns auto"><a data-set='{"option":[{"iaction":"approve", "id":<?php echo $row->id;?>}], "url":"/modules_/comments/controller.php", "complete":"remove", "parent":"#item_<?php echo $row->id;?>"}' data-tooltip="<?php echo Lang::$word->_MOD_CM_SUB4;?>" class="wojo small icon button primary inverted iaction"><i class="icon check"></i></a>
        <a data-set='{"option":[{"delete": "deleteComment","title": "ID","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/comments"}'  class="wojo small icon button negative inverted data"><i class="icon trash"></i></a>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>