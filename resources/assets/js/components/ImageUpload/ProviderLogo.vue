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
    providerName() {
      let provider = this.provider;

      if (provider === 'ajapaik_local') {
        provider = 'ajapaik';
      }

      return provider;
    },
    pageUrl() {
      if (this.externalPageUrl) {
        return this.externalPageUrl;
      } else if (this.providerName === 'ajapaik') {
        return 'https://ajapaik.ee/photo/' + this.id;
      } else if (this.providerName === 'muinas') {
        return `https://register.muinas.ee/public.php?menuID=photolibrary-cmtype-46&action=view&id=${this.id}&page=1&filter%5Bcmtype%5D=46`
      }

      return '';
    },
    logoUrl() {
      if (this.providerName === 'ajapaik' || this.providerName === 'muinas') {
        return `${window.Laravel.baseUrl ? window.Laravel.baseUrl : window.RADA.config.base_url}/img/logos/${this.providerName}.png`;
      }

      return '';
    }
  }
}
</script>