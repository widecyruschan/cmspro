<?php
  /**
   * Block Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: block-helper.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="section-helper" class="hide-all">
  <div class="header handle">
    <ul class="wojo basic tabs">
      <li class="hide-all">
        <a wojo-tab="rows">Rows</a>
      </li>
      <li class="hide-all">
        <a wojo-tab="blocks">Blocks</a>
      </li>
      <li class="hide-all">
        <a wojo-tab="sections">Sections</a>
      </li>
      <li class="hide-all">
        <a wojo-tab="plugins">Plugins</a>
      </li>
      <li class="hide-all">
        <a wojo-tab="modules">Modules</a>
      </li>
    </ul>
    <a class="close"><i class="icon delete"></i></a>
  </div>
  <div class="content scrollbox" style="min-height:200px;max-height:600px">
    <div id="rows" class="wojo tab item">
      <div class="grid-blocks row grid screen-3 small gutters">
        <div class="columns">
          <a data-row="1" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_1.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="2" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_2.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="3" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_3.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="4" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_4.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="5" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_5.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="6" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_6.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="7" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_7.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="8" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_8.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="9" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_9.svg">
          </a>
        </div>
        <div class="columns">
          <a data-row="10" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_10.svg">
          </a>
        </div>
        <div class="columns">&nbsp;</div>
        <div class="columns">
          <a data-row="11" data-element="rows">
          <img src="<?php echo ADMINVIEW;?>/builder/images/grid_11.svg">
          </a>
        </div>
      </div>
    </div>
    <div id="blocks" class="wojo tab item">
      <div class="grid-blocks row grid screen-2 small gutters">
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_2">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_2.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_3">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_3.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_4">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_4.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_5">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_5.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_6">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_6.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="divider" data-element="blocks" data-html="elements/divider_7">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/divider_7.png">
          </a>
        </div>
      </div>
      <div class="grid-blocks row grid screen-4 small gutters">
        <div class="columns">
          <a data-name="soundcloud" data-element="blocks" data-html="elements/audio_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/audio_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="google map" data-element="blocks" data-html="elements/map_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/map_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="youtube" data-element="blocks" data-html="elements/youtube_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/youtube_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="vimeo" data-element="blocks" data-html="elements/vimeo_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/vimeo_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="image" data-element="blocks" data-html="elements/picture_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/picture_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="button" data-element="blocks" data-html="elements/button_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/button_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="heading" data-element="blocks" data-html="elements/heading_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/heading_1.png">
          </a>
        </div>
        <div class="columns">
          <a data-name="paragraph" data-element="blocks" data-html="elements/text_1">
          <img src="<?php echo Url::builderUrl($this->core->theme);?>/thumbs/text_1.png">
          </a>
        </div>
      </div>
    </div>
    <div id="sections" class="wojo tab item">
      <?php if(File::is_File(BUILDERBASE . "/themes/" . $this->core->theme . "/sections.tpl.php")):?>
      <?php include BUILDERBASE . "/themes/" . $this->core->theme . "/sections.tpl.php";?>
      <?php else:?>
      <?php include BUILDERBASE . "/themes/default/sections.tpl.php";?>
      <?php endif;?>
    </div>
    <!-- System Plugins -->
    <div id="plugins" class="wojo tab item">
      <div class="grid-blocks row grid screen-3 small gutters">
        <?php if($this->plugins):?>
        <?php foreach($this->plugins as $row):?>
        <?php if($row->plugalias):?>
        <div class="columns">
          <a data-element="plugins" data-mode="readonly" data-plugin-id="<?php echo $row->id;?>" data-plugin-plugin_id="<?php echo $row->plugin_id;?>" data-plugin-name="<?php echo htmlspecialchars($row->title);?>" data-plugin-alias="<?php echo $row->plugalias;?>" data-plugin-group="<?php echo $row->groups;?>">
          <img src="<?php echo APLUGINURL . $row->icon;?>">
          </a>
          <p class="truncate small margin top center aligned"><span class="wojo tiny text"><?php echo $row->title;?></span></p>
        </div>
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
      </div>
      
      <!-- User Plugins -->
      <div class="grid-blocks row grid screen-2 small gutters">
        <?php if($this->plugins):?>
        <?php foreach($this->plugins as $row):?>
        <?php if(!$row->plugalias):?>
        <div class="columns">
          <a data-element="uplugins" data-plugin-id="<?php echo $row->id;?>" data-plugin-name="<?php echo htmlspecialchars($row->title);?>">
          <img src="<?php echo BUILDERVIEW;?>/images/uplugins.jpg">
          </a>
          <p class="truncate small margin top center aligned"><span class="wojo tiny text"><?php echo $row->title;?></span></p>
        </div>
        <?php endif;?>
        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
    
    <!-- System Modules -->
    <div id="modules" class="wojo tab item">
      <div class="grid-blocks row grid screen-3 small gutters">
        <?php if($this->modules):?>
        <?php foreach($this->modules as $row):?>
        <?php $group = explode("/", $row->modalias);?>
        <div class="columns">
          <a data-element="modules" data-mode="readonly" data-module-id="<?php echo $row->parent_id;?>" data-module-module_id="<?php echo $row->id;?>" data-module-name="<?php echo $row->title;?>" data-module-alias="<?php echo $row->modalias;?>" data-module-group="<?php echo $group[0];?>">
          <img src="<?php echo AMODULEURL . $row->icon;?>">
          </a>
          <p class="truncate small margin top center aligned"><span class="wojo tiny text"><?php echo $row->title;?></span></p>
        </div>
        <?php endforeach;?>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>