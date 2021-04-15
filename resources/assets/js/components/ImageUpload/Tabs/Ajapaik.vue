<template>
  <div class="ajapaik">
    <a
        href="https://ajapaik.ee"
        target="_blank"
    >
      <img
          :src="logoUrl"
          alt="ajapaik-logo"
          class="icon">
    </a>

    <div class="form-group">
      <div class="input-group">
        <input
            type="text"
            :placeholder="$t('image-upload.search-text')"
            class="form-control"
            v-model="search"
            @keyup.enter="onSearch()"
            :disabled="inAjaxCall">
        <span class="input-group-addon">
          <a
              href="#"
              class="btn btn-default btn-xs"
              role="button"
              @click.prevent="onSearch()"
              :disabled="inAjaxCall"
          >
            <i class="mdi mdi-image-search" aria-hidden="true"></i>
          </a>
        </span>

      </div>
    </div>

    <span :class="{ badge: true, 'animated infinite flash': inAjaxCall }">{{ $t('image-upload.results')}} {{ totalPhotos }}</span>

    <div class="row">
      <div
          v-for="(result, index) in photos"
          :key="index"
          class="col-sm-6 col-md-4"
      >
        <div class="thumbnail">
          <img :src="result.image" alt="image">
          <div class="caption">
            <h3>{{ getResultTitle(result) }}</h3>
            <p>{{ getResultDescription(result) }}</p>
            <p>
              <a
                  href="#"
                  class="btn btn-primary"
                  role="button"
                  @click.prevent="onAddClicked(result)"
              >
                {{ $t('image-upload.buttons.add') }}
              </a>
              <a
                  href="#"
                  class="btn btn-default"
                  role="button"
                  @click.prevent="onDetailsClicked(result)"
              >
                {{ $t('image-upload.buttons.details') }}
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center" v-if="nextUrl">
      <a
          href="#"
          :class="{ 'btn btn-default': true, 'animated infinite flash': inAjaxCall }"
          role="button"
          @click.prevent="onLoadMoreClicked()"
          :disabled="inAjaxCall"
      >
        {{ $t('buttons.load-more')}}
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Ajapaik',
  props: ['apiUrl', 'locale', 'baseUrl'],
  computed: {
    logoUrl() {
      return this.baseUrl + '/img/logos/ajapaik.png';
    }
  },
  mounted() {
    this.loadPhotos(null, false);
  },
  data() {
    return {
      inAjaxCall: false,
      search: '',
      totalPhotos: 0,
      photos: [],
      nextUrl: ''
    };
  },
  methods: {
    loadPhotos(params, append) {
      const vm = this;
      const data = {};
      let url = this.apiUrl + '/ajapaik/photos';

      if (params) {
        data.params = params;
      }

      if (append) {
        url = this.nextUrl;
      }

      vm.inAjaxCall = true;

      return this.$http.get(url, data).then(response => {
        vm.inAjaxCall = false;
        vm.totalPhotos = response.body.count;
        vm.nextUrl = response.body.next;

        if (append) {
          vm.photos.push(..._.clone(response.body.results));
        } else {
          vm.photos = _.clone(response.body.results);
        }
      }, () => {
        vm.inAjaxCall = false;
      });
    },
    getResultTitle(result) {
      const localeKey = 'title_' + this.locale;

      if (result[localeKey]) {
        return result[localeKey];
      }

      return result.title;
    },
    getResultDescription(result) {
      const localeKey = 'description_' + this.locale;

      if (result[localeKey]) {
        return result[localeKey];
      }

      return result.description;
    },
    onAddClicked(result) {
      this.$parent.$emit('ajapaik-image-selected', result.id, result.image);
    },
    onDetailsClicked(result) {
      window.open('https://ajapaik.ee/photo/' + result.id, '_blank');
    },
    onSearch() {
      this.loadPhotos({
        search: this.search
      }, false);
    },
    onLoadMoreClicked() {
      this.loadPhotos(null, true);
    }
  }
}
</script>

<style scoped>
.ajapaik .icon {
  max-width: 120px;
  margin-bottom: 1em;
}

.ajapaik .form-group {
  margin-left: 0;
  margin-right: 0;
}

.ajapaik .badge {
  margin-bottom: 1em;
}

/* This one is needed for meaningful distribution. Source: https://stackoverflow.com/a/45435596/2704169*/
.row{
  display: flex;
  flex-wrap: wrap;
}
.row>[class="col-sm-6 col-md-4"]{
  display: flex;
  flex-direction: column;
}
</style>