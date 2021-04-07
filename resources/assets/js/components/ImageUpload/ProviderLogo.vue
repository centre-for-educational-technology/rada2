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
      } else if (this.provider === 'muinas') {
        // TODO This has to be changed
        // `https://register.muinas.ee/public.php?menuID=photolibrary-cmtype-46&action=view&id=${this.id}&page=1&filter%5Bcmtype%5D=46`
        return window.Laravel.baseUrl + '/img/logos/muinas.png';
      }

      return '';
    },
    logoUrl() {
      if (this.provider === 'ajapaik' || this.provider === 'muinas') {
        return `${window.Laravel.baseUrl}/img/logos/${this.provider}.png`;
      }

      return '';
    }
  }
}
</script>