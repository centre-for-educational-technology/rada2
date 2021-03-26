<template>
  <div>
    <div class="image-upload-input">
      <a
          href="#"
          @click.prevent="open()"
      >
        {{ $t('image-upload.input-text') }}
      </a>
      <div>
        <img
            :src="previewUrl ? previewUrl : imageUrl"
            class="img-rounded sz-uploaded-image-preview"
            alt="image-preview"
            v-if="imageUrl || previewUrl">
        <a
            :href="'https://ajapaik.ee/photo/' + (photoData.id ? photoData.id : image.custom_properties.provider.id)"
            target="_blank"
            class="provider-logo"
            v-if="showAjapaikLogo()"
        >
          <img
              src="https://ajapaik.ee/static/images/ajapaik_266px.7d65ad54a95f.png"
              alt="ajapaik-logo"
          >
        </a>
        <input type="checkbox"
               :name="removeInputName"
               data-toggle="tooltip"
               data-placement="top"
               data-trigger="hover"
               data-container="body"
               :title="$t('image-upload.remove-image')"
               class="remove-existing-image"
               :disabled="!canRemoveUploadedImage"
               v-if="imageUrl"
        >
        <button
            class="btn btn-warning"
            type="button"
            @click.prevent="onRemoveSelectedImage()"
            v-if="previewUrl"
        >
          {{ $t('image-upload.buttons.remove-selected-image') }}
        </button>
      </div>
      <input
          type="hidden"
          :name="photoIdInputName"
          :value="photoData.id"
          v-if="photoData.id">
      <input
          type="hidden"
          :name="photoProviderInputName"
          :value="photoData.provider"
          v-if="photoData.provider">
    </div>

    <div
        ref="modal"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        v-on:click.self="close()"
        @keyup.esc="close()"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button
                type="button"
                class="close"
                aria-label="Close"
                v-on:click="close()"
                v-bind:diabled="inAjaxCall"
            >
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <ul class="nav nav-pills">
              <li
                  role="presentation"
                  v-for="(tab, index) in tabs"
                  :key="index"
                  :class="{ active: currentTab === tab.key }"
              >
                <a href="#" @click.prevent="onTabSelected(tab)">{{ tab.name }}</a>
              </li>
            </ul>

            <div class="container-fluid">
              <upload-image-select
                  :input-name="inputName"
                  v-show="currentTab === 'upload'"
                  ref="imageUpload"
              ></upload-image-select>
              <ajapaik-image-select
                  :api-url="apiUrl"
                  :locale="locale"
                  v-if="currentTab === 'ajapaik'"
              ></ajapaik-image-select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Dialog',
  components: {
    'upload-image-select': require('./Tabs/Upload.vue').default,
    'ajapaik-image-select': require('./Tabs/Ajapaik.vue').default
  },
  props: ['apiUrl', 'locale', 'inputName', 'image'],
  mounted() {
    const vm = this;

    this.$nextTick(() => {
      $(this.$refs.modal).on('hide.bs.modal', e => {
        if ( vm.inAjaxCall ) {
          e.preventDefault();
        }
      });
    });

    this.$on('ajapaik-image-selected', (id, imageUrl) => {
      this.close();
      this.previewUrl = imageUrl;
      this.photoData.id = id;
      this.photoData.provider = 'ajapaik';
      this.$refs.imageUpload.$emit('remove-selected-image');
    });

    this.$on('image-upload-selected', imageDataUrl => {
      this.previewUrl = imageDataUrl;

      if (this.photoData.id && this.photoData.provider) {
        this.photoData.id = null;
        this.photoData.provider = null;
      }
    });

    this.$on('image-upload-removed', () => {
      this.previewUrl = null;
    });
  },
  data() {
    return {
      isOpen: false,
      inAjaxCall: false,
      tabs: [
        {
          key: 'upload',
          name: this.$t('image-upload.tabs.upload')
        },
        {
          key: 'ajapaik',
          name: 'Ajapaik'
        },
        {
          key: 'cultural-monuments-registry',
          name: this.$t('image-upload.tabs.cultural-monuments-registry')
        }
      ],
      currentTab: 'upload',
      previewUrl: null,
      photoData: {
        id: null,
        provider: null
      }
    };
  },
  computed: {
    photoIdInputName() {
      return this.inputName + '_id';
    },
    photoProviderInputName() {
      return this.inputName + '_provider';
    },
    removeInputName() {
      return 'remove_' + this.inputName;
    },
    canRemoveUploadedImage() {
      return this.imageUrl && !this.previewUrl;
    },
    imageUrl() {
      return this.image ? this.image.url : null;
    }
  },
  methods: {
    open() {
      this.isOpen = true;
      $(this.$refs.modal).modal('show');

      // XXX Need to see if this is really needed
      return $(this.$refs.modal);
    },
    close() {
      this.$nextTick(() => {
        $(this.$refs.modal).modal('hide');

        this.isOpen = false;
      });
    },
    showAjapaikLogo() {
      if (this.previewUrl && this.photoData.id && this.photoData.provider && this.photoData.provider === 'ajapaik') {
        return true;
      } else if (!this.previewUrl && this.image && this.image.custom_properties && this.image.custom_properties.provider && this.image.custom_properties.provider.name === 'ajapaik') {
        return true;
      }

      return false;
    },
    onTabSelected(tab) {
      this.currentTab = tab.key;
    },
    onRemoveSelectedImage() {
      this.previewUrl = null;

      if (this.photoData.id && this.photoData.provider) {
        this.photoData.id = null;
        this.photoData.provider = null;
      }

      this.$refs.imageUpload.$emit('remove-selected-image');
    },
    onRemoveUploadedImage() {
      // TODO Implement me
    }
  }
}
</script>

<style scoped>
.modal .modal-body .nav {
  margin-bottom: 1em;
}

.image-upload-input img.sz-uploaded-image-preview {
  display: inline-block;
}

.image-upload-input a.provider-logo {
  position: absolute;
  left: 0;
  bottom: 0;
}

.image-upload-input a.provider-logo > img {
  width: 32px;
}

.remove-existing-image {
  margin-left: 1em;
}
</style>