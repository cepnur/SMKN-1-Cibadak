<template>
  <div class="lg:flex lg:items-center justify-between bg-[#005858] ">
    <nav
      class="
        container
        px-5
        xl:px-3
        py-3 md:py-8 lg:py-8 xl:py-8
        mx-auto
        lg:flex lg:justify-between lg:items-center 
      "
    >
      <div class=" flex items-center justify-between ">
        <router-link
          to="/home"
          class="
            
            text-xl
            text-gray-100
            md:sm
            hover:text-[#0DC0C0]
            flex
            gap-3
            items-center
          "
          >
          <img src="logo.png" alt="">
          <p>SMK1 Cibadak</p>
        </router-link>
        <!-- Mobile menu button -->
        <div @click="toggleNav" class="flex lg:hidden">
          <button
            type="button"
            class="
              text-gray-100
              hover:text-gray-400
              focus:outline-none focus:text-gray-400
            "
          >
            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
              <path
                fill-rule="evenodd"
                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
              ></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
      <ul
        :class="showMenu ? 'flex' : 'hidden'"
        class=" 
         
          flex-col
          mt-8
          space-y-4
          lg:flex lg:space-y-0 lg:flex-row lg:items-center lg:space-x-5 lg:mt-0
        "
      >
        <li class="text-gray-100 hover:text-[#0DC0C0] " v-for="(item, index) in navbar" :key="index">
            <a :href="item.url">{{item.title}}</a>
        </li>
        <li><img src="search.svg" alt="search"></li>
        <li><a href="/contactus" class="py-2 px-5 bg-[#0DC0C0] rounded-lg text-white">Contact Us</a></li>
        
       
      </ul>
    </nav>
  </div>
</template>

<script>
import {ref} from 'vue';
export default {
    data() {
        let showMenu = ref(false);
        const toggleNav = () => (showMenu.value = !showMenu.value);
        return {
            showMenu, toggleNav,
            navbar : [
                {
                    title : 'Home',
                    url : '/home',
                },
                {
                    title : 'About',
                    url : '/about',
                },
                {
                    title : 'Study Program',
                    url : '/programstudy',
                },
                {
                    title : 'Student Data',
                    url : '/Dasis',
                },
                {
                    title : 'Organisation',
                    url : '/organisation',
                },
                {
                    title : 'Info',
                    url : '/Info',
                },
                {
                    title : 'News',
                    url : '/News',
                },
                {
                    image : 'search.svg',
                },
            ]
        };
    },
    
};
</script>

<style>

</style>