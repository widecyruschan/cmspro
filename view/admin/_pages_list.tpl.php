<?php
  /**
   * Pages
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _pages_list.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h2><?php echo Lang::$word->META_T8;?></h2>
  </div>
  <div class="columns auto mobile-100 phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->PAG_SUB4;?></a>
  </div>
</div>
<div class="row gutters align center">
  <div class="columns screen-40 tablet-50 mobile-100 phone-100">
    <div class="wojo form">
      <div class="wojo icon ajax input">
        <input name="find" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text" data-page="Page" data-type="page">
        <i class="icon find"></i>
        <div class="results"></div>
      </div>
    </div>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->ET_INFO;?></p>
</div>
<?php else:?>
<div class="wojo segment">
  <table class="wojo basic responsive table">
    <thead>
      <tr>
        <th class="disabled center aligned"></th>
        <th data-sort="string"><?php echo Lang::$word->PAG_NAME;?></th>
        <th class="disabled center aligned"><?php echo Lang::$word->TYPE;?></th>
        <th class="disabled center aligned"><?php echo Lang::$word->ACTIONS;?></th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td class="auto"><span class="wojo small simple label"><?php echo $row->id;?></span></td>
      <td><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>">
        <?php echo $row->{'title' . Lang::$lang};?></a></td>
      <td class="collapsing center aligned"><?php if($row->page_type == "contact"):?>
        <i class="icon secondary email disabled"></i>
        <?php elseif($row->page_type == "home"):?>
        <i class="icon primary home disabled"></i>
        <?php else:?>
        <i class="icon file disabled"></i>
        <?php endif;?></td>
      <td class="auto"><a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>" class="wojo icon primary inverted circular button"><i class="icon note"></i></a>
        <?php if($row->page_type == "normal"):?>
        <a data-set='{"option":[{"action":"copyPage","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->COPY;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"append", "modalclass":"normal", "redirect":true}' class="wojo circular secondary inverted icon button action"><i class="icon copy"></i></a>
        <a data-set='{"option":[{"trash": "trashPage","title": "<?php echo Validator::sanitize($row->{'title' . Lang::$lang}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","parent":"#item_<?php echo $row->id;?>"}' class="wojo icon simple button data">
        <i class="icon negative trash"></i>
        </a>
        <?php else:?>
        <a class="wojo icon simple disabled button">
        <i class="icon close"></i>
        </a>
        <?php endif;?></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>