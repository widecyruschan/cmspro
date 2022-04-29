<?php
  /**
   * Portfolio
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: index.tpl.php, v1.00 2016-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkModAcl('portfolio')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "category": ?>
<!-- Start category edit -->
<?php include("_portfolio_category_edit.tpl.php");?>
<?php break;?>
<?php case "categories": ?>
<!-- Start category new -->
<?php include("_portfolio_category_new.tpl.php");?>
<?php break;?>
<?php case "edit": ?>
<!-- Start edit -->
<?php include("_portfolio_edit.tpl.php");?>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<?php include("_portfolio_new.tpl.php");?>
<?php break;?>
<?php case "settings": ?>
<!-- Start settings -->
<?php include("_portfolio_settings.tpl.php");?>
<?php break;?>
<?php case "list": ?>
<!-- Start list -->
<?php include("_portfolio_list.tpl.php");?>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<?php include("_portfolio_grid.tpl.php");?>
<?php break;?>
<?php endswitch;?>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo AMODULEURL;?>portfolio/view/js/portfolio.js"></script> 
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Portfolio({
		  url: "<?php echo AMODULEURL;?>portfolio/controller.php",
		  lang: {
			  delMsg3: "<?php echo Lang::$word->DELCONFIRM1;?>",
			  delMsg8: "<?php echo Lang::$word->DELCONFIRM2;?>",
			  canBtn: "<?php echo Lang::$word->CANCEL;?>",
			  trsBtn: "<?php echo Lang::$word->DELETE_REC;?>",
			  err: "<?php echo Lang::$word->ERROR;?>",
			  err1: "<?php echo Lang::$word->FU_ERROR7;?>",
		  }
	  });
  });
// ]]>
</script> 