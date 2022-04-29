<?php
  /**
   * Add Field
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $this->id: addField.tpl.php, v1.00 2018-01-08 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if(!$this->data) : Message::invalid("ID" . $this->id); return; endif;
  $options = Utility::jSonToArray($this->data->options);
?>
<?php
  $html = '<div data-id="' . $this->id . '" class="wojo fields align ' . (($options->type == "address" or $options->type == "long_text") ? "top" : "middle") . '" data-type="' . $options->type . '" data-sort="' . $this->data->id . '">';
  //$html .= '<span class="wojo white top right attached icon button handle"><i class="icon reorder"></i></span>';
  //$html .= '<span class="wojo white top left attached icon button remove"><i class="icon negative delete"></i></span>';
  $align = $this->labeltype ? null : ' class="content-right mobile-content-left"';
  switch ($options->type):
          /* == Short Text == */
      case "short_text":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <input type="text" name="' . $this->id . '" placeholder="' . $options->label . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Long Text == */
      case "long_text":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <textarea type="text" name="' . $this->id . '" placeholder="' . $options->label . '" disabled>' . $options->dvalue . '</textarea>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Dropdown == */
      case "dropdown":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <select name="' . $this->id . '" disabled></select>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Radio == */
      case "radio":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
				<div class="wojo checkbox radio ' . ($options->inline ? "inline" : "block") . '">
				  <input id="choice_r1" name="' . $this->id . '" type="radio" value="choice1" checked="checked" disabled>
				  <label for="choice_r1">choice1</label>
				</div>	
				<div class="wojo checkbox radio ' . ($options->inline ? "inline" : "block") . '">
				  <input id="choice_r2" name="' . $this->id . '" type="radio" value="choice2" disabled>
				  <label for="choice_r2">choice2</label>
				</div>
				<div class="wojo checkbox radio ' . ($options->inline ? "inline" : "block") . '">
				  <input id="choice_r3" name="' . $this->id . '" type="radio" value="choice3" disabled>
				  <label for="choice_r3">choice3</label>
				</div>		  
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Checkbox == */
      case "checkbox":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <div class="wojo inline fields">
				<div class="wojo checkbox inline">
				  <input id="choice_c1" name="' . $this->id . '" type="checkbox" value="Choice1" disabled>
				  <label for="choice_c1">Choice1</label>
				</div>	
				<div class="wojo checkbox inline">
				  <input id="choice_c2" name="' . $this->id . '" type="checkbox" value="Choice2" disabled>
				  <label for="choice_c2">Choice2</label>
				</div>
				<div class="wojo checkbox inline">
				  <input id="choice_c3" name="' . $this->id . '" type="checkbox" value="Choice3" disabled>
				  <label for="choice_c3">Choice3</label>
				</div>		  
			  </div>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == File Upload == */
      case "upload":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <input type="file" data-buttonText="' . Lang::$word->BROWSE . '" name="' . $this->id . '" id="' . $this->id . '" class="filefield" data-input="false" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Heading == */
      case "heading":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field item" data-name="' . $this->id . '">
			  <h2>' . $options->label . '</h2>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == HTML == */
      case "html":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field item" data-name="' . $this->id . '">
			  Your html code goes here...
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Image == */
      case "image":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <div class="content-center"><div class="wojo image"><img id="' . $this->id . '" src="' . AMODULEURL . 'forms/view/images/placeholder.jpg"></div></div>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Fullname == */
      case "name":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <input type="text" name="fname_' . $this->id . '" placeholder="' . Lang::$word->M_FNAME . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <input type="text" name="lname_' . $this->id . '" placeholder="' . Lang::$word->M_LNAME . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Email == */
      case "email":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <input type="text" name="' . $this->id . '" placeholder="' . $options->label . '" value="' . $options->dvalue . '" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Address == */
      case "address":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <div class="padding-bottom">
				<input type="text" name="address1_' . $this->id . '" placeholder="' . Lang::$word->M_ADDRESS . '" value="' . $options->dvalue . '" disabled>
			  </div>
			  <div class="padding-bottom">
				<input type="text" name="address2_' . $this->id . '" placeholder="' . Lang::$word->M_ADDRESS . '" value="' . $options->dvalue . '" disabled>
			  </div>
			  <div class="row gutters">
				<div class="column">
				  <input type="text" name="city_' . $this->id . '" placeholder="' . Lang::$word->M_CITY . '" value="' . $options->dvalue . '" disabled>
				</div>
				<div class="column">
				  <input type="text" name="state_' . $this->id . '" placeholder="' . Lang::$word->M_STATE . '" value="' . $options->dvalue . '" disabled>
				</div>
			  </div>
			  <div class="row horizontal-gutters">
				<div class="column">
				  <input type="text" name="zip_' . $this->id . '" placeholder="' . Lang::$word->M_ZIP . '" value="' . $options->dvalue . '" disabled>
				</div>
				<div class="column">
				  <select name="country_' . $this->id . '" disabled><option>' . Lang::$word->M_COUNTRY . '</option></select>
				</div>
			  </div>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Phone == */
      case "phone":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <div class="wojo inline fields">
				<div class="field">
				  <input type="text" name="phone1_' . $this->id . '" placeholder="###" size="3" max-length="3" disabled>
				</div>
				<div class="field">
				  <input type="text" name="phone2_' . $this->id . '" placeholder="###" size="3" max-length="3" disabled>
				</div>
				<div class="field">
				  <input type="text" name="phone3_' . $this->id . '" placeholder="####" size="4" max-length="4" disabled>
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
			<label' . $align . ' data-id="' . $this->id . '">' . $options->label . '
			</label>
			<p class="wojo small text" data-id="' . $this->id . '"></p>
		  </div>
		  <div class="field item" data-name="' . $this->id . '">
			<div class="wojo icon input">
			  <i class="icon date"></i>
			  <input name="' . $this->id . '" type="text" placeholder="' . App::Core()->short_date . '" value="' . $options->dvalue . '" disabled>
			</div>
		  </div>
		  <div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Time == */
      case "time":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
		  <div class="field four wide labeled">
			<label' . $align . ' data-id="' . $this->id . '">' . $options->label . '
			</label>
			<p class="wojo small text" data-id="' . $this->id . '"></p>
		  </div>
		  <div class="field item" data-name="' . $this->id . '">
			<div class="wojo icon input">
			  <input name="' . $this->id . '" type="text" placeholder="' . App::Core()->time_format . '" value="' . $options->dvalue . '" disabled>
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
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <div class="wojo action input">
				<input name="' . $this->id . '" type="text" placeholder="#ffffff" value="' . $options->dvalue . '" disabled>
				<div class="wojo basic icon button"><i class="icon contrast"></i></div>
			  </div>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
          /* == Range == */
      case "range":
          $html .= '
		  <div class="field auto"><span class="wojo simple icon button remove"><i class="icon negative delete"></i></span></div>
			<div class="field four wide labeled">
			  <label' . $align . ' data-id="' . $this->id . '">' . $options->label . '</label>
			  <p class="wojo small text" data-id="' . $this->id . '"></p>
			</div>
			<div class="field item" data-name="' . $this->id . '">
			  <input data-ranger=\'{"step":1,"from":1, "to":5, "format":"", "tip": false, "range":false}\' type="text" name="' . $this->id . '" value="' . $options->dvalue . '" class="rangers" disabled>
			</div>
			<div class="field auto"><span class="wojo simple icon button handle"><i class="icon black reorder"></i></span></div>';
          break;
  endswitch;
  $html .= '</div>';
  echo $html;
?>