<template>
  <div ref="modal" class="modal fade" tabindex="-1" role="dialog" v-on:click.self="close()" @keyup.esc="close()">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" v-on:click="close()" v-bind:diabled="inAjaxCall"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">
          </h4>
        </div>
        <div class="modal-body">
          <div v-for="result in results">
            <div class="response-info">
              <i class="mdi mdi-account-box-outline response-user-image" aria-hidden="true"></i>
              <div class="response-data">
                <div class="response-user-name">
                  <strong>{{ result.name }}</strong>
                </div>
                <div class="response-date">{{ formatDate(result.updated_at) }}</div>
              </div>
            </div>

            <div v-if="result.answer" class="textual-answer well well-sm">{{ result.answer.text }}</div>
            <img :src="result.image_url" alt="photo-answer-image" v-if="result.image_url" class="well img-responsive center-block">
          </div>

          <div class="text-center" v-if="nextUrl">
            <button
                type="button"
                :class="{ 'btn btn-default': true, 'animated infinite flash': inAjaxCall }"
                @click="onLoadMoreClicked()"
                v-bind:disabled="inAjaxCall"
            >
              {{ $t('load-more') }}
            </button>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" v-on:click="close()" v-bind:disabled="inAjaxCall" v-bind:title="$t('close')">
            <i class="mdi mdi-close"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PreviousAnswersModal",
  props: ['baseUrl', 'question', 'activity', 'gameId'],
  data() {
    return {
      inAjaxCall: false,
      search: '',
      totalResults: 0,
      results: [],
      nextUrl: ''
    };
  },
  methods: {
    open() {
      $(this.$refs.modal).modal('show');
      // TODO Need to start loading with a callback
      this.loadData(false);
    },
    close() {
      $(this.$refs.modal).one('hidden.bs.modal', () => {
        this.$parent.$emit('previous-answers-modal-closed');
      });
      $(this.$refs.modal).modal('hide');
    },
    loadData(append) {
      const vm = this;
      let url = `${this.baseUrl}/api/games/${this.gameId}/${this.question.id}/public_answers`;

      if (append) {
        url = this.nextUrl;
      }

      vm.inAjaxCall = true;

      return this.$http.get(url).then(response => {
        vm.inAjaxCall = false;
        vm.totalResults = response.body.total;
        vm.nextUrl = response.body.next;

        if (append) {
          vm.results.push(..._.clone(response.body.results));
        } else {
          vm.results = _.clone(response.body.results);
        }
      }, () => {
        vm.inAjaxCall = false;
      });
    },
    onLoadMoreClicked() {
      this.loadData(true);
    },
    formatDate(dateTime) {
      const date = new Date(dateTime);

      return `${date.getDate().toString().padStart(2, '0')}/${(date.getMonth() + 1).toString().padStart(2, '0')}/${date.getFullYear()}`;
    }
  }
}
</script>

<style scoped>
.textual-answer {
  white-space: pre-line;
}

.response-info {
  display: table-row;
}

.response-info .response-user-image,
.response-info .response-data {
  display: table-cell;
  vertical-align: middle;
}

.response-info .response-user-image::before {
  font-size: 400%;
}
</style>