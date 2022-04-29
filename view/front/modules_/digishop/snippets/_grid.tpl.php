<?php
/**
 * Grid Layout
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2018
 * @version $Id: _grid.tpl.php, v1.00 2018-12-05 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<div id="digishop" class="wojo mason <?php echo utility::numberToWords($this->conf->cols);?>" action="<?php echo FMODULEURL;?>">
  <?php foreach($this->rows as $row):?>
  <div class="item">
    <div class="wojo attached card">
      <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>">
      <img src="<?php echo Digishop::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>" class="wojo rounded image"></a>
      <div class="content">
        <h6><a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>" class="secondary">
          <?php echo $row->title;?>
          </a>
        </h6>
        <small>
        <?php echo Lang::$word->IN;?>: <a class="date" href="<?php echo Url::url('/' . $this->core->modname['digishop'] . '/' . $this->core->modname['digishop-cat'], $row->cslug);?>">
        <?php echo $row->ctitle;?>
        </a>
        </small>
        <p class="wojo small text">
          <?php echo $row->memberships ? Lang::$word->MEMBERSHIP . ': ' . $row->memberships : '';?>
        </p>
        <span class="wojo secondary thin big text">
        <?php echo Utility::formatMoney($row->price);?>
        </span>
        <small>
        <?php if($this->core->enable_tax and $row->price > 0) echo '+ ' . Lang::$word->TAX;?>
        </small>
      </div>
      <div class="footer">
        <?php include(FMODPATH . 'digishop/snippets/_gridButton.tpl.php');?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
