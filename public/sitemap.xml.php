<?
header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
$last_mod = '2022-04-01T00:00:00+01:00';
$articles = require(__DIR__.'/../assets/php/articles.php');
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/automatic-instagram-likes</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/buy-instagram-comments</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/buy-instagram-followers</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/buy-instagram-likes</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/buy-instagram-views</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/contact</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/support</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/terms</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/privacy-policy</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/blog/</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <? foreach ($articles as $article) : ?>
        <url>
            <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/blog/<?= $article['slug']; ?></loc>
            <lastmod><?= $last_mod; ?></lastmod>
            <priority>1.0</priority>
        </url>
    <? endforeach; ?>
</urlset>