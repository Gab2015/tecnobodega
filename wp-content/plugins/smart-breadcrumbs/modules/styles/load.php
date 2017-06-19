<?php
function smartBpath_get_last_arg($path){
    $path = str_replace('\\', '/', $path); 
    $path = preg_replace('/\/+$/', '', $path);
    $path = explode('/', $path);
    $l = count($path)-1;
    return isset($path[$l]) ? $path[$l] : '';
}
// strange thing here!
foreach(glob(str_replace(DIRECTORY_SEPARATOR . "load.php", "", realpath ( __FILE__ )) . DIRECTORY_SEPARATOR . 'style' . DIRECTORY_SEPARATOR . '*') as $dir){
    $preview = pathinfo($dir . DIRECTORY_SEPARATOR . 'preview.png'); 
    $files[] = 'style' . "/" . 
        smartBpath_get_last_arg($preview['dirname']) . 
        "/" . 'preview.png';
}