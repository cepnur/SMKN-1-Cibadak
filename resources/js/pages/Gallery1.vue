<template>
  <div>
    <Hero :title="title" :subtitle="subtitle" />
  </div>

  <div class="py-20 px-5 xl:px-0 lg:px-0">
    <div class="container mx-auto flex flex-col gap-4">
      <p class="font-bold">Categories</p>
      <div class="flex justify-between">
        <div class="relative border flex justify-between gap-20 px-6 p-4 rounded-lg" v-click-outside="handleOutsideClick">
          <div class="absolute z-10 top-16 left-0" v-show="statePop">
            <div class="flex rounded-xl font-bold flex-col gap-2 bg-[#E7F9F9] p-5 w-48">
              <a class="hover:text-[#005858]" @click="sortContents('terbaru')">Terbaru</a>
              <a class="hover:text-[#005858]" @click="sortContents('terlama')">Terlama</a>
              <a class="hover:text-[#005858]" @click="sortContents('banyak')">Sering Dibaca</a>
            </div>
          </div>
          <button @click="togglePop" class="flex items-center font-bold text-[#005858]">Filter</button>
          <img :src="this.$settings.imagesPublic + '/fil.svg'" alt="" />
        </div>

        <div class="relative">
          <input v-model="searchQuery" type="text" class="py-3 bg-[#F6F6F6] rounded-lg border-none lg:pr-10 xl:pr-10" placeholder="Search" />
          <button class="">
            <img :src="this.$settings.images + '/src.svg'" alt="" class="absolute top-4 right-3" />
          </button>
        </div>
      </div>
    </div>
    <!-- Konten data di sini -->
    <div class="container mx-auto py-20 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
      <div v-for="(item, index) in gambar" :key="index">
        <img :src="item.image" alt="" />
      </div>
    </div>

    <Pagination :current-page="currentPage" :total-pages="totalPages" @page-changed="handlePageChange" />
  </div>
</template>

<script>
import Pagination from "../Components/Pagination.vue";
export default {
  components: {
    Pagination,
  },
  data() {
    return {
      title: "Gallery",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
      gambar: [
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
        {
          image: this.$settings.imagesPublic + "/bully1.jpg",
        },
      ],
      statePop: false,
      searchQuery: "",
      currentPage: 1,
      totalPages: 10, // Ganti dengan total halaman yang sesuai dengan data Anda
    };
  },
  methods: {
    togglePop() {
      this.statePop = !this.statePop;
    },
    handleOutsideClick() {
      this.statePop = false;
    },
    sortContents(option) {
      this.sortBy = option;
    },
    handlePageChange(page) {
      // Mengubah halaman saat ini
      this.currentPage = page;

      // Lakukan permintaan data baru atau lakukan manipulasi data sesuai kebutuhan Anda
      // Misalnya, panggil metode untuk mengambil data sesuai halaman yang dipilih
      this.getDataFromServer(page);
    },
    getDataFromServer(page) {
      // Lakukan permintaan data ke server sesuai halaman yang dipilih
      // Implementasikan logika di sini
    },
  },
};
</script>

<style></style>
