<?php
  /**
   * Digishop
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _dashboard.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <h4>
    <?php echo Lang::$word->_MOD_DS_SUB11;?>
  </h4>
  <p><?php echo Lang::$word->_MOD_DS_INFO2;?></p>
  <?php if($this->history):?>
  <div class="wojo segment">
    <table class="wojo basic responsive table">
      <thead>
        <tr>
          <th>&nbsp;</th>
          <th><?php echo Lang::$word->NAME;?></th>
          <th><?php echo Lang::$word->DATE;?></th>
          <th class="right aligned"><?php echo Lang::$word->ACTIONS;?></th>
        </tr>
      </thead>
      <?php foreach ($this->history as $row):?>
      <tr>
        <td><a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>"><img src="<?php echo Digishop::hasThumb($row->thumb, $row->pid);?>" alt="" class="wojo small rounded image"></a></td>
        <td><a href="<?php echo Url::url('/' . $this->core->modname['digishop'], $row->slug);?>"><?php echo $row->title;?></a><p class="wojo small text">
		<?php if($row->downloads == "-1"):?>
        <?php echo Lang::$word->_MOD_DS_SUB13;?>
        <?php else:?>
        <?php echo str_replace("[X]", $row->downloads, Lang::$word->_MOD_DS_SUB12);?>
        <?php endif;?>
        </p>
        </td>
        <td><?php echo Date::doDate("short_date", $row->created);?></td>
        <td class="right aligned">
        <?php if($row->downloads == 0):?>
        <a class="wojo small circular simple icon passive button"><i class="icon delete"></i></a>
        <?php else:?>
        <a data-tooltip="<?php echo Lang::$word->DOWNLOAD;?>" href="<?php echo FMODULEURL;?>digishop/download.php?fileid=<?php echo $row->token;?>" class="wojo small basic circular icon button"><i class="icon download"></i></a>
        <?php endif;?>
          <a data-tooltip="<?php echo Lang::$word->M_INVOICE;?>" href="<?php echo FMODULEURL;?>digishop/controller.php?action=invoice&amp;tid=<?php echo Utility::encode($row->txn_id);?>" class="wojo small basic circular icon button"><i class="icon wysiwyg table"></i></a></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <?php endif;?>
</div>