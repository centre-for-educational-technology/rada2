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
  props: ['id', 'provider', 'imageWidth', 'externalPageUrl'],
  computed: {
    pageUrl() {
      if (this.externalPageUrl) {
        return this.externalPageUrl;
      } else if (this.provider === 'ajapaik') {
        return 'https://ajapaik.ee/photo/' + this.id;
      } else if (this.provider === 'muinas') {
        return `https://register.muinas.ee/public.php?menuID=photolibrary-cmtype-46&action=view&id=${this.id}&page=1&filter%5Bcmtype%5D=46`
      }

      return '';
    },
    logoUrl() {
      if (this.provider === 'ajapaik' || this.provider === 'muinas') {
        return `${window.Laravel.baseUrl ? window.Laravel.baseUrl : window.RADA.config.base_url}/img/logos/${this.provider}.png`;
      }

      return '';
    }
  }
}
</script>