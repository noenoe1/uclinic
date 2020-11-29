// AppIcon.vue
// https://materialdesignicons.com/ 
<template>
  <svg
    class="icon fill-current "
    style="width:20px;height:20px"
    viewBox="0 0 24 24"
  >
    <path :d="path" />
  </svg>
</template>

<script>
import icons from './Icons/Icons.json';

export default {
  name: 'AppIcon',
  props: {
    name: String,
  },
  computed: {
    path() {
      return icons[this.name];
    },
  },
};
</script>