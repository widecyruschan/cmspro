<?php
  /**
   * Shop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _dashboard.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php switch(Url::segment($this->segments)): case "wishlist": ?>
<!-- Start wishlist -->
<div class="wojo-grid">
  <h4>
    <?php echo Lang::$word->_MOD_SP_SUB19;?>
  </h4>
  <p><?php echo Lang::$word->_MOD_SP_INFO3;?></p>
  <?php if($this->wishlist):?>
  <div class="wojo segment" id="shop" action="<?php echo FMODULEURL;?>">
    <table class="wojo basic table">
      <thead>
        <tr>
          <th></th>
          <th><?php echo Lang::$word->NAME;?></th>
          <th><?php echo Lang::$word->PRICE;?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->wishlist as $k => $row):?>
        <tr id="wishlist_<?php echo $row->id?>">
          <td class="auto"><img src="<?php echo Shop::hasThumb($row->thumb, $row->pid);?>" alt="<?php echo $row->title?>" class="wojo basic small image"></td>
          <td><h5>
              <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>"><?php echo $row->title?></a>
            </h5></td>
          <td><?php echo Shop::renderPrice($row->price, $row->price_sale, "negative");?></td>
          <td class="auto"><a data-id="<?php echo $row->id?>" class="wojo circular negative icon button removeWish"><i class="icon delete"></i></a></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  <?php endif;?>
</div>
<?php break;?>
<!-- Start default -->
<?php default: ?>
<div class="wojo-grid">
  <div class="row">
    <div class="columns">
      <h4>
        <?php echo Lang::$word->_MOD_SP_SUB16;?>
      </h4>
      <p><?php echo Lang::$word->_MOD_SP_INFO2;?></p>
    </div>
    <div class="columns auto">
      <a class="wojo primary button" href="<?php echo Url::url('/' . $this->core->system_slugs->account[0]->{'slug' . Lang::$lang}, 'shop/wishlist');?>"><?php echo Lang::$word->_MOD_SP_WISH;?></a>
    </div>
  </div>
  <?php if($this->history):?>
  <div class="wojo segment">
    <table class="wojo basic table">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th><?php echo Lang::$word->NAME;?></th>
          <th><?php echo Lang::$word->DATE;?></th>
          <th class="right aligned"><?php echo Lang::$word->ACTIONS;?></th>
        </tr>
      </thead>
      <?php foreach ($this->history as $k => $row):?>
      <tr>
        <td><a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>"><img src="<?php echo Shop::hasThumb($row->thumb, $row->pid);?>" alt="" class="wojo small basic rounded image"></a></td>
        <td><a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>"><?php echo $row->title;?></a>
          <?php if($vars = json_decode($row->variant)):?>
          <p>
            <?php foreach($vars as $name => $var):?>
            <small>
            <b>
            <?php echo $name;?></b>: <?php echo $var;?></small>
            <?php endforeach;?>
          </p>
          <?php endif;?>
          <p><small><?php echo Lang::$word->_MOD_SP_SHIPPING;?>: <?php echo $row->name;?></small></p></td>
        <td><?php echo Date::doDate("short_date", $row->created);?></td>
        <td class="right aligned"><?php if($row->status == 0):?>
          <span data-tooltip="<?php echo Lang::$word->_MOD_SP_SUB14;?>" class="wojo simple circular icon button"><i class="icon ban"></i></span>
          <?php else:?>
          <a data-wdropdown="#dispDrop_<?php echo $k;?>" class="wojo small simple circular icon button"><i class="icon check"></i></a>
          <div class="wojo dropdown small pointing top-right" id="dispDrop_<?php echo $k;?>">
            <p><strong><?php echo Lang::$word->_MOD_SP_SUB15;?></strong>: <?php echo Date::doDate("short_date", $row->shipped);?></p>
            <p><?php echo $row->tracking;?></p>
          </div>
          <?php endif;?>
          <a data-tooltip="<?php echo Lang::$word->M_INVOICE;?>" href="<?php echo FMODULEURL;?>shop/controller.php?action=invoice&amp;tid=<?php echo Utility::encode($row->txn_id);?>" class="wojo small basic circular icon button"><i class="icon wysiwyg table"></i></a></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <?php endif;?>
</div>
<?php break;?>
<?php endswitch;?>