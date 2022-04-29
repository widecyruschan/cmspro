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
  <?php if($conf[0]->body):?>
  <?php echo Url::out_url($conf[0]->body);?>
  <?php endif;?>
  <?php if($data = App::Blog()->LatestPlugin()):?>
  <div class="wojo carousel" data-wcarousel='{"stageClass": "owl-stage flex","margin":32,"items":2,"loop":false,"nav":false,"dots":true,"responsive": {"0": {"items": 1},"769": {"items": 3},"1024": {"items": 4}}}'>
    <?php foreach($data as $row):?>
    <div class="wojo full attached aimple card">
      <div class="content">
        <span class="wojo mini very dimmed text"><?php echo Date::doDate("short_date", $row->created);?></span>
        <h5 class="vertical margin">
          <a href="<?php echo Url::url('/' . App::Core()->modname['blog'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h5>
        <p class="wojo small text"><?php echo Validator::sanitize($row->body, "default", 50);?></p>
      </div>
      <div class="horizontal margin">
        <div class="wojo basic divider"></div>
      </div>
      <div class="footer">
        <a href="<?php echo Url::url("/profile", $row->username);?>" class="black"> 
        <img src="<?php echo UPLOADURL;?>/avatars/<?php echo $row->avatar ? $row->avatar : "blank.png" ;?>" alt="" class="wojo mini inline circular image">
          <span class="wojo small text left margin"><?php echo $row->name;?></span></a>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>