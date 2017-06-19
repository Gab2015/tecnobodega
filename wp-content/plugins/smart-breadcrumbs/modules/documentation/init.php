<?php
/**
 * Init module
 * @author Andrei Dinca (AA-Team)
 */
// load interface
if(file_exists($_path . 'interface.php')){
    // Instance of class
    $smartBreadcrumbs = $_instance;
    
    require_once($_path . 'interface.php');
}
