<?php
  /**
   * Custom Fields
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2021
   * @version $Id: customFields.tpl.php, v1.00 2021-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>               
<?php
  $html = '';
  switch ($data['section']):
      case "profile":
	      if($data['type'] == "user"):
			  foreach ($data['data'] as $i => $row) {
				  if($row->field_value):
					  $is_url = (filter_var($row->field_value, FILTER_VALIDATE_URL)) ? '<a href="' . $row->field_value . '" target="_blank">' . $row->field_value . '</a>' : $row->field_value;
					  $html .= '<div class="item">';
					  $html .= '<div class="content wojo semi text screen-20">' . $row->{'title' . Lang::$lang} . '</div>';
					  $html .= '<div class="content wojo secondary text">' . $is_url;
					  $html .= '</div>';
					  $html .= '</div>';
				  endif;
			  }
			  unset($row);
		  else :
			  $html .= '<div class="wojo block fields">';
			  foreach ($data['data'] as $i => $row) {
				  $tootltip = $row->{'tooltip' . Lang::$lang} ? ' <span data-tooltip="' . $row->{'tooltip' . Lang::$lang} . '"><i class="icon question sign"></i></span>' : '';
				  $required = $row->required ? ' <i class="icon asterisk"></i>' : '';
	
				  $html .= '<div class="field">';
				  $html .= '<label>' . $row->{'title' . Lang::$lang} . $tootltip . $required . '</label>';
				  $html .= '<input name="custom_' . $row->name . '" type="text" placeholder="' . $row->{'title' . Lang::$lang} . '" value="' . ($data['id'] ? $row->field_value : '') . '">';
				  $html .= '</div>';
			  }
			  unset($row);
			  $html .= '</div>';
		  endif;

          break;
		  
      case "portfolio":
          foreach ($data['data'] as $i => $row) {
			  if($row->field_value):
				  $is_url = (filter_var($row->field_value, FILTER_VALIDATE_URL)) ? '<a href="' . $row->field_value . '" target="_blank">' . $row->field_value . '</a>' : $row->field_value;
				  $html .= '<div class="item">';
				  $html .= '<div class="content wojo semi text screen-20">' . $row->{'title' . Lang::$lang} . '</div>';
				  $html .= '<div class="content wojo text">' . $is_url;
				  $html .= '</div>';
				  $html .= '</div>';
			  endif;
		  }
		  unset($row);
          break;
		  
      case "digishop":
          foreach ($data['data'] as $i => $row) {
			  $is_url = (filter_var($row->field_value, FILTER_VALIDATE_URL)) ? '<a href="' . $row->field_value . '" target="_blank">' . $row->field_value . '</a>' : $row->field_value;
			  $html .= '<div class="item">';
			  $html .= '<div class="content auto"><span class="wojo semi text">' . $row->{'title' . Lang::$lang} . ':</span></div>';
			  $html .= '<div class="content description">' . $row->field_value;
			  $html .= '</div>';
			  $html .= '</div>';
		  }
		  unset($row);
          break;
  endswitch;
  echo $html;