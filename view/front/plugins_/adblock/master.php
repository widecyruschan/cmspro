<?php
  /**
   * AdBlock Plugin
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: master.php, v1.00 2016-12-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'adblock/'));
?>
<!-- Ad Block -->
<?php if($conf = Utility::findInArray($data['all'], "id", $data['id'])):?>
<div class="wojo fitted plugin segment<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
  <?php if($conf[0]->show_title):?>
  <h3><?php echo $conf[0]->title;?></h3>
  <?php endif;?>
  <?php if($conf[0]->body):?>
  <?php echo Url::out_url($conf[0]->body);?>
  <?php endif;?>
  <?php if($row = Adblock::Render($data['plugin_id'])):?>
  <?php if(Adblock::isOnline($row)):?>
  <?php $ad_content = ($row->image) ? ('<a href="' . $row->image_link . '" id="b_' . $row->id . '" title="' . $row->image_alt . '"><img src="' . FPLUGINURL . $row->plugin_id . '/'  . $row->image . '" alt="' . $row->image_alt . '" class="wojo basic image" /></a>') : Validator::cleanOut($row->banner_html);?>
  <?php echo $ad_content;?>
  <?php Adblock::udateView($row->id);?>
  <?php endif;?>
  <?php endif;?>
</div>
<?php if($conf[0]->jscode):?>
<script><?php echo $conf[0]->jscode;?></script>
<?php endif;?>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
    $("#b_<?php echo $row->id;?>").on('click', function() {
        $.post("<?php echo FMODULEURL . "adblock/controller.php";?>", {action:'click', id:"<?php echo $row->id;?>"});
   });
});
// ]]>
</script>
<?php endif;?>