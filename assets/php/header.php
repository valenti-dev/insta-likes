<header class="header" :class="header.opened ? 'opened' : ''">
    <div class="wrap">
        <div class="row1">
            <div class="left">
                <logo></logo>
            </div>
            <div class="right">
                <button class="menu_burger" @click="header.opened = !header.opened">
                    <img class="menu_burger_icon" alt="menu-burger" :src="'/img/icons/'+(header.opened ? 'menu-close-5cbe72' : 'menu-open-fff')+'.svg'">
                    <span class="menu_burger_label">MENU</span>
                </button>
                <div class="menu_wrap">
                    <ul class="menu">
                        <li class="menu_item <?= (isset($_GET['q']) && $_GET['q'] == 'buy-instagram-likes') ? 'active' : ''; ?>"><a href="/buy-instagram-likes" class="menu_item_anchor"><span class="menu_item_label">Buy Instagram Likes</span></a></li>
                        <li class="menu_item <?= (isset($_GET['q']) && $_GET['q'] == 'buy-instagram-followers') ? 'active' : ''; ?>"><a href="/buy-instagram-followers" class="menu_item_anchor"><span class="menu_item_label">Buy Instagram Followers</span></a></li>
                        <li class="menu_item <?= (isset($_GET['q']) && $_GET['q'] == 'buy-instagram-views') ? 'active' : ''; ?>"><a href="/buy-instagram-views" class="menu_item_anchor"><span class="menu_item_label">Buy Instagram Views</span></a></li>
                        <li class="menu_item <?= (isset($_GET['q']) && $_GET['q'] == 'buy-instagram-comments') ? 'active' : ''; ?>"><a href="/buy-instagram-comments" class="menu_item_anchor"><span class="menu_item_label">Buy Instagram Comments</span></a></li>
                        <li class="menu_item <?= (isset($_GET['q']) && $_GET['q'] == 'automatic-instagram-likes') ? 'active' : ''; ?>"><a href="/automatic-instagram-likes" class="menu_item_anchor"><span class="menu_item_label">Automatic Instagram Likes</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<?
$styles['header'] = [
    'rel' => 'stylesheet',
    'href' => '/css/header.css',
];
?>