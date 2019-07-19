<template>
    <div class="instructor-search-container">
        <div class="input-group col-xs-12">
            <input v-bind:name="name" type="text" class="form-control" ref="searchInput" />
        </div>
        <div class="col-xs-12 items-container">
            <div class="item" v-for="instructor in instructors">
                <span>{{ instructor.name }}</span>
                <span>{{ instructor.email }}</span>
                <span>{{ instructor.created_at }}</span>
            </div>
        </div>
    </div>
</template>

<script>
    function Instructor(data) {
        const id = data.id;
        const name = data.name;
        const email = data.email;
        const created_at = data.created_at;

        return {
            id: id,
            name: name,
            email: email,
            created_at: created_at
        };
    }

    export default {
        props: ['name', 'activity', 'defaultInstructors'],
        mixins: [],
        mounted() {
            const defaultInstructors = JSON.parse(this.defaultInstructors);
            let defaultInstructorsLength = defaultInstructors.length;
            if (defaultInstructorsLength > 0) {
                for (let i=0; i<defaultInstructorsLength; i++) {
                    let data = defaultInstructors[i];
                    let instructor = new Instructor(data);
                    this.instructors.push(instructor);
                }
            }
        },
        data() {
            return {
                instructors: []
            }
        },
        watch: {},
        methods: {}
    }
</script>

<style scoped>

</style>