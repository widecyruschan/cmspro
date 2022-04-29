<?php
  /**
   * F.A.Q.
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _faq_grid.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns phone-100">
    <h3><?php echo Lang::$word->_MOD_FAQ_TITLE;?></h3>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small stacked dark button"><i class="icon plus alt"></i><?php echo Lang::$word->_MOD_FAQ_NEW;?></a>
  </div>
  <div class="columns auto phone-100">
    <a href="<?php echo Url::url(Router::$path, "categories/");?>" class="wojo small stacked white button"><i class="icon unordered list"></i>
    <?php echo Lang::$word->CATEGORIES;?></a>
  </div>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->_MOD_FAQ_NOFAQS;?></p>
</div>
<?php else:?>
<div class="wojo mason">
  <?php foreach($this->data as $cat):?>
  <div class="item">
    <div class="wojo card attached">
      <div class="content">
        <h4>
          <?php echo $cat['name'];?>
        </h4>
        <div class="wojo relaxed divided fluid list sortable_faq">
          <?php foreach ($cat['items'] as $row) :?>
          <div class="item align middle" id="item_<?php echo $row['id'];?>" data-id="<?php echo $row['id'];?>">
            <div class="content auto">
              <div class="wojo simple small icon button draggable"><i class="icon reorder"></i></div>
            </div>
            <div class="content">
              <a href="<?php echo Url::url(Router::$path . '/edit', $row['id']);?>"><?php echo $row['question'];?></a>
            </div>
            <div class="content auto"><a data-set='{"option":[{"delete": "deleteFaq","title": "<?php echo Validator::sanitize($row['question'], "chars");?>","id":<?php echo $row['id'];?>}],"action":"delete","parent":"#item_<?php echo $row['id'];?>","url":"modules_/faq"}' class="wojo small negative simple icon button data"><i class="icon trash"></i></a>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>