<?
$page_class = 'order_page';
$title = 'Order';
$description = '';
$canonical = 'https://'.$_SERVER['SERVER_NAME'].'/order/';
if(!$_GET['methods']) {
    header("Location: /",TRUE,301);
    exit();
}
?>
<? include __DIR__.'/../../assets/php/head.php'; ?>
<section class="order_sect">
    <div class="wrap">
        <order-form init_step="3" :init_payment_methods='<?= json_encode($_GET['methods']); ?>' init_cost="<?= $_GET['cost']; ?>"></order-form>
    </div>
</section>
<? include __DIR__.'/../../assets/php/foot.php'; ?>