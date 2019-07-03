const VueI18n = require('vue-i18n');
Vue.use(VueI18n);
Vue.config.lang = window.Laravel.locale;
Vue.locale(window.Laravel.locale, _.cloneDeep(window.Laravel.translations));

import Autocomplete from '@trevoreyre/autocomplete-vue'

Vue.component('activity-items', require('./components/ActivityItems.vue'));
Vue.component('autocomplete', Autocomplete);

const activityApp = new Vue({
    el: 'form.activity-create,form.activity-edit',
    mounted() {
        const vm = this;

        vm.baseUrl = window.Laravel.baseUrl;
        vm.apiUrl = window.Laravel.apiUrl;
        vm.canCreateActivityItem = window.Laravel.canCreateActivityItem;
        if ( window.Laravel.hasFeaturedImage ) {
            vm.hasFeaturedImage = true;
        }

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

        $(vm.$refs.featuredImage).on('change', (e) => {
            this.canResetFeaturedImage = true;
        });
    },
    data() {
        return {
            baseUrl: '/',
            apiUrl: '/api',
            canCreateActivityItem: false,
            canResetFeaturedImage: false,
            hasFeaturedImage: false,
            subjects: []
        };
    },
    methods: {
        subjectSearch (input) {
            if (input.length < 1) { return [] }
            return this.subjects.filter(subject => {
                return subject.toLowerCase()
                    .startsWith(input.toLowerCase())
            })
        },
        resetFeaturedImage(e) {
            e.preventDefault();

            if ( !$(this.$refs.featuredImage).val() ) return;

            this.canResetFeaturedImage = false;
            $(this.$refs.featuredImage).val('');
        },
        canRemoveFeaturedImage() {
            return !this.hasFeaturedImage || this.canResetFeaturedImage;
        }
    }
});

$('[name="featured_image"]').on('change', function () {
    var self = $(this);
    var input = self.get(0);
    if (input.files && input.files[0]) {
        if (self.parent().parent().find('.help-block').length > 0) {
            var loadingText = self.parent().parent().find('.help-block').data('loading-text');
            self.parent().parent().find('.help-block').prepend(
                $('<div>').addClass('alert alert-info loading-text').html(loadingText)
            );
        }
        var reader = new FileReader();
        reader.onload = function(e) {
            if (self.parent().parent().find('.help-block .sz-uploaded-image-preview').length <= 0) {
                self.parent().parent().find('.help-block').prepend(
                    $('<img>').addClass('img-rounded pull-left sz-uploaded-image-preview').attr('alt', 'image')
                );
            }
            self.parent().parent().find('.help-block .sz-uploaded-image-preview').attr('src', e.target.result);
            self.parent().parent().find('.help-block .alert.loading-text').remove();
        }

        reader.readAsDataURL(input.files[0]);
    }
});

$('#edit-activity-item').on('submit', function () {
    $('.submit-loading-text').removeClass('hidden');
});