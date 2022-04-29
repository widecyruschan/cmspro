<?php
  /**
   * Trash
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: trash.tpl.php, v1.00 2020-11-12 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="row small gutters align middle">
  <div class="columns mobile-100 phone-100">
    <h3><?php echo Lang::$word->TRS_TITLE;?></h3>
    <p class="wojo small text"><?php echo Lang::$word->TRS_INFO;?></p>
  </div>
  <?php if($this->data):?>
  <div class="columns auto mobile-100 phone-100">
    <a data-set='{"option":[{"delete": "trashAll","title": "<?php echo Validator::sanitize(Lang::$word->TRS_TEMPTY, "chars");?>","id":0}],"action":"delete","parent":"#self"}' class="wojo negative button data"><?php echo Lang::$word->TRS_TEMPTY;?></a>
  </div>
  <?php endif;?>
</div>
<?php if(!$this->data):?>
<div class="wojo segment center aligned"><img src="<?php echo ADMINVIEW;?>/images/trash_empty.png" alt="">
  <p class="wojo small thick caps text"><?php echo Lang::$word->TRS_NOTRS;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $type => $rows):?>
<?php switch($type): ?>
<?php case "user":?>
<div class="wojo segment">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th colspan="2"><h4><?php echo Lang::$word->ADM_USERS;?></h4></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <?php $dataset = Utility::jSonToArray($row->dataset);?>
    <tr id="user_<?php echo $dataset->id;?>">
      <td><?php echo $dataset->fname;?>
        <?php echo $dataset->lname;?></td>
      <td class="auto"><a data-set='{"option":[{"restore": "restoreUser","title": "<?php echo Validator::sanitize($dataset->fname . ' ' . $dataset->lname, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#user_<?php echo $dataset->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteUser","title": "<?php echo Validator::sanitize($dataset->fname . ' ' . $dataset->lname, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#user_<?php echo $dataset->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($dataset);?>
  </table>
</div>
<?php break;?>
<?php case "membership":?>
<div class="wojo segment">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th colspan="2"><h4><?php echo Lang::$word->ADM_MEMBS;?></h4></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <?php $dataset = Utility::jSonToArray($row->dataset);?>
    <tr id="membership_<?php echo $dataset->id;?>">
      <td><?php echo $dataset->{'title_en'};?></td>
      <td class="auto"><a data-set='{"option":[{"restore": "restoreMembership","title": "<?php echo Validator::sanitize($dataset->{'title_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#membership_<?php echo $dataset->id;?>"}' class="wojo small positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteMembership","title": "<?php echo Validator::sanitize($dataset->{'title_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#membership_<?php echo $dataset->id;?>"}' class="wojo small negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($dataset);?>
  </table>
</div>
<?php break;?>
<?php case "page":?>
<div class="wojo segment">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th colspan="2"><h4><?php echo Lang::$word->ADM_PAGES;?></h4></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <?php $dataset = Utility::jSonToArray($row->dataset);?>
    <tr id="page_<?php echo $dataset->id;?>">
      <td><?php echo $dataset->{'title_en'};?></td>
      <td class="auto"><a data-set='{"option":[{"restore": "restorePage","title": "<?php echo Validator::sanitize($dataset->{'title_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#page_<?php echo $dataset->id;?>"}' class="wojo small positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deletePage","title": "<?php echo Validator::sanitize($dataset->{'title_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#page_<?php echo $dataset->id;?>"}' class="wojo small negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($dataset);?>
  </table>
</div>
<?php break;?>
<?php case "coupon":?>
<div class="wojo segment">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th colspan="2"><h4><?php echo Lang::$word->ADM_COUPONS;?></h4></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <?php $dataset = Utility::jSonToArray($row->dataset);?>
    <tr id="coupon_<?php echo $dataset->id;?>">
      <td><?php echo $dataset->title;?></td>
      <td class="auto"><a data-set='{"option":[{"restore": "restoreCoupon","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#coupon_<?php echo $dataset->id;?>"}' class="wojo small positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteCoupon","title": "<?php echo Validator::sanitize($dataset->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#coupon_<?php echo $dataset->id;?>"}' class="wojo small negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($dataset);?>
  </table>
</div>
<?php break;?>
<?php case "menu":?>
<div class="wojo segment">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th colspan="2"><h4><?php echo Lang::$word->ADM_MENUS;?></h4></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <?php $dataset = Utility::jSonToArray($row->dataset);?>
    <tr id="menu_<?php echo $dataset->id;?>">
      <td><?php echo $dataset->{'name_en'};?></td>
      <td class="auto"><a data-set='{"option":[{"restore": "restoreMenu","title": "<?php echo Validator::sanitize($dataset->{'name_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#menu_<?php echo $dataset->id;?>"}' class="wojo small positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteMenu","title": "<?php echo Validator::sanitize($dataset->{'name_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#menu_<?php echo $dataset->id;?>"}' class="wojo small negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($dataset);?>
  </table>
</div>
<?php break;?>
<?php case "plugin":?>
<div class="wojo segment">
  <table class="wojo small basic table">
    <thead>
      <tr>
        <th colspan="2"><h4><?php echo Lang::$word->PLUGINS;?></h4></th>
      </tr>
    </thead>
    <?php foreach($rows as $row):?>
    <?php $dataset = Utility::jSonToArray($row->dataset);?>
    <tr id="plugin_<?php echo $dataset->id;?>">
      <td><?php echo $dataset->{'title_en'};?></td>
      <td class="auto"><a data-set='{"option":[{"restore": "restorePlugin","title": "<?php echo Validator::sanitize($dataset->{'title_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#plugin_<?php echo $dataset->id;?>"}' class="wojo small positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deletetPlugin","title": "<?php echo Validator::sanitize($dataset->{'title_en'}, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#plugin_<?php echo $dataset->id;?>"}' class="wojo small negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a></td>
    </tr>
    <?php endforeach;?>
    <?php unset($dataset);?>
  </table>
</div>
<?php break;?>
<?php endswitch;?>
<?php endforeach;?>
<?php endif;?>