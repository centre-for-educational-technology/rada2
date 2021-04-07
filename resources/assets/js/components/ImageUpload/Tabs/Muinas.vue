<template>
  <div class="muinas">
    <a
        href="https://register.muinas.ee/public.php?menuID=photolibraryinfo&action=view&page=fotokogu_info"
        target="_blank"
    >
      <img
          :src="logoUrl"
          alt="muinas-logo"
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
          <img :src="result.image_url" alt="image">
          <div class="caption">
            <h3>{{ result.title }}</h3>
            <p v-if="result.description">{{ result.description }}</p>
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
        {{ $t('load-more')}}
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Muinas',
  props: ['apiUrl', 'baseUrl'],
  mounted() {
    const vm = this;

    this.loadPhotos(null, false);
  },
  computed: {
    logoUrl() {
      return this.baseUrl + '/img/logos/muinas.png';
    }
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
      let url = this.apiUrl + '/muinas/photos';

      if (params) {
        data.params = params;
      }

      if (append) {
        url = this.nextUrl;
      }

      vm.inAjaxCall = true;

      return this.$http.get(url, data).then(response => {
        vm.inAjaxCall = false;
        vm.totalPhotos = response.body.total;
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
    getExternalPageUrl(result) {
      return `https://register.muinas.ee/public.php?menuID=photolibrary-cmtype-46&action=view&id=${result.external_data.id}&page=1&filter%5Bcmtype%5D=46`;
    },
    onAddClicked(result) {
      this.$parent.$emit('muinas-image-selected', result.id, result.image_url, this.getExternalPageUrl(result));
    },
    onDetailsClicked(result) {
      window.open(this.getExternalPageUrl(result), '_blank');
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
.muinas .icon {
  max-width: 120px;
  margin-bottom: 1em;
}

.muinas .form-group {
  margin-left: 0;
  margin-right: 0;
}

.muinas .badge {
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