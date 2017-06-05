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
                                    <img class="media-object" alt="icon" style="width:30px;height:30px;" v-bind:src="getIconUrl(icon)">
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
                    <!--
                    <h3>{{ $t('activity-type') }}</h3>
                    <p>
                        {{ activity.type }}
                    </p>
                    -->
                    <h4>{{ $t('number-of-questions') }}</h4>
                    <p>{{ activity.questions.length }}</p>
                    <h4>{{ $t('difficulty-level') }}</h4>
                    <p>
                        {{ activity.difficulty_level_start }} - {{ activity.difficulty_level_end }}
                    </p>
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
                    <p>
                        <img v-bind:src="activity.featured_image" alt="featured-image" class="img-responsive center-block">
                    </p>
                    <!--
                    <h3>{{ $t('zoo') }}</h3>
                    <p>
                        {{ activity.zoo }}
                    </p>
                    -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg center-block sz-go-btn" v-on:click="close()">{{ $t('go')}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['activity'],
        mounted() {
            this.baseUrl = window.SmartZoos.config.base_url;
        },
        data() {
            return {
                icons: ['active', 'inactive', 'correct', 'incorrect'],
                baseUrl: ''
            };
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
            getIconUrl(type) {
                return this.baseUrl + '/img/map/icons/' + ( ( type !== 'active' ) ? type : 'default' ) + '.svg';
            },
            getIconText(type) {
                return this.$t('icons.' + type);
            }
        }
    }
</script>
