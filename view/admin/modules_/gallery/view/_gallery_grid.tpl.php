<?php
  /**
   * Gallery
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _gallery_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns phone-100">
    <h3><?php echo Lang::$word->_MOD_GA_TITLE;?></h3>
    <p class="wojo small text"><?php echo Lang::$word->_MOD_GA_SUB;?></p>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark button"><i class="icon plus alt"></i>
    <?php echo Lang::$word->_MOD_GA_NEW;?></a>
    <a class="wojo small white icon button" id="reorder"><i class="icon apps"></i></a>
  </div>
</div>
<div class="hide-all" id="dragNotice">
  <p class="center aligned wojo primary semi icon text middle">
    <i class="icon info sign"></i> Drag images around to sort</p>
</div>
<?php if(!$this->data):?>
<div class="center aligne"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->_MOD_GA_NOGAL;?></p>
</div>
<?php else:?>
<div class="wojo mason" id="sortable">
  <?php foreach($this->data as $row):?>
  <div class="item" id="item_<?php echo $row->id;?>" data-id="<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="image photo"><img src="<?php echo $row->poster ? FMODULEURL . 'gallery/data/' . $row->dir. '/thumbs/' . $row->poster : UPLOADURL . '/blank.jpg';?>" class="wojo basic rounded image"></div>
      <div class="content">
        <div class="center aligned margin bottom">
          <h4><?php echo $row->{'title' . Lang::$lang};?></h4>
          <a class="wojo small primary icon button" href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><i class="icon pencil"></i></a>
          <a data-set='{"option":[{"delete": "deleteGallery","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>, "dir":"<?php echo $row->dir;?>"}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/gallery"}' class="wojo small negative icon button data"><i class="icon trash"></i></a>
        </div>
        <div class="row align middle">
          <div class="columns">
            <a href="<?php echo Url::url(Router::$path, "photos/" . $row->id);?>" class="wojo small primary inverted button">
            <?php echo Lang::$word->_MOD_GA_PHOTOS;?>
            <?php echo $row->pics;?>
            </a>
          </div>
          <div class="columns auto">
            <div class="wojo small passive inverted button">
              <?php echo Lang::$word->LIKES;?>
              <?php echo $row->likes;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>