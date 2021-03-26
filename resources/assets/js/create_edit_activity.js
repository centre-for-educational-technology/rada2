import VueI18n from 'vue-i18n';

const messages = {};
messages[window.Laravel.locale] = _.cloneDeep(window.Laravel.translations);

const i18n = new VueI18n({
    locale: window.Laravel.locale,
    messages: messages
});

// import Autocomplete from '@trevoreyre/autocomplete-vue'

Vue.component('activity-items', require('./components/ActivityItems.vue').default);
// Vue.component('autocomplete', Autocomplete);
Vue.component('autocomplete', require('./components/MultiAutocomplete.vue').default);
Vue.component('instructor-search', require('./components/InstructorSearch.vue').default);
Vue.component('image-upload', require('./components/ImageUpload/Dialog.vue').default);

const activityApp = new Vue({
    i18n,
    el: 'form.activity-create,form.activity-edit',
    mounted() {
        const vm = this;

        vm.baseUrl = window.Laravel.baseUrl;
        vm.apiUrl = window.Laravel.apiUrl;
        vm.canCreateActivityItem = window.Laravel.canCreateActivityItem;

        if (window.Laravel.subjects) {
            vm.subjects = window.Laravel.subjects;
        }

        $(vm.$refs.proximityCheck).on('change', (e) => {
            const isChecked = $(vm.$refs.proximityCheck).prop('checked');
            $(vm.$refs.proximityRadius).prop('disabled', !isChecked);
        });

        $('[data-toggle="tooltip"]').tooltip();

        if ( !$(vm.$refs.proximityCheck).prop('checked') ) {
            $(vm.$refs.proximityRadius).prop('disabled', true);
        }
    },
    data() {
        return {
            baseUrl: '/',
            apiUrl: '/api',
            subjects: [],
            canCreateActivityItem: false
        };
    },
    methods: {
        subjectSearch (input) {
            if (input.length < 1) { return [] }
            return this.subjects.filter(subject => {
                return subject.toLowerCase()
                    .startsWith(input.toLowerCase())
            })
        }
    }
});

$('#edit-activity-item').on('submit', function () {
    $('.submit-loading-text').removeClass('hidden');
});

$('.keywords-input').tagsinput({
    trimValue: true
});
$('.keywords-input').parent().find('.bootstrap-tagsinput input').on('keyup', function(event) {
    if(event.keyCode == 188) {
        var self = $(this);
        setTimeout(function () {
            self.val('');
        }, 100);
    }
});
$(document).ready(function() {
    $(document).on('keypress', ':input:not(textarea):not([type=submit])', function(e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
});
