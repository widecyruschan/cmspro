<?php
  /**
   * Comments
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'comments/'));
  $section = ($this->core->pageslug == $this->segments[0]) ? "page" : $this->core->moddir[$this->segments[0]];
  
  $pager = Paginator::instance();
  $conf = App::Comments();
  $comments = Comments::Render($section, isset($this->data->id) ? $this->data->id : $this->row->id);
?>
<div class="wojo-grid" id="comments">
  <h5><?php echo ($pager->items_total) ? $pager->items_total . ' ' . Lang::$word->COMMENTS : Lang::$word->_MOD_CM_SUB;?></h5>
  <?php echo $comments;?>
  <div class="full padding center aligned">
    <?php echo $pager->display_pages();?>
  </div>
  <?php if($conf->public_access or App::Auth()->logged_in):?>
  <?php include(FMODPATH . 'comments/snippets/form.tpl.php');?>
  <?php else:?>
  <?php echo Message::msgSingleAlert(Lang::$word->_MOD_CM_SUB1);?>
  <?php endif;?>
</div>