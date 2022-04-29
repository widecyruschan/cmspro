<?php
  /**
   * Banner Grid
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _banner_grid.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if ($row->quantity == 0 or $row->label == "sold"):?>
<div class="wojo negative ribbon top left">
  <span>
  <?php echo Lang::$word->_MOD_SP_SOLDOUT;?>
  </span>
</div>
<?php else :?>
<?php 
  switch ($row->label):
	  /* == New == */
	  case "new":
		  print '<div class="wojo positive ribbon top left"><span>' . Lang::$word->_MOD_SP_NEWARR . '</span></div>';
	  break;
	  
	  /* == Comming Soon == */
	  case "soon":
		  print '<div class="wojo secondary ribbon sale top left"><span>' . Lang::$word->_MOD_SP_SOON . '</span></div>';
	  break;
	  
	  default:
	  break;
  endswitch;
?>
<?php endif;?>