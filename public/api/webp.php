<?php
//file_put_contents('test.json', json_encode($_GET));
$origin_path = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['src'];
$im_str = file_get_contents($origin_path);
$headers = getallheaders();
//file_put_contents('headers.json', json_encode($headers));

if($im_str && $headers['Accept'] && mb_strpos($headers['Accept'], 'image/webp') !== false) {
    $im = imagecreatefromstring($im_str);
    $webp_path = $_SERVER['DOCUMENT_ROOT'].'/cache/webp/'.str_replace(['.png', '.jpeg', '.jpg'], '.webp', $_GET['src']);
    if(file_exists($webp_path)) {
        header('Content-Type: image/webp');
        echo file_get_contents($webp_path);
        die();
    } else {
        //echo 'test';
        //die();
        $webp_path_dir = mb_substr($webp_path, 0, mb_strripos($webp_path, '/'));
        mkdir($webp_path_dir, 0777, true);
        if (imagewebp($im, $webp_path)) {
            imagedestroy($im);
            header('Content-Type: image/webp');
            echo file_get_contents($webp_path);
            die();
        }
        imagedestroy($im);
    }
}
header('Content-Type: image/'.mb_substr($origin_path, mb_strripos($origin_path, '.')+1));
echo $im_str;