<?php
  /**
   * Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _grid.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->rows):?>
<div class="wojo mason <?php echo Utility::numberToWords(App::Portfolio()->cols);?>">
  <?php foreach($this->rows as $row):?>
  <div class="item">
    <div class="wojo attached basic card">
      <figure class="wojo hover">
        <img src="<?php echo FMODULEURL . Portfolio::PORTDATA . $row->id. '/thumbs/' . $row->thumb;?>" loading="lazy" alt="<?php echo $row->title;?>">
        <figcaption class="center aligned">
          <a href="<?php echo Url::url(Router::$path, $row->slug);?>" class="wojo primary icon button"><i class="icon url alt"></i></a>
        </figcaption>
      </figure>
      <div class="content">
        <h6 class="basic">
          <a href="<?php echo Url::url(Router::$path, $row->slug);?>" class="black">
          <?php echo $row->title;?>
          </a>
        </h6>
        <span class="wojo small text">
        <a href="<?php echo Url::url(Router::$path . '/' . $this->core->modname['portfolio-cat'], $row->cslug);?>" class="black"><?php echo $row->ctitle;?></a>
        </span>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>