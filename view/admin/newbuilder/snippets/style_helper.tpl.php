<?php
  /**
   * Style Helper
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: style_helper.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div id="style-helper" class="hide-all">
  <div class="header">
    <i class="icon white note"></i>
    <h3 class="handle"> Section Editor</h3>
    <a class="close-styler"><i class="icon white delete"></i></a>
  </div>
  <div class="wojo form scrollbox" id="seditor">
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Data</a>
        </h6>
        <div class="details">
          <div class="wojo small block fields">
            <div class="field">
              <label>Data ID</label>
              <div class="wojo small input">
                <input name="data_id" value="" disabled>
              </div>
            </div>
            <div class="field">
              <label>Data Section</label>
              <div class="wojo small input">
                <input name="data_section" value="">
              </div>
            </div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Classes</a>
        </h6>
        <div class="details">
          <div class="wojo small block fields">
            <div class="field">
              <label>Class Section</label>
              <div class="wojo small action input">
                <input type="text" name="class_section">
                <a class="wojo small primary icon button" id="addSectionClass"><i class="icon plus"></i></a>
              </div>
            </div>
            <div id="sectionClasses" class="field"></div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Padding</a>
        </h6>
        <div class="details">
          <div class="wojo block fields">
            <div class="field">
              <label>Padding Top</label>
              <input class="srangers" name="paddingTop" type="text" min="0" max="260" step="2" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Padding Bottom</label>
              <input class="srangers" name="paddingBottom" type="text" min="0" max="260" step="2" value="0" hidden data-suffix=" px">
            </div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Margin</a>
        </h6>
        <div class="details">
          <div class="wojo block fields">
            <div class="field">
              <label>Margin Top</label>
              <input class="srangers" name="marginTop" type="text" min="0" max="200" step="2" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Margin Bottom</label>
              <input class="srangers" name="marginBottom" type="text" min="0" max="200" step="2" value="0" hidden data-suffix=" px">
            </div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Spacing</a>
        </h6>
        <div class="details">
          <div class="wojo block fields">
            <div class="field">
              <label>Space Size</label>
              <div class="wojo checkbox radio">
                <input name="space_size" type="radio" value="vertical" id="space_vertical" checked="checked">
                <label for="space_vertical">Vertical</label>
              </div>
              <div class="wojo checkbox radio">
                <input name="space_size" type="radio" value="horizontal" id="space_horizontal">
                <label for="space_horizontal">Horizontal</label>
              </div>
              <div class="wojo checkbox radio fitted inline">
                <input name="space_size" type="radio" value="both" id="space_both">
                <label for="space_both">Both</label>
              </div>
            </div>
            <div class="field">
              <label>Space Width</label>
              <input class="srangers" name="spaceWidth" type="text" min="0" max="3" step="1" value="0" hidden data-suffix=" wide">
            </div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Border</a>
        </h6>
        <div class="details">
          <div class="wojo block fields">
            <div class="field">
              <label>Rounded Corners</label>
              <div id="bRadius">
                <div class="bRadiusWrap">
                  <input class="styler small" value="" data-corner="borderTopLeftRadius" placeholder="0px" type="text">
                  <input class="styler small" value="" data-corner="borderBottomLeftRadius" placeholder="0px" type="text">
                </div>
                <div class="bRadiusWrap">
                  <div id="bRadiusView" class="inner">
                    <button id="bRadiusAll" class="wojo small grey icon button" type="button"><i class="icon url alt"></i></button>
                  </div>
                </div>
                <div class="bRadiusWrap">
                  <input class="styler small" value="" data-corner="borderTopRightRadius" placeholder="0px" type="text">
                  <input class="styler small" value="" data-corner="borderBottomRightRadius" placeholder="0px" type="text">
                </div>
              </div>
            </div>
            <div class="field">
              <label>Border Styles</label>
              <div id="borderStyle" class="small full padding center aligned">
                <button name="borderSolid" data-type="solid" class="wojo small white icon button"><i class="icon wysiwyg border solid"></i></button>
                <button name="borderDashed" data-type="dashed" class="wojo small white icon button"><i class="icon wysiwyg border dashed"></i></button>
                <button name="borderDotted" data-type="dotted" class="wojo small white icon button"><i class="icon wysiwyg border dotted"></i></button>
                <button name="borderDouble" data-type="double" class="wojo small white icon button"><i class="icon wysiwyg border double"></i></button>
                <button name="borderNone" data-type="none" class="wojo small white icon button"><i class="icon delete"></i></button>
              </div>
              <div id="bBorder">
                <div id="bBorderView" class="inner"></div>
              </div>
            </div>
            <div class="field">
              <label>Border Width</label>
              <input class="srangers" name="borderWidth" type="text" min="0" max="50" step="1" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Border Color</label>
              <input id="borderColor" value="#276cb8" class="wojo colorpicker">
            </div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Box Shadow</a>
        </h6>
        <div class="details">
          <div class="wojo small fields center aligned">
            <div class="field"><a class="bShadow preset1"><span><i class="icon ban"></i></span></a>
            </div>
            <div class="field"><a class="bShadow preset2"><span></span></a>
            </div>
            <div class="field"><a class="bShadow preset3"><span></span></a>
            </div>
            <div class="field"><a class="bShadow preset4"><span></span></a>
            </div>
          </div>
          <div class="wojo small fields center aligned">
            <div class="field"><a class="bShadow preset5"><span></span></a>
            </div>
            <div class="field"><a class="bShadow preset6"><span></span></a>
            </div>
            <div class="field"><a class="bShadow preset7"><span></span></a>
            </div>
            <div class="field"><a class="bShadow preset8"><span></span></a>
            </div>
          </div>
          <div class="wojo block fields">
            <div class="field">
              <label>Box Shadow Horizontal Position</label>
              <input class="srangers" name="boxShadowHorizontal" type="text" min="-80" max="80" step="1" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Box Shadow Vertical Position</label>
              <input class="srangers" name="boxShadowVertical" type="text" min="-80" max="80" step="1" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Box Shadow Blur Strength</label>
              <input class="srangers" name="boxShadowBlur" type="text" min="0" max="80" step="1" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Box Shadow Spread Strength</label>
              <input class="srangers" name="boxShadowSpread" type="text" min="-80" max="80" step="1" value="0" hidden data-suffix=" px">
            </div>
            <div class="field">
              <label>Box Shadow Position</label>
              <div class="content-center">
                <button name="shadowInset" data-tooltip="Inner Shadow" data-type="inset" class="wojo small white icon button"><i class="icon wysiwyg border inset"></i></button>
                <button name="shadowOutset" data-tooltip="Outer Shadow" data-type="outset" class="wojo small white icon button active"><i class="icon wysiwyg border outset"></i></button>
              </div>
            </div>
            <div class="field">
              <label>Box Shadow Color</label>
              <input id="shadowColor" value="#276cb8" class="wojo colorpicker">
            </div>
          </div>
        </div>
      </section>
    </article>
    <article class="wojo accordion">
      <section>
        <h6 class="summary"><a>Background</a>
        </h6>
        <div class="details">
          <div class="wojo block fields">
            <div class="field">
              <button name="bgColor" data-tab="bgColor" data-tooltip="Color" data-type="color" class="wojo small white icon button"><i class="icon wysiwyg color"></i></button>
              <button name="bgGradient" data-tab="bgGradient" data-tooltip="Gradient" data-type="gradient" class="wojo small white icon button"><i class="icon wysiwyg gradient"></i></button>
              <button name="bgImage" data-tab="bgImage" data-tooltip="Image" data-type="image" class="wojo small white icon button"><i class="icon wysiwyg photo"></i></button>
              <button name="bgNone" data-tooltip="None" data-type="none" class="wojo small white icon button"><i class="icon ban"></i></button>
            </div>
          </div>
          <div id="bgColor" class="wojo tab active">
            <div class="wojo block fields">
              <div class="field">
                <label>Background Color</label>
                <input id="backgroundColor" value="#276cb8" class="wojo colorpicker">
              </div>
            </div>
          </div>
          <div id="bgGradient" class="wojo tab">
            <div class="wojo block fields">
              <div class="field">
                <label>Start Color</label>
                <input id="gradColorStart" value="#276cb8" class="wojo colorpicker">
              </div>
              <div class="field">
                <label>Stop Color</label>
                <input id="gradColorStop" value="#276cb8" class="wojo colorpicker">
              </div>
              <div class="field">
                <label>Start Position</label>
                <input class="srangers" name="gradientStart" type="text" min="0" max="100" step="1" value="0" hidden data-suffix=" %">
              </div>
              <div class="field">
                <label>End Position</label>
                <input class="srangers" name="gradientStop" type="text" min="0" max="100" step="1" value="0" hidden data-suffix=" %">
              </div>
              <div class="field">
                <label>Direction</label>
                <input class="srangers" name="gradientDeg" type="text" min="0" max="360" step="1" value="0" hidden data-suffix=" &deg;">
              </div>
            </div>
          </div>
          <div id="bgImage" class="wojo tab">
            <div class="wojo block fields">
              <div class="field">
                <label>Paralax Effect</label>
                <div class="wojo checkbox toggle fitted inline">
                  <input name="imageParalax" type="checkbox" value="1" id="imageParalax">
                  <label for="imageParalax"><?php echo Lang::$word->YES;?></label>
                </div>
              </div>
            </div>
            <div id="bgImageWrap"><a>NO IMAGE</a>
            </div>
          </div>
        </div>
      </section>
    </article>
    <a class="wojo fluid positive button sectionRestore">Restore</a>
  </div>
</div>
