<?
$page_class = 'support_page';
$title = 'Support';
$description = '';
?>
<? include '../assets/php/head.php'; ?>
    <section class="title_sect">
        <div class="wrap">
            <h1 class="row1"><span>Hello!</span></h1>
            <div class="row2">
                How can we help?
            </div>
            <search placeholder="Ask a question or search of keabords" class="row3"></search>
        </div>
    </section>
<?
$styles['title_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/title_sect.css',
];
?>
<section class="sections_sect">
    <div class="wrap">
        <h2 class="row1">Article <span>sections</span></h2>
        <sections-items class="row2">
            <a href="#" class="item">
                <div class="img_wrap">
                    <img alt="" src="/img/sections_sect/img1.svg" class="img">
                </div>
                <div class="text_wrap">
                    <div class="title">
                        FAQ
                    </div>
                    <div class="desc">
                        General questions about our service
                    </div>
                </div>
            </a>
            <a href="#" class="item">
                <div class="img_wrap">
                    <img alt="" src="/img/sections_sect/img2.svg" class="img">
                </div>
                <div class="text_wrap">
                    <div class="title">
                        One time
                    </div>
                    <div class="desc">
                        Questions about our one-time packages
                    </div>
                </div>
            </a>
            <a href="#" class="item">
                <div class="img_wrap">
                    <img alt="" src="/img/sections_sect/img3.svg" class="img">
                </div>
                <div class="text_wrap">
                    <div class="title">
                        Subscription
                    </div>
                    <div class="desc">
                        Questions about our monthly plan packages
                    </div>
                </div>
            </a>
        </sections-items>
    </div>
</section>
<?
$styles['sections_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/sections_sect.css',
];
?>
    <section class="questions_sect" id="faq">
        <div class="wrap">
            <h2 class="row1">
                Promoted <span>articles</span>
            </h2>
            <div class="row2">
                <question>
                    <template v-slot:question>Why do I need an online presence?</template>
                    <template v-slot:answer></template>
                </question>
                <question>
                    <template v-slot:question>Figure Out Who Your Audience Is?</template>
                    <template v-slot:answer></template>
                </question>
                <question>
                    <template v-slot:question>The Power of Instagram?</template>
                    <template v-slot:answer>
                        How did you make verified users with hundreds of thousands of followers to like my picture for such a cheap price? You should increase the prices on premium likes, seriously. I would be willing to pay way more for this service and keep the cheapskates out.”
                    </template>
                </question>
                <question>
                    <template v-slot:question>Focus On Delivering Better Content?</template>
                    <template v-slot:answer></template>
                </question>
                <question>
                    <template v-slot:question>Engage Your Followers and Other Users?</template>
                    <template v-slot:answer></template>
                </question>
                <question>
                    <template v-slot:question>Optimize Your Posts and Your Posting?</template>
                    <template v-slot:answer></template>
                </question>
            </div>
        </div>
    </section>
<?
$styles['questions_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/questions_sect.css',
];
?>
<section class="help_sect">
    <div class="wrap">
        <h2 class="row1">Still <span>need help?</span></h2>
        <div class="row2">
            Don't know what to look for? Have a specific question?
        </div>
        <div class="row3">
            <butt href="/contact">Contact us</butt>
        </div>
    </div>
</section>
<?
$styles['help_sect'] = [
    'rel' => 'stylesheet',
    'href' => '/css/help_sect.css',
];
?>
<? include '../assets/php/foot.php'; ?>