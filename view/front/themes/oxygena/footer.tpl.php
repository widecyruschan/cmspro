<?php
  /**
   * Footer
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: footer.tpl.php, v1.00 2019-09-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<!-- Footer -->
<footer>
  <div class="wrapper">
    <div class="wojo-grid">
      <div class="row align middle">
        <div class="columns phone-100 phone-content-center">
          <span class="logo">
          <?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '" class="wojo basic image">': null;?>
          </span>
          <!-- <a href="<?php echo SITEURL;?>" class="wojo small transparent circular spaced icon button"><i class="icon home"></i></a>
          <a href="//validator.w3.org/check/referer" target="_blank" class="wojo small transparent circular spaced icon button"><i class="icon html5"></i></a>
          <a href="//<?php echo $this->core->social->facebook;?>" class="wojo small transparent circular spaced icon button"><i class="icon facebook"></i></a>
          <a href="//<?php echo $this->core->social->twitter;?>" class="wojo small transparent circular icon button"><i class="icon twitter"></i></a> -->
        </div>
        <!-- <div class="columns auto phone-100 phone-content-center">
          
        </div> -->
        <div class="columns mobile-100 phone-100">
          <div class="center aligned">
            <p class="wojo small text">Copyright &copy;<?php echo date('Y') . ' '. $this->core->company;?> |  Powered by <a href="http://tag.digital" target="_blank">tag.digital Limited</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<a href="#" id="back-to-top" title="Back to top"><i class="icon chevron up"></i></a>
<script src="<?php echo THEMEURL;?>/js/master.js"></script>
<?php Debug::displayInfo();?>
<script> 
// <![CDATA[  
<?php if($this->core->ploader):?>
$(window).on('load', function() {
	setTimeout(function() {
		$("body").addClass("loaded");
	}, 200);
});
<?php endif;?>
$(document).ready(function() {
    $.Master({
		url: "<?php echo FRONTVIEW;?>",
		surl: "<?php echo SITEURL;?>",
        weekstart: <?php echo(App::Core()->weekstart);?>,
		ampm: <?php echo (App::Core()->time_format) == "HH:mm" ? 0 : 1;?>,
        lang: {
            monthsFull: [ <?php echo Date::monthList(false);?> ],
            monthsShort: [ <?php echo Date::monthList(false, false);?> ],
            weeksFull: [ <?php echo Date::weekList(false); ?> ],
            weeksShort: [ <?php echo Date::weekList(false, false);?> ],
			weeksMed: [ <?php echo Date::weekList(false, false, true);?> ],
            button_text: "<?php echo Lang::$word->BROWSE;?>",
            empty_text: "<?php echo Lang::$word->NOFILE;?>",
			sel_pic: "<?php echo Lang::$word->SELIMG;?>",
        }
    });
	<?php if($this->core->eucookie):?>
    $("body").acceptCookies({
        position: 'top',
        notice: '<?php echo Lang::$word->EU_NOTICE;?>',
        accept: '<?php echo Lang::$word->EU_ACCEPT;?>',
        decline: '<?php echo Lang::$word->EU_DECLINE;?>',
        decline_t: '<?php echo Lang::$word->EU_DECLINE_T;?>',
        whatc: '<?php echo Lang::$word->EU_W_COOKIES;?>'
    });
	<?php endif;?>
});
// ]]>
</script>
<?php if(Utility::in_array_any(["dashboard", "checkout", "booking"], $this->segments)):?>
<script src="https://js.stripe.com/v3/"></script>
<?php endif;?>
<?php if($this->core->analytics):?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $this->core->analytics;?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $this->core->analytics;?>');
</script>
<?php endif;?>
</body></html>