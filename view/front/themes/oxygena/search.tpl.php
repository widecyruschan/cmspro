<?php
  /**
   * Search
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: search.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<main>
  <?php if(File::is_File(FMODPATH . 'portfolio/_search.tpl.php')):?>
  <?php include_once(FMODPATH . 'portfolio/_search.tpl.php');?>
  <?php endif;?>
  <?php if(File::is_File(FMODPATH . 'digishop/_search.tpl.php')):?>
  <?php include_once(FMODPATH . 'digishop/_search.tpl.php');?>
  <?php endif;?>
  <?php if(File::is_File(FMODPATH . 'blog/_search.tpl.php')):?>
  <?php include_once(FMODPATH . 'blog/_search.tpl.php');?>
  <?php endif;?>
  <?php if(File::is_File(FMODPATH . 'shop/_search.tpl.php')):?>
  <?php include_once(FMODPATH . 'shop/_search.tpl.php');?>
  <?php endif;?>
  <div class="section" id="searchHero">
    <div class="wojo-grid">
      <div class="row align middle horizontal gutters">
        <div class="columns screen-60">
          <h1 class="wojo semi text"><?php echo $this->data->{'title' . Lang::$lang};?></h1>
          <p><?php echo $this->data->{'caption' . Lang::$lang};?></p>
          <form method="get" id="wojo_form" name="wojo_form">
            <div class="wojo action input">
              <input name="keyword" placeholder="<?php echo Lang::$word->SEARCH;?>..." type="text">
              <button class="wojo icon secondary button">
              <i class="find icon"></i>
              </button>
            </div>
          </form>
        </div>
        <div class="columns screen-40">
          <figure style="margin-bottom:-1rem">
             <img src="<?php echo THEMEURL;?>/images/search-girl.svg" alt="<?php echo $this->data->{'title' . Lang::$lang};?>">
          </figure>
        </div>
      </div>
    </div>
  </div>
  <div class="wojo-grid">
    <?php if(!$this->keyword || strlen($this->keyword = trim($this->keyword)) == 0 || strlen($this->keyword) < 3):?>
    <?php Message::msgSingleInfo(Lang::$word->FRT_SEARCH_EMPTY2);?>
    <?php elseif(!$this->pagedata and !$this->blogdata and !$this->portadata and !$this->digidata and !$this->shopdata):?>
    <?php Message::msgSingleAlert(Lang::$word->FRT_SEARCH_EMPTY . '<span class="wojo bold text">[' . Validator::sanitize($this->keyword) . ']</span>' . Lang::$word->FRT_SEARCH_EMPTY1);?>
    <?php else:?>
    <!-- Page -->
    <div class="wojo relaxed divided list">
      <?php $i = 0;?>
      <?php foreach($this->pagedata as $row):?>
      <?php
	      $newbody = '';
	      $body = $row->body;
      	  $pattern = "/%%(.*?)%%/";
		  preg_match_all($pattern, $body, $matches);
		  if ($matches[1]) {
		    $body = str_replace($matches[0], '', $body);
			$string = Validator::sanitize($body, "default", 250);
			$newbody = preg_replace("|($this->keyword)|Ui", "<span class=\"wojo negative small label\">$1</span>", $string);
		  }
		  $url = $row->page_type == "home" ? Url::url('') : Url::url('/' . $this->core->pageslug, $row->slug);
      ?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small> <a href="<?php echo $url;?>"><?php echo $row->title;?></a></h6>
          <p><?php echo $newbody;?></p>
        </div>
      </div>
      <?php endforeach;?>
      <?php unset($row);?>
    </div>
    <!-- Portfolio -->
    <?php if($this->portadata):?>
    <h5><?php echo ucfirst($this->core->modname['portfolio']);?></h5>
    <div class="wojo relaxed divided list">
      <?php $i = 0;?>
      <?php foreach($this->portadata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small> <a href="<?php echo Url::url('/' . $this->core->modname['portfolio'], $row->slug);?>"><?php echo $row->title;?></a></h6>
          <p><?php echo Validator::sanitize($row->body, "default", 250);?></p>
        </div>
      </div>
      <?php endforeach;?>
      <?php unset($row);?>
    </div>
    <?php endif;?>
    
    <!-- Digishop -->
    <?php if($this->digidata):?>
    <h5><?php echo ucfirst($this->core->modname['digishop']);?></h5>
    <div class="wojo relaxed divided list">
      <?php $i = 0;?>
      <?php foreach($this->digidata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small> <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>"><?php echo $row->title;?></a></h6>
          <p><?php echo Validator::sanitize($row->body, "default", 250);?></p>
        </div>
      </div>
      <?php endforeach;?>
      <?php unset($row);?>
    </div>
    <?php endif;?>
    
    <!-- Blog -->
    <?php if($this->blogdata):?>
    <h5><?php echo ucfirst($this->core->modname['blog']);?></h5>
    <div class="wojo relaxed divided list">
      <?php $i = 0;?>
      <?php foreach($this->blogdata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
           <h6><small><?php echo $i;?>.</small> <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>"><?php echo $row->title;?></a></h6>
          <p><?php echo Validator::sanitize($row->body, "default", 250);?></p>
        </div>
      </div>
      <?php endforeach;?>
      <?php unset($row);?>
    </div>
    <?php endif;?>
    
    <!-- Shop -->
    <?php if($this->shopdata):?>
    <h5><?php echo ucfirst($this->core->modname['shop']);?></h5>
    <div class="wojo relaxed divided list">
      <?php $i = 0;?>
      <?php foreach($this->shopdata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small> <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>"><?php echo $row->title;?></a></h6>
          <p><?php echo Validator::sanitize($row->body, "default", 250);?></p>
        </div>
      </div>
      <?php endforeach;?>
      <?php unset($row);?>
    </div>
    <?php endif;?>
    
    <?php endif;?>
  </div>
</main>