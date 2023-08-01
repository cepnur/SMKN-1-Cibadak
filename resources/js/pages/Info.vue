<template>
  <div>
    <Hero :title="title" :subtitle="subtitle" />
  </div>

  <div class="container mx-auto py-20 px-5 xl:px-0 lg:px-0">
    <div class="flex flex-col gap-4">
      <p class="font-bold">Categories</p>
      <div class="flex justify-between">
        <div class="relative border flex justify-between gap-20 px-6 p-4 rounded-lg" v-click-outside="handleOutsideClick">
          <div class="absolute z-10 top-16 left-0" v-show="statePop">
            <div class="flex rounded-xl font-bold flex-col gap-2 bg-[#E7F9F9] p-5 w-48">
              <a class="hover:text-[#005858]" href="">terbaru</a>
              <a href="">terlama</a>
              <a href="">sering dbaca</a>
            </div>
          </div>
          <button @click="togglePop" class="flex items-center font-bold text-[#005858]">Filter</button>
          <img :src="this.$settings.imagesPublic + '/fil.svg'" alt="" />
        </div>

        <div class="relative">
          <input type="text" v-model="searchQuery" class="py-3 bg-[#F6F6F6] rounded-lg border-none pr-10" placeholder="Search" />
          <button class="">
            <img :src="this.$settings.images + '/src.svg'" alt="" class="absolute top-4 right-3" />
          </button>
        </div>
      </div>
    </div>
    <div class="py-10">
      <div class="flex gap-6">
        <div v-for="(item, index) in contents" :key="index" class="md:relative lg:relative xl:relative w-1/2">
          <a class="flex flex-col" :href="item.url">
            <img class="w-full" :src="item.image" alt="" />
            <div class="md:absolute lg:absolute xl:absolute flex flex-col md:gap-1 lg:gap-4 xl:gap-4 md:text-white lg:text-white xl:text-white md:px-4 px-1 gap-1 lg:px-10 xl:px-10 md:bottom-6 lg:bottom-6 xl:bottom-6">
              <p class="lg:text-2xl xl:text-2xl text-sm font-semibold">{{ item.title }}</p>
              <p class="text-sm">{{ item.date }}</p>
              <p class="text-sm">{{ item.sub }}</p>
            </div>
          </a>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-5 pt-10">
        <div v-for="(item, index) in items" :key="index">
          <a class="lg:flex lg:gap-4 xl:flex xl:gap-4" :href="item.url">
            <img class="md:w-full" :src="item.image" alt="" />
            <div class="flex flex-col gap-1 lg:gap-3 xl:gap-3 pt-2 lg:pt-0 xl:pt-0">
              <p class="lg:text-lg xl:text-lg text-sm font-semibold">{{ item.title }}</p>
              <p class="text-sm text-[#969696]">{{ item.date }}</p>
              <p class="text-sm text-[#969696] lg:pt-2 xl:pt-2">{{ item.sub }}</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      title: "Welcome To The Information",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
      components: {},
      contents: [
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
          title: "Bully Kerap terjadi di Semua Sekolah",
          date: "September 2, 2022",
          sub: "Lörem ipsum mikrolös dongen infodemi. Terapument anteliga deforen laskapet målagisk.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/bully2.jpg",
          title: "Bully Kerap terjadi di Semua Sekolah",
          date: "September 2, 2022",
          sub: "Lörem ipsum mikrolös dongen infodemi. Terapument anteliga deforen laskapet målagisk.",
          url: "/detailnews",
        },
      ],
      items: [
        {
          image: this.$settings.imagesPublic + "/Frame1.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame2.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame3.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame4.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame5.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame6.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame7.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
        {
          image: this.$settings.imagesPublic + "/Frame8.png",
          title: "2022 Indonesia National Figure Skating Championships & Invitational Competition",
          date: "June 17th, 2022",
          sub: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailnews",
        },
      ],

      statePop: false,
      searchQuery: "",
    };
  },
  computed: {
    contents() {
      let filtered = this.contents;

      if (this.searchQuery !== "") {
        filtered = filtered.filter((item) => item.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.sub.toLowerCase().includes(this.searchQuery.toLowerCase()));
      }
      return filtered;
    },
    items() {
      let filtered = this.items;

      if (this.searchQuery !== "") {
        filtered = filtered.filter((item) => item.title.toLowerCase().includes(this.searchQuery.toLowerCase()) || item.sub.toLowerCase().includes(this.searchQuery.toLowerCase()));
      }
      return filtered;
    },
  },
  methods: {
    togglePop() {
      this.statePop = !this.statePop;
    },
    handleOutsideClick() {
      this.statePop = false;
    },
  },
};
</script>
<style></style>
