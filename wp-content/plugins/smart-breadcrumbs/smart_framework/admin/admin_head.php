<?php 
/***  Add css and js to admin header  ***/
function smartBreadcrumbs_admin_head() {  
    global $smartBreadcrumbs;
    $prefix = $smartBreadcrumbs->prefix;
?>
    <script type="text/javascript">
        var smartBreadcrumbsURI = '<?php echo $smartBreadcrumbs->cfg('PLUGIN_URI');?>';
    </script>
    
    <link href="<?php echo $smartBreadcrumbs->cfg('ADMIN_CSS'); ?>/style.css" rel="stylesheet" type="text/css" media="screen" /> 
    <script src="<?php echo $smartBreadcrumbs->cfg('ADMIN_JS'); ?>/ui.core.js" type="text/javascript" ></script>
    <script src="<?php echo $smartBreadcrumbs->cfg('ADMIN_JS'); ?>/ajaxupload.js" type="text/javascript" ></script>

    <script src="<?php echo $smartBreadcrumbs->cfg('ADMIN_JS'); ?>/js.js" type="text/javascript" ></script>
<?php 
}//END smartBreadcrumbs_admin_head()
add_action('admin_head', 'smartBreadcrumbs_admin_head');  