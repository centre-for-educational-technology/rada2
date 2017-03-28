<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" v-on:keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ activity.title }}</h4>
                </div>
                <div class="modal-body">
                    <h3>{{ $t('description') }}</h3>
                    <p class="sz-display-new-lines">
                        {{ activity.description }}
                    </p>
                    <h3>{{ $t('activity-type') }}</h3>
                    <p>
                        {{ activity.type }}
                    </p>
                    <h3>{{ $t('difficulty-level') }}</h3>
                    <p>
                        {{ activity.difficulty_level_start }} - {{ activity.difficulty_level_end }}
                    </p>
                    <h3>{{ $t('playing-time') }}</h3>
                    <p>
                        {{ activity.playing_time }} {{ $t('minutes') }}
                    </p>
                    <h3>{{ $t('language') }}</h3>
                    <p>
                        {{ activity.language }}
                    </p>
                    <h3 v-if="activity.contact_information">{{ $t('contact-information') }}</h3>
                    <p v-if="activity.contact_information">
                        {{ activity.contact_information }}
                    </p>
                    <h3>{{ $t('featured-image') }}</h3>
                    <p>
                        <img v-bind:src="activity.featured_image" alt="featured-image" class="img-responsive center-block">
                    </p>
                    <h3>{{ $t('zoo') }}</h3>
                    <p>
                        {{ activity.zoo }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="close()">{{ $t('close')}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['activity'],
        mounted() {
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
            }
        }
    }
</script>
