<?php
  /**
   * Blog Combo
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));
?>
<?php if(class_exists('Blog')):?>
<?php $data = App::Blog()->blogCombo();?>
<div class="columns mobile-100 phone-100">
  <h5 class="wojo white text underlined"><?php echo Lang::$word->_MOD_AM_SUB41;?></h5>
  <?php if($data['popular']):?>
  <div class="wojo list">
    <?php foreach ($data['popular'] as $poprow):?>
    <div class="item">
      <div class="content">
        <a href="<?php echo Url::url('/' . App::Core()->modname['blog'], $poprow->slug);?>" class="white"><?php echo $poprow->title;?></a>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>
<div class="columns mobile-100 phone-100">
  <h5 class="wojo white text underlined"><?php echo Lang::$word->_MOD_AM_SUB42;?></h5>
  <?php if($data['archive']):?>
  <div class="wojo list">
    <?php foreach ($data['archive'] as $arow):?>
    <div class="item align middle">
    <i class="icon resize"></i>
      <div class="content">
        <a href="<?php echo Url::url('/' . App::Core()->modname['blog'] . '/' . App::Core()->modname['blog-archive'], $arow->year . '-'. $arow->month);?>" class="white"><?php echo Date::doDate("MMMM yyyy", $arow->year . "-" . $arow->month);?></a>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>
<?php endif;?>