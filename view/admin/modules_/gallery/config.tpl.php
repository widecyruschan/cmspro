<?php
  /**
   * Configuration
   *
   * @package wojo:cms
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: config.php, v5.00 2020-03-05 10:12:05 gewa Exp $
   */
   
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  Bootstrap::Autoloader(array(AMODPATH . 'gallery/'));
?>
<label><?php echo Lang::$word->_MOD_GA_SUB7;?></label>
<select name="module_data">
  <option value="0"><?php echo Lang::$word->_MOD_GA_SUB6;?></option>
  <?php echo Utility::loopOptions(Gallery::getGalleryList(), "id", "title" . Lang::$lang, $this->data);?>
</select>