let mix = require('laravel-mix');

mix.js('assets/js/app.js', 'public/js')
    .vue()
    .copyDirectory('assets/img', 'public/img')
    .copyDirectory('assets/fonts', 'public/fonts')
    .options({
        processCssUrls: false,
    })
    .css('assets/css/styles.css', 'public/css')
    .css('assets/css/header.css', 'public/css')
    .css('assets/css/footer.css', 'public/css')
    .css('assets/css/banner_sect.css', 'public/css')
    .css('assets/css/get_started_sect.css', 'public/css')
    .css('assets/css/questions_sect.css', 'public/css')
    .css('assets/css/process_sect.css', 'public/css')
    .css('assets/css/chat_sect.css', 'public/css')
    .css('assets/css/reviews_sect.css', 'public/css')
    .css('assets/css/contact_sect.css', 'public/css')
    .css('assets/css/title_sect.css', 'public/css')
    .css('assets/css/sections_sect.css', 'public/css')
    .css('assets/css/help_sect.css', 'public/css')
    .css('assets/css/text_sect.css', 'public/css')
    .css('assets/css/service_text_sect.css', 'public/css')
    .css('assets/css/articles_sect.css', 'public/css')
    .css('assets/css/article_sect.css', 'public/css')
    .disableNotifications();