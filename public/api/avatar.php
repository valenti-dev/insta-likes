<?php
header('Content-Type: image/png');
$dir = $_SERVER['DOCUMENT_ROOT'].'/cache/avatar';
$path = $dir.'/'.md5($_GET['url']).'.png';
if(!file_exists($path)) {
    if(!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
    file_put_contents($path, file_get_contents($_GET['url']));
}
echo file_get_contents($path, FILE_USE_INCLUDE_PATH);
