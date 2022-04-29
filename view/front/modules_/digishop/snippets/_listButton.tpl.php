<?php
  /**
   * Digishop List Button
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _listButton.tpl.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php
  if ($row->membership_id == 0) {
      if ($row->price == 0) {
          switch ($this->conf->allow_free) {
              case "yes":
                  echo '<a href="' . FMODULEURL . 'digishop/download.php?free=' . $row->token .
                      '" class="wojo basic positive small fluid button"> <i class="icon unlock"></i>' . Lang::$word->_MOD_DS_DOWNFREE . '</a>';
                  break;
              case "no" and App::Auth()->logged_in:
                  echo '<a href="' . FMODULEURL . 'digishop/download.php?free=' . $row->token .
                      '" class="wojo basic positive small fluid button"> <i class="icon unlock"></i>' . Lang::$word->_MOD_DS_DOWNFREE . '</a>';
                  break;
              default:
                  echo '<a href="' . Url::url("/" . $this->core->system_slugs->login[0]->{'slug_' . Core::$language}) .
                      '" class="wojo secondary basic small fluid button"> <i class="icon red lock"></i>' . Lang::$word->_MOD_DS_LOGIN_TO . '</a>';
                  break;
          }
      } else {
          echo '<a data-id="' . $row->id . '" class="wojo small fluid basic button add-digishop"><i class="icon plus alt"></i>' . Lang::$word->_MOD_DS_SUB5 . '</a>';
      }
  } else {
      if ($row->membership_id and Membership::is_valid(explode(',', $row->membership_id))) {
          echo '<a href="' . FMODULEURL . 'digishop/download.php?member=' . $row->token . 
		  '" class="wojo basic small fluid positive button"> <i class="icon download"></i>' . Lang::$word->_MOD_DS_DOWNMEM . '</a>';
      } else {
          echo '<a class="wojo small basic secondary fluid button disabled"> <i class="icon membership"></i>' . Lang::$word->_MOD_DS_MEMREQ . '</a>';
      }
  }
?>