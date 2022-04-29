<?php
  /**
   * Configuration
   *
   * @package wojo:cms
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: config.tpl.php, v5.00 2020-03-05 10:12:05 gewa Exp $
   */
   
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');

  Bootstrap::Autoloader(array(AMODPATH . 'timeline/'));
?>
<label><?php echo Lang::$word->_MOD_TML_LSELTIME;?></label>
<select name="module_data">
  <option value="0"><?php echo Lang::$word->_MOD_TML_LSELTIME;?></option>
  <?php echo Utility::loopOptions(Db::run()->select(Timeline::mTable, null, null, "ORDER BY created DESC")->results(), "id", "name", $this->data);?>
</select>