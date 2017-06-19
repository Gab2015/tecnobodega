<?php

/**
 * Init module
 * @author Andrei Dinca (AA-Team)
 */

// load interface
if (file_exists($_path . 'interface.php')) {
    // Instance of class
    $smartBreadcrumbs = $_instance;

    /* Initialize the admin head js,css */
    require_once ($smartBreadcrumbs->cfg('PLUGIN_ADMIN') . '/admin_head.php');

    // load options
    require_once($_path . 'options.php');

    // load interface
    require_once($_path . 'interface.php');
}
