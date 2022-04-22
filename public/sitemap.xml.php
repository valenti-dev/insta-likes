<?
header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>';
$last_mod = '2022-04-01T00:00:00+01:00';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/contact</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/free-instagram-followers</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/get-started</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/get-started</loc>
        <lastmod><?= $last_mod; ?></lastmod>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>https://<?= $_SERVER['SERVER_NAME']; ?>/pricing</loc>
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

</urlset>