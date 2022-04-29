<?php
  /**
   * Bottom Widget
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: bottom_widget.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->layout->bottomCount):?>
<div class="bottomwidget clearfix">
  <?php if($this->layout->bottomCount > 1 and $this->layout->bcounter == 0):?>
  <div class="wojo-grid">
    <div class="row gutters">
      <?php endif;?>
      <?php foreach ($this->layout->bottomWidget as $row): ?>
      <?php if($this->layout->bottomCount > 1 and $this->layout->bcounter):?>
      <div class="row">
        <?php endif;?>
        <div class="columns screen-<?php echo $row->space;?>0 tablet-<?php echo $row->space;?>0 mobile-100 phone-100">
          <div class="bottomwidget-wrap <?php echo ($row->alt_class) ? $row->alt_class : '';?>">
            <?php if ($row->show_title and !$row->system):?>
            <h4 class="wojo header"><?php echo $row->title;?></h4>
            <?php endif;?>
            <?php if ($row->body and !$row->system):?>
            <div class="bottomwidget-body"><?php echo Url::out_url($row->body);?></div>
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
        </div>
        <?php if($this->layout->bottomCount > 1 and $this->layout->bcounter):?>
      </div>
      <?php endif;?>
      <?php endforeach; ?>
      <?php unset($row);?>
      <?php if($this->layout->bottomCount > 1 and $this->layout->bcounter == 0):?>
    </div>
  </div>
  <?php endif;?>
</div>
<?php endif;?>