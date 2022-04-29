<?php
  /**
   * Left Widget
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: left_widget.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->layout->leftCount):?>
<aside class="leftwidget">
  <?php foreach ($this->layout->leftWidget as $row): ?>
  <div class="leftwidget-wrap <?php echo ($row->alt_class) ? $row->alt_class : '';?>">
    <?php if ($row->show_title):?>
    <h4 class="wojo header"><?php echo $row->title;?></h4>
    <?php endif;?>
    <?php if ($row->body):?>
    <div class="leftwidget-body"><?php echo Url::out_url($row->body);?></div>
    <?php endif;?>
    <?php if ($row->jscode):?>
	  <script>
      <?php Validator::cleanOut($row->jscode);?>
      </script>
    <?php endif;?>
    <?php if ($row->system):?>
    <?php echo Plugins::loadPluginFile(array($row->plugalias, $row->plugin_id, $row->plug_id, $this->plugins));?>
    <?php endif;?>
  </div>
  <?php endforeach; ?>
  <?php unset($row);?>
</aside>
<?php endif;?>