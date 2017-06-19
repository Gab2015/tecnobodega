<?php

// Saving option to Database
function smartBreadcrumbs_save_admin_options($get_option='') {
    $__tmp = explode("_", $_REQUEST['page']);
    if (trim($__tmp[0]) == "smartBreadcrumbs") {
        if ('save' == isset($_REQUEST['smartBreadcrumbs_save'])) {
            return smartBreadcrumbs_save_options($get_option);
        }
    }
}

function smartBreadcrumbs_save_options($options = null) {
    global $smartBreadcrumbs;
    $prefix = $smartBreadcrumbs->prefix;
    foreach ($options as $option) {
        if (is_array($option['type'])) {
            foreach ($option['type'] as $array) {
                if ($array['type'] == 'text') {
                    smartBreadcrumbs_save_text($array);
                }
            }
        }
        switch ($option['type']) {
		
            case 'text':
                smartBreadcrumbs_save_text($option);
                break;

            case 'checkbox':
                smartBreadcrumbs_save_checkbox($option);
                break;

            case 'multicheck':
                smartBreadcrumbs_save_multicheck($option);
                break;

            case 'multi':
                smartBreadcrumbs_save_multi($option);
                break;

            case 'slider':
                smartBreadcrumbs_save_slider($option);
                break;

            case 'boxes':
                smartBreadcrumbs_save_boxes($option);
                break;
            default: 
                smartBreadcrumbs_save_default($option);
        }
    }

    $__tmp = explode("_", $_REQUEST['page']);
    if (trim($__tmp[0]) == "smartBreadcrumbs" && $_REQUEST['smartBreadcrumbs_save'] == 'save') {
        return 'saved';
    }
}
