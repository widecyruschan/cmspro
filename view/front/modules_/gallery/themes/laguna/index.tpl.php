<?php
  /**
   * Gallery
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'gallery/'));
?>
<!-- Start Gallery -->
<?php if(isset($data['module_id'])):?>
<?php $rows = App::Gallery()->getGallery($data['id']);?>
<?php if($rows):?>
<?php $data = App::Gallery()->renderSingle($rows->id);?>
<?php if($data):?>
<h2 class="wojo text"><?php echo $rows->title;?></h2>
<p><?php echo $rows->description;?></p>
<div class="wojo mason <?php echo Utility::numberToWords($rows->cols);?>">
  <?php foreach($data as $row):?>
  <?php $is_watermark = ($rows->watermark) ? 'gallery/controller.php?action=watermark&dir=' . $rows->dir. '&thumb=' . $row->thumb : Gallery::GALDATA . $rows->dir. '/' . $row->thumb;?>
  <div class="item">
    <div class="wojo attached basic card">
      <a href="<?php echo FMODULEURL . $is_watermark;?>" data-title="<?php echo $row->{'description' . Lang::$lang};?>" data-gallery="gallery" class="lightbox">
      <img src="<?php echo FMODULEURL . Gallery::GALDATA . $rows->dir. '/thumbs/' . $row->thumb;?>" alt="<?php echo $row->{'description' . Lang::$lang};?>"></a>
      <div class="content">
        <?php if($row->{'title' . Lang::$lang}):?>
        <h5 class="center aligned"><?php echo $row->{'title' . Lang::$lang};?></h5>
        <?php endif;?>
        <?php if($row->{'description' . Lang::$lang}):?>
        <p class="wojo small text"><?php echo $row->{'description' . Lang::$lang};?></p>
        <?php endif;?>
      </div>
      <?php if($rows->likes):?>
      <div class="footer" data-gallery-like="<?php echo $row->id;?>" data-gallery-total="<?php echo $row->likes;?>">
        <div class="row align middle">
          <div class="columns">
            <span class="galleryTotal"><?php echo $row->likes;?></span>
            <?php echo Lang::$word->LIKES;?></div>
          <div class="columns right aligned">
            <a class="wojo small primary button galleryLike">
            <i class="thumbs up icon"></i>
            <?php echo Lang::$word->LIKE;?>
            </a>
          </div>
        </div>
      </div>
      <?php endif;?>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php unset($row);?>
<?php endif;?>
<?php endif;?>
<?php else:?>
<!-- Start Galleries -->
<?php switch(Url::segment($this->segments, 1)): case $this->core->modname['gallery-album']: ?>
<!-- Start photos -->
<?php if($this->photos):?>
<div class="wojo-grid">
  <h2 class="wojo text"><?php echo $this->row->{'title' . Lang::$lang};?></h2>
  <p><?php echo $this->row->{'description' . Lang::$lang};?></p>
  <div class="wojo mason <?php echo Utility::numberToWords($this->row->cols);?>">
    <?php foreach($this->photos as $row):?>
    <?php $is_watermark = ($this->row->watermark) ? 'gallery/controller.php?action=watermark&dir=' . $this->row->dir. '&thumb=' . $row->thumb : Gallery::GALDATA . $this->row->dir. '/' . $row->thumb;?>
    <div class="item">
      <div class="wojo attached basic card">
        <a href="<?php echo FMODULEURL . $is_watermark;?>" data-title="<?php echo $row->{'description' . Lang::$lang};?>" data-gallery="gallery" class="lightbox">
        <img src="<?php echo FMODULEURL . Gallery::GALDATA . $this->row->dir. '/thumbs/' . $row->thumb;?>" alt="<?php echo $row->{'title' . Lang::$lang};?>"></a>
        <div class="content">
          <h5 class="center aligned"><?php echo $row->{'title' . Lang::$lang};?></h5>
          <?php if($row->{'description' . Lang::$lang}):?>
          <p class="wojo small text">
            <?php echo $row->{'description' . Lang::$lang};?>
          </p>
          <?php endif;?>
        </div>
        <?php if($this->row->likes):?>
        <div class="footer" data-gallery-like="<?php echo $row->id;?>" data-gallery-total="<?php echo $row->likes;?>">
          <div class="row align middle">
            <div class="columns">
              <span class="galleryTotal"><?php echo $row->likes;?></span>
              <?php echo Lang::$word->LIKES;?></div>
            <div class="columns right aligned">
              <a class="wojo small primary button galleryLike">
              <i class="thumbs up icon"></i>
              <?php echo Lang::$word->LIKE;?>
              </a>
            </div>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php if($this->rows):?>
<div class="wojo-grid">
  <div class="wojo mason two">
    <?php foreach($this->rows as $row):?>
    <div class="item">
      <figure class="wojo hover">
        <img src="<?php echo $row->poster ? FMODULEURL . 'gallery/data/' . $row->dir. '/thumbs/' . $row->poster : UPLOADURL . '/blank.jpg';?>" class="wojo basic rounded image">
        <figcaption class="center aligned">
          <?php if($row->{'title' . Lang::$lang}):?>
          <h5><?php echo $row->{'title' . Lang::$lang};?></h5>
          <?php endif;?>
          <?php if($row->{'description' . Lang::$lang}):?>
          <p class="wojo small text"><?php echo $row->{'description' . Lang::$lang};?></p>
          <?php endif;?>
          <p>
            <a href="<?php echo Url::url("/" . $this->core->modname['gallery'] . "/" . $this->core->modname['gallery-album'], $row->{'slug' . Lang::$lang});?>" class="wojo white icon button">
            <i class="icon url alt"></i>
            </a>
          </p>
          <div class="wojo mini statistics align center">
            <div class="statistic">
              <div class="value">
                <i class="icon thumbs up"></i>
                <?php echo $row->likes;?>
              </div>
              <div class="label">
                <?php echo Lang::$word->LIKES;?>
              </div>
            </div>
            <div class="statistic">
              <div class="value">
                <i class="icon photo"></i>
                <?php echo $row->pics;?>
              </div>
              <div class="label">
                <?php echo Lang::$word->_MOD_GA_PHOTOS;?>
              </div>
            </div>
          </div>
        </figcaption>
      </figure>
    </div>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
<?php break;?>
<?php endswitch;?>
<?php endif;?>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {
    $('.wojo.mason').on('click', '.galleryLike', function() {
        var id = $(this).closest(".footer").attr('data-gallery-like');
        var total = $(this).closest(".footer").attr('data-gallery-total');
        var score = $(this).closest(".footer").find('.galleryTotal');
        score.html(parseInt(total) + 1);
        $(this).transition('scaleIn', {
            duration: 1000,
            complete: function() {
                $(this).find(".icon").removeClass('thumbs up').addClass('check');
                $(this).removeClass('galleryLike').addClass('passive');
                $.post("<?php echo FMODULEURL;?>gallery/controller.php", {
                    action: "like",
                    id: id
                });
            }
        });
    });
});
// ]]>
</script>