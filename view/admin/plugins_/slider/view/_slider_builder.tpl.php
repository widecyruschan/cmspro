<?php
  /**
   * Slider Builder
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: builder.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<!-- Builder Container-->
<div id="builder">
 <iframe src="<?php echo ADMINVIEW;?>/plugins_/slider/builder/iframe.tpl.php" style="width:100%;height:100%;border:none" id="builderViewer"> </iframe>
</div>
