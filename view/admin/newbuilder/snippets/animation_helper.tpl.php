<?php
  /**
   * Animation Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: animation_helper.tpl.php, v1.00 2019-09-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="animation-helper" class="hide-all">
  <div class="header">
    <i class="icon white spin circles"></i>
    <h3 class="handle"> Animation Editor</h3>
    <a class="close-animator"><i class="icon white delete"></i></a>
  </div>
  <div class="wojo form wrapper" id="anieditor">
    <div class="row gutters">
      <div class="columns center aligned">
        <a class="wojo fluid icon button item noani" data-value="none"><i class="icon ban"></i></a>
        <small>none</small>
      </div>
      <div class="columns center aligned">
        <a data-wdropdown="#animationFade" class="wojo fluid icon button"><i class="icon wysiwyg fade"></i></a>
        <small>fade</small>
        <div class="wojo small dropdown dark top-center" id="animationFade">
          <a class="item" data-value="fadeIn">fadeIn</a>
          <a class="item" data-value="fadeInLeft">fadeInLeft</a>
          <a class="item" data-value="fadeInRight">fadeInRight</a>
          <a class="item" data-value="fadeInTop">fadeInTop</a>
          <a class="item" data-value="fadeInBottom">fadeInBottom</a>
        </div>
      </div>
      <div class="columns center aligned">
        <a data-wdropdown="#animationSlide" class="wojo fluid icon button"><i class="icon wysiwyg slide"></i></a>
        <small>slide</small>
        <div class="wojo small dropdown dark top-center" id="animationSlide">
          <a class="item" data-value="driveInLeft">slideInLeft</a>
          <a class="item" data-value="driveInRight">slideInRight</a>
          <a class="item" data-value="driveInTop">slideInTop</a>
          <a class="item" data-value="driveInBottom">slideInBottom</a>
        </div>
      </div>
      <div class="columns center aligned">
        <a data-wdropdown="#animationBounce" class="wojo fluid icon button"><i class="icon wysiwyg bounce"></i></a>
        <small>bounce</small>
        <div class="wojo small dropdown dark top-center" id="animationBounce">
          <a class="item" data-value="popIn">bounceIn</a>
          <a class="item" data-value="popInLeft">bounceInLeft</a>
          <a class="item" data-value="popInRight">bounceInRight</a>
          <a class="item" data-value="popInTop">bounceInTop</a>
          <a class="item" data-value="popInBottom">bounceInBottom</a>
        </div>
      </div>
    </div>
    <div class="row gutters">
      <div class="columns center aligned">
        <a data-wdropdown="#animationZoom" class="wojo fluid icon button"><i class="icon wysiwyg zoom"></i></a>
        <small>zoom</small>
        <div class="wojo small dropdown dark top-center" id="animationZoom">
          <a class="item" data-value="popIn">zoomIn</a>
          <a class="item" data-value="popInLeft">zoomInLeft</a>
          <a class="item" data-value="popInRight">zoomInRight</a>
          <a class="item" data-value="popInTop">zoomInTop</a>
          <a class="item" data-value="popInBottom">zoomInBottom</a>
        </div>
      </div>
      <div class="columns center aligned">
        <a data-wdropdown="#animationFlip" class="wojo fluid icon button"><i class="icon wysiwyg flip"></i></a>
        <small>flip</small>
        <div class="wojo small dropdown dark top-center" id="animationFlip">
          <a class="item" data-value="flip">flip</a>
          <a class="item" data-value="flipInX">flipInX</a>
          <a class="item" data-value="flipInY">flipInY</a>
        </div>
      </div>
      <div class="columns center aligned">
        <a data-wdropdown="#animationFold" class="wojo fluid icon button"><i class="icon wysiwyg fold"></i></a>
        <small>fold</small>
        <div class="wojo small dropdown dark top-center" id="animationFold">
          <a class="item" data-value="fold">fold</a>
          <a class="item" data-value="unfold">unfold</a>
        </div>
      </div>
      <div class="columns center aligned">
        <a data-wdropdown="#animationRoll" class="wojo fluid icon button"><i class="icon wysiwyg roll"></i></a>
        <small>roll</small>
        <div class="wojo small dropdown dark top-center" id="animationRoll">
          <a class="item" data-value="rollInLeft">rollInLeft</a>
          <a class="item" data-value="rollInRight">rollInRight</a>
          <a class="item" data-value="rollInTop">rollInTop</a>
          <a class="item" data-value="rollInBottom">rollInBottom</a>
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="seven wide field">
        <label>Duration in (ms)</label>
        <input class="rangers" name="aniDuration" type="text" min="0" max="3000" step="100" value="0" hidden data-suffix=" ms">
      </div>
      <div class="field">
        <div class="wojo mini input">
          <input type="text" value="0" name="aniDurationText">
        </div>
      </div>
    </div>
    <div class="wojo fields">
      <div class="seven wide field">
        <label>Delay in (ms)</label>
        <input class="rangers" name="aniDelay" type="text" min="0" max="2000" step="100" value="0" hidden data-suffix=" ms">
      </div>
      <div class="field">
        <div class="wojo mini input">
          <input type="text" value="0" name="aniDelayText">
        </div>
      </div>
    </div>
    <div class="center aligned">
      <button class="wojo primary button" id="aniPlay"><i class="icon play"></i> Play</button>
    </div>
  </div>
</div>