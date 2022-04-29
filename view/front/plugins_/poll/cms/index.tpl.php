<?php
  /**
   * Poll
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(APLUGPATH . 'poll/'));
?>
<!-- Poll -->
<?php if($conf = Utility::findInArray($data['all'], "id", $data['id'])):?>
<div class="wojo poll plugin segment<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
  <?php if($conf[0]->show_title):?>
  <h3 class="center alignedr"><?php echo $conf[0]->title;?></h3>
  <?php endif;?>
  <?php if($conf[0]->body):?>
  <?php echo Url::out_url($conf[0]->body);?>
  <?php endif;?>
  <?php if($data = App::Poll()->Render($data['plugin_id'])):?>
  <?php $voted = Session::cookieExists("CMSPRO_voted", $conf[0]->plugin_id);?>
  <?php foreach($data as $rows):?>
  <h5 class="center aligned"><?php echo $rows->name;?></h5>
  <div class="wojo very relaxed fluid divided list pollResult" style="display:<?php echo $voted == true ? 'block' : 'none';?>">
    <?php foreach($rows->opts as $i => $row):?>
    <?php $percent = Utility::doPercent($row->total, $rows->totals);?>
    <div class="item">
      <div class="content"><?php echo $row->value;?></div>
      <div class="content auto"><span data-total-id="<?php echo $row->oid;?>" class="wojo small basic label"><?php echo $row->total;?></span></div>
    </div>
    <?php endforeach;?>
  </div>
  <div class="wojo very relaxed divided list pollDisplay" style="display:<?php echo $voted == true ? 'none' : 'block';?>">
    <?php foreach($rows->opts as $i => $row):?>
    <a class="item secondary dovote" data-poll='{"id":<?php echo $rows->id;?>,"oid":<?php echo $row->oid;?>,"total":<?php echo $row->total;?>}'>
    <i class="icon line chart"></i>
    <div class="content">
      <div class="header"><?php echo $row->value;?></div>
    </div>
    </a>
    <?php endforeach;?>
  </div>
  <?php endforeach;?>
  <div class="center aligned top padding hide-all goBack">
    <a class="wojo small semi text pollBack"><?php echo Lang::$word->BACK;?></a>
  </div>
  <div class="center aligned top padding goFront" style="display:<?php echo $voted == true ? 'none' : 'block';?>">
    <a class="wojo small primary button pollVote"><?php echo Lang::$word->_PLG_PL_VOTE;?></a>
    <a class="wojo small semi secondary text pollView"><?php echo Lang::$word->_PLG_PL_RESULT;?></a>
  </div>
  <?php endif;?>
</div>
<?php endif;?>