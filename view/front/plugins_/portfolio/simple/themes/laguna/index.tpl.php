<?php
  /**
   * Portfolio Latest
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2021
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'portfolio/'));
?>
<?php $conf = Utility::findInArray($data['all'], "id", $data['id']);?>
<div class="wojo plugin<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
  <?php if($data = App::Portfolio()->LatestPlugin()):?>
  <div class="wojo mason three">
    <?php foreach($data as $row):?>
    <div class="item">
      <figure class="wojo hover">
        <img src="<?php echo Portfolio::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo rounded image">
        <figcaption>
          <h6><a href="<?php echo Url::url('/' . App::Core()->modname['portfolio'], $row->slug);?>" class="black">
            <?php echo $row->title;?>
            </a>
          </h6>
        </figcaption>
      </figure>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>