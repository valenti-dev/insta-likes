import Vue from 'vue';
import butt from '../vue/butt';
import logo from '../vue/logo';
import bannerItems from '../vue/bannerItems';
import processItems from '../vue/processItems';
import question from '../vue/question';
import reviews from '../vue/reviews';
import contactForm from '../vue/contactForm';
import search from '../vue/search';
import sectionsItems from '../vue/sectionsItems';
import pricing from '../vue/pricing';
import orderForm from '../vue/orderForm';
////////////////
window.axios = require('axios').default;
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-IDENTITY-SITE'] = location.hostname;
axios.defaults.baseURL = 'https://core.poprey.com/api/';
var token = localStorage.getItem('token');
if(token) {
    axios.defaults.headers.common['X-IDENTITY-TOKEN'] = token;
}
axios.interceptors.response.use((response) => {
    if(response.headers['x-identity-token']) {
        token = response.headers['x-identity-token'];
        localStorage.setItem('token', token);
        axios.defaults.headers.common['X-IDENTITY-TOKEN'] = token;
    }
    return response;
});
////////////
var app = new Vue({
    el: "#app",
    components: {
        butt,
        logo,
        'banner-items': bannerItems,
        'process-items': processItems,
        question,
        reviews,
        'contact-form': contactForm,
        search,
        'sections-items': sectionsItems,
        pricing,
        'order-form': orderForm,
    },
    data: {
        header: {
            opened: false,
        },
        scrolled: false,
        user_info: {},
        payment: {
            success: null,
        },
        loaded: false,
        recaptcha: {
            site_key: '6Lfln3sfAAAAAHMgAn1KBgWSj1AuA6PVtSv9zFS0',
        },
    },
    mounted() {
        this.loaded = true;
        this.scroll_event();
        window.addEventListener('scroll', this.scroll_event);
        axios.post('user_info.php').then((response) => {
            if(response.data.result === 'Ok') {
                this.user_info = response.data.data;
            }
        });
    },
    methods: {
        scroll_event() {
            this.scrolled = window.pageYOffset;
        },
        go_to_faq() {
            location.href = '/support#faq';
        },
    },
});