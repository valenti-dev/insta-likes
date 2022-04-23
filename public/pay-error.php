<?
$page_class = 'contact_page';
$title = 'Contact Us';
$description = '';
?>
<? include '../assets/php/head.php'; ?>
<section class="pay_status_sect">
    <div class="wrap">
        <div class="row1">
            <img class="icon" alt="" src="/img/pay_status_sect/error.svg">
        </div>
        <h1 class="row2">payment error</h1>
        <div class="row3">
            For now, we have not received your payment. But it may come to our account with time. Please check your email address for a letter saying whether we have received your payment. After this, your order will be realized according to its description. If not - please, write to our support. Thank you for staying witth us!
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