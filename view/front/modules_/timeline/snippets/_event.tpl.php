<?php
  /**
   * Timeline Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: index.tpl.php, v1.00 2016-12-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'timeline/'));
?>
<!-- Start Timeline Manager -->
<div id="timeline"></div>
<?php if(isset($data['id'])):?>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {
    var timeline_data = [];

    $.get("<?php echo FMODULEURL;?>timeline/controller.php", {
        action: "loaddata",
        item_id: "<?php echo Utility::encode($data['id']);?>"
    }, function(json) {
        if (json.type === "success") {
			$(json.entries).each(function (index, data) {
				timeline_data.push({
					type: data.display_mode,
					date: data.timedate,
					dateDisplay: data.edate,
					title: data.title,
					height: data.height,
					content: data.content,
					images: data.thumb,
					readmore: data.more
				});
			});
			
			var timeline = new Timeline($('#timeline'), timeline_data);
			timeline.setOptions({
				columnMode:  json.colmode,
				responsive_width: 800,
				max: json.maxitems,
				loadmore: json.showmore,
				readmore_text :"<?php echo Lang::$word->_MOD_TML_SUB18;?>",
				loadmore_text:"<?php echo Lang::$word->_MOD_TML_SUB19;?>",
			});
			timeline.display();
		}
    }, "json");
});
// ]]>
</script>
<?php endif;?>