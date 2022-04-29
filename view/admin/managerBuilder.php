<?php
  /**
   * File Manager Page Builder
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: managerBuilder.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  define("_WOJO", true);
  require_once("../../init.php");
	  
  if (!App::Auth()->is_Admin())
      exit;
	  
  if(!Auth::hasPrivileges('manage_files')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div class="header">
  <h4 class="basic"><?php echo Lang::$word->ADM_FM;?></h4>
</div>
<div class="body" id="fm">
  <div class="wojo form margin bottom">
    <div class="row horizontal small gutters align middle">
      <div class="auto columns phone-100">
        <div class="wojo primary small stacked button uploader" id="drag-and-drop-zone">
          <i class="icon plus alt"></i>
          <label><?php echo Lang::$word->UPLOAD;?>
            <input type="file" multiple name="files[]">
          </label>
        </div>
      </div>
      <div class="columns phone-100 center aligned">
        <div class="wojo small action input">
          <input placeholder="<?php echo Lang::$word->FM_NEWFLD_S1;?>..." name="foldername" type="text">
          <a id="addFolder" class="wojo small primary button">
          <?php echo Lang::$word->ADD;?>
          </a>
        </div>
      </div>
      <div class="auto columns phone-100">
        <a class="wojo negative small button stacked disabled is_delete"><?php echo Lang::$word->DELETE;?></a>
      </div>
      <div class="auto columns phone-100">
        <div id="displayType" class="wojo small white buttons">
          <a data-type="table" class="wojo icon small button<?php echo Session::getCookie("CMS_FLAYOUT") == "table" ? ' active' : null;?>"><i class="icon reorder"></i></a>
          <a data-type="list" class="wojo icon small button<?php echo Session::getCookie("CMS_FLAYOUT") == "list" ? ' active' : null;?>"><i class="icon unordered list"></i></a>
          <a data-type="grid" class="wojo icon small button<?php echo Session::getCookie("CMS_FLAYOUT") == "grid" ? ' active' : null;?>"><i class="icon dashboard"></i></a>
        </div>
      </div>
      <div class="columns auto hide-all">
        <a id="fInsert" class="wojo small positive button"><?php echo Lang::$word->INSERT;?></a>
      </div>
    </div>
  </div>
  <div class="row align middle">
    <div class="columns">
      <div id="fcrumbs" class="wojo small demi text"><?php echo Lang::$word->HOME;?></div>
    </div>
    <div class="colums auto">
      <div id="done"></div>
    </div>
  </div>
  <div id="fileList" class="wojo small attached relaxed middle aligned celled list"></div>
  <div class="wojo divider"></div>
  <div class="scrollbox h500">
    <div id="result"></div>
  </div>
  <div class="footer">
    <div class="wojo small horizontal relaxed divided list">
      <div class="item"><?php echo Lang::$word->FM_SPACE;?>: <span class="description"><?php echo File::directorySize(UPLOADS, true);?></span></div>
      <div id="tsizeDir" class="item"><?php echo Lang::$word->FM_DIRS;?>: <span class="description">0</span></div>
      <div id="tsizeFile" class="item"><?php echo Lang::$word->FM_FILES;?>: <span class="description">0</span></div>
    </div>
  </div>
</div>
<input type="hidden" name="dir" value="">
<script src="<?php echo ADMINVIEW;?>/js/manager.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $("#result").Manager({
        url: "<?php echo ADMINVIEW;?>",
        dirurl: "<?php echo UPLOADURL;?>",
		is_editor: true,
		is_mce: false,
        lang: {
            delete: "<?php echo Lang::$word->DELETE;?>",
			insert: "<?php echo Lang::$word->INSERT;?>",
			download: "<?php echo Lang::$word->DOWNLOAD;?>",
			unzip: "<?php echo Lang::$word->FM_UNZIP;?>",
			size: "<?php echo Lang::$word->FM_FSIZE;?>",
			lastm: "<?php echo Lang::$word->FM_LASTM;?>",
			items: "<?php echo strtolower(Lang::$word->ITEMS);?>",
			done: "<?php echo Lang::$word->DONE;?>",
			home: "<?php echo Lang::$word->HOME;?>",
        }
    });
});
// ]]>
</script>