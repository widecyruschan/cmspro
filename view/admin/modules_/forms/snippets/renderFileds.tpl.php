<?php
  /**
   * Render Fields
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $id: renderFileds.tpl.php, v1.00 2020-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<?php if($this->data):?>
<?php $html = '';?>
<?php foreach($this->data as $row):?>
<?php
  $options = Utility::jSonToArray($row->options);
  $html .= '<div data-id="' . $row->name . '" class="wojo fields" data-type="' . $options->type . '" data-sort="' . $row->id . '">';
  $required = ($options->required) ? ' <i class="icon asterisk"></i>' : '';
    switch ($options->type):
          /* == Short Text == */
      case "short_text":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <input type="text" name="' . $row->name . '" placeholder="' . $options->label . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Long Text == */
      case "long_text":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <textarea type="text" name="' . $row->name . '" placeholder="' . $options->label . '" disabled>' . $options->dvalue . '</textarea>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Dropdown == */
      case "dropdown":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <select name="' . $row->name . '" disabled></select>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Radio == */
      case "radio":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">';
				if(is_array($options->items)):
				foreach($options->items as $k => $item):
				$k++;
          $html .= '
				<div class="wojo checkbox radio ' . ($options->inline ? "fitted inline" : "block") . '">
				  <input id="' . $row->name . '_' . $item . $k . '" name="' . $row->name . '" type="radio" value="' . $item . '" ' . (($options->dvalue == $item) ? ' checked="checked"' : null) . ' disabled>
				  <label for="' . $row->name . '_' . $item . $k . '">' . $item . '</label>
				</div>';
				endforeach;
				endif;
				
          $html .= '
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Checkbox == */
      case "checkbox":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">';
				if(is_array($options->items)):
				foreach($options->items as $k => $item):
				$k++;
          $html .= '
				<div class="wojo checkbox fitted ' . ($options->inline ? "inline" : "block") . '">
				  <input id="' . $row->name . '_' . $item . $k . '" name="' . $row->name . '" type="checkbox" value="' . $item . '" ' . (($options->dvalue == $item) ? ' checked="checked"' : null) . ' disabled>
				  <label for="' . $row->name . '_' . $item . $k . '">' . $item . '</label>
				</div>';
				endforeach;
				endif;
				
          $html .= '
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == File Upload == */
      case "upload":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <input type="file" data-buttonText="' . Lang::$word->BROWSE . '" name="' . $row->name . '" id="' . $row->name . '" class="filefield" disabled data-input="false">
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Heading == */
      case "heading":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field item" data-name="' . $row->name . '">
			  <h2>' . $options->label . '</h2>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == HTML == */
      case "html":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field item" data-name="' . $row->name . '">
			  ' . $options->dvalue . '
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Image == */
      case "image":
	      $image = ($options->validation) ? UPLOADURL . '/' . $options->validation : AMODULEURL . 'forms/view/images/placeholder.jpg';
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <div class="center aligned"><div class="wojo ' . $options->dvalue . ' image"><img id="' . $row->name . '" src="' . $image . '"></div></div>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Fullname == */
      case "name":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <input type="text" name="fname_' . $row->name . '" placeholder="' . Lang::$word->M_FNAME . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <input type="text" name="lname_' . $row->name . '" placeholder="' . Lang::$word->M_LNAME . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Email == */
      case "email":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <input type="text" name="' . $row->name . '" placeholder="' . $options->label . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Phone == */
      case "phone":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <div class="wojo inline fields">
				<div class="field">
				  <input type="text" name="phone1_' . $row->name . '" placeholder="###" size="3" max-length="3" disabled>
				</div>
				<div class="field">
				  <input type="text" name="phone2_' . $row->name . '" placeholder="###" size="3" max-length="3" disabled>
				</div>
				<div class="field">
				  <input type="text" name="phone3_' . $row->name . '" placeholder="####" size="4" max-length="4" disabled>
				</div>
			  </div>	
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
      case "address":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			  <div class="padding-bottom">
				<input type="text" name="address1_' . $row->name . '" placeholder="' . Lang::$word->M_ADDRESS . '" value="' . $options->dvalue . '" disabled>
			  </div>
			  <div class="padding-bottom">
				<input type="text" name="address2_' . $row->name . '" placeholder="' . Lang::$word->M_ADDRESS . '" value="' . $options->dvalue . '" disabled>
			  </div>
			  <div class="row gutters">
				<div class="column">
				  <input type="text" name="city_' . $row->name . '" placeholder="' . Lang::$word->M_CITY . '" value="' . $options->dvalue . '" disabled>
				</div>
				<div class="column">
				  <input type="text" name="state_' . $row->name . '" placeholder="' . Lang::$word->M_STATE . '" value="' . $options->dvalue . '" disabled>
				</div>
			  </div>
			  <div class="row horizontal-gutters">
				<div class="column">
				  <input type="text" name="zip_' . $row->name . '" placeholder="' . Lang::$word->M_ZIP . '" value="' . $options->dvalue . '" disabled>
				</div>
				<div class="column">
				  <select name="country_' . $row->name . '" class="wojo fluid dropdown" disabled><option>' . Lang::$word->M_COUNTRY . '</option></select>
				</div>
			  </div>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Date == */
      case "date":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
		  <div class="field four wide labeled">
			<label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			<p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
		  </div>
		  <div class="field item" data-name="' . $row->name . '">
			<div class="wojo icon input">
			  <input name="' . $row->name . '" type="text" placeholder="' . App::Core()->short_date . '" value="' . $options->dvalue . '" disabled>
			  <i class="icon date"></i>
			</div>
		  </div>
		  <div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Time == */
      case "time":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
		  <div class="field four wide labeled">
			<label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			<p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
		  </div>
		  <div class="field item" data-name="' . $row->name . '">
			<div class="wojo icon input">
			  <input name="' . $row->name . '" type="text" placeholder="' . App::Core()->time_format . '" value="' . $options->dvalue . '" disabled>
			  <i class="icon clock"></i>
			</div>
		  </div>
		  <div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Color == */
      case "color":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
		  <div class="field four wide labeled">
			<label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			<p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
		  </div>
		  <div class="field item" data-name="' . $row->name . '">
			  <input data-wcolor="simple" name="' . $row->name . '" type="text" placeholder="#ffffff" data-color=\'{"showPaletteOnly":true,"color": "#ffffff"}\' value="' . $options->dvalue . '" disabled>
		  </div>
		  <div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Range == */
      case "range":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label data-id="' . $row->name . '">' . $options->label . $required . '</label>
			  <p class="wojo small text" data-id="' . $row->name . '">' . $options->tooltip . '</p>
			</div>
			<div class="field item" data-name="' . $row->name . '">
			<input name="' . $row->name . '" type="range" min="1" max="5" step="1" value="' . $options->dvalue . '" hidden data-suffix="">
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
  endswitch;
  $html .= '</div>';
?>
<?php endforeach;?>
<?php echo $html;?>
<?php endif;?>