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
        <div class="columns screen-60 tablet-60 mobile-100 phone-100">
          <h1 class="wojo white text"><?php echo $this->data->{'title' . Lang::$lang};?></h1>
          <p class="wojo white text"><?php echo $this->data->{'caption' . Lang::$lang};?></p>
          <form method="get" id="wojo_form" name="wojo_form" class="wojo form">
            <div class="wojo action transparent input">
              <input name="keyword" placeholder="<?php echo Lang::$word->SEARCH;?>..." type="text">
              <button class="wojo icon white button">
              <i class="find icon"></i>
              </button>
            </div>
          </form>
        </div>
        <div class="columns screen-40 tablet-40 mobile-hide phone-hide">
          <figure style="margin-bottom:-4rem">
            <img src="<?php echo THEMEURL;?>/images/search-girl.svg" alt="<?php echo $this->data->{'title' . Lang::$lang};?>">
          </figure>
        </div>
      </div>
    </div>
    <figure class="wave">
      <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 150 512 200" width="100%" height="100px">
        <path fill="#fff" d="M38.6 264.9S111.8 196 188 236.5c131.9 70.3 193.4-3.9 250.3-9.5 83-8.1 121.8 34 121.8 34v107l-521.4.3V264.9z" opacity=".4"/>
        <path fill="#fffefe" d="M-72 267s70.2-69.7 146.3-29.1c131.9 70.3 193.4-3.9 250.3-9.5 83-8.1 119.4 32.4 119.4 32.4v108.8l-516 .4V267z" opacity=".4"/>
        <path fill="#fff" d="M-72 302s94.3-90.3 204-54.7c139.7 45.4 190 12.3 250.3-9.5C472.9 205.1 560 311 560 311v74H-72v-83z"/>
      </svg>
    </figure>
  </div>
  <div class="wojo-grid">
    <?php if(!$this->keyword || strlen($this->keyword = trim($this->keyword)) == 0 || strlen($this->keyword) < 3):?>
    <?php Message::msgSingleInfo(Lang::$word->FRT_SEARCH_EMPTY2);?>
    <?php elseif(!$this->pagedata and !$this->blogdata and !$this->portadata and !$this->digidata and !$this->shopdata):?>
    <?php Message::msgSingleAlert(Lang::$word->FRT_SEARCH_EMPTY . '<span class="wojo bold text">[' . Validator::sanitize($this->keyword) . ']</span>' . Lang::$word->FRT_SEARCH_EMPTY1);?>
    <?php else:?>
    <!-- Page -->
    <div class="wojo relaxed divided list vertical margin">
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
          <h6><small><?php echo $i;?>.</small>
            <a href="<?php echo $url;?>"><?php echo $row->title;?></a>
          </h6>
          <p><?php echo $newbody;?></p>
        </div>
      </div>
      <?php endforeach;?>
      <?php unset($row);?>
    </div>
    <!-- Portfolio -->
    <?php if($this->portadata):?>
    <h5><?php echo ucfirst($this->core->modname['portfolio']);?></h5>
    <div class="wojo relaxed divided list vertical margin">
      <?php $i = 0;?>
      <?php foreach($this->portadata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small>
            <a href="<?php echo Url::url('/' . $this->core->modname['portfolio'], $row->slug);?>"><?php echo $row->title;?></a>
          </h6>
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
    <div class="wojo relaxed divided list vertical margin">
      <?php $i = 0;?>
      <?php foreach($this->digidata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small>
            <a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>"><?php echo $row->title;?></a>
          </h6>
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
    <div class="wojo relaxed divided list vertical margin">
      <?php $i = 0;?>
      <?php foreach($this->blogdata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small>
            <a href="<?php echo Url::url('/' . $this->core->modname['blog'], $row->slug);?>"><?php echo $row->title;?></a>
          </h6>
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
    <div class="wojo relaxed divided list vertical margin">
      <?php $i = 0;?>
      <?php foreach($this->shopdata as $row):?>
      <?php $i++;?>
      <div class="item">
        <div class="content">
          <h6><small><?php echo $i;?>.</small>
            <a href="<?php echo Url::url('/' . $this->core->modname['shop'], $row->slug);?>"><?php echo $row->title;?></a>
          </h6>
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