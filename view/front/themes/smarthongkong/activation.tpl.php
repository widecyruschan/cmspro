<?php
  /**
   * Activation
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: activation.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <?php if(Validator::get('done')):?>
  <?php Message::msgOk(Lang::$word->M_INFO9 . '<a href="' . Url::url('/' . $this->core->system_slugs->login[0]->{'slug' . Lang::$lang}) . '">' . Lang::$word->M_INFO9_1 . '</a>');?>
  <?php else:?>
  <?php echo Message::msgError(Lang::$word->M_INFO10);?>
  <?php endif;?>
</div>