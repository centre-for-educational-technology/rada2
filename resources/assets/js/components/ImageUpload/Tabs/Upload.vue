<template>
  <div class="form-group">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="mdi mdi-image" aria-hidden="true"></i>
      </span>
      <input type="file" :name="inputName" class="form-control" accept="image/jpeg, image/png" ref="input">
      <span class="input-group-addon">
        <a href="#" class="btn btn-warning btn-xs" @click.prevent="onRemoveSelectedImage()" :disabled="!hasImageSelected">
          <i class="mdi mdi-delete" aria-hidden="true"></i>
        </a>
      </span>
    </div>

    <p class="help-block">
      {{ $t('image-upload.help') }}
    </p>
  </div>
</template>

<script>
export default {
  name: "Upload",
  props: ['inputName'],
  data() {
    return {
      hasImageSelected: false
    };
  },
  mounted() {
    $(this.$refs.input).on('change', () => {
      const input = this.$refs.input;

      if (input && input.files[0]) {
        this.hasImageSelected = true;
        const reader = new FileReader();

        reader.onload = (e) => {
          this.$parent.$emit('image-upload-selected', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    });

    this.$on('remove-selected-image', () => {
      this.removeSelectedImage();
    });
  },
  methods: {
    removeSelectedImage() {
      if ( !$(this.$refs.input).val() ) return false;

      $(this.$refs.input).val('');
      this.hasImageSelected = false;

      return true;
    },
    onRemoveSelectedImage() {
      if (this.removeSelectedImage()) {
        this.$parent.$emit('image-upload-removed');
      }
    }
  }
}
</script>

<style scoped>

</style>