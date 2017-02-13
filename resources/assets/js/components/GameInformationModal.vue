<template>
    <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" v-on:keyup.esc="close()">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-label="Close" v-on:click="close()"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ activity.title }}</h4>
                </div>
                <div class="modal-body">
                    <h3>Description</h3>
                    <p class="sz-display-new-lines">
                        {{ activity.description }}
                    </p>
                    <h3>Activity Type</h3>
                    <p>
                        {{ activity.type }}
                    </p>
                    <h3>Difficulty Level</h3>
                    <p>
                        {{ activity.difficulty_level_start }} - {{ activity.difficulty_level_end }}
                    </p>
                    <h3>Playing Time</h3>
                    <p>
                        {{ activity.playing_time }} minutes
                    </p>
                    <h3>Language</h3>
                    <p>
                        {{ activity.language }}
                    </p>
                    <h3>Contact Information</h3>
                    <p>
                        {{ activity.contact_information }}
                    </p>
                    <h3>Featured Image</h3>
                    <p>
                        <img v-bind:src="activity.featured_image" alt="featured-image" class="sz-uploadable-image">
                    </p>
                    <h3>Zoo</h3>
                    <p>
                        {{ activity.zoo }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" v-on:click="close()">Close</button>
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
