<template>
    <div v-bind:style="{ direction } " class=" antialiased leading-normal tracking-normal text-sm " id="main-body">
        <DarkModeSwitcher v-on:toogle-side-menu =  "toogleSideMenu" />
        <MobileMenu />
        
        <div class="flex text-text-500 dark:text-textdark-500 bg-background-500 dark:bg-backgrounddark-500">
            <!-- Side Bar -->
            <Sidebar class=" h-screen"/>

            <!-- Main Content -->
            <div class="flex-grow "  id="main-content">
            
                <!-- <div class="w-full bg-gray-100 pl-0  min-h-screen" :class="isSideMenuOpen ? 'overlay lg:pl-64 ' : ''" id="main-content"> -->
                <Navbar :isSideMenuOpen =  "isSideMenuOpen" v-on:toogle-side-menu =  "toogleSideMenu" >
                    <template #navbar> 
                        <slot name="navbar" />
                    </template>
                </Navbar>

                <!-- Page Heading -->
                <header class="  ">
                    <!-- <div class="max-w-7xl mx-auto py-3 px-5 sm:px-3 lg:px-5 "> -->
                        <slot name="header"></slot>
                    <!-- </div> -->
                </header>

                <!-- Page Content -->
                <main class="">
                    <slot></slot>
                </main>

                <!-- Modal Portal -->
                <portal-target name="modal" multiple>
                </portal-target>

            </div>
        </div>
    </div>
</template>

<script>
    import Sidebar from './Sidebar'
    import Navbar from './Navbar'
    import Footer from './Footer'
    import DarkModeSwitcher from './DarkModeSwitcher'
    import $ from "cash-dom";
    import MobileMenu from "./MobileMenu";
    
    export default {
        components: {
            
            Sidebar,
            Navbar,
            Footer,
            DarkModeSwitcher,
            MobileMenu
    
        },
        mounted() {
            
            this.setDarkModeClass();
            
        },
        // computed() {
        //     mobileMenu() {
        //         return direction;   
        //     }
		// },
        // watch() {
        //     dir : mobileMenu()
        // },
        data() {
            return {
                showingNavigationDropdown: false,
                isSideMenuOpen : false,
                direction: "rtl"
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },

            toogleSideMenu () {
                this.isSideMenuOpen = !this.isSideMenuOpen;
                
               if(this.direction == 'ltr') {
                //    document.body.style.direction = "rtl";// direction = "ltr";
                   this.direction = "rtl";
                   console.log('toggle rtl');
                }else {
                //    document.body.style.direction = "ltr";
                   this.direction = "ltr";
                   console.log('toggle ltr');
                }
             
            },
            setDarkModeClass() {
                console.log('lskdf');
                console.log(this.$page.isDarkMode );
                this.$store.dispatch("main/setDarkMode", this.$page.isDarkMode);
                this.$page.isDarkMode
                    ? $("html").addClass("dark")
                    : $("html").removeClass("dark");

                if(this.$page.isDarkMode) {
                //    document.body.style.direction = "rtl";// direction = "ltr";
                   this.direction = "rtl";
                }else {
                //    document.body.style.direction = "ltr";
                   this.direction = "ltr";
                }
                
            }
        },
       
        computed: {
            path() {
                return window.location.pathname
            }
        }
    }
</script>
