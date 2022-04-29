<?php
  /**
   * Register Error
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: registerError.tpl.php, v1.00 2020-06-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <div class="vertical padding">
    <div class="wojo negative relaxed icon message">
      <i class="icon big white lock"></i>
      <div class="content">
        <h1 class="wojo white text"><?php echo Lang::$word->FRT_MERROR;?></h1>
        <p class="wojo white dimmed text"><?php echo Lang::$word->FRT_MERROR_1;?></p>
      </div>
    </div>
  </div>
</div>
