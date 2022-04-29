<?php
  /**
   * Forms
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkModAcl('forms')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "edit": ?>
<!-- Start edit -->
<?php include("_forms_edit.tpl.php");?>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<?php include("_forms_new.tpl.php");?>
<?php break;?>
<?php case "design": ?>
<!-- Start design -->
<?php include("_forms_design.tpl.php");?>
<?php break;?>
<?php case "view": ?>
<!-- Start view -->
<?php include("_forms_view.tpl.php");?>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<?php include("_forms_grid.tpl.php");?>
<?php break;?>
<?php endswitch;?>