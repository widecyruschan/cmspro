<?php
  /**
   * Visual Forms
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2020
   * @version $Id: index.tpl.php, v1.00 2020-06-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(AMODPATH . 'forms/'));
?>
<!-- Start Form -->
<?php if(isset($data['module_id'])):?>
<?php if($data = App::Forms()->Render($data['id'])):?>
<h2 class="underlined">
  <?php echo $data['row']->{'title' . Lang::$lang};?>
</h2>
<div class="wojo form segment">
  <form id="wojo_form" name="wojo_form" method="post">
    <?php $html = '';?>
    <?php foreach($data['fields'] as $row):?>
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
			  <select name="' . $row->name . '" ' . (($options->multiple) ? ' multile="multiple"' : '') . '>
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
			  <div class="wojo checkbox radio ' . ($options->inline ? "fitted inline" : "block") . '">
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
			<div class="field item" data-name="' . $row->name . '">';
				if(is_array($options->items)):
				foreach($options->items as $k => $item):
				$k++;
          $html .= '
				<div class="wojo checkbox fitted ' . ($options->inline ? "inline" : "block") . '">
				  <input id="' . $row->name . '_' . $item . $k . '" name="' . $row->name . '[]" type="checkbox" value="' . $item . '" ' . (($options->dvalue == $item) ? ' checked="checked"' : null) . '>
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
			  <input type="file" data-buttonText="' . Lang::$word->BROWSE . '" name="' . $row->name . '" id="' . $row->name . '" class="filefield">
			</div>';
          break;
          /* == Heading == */
      case "heading":
          $html .= '
			<div class="field">
			  <div class="wojo large text">' . $options->label . '</div>
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
			  <div class="content-center"><div class="wojo image"><img id="' . $row->name . '" src="' . $image . '"></div></div>
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
				  <input type="text" name="phone1_' . $row->name . '" placeholder="###" size="3" maxlength="3">
				</div>
				<div class="field">
				  <input type="text" name="phone2_' . $row->name . '" placeholder="###" size="3" maxlength="3">
				</div>
				<div class="field">
				  <input type="text" name="phone3_' . $row->name . '" placeholder="####" size="4" maxlength="4">
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
				  <select name="country_' . $row->name . '" class="wojo fluid dropdown"><option>' . Lang::$word->M_COUNTRY . '</option>
					<option value="Afghanistan">Afghanistan</option>
					<option value="Albania">Albania</option>
					<option value="Algeria">Algeria</option>
					<option value="Andorra">Andorra</option>
					<option value="Angola">Angola</option>
					<option value="Antigua and Barbuda">Antigua and Barbuda</option>
					<option value="Argentina">Argentina</option>
					<option value="Armenia">Armenia</option>
					<option value="Australia">Australia</option>
					<option value="Austria">Austria</option>
					<option value="Azerbaijan">Azerbaijan</option>
					<option value="Bahamas">Bahamas</option>
					<option value="Bahrain">Bahrain</option>
					<option value="Bangladesh">Bangladesh</option>
					<option value="Barbados">Barbados</option>
					<option value="Belarus">Belarus</option>
					<option value="Belgium">Belgium</option>
					<option value="Belize">Belize</option>
					<option value="Benin">Benin</option>
					<option value="Bhutan">Bhutan</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
					<option value="Botswana">Botswana</option>
					<option value="Brazil">Brazil</option>
					<option value="Brunei">Brunei</option>
					<option value="Bulgaria">Bulgaria</option>
					<option value="Burkina Faso">Burkina Faso</option>
					<option value="Burundi">Burundi</option>
					<option value="Côte d\'Ivoire">Côte d\'Ivoire</option>
					<option value="Cabo Verde">Cabo Verde</option>
					<option value="Cambodia">Cambodia</option>
					<option value="Cameroon">Cameroon</option>
					<option value="Canada">Canada</option>
					<option value="Central African Republic">Central African Republic</option>
					<option value="Chad">Chad</option>
					<option value="Chile">Chile</option>
					<option value="China">China</option>
					<option value="Colombia">Colombia</option>
					<option value="Comoros">Comoros</option>
					<option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Croatia">Croatia</option>
					<option value="Cuba">Cuba</option>
					<option value="Cyprus">Cyprus</option>
					<option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>
					<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>
					<option value="Denmark">Denmark</option>
					<option value="Djibouti">Djibouti</option>
					<option value="Dominica">Dominica</option>
					<option value="Dominican Republic">Dominican Republic</option>
					<option value="Ecuador">Ecuador</option>
					<option value="Egypt">Egypt</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Equatorial Guinea">Equatorial Guinea</option>
					<option value="Eritrea">Eritrea</option>
					<option value="Estonia">Estonia</option>
					<option value="Eswatini (fmr. "Swaziland")">Eswatini (fmr. "Swaziland")</option>
					<option value="Ethiopia">Ethiopia</option>
					<option value="Fiji">Fiji</option>
					<option value="Finland">Finland</option>
					<option value="France">France</option>
					<option value="Gabon">Gabon</option>
					<option value="Gambia">Gambia</option>
					<option value="Georgia">Georgia</option>
					<option value="Germany">Germany</option>
					<option value="Ghana">Ghana</option>
					<option value="Greece">Greece</option>
					<option value="Grenada">Grenada</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Guinea">Guinea</option>
					<option value="Guinea-Bissau">Guinea-Bissau</option>
					<option value="Guyana">Guyana</option>
					<option value="Haiti">Haiti</option>
					<option value="Holy See">Holy See</option>
					<option value="Honduras">Honduras</option>
					<option value="Hungary">Hungary</option>
					<option value="Iceland">Iceland</option>
					<option value="India">India</option>
					<option value="Indonesia">Indonesia</option>
					<option value="Iran">Iran</option>
					<option value="Iraq">Iraq</option>
					<option value="Ireland">Ireland</option>
					<option value="Israel">Israel</option>
					<option value="Italy">Italy</option>
					<option value="Jamaica">Jamaica</option>
					<option value="Japan">Japan</option>
					<option value="Jordan">Jordan</option>
					<option value="Kazakhstan">Kazakhstan</option>
					<option value="Kenya">Kenya</option>
					<option value="Kiribati">Kiribati</option>
					<option value="Kuwait">Kuwait</option>
					<option value="Kyrgyzstan">Kyrgyzstan</option>
					<option value="Laos">Laos</option>
					<option value="Latvia">Latvia</option>
					<option value="Lebanon">Lebanon</option>
					<option value="Lesotho">Lesotho</option>
					<option value="Liberia">Liberia</option>
					<option value="Libya">Libya</option>
					<option value="Liechtenstein">Liechtenstein</option>
					<option value="Lithuania">Lithuania</option>
					<option value="Luxembourg">Luxembourg</option>
					<option value="Madagascar">Madagascar</option>
					<option value="Malawi">Malawi</option>
					<option value="Malaysia">Malaysia</option>
					<option value="Maldives">Maldives</option>
					<option value="Mali">Mali</option>
					<option value="Malta">Malta</option>
					<option value="Marshall Islands">Marshall Islands</option>
					<option value="Mauritania">Mauritania</option>
					<option value="Mauritius">Mauritius</option>
					<option value="Mexico">Mexico</option>
					<option value="Micronesia">Micronesia</option>
					<option value="Moldova">Moldova</option>
					<option value="Monaco">Monaco</option>
					<option value="Mongolia">Mongolia</option>
					<option value="Montenegro">Montenegro</option>
					<option value="Morocco">Morocco</option>
					<option value="Mozambique">Mozambique</option>
					<option value="Myanmar (formerly Burma)">Myanmar (formerly Burma)</option>
					<option value="Namibia">Namibia</option>
					<option value="Nauru">Nauru</option>
					<option value="Nepal">Nepal</option>
					<option value="Netherlands">Netherlands</option>
					<option value="New Zealand">New Zealand</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Niger">Niger</option>
					<option value="Nigeria">Nigeria</option>
					<option value="North Korea">North Korea</option>
					<option value="North Macedonia">North Macedonia</option>
					<option value="Norway">Norway</option>
					<option value="Oman">Oman</option>
					<option value="Pakistan">Pakistan</option>
					<option value="Palau">Palau</option>
					<option value="Palestine State">Palestine State</option>
					<option value="Panama">Panama</option>
					<option value="Papua New Guinea">Papua New Guinea</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Peru">Peru</option>
					<option value="Philippines">Philippines</option>
					<option value="Poland">Poland</option>
					<option value="Portugal">Portugal</option>
					<option value="Qatar">Qatar</option>
					<option value="Romania">Romania</option>
					<option value="Russia">Russia</option>
					<option value="Rwanda">Rwanda</option>
					<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
					<option value="Saint Lucia">Saint Lucia</option>
					<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
					<option value="Samoa">Samoa</option>
					<option value="San Marino">San Marino</option>
					<option value="Sao Tome and Principe">Sao Tome and Principe</option>
					<option value="Saudi Arabia">Saudi Arabia</option>
					<option value="Senegal">Senegal</option>
					<option value="Serbia">Serbia</option>
					<option value="Seychelles">Seychelles</option>
					<option value="Sierra Leone">Sierra Leone</option>
					<option value="Singapore">Singapore</option>
					<option value="Slovakia">Slovakia</option>
					<option value="Slovenia">Slovenia</option>
					<option value="Solomon Islands">Solomon Islands</option>
					<option value="Somalia">Somalia</option>
					<option value="South Africa">South Africa</option>
					<option value="South Korea">South Korea</option>
					<option value="South Sudan">South Sudan</option>
					<option value="Spain">Spain</option>
					<option value="Sri Lanka">Sri Lanka</option>
					<option value="Sudan">Sudan</option>
					<option value="Suriname">Suriname</option>
					<option value="Sweden">Sweden</option>
					<option value="Switzerland">Switzerland</option>
					<option value="Syria">Syria</option>
					<option value="Tajikistan">Tajikistan</option>
					<option value="Tanzania">Tanzania</option>
					<option value="Thailand">Thailand</option>
					<option value="Timor-Leste">Timor-Leste</option>
					<option value="Togo">Togo</option>
					<option value="Tonga">Tonga</option>
					<option value="Trinidad and Tobago">Trinidad and Tobago</option>
					<option value="Tunisia">Tunisia</option>
					<option value="Turkey">Turkey</option>
					<option value="Turkmenistan">Turkmenistan</option>
					<option value="Tuvalu">Tuvalu</option>
					<option value="Uganda">Uganda</option>
					<option value="Ukraine">Ukraine</option>
					<option value="United Arab Emirates">United Arab Emirates</option>
					<option value="United Kingdom">United Kingdom</option>
					<option value="United States of America">United States of America</option>
					<option value="Uruguay">Uruguay</option>
					<option value="Uzbekistan">Uzbekistan</option>
					<option value="Vanuatu">Vanuatu</option>
					<option value="Venezuela">Venezuela</option>
					<option value="Vietnam">Vietnam</option>
					<option value="Yemen">Yemen</option>
					<option value="Zambia">Zambia</option>
					<option value="Zimbabwe">Zimbabwe</option>
				  </select>
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
			  <div class="wojo fluid left icon input">
				<input data-datepicker="true" name="' . $row->name . '" type="text" placeholder="' . App::Core()->short_date . '" value="' . $options->dvalue . '" readonly>
				<i class="icon date"></i>
			  </div>
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
			  <div data-timepicker="true" class="wojo fluid calendar left icon input">
				<input name="' . $row->name . '" type="text" placeholder="' . App::Core()->time_format . '" value="' . $options->dvalue . '" readonly>
				<i class="icon clock"></i>
			  </div>
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
			  <div data-adv-color="true" class="wojo action input">
				<input name="' . $row->name . '" type="text" placeholder="#ffffff" value="' . $options->dvalue . '" readonly>
				<div class="wojo basic icon button"><i class="icon checkbox"></i></div>
			  </div>
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
			  <input data-ranger=\'{"step":1,"from":' . $options->min_len . ', "to":' . $options->max_len . ', "format":"", "tip": false, "range":false}\' type="hidden" name="' . $row->name . '" value="' . $options->dvalue . '" class="rangers">
			</div>';
          break;
  endswitch;
  $html .= '</div>';
?>
    <?php endforeach;?>
    <?php echo $html;?>
    <?php if($data['row']->captcha):?>
    <div class="wojo fields">
      <div class="field four wide labeled">
        <label><?php echo Lang::$word->CAPTCHA;?>
          <i class="icon asterisk"></i></label>
      </div>
      <div class="field">
        <div class="wojo right labeled fluid input">
          <input placeholder="<?php echo Lang::$word->CAPTCHA;?>" name="captcha" type="text">
          <span class="wojo simple passive button captcha"><?php echo Session::captcha();?></span>
        </div>
      </div>
    </div>
    <?php endif;?>
    <div class="center aligned">
      <button type="button" data-hide="true" data-url="modules_/forms" data-action="send" name="dosubmit"  class="wojo primary button"><?php echo $data['row']->{'sbutton' . Lang::$lang};?></button>
    </div>
    <input type="hidden" name="id" value="<?php echo $data['row']->id;?>">
  </form>
</div>
<?php endif;?>
<?php endif;?>
