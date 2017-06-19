<?php
function smartBreadcrumbs_install_theme(){
    global $wpdb, $smartBreadcrumbs;
		
    // load sql file as binary
    $mySQL = $smartBreadcrumbs->cfg('PLUGIN_MODULES') . '/install/' . "default.sql";
    
    $handle = @fopen($mySQL, "r");
    if ($handle) {
        while (($theQUERY = fgets($handle, 99999)) !== false) {
            if(trim($theQUERY) == "") continue;
            
            // replace content table 
            $theQUERY = str_replace("{db_prefix}", $wpdb->prefix, $theQUERY);
            $theQUERY = str_replace("{install_uri}", $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . '/install/images', $theQUERY);
            
            // execute query 
            $wpdb->query($theQUERY);
        }
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail (default install)\n";
        }
        fclose($handle);
    }
}

/* smartBreadcrumbs Admin (theme) Interface Page */
function smartBreadcrumbs_create_install_page() {
    global $smartBreadcrumbs, $wpdb;
 ?>
    <link href="<?php echo $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'install/css/install.css'; ?>" rel="stylesheet" type="text/css" media="screen" />
     
    <div class="install-box">
        
        <?php
        if(isset($_GET['install']) == 1){
            smartBreadcrumbs_install_theme();
        ?>
            <script type="text/javascript">
                window.location = "<?php echo home_url("/") . 'wp-admin/admin.php?page=smartBreadcrumbs';?>";
            </script>
            <a href="<?php echo home_url("/") . 'wp-admin/admin.php?page=smartBreadcrumbs';?>" class="button">Go to dashboard</a>
        <?php  }else{ ?>
        <img src="<?php echo $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'install/';?>images/install.png" alt="preview" />

        <h1 class="smartHeadlinde">First setup (restore to default) <?php echo $smartBreadcrumbs->utils['shortname'];?></h1>
        <p><?php echo $smartBreadcrumbs->utils['shortdes'];?></p>

        <a href="<?php echo home_url("/") . 'wp-admin/admin.php?page=smartBreadcrumbs_install&install=1';?>" class="button">Install default config</a> &nbsp; <i>or</i> &nbsp; <a href="<?php echo home_url("/") . 'wp-admin/admin.php?page=smartBreadcrumbs';?>" class="button">Go to dashboard</a>
        
        <?php } ?>
    </div>   
<?php 
}