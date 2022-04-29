<?php
  /**
   * Pages
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: pages.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_pages')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "edit": ?>
<!-- Start edit -->
<?php include("_pages_edit.tpl.php");?>
<?php break;?>
<!-- Start new -->
<?php case "new": ?>
<?php include("_pages_new.tpl.php");?>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<?php include("_pages_list.tpl.php");?>
<?php break;?>
<?php endswitch;?>