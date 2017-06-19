<?php
// Generate custom fields
function smartBreadcrumbs_options_page_content($get_option = null, $only_form = false, $showlogo = true) {
    global $admin_options, $smartBreadcrumbs;
    $prefix = $smartBreadcrumbs->prefix;

    $counter = 0;
    $draw_tabs_li = '';
    $heading_open = false;
    $tab_open = false;
	$output = '';
	
    if (empty($get_option)) {
        $options = $admin_options;
    } else {
        $options = $get_option;
    }

	
    foreach ($options as $value) {
		$value['id'] = isset($value['id']) ? $value['id'] : '';
		
        if ($only_form === false && $value['type'] != "title" && $value['type'] != "buttons" && $value['type'] != "boxes" && $value['type'] != "tableList" && $value['type'] != "tab" && $value['type'] != "metabox") {
            if($value['type'] != "addons") {
                $output .= '<div class="option option-' . $value['type'] . '">' . "\n" . '<div class="option-inner">' . "\n";
                $output .= '<label class="titledesc" for="' . $value['id'] . '">' . $value['name'] . '</label>' . "\n";
                $output .= '<div class="formcontainer">' . "\n" . '<div class="forminp">' . "\n";
            }else{
                ob_start();
                require_once ($smartBreadcrumbs->cfg('PLUGIN_DIR') . '/' . $value['path']);
             
                $output .= ob_get_contents();
                ob_end_clean();
            }
        }

        if (is_array($value['type']))
            $output .= smartBreadcrumbs_array_type($value);

        switch ($value['type']) {

            case "tab":
                if ($tab_open) {
                    $tab_open = false;
                    $output .= '</div> <!-- // end #tab_' . $value['id'] . ' -->';
                }

                $draw_tabs_li .= '<li><a href="#tab_' . $value['id'] . '">' . $value['name'] . '</a></li>' . "\n";
                $output .= '<div class="et-tabs-content" id="tab_' . $value['id'] . '">';
                $tab_open = true;
                $heading_open = false;

                break;

            case "tableList":
                $output .= smartBreadcrumbs_listdatabase($value);

                break;
            
            case "buttons":
                $output .= smartSeo_buttons($value);

                break;
            
            case 'text':
                $output .= smartBreadcrumbs_text($value);
                break;
            
            case 'radiobutton_files':
                $output .= smartBreadcrumbs_radio_files($value);
                break;
            
            case 'password':
                $output .= smartBreadcrumbs_password($value);
                break;
            
            case 'textarea':
                $output .= smartBreadcrumbs_textarea($value);
                break;

            case 'select':
                $output .= smartBreadcrumbs_select($value);
                break;
            
            case 'title':
				$value['styles'] = isset($value['styles']) ? $value['styles'] : '';
                $output .= "<h2 style='font-size: 14px; margin: 20px 0px 10px 0px;display: block;float: left;" . $value['styles'] . "'>" . $value['name'] . "</h2>";
                break;
            
            case 'radio':
                $output .= smartBreadcrumbs_radio($value);
                break;

            case 'checkbox':
                $output .= smartBreadcrumbs_checkbox($value);
                break;
            
            case 'colorpicker':
                $output .= smartBreadcrumbs_colorpicker($value);
                break;
            
            case 'multicheck':
                $output .= smartBreadcrumbs_multicheck($value);
                break;

            case 'upload':
                $output .= smartBreadcrumbs_upload($value);
                break;

            case 'multi':
                $output .= smartBreadcrumbs_multi($value);
                break;

            case 'slider':
                $output .= smartBreadcrumbs_slider($value);
                break;

            case 'boxes':
                $output .= smartBreadcrumbs_boxes($value);
                break;
        } //END switch ( $value['type'] )
        //-------------------------------------------//

        if ($only_form === false && $value['type'] != "title" && $value['type'] != "boxes" && $value['type'] != "tableList" && $value['type'] != "tab" && $value['type'] != "metabox" && $value['type'] != "addons") {
            if ($value['type'] != "checkbox") {
                $output .= '<br/>';
            }
			$value['desc'] = isset($value['desc']) ? $value['desc'] : '';
            $output .= '</div><div class="desc">' . $value['desc'] . '</div></div>' . "\n";
            $output .= '</div></div>' . "\n";
        } // END if
    } //END foreach ($options as $value)
  
    if($showlogo == true){
		$draw_tabs = "<ul class='et-tabs-control'>\n";
		$draw_tabs .= $draw_tabs_li;
		$draw_tabs .= "</ul>\n";
		$output_content = '<div id="verticalTabs">' . "\n";

		$output_content .= '<div class="topArea">
			<div class="smartIcon">
                <img src="'.($smartBreadcrumbs->cfg('PLUGIN_URI')) . '/' . $smartBreadcrumbs->utils['thumb'] . '" alt="plugin icon" />
            </div>
			<div class="smartHead">
				<h1>'.($smartBreadcrumbs->utils['shortname']).'</h1>
				<div class="desc">'.($smartBreadcrumbs->utils['shortdes']).'</div>
			</div>
		</div>';
		$output_content .= $draw_tabs . $output;
		$output_content .= '</div></div>' . "\n";
	
		return $output_content;
	}else{
		return $output;
	}
}
//END smartBreadcrumbs_options_page_content()