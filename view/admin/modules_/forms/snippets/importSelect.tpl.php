<?php
  /**
   * Import Selects
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $this->id: importSelect.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="body">
  <div class="row gutters">
    <div class="columns screen-70">
      <div class="wojo small form"><textarea type="text" name="customSelect" style="height:300px"><?php echo $this->items;?></textarea></div>
    </div>
    <div class="columns">
      <h4><?php echo Lang::$word->_MOD_VF_SUB13;?></h4>
      <div class="wojo divided list">
        <a data-id="dow" class="item">Days of the Week</a>
        <a data-id="moy" class="item">Months of the Year</a>
        <a data-id="age" class="item">Age</a>
        <a data-id="years" class="item">Years (1930+)</a>
        <a data-id="con" class="item">Continents</a>
        <a data-id="us" class="item">US States</a>
        <a data-id="ca" class="item">Canada Provinces</a>
        <a data-id="eu" class="item">EU Countries</a>
        <a data-id="uk" class="item">UK Counties</a>
        <a data-id="cn" class="item">World Countries</a>
        <a data-id="nu" class="item">Numbers from 1 to 50</a>
      </div>
    </div>
  </div>
</div>