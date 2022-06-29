<?
$page_class = 'order_page';
$title = 'Order';
$description = '';
$canonical = 'https://'.$_SERVER['SERVER_NAME'].'/order/';
if(!$_GET['order']) {
    header("Location: /",TRUE,301);
    exit();
}
?>
<? include __DIR__.'/../../assets/php/head.php'; ?>
<section class="order_sect">
    <div class="wrap">
        <order-form init_step="2" init_order="<?= $_GET['order']; ?>"></order-form>
    </div>
</section>
<? include __DIR__.'/../../assets/php/foot.php'; ?>