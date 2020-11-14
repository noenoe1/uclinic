<template>
  <!-- BEGIN: Dark Mode Switcher-->
  <div
    class="cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border px-3 py-1 rounded-full justify-center z-50 mb-10 mr-10"
    @click="switchMode"
  >
  <div v-if="darkMode" class="text-text-300 dark:text-text-300" >
    <div class="">Light Mode</div>
    <!-- <div
      :class="{ 'dark-mode-switcher__toggle--active': darkMode }"
      class="dark-mode-switcher__toggle border" -->
    <!-- ></div> -->
  </div>
  <div v-else>
    <div >Dark Mode</div>
    <!-- <div
      :class="{ 'dark-mode-switcher__toggle--active': darkMode }"
      class="dark-mode-switcher__toggle border"
    ></div> -->
  </div>
  </div>
  <!-- END: Dark Mode Switcher-->
</template>

<script>
import $ from "cash-dom";

export default {
  computed: {
    darkMode() {
      return this.$store.state.main.darkMode;
    }
  },
  mounted() {
    // if(this.$page.isDarkMode != null && this.darkMode != this.$page.isDarkMode) {
    //   this.$store.dispatch("main/setDarkMode", this.$page.isDarkMode);
    // }
    
    // this.setDarkModeClass();
  },
  methods: {
    

    switchMode() {
        // e.preventDefault();
    //this.$store.dispatch('toggleSidebar')
        this.$emit('toogle-side-menu', 0)
// @click="$emit('toogle-side-menu', 0)"
      this.$store.dispatch("main/setDarkMode", !this.darkMode);
      this.setDarkModeClass();
    },

    setDarkModeClass() {
      this.darkMode
        ? $("html").addClass("dark")
        : $("html").removeClass("dark");
      const params = { isDarkMode: !this.darkMode };
       axios.post(route('common.toggleDarkMode').url(), params).then(response => {
                 console.log(response.data);
                if(response.data != null) {
                  if(response.data != !this.darkMode) {
                    console.log('updated');
                    this.$store.dispatch("main/setDarkMode", response.data);

                    this.darkMode
                      ? $("html").addClass("dark")
                      : $("html").removeClass("dark");
                  }
                }
                 } ).catch(error => console.log(error))

      
    }
  }
};
</script>
