<?
$page_class = 'blog_page';
$title = 'Online Social Media Marketing Blog';
$description = 'A lot of tips and hacks for growing organic traffic and popularity on social media sites';
$canonical = 'https://'.$_SERVER['SERVER_NAME'].'/blog/';
?>
<? include __DIR__.'/../../assets/php/head.php'; ?>
    <section class="title_sect">
        <div class="wrap">
            <h1 class="row1"><span>Blog</span></h1>
            <div class="row2">
                Most interesting news
            </div>
        </div>
    </section>
<?
$styles['title_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/title_sect.css',
];
?>
<?
$articles = require(__DIR__.'/../../assets/php/articles.php');
$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
?>
<section class="articles_sect">
    <div class="wrap">
        <div class="row1">
            <? foreach($articles as $indx => $article) : ?>
                <? if($indx >= ($limit*$page - $limit) && $indx < $limit*$page) : ?>
                    <a href="/blog/<?= $article['slug']; ?>" class="card">
                        <div class="img" style="background-image: url(<?= $article['image']; ?>);"></div>
                        <div class="info">
                            <div class="title"><?= $article['title']; ?></div>
                            <div class="attrs">
                                <div class="attr">
                                    <img class="icon" alt="" src="/img/icons/author-5cbe72.svg">
                                    <span class="label">By <?= mb_strtolower($article['author']); ?></span>
                                </div>
                                <div class="attr">
                                    <img class="icon" alt="" src="/img/icons/calendar-5cbe72.svg">
                                    <span class="label"><?= $article['date']; ?></span>
                                </div>
                                <div class="attr">
                                    <img class="icon" alt="" src="/img/icons/views-5cbe72.svg">
                                    <span class="label"><?= $article['views_qty']; ?> views</span>
                                </div>
                            </div>
                            <div class="intro_text"><?= $article['intro_text']; ?></div>
                        </div>
                    </a>
                <? endif; ?>
            <? endforeach; ?>
        </div>
        <? if(count($articles) > $limit) : ?>
            <div class="row2">
                <? if($page > 1): ?>
                    <a href="?page=<?= ($page - 1); ?>" class="page prev_page"></a>
                <? endif; ?>
                <? for ($i = 1; $i <= ceil(count($articles)/$limit); $i++) : ?>
                    <? if($i == $page) : ?>
                        <span class="page active"><?= $i; ?></span>
                    <? else : ?>
                        <a href="?page=<?= $i; ?>" class="page"><?= $i; ?></a>
                    <? endif; ?>
                <? endfor; ?>
                <? if($page < ceil(count($articles)/$limit)): ?>
                    <a href="?page=<?= ($page + 1); ?>" class="page next_page"></a>
                <? endif; ?>
            </div>
        <? endif; ?>
    </div>
</section>
<?
$styles['articles_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/articles_sect.css',
];
?>
<? include __DIR__.'/../../assets/php/foot.php'; ?>