<?php
  /**
   * Header
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: 404.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
 ?>
<main class="align middle">
  <div class="columns">
    <a href="<?php echo SITEURL;?>/" class="logo"><?php echo ($this->core->logo) ? '<img src="' . SITEURL . '/uploads/' . $this->core->logo . '" alt="'.$this->core->company . '">': $this->core->company;?></a>
    <h1 class="underlined"><?php echo Lang::$word->META_ERROR;?></h1>
    <p class="basic"><?php echo Lang::$word->META_ERROR2;?></p>
    <p><?php echo Lang::$word->META_ERROR3;?> <a href="<?php echo URl::url('/' . $this->core->system_slugs->search[0]->{'slug' . Lang::$lang});?>"> <?php echo Lang::$word->META_ERROR3_1;?></a></p>
    <a href="<?php echo SITEURL;?>/" class="wojo primary wide button"><i class="icon chevron left"></i>Go Back</a>
  </div>
</main>