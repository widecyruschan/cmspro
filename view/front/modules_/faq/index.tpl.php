<?php
  /**
   * F.A.Q. Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: index.tpl.php, v1.00 2016-12-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'faq/'));
  $data = App::Faq()->Render();
  $cats = App::Faq()->categoryTree();
?>
<!-- Start F.A.Q. Manager -->
<div class="content-center">
  <h1 class="wojo primary text"><?php echo Lang::$word->_MOD_FAQ_SUB;?></h1>
  <p><?php echo Lang::$word->_MOD_FAQ_INFO;?></p>
</div>
<div class="wojo divider"></div>
<?php if($data):?>
<div class="row gutters">
  <div class="columns relative screen-20 tablet-20 mobile-hide phone-hide">
    <?php if($cats):?>
    <div class="wojo native sticky">
      <div class="wojo primary bg basic tall card">
        <div class="content">
          <div class="wojo relaxed list">
            <?php foreach($cats as $crow):?>
            <div class="item">
              <a href="#cat_<?php echo $crow->{'name' . Lang::$lang};?>" class="white" data-scroll="true" data-offset="150"><?php echo $crow->{'name' . Lang::$lang};?></a>
            </div>
            <?php endforeach;?>
          </div>
        </div>
      </div>
    </div>
    <?php endif;?>
  </div>
  <div class="columns screen-80 tablet-80 mobile-100 phone-100" id="context">
    <?php foreach($data as $cat):?>
    <h3 class="wojo primary semi text vertical margin">
      <?php echo $cat['name'];?>
    </h3>
    <?php foreach ($cat['items'] as $row) :?>
    <div class="wojo accordion" id="cat_<?php echo $cat['name'];?>">
      <section>
        <h6 class="summary"><a><?php echo $row['question'];?></a></h6>
        <div class="details">
          <?php echo $row['answer'];?>
        </div>
      </section>
    </div>
    <?php endforeach;?>
    <?php endforeach;?>
  </div>
</div>
<?php else:?>
<?php echo Message::msgSingleInfo(Lang::$word->_MOD_FAQ_NOFAQF);?>
<?php endif;?>
