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
    },
    data() {
        return {
            apiUrl: '/api'
        };
    }
});
