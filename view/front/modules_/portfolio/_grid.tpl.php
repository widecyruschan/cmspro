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
    <div class="wojo attached card">
      <figure class="wojo hover">
        <img src="<?php echo FMODULEURL . Portfolio::PORTDATA . $row->id. '/thumbs/' . $row->thumb;?>">
        <figcaption class="center aligned">
          <a href="<?php echo Url::url(Router::$path, $row->slug);?>"><i class="icon large circular white url alt link"></i></a>
        </figcaption>
      </figure>
      <div class="content">
        <h6>
          <a href="<?php echo Url::url(Router::$path, $row->slug);?>" class="black">
          <?php echo $row->title;?>
          </a>
        </h6>
        <span class="wojo small text">
        <a href="<?php echo Url::url(Router::$path . '/' . $this->core->modname['portfolio-cat'], $row->cslug);?>" class="secondary"><?php echo $this->row->client;?></a>
        </span>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>