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
  <div class="wrapper">
    <!-- <div class="wojo-grid">
      <div class="contents">
        <div class="row big gutters">
          <div class="columns mobile-100 phone-100">
            <h5 class="wojo white text underlined">About Us</h5>
            <p class="wojo small white very dimmed text">When you visit or interact with our sites, services or tools, we or our authorised service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.</p>
            <a class="logo" href="<?php echo SITEURL;?>"><?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '" class="wojo image">': null;?></a>
            <a href="//<?php echo $this->core->social->facebook;?>" class="wojo small simple icon button"><i class="icon facebook"></i></a>
            <a href="//<?php echo $this->core->social->twitter;?>" class="wojo small simple icon button"><i class="icon twitter"></i></a>
          </div>
          <?php  include FPLUGPATH . 'blog/blogcombo-footer/index.tpl.php';?>
          <div class="columns mobile-100 phone-100">
            <h5 class="wojo white text underlined">Newsletter</h5>
            <p class="wojo small dimmed white text">New features, updates or big discounts. Never spam.</p>
            <form id="wojo_form_newsletter" name="wojo_form_newsletter" method="post" class="wojo form">
              <div class="wojo transparent input">
                <input type="email" name="email" placeholder="Email">
              </div>
              <div class="wojo small divider"></div>
              <button type="button" data-url="plugins_/newsletter" data-hide="true" data-action="processNewsletter" name="dosubmit" class="wojo primary fluid right button"><?php echo Lang::$word->SUBMIT;?><i class="icon long right arrow"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div> -->
    <div class="copyright">
      <div class="wojo-grid">
        <div class="row align middle">
          <div class="columns phone-100">Copyright &copy;<?php echo date('Y') . ' '. $this->core->company;?> | Powered by <a href="http://tag.digital" target="_blank">tag.digital Limited</a></div>
          <div class="columns auto phone-100">
          <a href="https://www.w3.org/WAI/WCAG2AA-Conformance" class="wojo small simple" target="_blank"><img src="<?php echo THEMEURL;?>/images/wcag2.svg" alt="遵守2A級無障礙圖示，萬維網聯盟（W3C）- 無障礙網頁倡議（WAI） Web Content Accessibility Guidelines 2.1" style="width: 80px;margin: 5px;"></a>
            <!-- <a href="<?php echo SITEURL;?>" class="wojo small simple icon button"><i class="icon home"></i></a> -->
            <!-- <a href="//validator.w3.org/check/referer" target="_blank" class="wojo small simple icon button"><i class="icon html5"></i></a> -->
            <a href="<?php echo URl::url('/' . $this->core->system_slugs->sitemap[0]->{'slug' . Lang::$lang});?>" class="wojo small simple icon button"><i class="icon apps"></i></a>
            <a href="<?php echo SITEURL;?>/rss.php" class="wojo small simple icon button"><i class="icon rss"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<a href="#" id="back-to-top" title="Back to top"><i class="icon long arrow up"></i></a>
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
			canBtn: "<?php echo Lang::$word->CANCEL;?>",
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
<?php if(Utility::in_array_any(["dashboard", "checkout"], $this->segments)):?>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
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