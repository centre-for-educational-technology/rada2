import VueI18n from 'vue-i18n';

const messages = {};
messages[window.Laravel.locale] = _.cloneDeep(window.Laravel.translations);

const i18n = new VueI18n({
    locale: window.Laravel.locale,
    messages: messages
});

Vue.component('previous-answers-modal', require('./components/PreviousAnswersModal.vue').default);

const showSingleOrListActivityItems = new Vue({
    i18n,
    el: '#show-single-or-list-activity-items',
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();

        this.baseUrl = window.Laravel.baseUrl;
    },
    data() {
        return {
            question: null,
            baseUrl: null
        };
    },
    computed: {
        endpointUrl() {
            return `${this.baseUrl}/api/activity_items/${this.question.id}/public_answers`;
        }
    },
    methods: {
        onShowPreviousAnswers(question) {
            this.question = question;

            this.$nextTick(() => {
                this.$refs.previousAnswersModal.open();
            });
        }
    }
});
