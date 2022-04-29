<?php
  /**
   * Newsletter
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-26 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::checkPlugAcl('newsletter')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h3><?php echo Lang::$word->_PLG_NSL_TITLE;?></h3>
  </div>
  <div class="columns auto"> <a href="<?php echo APLUGINURL . 'newsletter/controller.php?action=exportEmails';?>" class="wojo small dark button"><i class="icon wysiwyg table"></i><?php echo Lang::$word->EXPORT;?></a> </div>
</div>
<p class="wojo bold text center aligned"><?php echo str_replace("[TOTAL]", $this->data, Lang::$word->_PLG_NSL_INFO);?></p>