<?php
  /**
   * Portfolio Latest
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'portfolio/'));
?>
<?php $conf = Utility::findInArray($data['all'], "id", $data['id']);?>
<div class="wojo divider"></div>
<div class="wojo-grid">
  <div class="wojo plugin<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
    <div class="center aligned">
      <span class="wojo positive label"><?php echo ucfirst(App::Core()->modname['portfolio']);?></span>
      <?php if($conf[0]->show_title):?>
      <h2 class="wojo primary text top margin"><?php echo $conf[0]->title;?></h2>
      <?php endif;?>
      <?php if($conf[0]->body):?>
      <?php echo Url::out_url($conf[0]->body);?>
      <?php endif;?>
    </div>
    <?php if($data = App::Portfolio()->LatestPlugin()):?>
    <div class="wojo mason margin top">
      <?php foreach($data as $row):?>
      <div class="item">
        <figure class="wojo hover">
          <img src="<?php echo Portfolio::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo basic image">
          <figcaption class="center aligned">
            <a class="white" href="<?php echo Url::url('/' . App::Core()->modname['portfolio'], $row->slug);?>">
            <?php echo $row->title;?>
            </a>
          </figcaption>
        </figure>
      </div>
      <?php endforeach;?>
    </div>
    <?php endif;?>
  </div>
</div>
