const VueI18n = require('vue-i18n');
Vue.use(VueI18n);
Vue.config.lang = window.Laravel.locale;
Vue.locale(window.Laravel.locale, _.cloneDeep(window.Laravel.translations));

Vue.component('activity-items', require('./components/ActivityItems.vue'));

const activityApp = new Vue({
    el: 'form.activity-create,form.activity-edit',
    mounted() {
        const vm = this;

        vm.apiUrl = window.Laravel.apiUrl;

        $(vm.$refs.difficultyLevel).ionRangeSlider({
            onChange(data) {
                $(vm.$refs.difficultyLevelStart).val(data.from);
                $(vm.$refs.difficultyLevelEnd).val(data.to);
            }
        });

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
            apiUrl: '/api'
        };
    }
});
