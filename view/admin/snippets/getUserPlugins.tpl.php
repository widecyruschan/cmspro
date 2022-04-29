<?php
  /**
   * User Plugins
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: getUserPlugins.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->row):?>
<article class="plugin-wrap <?php echo ($this->row->alt_class) ? $this->row->alt_class : '';?>">
  <?php if ($this->row->show_title):?>
  <h3><?php echo $this->row->title;?></h3>
  <?php endif;?>
  <?php if ($this->row->body):?>
  <div class="plugin-body"><?php echo Url::out_url($this->row->body);?></div>
  <?php endif;?>
</article>
<?php endif;?>