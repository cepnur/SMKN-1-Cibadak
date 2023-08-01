<template>
  <div>
    <Hero :title="title" :subtitle="subtitle" />
  </div>
  <div class="container py-20 px-5 xl:px-0 lg:px-0">
    <div class="flex flex-col gap-4">
      <p class="font-bold">Categories</p>
      <div class="flex justify-between">
        <div class="border flex justify-between gap-20 px-5 p-4 rounded-lg">
          <button class="flex items-center font-bold text-[#005858]">Filter</button>
          <img :src="this.$settings.imagesPublic + '/fil.svg'" alt="" />
        </div>
      </div>
    </div>

    <div class="pt-20">
      <div class="flex flex-col">
        <Jabatan :class="right" />
      </div>
    </div>
  </div>
</template>

<script>
import Jabatan from "../Components/Jabatan.vue";
export default {
  components: {
    Jabatan,
  },
  data() {
    return {
      title: "Organisation",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",

      image: {
        image1: this.$settings.imagesPublic + "/Group1.png",
        image2: this.$settings.imagesPublic + "/group1.2.png",
      },
      jabatans: [
        {
          title: "Nama",
        },
        {
          title: "Tempat Tanggal Lahir",
        },
        {
          title: "Alamat Lengkap",
        },
        {
          title: "Jabatan",
        },
        {
          title: "Mata Pembelajaran",
        },
      ],
    };
  },
};
</script>

<style></style>
