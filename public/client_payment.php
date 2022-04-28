<?
$page_class = 'contact_page';
$title = 'Contact Us';
$description = '';
?>
<? include '../assets/php/head.php'; ?>
<section class="pay_status_sect">
    <div class="wrap">
        <div class="row1">
            <img class="icon" alt="" src="/img/pay_status_sect/success.svg">
        </div>
        <h1 class="row2">thanks for purchase</h1>
        <div class="row3">
            We will fulfilling your order according to its
            descriprion. If there will be any problems, we will
            e-mail you.
        </div>
        <div class="row4">
            <butt href="/">Home page</butt>
        </div>
    </div>
</section>
<?
$styles['pay_status_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/pay_status_sect.css',
];
?>
<? include '../assets/php/foot.php'; ?>