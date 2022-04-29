<?php
  /**
   * Blog
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));
?>
<?php switch(count($this->segments)): case 3: ?>
  <?php if(in_array($this->core->modname['blog-archive'], $this->segments)):?>
	<?php include_once(FMODPATH . "blog/snippets/_layout_archive.tpl.php");?>
    <?php elseif(in_array($this->core->modname['blog-tag'], $this->segments)):?>
    <?php include_once(FMODPATH . "blog/snippets/_layout_tag.tpl.php");?>
  <?php else:?>
    <?php switch($this->row->layout): case 4: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_list.tpl.php");?>
    <?php break;?>
    <?php case 3: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_modern.tpl.php");?>
    <?php break;?>
    <?php case 2: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_masonry.tpl.php");?>
    <?php break;?>
    <?php default: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_classic.tpl.php");?>
    <?php break;?>
    <?php endswitch;?>
  <?php endif;?>
<?php break;?>

<!-- Start Blog single -->
<?php case 2: ?>
    <?php switch($this->row->layout): case 4: ?>
    <?php include_once(FMODPATH . "blog/snippets/_layout_single_bottom.tpl.php");?>
    <?php break;?>
    <?php case 3: ?>
    <?php include_once(FMODPATH . "blog/snippets/_layout_single_top.tpl.php");?>
    <?php break;?>
    <?php case 2: ?>
    <?php include_once(FMODPATH . "blog/snippets/_layout_single_right.tpl.php");?>
    <?php break;?>
    <?php default: ?>
    <?php include_once(FMODPATH . "blog/snippets/_layout_single_left.tpl.php");?>
    <?php break;?>
    <?php endswitch;?>
<?php break;?>
<!-- Start Blog default -->
<?php default: ?>
    <h5 class="margin-bottom"><?php echo Lang::$word->_MOD_AM_SUB43;?></h5>
    <?php switch(App::Blog()->flayout): case 4: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_list.tpl.php");?>
    <?php break;?>
    <?php case 3: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_modern.tpl.php");?>
    <?php break;?>
    <?php case 2: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_masonry.tpl.php");?>
    <?php break;?>
    <?php default: ?>
    <?php include_once(FMODPATH . "blog/snippets/_front_layout_classic.tpl.php");?>
    <?php break;?>
    <?php endswitch;?>
<?php break;?>
<?php endswitch;?>