<?php
/* smartBreadcrumbs Admin (theme) Interface Page */
function smartBreadcrumbs_create_config_page() {
    global $smartBreadcrumbs;
    $prefix = $smartBreadcrumbs->prefix;
    
    // call options
    $option_fields = smartBreadcrumbs_config_option_fields();
?>
    <!-- Start smartPanel output page -->
    <div class="smartPanel"> 
        
        <?php 
        // save action handler
        $action_response = smartBreadcrumbs_save_admin_options($option_fields);
        
        // action succes status messages
        if ( $action_response == 'saved' ) { ?><div style="clear:both;height:5px;"></div><div class="happy">Options has been updated!</div>
        <?php } 

        // Errors
        /* Check if no duplicate id options */
        function check_option_ids($option_fields) {
            global $all_ids, $smartBreadcrumbs;
			$errors_print = ''; // avoid notice
			
            $options = array_merge($option_fields);		
            smart_array_walk_recursive($options, 'all_ids');
            $all_ids = array_count_values($all_ids);

            foreach($all_ids as $id => $count) {
                if($count>1) $errors_print .= "The ID <b>$id</b> is repeating $count times. <br />";
            }
            return $errors_print;
        }

        function all_ids($item, $key) { 
            global $all_ids; 
            if($key === "id") $all_ids[] = $item;
        }    

		$errors_print = ''; // avoid notice
        $errors_print .= check_option_ids($option_fields);
        $error_occurred = false;
        if($errors_print<>'') {
            $error_occurred = true;
        }

        if($error_occurred) {
            $output = '<div style="clear:both;height:20px;"></div><div class="errors"><ul>' . "\n";
            $output .= $errors_print;
            $output .= '</ul></div>' . "\n";
            echo $output;
        }
        ?>
        
        <!-- Start form -->
        <form id="smartBreadcrumbs" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post"  enctype="multipart/form-data">
        
        <?php
        // Generate the admin page contet, all input custom data
        echo smartBreadcrumbs_options_page_content($option_fields);
		
		// load submit button
        require_once ($smartBreadcrumbs->cfg('PLUGIN_ADMIN') . '/bottom.php');
        ?>
        </form>
        
        <div style="clear:both;"></div>
    </div><!-- // End smartPanel output page -->
    <?php
}