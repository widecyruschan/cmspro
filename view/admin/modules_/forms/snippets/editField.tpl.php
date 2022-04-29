<?php
  /**
   * Edit Field
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $this->id: editField.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->data) : Message::invalid("ID" . $this->id); return; endif;
  $options = Utility::jSonToArray($this->data->options);
?>
<?php
  $html = '<div data-prop="' . $this->data->name . '" class="small full padding">';
  if(!in_array($options->type, ["image", "html"])) :
	$html .= '
	<div class="wojo block small fields">
	  <div class="field">
		<label>' . Lang::$word->_MOD_VF_SUB7 . '</label>
	  </div>
	  <div class="field">
		<textarea type="text" name="label" class="tiny">' . $options->label . '</textarea>
	  </div>
	</div>';
  endif;
  switch ($options->type):
          /* == Short Text == */
      case "short_text":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB8 . '</label>
			  </div>
			  <div class="field">
				<textarea type="text" name="dvalue" class="tiny">' . $options->dvalue . '</textarea>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB9 . '</label>
			  </div>
			  <div class="field">
				<select name="validation">
				' . Utility::loopOptionsSimpleAlt(Forms::fieldValidation(), $options->validation) . '
				</select>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="type" value="short_text">';
          break;
          /* == Long Text == */
      case "long_text":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB8 . '</label>
			  </div>
			  <div class="field">
				<textarea type="text" name="dvalue" class="tiny">' . $options->dvalue . '</textarea>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB10 . '</label>
			  </div>
			  <div class="field">
				<div class="wojo small input">
				  <input name="min_len" type="text" placeholder="' . Lang::$word->_MOD_VF_SUB10_1 . '" value="' . $options->min_len . '">
				  <input name="max_len" type="text" placeholder="' . Lang::$word->_MOD_VF_SUB10_2 . '" value="' . $options->max_len . '">
				</div>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="type" value="long_text">
			<input type="hidden" name="validation" value="string">';
          break;
          /* == Dropdown == */
      case "dropdown":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB8 . '</label>
			  </div>
			  <div class="field">
				<select name="dvalue">
				' . Utility::loopOptionsSimple($options->items, $options->selected) . '
				</select>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB11 . '<p class="wojo small basic text">' . Lang::$word->_MOD_VF_SUB11_1 . '</p> <a id="importSelect">' . Lang::$word->IMPORT . '</a></label>
			  </div>
			  <div class="field">
				<textarea type="text" name="items" class="grow">' . Utility::loopSingleLine($options->items) . '</textarea>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			  <div class="field">
				<label>' . Lang::$word->MULTIPLE . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="multi_1" name="multiple" type="checkbox"' . (($options->multiple) ? ' checked="checked"' : null) . ' value="1">
				<label for="multi_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="type" value="dropdown">
			<input type="hidden" name="validation" value="string">';
          break;
          /* == Radio == */
      case "radio":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB8 . '</label>
			  </div>
			  <div class="field">
				<select name="dvalue">
				' . Utility::loopOptionsSimple($options->items, $options->dvalue) . '
				</select>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label><a class="push-right" id="importSelect">' . Lang::$word->IMPORT . '</a>' . Lang::$word->_MOD_VF_SUB11 . '<p class="wojo thin text">' . Lang::$word->_MOD_VF_SUB11_1 . '</p></label>
			  </div>
			  <div class="field">
				<textarea type="text" name="items" class="grow">' . Utility::loopSingleLine($options->items) . '</textarea>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB16 . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="inline_1" name="inline" type="checkbox"' . (($options->inline) ? ' checked="checked"' : null) . ' value="1">
				<label for="inline_1" >' . Lang::$word->_MOD_VF_SUB17 . '</label>
			  </div>
			</div>
			<input type="hidden" name="type" value="radio">
			<input type="hidden" name="validation" value="string">';
          break;
          /* == Checkbox == */
      case "checkbox":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB8 . '</label>
			  </div>
			  <div class="field">
				<select name="dvalue">
				' . Utility::loopOptionsSimple($options->items, $options->dvalue) . '
				</select>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label><a class="push-right" id="importSelect">' . Lang::$word->IMPORT . '</a>' . Lang::$word->_MOD_VF_SUB11 . '<p class="wojo thin text">' . Lang::$word->_MOD_VF_SUB11_1 . '</p></label>
			  </div>
			  <div class="field">
				<textarea type="text" name="items" class="grow">' . Utility::loopSingleLine($options->items) . '</textarea>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo checkbox field">
				<input name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label>' . Lang::$word->YES . '</label>
			  </div>
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB16 . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="inline_1" name="inline" type="checkbox"' . (($options->inline) ? ' checked="checked"' : null) . ' value="1">
				<label for="inline_1" >' . Lang::$word->_MOD_VF_SUB17 . '</label>
			  </div>
			</div>
			<input type="hidden" name="type" value="checkbox">
			<input type="hidden" name="validation" value="string">';
          break;
          /* == File Upload == */
      case "upload":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB9 . '</label>
			  </div>
			  <div class="field">
			    <input name="validation" type="text" placeholder="' . Lang::$word->_MOD_VF_SUB9 . '" value="' . $options->validation . '">
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB18 . '</label>
			  </div>
			  <div class="field">
			    <div class="wojo right fluid labeled input">
				  <input name="filesize" type="text" placeholder="' . Lang::$word->_MOD_VF_SUB18 . '" value="' . $options->filesize . '">
				  <div class="wojo basic label">mb</div>
				</div>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="type" value="upload">
			<input type="hidden" name="dvalue" value="">';
          break;
          /* == Heading == */
      case "heading":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB19 . '</label>
			  </div>
			  <div class="field">
				<select name="dvalue">
				' . Utility::loopOptionsSimpleAlt(Forms::sizeValidation(), $options->dvalue) . '
				</select>
			  </div>
			</div>
			<input type="hidden" name="required" value="0">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="type" value="heading">';
          break;
          /* == HTML == */
      case "html":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field content-center">
				<a class="wojo small basic negative button" id="editHtml">' . Lang::$word->_MOD_VF_SUB31 . '</a>
			  </div>
			</div>
			<input type="hidden" name="required" value="0">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="tooltip" value="">
			<input type="hidden" name="label" value="Untilted">
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="type" value="html">';
          break;
          /* == Image == */
      case "image":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB21 . '</label>
			  </div>
			  <div class="field">
				<div class="wojo fluid right action input">
				  <input id="validation" placeholder="' . Lang::$word->_MOD_VF_SUB21 . '" value="' . $options->validation . '" name="validation" type="text" readonly>
				  <div id="imgpicker" class="wojo icon basic button"><i class="open folder icon"></i></div>
				</div>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB20 . '</label>
			  </div>
			  <div class="field">
				<select name="dvalue">
				' . Utility::loopOptionsSimpleAlt(Forms::sizeValidation(), $options->dvalue) . '
				</select>
			  </div>
			</div>
			<input type="hidden" name="required" value="0">
			<input type="hidden" name="label" value="none">
			<input type="hidden" name="tooltip" value="">
			<input type="hidden" name="type" value="image">';
          break;
          /* == Fullname == */
      case "name":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB9 . '</label>
			  </div>
			  <div class="field">
				<select name="validation">
				' . Utility::loopOptionsSimpleAlt(Forms::fieldValidation(), $options->validation) . '
				</select>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="special" value="1">
			<input type="hidden" name="type" value="name">';
          break;
          /* == Email == */
      case "email":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB8 . '</label>
			  </div>
			  <div class="field">
				<textarea type="text" name="dvalue" class="tiny">' . $options->dvalue . '</textarea>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="validation" value="email">
			<input type="hidden" name="type" value="email">';
          break;
          /* == Address == */
      case "address":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="special" value="1">
			<input type="hidden" name="type" value="address">';
          break;
          /* == Phone == */
      case "phone":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="special" value="1">
			<input type="hidden" name="type" value="phone">';
          break;
          /* == Date == */
      case "date":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="type" value="date">';
          break;
          /* == Time == */
      case "time":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo checkbox field">
				<input name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label>' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="type" value="time">';
          break;
          /* == Color == */
      case "color":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="type" value="color">';
          break;
          /* == Range == */
      case "range":
          $html .= '
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->_MOD_VF_SUB10 . '</label>
			  </div>
			  <div class="field">
				<div class="wojo small input">
				  <input name="min_len" type="text" placeholder="' . Lang::$word->_MOD_VF_SUB10_1 . '" value="' . $options->min_len . '">
				  <input name="max_len" type="text" placeholder="' . Lang::$word->_MOD_VF_SUB10_2 . '" value="' . $options->max_len . '">
				</div>
			  </div>
			</div>
			<div class="wojo block small fields">
			  <div class="field">
				<label>' . Lang::$word->REQUIRED . '</label>
			  </div>
			  <div class="wojo toggle checkbox">
				<input id="req_1" name="required" type="checkbox"' . (($options->required) ? ' checked="checked"' : null) . ' value="1">
				<label for="req_1">' . Lang::$word->YES . '</label>
			  </div>
			</div>
			<input type="hidden" name="dvalue" value="">
			<input type="hidden" name="validation" value="">
			<input type="hidden" name="special" value="1">
			<input type="hidden" name="type" value="range">';
          break;
  endswitch;
  if(!in_array($options->type, ["image", "html"])) :
	$html .= '
	<div class="wojo block small fields">
	  <div class="field">
		<label>Instructions</label>
	  </div>
	  <div class="field">
		<textarea type="text" name="tooltip" class="tiny">' . $options->tooltip . '</textarea>
	  </div>
	</div>';
  endif;
  $html .= '<input type="hidden" name="id" value="' . $this->data->name . '">';
  $html .= '</div>';
  echo $html;
?>