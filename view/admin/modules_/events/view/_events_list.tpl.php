<?php
  /**
   * Events
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _events_list.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns phone-100">
    <h2><?php echo Lang::$word->_MOD_EM_TITLE;?></h2>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_EM_SUB;?></a>
  </div>
  <div class="columns auto phone-100">
    <div class="wojo filter buttons">
      <a class="wojo small disabled icon button"><i class="icon unordered list"></i></a>
      <a href="<?php echo Url::url(Router::$path, "grid");?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
    </div>
  </div>
</div>
<form method="get" id="wojo_form" action="<?php echo Url::url(Router::$path);?>" name="wojo_form" class="wojo form">
  <div class="row gutters align center">
    <div class="columns screen-30 phone-100">
      <div class="wojo icon input">
        <input id="fromdate" name="fromdate" type="text" placeholder="<?php echo Lang::$word->FROM;?>" readonly>
        <i class="icon calendar"></i>
      </div>
    </div>
    <div class="columns screen-30 phone-100">
      <div class="wojo action icon input">
        <i class="calendar icon"></i>
        <input id="enddate" name="enddate" type="text" placeholder="<?php echo Lang::$word->TO;?>" readonly>
        <button id="doDates" class="wojo primary inverted icon button"><i class="icon find"></i></button>
      </div>
    </div>
  </div>
</form>
<div class="center aligned">
  <div class="wojo divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->SORTING_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
    <?php echo Lang::$word->RESET;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=title|DESC");?>" class="item<?php echo Url::setActive("order", "title");?>">
    <?php echo Lang::$word->NAME;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=venue|DESC");?>" class="item<?php echo Url::setActive("order", "venue");?>">
    <?php echo Lang::$word->_MOD_EM_SUB1;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=contact|DESC");?>" class="item<?php echo Url::setActive("order", "contact");?>">
    <?php echo Lang::$word->_MOD_EM_SUB2;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=ending|DESC");?>" class="item<?php echo Url::setActive("order", "ending");?>">
    <?php echo Lang::$word->_MOD_EM_SUB23;?>
    </a>
    <div class="item"><a href="<?php echo Url::sortItems(Url::url(Router::$path), "order");?>" data-content="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
    </div>
  </div>
</div>
<div class="center aligned margin bottom">
  <?php echo Validator::alphaBits(Url::url(Router::$path), "letter");?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_EM_NOEVENTS;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $row):?>
<div class="wojo card" id="item_<?php echo $row->id;?>">
  <div class="content">
    <h4>
      <a href="<?php echo Url::url(Router::$path . '/edit', $row->id);?>"><?php echo $row->title;?></a>
    </h4>
    <p class="wojo small text"><?php echo $row->venue;?></p>
  </div>
  <div class="footer divided">
    <div class="row align middle">
      <div class="columns">
        <div class="wojo horizontal responsive small divided list">
          <div class="item">
            <?php echo Lang::$word->_MOD_EM_DATE_S;?>
            <span class="description"><?php echo Date::doDate("short_date", $row->date_start);?>
            <?php echo Date::doTime($row->time_start);?></span>
          </div>
          <div class="item">
            <?php echo Lang::$word->_MOD_EM_TIME_S;?>
            <span class="description"><?php echo Date::doDate("short_date", $row->ending);?>
            <?php echo Date::doTime($row->time_end);?></span>
          </div>
        </div>
      </div>
      <div class="columns auto">
        <a class="wojo small primary icon button" href="<?php echo Url::url(Router::$path . '/edit', $row->id);?>"><i class="icon pencil"></i></a>
        <a data-set='{"option":[{"delete": "deleteEvent","title": "<?php echo Validator::sanitize($row->title, "chars");?>","id":<?php echo $row->id;?>}],"action":"delete","parent":"#item_<?php echo $row->id;?>","url":"modules_/events"}' class="wojo small negative icon button data"><i class="icon trash"></i></a>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>