<?php
  /**
   * Blog Latest
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-15-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));
?>
<!-- Blog Latest -->
<?php $conf = Utility::findInArray($data['all'], "id", $data['id']);?>
<div class="wojo plugin<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
  <?php if($data = App::Blog()->LatestPlugin()):?>
  <div class="wojo testimonials carousel" data-wcarousel='{"stageClass": "owl-stage flex","center":true,"margin":32,"items":2,"loop":true,"nav":true,"dots":false,"responsive": {"0": {"items": 1},"769": {"items": 3},"1024": {"items": 3}}}'>
    <?php foreach($data as $row):?>
    <div class="wojo full attached basic card">
      <figure class="wojo rounded image">
        <img src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>">
      </figure>
      <div class="content">
        <span class="wojo mini very dimmed text"><?php echo Date::doDate("short_date", $row->created);?></span>
        <h6>
          <a href="<?php echo Url::url('/' . App::Core()->modname['blog'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h6>
        <p class="wojo small text"><?php echo Validator::sanitize($row->body, "default", 80);?></p>
      </div>
      <div class="footer">
        <a href="<?php echo Url::url("/profile", $row->username);?>" class="wojo primary small right labeled button"><span>Read More</span><i class="icon long right arrow"></i></a>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>