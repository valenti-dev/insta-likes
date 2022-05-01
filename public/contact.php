<?
$page_class = 'contact_page';
$title = 'Contact Us - Expert Platform';
$description = 'Ask us if you have any questions. Online social media marketing platform';
?>
<? include '../assets/php/head.php'; ?>
<section class="contact_sect">
    <div class="wrap">
        <h1 class="row1">Contact us</h1>
        <div class="row2">
            Get in touch with us today, we’d love to hear from you!
        </div>
        <contact-form class="row3"></contact-form>
    </div>
</section>
<?
$styles['contact_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/contact_sect.css',
];
?>
<? include '../assets/php/foot.php'; ?>