<?php
  /**
   * History
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _history.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="wojo-grid">
  <h4>
    <?php echo Lang::$word->HISTORY;?>
  </h4>
  <p><?php echo Lang::$word->M_INFO14;?></p>
  <?php if($this->history):?>
  <div class="wojo segment">
    <table class="wojo basic responsive table">
      <thead>
        <tr>
          <th><?php echo Lang::$word->NAME;?></th>
          <th><?php echo Lang::$word->MEM_ACT;?></th>
          <th><?php echo Lang::$word->MEM_EXP;?></th>
          <th><?php echo Lang::$word->MEM_REC1;?></th>
          <th class="auto"></th>
        </tr>
      </thead>
      <?php foreach ($this->history as $row):?>
      <tr>
        <td><?php echo $row->title;?></td>
        <td><?php echo Date::doDate("long_date", $row->activated);?></td>
        <td><?php echo Date::doDate("long_date", $row->expire);?></td>
        <td class="center aligned"><?php echo Utility::isPublished($row->recurring);?></td>
        <td class="center aligned"><a href="<?php echo FRONTVIEW;?>/controller.php?action=invoice&amp;id=<?php echo $row->tid;?>"><i class="icon download"></i></a></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <?php endif;?>
</div>