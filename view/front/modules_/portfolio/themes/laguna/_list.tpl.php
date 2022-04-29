<?php
  /**
   * List
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _list.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->rows):?>
<?php foreach($this->rows as $row):?>
<div class="wojo basic card">
  <div class="row align middle">
    <div class="columns screen-20 tablet-20 mobile-20 phone-100">
      <a href="<?php echo Url::url(Router::$path, $row->slug);?>">
      <img src="<?php echo FMODULEURL . Portfolio::PORTDATA . $row->id. '/thumbs/' . $row->thumb;?>" class="wojo rounded image"></a>
    </div>
    <div class="columns phone-100">
      <div class="full padding">
        <h6><a href="<?php echo Url::url(Router::$path, $row->slug);?>" class="black">
          <?php echo $row->title;?></a>
        </h6>
        <span class="wojo small text">
        <a href="<?php echo Url::url(Router::$path . '/' . $this->core->modname['portfolio-cat'], $row->cslug);?>"><?php echo $row->ctitle;?></a>
        </span>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>