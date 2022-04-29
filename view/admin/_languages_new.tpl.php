<?php
/**
 * Language Manager
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2020
 * @version $Id: _languages_edit.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');
?>
<h2><?php echo Lang::$word->LG_SUB5;?></h2>
<form method="post" id="wojo_form" name="wojo_form">
    <div class="wojo segment form">
        <div class="wojo fields align middle">
            <div class="field four wide labeled">
                <label><?php echo Lang::$word->LG_NAME;?> <i class="icon asterisk"></i></label>
            </div>
            <div class="field">
                <input type="text" placeholder="<?php echo Lang::$word->LG_NAME;?>" name="name">
            </div>
        </div>
        <div class="wojo fields align middle">
            <div class="field four wide labeled">
                <label><?php echo Lang::$word->LG_AUTHOR;?></label>
            </div>
            <div class="field">
                <input type="text" placeholder="<?php echo Lang::$word->LG_AUTHOR;?>" name="author">
            </div>
        </div>
        <div class="wojo fields align middle">
            <div class="field four wide labeled">
                <label><?php echo Lang::$word->LG_COLOR;?></label>
            </div>
            <div class="field">
                <input type="text" data-wcolor="simple" name="color" data-color='{"showPaletteOnly":true,"color": "#7f8c8d"}' readonly>
            </div>
        </div>
        <div class="wojo fields align middle">
            <div class="field four wide labeled">
                <label><?php echo Lang::$word->LG_ABBR;?> <i class="icon asterisk"></i></label>
            </div>
            <div class="field">
                <input type="text" placeholder="<?php echo Lang::$word->LG_ABBR;?>" name="abbr">
            </div>
        </div>
    </div>
    <div class="center aligned"> <a href="<?php echo Url::url("/admin/languages");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a>
        <button type="button" data-action="processLanguage" name="dosubmit" class="wojo primary button"><?php echo Lang::$word->LG_SUB5;?></button>
    </div>
</form>