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
        <order-form :init_plan='<?= json_encode($_GET['plan']); ?>' init_service="<?= $_GET['service']; ?>" init_system="<?= $_GET['system']; ?>"></order-form>
    </div>
</section>
<? include __DIR__.'/../../assets/php/foot.php'; ?>