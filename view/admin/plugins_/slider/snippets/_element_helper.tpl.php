<?php
  /**
   * Element Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _element_helper.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  $images = File::findFiles(UPLOADS, array('fileTypes'=>array('jpg', 'png', 'svg'),'exclude'=>array('/thumbs/','/avatars/','/memberships/'),'returnType'=>'fullPath'));
?>
<div id="element-helper" class="hide-all">
  <div class="header">
    <i class="icon white note"></i>
    <h3 class="handle"> Element Insert</h3>
    <a class="close-styler"><i class="icon white delete"></i></a>
  </div>
  <div class="sub-header">
    <div class="row">
      <div class="columns">
        <a data-tab="el_button" data-type="button" class="wojo simple fluid button tbutton active"> Button</a>
      </div>
      <div class="columns">
        <a data-tab="el_icon" data-type="icon" class="wojo simple fluid button tbutton">Icon</a>
      </div>
      <div class="columns">
        <a data-tab="el_image" data-type="image" class="wojo simple fluid button tbutton"> Image</a>
      </div>
      <div class="columns">
        <a data-tab="el_text" data-type="text" class="wojo simple fluid button tbutton"> Text</a>
      </div>
    </div>
  </div>
  <div style="max-height:400px;overflow:auto">
    <div id="el_button" class="wojo tab active">
      <div class="row gutters">
        <div class="columns small full padding center aligned" id="buttons">
          <div class="small full padding"><a class="wojo button" style="box-shadow:none"><span>Button Text</span></a>
          </div>
          <div class="small full padding"><a class="wojo rounded button" style="box-shadow:none"><span>Button Text</span></a>
          </div>
          <div class="small full padding"><a class="wojo button" style="box-shadow:none"><i class="icon check"></i><span>Button Text</span></a>
          </div>
          <div class="small full padding"><a class="wojo rounded button" style="box-shadow:none"><i class="icon check"></i><span>Button Text</span></a>
          </div>
          <div class="small full padding"><a class="wojo circular icon button" style="box-shadow:none"><i class="icon check"></i></a>
          </div>
          <div class="small full padding"><a class="wojo labeled icon button" style="box-shadow:none">
            <i class="icon check"></i>
            <span>Button Text</span>
            </a>
          </div>
          <div class="small full padding"><a class="wojo right labeled icon button" style="box-shadow:none">
            <span>Button Text</span>
            <i class="icon check"></i>
            </a>
          </div>
        </div>
        <div class="columns auto small full padding">
          <h4>Colors</h4>
          <div class="wojo space divider"></div>
          <p class="wojo small bold text"> Background Color </p>
          <div class="wojo space divider"></div>
          <div class="wojo small fluid right action input">
            <input type="text" placeholder="Background Color" readonly>
            <button class="wojo small basic icon button docolors" data-color="bg"><i class="icon apps"></i></button>
          </div>
          <div class="wojo space divider"></div>
          <p class="wojo small bold text"> Text Color </p>
          <div class="wojo space divider"></div>
          <div class="wojo small fluid right action input">
            <input type="text" placeholder="Text Color" readonly>
            <button class="wojo small basic icon button docolors" data-color="text"><i class="icon apps"></i></button>
          </div>
          <div class="wojo space divider"></div>
          <p class="wojo small bold text"> Icon Color </p>
          <div class="wojo space divider"></div>
          <div class="wojo small fluid right action input">
            <input type="text" placeholder="Icon Color" readonly>
            <button class="wojo small basic icon button docolors" data-color="icon"><i class="icon apps"></i></button>
          </div>
          <div class="wojo space divider"></div>
          <p class="wojo small bold text"> Button Text </p>
          <div class="wojo space divider"></div>
          <div class="wojo small fluid input">
            <input type="text" placeholder="Button Text" name="btext">
          </div>
          <div class="wojo space divider"></div>
          <p class="wojo small bold text"> Button Link </p>
          <div class="wojo space divider"></div>
          <div class="wojo small fluid input">
            <input type="text" placeholder="http://" name="burl">
          </div>
        </div>
      </div>
    </div>
    <div id="el_icon" class="wojo tab">
      <div class="small full padding">
        <?php include(BASEPATH . '/view/admin/builder/snippets/icons.tpl.php');?>
      </div>
    </div>
    <div id="el_image" class="wojo tab">
      <div class="small full padding">
        <div class="wojo small mason">
          <?php foreach ($images as $rows):?>
          <?php $file = str_replace(UPLOADS, UPLOADURL, $rows);?>
          <?php if(substr(strrchr($rows,'.'),1) == "svg"):?>
          <a class="item thumb" data-type="svg" data-src="<?php echo str_replace(BASEPATH, "", $rows);?>"><img src="<?php echo $file;?>"></a>
          <?php else:?>
          <?php if(File::is_File(UPLOADS . '/thumbs/' . basename($file))):?>
          <a class="item thumb" data-type="img"  data-src="<?php echo str_replace(BASEPATH, "", $rows);?>"><img src="<?php echo UPLOADURL . '/thumbs/' . basename($file);?>"></a>
          <?php endif;?>
          <?php endif;?>
          <?php endforeach;?>
        </div>
      </div>
    </div>
    <div id="el_text" class="wojo tab">
      <div class="small full padding center aligned">
        <div class="item">
          <h1>Welcome to Our Company</h1>
        </div>
        <div class="item">
          <h2>Welcome to Our Company</h2>
        </div>
        <div class="item">
          <h3>Welcome to Our Company</h3>
        </div>
        <div class="item">
          <h4>Welcome to Our Company</h4>
        </div>
        <div class="item">
          <p>Demonstrate relevant and engaging content but maximise share of voice. Target key demographics so that we make users into advocates.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="full padding">
    <div class="actions center aligned">
      <button class="wojo insert small primary button">insert</button>
    </div>
  </div>
</div>