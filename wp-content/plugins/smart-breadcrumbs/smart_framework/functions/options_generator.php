<?php	
//Generate a text field
function smartBreadcrumbs_text($value) {
    global $post_id;
    $value['options'] = isset($value['options']) ? $value['options'] : '';
	$value['width'] = isset($value['width']) ? $value['width'] : '';
	$value['height'] = isset($value['height']) ? $value['height'] : '';
	$value['cols'] = isset($value['cols']) ? $value['cols'] : '';
	$value['name'] = isset($value['name']) ? $value['name'] : '';
	$value['id'] = isset($value['id']) ? $value['id'] : '';
	$value['std'] = isset($value['std']) ? $value['std'] : '';
	//$value['readonly'] = isset($value['readonly']) == true ? $value['readonly'] : false;
	
    $val = $value ['std'];
    $value ['id'];
    if (smartBreadcrumbs_option_exist($value ['id'])) {
        $val = get_option($value ['id']);
    }else {
        $val = get_post_meta($post_id, $value['id'], true);
    }

    return '<input name="' . $value ['id'] . '" style="' . ( isset($value['width']) != "" ? "width: {$value['width']}%" : "" ) . '" id="' . $value ['id'] . '" type="' . $value ['type'] . '" value="' . $val . '" ' . (isset($value['readonly']) === true ? 'readonly' : '') . ' />';
}

// Generate button
function smartSeo_buttons($value) {
    global $smartBreadcrumbs;
    
    
    $ret = '<div id="messageStats" class="updated"><p></p></div>
            <div class="smartBlockActions">
            <p class="submit submit-footer">';
    
    foreach ($value['buttons']  as $key => $value){
        if($key == 'ajax') {
            $ret .= '<input name="save" type="submit" class="button-primary btn_save_ajax" value="'.($value).'" />';
        }
    }
    
    $ret .= '</p> 
        <div id="smartAjaxSave">
            <img src="' . ($smartBreadcrumbs->cfg('ADMIN_IMAGES')) .'/ajax-loader.gif" alt="saving" />
            <i> saving settings ... </i>
        </div>
  ';
    
    return $ret;
}

//Generate a password field
function smartBreadcrumbs_password($value) {
    $val = $value ['std'];
    $value ['id'];
    if (smartBreadcrumbs_option_exist($value ['id'])) {
        $val = get_option($value ['id']);
    }

    return '<input name="' . $value ['id'] . '" style="' . ( $value['width'] != "" ? "width: {$value['width']}%" : "" ) . '" id="' . $value ['id'] . '" type="' . $value ['type'] . '" value="' . $val . '" ' . ($value['readonly'] === true ? 'readonly' : '') . ' />';
}
	
// Generate fields with array type
function smartBreadcrumbs_array_type($value) {
    global $post;

    foreach ($value ['type'] as $array) {

        $id = $array ['id'];
        $val = $array ['std'];
        $meta = $array ['meta'];
        $style = $array ['style'];
        if (smartBreadcrumbs_option_exist($id))
            $val = get_option($id);
        if ($array ['type'] == 'text') {
            $output .= '<input class="input-text-small" name="' . $id . '" id="' . $id . '" type="text" value="' . $val . '" style="' . ( $style ) . '" /> <span class="meta-two">' . $meta . '</span>';
        }
    }

    return $output;
}

//END smartBreadcrumbs_array_type()
//----------------------------------------------------------------------------//


function smartBreadcrumbs_textarea($value) {
    global $post_id, $prefix;
	
    $value['options'] = isset($value['options']) ? $value['options'] : '';
	$value['width'] = isset($value['width']) ? $value['width'] : '';
	$value['height'] = isset($value['height']) ? $value['height'] : '';
	$value['cols'] = isset($value['cols']) ? $value['cols'] : '';
	$value['name'] = isset($value['name']) ? $value['name'] : '';
	$value['id'] = isset($value['id']) ? $value['id'] : '';
	$value['std'] = isset($value['std']) ? $value['std'] : '';
	$value['type'] = isset($value['type']) ? $value['type'] : '';
	
    $val = $value ['std'];

    if (smartBreadcrumbs_option_exist($value ['id'])) {
        $val = get_option($value ['id']);
    }else{
        $val = get_post_meta($post_id, $value['id'], true);
    }

    return '<textarea style="' . ( $value['width'] != "" ? "width: {$value['width']}%;" : "" ) . ' ' . ( $value['height'] != "" ? "height: {$value['height']}px;" : "" ) . '" name="' . $value ['id'] . '" id="' . $value ['id'] . '" cols="' . $value ['cols'] . '" rows="8">' . $val . '</textarea>';
}

