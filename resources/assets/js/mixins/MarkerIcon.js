export default {
    methods: {
        getIconsBaseUrl() {
            return this.baseUrl + '/img/map/icons/';
        },
        getIconUrl(state, type, hasAccessCode) {
            return this.getIconsBaseUrl() +
                ( ( type && type === 1 ) ? 'info_' : '' ) +
                ( ( state !== 'active' ) ? state : 'default' ) +
                ( ( hasAccessCode === true && state === 'inactive' ) ? '_access' : '' ) +
                '.svg';
        }
    }
};
