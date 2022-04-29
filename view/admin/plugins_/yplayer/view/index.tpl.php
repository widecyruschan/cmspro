<?php
  /**
   * Yplayer
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkPlugAcl('yplayer')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "edit": ?>
<!-- Start edit -->
<h2 class="header"><?php echo Lang::$word->_PLG_YPL_TITLE2;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" value="<?php echo $this->data->title;?>" name="title">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB11;?></label>
        <select name="playlist_type">
          <option value="horizontal" <?php echo Validator::getSelected($this->data->layout,"horizontal");?>><?php echo Lang::$word->HORIZONTAL;?></option>
          <option value="vertical" <?php echo Validator::getSelected($this->data->layout, "vertical");?>><?php echo Lang::$word->VERTICAL;?></option>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB20;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="mode" type="radio" value="playlist" id="playlist" <?php Validator::getChecked($this->row->playlist, true); ?>>
          <label for="playlist"><?php echo Lang::$word->_PLG_YPL_SUB3;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="mode" type="radio" value="channel" id="channel" <?php Validator::getChecked($this->row->channel, true); ?>>
          <label for="channel"><?php echo Lang::$word->_PLG_YPL_SUB4;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="mode" type="radio" value="videos" id="videos" <?php Validator::getChecked($this->row->videos, true); ?>>
          <label for="videos"><?php echo Lang::$word->_PLG_YPL_SUB6;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB21;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_YPL_SUB21;?>" value="<?php echo ($this->row->playlist ? $this->row->playlist : ($this->row->channel ? $this->row->channel : $this->row->videos));;?>" name="video_id">
        <p class="wojo small text"><?php echo Lang::$word->_PLG_YPL_SUB6_I;?></p>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB7;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="pagination" type="radio" value="1" id="pagination_1" <?php Validator::getChecked($this->row->pagination, 1); ?>>
          <label for="pagination_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="pagination" type="radio" value="0" id="pagination_0" <?php Validator::getChecked($this->row->pagination, 0); ?>>
          <label for="pagination_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB9;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="continuous" type="radio" value="1" id="continuous_1" <?php Validator::getChecked($this->row->continuous, 1); ?>>
          <label for="continuous_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="continuous" type="radio" value="0" id="continuous_0" <?php Validator::getChecked($this->row->continuous, 0); ?>>
          <label for="continuous_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB16;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="1" id="autoplay_1" <?php Validator::getChecked($this->row->autoplay, 1); ?>>
          <label for="autoplay_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="0" id="autoplay_0" <?php Validator::getChecked($this->row->autoplay, 0); ?>>
          <label for="autoplay_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB18;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="force_hd" type="radio" value="1" id="force_hd_1" <?php Validator::getChecked($this->row->force_hd, 1); ?>>
          <label for="force_hd_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="force_hd" type="radio" value="0" id="force_hd_0" <?php Validator::getChecked($this->row->force_hd, 0); ?>>
          <label for="force_hd_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB12;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_playlist" type="radio" value="1" id="show_channel_in_playlist_1" <?php Validator::getChecked($this->row->show_channel_in_playlist, 1); ?>>
          <label for="show_channel_in_playlist_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_playlist" type="radio" value="0" id="show_channel_in_playlist_0" <?php Validator::getChecked($this->row->show_channel_in_playlist, 0); ?>>
          <label for="show_channel_in_playlist_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB13;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_title" type="radio" value="1" id="show_channel_in_title_1" <?php Validator::getChecked($this->row->show_channel_in_title, 1); ?>>
          <label for="show_channel_in_title_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_title" type="radio" value="0" id="show_channel_in_title_0" <?php Validator::getChecked($this->row->show_channel_in_title, 0); ?>>
          <label for="show_channel_in_title_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB17;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="share_control" type="radio" value="1" id="share_control_1" <?php Validator::getChecked($this->row->share_control, 1); ?>>
          <label for="share_control_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="share_control" type="radio" value="0" id="share_control_0" <?php Validator::getChecked($this->row->share_control, 0); ?>>
          <label for="share_control_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB10;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_playlist" type="radio" value="1" id="show_playlist_1" <?php Validator::getChecked($this->row->show_playlist, 1); ?>>
          <label for="show_playlist_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_playlist" type="radio" value="0" id="show_playlist_0" <?php Validator::getChecked($this->row->show_playlist, 0); ?>>
          <label for="show_playlist_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB8;?></label>
        <input name="max_results" type="range" min="1" max="50" step="1" value="<?php echo $this->row->max_results;?>" hidden data-suffix=" itm">
      </div>
    </div>
  </div>
  <div class="wojo form segment">
    <h3><?php echo Lang::$word->_PLG_YPL_SUB19;?></h3>
    <div class="wojo fields">
      <div class="field">
        <label>Controls BG</label>
        <input type="text" value="<?php echo $this->row->colors->controls_bg;?>" data-wcolor="full" name="controls_bg" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->controls_bg;?>"}' readonly>
      </div>
      <div class="field">
        <label>Time Text</label>
        <input type="text" value="<?php echo $this->row->colors->time_text;?>" name="time_text" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->time_text;?>"}' readonly>
      </div>
      <div class="field">
        <label>Fill</label>
        <input type="text" value="<?php echo $this->row->colors->fill;?>" name="fill" data-color="full" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->fill;?>"}' readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>Buttons</label>
        <input type="text" value="<?php echo $this->row->colors->buttons;?>" name="buttons" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->buttons;?>"}' readonly>
      </div>
      <div class="field">
        <label>Buttons Hover</label>
        <input type="text" value="<?php echo $this->row->colors->buttons_hover;?>" name="buttons_hover" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->buttons_hover;?>"}' readonly>
      </div>
      <div class="field">
        <label>Buttons Active</label>
        <input type="text" value="<?php echo $this->row->colors->buttons_active;?>" name="buttons_active" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->buttons_active;?>"}' readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>Playlist Overlay</label>
        <input type="text" value="<?php echo $this->row->colors->playlist_overlay;?>" name="playlist_overlay" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->playlist_overlay;?>"}' readonly>
      </div>
      <div class="field">
        <label>Playlist Title</label>
        <input type="text" value="<?php echo $this->row->colors->playlist_title;?>" name="playlist_title" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->playlist_title;?>"}' readonly>
      </div>
      <div class="field">
        <label>Playlist Channel</label>
        <input type="text" value="<?php echo $this->row->colors->playlist_channel;?>" name="playlist_channel" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->playlist_channel;?>"}' readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>Video Title</label>
        <input type="text" value="<?php echo $this->row->colors->video_title;?>" name="video_title" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->video_title;?>"}' readonly>
      </div>
      <div class="field">
        <label>Video Channel</label>
        <input type="text" value="<?php echo $this->row->colors->video_channel;?>" name="video_channel" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->video_channel;?>"}' readonly>
      </div>
      <div class="field">
        <label>Bar BG</label>
        <input type="text" value="<?php echo $this->row->colors->bar_bg;?>" name="bar_bg" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "<?php echo $this->row->colors->bar_bg;?>"}' readonly>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "yplayer");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/yplayer" data-action="processPlayer" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
  <input type="hidden" name="id" value="<?php echo $this->data->id;?>">
</form>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<h2 class="header"><?php echo Lang::$word->_PLG_YPL_SUB2;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
  <div class="wojo form segment">
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->NAME;?>
          <i class="icon asterisk"></i></label>
        <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB11;?></label>
        <select name="playlist_type">
          <option value="horizontal" selected="selected"><?php echo Lang::$word->HORIZONTAL;?></option>
          <option value="vertical"><?php echo Lang::$word->VERTICAL;?></option>
        </select>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB20;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="mode" type="radio" value="playlist" id="playlist">
          <label for="playlist"><?php echo Lang::$word->_PLG_YPL_SUB3;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="mode" type="radio" value="channel" id="channel">
          <label for="channel"><?php echo Lang::$word->_PLG_YPL_SUB4;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="mode" type="radio" value="videos" id="videos" checked="checked">
          <label for="videos"><?php echo Lang::$word->_PLG_YPL_SUB6;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB21;?></label>
        <input type="text" placeholder="<?php echo Lang::$word->_PLG_YPL_SUB21;?>" name="video_id">
        <p class="wojo small text"><?php echo Lang::$word->_PLG_YPL_SUB6_I;?></p>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB7;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="pagination" type="radio" value="1" id="pagination_1" checked="checked">
          <label for="pagination_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="pagination" type="radio" value="0" id="pagination_0">
          <label for="pagination_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB9;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="continuous" type="radio" value="1" id="continuous_1" checked="checked">
          <label for="continuous_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="continuous" type="radio" value="0" id="continuous_0">
          <label for="continuous_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB16;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="1" id="autoplay_1">
          <label for="autoplay_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="autoplay" type="radio" value="0" id="autoplay_0" checked="checked">
          <label for="autoplay_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB18;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="force_hd" type="radio" value="1" id="force_hd_1">
          <label for="force_hd_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="force_hd" type="radio" value="0" id="force_hd_0"checked="checked">
          <label for="force_hd_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB12;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_playlist" type="radio" value="1" id="show_channel_in_playlist_1" checked="checked">
          <label for="show_channel_in_playlist_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_playlist" type="radio" value="0" id="show_channel_in_playlist_0">
          <label for="show_channel_in_playlist_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB13;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_title" type="radio" value="1" id="show_channel_in_title_1" checked="checked">
          <label for="show_channel_in_title_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_channel_in_title" type="radio" value="0" id="show_channel_in_title_0">
          <label for="show_channel_in_title_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB17;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="share_control" type="radio" value="1" id="share_control_1" checked="checked">
          <label for="share_control_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="share_control" type="radio" value="0" id="share_control_0">
          <label for="share_control_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB10;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_playlist" type="radio" value="1" id="show_playlist_1" checked="checked">
          <label for="show_playlist_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="show_playlist" type="radio" value="0" id="show_playlist_0">
          <label for="show_playlist_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_PLG_YPL_SUB8;?></label>
        <input name="max_results" type="range" min="1" max="50" step="1" value="30" hidden data-suffix=" itm">
      </div>
    </div>
  </div>
  
  <div class="wojo form segment">
    <h3><?php echo Lang::$word->_PLG_YPL_SUB19;?></h3>
    <div class="wojo fields">
      <div class="field">
        <label>Controls BG</label>
        <input type="text" value="rgba(0,0,0,.75" data-wcolor="full" name="controls_bg" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(0,0,0,.75"}' readonly>
      </div>
      <div class="field">
        <label>Time Text</label>
        <input type="text" value="#FFFFFF" name="time_text" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "#FFFFFF"}' readonly>
      </div>
      <div class="field">
        <label>Fill</label>
        <input type="text" value="#FFFFFF" name="fill" data-color="full" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "#FFFFFF"}' readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>Buttons</label>
        <input type="text" value="rgba(255, 255, 255, 0.5)" name="buttons" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(255, 255, 255, 0.5)"}' readonly>
      </div>
      <div class="field">
        <label>Buttons Hover</label>
        <input type="text" value="#FFFFFF" name="buttons_hover" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "#FFFFFF"}' readonly>
      </div>
      <div class="field">
        <label>Buttons Active</label>
        <input type="text" value="rgba(255,255,255,1)" name="buttons_active" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(255,255,255,1)>"}' readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>Playlist Overlay</label>
        <input type="text" value="rgba(0,0,0,.75)" name="playlist_overlay" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(0,0,0,.75)"}' readonly>
      </div>
      <div class="field">
        <label>Playlist Title</label>
        <input type="text" value="#FFFFFF" name="playlist_title" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "#FFFFFF"}' readonly>
      </div>
      <div class="field">
        <label>Playlist Channel</label>
        <input type="text" value="rgba(255, 0, 0, 0.35)" name="playlist_channel" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(255, 0, 0, 0.35)"}' readonly>
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label>Video Title</label>
        <input type="text" value="#FFFFFF" name="video_title" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "#FFFFFF"}' readonly>
      </div>
      <div class="field">
        <label>Video Channel</label>
        <input type="text" value="rgba(255, 0, 0, 0.35)" name="video_channel" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(255, 0, 0, 0.35)>"}' readonly>
      </div>
      <div class="field">
        <label>Bar BG</label>
        <input type="text" value="rgba(255,255,255,.5)" name="bar_bg" data-wcolor="full" data-color='{"type":"component", "showInitial": true, "showAlpha": true, "color": "rgba(255,255,255,.5)"}' readonly>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/plugins", "yplayer");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="plugins_/yplayer" data-action="processPlayer" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->SAVECONFIG;?></button>
  </div>
</form>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h3><?php echo Lang::$word->_PLG_YPL_TITLE;?></h3>
    <p class="wojo small text"><?php echo Lang::$word->_PLG_YPL_SUB1;?></p>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo dark small stacked  button"><i class="icon plus alt"></i><?php echo Lang::$word->_PLG_YPL_NEW;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold text"><?php echo Lang::$word->_PLG_YPL_NOPLAY;?></p>
</div>
<?php else:?>
<div class="row phone-1 mobile-1 tablet-2 screen-2 gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo card">
      <div class="content center aligned">
        <img src="<?php echo APLUGINURL . 'yplayer/view/images/' . $row->layout;?>.png" class="wojo inline image" alt="">
        <h5><?php echo $row->title;?></h5>
      </div>
      <div class="divided footer center aligned">
        <a href="<?php echo Url::url(Router::$path . "/edit", $row->id);?>" class="wojo icon small primary button"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deletePlayer","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>", "url":"plugins_/yplayer"}' class="wojo icon negative small button data">
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
