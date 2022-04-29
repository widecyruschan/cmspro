<?php
  /**
   * List Layout
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _list.tpl.php, v1.00 2020-07-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="shop" action="<?php echo FMODULEURL;?>">
  <?php foreach($this->rows as $row):?>
  <div class="wojo card">
    <div class="row">
      <div class="columns screen-20 phone-100">
        <?php include FMODPATH . "/shop/snippets/_banner_list.tpl.php";?>
        <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>" class="wojo rounded image">
        <img src="<?php echo Shop::hasThumb($row->thumb, $row->id);?>" alt="<?php echo $row->title;?>">
        </a>
      </div>
      <div class="columns full padding phone-100">
        <div class="wojo small text">
          <?php echo Lang::$word->IN;?>: <a class="secondary" href="<?php echo Url::url('/' . $this->core->modname['shop'] . '/' . $this->core->modname['shop-cat'], $row->cslug);?>"><?php echo $row->name;?></a>
        </div>
        <h6>
          <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>" class="black"><?php echo $row->title;?></a>
        </h6>
        <div class="wojo semi medium text">
          <?php echo Shop::renderPrice($row->price, $row->price_sale, "negative");?>
        </div>
        <div class="small vertical margin">
          <div class="wojo stars">
            <?php for ($x = 1; $x <= $row->stars; $x++):?>
            <span class="star active"><i class="icon small star full"></i></span>
            <?php endfor;?>
            <?php while ($x <= 5):?>
            <span class="star"><i class="icon small star"></i></span>
            <?php $x++;?>
            <?php endwhile;?>
            <small><?php echo $row->ratings;?></small>
          </div>
        </div>
        <?php include FMODPATH . "/shop/snippets/_button_list.tpl.php";?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>