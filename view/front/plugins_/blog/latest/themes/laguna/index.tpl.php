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
<div class="wojo basic segment<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
  <div class="scrollbox" style="height:600px">
    <?php if($conf[0]->show_title):?>
    <h5 class="center aligned"><?php echo $conf[0]->title;?></h5>
    <?php endif;?>
    <?php if($conf[0]->body):?>
    <?php echo Url::out_url($conf[0]->body);?>
    <?php endif;?>
    <?php if($data = App::Blog()->LatestPlugin()):?>
    <div class="wojo very relaxed list margin bottom">
      <?php foreach($data as $row):?>
      <div class="item">
        <div class="content">
          <figure class="bottom margin"><img class="wojo basic rounded image" src="<?php echo Blog::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>"></figure>
          <a href="<?php echo Url::url('/' . App::Core()->modname['blog'], $row->slug);?>"><?php echo $row->title;?></a>
          <p class="wojo mini text"><?php echo Date::doDate("long_date", $row->created);?></p>
        </div>
      </div>
      <?php endforeach;?>
    </div>
    <a href="<?php echo Url::url('/' . App::Core()->modname['blog']);?>" class="wojo fluid primary button">
    <?php echo Lang::$word->_MOD_AM_SUB40;?></a>
    <?php endif;?>
  </div>
</div>
