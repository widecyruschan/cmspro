<?php
  /**
   * Timeline
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _timeline_items.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100">
    <h2><?php echo Lang::$word->_MOD_TML_SUB10;?>
      <span class="wojo small text"> // <?php echo $this->row->name;?></span>
    </h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url("/admin/modules/timeline/inew", $this->row->id);?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_TML_SUB11;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_TML_NOITM;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <table class="wojo responsive basic table">
    <thead>
      <tr>
        <th data-sort="string"><?php echo Lang::$word->TYPE;?></th>
        <th data-sort="string"><?php echo Lang::$word->NAME;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
        <th class="disabled right aligned"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td><span class="wojo small label"><?php echo $row->type;?></span></td>
      <td><a href="<?php echo Url::url("/admin/modules/timeline/iedit", $this->row->id . '/' . $row->id);?>">
        <?php echo $row->{'title' . Lang::$lang};?></a></td>
      <td data-sort-value="<?php echo strtotime($row->created);?>"><?php echo Date::Dodate("short_date", $row->created);?></td>
      <td class="auto"><a href="<?php echo Url::url("/admin/modules/timeline/iedit", $this->row->id . '/' . $row->id);?>" class="wojo icon circular inverted primary button"><i class="icon note"></i></a>
        <a data-set='{"option":[{"delete": "deleteItem","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/timeline"}' class="wojo icon simple button data">
        <i class="icon negative trash"></i></a></td>
    </tr>
    <?php endforeach;?>
  </table>
  </table>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>