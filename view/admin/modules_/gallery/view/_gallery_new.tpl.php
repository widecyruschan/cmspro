<?php
  /**
   * Gallery
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _gallery_new.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header">
  <?php echo Lang::$word->_MOD_GA_NEW;?>
</h2>
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
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
              </div>
            </div>
            <div class="field five wide">
              <label><?php echo Lang::$word->ITEMSLUG;?><small><?php echo $lang->abbr;?></small></label>
              <div class="wojo large basic input">
                <input type="text" placeholder="<?php echo Lang::$word->ITEMSLUG;?>" name="slug_<?php echo $lang->abbr?>">
              </div>
            </div>
          </div>
          <div class="wojo fields">
            <div class="field">
              <label><?php echo Lang::$word->DESCRIPTION;?><small><?php echo $lang->abbr;?></small></label>
              <input type="text" placeholder="<?php echo Lang::$word->DESCRIPTION;?>" name="description_<?php echo $lang->abbr?>">
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
        <label><?php echo Lang::$word->_MOD_GA_THUMBW;?>
          <i class="icon asterisk"></i></label>
        <input name="thumb_w" type="range" min="100" max="700" step="20" value="300" hidden data-suffix=" px" data-type="labels" data-labels="100,300,500,700">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GA_THUMBH;?>
          <i class="icon asterisk"></i></label>
        <input name="thumb_h" type="range" min="100" max="700" step="20" value="300" hidden data-suffix=" px" data-type="labels" data-labels="100,300,500,700">
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GA_COLS;?>
          <i class="icon asterisk"></i></label>
        <input name="cols" type="range" min="2" max="5" step="1" value="3" hidden data-suffix=" itm" data-type="labels" data-labels="2,3,4,5">
      </div>
    </div>
    <div class="wojo fields">
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GA_WMARK;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="watermark" type="radio" value="1" id="watermark_1">
          <label for="watermark_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="watermark" type="radio" value="0" id="watermark_0" checked="checked">
          <label for="watermark_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GA_LIKE;?></label>
        <div class="wojo checkbox radio fitted inline">
          <input name="likes" type="radio" value="1" id="likes_1" checked="checked">
          <label for="likes_1"><?php echo Lang::$word->YES;?></label>
        </div>
        <div class="wojo checkbox radio fitted inline">
          <input name="likes" type="radio" value="0" id="likes_0">
          <label for="likes_0"><?php echo Lang::$word->NO;?></label>
        </div>
      </div>
      <div class="field">
        <label><?php echo Lang::$word->_MOD_GA_RESIZE_THE;?></label>
        <select name="resize" class="wojo fluid dropdown">
          <option value="thumbnail">Thumbnail</option>
          <option value="resize">Resize</option>
          <option value="bestFit">Best Fit</option>
          <option value="fitToHeight">Fit to Height</option>
          <option value="fitToWidth">Fit to Width</option>
        </select>
      </div>
    </div>
  </div>
  <div class="center aligned">
    <a href="<?php echo Url::url("/admin/modules", "gallery");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
    <button type="button" data-url="modules_/gallery"  data-action="processGallery" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->_MOD_GA_SUB3;?></button>
  </div>
</form>