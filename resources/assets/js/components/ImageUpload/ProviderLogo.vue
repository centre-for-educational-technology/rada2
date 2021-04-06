<template>
  <a
      :href="pageUrl"
      target="_blank"
      class="provider-logo"
  >
    <img
        :src="logoUrl"
        alt="provider-logo"
        :style="{ width: (imageWidth ? imageWidth + 'px' : '32px') }"
    >
  </a>
</template>

<script>
export default {
  name: "ProviderLogo",
  props: ['id', 'provider', 'imageWidth'],
  computed: {
    pageUrl() {
      if (this.provider === 'ajapaik') {
        return 'https://ajapaik.ee/photo/' + this.id;
      } else if (this.provider === 'cultural-monuments-registry') {
        // TODO This has to be changed
        return window.Laravel.baseUrl + '/img/logos/cultural-monuments-registry.png';
      }

      return '';
    },
    logoUrl() {
      if (this.provider === 'ajapaik') {
        return 'https://ajapaik.ee/static/images/ajapaik_266px.7d65ad54a95f.png';
      } else if (this.provider === 'cultural-monuments-registry') {
        return window.Laravel.baseUrl + '/img/logos/cultural-monuments-registry.png';
      }

      return '';
    }
  }
}
</script>