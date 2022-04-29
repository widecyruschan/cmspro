<?php
  /**
   * Portfolio
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'portfolio/'));
?>
<?php switch(count($this->segments)): case 3: ?>
<div class="wojo-grid">
  <?php if($this->categories and App::Portfolio()->show_cats):?>
  <!-- Start Category -->
  <div class="vertical margin center aligned">
    <div class="wojo divided horizontal list">
      <a href="<?php echo Url::url('/' . $this->core->modname['portfolio']);?>" class="wojo semi text item">
      <?php echo Lang::$word->ALL;?>
      </a>
      <?php foreach($this->categories as $crow):?>
      <?php $active = (in_array($crow->{'slug' . Lang::$lang}, $this->segments)) ? " active" : null;?>
      <a href="<?php echo Url::url('/' . $this->core->modname['portfolio'] . '/' . $this->core->modname['portfolio-cat'], $crow->{'slug' . Lang::$lang});?>" class="item<?php echo $active;?>">
      <?php echo $crow->{'name' . Lang::$lang};?>
      </a>
      <?php endforeach;?>
    </div>
  </div>
  <?php endif;?>
  <!-- <div class="vertical margin">
    <h2><?php echo $this->row->{'name' . Lang::$lang};?></h2>
    <p class="wojo secondary text"><?php echo $this->row->{'description' . Lang::$lang};?></p>
  </div> -->
  <?php if($this->rows):?>
  <div class="wojo mason">
    <?php foreach($this->rows as $row):?>
    <div class="item">
      <div class="wojo card">
        <figure class="wojo hover">
          <img src="<?php echo FMODULEURL . Portfolio::PORTDATA . $row->id. '/thumbs/' . $row->thumb;?>" alt="" class="wojo rounded image">
          <figcaption class="center aligned">
            <a href="<?php echo Url::url('/' . $this->core->modname['portfolio'], $row->slug);?>" class="white"><?php echo $row->title;?></a>
          </figcaption>
        </figure>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <div class="row gutters align middle">
    <div class="columns auto mobile-100 phone-100">
      <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
    </div>
    <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
  </div>
</div>
<?php endif;?>
<?php break;?>
<?php case 2: ?>
<!-- Start Item -->
<div class="wojo-grid">
  <div class="row big gutters">
    <div class="columns screen-50 tablet-60 mobile-100 phone-100">
      <figure class="wojo hover">
        <img src="<?php echo FMODULEURL . Portfolio::PORTDATA . $this->row->id. '/thumbs/' . $this->row->thumb;?>" alt="" class="wojo basic rounded image">
        <figcaption class="center aligned">
          <a href="<?php echo FMODULEURL . Portfolio::PORTDATA . $this->row->id. '/' . $this->row->thumb;?>" class="lightbox"><i class="icon large circular inverted primary url alt link"></i></a>
        </figcaption>
      </figure>
      <?php if($this->images):?>
      <?php foreach($this->images as $img):?>
      <div class="small top margin"><a href="<?php echo FMODULEURL . Portfolio::PORTDATA . $this->row->id. '/' . $img->name;?>" data-gallery="portfolio" class="lightbox"><img src="<?php echo Portfolio::hasThumb($img->name, $this->row->id);?>" alt="<?php echo $this->row->{'title' . Lang::$lang};?>" class="wojo basic rounded image"></a>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </div>
    <div class="columns screen-50 tablet-40 mobile-100 phone-100">
      <div class="wojo native sticky">
        <h2 class="wojo primary text">
          <?php echo $this->row->{'title' . Lang::$lang};?></h2>
        <?php echo Url::out_url($this->row->{'body' . Lang::$lang});?>
        <!-- <div class="wojo divider"></div> -->
        <!-- <div class="wojo small relaxed fluid list">
          <div class="item">
            <div class="content wojo semi text screen-20"><?php echo Lang::$word->_MOD_PF_SUB1;?></div>
            <div class="content wojo secondary text"><?php echo $this->row->client;?></div>
          </div>
          <?php echo $this->custom_fields;?>
          <div class="item">
            <div class="content wojo semi text text screen-20"><?php echo Lang::$word->DATE;?></div>
            <div class="content wojo secondary text"><?php echo Date::doDate("short_date", $this->row->created);?></div>
          </div>
          <?php if($this->row->file):?>
          <div class="item">
            <div class="content wojo semi text text screen-20">
              <?php echo Lang::$word->DOWNLOAD;?></div>
            <div class="content"><a href="<?php echo FMODULEURL . Portfolio::FILEDATA . $this->row->file;?>" class="wojo primary small icon button"><i class="icon download"></i></a>
            </div>
          </div>
          <?php endif;?>
        </div> 
        <?php if(App::Portfolio()->social):?>
        <div class="wojo small divider"></div>
        <div class="wojo small relaxed fluid list align-middle">
          <div class="item">
            <div class="content wojo semi text text screen-20">Share</div>
            <div class="content">
              <a href="//facebook.com/sharer/sharer.php?u=<?php echo Url::url(Router::$path);?>" class="wojo small circular icon secondary spaced button">
              <i class="icon facebook"></i>
              </a>
              <a href="//twitter.com/home?status=<?php echo Url::url(Router::$path);?>&text=<?php echo $this->row->{'title' . Lang::$lang};?>" class="wojo small circular icon secondary spaced button">
              <i class="icon twitter"></i>
              </a>
              <a href="//plus.google.com/share?url=<?php echo Url::url(Router::$path);?>" class="wojo small circular icon secondary spaced button">
              <i class="icon google"></i>
              </a>
              <a href="//pinterest.com/pin/create/button/?url=<?php echo Url::url(Router::$path);?>&media=<?php echo FMODULEURL . Portfolio::PORTDATA . $this->row->id. '/' . $this->row->thumb;?>&description=<?php echo $this->row->{'title' . Lang::$lang};?>" class="wojo small circular icon secondary button">
              <i class="icon pinterest"></i>
              </a>
            </div>
          </div>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php break;?>
<!-- Start default -->
<?php default: ?>


<?php if(App::Portfolio()->layout == "grid"):?>
<?php include_once("_grid.tpl.php");?>
<?php else:?>
<?php include_once("_list.tpl.php");?>
<?php endif;?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns right aligned mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
<?php break;?>
<?php endswitch;?>
