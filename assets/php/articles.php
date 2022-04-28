<?php
$articles = [
    [
        'slug' => 'example',
        'title' => 'Why do I need an online presence?',
        'date' => '21.03.22',
        'image' => '/img/articles_sect/img1.png',
        'author' => 'Admin',
        'intro_text' => 'Building an Instagram following takes patience, creativity, and strategy. But, even if you have all of those things, you might still grow tired of spinning your wheels',
    ],[
        'slug' => 'example',
        'title' => '5 Ways to Grow Your Following On Instagram',
        'date' => '22.03.22',
        'image' => '/img/articles_sect/img2.png',
        'author' => 'Admin',
        'intro_text' => 'Instagram lets you tell the world who you are and empowers you to interact with your audience directly. Users want to engage with businesses',
    ],[
        'slug' => 'example',
        'title' => 'The Power of Instagram',
        'date' => '23.03.22',
        'image' => '/img/articles_sect/img3.png',
        'author' => 'Admin',
        'intro_text' => 'Tagging your location can also connect you with users in your community and people who travel there. If someone is in your area looking for the best place',
    ],[
        'slug' => 'example',
        'title' => 'Figure Out Who Your Audience Is',
        'date' => '24.03.22',
        'image' => '/img/articles_sect/img4.png',
        'author' => 'Admin',
        'intro_text' => 'Different industries have different optimal times for posting to Instagram. Even within industries, every brand and audience behaves differently',
    ],[
        'slug' => 'example',
        'title' => 'Focus On Delivering Better Content',
        'date' => '25.03.22',
        'image' => '/img/articles_sect/img5.png',
        'author' => 'Admin',
        'intro_text' => 'In general, Sprout Social cites images as the most engaging content medium at 68%, but the video is a close second at 50%. Mix it up for your users and give them',
    ],[
        'slug' => 'example',
        'title' => 'Optimize Your Posts and Your Posting Strategy',
        'date' => '26.03.22',
        'image' => '/img/articles_sect/img6.png',
        'author' => 'Admin',
        'intro_text' => 'Cross-promotion is immensely helpful when you’re trying to grow your following. Reach out to influencers or other people in your niche',
    ],[
        'slug' => 'example',
        'title' => 'Engage Your Followers and Other Users',
        'date' => '27.03.22',
        'image' => '/img/articles_sect/img7.png',
        'author' => 'Admin',
        'intro_text' => 'Growing your Instagram following organically can be a tedious process that might not deliver the return on investment you wanted',
    ],[
        'slug' => 'example',
        'title' => 'Why You Should Buy Real Instagram Followers',
        'date' => '28.03.22',
        'image' => '/img/articles_sect/img8.png',
        'author' => 'Admin',
        'intro_text' => 'Additionally, a large following can act as social proof for when new Instagram users visit your account. If everyone else is doing it, it must be cool',
    ],[
        'slug' => 'example',
        'title' => 'Use Likes.io to Buy 1000 Followers or More ',
        'date' => '29.03.22',
        'image' => '/img/articles_sect/img9.png',
        'author' => 'Admin',
        'intro_text' => 'Likes.io is a service that provides customers the chance to buy followers, likes, and views on Instagram. Unlike companies that sell fake engagement',
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