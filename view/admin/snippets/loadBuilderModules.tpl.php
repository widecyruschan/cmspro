<?php
  /**
   * Builder Modules
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: loadBuilderModules.tpl.php, v1.00 2018-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<?php foreach($this->data as $row):?>
<div class="column">
  <a data-element="modules" data-mode="readonly" data-module-id="<?php echo $row->parent_id;?>" data-module-module_id="<?php echo $row->id;?>" data-module-name="<?php echo $row->title;?>" data-module-alias="<?php echo $row->modalias;?>" data-module-group="<?php echo $row->modalias;?>">
    <img src="<?php echo AMODULEURL . $row->icon;?>">
  </a>
  <p class="wojo tiny text truncate content-center half-top-padding"><?php echo $row->title;?></p>
</div>
<?php endforeach;?>
<?php endif;?>