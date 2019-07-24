const VueI18n = require('vue-i18n');
Vue.use(VueI18n);
Vue.config.lang = window.Laravel.locale;
Vue.locale(window.Laravel.locale, _.cloneDeep(window.Laravel.translations));

Vue.component('open-game-by-entering-pin-code', require('./components/OpenGameByEnteringPinCode.vue'));

const activityApp = new Vue({
    el: '#sz-quick-play',
    mounted() {},
    data() {
        return {
            baseUrl: '/'
        }
    },
    methods: {}
});