//END smartBreadcrumbs_textarea()
//----------------------------------------------------------------------------//


function smartBreadcrumbs_checkbox($value) {

    $val = $value ['std'];

    if (smartBreadcrumbs_option_exist($value ['id'])) {
        $val = get_option($value ['id']);
    }

    if ($val == 'true') {
        $checked = 'checked="checked"';
    } else {
        $checked = '';
    }

    $output = '<input type="checkbox" style="margin-top:5px;" class="single_checkbox" name="' . $value ['id'] . '" id="' . $value ['id'] . '" value="true" ' . $checked . ' />';

    return $output;
}

//END smartBreadcrumbs_checkbox()
//----------------------------------------------------------------------------//
//Generate multi checkboxes
function smartBreadcrumbs_multicheck($value) {
    global $post; 
    foreach ($value ['options'] as $key => $option) {
        if ($key === 0)
            continue;

        $val = $value ['std'];
        $smart_key = $value ['id'] . '_' . $key;

        if ($_REQUEST ['page'] == 'smartBreadcrumbs' || basename($_SERVER ['PHP_SELF']) == "categories.php") {
            if (smartBreadcrumbs_option_exist($smart_key))
                $val = get_option($smart_key);
        } else {
            if (smartBreadcrumbs_meta_exist($smart_key))
                $val = get_post_meta($post->ID, $smart_key, true);
        }

        if ($val == 'true' or $val == $key) {
            $checked = 'checked="checked"';
        } else {
            $checked = '';
        }

        $output .= '
			<div class="multicheckbox" style="padding-bottom: 5px;"><input type="checkbox" class="checkbox" name="' . $smart_key . '" id="' . $smart_key . '" value="true" ' . $checked . ' /> 
			' . $option . '</div>';
    }

    return $output;
}

//END smartBreadcrumbs_multicheck() 
//----------------------------------------------------------------------------//  

