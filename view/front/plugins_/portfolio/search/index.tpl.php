<?php
  /**
   * Portfolio Search
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: index.tpl.php, v1.00 2018-12-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'portfolio/'));
?>
<div class="margin-bottom">
  <div class="wojo fluid icon search input"> <i class="find icon"></i>
    <input data-search="true" data-url="<?php echo FMODULEURL;?>/portfolio/controller.php" name="pfind" placeholder="<?php echo Lang::$word->SEARCH;?>..." type="text" id="portaFind">
  </div>
</div>