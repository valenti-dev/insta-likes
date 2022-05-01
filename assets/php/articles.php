<?php
$articles = [
    [
        'slug' => 'how-to-build-a-brand-on-instagram',
        'title' => 'How to Build a Brand on Instagram?',
        'date' => '01.05.22',
        'image' => '/img/articles_sect/how-to-build-a-brand-on-instagram/1.png',
        'author' => 'Admin',
        'intro_text' => 'Useful Information on How to Build Your Own Personal Brand',
    ],[
        'slug' => '5xx-server-error-instagram',
        'title' => 'What is 5xx Instagram Server Error?',
        'date' => '01.05.22',
        'image' => '/img/articles_sect/5xx-server-error-instagram/1.png',
        'author' => 'Admin',
        'intro_text' => 'So what is the meaning behind Instagram 5xx Server Error?',
    ],
];
$view_qties = json_decode(file_get_contents(__DIR__.'/../../assets/view_qties.json', FILE_USE_INCLUDE_PATH), true);
if(!is_array($view_qties)) {
    $view_qties = [];
}
foreach ($articles as $indx => $article) {
    $articles[$indx]['views_qty'] = isset($view_qties['blog/'.$article['slug']]) ? $view_qties['blog/'.$article['slug']] : 0;
}
return $articles;