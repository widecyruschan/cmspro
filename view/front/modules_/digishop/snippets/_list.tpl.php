<?php
  /**
   * Grid Layout
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _grid.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="digishop" action="<?php echo FMODULEURL;?>">
  <?php foreach($this->rows as $row):?>
  <div class="wojo card">
    <div class="row align bottom">
      <div class="columns screen-40 phone-100">
        <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>">
        <img src="<?php echo Digishop::hasThumb($row->thumb, $row->id);?>" alt="" class="wojo rounded image">
        </a>
      </div>
      <div class="columns full padding phone-100">
        <div class="wojo demi primary text">
          <?php echo Utility::formatMoney($row->price);?>
          <?php if($this->core->enable_tax and $row->price > 0) echo ' <small>+ ' . Lang::$word->TAX . '</small>';?>
        </div>
        <div class="wojo small text">
          <?php echo Lang::$word->IN;?>: <a class="secondary" href="<?php echo Url::url('/' . $this->core->modname['digishop'] . '/' . $this->core->modname['digishop-cat'], $row->cslug);?>"><?php echo $row->ctitle;?></a>
        </div>
        <h6>
          <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h6>
        <div class="wojo small horizontal divided list">
          <?php if($this->conf->like):?>
          <div class="item">
            <i class="icon warning star"></i>
            <?php echo $row->likes;?>
          </div>
          <?php endif;?>
          <?php if($this->conf->comments):?>
          <div class="item">
            <i class="icon information comment"></i>
            <?php echo $row->comments;?>
          </div>
          <?php endif;?>
          <div class="item">
            <?php echo Date::doDate("short_date", $row->created);?>
          </div>
        </div>
        <p>
          <?php echo $row->memberships ? $row->memberships : '';?>
        </p>
        <?php include(FMODPATH . 'digishop/snippets/_listButton.tpl.php');?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>