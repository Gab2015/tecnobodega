<?php
// Check if $meta option exist in DB
function smartBreadcrumbs_meta_exist($meta = '', $get_id = null) {
    global $wpdb, $post;

    if ($get_id)
        $post_id = $get_id; else
        $post_id = $post->ID;

    return $wpdb->get_var($wpdb->prepare("SELECT COUNT(meta_key) FROM $wpdb->postmeta WHERE meta_key = '%s' AND post_id = %d;", $meta, $post_id));
}

// Check if $option exist in DB
function smartBreadcrumbs_option_exist($option = '') {
    global $wpdb;

    return $wpdb->get_var($wpdb->prepare("SELECT COUNT(option_name) FROM $wpdb->options WHERE option_name = '%s';", $option));
}

if (!function_exists('change_link')) {
    function change_link(&$item, $key, $base_url) {
        if (preg_match('/^\/[\w\W]+$/', $item))
            $item = rtrim($base_url, '/') . $item;

        $item = str_replace($base_url, get_bloginfo('url'), $item);
    }
}

if (!function_exists('pk')) {
    function pk($data) {
        return urlencode(serialize($data));
    }
}

if (!function_exists('unpk')) {
    function unpk($data) {
        return unserialize(urldecode($data));
    }
}

function smartBreadcrumbsCopy($source, $dest, $folderPermission=0755, $filePermission=0644) {
# source=file & dest=dir => copy file from source-dir to dest-dir 
# source=file & dest=file / not there yet => copy file from source-dir to dest and overwrite a file there, if present 
# source=dir & dest=dir => copy all content from source to dir 
# source=dir & dest not there yet => copy all content from source to a, yet to be created, dest-dir 
    $result = false;

    if (is_file($source)) { # $source is file 
        if (is_dir($dest)) { # $dest is folder 
            if ($dest[strlen($dest) - 1] != '/') # add '/' if necessary 
                $__dest = $dest . "/";
            $__dest .= basename($source);
        }
        else { # $dest is (new) filename 
            $__dest = $dest;
        }
        $result = copy($source, $__dest);
        chmod($__dest, $filePermission);
    } elseif (is_dir($source)) { # $source is dir 
        if (!is_dir($dest)) { # dest-dir not there yet, create it 
            @mkdir($dest, $folderPermission);
            chmod($dest, $folderPermission);
        }
        if ($source[strlen($source) - 1] != '/') # add '/' if necessary 
            $source = $source . "/";
        if ($dest[strlen($dest) - 1] != '/') # add '/' if necessary 
            $dest = $dest . "/";

        # find all elements in $source 
        $result = true; # in case this dir is empty it would otherwise return false 
        $dirHandle = opendir($source);
        while ($file = readdir($dirHandle)) { # note that $file can also be a folder 
            if ($file != "." && $file != "..") { # filter starting elements and pass the rest to this function again 
#                echo "$source$file ||| $dest$file<br />\n"; 
                $result = smartBreadcrumbsCopy($source . $file, $dest . $file, $folderPermission, $filePermission);
            }
        }
        closedir($dirHandle);
    } else {
        $result = false;
    }
    return $result;
}