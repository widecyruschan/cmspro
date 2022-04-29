<?php
  /**
   * Gallery
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkModAcl('gallery')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments, 3)): case "edit": ?>
<!-- Start edit -->
<?php include("_gallery_edit.tpl.php");?>
<?php break;?>
<?php case "new": ?>
<!-- Start new -->
<?php include("_gallery_new.tpl.php");?>
<?php break;?>
<?php case "photos": ?>
<!-- Start photos -->
<?php include("_gallery_photos.tpl.php");?>
<?php break;?>
<?php default: ?>
<!-- Start default -->
<?php include("_gallery_grid.tpl.php");?>
<?php break;?>
<?php endswitch;?>
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo AMODULEURL;?>gallery/view/js/gallery.js"></script> 
<script type="text/javascript"> 
// <![CDATA[  
  $(document).ready(function() {
	  $.Gallery({
		  url: "<?php echo AMODULEURL;?>gallery/controller.php",
		  dir: "<?php echo in_array("photos", $this->segments) ? $this->data->dir : null;?>",
		  lang: {
			  done: "<?php echo Lang::$word->DONE;?>"
		  }
	  });
	 
  });
// ]]>
</script> 