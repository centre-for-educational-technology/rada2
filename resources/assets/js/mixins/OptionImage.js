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
        imageSelected(event, index) {
            if ( !this.hasFiles(event) ) return;

            if ( !this.isValidImageFormat(event.target.files[0]) ) {
                this.resetImageFileInput(event);
                this.resetOptionImage(index);
                alert(this.$t('image-format-hint'));
                return;
            }

            this.options[index].image = event.target.files[0].name;
            this.options[index].imagePreview = false;
            this.options[index].imageSelected = true;

            const element = this.getImageInputElement(index);

            this.$nextTick(() => {
                if ( element.data && element.data('original-title') ) {
                    element
                        .attr('data-original-title', element.attr('title'))
                        .removeAttr('title')
                        .tooltip('show');
                } else {
                    element.attr('data-original-title', this.options[index].image);
                    element.attr('title', this.options[index].image);
                }
            });
        },
        canRemoveSelectedImage(index) {
            return !!this.options[index].imageSelected;
        },
        removeSelectedImage(index) {
            if ( this.canRemoveSelectedImage(index) ) {
                const option = this.options[index];

                if ( option.image_url ) {
                    option.image = option.image_url.split('/').pop();
                    option.imagePreview = true;
                } else {
                    option.image = '';
                }
                option.imageSelected = false;
                
                $(this.$refs['option-image'][index]).val('');

                const element = this.getImageInputElement(index);

                this.$nextTick(() => {
                    if ( option.image )
                    {
                        element.attr('data-original-title', option.image);
                    } else {
                        element.attr('title', '');
                        element.attr('data-original-title', '');
                    }
                });
            }
        },
        canRemoveImage(index) {
            return !!this.options[index].image_url && !this.canRemoveSelectedImage(index);
        },
        removeImage(index) {
            if ( this.canRemoveImage(index) ) {
                $(this.$refs['removed-option-images'][index]).trigger('click');

            }
        },
        hasImageRemoved(index) {
            return this.removedImages.indexOf(this.options[index].id) !== -1;
        }
    }
};
