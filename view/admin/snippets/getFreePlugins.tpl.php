<?php
  /**
   * Free Plugins
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: getFreePlugins.tpl.php, v1.00 2020-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="body mh400 overflow-auto">
  <?php if($this->data):?>
  <div data-section="<?php echo $this->section;?>" class="wojo divided relaxed list">
    <?php foreach($this->data as $row):?>
    <div class="item" data-id="<?php echo $row->id;?>"><a class=""><?php echo $row->title;?></a>
    </div>
    <?php endforeach;?>
  </div>
  <?php endif;?>
</div>