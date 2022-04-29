<?php
  /**
   * Gallery
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _gallery_photos.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->_MOD_GA_SUB4;?><small> // <?php echo $this->data->{'title' . Lang::$lang};?></small></h2>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <div class="wojo small stacked dark button uploader" id="drag-and-drop-zone">
      <i class="icon plus alt"></i>
      <label><?php echo Lang::$word->_MOD_GA_SUB5;?>
        <input type="file" multiple name="files[]">
      </label>
    </div>
  </div>
  <div class="columns auto">
    <a class="wojo small white icon button" id="reorder"><i class="icon apps"></i></a>
  </div>
</div>
<div class="hide-all" id="dragNotice">
  <p class="center aligned wojo primary semi icon text middle">
    <i class="icon info sign"></i> Drag images around to sort</p>
</div>
<div class="wojo small fluid relaxed celled items" id="fileList"></div>
<div class="wojo mason" id="sortable">
  <?php if(!$this->photos):?>
  <div class=" center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
    <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_GA_NOPHOTO;?></p>
  </div>
  <?php else:?>
  <?php foreach($this->photos as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="image photo">
        <img src="<?php echo FMODULEURL . Gallery::GALDATA . $this->data->dir. '/thumbs/' . $row->thumb;?>" class="wojo basic image"></div>
      <div class="content">
        <div class="center aligned">
          <div class="description" id="description_<?php echo $row->id;?>">
            <h4><?php echo $row->{'title' . Lang::$lang};?></h4>
            <p><?php echo $row->{'description' . Lang::$lang};?></p>
          </div>
        </div>
        <div class="row align middle">
          <div class="columns">
            <div class="wojo small passive inverted button">
              <?php echo Lang::$word->LIKES;?>
              <?php echo $row->likes;?>
            </div>
          </div>
          <div class="columns auto">
            <a data-wdropdown="#photoMenu_<?php echo $row->id;?>" class="wojo primary inverted icon circular button">
            <i class="icon vertical ellipsis"></i>
            </a>
            <div class="wojo small dropdown top-right pointing" id="photoMenu_<?php echo $row->id;?>">
              <a class="item action" data-set='{"option":[{"action":"editPhoto","id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->UPDATE;?>", "url":"modules_/gallery/controller.php", "parent":"#description_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}'><i class="icon pencil"></i>
              <?php echo Lang::$word->EDIT;?></a>
              <a class="item <?php echo ($this->data->poster == $row->thumb) ? 'disabled' : 'poster';?>" data-poster="<?php echo $row->thumb;?>"><i class="icon <?php echo ($this->data->poster == $row->thumb) ? 'check' : 'photo' ;?>"></i>
              <?php echo Lang::$word->_MOD_GA_POSTER;?></a>
              <div class="wojo basic divider"></div>
              <a class="item data" data-set='{"option":[{"delete": "deletePhoto","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>, "dir":"<?php echo $this->data->dir;?>"}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/gallery"}'><i class="icon trash"></i>
              <?php echo Lang::$word->DELETE;?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>