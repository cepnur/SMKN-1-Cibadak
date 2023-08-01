<template>
  <div class="bg-[#E7F9F9] md:h-[900px] lg:h-469 xl:h-469">
    <div class="container mx-auto lg:flex xl:flex gap-6 justify-center py-20 w-full lg:py-20 xl:py-16 px-5">
      <div class="lg:order-2 md:w-full lg:w-3/5 xl:w-3/5">
        <img class="md:w-full py-4" :src="komimage" alt="" />
      </div>
      <div class="flex flex-col w-full lg:gap-2 xl:gap-6">
        <h1 class="font-bold text-32">{{ komtitle }}</h1>
        <p class="text-[#5A5A5A]">{{ komsub }}</p>
        <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-3 text-[#5A5A5A]">
          <div class="" v-for="(item, ahli) in keahlian" :key="ahli">
            <div class="flex gap-2">
              <img class="" :src="item.imagelist" alt="" />
              <p class="">{{ item.listkeahlian }}</p>
            </div>
          </div>
          <div class="" v-for="(item, ind) in komps" :key="ind">
            <div class="flex gap-2">
              <img :src="item.imagelist" alt="" />
              <p>{{ item.listkeahlian }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["komimage", "komtitle", "komsub", "keahlian"],
  data() {
    return {
      kompeten: {
        title: "Kompetensi Keahlian",
        sub: "Lörem ipsum mögunde seråpp pos. Faplasade jer och titeck såryledes. Eurossade gesat. Usoligen. Nåhet exonde rytubel der. ",
      },
      keahlians: [
        {
          cek: this.$settings.imagesPublic + "/check.svg",
          title: "Computer Science Department",
        },
        {
          cek: this.$settings.imagesPublic + "/check.svg",
          title: "Nutritional Sicence Department",
        },
        {
          cek: this.$settings.imagesPublic + "/check.svg",
          title: "Agribusiness Department",
        },
        {
          cek: this.$settings.imagesPublic + "/check.svg",
          title: "Agrotechnology Department",
        },
      ],
      komps: [
        {
          cek1: this.$settings.imagesPublic + "/check.svg",
          title1: "Information Technology Department",
        },
        {
          cek1: this.$settings.imagesPublic + "/check.svg",
          title1: "Fisheries Sciences Department  ",
        },
        {
          cek1: this.$settings.imagesPublic + "/check.svg",
          title1: "Visual Communication Design",
        },
        {
          cek1: this.$settings.imagesPublic + "/check.svg",
          title1: "Islamic Education Department   ",
        },
      ],
      gambar: this.$settings.imagesPublic + "/kompetensi.jpg",
    };
  },
};
</script>

<style></style>
