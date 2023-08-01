<template>
  <div class="lg:flex lg:items-center justify-between bg-[#005858]">
    <nav class="container px-5 lg:px-4 xl:px-0 py-3 md:py-8 lg:py-8 xl:py-8 mx-auto lg:flex lg:justify-between lg:items-center">
      <div class="flex items-center justify-between">
        <a href="/home" class="text-xl text-gray-100 md:sm hover:text-[#0DC0C0] flex gap-3 items-center">
          <img :src="this.$settings.images + '/logo.png'" alt="" />
          <p>SMK1 Cibadak</p>
        </a>
        <!-- Mobile menu button -->
        <div @click="toggleNav" class="flex lg:hidden">
          <button type="button" class="text-gray-100 hover:text-gray-400 focus:outline-none focus:text-gray-400">
            <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
              <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
      <ul :class="showMenu ? 'flex' : 'hidden'" class="flex-col mt-8 space-y-4 lg:flex lg:space-y-0 lg:flex-row lg:items-center lg:space-x-4 xl:space-x-5 lg:mt-0">
        <li class="text-gray-100 hover:text-[#0DC0C0] xl:text-base lg:text-sm" v-for="(item, index) in navbar" :key="index">
          <a :href="item.url">{{ item.title }}</a>
        </li>
        <li class="" v-click-outside="handleOutsideClick">
          <div class="search absolute top-6 right-64 transition duration-150 fade-in-top" v-show="search">
            <input type="text" class="bg-[#0DC0C0] relative w-full py-3 pr-10 px-4 rounded-2xl" /><button type="button" class="px-12">
              <img class="absolute right-3 top-4" :src="this.$settings.images + '/search.svg'" alt="search" />
            </button>
          </div>
          <button type="button" @click="toggleSearch">
            <img :src="this.$settings.images + '/search.svg'" />
          </button>
        </li>
        <li><a href="/contact" class="py-2 px-5 hover:bg-[#E7F9F9] hover:text-black bg-[#0DC0C0] rounded-lg text-white lg:text-sm xl:text-base">Contact Us</a></li>
      </ul>
    </nav>
  </div>
</template>

<script>
import { ref } from "vue";
export default {
  data() {
    let showMenu = ref(false);
    const toggleNav = () => (showMenu.value = !showMenu.value);
    return {
      showMenu,
      toggleNav,
      navbar: [
        {
          title: "Home",
          url: "/home",
        },
        {
          title: "About",
          url: "/about",
        },
        {
          title: "Study Program",
          url: "/study-program",
        },
        {
          title: "Student Data",
          url: "/studentdata",
        },
        {
          title: "Organisation",
          url: "/organisasi",
        },
        {
          title: "Info",
          url: "/info",
        },
        {
          title: "Gallery",
          url: "/gallery1",
        },
        {
          title: "News",
          url: "/news",
        },
        {
          image: "search.svg",
        },
      ],
      search: false,
    };
  },
  methods: {
    toggleSearch() {
      this.search = !this.search;
    },
    handleOutsideClick() {
      this.search = false;
    },
  },

  mounted() {
    console.log(this.$settings.images);
  },
};
</script>

<style></style>
