<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _sitemap.tpl.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'digishop/'));
?>
<?php $this->digidata = App::Digishop()->Sitemap($this->keyword);?>