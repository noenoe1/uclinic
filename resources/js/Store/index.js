import Vuex from "vuex";
import Vue from "vue";
import main from "./main";
import sideMenu from "./side-menu";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    main: main,
    sideMenu: sideMenu
  }
});