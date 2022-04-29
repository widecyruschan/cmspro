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
<!-- Footer -->
<footer>
  <div class="wojo-grid">
    <div class="vertical padding">
      <div class="row">
        <div class="columns phone-100"><span class="wojo small text">&copy; <?php echo date('Y') . ' '. $this->core->company;?> | Powered by <a href="http://tag.digital" target="_blank">tag.digital Limited</a></div>
        <div class="columns phone-100">
          <div class="right aligned">
            <a href="<?php echo SITEURL;?>" class="wojo small simple icon button"><i class="icon home"></i></a>
            <a href="//validator.w3.org/check/referer" target="_blank" class="wojo small simple icon button"><i class="icon html5"></i></a>
            <a href="<?php echo URl::url('/' . $this->core->system_slugs->sitemap[0]->{'slug' . Lang::$lang});?>" class="wojo small simple icon button"><i class="icon apps"></i></a>
            <a href="<?php echo SITEURL;?>/rss.php" class="wojo small simple icon button"><i class="icon rss"></i></a>
            <a href="//<?php echo $this->core->social->facebook;?>" class="wojo small simple icon button"><i class="icon facebook"></i></a>
            <a href="//<?php echo $this->core->social->twitter;?>" class="wojo small simple icon button"><i class="icon twitter"></i></a>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</footer>
<?php Debug::displayInfo();?>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function() {
	$('.logo img').each(function() {
		var $img = $(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		$.get(imgURL, function(data) {
			var $svg = $(data).find('svg');
			if (typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			if (typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass + ' replaced-svg');
			}
			$svg = $svg.removeAttr('xmlns:a');
			$img.replaceWith($svg);
		}, 'xml');
	});
});
// ]]>
</script>
</body></html>