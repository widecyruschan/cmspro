<?php
  /**
   * Language Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: _languages_translate.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3><?php echo Lang::$word->LG_TITLE1;?></h3>
<p><?php echo Lang::$word->LG_SUB2;?></p>
<div class="wojo form">
  <div class="row gutters align middle">
    <div class="columns screen-50 mobile-100">
      <div class="wojo action icon input">
        <input id="filter" type="text" placeholder="<?php echo Lang::$word->SEARCH;?>">
        <i class="icon find"></i>
      </div>
    </div>
    <div class="columns screen-25 mobile-50 phone-100">
      <select name="pgroup" id="pgroup" data-abbr="<?php echo $this->row->abbr;?>">
        <option data-type="all" value="all"><?php echo Lang::$word->LG_SUB4;?></option>
        <?php foreach($this->sections as $rows):?>
        <option data-type="filter" value="<?php echo $rows;?>"><?php echo $rows;?></option>
        <?php endforeach;?>
        <?php unset($rows);?>
      </select>
    </div>
    <div class="columns screen-25 mobile-50 phone-100">
      <select name="group" id="group" data-abbr="<?php echo $this->row->abbr;?>">
        <option value="all"><?php echo Lang::$word->LG_SUB3;?></option>
        <optgroup label="<?php echo Lang::$word->PLUGINS;?>">
        <?php foreach($this->pluglang as $rows):?>
        <option data-type="plugins" value="<?php echo 'plugins' . '/' . basename($rows, '.lang.plugin.xml') .'.lang.plugin.xml';?>"><?php echo ucfirst(basename($rows, '.lang.plugin.xml'));?></option>
        <?php endforeach;?>
        <?php unset($rows);?>
        </optgroup>
        <optgroup label="<?php echo Lang::$word->MODULES;?>">
        <?php foreach($this->modlang as $rows):?>
        <option data-type="modules" value="<?php echo 'modules' . '/' . basename($rows, '.lang.module.xml') .'.lang.module.xml';?>"><?php echo ucfirst(basename($rows, '.lang.module.xml'));?></option>
        <?php endforeach;?>
        <?php unset($rows);?>
        </optgroup>
      </select>
    </div>
  </div>
</div>
<div class="wojo segment">
  <?php $i = 0;?>
  <div class="wojo small relaxed fluid celled list align middle" id="editable">
    <?php foreach ($this->data as $pkey) :?>
    <?php $i++;?>
    <div class="item">
      <div class="content"><span data-editable="true" data-set='{"action": "editPhrase", "id": <?php echo $i;?>,"key":"<?php echo $pkey['data'];?>", "path":"<?php echo $this->row->abbr;?>/lang.xml"}'><?php echo $pkey;?></span></div>
      <div class="content auto phone-hide"><span class="wojo small dark inverted label"><?php echo $pkey['data'];?></span></div>
    </div>
    <?php endforeach;?>
  </div>
</div>