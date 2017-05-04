export default {
    methods: {
        hasFiles(event) {
            return event.target.files.length > 0;
        },
        resetImageFileInput(event) {
            $(event.target).val('');
        },
        getImageInputElement(index) {
            return $(this.$refs['add-image'][index]);
        },
        resetOptionImage(index) {
            const element = this.getImageInputElement(index);

            this.options[index].image = '';
            this.options[index].imagePreview = false;

            this.$nextTick(() => {
                element.tooltip('destroy');
            });
        },
        imageSelected: function(index) {
            if ( !this.hasFiles(event) ) return;

            if ( !this.isValidImageFormat(event.target.files[0]) ) {
                this.resetImageFileInput(event);
                this.resetOptionImage(index);
                alert(this.$t('image-format-hint'));
                return;
            }

            this.options[index].image = event.target.files[0].name;
            this.options[index].imagePreview = false;

            const element = this.getImageInputElement(index);

            this.$nextTick(() => {
                if ( element.data && element.data('original-title') ) {
                    element
                        .attr('data-original-title', element.attr('title'))
                        .removeAttr('title')
                        .tooltip('show');
                } else {
                    element.tooltip();
                }
            });
        }
    }
};
