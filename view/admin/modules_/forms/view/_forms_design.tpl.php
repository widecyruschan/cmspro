<?php
  /**
   * Forms
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _forms_fields.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h2 class="header"><?php echo Lang::$word->_MOD_VF_TITLE1;?><span class="wojo small text"> // <?php echo $this->data->{'title' . Lang::$lang};?></small></h2>
<div id="formBuilder" class="row gutters">
  <div class="columns screen-25 tablet-30 mobile-100 phone-100">
    <div class="wojo sticky">
      <div class="wojo passive attached segment" id="fItems">
        <div class="wojo accordion">
          <section>
            <h6 class="summary"><a><?php echo Lang::$word->_MOD_VF_FIELDS_B;?></a></h6>
            <div class="details">
              <div class="wojo relaxed list">
                <a class="item" data-type="short_text"><?php echo Lang::$word->_MOD_VF_SUB22;?></a>
                <a class="item" data-type="long_text"><?php echo Lang::$word->_MOD_VF_SUB23;?></a>
                <a class="item" data-type="dropdown"><?php echo Lang::$word->_MOD_VF_SUB24;?></a>
                <a class="item" data-type="radio"><?php echo Lang::$word->_MOD_VF_SUB25;?></a>
                <a class="item" data-type="checkbox"><?php echo Lang::$word->_MOD_VF_SUB26;?></a>
                <a class="item" data-type="upload"><?php echo Lang::$word->_MOD_VF_SUB27;?></a>
                <a class="item" data-type="heading"><?php echo Lang::$word->_MOD_VF_SUB28;?></a>
                <a class="item" data-type="html"><?php echo Lang::$word->_MOD_VF_SUB29;?></a>
                <a class="item" data-type="image"><?php echo Lang::$word->_MOD_VF_SUB30;?></a>
              </div>
            </div>
          </section>
        </div>
        <div class="wojo accordion">
          <section>
            <h6 class="summary">
              <a><?php echo Lang::$word->_MOD_VF_FIELDS_S;?></a>
            </h6>
            <div class="details">
              <div class="wojo relaxed list">
                <a class="item" data-type="name"><?php echo Lang::$word->NAME;?></a>
                <a class="item" data-type="email"><?php echo Lang::$word->M_EMAIL;?></a>
                <a class="item" data-type="address"><?php echo Lang::$word->M_ADDRESS;?></a>
                <a class="item" data-type="phone"><?php echo Lang::$word->M_PHONE;?></a>
                <a class="item" data-type="date"><?php echo Lang::$word->DATE;?></a>
                <a class="item" data-type="time"><?php echo Lang::$word->TIME;?></a>
                <a class="item" data-type="color"><?php echo Lang::$word->COLOR;?></a>
                <a class="item" data-type="range"><?php echo Lang::$word->RANGE;?></a>
              </div>
            </div>
          </section>
        </div>
      </div>
      <div id="fProperty" class="wojo small basic form segment">
        <form method="post" id="item_form" name="item_form">
        </form>
      </div>
    </div>
  </div>
  <div id="context" class="columns screen-75 tablet-70 mobile-100 phone-100">
    <div class="wojo form attached segment loading" id="fDesign">
    </div>
  </div>
</div>
<link href="<?php echo AMODULEURL;?>forms/view/css/forms.css" rel="stylesheet" type="text/css">
<script src="<?php echo SITEURL;?>/assets/sortable.js"></script>
<script src="<?php echo AMODULEURL;?>forms/view/js/forms.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $('#formBuilder').Forms({
        url: "<?php echo AMODULEURL;?>forms/controller.php",
		aurl: "<?php echo ADMINVIEW;?>",
		surl: "<?php echo SITEURL;?>",
		murl: "<?php echo AMODULEURL;?>forms/",
		ltype: <?php echo $this->data->label_type;?>,
		days: [<?php echo Date::weekList(false); ?>],
		months: [<?php echo Date::monthList(false); ?>],
        lang: {
            cancel: "<?php echo Lang::$word->CANCEL;?>",
			insert: "<?php echo Lang::$word->INSERT;?>",
			optEditor: "<?php echo Lang::$word->_MOD_VF_SUB12;?>",
			under: "<?php echo Lang::$word->_MOD_VF_SUB14;?>",
			orOver: "<?php echo Lang::$word->_MOD_VF_SUB15;?>",
			saveHtml: "<?php echo Lang::$word->_MOD_VF_SUB32;?>",
        }
    });
});
// ]]>
</script>