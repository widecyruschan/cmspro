<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _search.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'shop/'));
?>
<?php $this->shopdata = App::Shop()->searchResults($this->keyword);?>