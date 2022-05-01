<?
$page_class = 'support_page';
$title = 'Expert Support from Our Platform';
$description = 'Get customer support from our online social media marketing platform';
?>
<? include '../assets/php/head.php'; ?>
    <section class="title_sect">
        <div class="wrap">
            <h1 class="row1"><span>Hello!</span></h1>
            <div class="row2">
                How can we help?
            </div>
            <search placeholder="Ask a question or search of keabords" class="row3" @input="go_to_faq"></search>
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
        <h2 class="row1">24/7 <span>SUPPORT</span></h2>
        <sections-items class="row2">
            <a href="#" class="item">
                <div class="img_wrap">
                    <img alt="24/7 SUPPORT" src="/img/sections_sect/img1.svg" class="img">
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
                    <img alt="Likewave Get Followers Support" src="/img/sections_sect/img2.svg" class="img">
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
                    <img alt="Likewave Support" src="/img/sections_sect/img3.svg" class="img">
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
                FAQ
            </h2>
            <div class="row2">
                <question>
                    <template v-slot:question>How can you help me?</template>
                    <template v-slot:answer>
                        Growing a lot of followers takes a lot of effort and even a huge chunk of your day! We understand how complicated and frustrating it can be, and we hear you! Likewave is here to make things easier for you.
                    </template>
                </question>
                <question>
                    <template v-slot:question>How many likes can I buy?</template>
                    <template v-slot:answer>
                        You can choose from 200 to 50000 Instagram likes, from 100 to 50000 Instagram followers, from 200 to 200000 Instagram views, from 25 to 5000 Instagram comments, from 1000 to 500000 auto likes.
                    </template>
                </question>
                <question>
                    <template v-slot:question>I have some questions, what should I do?</template>
                    <template v-slot:answer>
                        Need someone to talk to? Our support team is always happy to help should you have any queries or concerns.<br>
                        We want to make sure that our clients receive the best experience with us! 99.99% of the time we deliver, but if our service is unsatisfactory for you then let us know.
                    </template>
                </question>
                <question>
                    <template v-slot:question>What is Likewave?</template>
                    <template v-slot:answer>
                        A lot of people don’t want to invest so much unnecessary time building their profile. That’s what Likewave is here for! So you’re ready for a monumental change in your social media presence? Don’t get overwhelmed! We’re here to guide you in every step of our super easy process!
                    </template>
                </question>
                <question>
                    <template v-slot:question>How can I buy Instagram followers or likes?</template>
                    <template v-slot:answer>
                        <ol>
                            <li>Choose which package <a href="https://likewave.io/buy-instagram-likes">likes</a>, <a href="https://likewave.io/buy-instagram-followers">followers</a>, <a href="https://likewave.io/buy-instagram-comments">comments</a>, <a href="">views</a>, <a href="https://likewave.io/automatic-instagram-likes">auto-likes</a>.</li>
                            <li>Input your information.</li>
                            <li>
                                Choose our payment gateway and make the payment.
                            </li>
                            <li>
                                Once after checking out, enjoy the result.
                            </li>
                        </ol>
                    </template>
                </question>
                <question>
                    <template v-slot:question>Is it safe for me?</template>
                    <template v-slot:answer>
                        We will ask for your Instagram username and your email, but NEVER your password. This is going to be safe and confidential, we do not share information to third-parties and we respect your privacy!
                    </template>
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