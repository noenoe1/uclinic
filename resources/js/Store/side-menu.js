const state = () => {
  return {
    menu: [
      {
        icon: "dashboard",
        pageName: "dashboard",
        title: "Dashboard"
      },
      {
        icon: "apps",
        pageName: "products",
        title: "Features",
        subMenu: [
          
          {
            icon: "",
            pageName: "services.list",
            title: "Services",
            ignore: false
          },
          {
            icon: "",
            pageName: "departments.list",
            title: "Department",
            ignore: false
          },
          {
            icon: "",
            pageName: "blogs.list",
            title: "Blog",
            ignore: false
          },
          {
            icon: "",
            pageName: "abouts.view",
            title: "About Us",
            ignore: false
          },
         
        ]
      },
      {
        icon: "dashboard",
        pageName: "teams.create",
        title: "Another Feature"
      }      
    ]
  };
};

// getters
const getters = {
  menu: state => state.menu
};

// actions
const actions = {};

// mutations
const mutations = {};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
