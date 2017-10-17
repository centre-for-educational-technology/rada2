export default {
    methods: {
        getIconsBaseUrl() {
            return this.baseUrl + '/img/map/icons/';
        },
        getIconUrl(state, type) {
            return this.getIconsBaseUrl() + ( ( type && type === 1 ) ? 'info_' : '' ) + ( ( state !== 'active' ) ? state : 'default' ) + '.svg';
        }
    }
};
