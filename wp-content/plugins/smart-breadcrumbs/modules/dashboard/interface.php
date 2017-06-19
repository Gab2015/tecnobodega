<?php
/* smartBreadcrumbs Admin (theme) Interface Page */

function smartBreadcrumbs_create_dashboard_page() {
    global $smartBreadcrumbs;
    $prefix = $smartBreadcrumbs->prefix;
    
    // define static array with config
    $sections = array(
        array(
            'label' => 'Layout',
            'link'  => 'smartBreadcrumbs_config#tab_smartLayout',
            'icon'  => $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'dashboard/images/icons/layout.png'
        ),
        array(
            'label' => 'Advance setup',
            'link'  => 'smartBreadcrumbs_config#tab_smartBrAdvanceSettings',
            'icon'  => $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'dashboard/images/icons/settings.png'
        ),
		array(
            'label' => 'Direct support',
            'link'  => 'smartBreadcrumbs_support',
            'icon'  => $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'dashboard/images/icons/support.png'
        ),
        array(
            'label' => 'Document<br />ation',
            'link'  => 'smartBreadcrumbs_documentation',
            'icon'  => $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'dashboard/images/icons/manual.png'
        )
    );

    echo '<h1 class="smartHeadlinde">Dashboard</h1>';
    ?>
    <link href="<?php echo $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'dashboard/css/tipTip.css'; ?>" rel="stylesheet" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo $smartBreadcrumbs->cfg('PLUGIN_MODULES_URL') . 'dashboard/js/jquery.tipTip.minified.js'; ?>" ></script>
    <script type="text/javascript">
        jQuery(function(){
            jQuery(".tooltip_class").tipTip({maxWidth: "auto", edgeOffset: 10});
        });
    </script>
    <div class="wrap themePage">
        <div class="box-custom">
            <?php
            foreach ($sections as $key => $value) {
                ?>
                <a href="<?php echo home_url("/") . 'wp-admin/admin.php?page=' . $value['link'];?>" class="tooltip_class" title="<?php echo $value['label']; ?>">
                    <img src="<?php echo $value['icon']; ?>" width="32" height="32" alt="<?php echo $value['label']; ?>" />
                    <div style="clear:left;"></div>
                <?php echo $value['label']; ?>
                </a>
        <?php
    }
    ?>
        </div>
    </div>
    <?php
}