<?php
  /**
   * Footer
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: footer.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<script src="<?php echo SITEURL;?>/assets/jquery-ui.min.js"></script>
<script src="<?php echo ADMINVIEW;?>/plugins_/slider/builder/builder.js"></script>
<script type="text/javascript">
  $(window).on('load', function() {
	  $.get("<?php echo ADMINVIEW;?>/plugins_/slider/controller.php", {
		  action: "editSlide",
		  id: <?php echo $this->data->id;?>,
	  }, function(json) {
		  var jsonObj = JSON.parse(json);
		  $("#builderViewer").contents().find("body").html(jsonObj.html);
		  $("#builderViewer").contents().find(".uimage, .ucontent").css("minHeight", jsonObj.height);
		  $("#builderViewer").contents().find("body")
			  .Builder({
				  url: "<?php echo ADMINVIEW;?>",
				  purl: "<?php echo ADMINVIEW;?>/plugins_/slider/",
				  surl: "<?php echo SITEURL;?>",
				  slidename: "<?php echo htmlspecialchars($this->data->title);?>",
			  });

	  }).always(function() {
		  setTimeout(function() {
			  $("body").addClass("loaded");
		  }, 200);
	  },"json");
  });
</script>
<div id="tempData" class="hidden"></div>
<?php include(APLUGPATH . "slider/snippets/_canvas_helper.tpl.php");?>
<?php include(APLUGPATH . "slider/snippets/_section_helper.tpl.php");?>
<?php include(APLUGPATH . "slider/snippets/_row_helper.tpl.php");?>
<?php include(APLUGPATH . "slider/snippets/_element_helper.tpl.php");?>
<?php include(APLUGPATH . "slider/snippets/_source_helper.tpl.php");?>
<?php Debug::displayInfo();?>
</body></html>