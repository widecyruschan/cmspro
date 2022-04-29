<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkModAcl('shop')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "category": ?>
<!-- Start category edit -->
<?php include("_shop_category_edit.tpl.php");?>
<?php break;?>
<?php case "categories": ?>
<!-- Start category new -->
<?php include("_shop_category_new.tpl.php");?>
<?php break;?>
<?php case "variations": ?>
<!-- Start variations new -->
<?php include("_shop_vriations.tpl.php");?>
<?php break;?>
<?php case "edit": ?>
<!-- Start edit -->
<?php include("_shop_edit.tpl.php");?>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<?php include("_shop_new.tpl.php");?>
<?php break;?>
<?php case "settings": ?>
<!-- Start settings -->
<?php include("_shop_settings.tpl.php");?>
<?php break;?>
<?php case "payments": ?>
<!-- Start grid -->
<?php include("_shop_payments.tpl.php");?>
<?php break;?>
<?php case "history": ?>
<!-- Start history -->
<?php include("_shop_history.tpl.php");?>
<?php break;?>
<?php case "shipping": ?>
<!-- Start shipping -->
<?php include("_shop_shipping.tpl.php");?>
<?php break;?>
<?php case "grid": ?>
<!-- Start grid -->
<?php include("_shop_grid.tpl.php");?>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<?php include("_shop_list.tpl.php");?>
<?php break;?>
<?php endswitch;?>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo AMODULEURL;?>shop/view/js/shop.js"></script> 
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Shop({
		  url: "<?php echo AMODULEURL;?>shop/controller.php",
		  aurl: "<?php echo ADMINVIEW;?>",
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