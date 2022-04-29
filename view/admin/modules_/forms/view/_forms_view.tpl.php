<?php
  /**
   * Forms
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: _forms_view.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<h3> <?php echo Lang::$word->_MOD_VF_TITLE2;?><span class="wojo small text"> // <?php echo $this->row->{'title' . Lang::$lang};?></span></h3>
<div class="wojo form segment">

<?php if($this->data):?>
<?php $html = '';?>
<?php foreach($this->data as $row):?>
<?php
  $options = Utility::jSonToArray($row->options);
  $html .= '<div class="wojo fields">';
  $required = ($options->required) ? ' <i class="icon asterisk"></i>' : '';
    switch ($options->type):
          /* == Short Text == */
      case "short_text":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <input type="text" name="' . $row->name . '" placeholder="' . $options->label . '" value="' . $options->dvalue . '">
			</div>';
          break;
          /* == Long Text == */
      case "long_text":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <textarea type="text" name="' . $row->name . '" placeholder="' . $options->label . '">' . $options->dvalue . '</textarea>
			</div>';
          break;
          /* == Dropdown == */
      case "dropdown":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <select name="' . $row->name . '"' . (($options->multiple) ? ' multile="multiple"' : '') . '>
			  ' . (($options->multiple) ? Utility::loopOptionsSimpleMultiple($options->items, $options->selected) : Utility::loopOptionsSimple($options->items, $options->selected)) . '
			  </select>
			</div>';
          break;
          /* == Radio == */
      case "radio":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">';
				if(is_array($options->items)):
				foreach($options->items as $k => $item):
				$k++;
          $html .= '
				<div class="wojo checkbox radio fitted ' . ($options->inline ? "inline" : "block") . '">
				  <input id="' . $row->name . '_' . $item . $k . '" name="' . $row->name . '" type="radio" value="' . $item . '" ' . (($options->dvalue == $item) ? ' checked="checked"' : null) . '>
				  <label for="' . $row->name . '_' . $item . $k . '">' . $item . '</label>
				</div>';
				endforeach;
				endif;
				
          $html .= '
			</div>';
          break;
          /* == Checkbox == */
      case "checkbox":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">';
				if(is_array($options->items)):
				foreach($options->items as $k => $item):
				$k++;
          $html .= '
				<div class="wojo checkbox radio fitted ' . ($options->inline ? "inline" : "block") . '">
				  <input id="' . $row->name . '_' . $item . $k . '" name="' . $row->name . '" type="checkbox" value="' . $item . '" ' . (($options->dvalue == $item) ? ' checked="checked"' : null) . '>
				  <label for="' . $row->name . '_' . $item . $k . '">' . $item . '</label>
				</div>';
				endforeach;
				endif;
				
          $html .= '
			</div>';
          break;
          /* == File Upload == */
      case "upload":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <input type="file" data-buttonText="' . Lang::$word->BROWSE . '" name="' . $row->name . '" id="' . $row->name . '" class="filestyle" data-input="false">
			</div>';
          break;
          /* == Heading == */
      case "heading":
          $html .= '
			<div class="field">
			  <h2>' . $options->label . '</h2>
			</div>';
          break;
          /* == HTML == */
      case "html":
          $html .= '
			<div class="field">
			  ' . $options->dvalue . '
			</div>';
          break;
          /* == Image == */
      case "image":
	      $image = ($options->validation) ? UPLOADURL . '/' . $options->validation : AMODULEURL . 'forms/view/images/placeholder.jpg';
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <div class="center aligned"><div class="wojo image"><img id="' . $row->name . '" src="' . $image . '"></div></div>
			</div>';
          break;
          /* == Fullname == */
      case "name":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <input type="text" name="fname_' . $row->name . '" placeholder="' . Lang::$word->M_FNAME . '" value="' . $options->dvalue . '">
			</div>
			<div class="field">
			  <input type="text" name="lname_' . $row->name . '" placeholder="' . Lang::$word->M_LNAME . '" value="' . $options->dvalue . '">
			</div>';
          break;
          /* == Email == */
      case "email":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <input type="text" name="' . $row->name . '" placeholder="' . $options->label . '" value="' . $options->dvalue . '">
			</div>';
          break;
          /* == Phone == */
      case "phone":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <div class="wojo inline fields">
				<div class="field">
				  <input type="text" name="phone1_' . $row->name . '" placeholder="###" size="3" max-length="3">
				</div>
				<div class="field">
				  <input type="text" name="phone2_' . $row->name . '" placeholder="###" size="3" max-length="3">
				</div>
				<div class="field">
				  <input type="text" name="phone3_' . $row->name . '" placeholder="####" size="4" max-length="4">
				</div>
			  </div>	
			</div>';
          break;
      case "address":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <div class="padding-bottom">
				<input type="text" name="address1_' . $row->name . '" placeholder="' . Lang::$word->M_ADDRESS . '" value="' . $options->dvalue . '">
			  </div>
			  <div class="padding-bottom">
				<input type="text" name="address2_' . $row->name . '" placeholder="' . Lang::$word->M_ADDRESS . '" value="' . $options->dvalue . '">
			  </div>
			  <div class="row gutters">
				<div class="column">
				  <input type="text" name="city_' . $row->name . '" placeholder="' . Lang::$word->M_CITY . '" value="' . $options->dvalue . '">
				</div>
				<div class="column">
				  <input type="text" name="state_' . $row->name . '" placeholder="' . Lang::$word->M_STATE . '" value="' . $options->dvalue . '">
				</div>
			  </div>
			  <div class="row horizontal-gutters">
				<div class="column">
				  <input type="text" name="zip_' . $row->name . '" placeholder="' . Lang::$word->M_ZIP . '" value="' . $options->dvalue . '">
				</div>
				<div class="column">
				  <select name="country_' . $row->name . '" class="wojo fluid dropdown"><option>' . Lang::$word->M_COUNTRY . '</option></select>
				</div>
			  </div>
			</div>';
          break;
          /* == Date == */
      case "date":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <div class="wojo icon input">
				<input name="' . $row->name . '" type="text" class="datepick" placeholder="' . App::Core()->short_date . '" value="' . $options->dvalue . '" readonly>
				<i class="icon date"></i> </div>
			</div>';
          break;
          /* == Time == */
      case "time":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <div class="wojo icon input">
				<input name="' . $row->name . '" class="timepick" type="text" placeholder="' . App::Core()->time_format . '" value="' . $options->dvalue . '" readonly>
				<i class="icon clock"></i> </div>
			</div>';
          break;
          /* == Color == */
      case "color":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
				<input data-wcolor="simple" name="' . $row->name . '" data-color=\'{"showPaletteOnly":true,"color": "' . $options->dvalue . '"}\' type="text" placeholder="#ffffff" value="' . $options->dvalue . '">
			</div>';
          break;
          /* == Range == */
      case "range":
          $html .= '
			<div class="field four wide labeled">
			  <label>' . $options->label . $required . '</label>
			  <p class="wojo small text">' . $options->tooltip . '</p>
			</div>
			<div class="field">
			  <input name="' . $row->name . '" type="range" min="' . $options->min_len . '" max="' . $options->max_len . '" step="1" value="' . $options->dvalue . '" hidden data-suffix="">
			</div>';
          break;
  endswitch;
  $html .= '</div>';
?>
<?php endforeach;?>
<?php echo $html;?>
<?php endif;?>
</div>