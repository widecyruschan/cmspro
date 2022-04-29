<?php
/**
 * Grid Layout
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2020
 * @version $Id: _grid.tpl.php, v1.00 2020-05-17 10:12:05 gewa Exp $
 */
if ( !defined( "_WOJO" ) )
	die( 'Direct access to this location is not allowed.' );
?>
<div id="shop" class="wojo full cards screen-3 tablet-2 mobile-2 phone-1" action="<?php echo FMODULEURL;?>">
  <?php foreach($this->rows as $row):?>
  <div class="card" id="item_<?php echo $row->id;?>">
    <?php include FMODPATH . "/shop/snippets/_banner_grid.tpl.php";?>
    <div class="content bottom attached">
      <div class="center aligned">
        <div class="wojo basic medium rounded responsive image">
          <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>">
          <img src="<?php echo Shop::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>">
          </a>
        </div>
        <div class="wojo small text margin-top">
          <?php echo Lang::$word->IN;?>: <a class="secondary" href="<?php echo Url::url('/' . $this->core->modname['shop'] . '/' . $this->core->modname['shop-cat'], $row->cslug);?>"><?php echo $row->name;?></a>
        </div>
        <h6>
          <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h6>
        <div class="wojo semi medium text margin-bottom">
          <?php echo Shop::renderPrice($row->price, $row->price_sale, "negative");?>
        </div>
      </div>
    </div>
    <div class="footer center aligned">
      <div class="wojo stars bottom margin">
        <?php for ($x = 1; $x <= $row->stars; $x++):?>
        <span class="star active"><i class="icon small star full"></i></span>
        <?php endfor;?>
        <?php while ($x <= 5):?>
        <span class="star"><i class="icon small star"></i></span>
        <?php $x++;?>
        <?php endwhile;?>
        <small><?php echo $row->ratings;?></small>
      </div>
      <?php include FMODPATH . "/shop/snippets/_button_grid.tpl.php";?>
    </div>
  </div>
  <?php endforeach;?>
</div>