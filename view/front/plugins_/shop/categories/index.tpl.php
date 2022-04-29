<?php
  /**
   * Digishop Categories
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));
?>
<div class="wojo plugin segment">
  <?php echo App::Shop()->renderCategories(App::Shop()->catList());?>
</div>