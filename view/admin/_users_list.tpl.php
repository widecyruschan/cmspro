<?php
  /**
   * User Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _users_list.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row gutters align middle">
  <div class="columns auto mobile-100 mobile-order-1">
    <h2><?php echo Lang::$word->META_T2;?></h2>
  </div>
  <div class="columns right aligned mobile-50 phone-100 mobile-order-2">
    <a href="<?php echo Url::url(Router::$path, "new/");?>" class="wojo small dark stacked button"><i class="icon plus alt"></i><?php echo Lang::$word->M_TITLE5;?></a>
  </div>
  <div class="columns auto mobile-order-3">
    <div class="wojo filter buttons">
      <a class="wojo small disabled icon button"><i class="icon unordered list"></i></a>
      <a href="<?php echo Url::url(Router::$path, "grid/");?>" class="wojo small primary icon button"><i class="icon grid list"></i></a>
    </div>
  </div>
  <div class="columns auto mobile-order-4">
    <a href="<?php echo ADMINVIEW . '/helper.php?action=exportUsers';?>" class="wojo small primary button"><?php echo Lang::$word->EXPORT;?></a>
  </div>
</div>
<div class="row gutters align center">
  <div class="columns screen-40 tablet-50 mobile-100 phone-100">
    <form method="post" id="wojo_form" name="wojo_form" class="wojo form">
      <div class="wojo action input">
        <input name="find" placeholder="<?php echo Lang::$word->SEARCH;?>" type="text">
        <button class="wojo small icon primary inverted button">
        <i class="icon find"></i></button>
      </div>
    </form>
  </div>
</div>
<div class="center aligned">
  <div class="wojo small divided horizontal list">
    <div class="disabled item wojo bold text">
      <?php echo Lang::$word->SORTING_O;?>
    </div>
    <a href="<?php echo Url::url(Router::$path);?>" class="item<?php echo Url::setActive("order", false);?>">
    <?php echo Lang::$word->RESET;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=membership_id|DESC");?>" class="item<?php echo Url::setActive("order", "items");?>">
    <?php echo Lang::$word->MEMBERSHIP;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=email|DESC");?>" class="item<?php echo Url::setActive("order", "email");?>">
    <?php echo Lang::$word->M_EMAIL1;?>
    </a>
    <a href="<?php echo Url::url(Router::$path, "?order=fname|DESC");?>" class="item<?php echo Url::setActive("order", "fname");?>">
    <?php echo Lang::$word->NAME;?>
    </a>
    <div class="item"><a href="<?php echo Url::sortItems(Url::url(Router::$path), "order");?>" data-tooltip="ASC/DESC"><i class="icon triangle unfold more link"></i></a>
    </div>
  </div>
</div>
<div class="center aligned vertical margin">
  <?php echo Validator::alphaBits(Url::url(Router::$path), "letter");?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/notfound.png" alt="">
  <p class="wojo small bold caps text"><?php echo Lang::$word->M_INFO6;?></p>
</div>
<?php else:?>
<div class="row grid screen-2 tablet-1 mobile-1 phone-1 small gutters">
  <?php foreach($this->data as $row):?>
  <div class="columns" id="item_<?php echo $row->id;?>">
    <div class="wojo attached card">
      <div class="divided header">
        <div class="row horizontal gutters align middle">
          <div class="columns auto"><img src="<?php echo UPLOADURL;?>/avatars/<?php echo $row->avatar ? $row->avatar : "blank.png" ;?>" alt="" class="wojo avatar image"></div>
          <div class="columns">
            <h4>
              <?php if(Auth::hasPrivileges('edit_user')):?>
              <a href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><?php echo $row->fullname;?></a>
              <?php else:?>
              <?php echo $row->fullname;?>
              <?php endif;?>
            </h4>
            <?php echo Utility::status($row->active, $row->id);?>
            <?php echo Utility::userType($row->type);?>
          </div>
          <div class="column auto">
            <a class="wojo icon circular primary inverted button" data-wdropdown="#userDrop_<?php echo $row->id;?>">
            <i class="icon horizontal ellipsis"></i>
            </a>
            <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $row->id;?>">
              <?php if(Auth::hasPrivileges('edit_user')):?>
              <a class="item" href="<?php echo Url::url(Router::$path, "edit/" . $row->id);?>"><i class="icon pencil"></i>
              <?php echo Lang::$word->EDIT;?></a>
              <?php endif;?>
              <a class="item" href="<?php echo Url::url(Router::$path, "history/" . $row->id);?>"><i class="icon history"></i>
              <?php echo Lang::$word->HISTORY;?></a>
              <?php if(Auth::hasPrivileges('delete_user')):?>
              <div class="wojo basic divider"></div>
              <a data-set='{"option":[{"trash":"trashUser","title": "<?php echo Validator::sanitize($row->fullname, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"trash","parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
              <i class="icon trash"></i>
              <?php echo Lang::$word->TRASH;?></a>
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>
      <div class="footer center aligned">
        <div class="wojo small divided horizontal block list align center">
          <div class="item">
            <?php echo Lang::$word->M_EMAIL1;?>
            <span class="description"><a href="<?php echo Url::url("/admin/mailer", "?email=" . urlencode($row->email));?>"><?php echo $row->email;?></a>
            </span>
          </div>
          <div class="item">
            <?php echo Lang::$word->CREATED;?>
            <span class="description"><?php echo Date::doDate("short_date", $row->created);?></span>
          </div>
        </div>
        <div class="wojo small divided horizontal block list align center">
          <div class="item">
            <?php echo Lang::$word->MEMBERSHIP;?>
            <span class="description"><?php echo ($row->membership_id) ? '<a href="' . Url::url("/admin/memberships/edit/" . $row->membership_id) . '">' . $row->mtitle . '</a>' : '-/-';?></span>
          </div>
          <div class="item">
            <?php echo Lang::$word->MEM_EXP;?>
            <span class="description"><?php echo ($row->mem_expire) ? Date::doDate("short_date", $row->mem_expire) : "-/-";?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<div class="row gutters align middle spaced">
  <div class="columns auto mobile-100 phone-100">
    <div class="wojo small semi text"><?php echo Lang::$word->TOTAL . ': ' . $this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE . ': ' . $this->pager->current_page . ' '. Lang::$word->OF . ' ' . $this->pager->num_pages;?></div>
  </div>
  <div class="columns auto mobile-100 phone-100"><?php echo $this->pager->display_pages();?></div>
</div>
