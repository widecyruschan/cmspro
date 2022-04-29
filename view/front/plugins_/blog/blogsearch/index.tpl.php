<?php
  /**
   * Blog Search
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'blog/'));
?>
<div class="wojo form margin bottom">
  <div class="wojo icon search input">
    <i class="find icon"></i>
    <input data-search="true" data-url="<?php echo FMODULEURL;?>/blog/controller.php" name="bfind" placeholder="<?php echo Lang::$word->SEARCH;?>..." type="text" id="blogFind">
  </div>
</div>