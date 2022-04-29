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
  
  $data = App::Blog()->blogCombo();
?>
<div class="wojo simple fluid tabs">
  <ul class="nav">
    <li class="active"><a data-tab="tab_popular"><?php echo Lang::$word->_MOD_AM_SUB41;?></a>
    </li>
    <li><a data-tab="tab_archive"><?php echo Lang::$word->_MOD_AM_SUB42;?></a>
    </li>
    <li><a data-tab="tab_comments"><i class="icon bubble"></i></a>
    </li>
  </ul>
  
  <div class="wojo segment tab">
    <!-- Start Popular Article -->
    <div class="item" data-tab="tab_popular">
      <?php if($data['popular']):?>
      <div class="wojo very relaxed divided fluid list">
        <?php foreach ($data['popular'] as $poprow):?>
        <div class="item">
          <img src="<?php echo Blog::hasThumb($poprow->thumb, $poprow->id);?>" alt="<?php echo $poprow->title;?>" class="wojo small basic rounded image">
          <div class="content">
            <h6 class="basic"><a href="<?php echo Url::url('/' . App::Core()->modname['blog'], $poprow->slug);?>" class="secondary"><?php echo $poprow->title;?></a></h6>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
    
    <!-- Start Blog Archive -->
    <div class="item" data-tab="tab_archive">
      <?php if($data['archive']):?>
      <div class="wojo very relaxed divided fluid list">
        <?php foreach ($data['archive'] as $arow):?>
        <div class="item align middle">
          <div class="content">
            <span class="wojo mini primary passive button"><?php echo $arow->total;?></span>
            <a href="<?php echo Url::url('/' . App::Core()->modname['blog'] . '/' . App::Core()->modname['blog-archive'], $arow->year . '-'. $arow->month);?>" class="secondary"><?php echo Date::doDate("MMMM yyyy", $arow->year . "-" . $arow->month);?></a>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
    
    <!-- Start Latest Comments -->
    <div class="item" data-tab="tab_comments">
      <?php if($data['comments']):?>
      <div class="wojo relaxed divided fluid list">
        <?php foreach ($data['comments'] as $comrow):?>
        <div class="item">
          <div class="content">
            <h6><a href="<?php echo Url::url('/' . App::Core()->modname['blog'], $comrow->slug);?>"><?php echo $comrow->title;?></a></h6>
            <p class="wojo small text"><?php echo Validator::truncate($comrow->body, 50);?></p>
            <span class="wojo secondary small label"><?php echo Date::doDate("short_date", $comrow->created);?></span>
          </div>
        </div>
        <?php endforeach;?>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>
