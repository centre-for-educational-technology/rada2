<template>
    <div class="instructor-search-container">
        <div class="input-group col-xs-12">
            <input type="text" class="form-control" ref="searchInput" @keyup="onSearch" />
            <img v-if="loading === true" class="loading" src="/img/icons/loading.gif" alt="Loading ..." />
            <div class="search-results" ref="searchResults">
                <p v-if="searchResults.length === 0 && query.length > 0 && loading === false && typing === false"
                   class="alert-info no-results">
                    {{ $t('no_results_found') }}
                </p>
                <ul v-if="searchResults.length > 0">
                    <li v-for="searchResult in searchResults"
                        v-bind:data-user-id="searchResult.user_id"
                        @click="onSearchResultClick">
                        <span @click="onSearchResultSpanClick">{{ searchResult.user_id }}</span>
                        <span @click="onSearchResultSpanClick">{{ searchResult.name }}</span>
                        <span @click="onSearchResultSpanClick">{{ searchResult.email }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="instructors.length > 0" class="items-container">
            <div class="item" v-for="instructor in instructors">
                <input type="hidden" v-bind:name="name" v-bind:value="instructor.user_id" />
                <span>{{ instructor.user_id }}</span>
                <span>{{ instructor.name }}</span>
                <span>{{ instructor.email }}</span>
                <span class="pull-right">
                    <button type="button"
                            class="btn btn-danger btn-xs">
                        <i v-bind:data-user-id="instructor.user_id"
                           @click="onInstructorRemoveClick"
                           class="mdi mdi-minus"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    function Instructor(data) {
        const id = parseInt(data.id);
        const user_id = parseInt(data.user_id);
        const name = data.name;
        const email = data.email;
        const created_at = data.created_at;

        return {
            id: id,
            user_id: user_id,
            name: name,
            email: email,
            created_at: created_at
        };
    }

    function SearchResult(data) {
        const user_id = parseInt(data.user_id);
        const name = data.name;
        const email = data.email;

        return {
            user_id: user_id,
            name: name,
            email: email
        };
    }

    export default {
        props: ['name', 'activity', 'defaultInstructors'],
        mixins: [],
        mounted() {
            this.baseUrl = window.RADA.config.base_url;
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
                baseUrl: '',
                instructors: [],
                searchResults: [],
                requestTimer: 0,
                loading: false,
                typing: false,
                query: ''
            }
        },
        watch: {},
        methods: {
            onSearch(evt) {
                this.query = evt.target.value;
                clearTimeout(this.requestTimer);
                this.clearSearchResults();
                this.loading = false;
                this.typing = true;
                this.requestTimer = setTimeout(() => {
                    this.loading = true;
                    this.typing = false;
                    this.findInstructors(searchResults => {
                        this.loading = false;
                        const searchResultsLength = searchResults.length;
                        for (let i=0; i<searchResultsLength; i++) {
                            let data = searchResults[i];
                            let searchResult = new SearchResult(data);
                            if (this.hasInstructor(searchResult.user_id) === false) {
                                this.searchResults.push(searchResult);
                            }
                        }
                    });
                }, 500);
            },
            hasInstructor(userId) {
                return typeof this.instructors.find(instructor => {
                    return instructor.user_id === userId;
                }) !== 'undefined';
            },
            findInstructors(callback) {
                const url = this.baseUrl + '/api/activities/find-instructors';
                const data = {
                    query: this.query
                };
                this.$http.post(url, data).then(response => {
                    callback(response.body);
                }, response => {
                    callback([]);
                    console.log('Error: ' + response);
                });
            },
            onSearchResultClick(evt) {
                const userId = parseInt(evt.target.getAttribute('data-user-id'));
                this.addFoundInstructor(userId);
            },
            onSearchResultSpanClick(evt) {
                const userId = parseInt(evt.target.parentElement.getAttribute('data-user-id'));
                this.addFoundInstructor(userId);
            },
            onInstructorRemoveClick(evt) {
                const userId = parseInt(evt.target.getAttribute('data-user-id'));
                this.instructors = this.instructors.filter(instructor => {
                    return instructor.user_id !== userId;
                });
            },
            addFoundInstructor(userId) {
                const searchResult = this.searchResults.find(result => {
                    return userId === result.user_id;
                });
                if (typeof searchResult !== 'undefined') {
                    const instructor = new Instructor({
                        id: 0,
                        user_id: searchResult.user_id,
                        name: searchResult.name,
                        email: searchResult.email,
                        created_at: '-'
                    });
                    this.instructors.push(instructor);
                    this.clearSearchInput();
                    this.clearSearchResults();
                }
            },
            clearSearchInput() {
                this.$refs.searchInput.value = '';
                this.query = '';
            },
            clearSearchResults() {
                this.searchResults = [];
            }
        }
    }
</script>

<style scoped>
    .search-results {
        position: relative;
        display: block;
    }
    .search-results .alert-info {
        text-align: center;
    }
    .search-results ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .search-results ul li {
        margin: 0;
        padding: 0;
        background: #fff;
        border: 1px solid #ccc;
        border-top: 0;
        cursor: pointer;
    }
    .search-results ul li span {
        padding: 10px;
        display: inline-block;
    }
    .items-container {
        margin-top: 15px;
        border-top: 1px solid #ccc;
    }
    .items-container .item {
        background: #fff;
        border: 1px solid #ccc;
        border-top: 0;
    }
    .items-container .item span {
        padding: 10px;
        display: inline-block;
    }
    .items-container .item span.pull-right {
        position: absolute;
        right: 15px;
    }
    .loading {
        position: absolute;
        right: 3px;
        top: 3px;
        z-index: 20;
    }
</style>