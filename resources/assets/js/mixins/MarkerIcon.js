export default {
    methods: {
        getIconsBaseUrl() {
            return this.baseUrl + '/img/map/icons/';
        },
        getIconUrl(state) {
            return this.getIconsBaseUrl() + ( ( state !== 'active' ) ? state : 'default' ) + '.svg';
        }
    }
};
