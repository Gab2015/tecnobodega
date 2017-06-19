<?php
/**
 * add to init dynamically
 *
 * @global type $config_options
 * @global type $smartBreadcrumbs
 */
function smartBreadcrumbs_config_option_fields() {
    global $tagcloud_options, $smartBreadcrumbs;
    $prefix = $smartBreadcrumbs->prefix;

    $options = array();

    /* Tab - CountDown - datapicker */
    $options[] = array(
        "name" => "Layout",
        "type" => "tab",
        "id" => "smartLayout"
    );

    $options[] = array(
        "name" => "General design settings:",
        "type" => "title",
        "styles" => "margin-top: 16px;"
    );
    $options[] = array(
        "name" => "General style",
        "type" => "radiobutton_files",
        "path" => "modules/styles/load.php",
        "id" => "{$prefix}" . "_" . "config" . "_" . "style"
    );
        
    $options[] = array(
        "name" => "Link text - color:",
        "desc" => 'Pick your color',
        "id" => "{$prefix}" . "_" . "config" . "_" . "link_fontcolor",
        "std" => "",
        "type" => "colorpicker"
    );
    $options[] = array(
        "name" => "Current item (not link) text - color:",
        "desc" => 'Pick your color',
        "id" => "{$prefix}" . "_" . "config" . "_" . "curr_fontcolor",
        "std" => "",
        "type" => "colorpicker"
    );
    $options[] = array(
        "name" => "Hover link text - color:",
        "desc" => 'Pick your color',
        "id" => "{$prefix}" . "_" . "config" . "_" . "hover_fontcolor",
        "std" => "",
        "type" => "colorpicker"
    );
    $options[] = array(
        "name" => "Font family:",
        "desc" => 'Choose from list',
        "id" => "{$prefix}" . "_" . "config" . "_" . "fontfamily",
        "std" => "",
        "options" => $smartBreadcrumbs->fonts(),
        "type" => "select"
    );
    $options[] = array(
        "name" => "Font size:",
        "desc" => 'Default: <b>12px</b>',
        "id" => "{$prefix}" . "_" . "config" . "_" . "font_size",
        "std" => "",
        "type" => "text",
        "width" => "10"
    );
    $options[] = array(
        "name" => "Show border:",
        "desc" => 'Default: true',
        "id" => "{$prefix}" . "_" . "config" . "_" . "border_show",
        "std" => "",
        "options" => array('', 'Yes', 'No'),
        "type" => "radio"
    );
    $options[] = array(
        "name" => "Border color:",
        "desc" => 'Pick your color',
        "id" => "{$prefix}" . "_" . "config" . "_" . "border_color",
        "std" => "",
        "type" => "colorpicker"
    );
    
    $options[] = array(
        "name" => "Home icon:",
        "desc" => 'Pick your homepage icon',
        "id" => "{$prefix}" . "_" . "config" . "_" . "homeicon",
        "std" => "",
        "type" => "upload"
    );

    $options[] = array(
        "name" => "Advanced settings",
        "type" => "tab",
        "id" => "smartBrAdvanceSettings"
    );
    $options[] = array(
        "name" => "Link current item:",
        "desc" => 'Display current item as link?',
        "id" => "{$prefix}" . "_" . "config" . "_" . "link_current_item",
        "std" => "",
        "options" => array('true' => 'true', 'false' => 'false'),
        "type" => "select",
        "width" => "8"
    );
    $options[] = array(
        "name" => "Post title max lenght:",
        "desc" => 'Maximum number of characters of post title to be displayed? 0 means no limit.',
        "id" => "{$prefix}" . "_" . "config" . "_" . "posttitle_maxlen",
        "std" => "",
        "type" => "text",
        "width" => "8"
    );
    $options[] = array(
        "name" => "Single blog post category display:",
        "desc" => 'Display category when displaying single blog post',
        "id" => "{$prefix}" . "_" . "config" . "_" . "singleblogpost_category_display",
        "std" => "",
        "options" => array('true' => 'true', 'false' => 'false'),
        "type" => "select"
    );
        
    /* END tagcloud_option_fields() */
    update_option("{$smartBreadcrumbs->prefix}_tagcloud_options", $options);

    return $options;
}