<?php
  /**
   * Edit Role
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: copyPage.tpl.php, v1.00 2020-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="body">
  <div class="wojo small form">
    <form method="post" id="modal_form" name="modal_form">
      <div class="wojo lang tabs">
        <ul class="nav">
          <?php foreach($this->core->langlist as $lang):?>
          <li<?php echo ($lang->abbr == $this->core->lang) ? ' class="active"' : null;?>><a style="border-color:<?php echo $lang->color;?>;background:<?php echo $lang->color;?>;color:#fff" data-tab="lang_<?php echo $lang->abbr;?>"><span class="flag icon <?php echo $lang->abbr;?>"></span><?php echo $lang->name;?></a>
          </li>
          <?php endforeach;?>
        </ul>
        <div class="tab gutters">
          <?php foreach($this->core->langlist as $lang):?>
          <div data-tab="lang_<?php echo $lang->abbr;?>" class="item">
            <div class="wojo fields">
              <div class="field">
                <label class=""><?php echo Lang::$word->PAG_NAME;?><small><?php echo $lang->abbr;?></small>
                  <i class="icon asterisk"></i></label>
                <div class="wojo input">
                  <input type="text" placeholder="<?php echo Lang::$word->NAME;?>" name="title_<?php echo $lang->abbr?>">
                </div>
              </div>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      </div>
    </form>
  </div>
</div>