<?php
  /**
   * Digishop Categories
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));
?>
<div class="wojo plugin segment">
	<?php echo App::Digishop()->renderCategories(App::Digishop()->catList());?>
</div>