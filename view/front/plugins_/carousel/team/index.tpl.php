<?php
  /**
   * Carousel
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: index.tpl.php, v1.00 2018-12-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(APLUGPATH . 'carousel/'));
?>
<?php if($row = App::Carousel()->render($data['plugin_id'])):?>
<div class="wojo carousel" data-wcarousel='<?php echo (in_array(Core::$language, array("he", "ae", "ir"))) ? str_replace('"rtl":false', '"rtl":true', $row->settings) : $row->settings;?>'>
  <?php echo Url::out_url($row->{'body' . Lang::$lang});?> 
</div>
<?php endif;?>