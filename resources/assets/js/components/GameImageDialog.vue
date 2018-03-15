<template>
    <div class="sz-image-dialog" v-on:click="close()" ref="dialog">
        <div class="sz-image-dialog-backdrop"></div>
        <img alt="image" ref="image" v-bind:src="imageUrl()" class="animated">
    </div>
</template>

<script>
    export default {
        props: ['baseUrl', 'image', 'inAnimationClass', 'outAnimationClass'],
        methods: {
            open() {
                const vm = this;

                vm.$emit('show:image:dialog');

                vm.$nextTick(() => {
                    $(vm.$refs.image).removeClass(vm.outAnimationClass).addClass(vm.inAnimationClass);
                    $(vm.$refs.dialog).show(0, () => {
                        vm.$emit('shown:image:dialog');
                        vm.timeoutId = setTimeout(() => {
                            vm.close();
                        }, 5000);
                    });
                });
            },
            close() {
                const vm = this;

                if ( vm.timeoutId ) {
                    clearTimeout(vm.timeoutId);
                    vm.timeoutId = null;
                }

                vm.$emit('hide:image:dialog');

                vm.$nextTick(() => {
                    $(vm.$refs.image).removeClass(vm.inAnimationClass).addClass(vm.outAnimationClass);
                    setTimeout(() => {
                        $(vm.$refs.dialog).hide(0, () => {
                            vm.$emit('hidden:image:dialog');
                        });
                    }, 1000);
                });
            },
            imageUrl() {
                return this.baseUrl + '/img/dialogs/' + this.image;
            }
        }
    }
</script>
