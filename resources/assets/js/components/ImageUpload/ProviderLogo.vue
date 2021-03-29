<template>
  <a
      :href="'https://ajapaik.ee/photo/' + id"
      target="_blank"
      class="provider-logo"
      v-if="provider === 'ajapaik'"
  >
    <img
        src="https://ajapaik.ee/static/images/ajapaik_266px.7d65ad54a95f.png"
        alt="ajapaik-logo"
        :style="{ width: (imageWidth ? imageWidth + 'px' : '32px') }"
    >
  </a>
</template>

<script>
export default {
  name: "ProviderLogo",
  props: ['id', 'provider', 'imageWidth']
}
</script>