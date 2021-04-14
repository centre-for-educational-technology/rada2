<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" v-on:keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">{{ activity.title }}</h4>
                </div>
                <div class="modal-body">
                    <button class="btn btn-default btn-sm pull-right" role="button" data-toggle="collapse" data-target="#iconCodes" aria-expanded="false" aria-controls="iconCodes">
                        <i class="mdi mdi-information-outline"></i>
                    </button>
                    <div class="collapse" id="iconCodes">
                        <div class="well well-sm">
                            <p class="help-block">{{ $t('icons.help') }}</p>
                            <div class="media"  v-for="icon in icons">
                                <div class="media-left media-middle">
                                    <img class="media-object" alt="icon" v-bind:src="getIconUrl(icon)">
                                </div>
                                <div class="media-body">
                                    <p>{{ getIconText(icon) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                    <h3>{{ $t('description') }}</h3>
                    -->
                    <p class="sz-display-new-lines text-center" v-if="activity.description">
                        {{ activity.description }}
                    </p>
                    <p v-if="isPublicPath">
                      {{ $t('public-path-label') }} ({{ $t('public-path-tooltip') }})
                    </p>
                    <!--
                    <h3>{{ $t('activity-type') }}</h3>
                    <p>
                        {{ activity.type }}
                    </p>
                    -->
                    <h4>{{ $t('number-of-questions') }}</h4>
                    <p>{{ activity.questions.length }}</p>
                    <h4>{{ $t('playing-time') }}</h4>
                    <p>
                        {{ activity.playing_time }} {{ $t('minutes') }}
                    </p>
                    <!--
                    <h3>{{ $t('language') }}</h3>
                    <p>
                        {{ activity.language }}
                    </p>
                    -->
                    <!--
                    <h3 v-if="activity.contact_information">{{ $t('contact-information') }}</h3>
                    <p v-if="activity.contact_information">
                        {{ activity.contact_information }}
                    </p>
                    -->
                    <!--
                    <h3>{{ $t('featured-image') }}</h3>
                    -->
                    <p class="text-center">
                        <img v-bind:src="activity.featured_image_url" alt="featured-image" class="img-responsive center-block">
                        <provider-logo
                            :id="activity.featured_image.custom_properties.provider.id"
                            :provider="activity.featured_image.custom_properties.provider.name"
                            :image-width="64"
                            v-if="activity.featured_image && activity.featured_image.custom_properties && activity.featured_image.custom_properties.provider"
                        ></provider-logo>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg center-block sz-go-btn" v-on:click="close()">{{ $t('go')}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MarkerIconMixin from './../mixins/MarkerIcon.js';

    export default {
        components: {
            'provider-logo': require('./ImageUpload/ProviderLogo.vue').default
        },
        props: ['activity'],
        mixins: [MarkerIconMixin],
        mounted() {
            this.baseUrl = window.RADA.config.base_url;
        },
        data() {
            return {
                icons: ['active', 'inactive', 'correct', 'incorrect'],
                baseUrl: ''
            };
        },
        computed: {
            isPublicPath() {
                return !!this.activity.public_path;
            }
        },
        methods: {
            open() {
                this.$nextTick(function() {
                    $(this.$refs.modal).modal('show');
                });
            },
            close() {
                this.$nextTick(function() {
                    $(this.$refs.modal).modal('hide');
                });
            },
            getIconText(type) {
                return this.$t('icons.' + type);
            }
        }
    }
</script>

<style scoped>
a.provider-logo {
  margin-top: 0.25em;
  display: inline-block;
}

img.media-object {
  height: 30px;
  width: 30px;
}
</style>
