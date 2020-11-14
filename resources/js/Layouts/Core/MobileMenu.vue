<template>
	<!-- BEGIN: Mobile Menu -->
	<div class="mobile-menu sm:hidden block w-full sm:w-24 lg:w-64 bg-background-700 dark:bg-backgrounddark-700 scrolling-auto text-textdark-500">
		<div class="mobile-menu-bar">
			<div class="flex items-center justify-between">
				<div class="flex px-4 items-center py-5 mt-2">
					<AppIcon name="hexagonMultiple" class="h-6 w-6 fill-current text-primary-500 sm:ml-4" />
					<p class="font-semibold text-lg text-primary-500 pl-2">PS Buy & Sell</p>
				</div> 

				<div @click="toggleMobileMenu">
					<AppIcon name="menu" class="mx-5"  />
				</div>
			</div>
		</div>
		<transition @enter="enter" @leave="leave">
			<ul v-if="activeMobileMenu" class="border-t border-theme-24 py-5">
				<!-- First Child -->
				<template v-for="(menu, menuKey) in formattedMenu">
					<li
					v-if="menu == 'devider'"
					:key="menuKey"
					class="side-nav__devider my-6"
					></li>
					<li v-else :key="menuKey">
					<a
						href="javascript:;"
						class="flex py-4 hover:bg-background-900 pl-4"
						@click="linkTo(menu)">
						<div class="mx-2">
							<AppIcon v-bind:name="menu.icon" :class="{ 'text-primary-500': menu.active }" />
						</div>
						<div class="flex-grow flex justify-between" :class="{ 'text-primary-500': menu.active}" >
							<div >{{ menu.title }}</div>
							<AppIcon name="downArrow" v-if="$h.isset(menu.subMenu)" class='text-white mx-2' :class="{ 'transform rotate-180 ': menu.activeDropdown , 'text-primary-500': menu.active}"  />
						</div>
					</a>
					<!-- BEGIN: Second Child -->
					<transition @enter="enter" @leave="leave"> 
						<ul v-if="$h.isset(menu.subMenu) && menu.activeDropdown" class="lg:mx-2 rounded-lg bg-background-900">
						<li
							v-for="(subMenu, subMenuKey) in menu.subMenu"
							:key="subMenuKey"
						>
						<a
							href="javascript:;"
							class="flex py-4 px-2 justify-start  hover:bg-backgrounddark-700 pl-4 lg:pl:0"                      
							@click="linkTo(subMenu)">
								<div class="mx-2">
									<AppIcon name="rhombusMedium" class='text-white' :class="{ 'text-primary-500': subMenu.active}"/>
								</div>
								<div class="flex-grow flex justify-between" :class="{ 'text-primary-500': subMenu.active}">
									<div >{{ subMenu.title }}</div>
									<AppIcon name="downArrow" v-if="$h.isset(subMenu.subMenu)" class='text-white  ' :class="{ 'transform rotate-180': subMenu.activeDropdown, 'text-primary-500': menu.active }" />
								</div>
						</a>
							
						<!-- BEGIN: Third Child -->
						<transition @enter="enter" @leave="leave">  
							<ul
							v-if="
								$h.isset(subMenu.subMenu) && subMenu.activeDropdown" class="rounded-lg bg-backgrounddark-900">
							<li
								v-for="(lastSubMenu,
								lastSubMenuKey) in subMenu.subMenu"
								:key="lastSubMenuKey">
								<a 
									href="javascript:;"
									class="flex py-6 px-2 hover:bg-backgrounddark-700  pl-4 lg:pl:0"
									@click="linkTo(lastSubMenu)">
									<div class="mx-2">
										<AppIcon name="rhombusMediumOutline" class='text-white' :class="{ 'text-primary-500': subMenu.active}"/>
									</div>
									<div class="" :class="{ 'text-primary-500': subMenu.active}">
										<div class="">{{ lastSubMenu.title }}</div>
									</div>
								</a>
							</li>
							</ul>
						</transition>
						<!-- END: Third Child -->
						</li>
						</ul>
					</transition>
					<!-- END: Second Child -->
					</li>
				</template>
				<!-- END: First Child -->
			</ul>
		</transition>
	</div>
	<!-- END: Mobile Menu -->
</template>

<script>
import Velocity from "velocity-animate";
import ArrowDownIcon from "./../Components/Icons/ArrowDownIcon";
import AppIcon from "./../Components/Icons/AppIcon";
import Border from "./../Components/Borders/Border";


export default {

  components: {    
		ArrowDownIcon,
		AppIcon,
		Border
	},
	data() {
		return {
			formattedMenu: [],
			activeMobileMenu: false
		};
	},
	computed: {
		mobileMenu() {
			console.log(this.nestedMenu(this.$store.state.sideMenu.menu));
			return this.nestedMenu(this.$store.state.sideMenu.menu);
		}
	},
	watch: {
		$route() {
		  this.formattedMenu = this.$h.assign(this.mobileMenu);
		}
	},
	mounted() {
		this.formattedMenu = this.$h.assign(this.mobileMenu);
	},
	methods: {
		toggleMobileMenu() {
			this.activeMobileMenu = !this.activeMobileMenu;
		},
		nestedMenu(menu) {
			menu.forEach((item, key) => {
				if (typeof item !== "string") {
				menu[key].active =
					(route().current(item.pageName)
					|| (this.$h.isset(item.subMenu) &&
						this.findActiveMenu(item.subMenu))) &&
					!item.ignore;
				}

				if (this.$h.isset(item.subMenu)) {
				menu[key].activeDropdown = this.findActiveMenu(item.subMenu);
				menu[key] = {
					...item,
					...this.nestedMenu(item.subMenu)
				};
				}
			});

			return menu;
		},
		findActiveMenu(subMenu) {
			let match = false;
			subMenu.forEach(item => {
				if (route().current(item.pageName)
				&& !item.ignore) {
				match = true;
				} else if (!match &&  this.$h.isset(item.subMenu)) {
				match = this.findActiveMenu(item.subMenu);
				}
			});
			return match;
		},
		linkTo(menu) {
			if (this.$h.isset(menu.subMenu)) {
				menu.activeDropdown = !menu.activeDropdown;
			} else {
				this.activeMobileMenu = false;
				this.$inertia.visit(route(menu.pageName));
				
			}
		},
		enter(el, done) {
			Velocity(
				el,
				"slideDown",
				{
				duration: 300
				},
				{
				complete: done
				}
			);
		},
		leave(el, done) {
			Velocity(
				el,
				"slideUp",
				{
				duration: 300
				},
				{
				complete: done
				}
			);
		}
	}
};
</script>