function smartBreadcrumbs_colorpicker($value) {
    global $smartBreadcrumbs;
	
	$value['options'] = isset($value['options']) ? $value['options'] : '';
	$value['width'] = isset($value['width']) ? $value['width'] : '';
	$value['height'] = isset($value['height']) ? $value['height'] : '';
	$value['cols'] = isset($value['cols']) ? $value['cols'] : '';
	$value['name'] = isset($value['name']) ? $value['name'] : '';
	$value['id'] = isset($value['id']) ? $value['id'] : '';
	$value['std'] = isset($value['std']) ? $value['std'] : '';
	$value['readonly'] = isset($value['readonly']) ? $value['readonly'] : '';
    
    $val = get_option($value['id']);

    $output = "<link rel='stylesheet' id='colorpicker-style-css'  href='".($smartBreadcrumbs->cfg('PLUGIN_URI') . "/smart_framework/js/colorpicker/css/colorpicker.css")."' type='text/css' media='' />";
    $output .= "<script type='text/javascript' src='".($smartBreadcrumbs->cfg('PLUGIN_URI') . "/smart_framework/js/colorpicker/js/colorpicker.js")."'></script>";

    $output .= '<div class="colorSelector" id="colorSelector-' . $value ['id'] . '" style="float: left; margin: 0px 0px 0px 0px;"><div style="background-color: '.($val).'"></div></div>';
    
    $output .= "<script type='text/javascript'>
        jQuery(document).ready(function () {
            jQuery('#colorSelector-". ( $value ['id'] ) ."').ColorPicker({
                color: '".($val)."',
                onShow: function (colpkr) {
                    jQuery(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    jQuery('#colorSelector-". ( $value ['id'] ) ." div, #bk_image').css('backgroundColor', '#' + hex);
                    jQuery('#".($value ['id'])."').val('#' + hex);
                }
            });
        })";
     $output .= "</script>";
     $output .= '<input name="' . $value ['id'] . '" style="width:120px; margin: 5px 0px 10px 10px; float: left;" id="' . $value ['id'] . '" type="text" value="' . $val . '" ' . ($value['readonly'] === true ? 'readonly' : '') . ' /><div style="clear:both"></div>';
     
     return $output;
}

function smartBreadcrumbs_radio($value) {

    foreach ($value ['options'] as $key => $option) {
        if ($key === 0)
            continue;

        if (smartBreadcrumbs_option_exist($value ['id'])) {
            $val = get_option($value ['id']);
        } else {
            $val = $value ['std'];
        }

        if ($val == $key) {
            $checked = ' checked';
        } else {
            $checked = '';
        }

        $output .= '
			<div class="multicheckbox"><input type="radio" class="checkbox ' . $value ['id'] . ' " name="' . $value ['id'] . '"  value="' . $key . '" ' . $checked . ' /> 
			' . $option . '</div>';
    }
    return $output;
}


function smartBreadcrumbs_radio_files($value) {
    global $smartBreadcrumbs;
    
	$output = '';
    $files = array();
    require_once ($smartBreadcrumbs->cfg('PLUGIN_DIR') . '/' . $value['path']);
    
    $files_uri = str_replace("/load.php", "/", $smartBreadcrumbs->cfg('PLUGIN_URI') . '/' . $value['path']);
    if(count($files) > 0){
        foreach ($files as $key => $option) {
            
            if (smartBreadcrumbs_option_exist($value['id'])) {
                $val = get_option($value['id']);
            } else {
                $val = $value['std'];
            }

            if ($val == $option) {
                $checked = ' checked';
            } else {
                $checked = '';
            }
            $output .= '
                <div style="float: left;width: 590px;height: 32px;border: 1px solid #dadada; padding: 3px; margin: 3px;background-color: #fff;">
                <input type="radio" style="float: left;position: relative; bottom: -10px;margin-right: 2px;" class="checkbox ' . $value ['id'] . ' " name="' . $value ['id'] . '" id="' . $value ['id'] . '-' . $option . '" value="' . $option . '" ' . $checked . ' /> 
                <label for="' . $value ['id'] . '-' . $option . '">
                    
                <div style="background-image: url('.($files_uri . $option).'); background-repeat: no-repeat; width: 571px; height: 32px; float: right; margin-right: 4px;"></div>
                </label></div>';
        }
    }
    return $output . "<div style='clear:both;'></div>";
}

//END smartBreadcrumbs_radio()
//----------------------------------------------------------------------------//


function smartBreadcrumbs_select($value) {
	global $post_id;
	$value['options'] = isset($value['options']) ? $value['options'] : '';
	$value['width'] = isset($value['width']) ? $value['width'] : '';
	$value['height'] = isset($value['height']) ? $value['height'] : '';
	$value['cols'] = isset($value['cols']) ? $value['cols'] : '';
	$value['name'] = isset($value['name']) ? $value['name'] : '';
	$value['id'] = isset($value['id']) ? $value['id'] : '';
	$value['std'] = isset($value['std']) ? $value['std'] : '';
	$value['readonly'] = isset($value['readonly']) ? $value['readonly'] : '';
	
    $output = '<select name="' . $value ['id'] . '" id="' . $value ['id'] . '" style="' . ( $value['width'] != "" ? "width: {$value['width']}%;" : "" ) . ' ' . ( $value['height'] != "" ? "height: {$value['height']}px;" : "" ) . '">';

    foreach ($value ['options'] as $key => $option) {

        if (smartBreadcrumbs_option_exist($value ['id'])) {
            $val = get_option($value ['id']);
        } else {
			$val = get_post_meta($post_id, $value['id'], true);
        }
        if ($val == $key) {
            $selected = ' selected="selected"';
        } else {
            $selected = '';
        }

        $output .= '<option' . $selected . ' value="' . $key . '">';
        $output .= $option;
        $output .= '</option>';
    }

    $output .= '</select>';

    return $output;
}

// END smartBreadcrumbs_select()
//----------------------------------------------------------------------------//


function smartBreadcrumbs_listdatabase($value) {
    global $wpdb;

    $output = '<table cellspacing="0" class="widefat tag fixed" >
		<thead>
			<tr>';
    $output .= '<th scope="col" width="60">Actions</th>';
    foreach ($value['options'] as $key => $val) {
        $output .= '<th scope="col">' . (ucfirst(str_replace("_", " ", $val))) . '</th>';
    }
    $output .= '</tr>
		</thead>
		<tfoot>
			<tr>';
    $output .= '<th scope="col" width="60">Actions</th>';
    foreach ($value['options'] as $key => $val) {
        $output .= '<th scope="col">' . (ucfirst(str_replace("_", " ", $val))) . '</th>';
    }
    $output .= '</tr>
		</tfoot>
		<tbody class="list:tag">';

    // get entry
    $entry = (array) $wpdb->get_results("SELECT " . (implode(" ,", $value['options'])) . " FROM " . ($value['std']) . " WHERE 1=1");
    if (count($entry) > 0) {
        $cc = 0;
        foreach ($entry as $key => $value2) {

            $output .= '<tr class="<?php echo $cc % 2 ? \'alternate\' : \'\';?>">';
            
            $output .= '<td style="height:35px"><a href="javascript: void(0)" class="button delete" style="position:relative; bottom: -5px;" id="delete-'.($value2->$value['options'][0]).'">DELETE</a></td>';
            foreach ($value['options'] as $key => $val) {
                $output .= '<td>' . ($value2->$val) . '</td>';
            }

            $output .= '</tr>';

            $cc++;
        }
    } else {
        $output .= '
				<tr class="alternate" id="tag-4">
					<td class="name column-name" colspan="' . (count($value['options'])) . '"><strong style="color:red">NO entry yet!</strong></td>
				</tr>';
    }
    $output .= '</tbody>
	</table>';

    return $output;
}

// END smartBreadcrumbs_select()

function smartBreadcrumbs_multi($value) {
    global $post;

    $output .= '<div class="multiple_box">';

    $hidden_name = $value ['id'] . '_hidden';

    //get nr of entries
    if ($_REQUEST ['page'] == 'smartBreadcrumbs' || basename($_SERVER ['PHP_SELF']) == "categories.php") {
        if (smartBreadcrumbs_option_exist($hidden_name))
            $settings_hidden_name = get_option($hidden_name);
    } else {
        if (smartBreadcrumbs_meta_exist($hidden_name))
            $settings_hidden_name = get_post_meta($post->ID, $hidden_name, true);
    }

    if ($settings_hidden_name == "" || $settings_hidden_name === false) {
        $settings_hidden_name = 1;
    }

    for ($i = 0; $i < $settings_hidden_name; $i++) {

        if ($value ['subtype'] == 'page') {
            $select = 'Select additional page?';
            $entries = get_pages('title_li=&orderby=name');
        } elseif ($value ['subtype'] == 'category') {
            $select = 'Select additional category?';
            $entries = get_categories('title_li=&orderby=name&hide_empty=0');
        } else {
            $select = 'Select additional category or page?';
            $entries_cat = get_categories('title_li=&orderby=name&hide_empty=0');
            $entries_page = get_pages('title_li=&orderby=name');
            $entries = array_merge($entries_page, $entries_cat);
        }

        $output .= '<select class="postform multiply_me disable_me" id="' . $value ['id'] . '_' . $i . '" name="' . $value ['id'] . '_' . $i . '"> ';
        $output .= '<option value="0">' . $select . '</option>  ';

        if ($_REQUEST ['page'] == 'smartBreadcrumbs' || basename($_SERVER ['PHP_SELF']) == "categories.php") {
            if (smartBreadcrumbs_option_exist($value ['id'] . '_' . $i))
                $home_val = trim(get_option($value ['id'] . '_' . $i));
        } else {
            if (smartBreadcrumbs_meta_exist($value ['id'] . '_' . $i))
                $home_val = trim(get_post_meta($post->ID, $value ['id'] . '_' . $i, true));
        }

        if ($home_val == "home")
            $selected = "selected='selected'";
        else
            $selected = "";

        if ($value ['subtype'] != 'category' && $value ['subtype'] != 'page')
            $output .= '<option ' . $selected . ' value="home">Home</option>  ';

        foreach ($entries as $entry) {

            $prefixt = '';

            if ($value ['subtype'] == 'page' || $entry->post_title != '') {
                if ($value ['subtype'] != 'category' && $value ['subtype'] != 'page') {
                    $prefixt = "Page - ";
                }

                $id = "pag_" . $entry->ID;
                $title = $prefixt . $entry->post_title;
            } else {
                if ($value ['subtype'] != 'category' && $value ['subtype'] != 'page') {
                    $prefixt = "Category - ";
                }

                $id = "cat_" . $entry->term_id;
                $title = $prefixt . $entry->name;
            }

            if ($_REQUEST ['page'] == 'smartBreadcrumbs' || basename($_SERVER ['PHP_SELF']) == "categories.php") {
                if (smartBreadcrumbs_option_exist($value ['id'] . '_' . $i))
                    $val = get_option($value ['id'] . '_' . $i);
            } else {
                if (smartBreadcrumbs_meta_exist($value ['id'] . '_' . $i))
                    $val = get_post_meta($post->ID, $value ['id'] . '_' . $i, true);
            }

            if ($val == $id) {
                $selected = "selected='selected'";
            } else {
                $selected = "";
            }

            $output .= "<option $selected value='" . $id . "'>" . $title . "</option>";
        }

        $output .= '</select>';
    }

    if (isset($settings_hidden_name))
        $value ['std'] = $settings_hidden_name;

    $output .= '<input name="' . $hidden_name . '" class="' . $hidden_name . '" type="hidden" value="' . $settings_hidden_name . '" />';

    $output .= '</div>';

    return $output;
}

// END smartBreadcrumbs_multi ()