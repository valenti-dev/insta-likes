<?php
if (isset($_GET['q']) && $_GET['q']) {
    if(mb_stripos($_GET['q'], '//') !== false || mb_substr($_GET['q'], -1) == '/' || mb_strtolower($_GET['q']) !== $_GET['q']) {
        while(mb_stripos($_GET['q'], '//') !== false) {
            $_GET['q'] = str_replace('//', '/', $_GET);
        }
        if(mb_substr($_GET['q'], -1) == '/') {
            $_GET['q'] = mb_substr($_GET['q'], 0, strlen($_GET['q']) - 1);
        }
        $_GET['q'] = mb_strtolower($_GET['q']);
        header('Location: //'.$_SERVER['SERVER_NAME'].'/'.$_GET['q'], true, 301);
        exit();
    }
}
if(!isset($_GET['q']) || !$_GET['q']) {
    $canonical = 'https://'.$_SERVER['SERVER_NAME'].'/';
    return include('home.php');
} else if (file_exists($_GET['q'].'.php')) {
    $canonical = 'https://'.$_SERVER['SERVER_NAME'].'/'.$_GET['q'];
    return include($_GET['q'].'.php');
} else {
    $q_parts = explode('/', $_GET['q']);
    if($q_parts && $q_parts[0] == 'ticket') {
        $canonical = 'https://'.$_SERVER['SERVER_NAME'].'/'.$_GET['q'];
        $email = $q_parts[1];
        $code = $q_parts[2];
        return include('ticket.php');
    } else {
        http_response_code(404);
    }
}