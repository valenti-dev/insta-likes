<?
$page_class = 'order_page';
$title = 'Order';
$description = '';
$canonical = 'https://'.$_SERVER['SERVER_NAME'].'/order/';
if(!$_GET['plan']) {
    header("Location: /",TRUE,301);
    exit();
}
?>
<? include __DIR__.'/../../assets/php/head.php'; ?>
<section class="order_sect">
    <div class="wrap">
        <order-form :plan='<?= json_encode($_GET['plan']); ?>' service="<?= $_GET['service']; ?>" system="<?= $_GET['system']; ?>" init_step="2" init_email="<?= $_GET['email']; ?>" init_username="<?= $_GET['username']; ?>"></order-form>
    </div>
</section>
<? include __DIR__.'/../../assets/php/foot.php'; ?>