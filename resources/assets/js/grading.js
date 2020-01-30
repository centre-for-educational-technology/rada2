const VueI18n = require('vue-i18n');
Vue.use(VueI18n);
Vue.config.lang = window.Laravel.locale;
Vue.locale(window.Laravel.locale, _.cloneDeep(window.Laravel.translations));

Vue.component('grading-list', require('./components/Grading/GradingList.vue').default);

const activityApp = new Vue({
    el: '#grading-list-container',
    mounted() {
        this.answers = window.Laravel.answers;
    },
    data() {
        return {
            baseUrl: '/',
            answers: []
        }
    },
    methods: {}
});
