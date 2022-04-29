<?php
  /**
   * File Manager
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: manager.tpl.php, v1.00 2020-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!Auth::hasPrivileges('manage_files')): print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<div id="fm">
  <div class="wojo form segment">
    <div class="row horizontal small gutters align middle">
      <div class="auto columns phone-100">
        <div class="wojo primary stacked button uploader" id="drag-and-drop-zone">
          <i class="icon plus alt"></i>
          <label><?php echo Lang::$word->UPLOAD;?>
            <input type="file" multiple name="files[]">
          </label>
        </div>
      </div>
      <div class="columns phone-100 center aligned">
        <div class="wojo action input">
          <input placeholder="<?php echo Lang::$word->FM_NEWFLD_S1;?>..." name="foldername" type="text">
          <a id="addFolder" class="wojo small primary button">
          <?php echo Lang::$word->ADD;?>
          </a>
        </div>
      </div>
      <div class="auto columns phone-100">
        <a class="wojo negative button stacked disabled is_delete"><?php echo Lang::$word->DELETE;?></a>
      </div>
      <div class="auto columns phone-100">
        <div id="displayType" class="wojo white buttons">
          <a data-type="table" class="wojo icon button<?php echo Session::getCookie("CMS_FLAYOUT") == "table" ? ' active' : null;?>"><i class="icon reorder"></i></a>
          <a data-type="list" class="wojo icon button<?php echo Session::getCookie("CMS_FLAYOUT") == "list" ? ' active' : null;?>"><i class="icon unordered list"></i></a>
          <a data-type="grid" class="wojo icon button<?php echo Session::getCookie("CMS_FLAYOUT") == "grid" ? ' active' : null;?>"><i class="icon dashboard"></i></a>
        </div>
      </div>
      <div class="columns auto phone-hide mobile-hide">
        <a id="togglePreview" class="wojo simple icon button"><i class="icon compress"></i></a>
      </div>
    </div>
  </div>
  <div class="row gutters">
    <div class="auto columns phone-hide mobile-hide">
      <div class="wojo form small card">
        <div class="content">
          <div id="ftype" class="wojo relaxed fluid list">
            <a data-type="all" class="item active">
            <i class="icon inbox"></i>
            <div class="content">
              <div class="header"><?php echo Lang::$word->FM_ALL_F;?></div>
            </div>
            </a>
            <a data-type="pic" class="item">
            <i class="icon photo"></i>
            <div class="content">
              <div class="header"><?php echo Lang::$word->FM_AMG_F;?></div>
            </div>
            </a>
            <a data-type="vid" class="item">
            <i class="icon movie"></i>
            <div class="content">
              <div class="header"><?php echo Lang::$word->FM_VID_F;?></div>
            </div>
            </a>
            <a data-type="aud" class="item">
            <i class="icon volume"></i>
            <div class="content">
              <div class="header"><?php echo Lang::$word->FM_AUD_F;?></div>
            </div>
            </a>
            <a data-type="doc" class="item">
            <i class="icon files"></i>
            <div class="content">
              <div class="header"><?php echo Lang::$word->FM_DOC_F;?></div>
            </div>
            </a>
          </div>
        </div>
        <div class="footer divided">
          <select class="fileSort">
            <option value="name"><?php echo Lang::$word->TITLE;?></option>
            <option value="size"><?php echo Lang::$word->FM_FSIZE;?></option>
            <option value="type"><?php echo Lang::$word->TYPE;?></option>
            <option value="date"><?php echo Lang::$word->FM_LASTM;?></option>
          </select>
          <input type="hidden" name="dir" value="">
        </div>
      </div>
    </div>
    <div class="phone-100 columns">
      <div class="row">
        <div class="columns align middle">
          <div id="fcrumbs" class="wojo small demi text"><?php echo Lang::$word->HOME;?></div>
        </div>
        <div class="columsn align middle auto">
          <div id="done"></div>
        </div>
      </div>
      <div id="fileList" class="wojo small attached relaxed middle aligned celled list"></div>
      <div class="wojo divider"></div>
      <div id="result" class="scrollbox h500"></div>
    </div>
    <div class="auto columns phone-hide mobile-hide">
      <div id="preview"><img src="<?php echo ADMINVIEW;?>/images/blank.png" class="wojo medium image" alt="">
      </div>
    </div>
  </div>
  <div class="footer">
    <div class="wojo small horizontal relaxed divided list">
      <div class="item"><?php echo Lang::$word->FM_SPACE;?>: <span class="description"><?php echo File::directorySize(UPLOADS, true);?></span></div>
      <div id="tsizeDir" class="item"><?php echo Lang::$word->FM_DIRS;?>: <span class="description">0</span></div>
      <div id="tsizeFile" class="item"><?php echo Lang::$word->FM_FILES;?>: <span class="description">0</span></div>
    </div>
  </div>
</div>
<script src="<?php echo ADMINVIEW;?>/js/manager.js"></script>
<script type="text/javascript"> 
// <![CDATA[	
$(document).ready(function() {
    $("#result").Manager({
        url: "<?php echo ADMINVIEW;?>",
        dirurl: "<?php echo UPLOADURL;?>",
		is_editor: false,
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