<?php
  /**
   * Portfolio
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _sitemap.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'portfolio/'));
?>
<?php $this->portadata = App::Portfolio()->Sitemap($this->keyword);?>