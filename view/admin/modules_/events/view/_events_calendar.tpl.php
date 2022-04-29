<?php
  /**
   * Events
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _events_clendar.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo card">
  <div class="header">
    <div class="row align-middle">
      <div class="column content-center">
        <div id="calnav" class="wojo small white buttons">
          <div id="prev" class="wojo icon button"><i class="icon chevron left"></i></div>
          <div id="now" class="wojo button"> <?php echo Date::doDate("MMMM yyyy", Date::today());?> </div>
          <div id="next" class="wojo icon button"><i class="icon chevron right"></i></div>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo form calendar" id="mCalendar"></div>
</div>
<script src="<?php echo AMODULEURL;?>events/view/js/events.js"></script> 
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $('#mCalendar').Calendar({
        url: "<?php echo AMODULEURL;?>events/controller.php",
		murl: "<?php echo URL::url("admin/modules/events");?>",
        weekStart: <?php echo App::Core()->weekstart;?>,
		ampm: <?php echo (App::Core()->time_format) == "HH:mm" ? 1 : 0;?>,
        lang: {
            dayNames: [<?php echo Date::weekList(false, false);?>],
            monthNames: [<?php echo Date::monthList(false);?>],
        }
    });
});
// ]]>
</script>