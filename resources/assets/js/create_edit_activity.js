const VueI18n = require('vue-i18n');
Vue.use(VueI18n);
Vue.config.lang = window.Laravel.locale;
Vue.locale(window.Laravel.locale, _.cloneDeep(window.Laravel.translations));

Vue.component('activity-items', require('./components/ActivityItems.vue'));

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

        $(vm.$refs.difficultyLevelButtons).find('button').on('click', (e) => {
            var buttonElement = $(e.target);
            $(vm.$refs.difficultyLevelButtons).find('button').removeClass('active');
            buttonElement.addClass('active');
            $(vm.$refs.difficultyLevel).val(buttonElement.data('value'));
        });

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
            hasFeaturedImage: false
        };
    },
    methods: {
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
