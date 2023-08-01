<template>
  <div class="flex flex-col items-center gap-4 pt-6">
    <div class="px-5">
      <h1 class="text-center text-lg text-[#5A5A5A]">{{ title }}</h1>
      <div class="flex gap-8 md:gap-16 lg:gap-16 xl:gap-16 pt-3">
        <div v-for="(item, ind) in gambar" :key="ind" class="transition duration-700 ease-in-out hover:scale-110">
          <img :src="item.image" alt="" />
        </div>
      </div>
    </div>
    <div class="w-full bg-[#E7F9F9]">
      <div class="w-full h-[180px] items-center flex flex-col py-10 md:py-16 lg:py-16 xl:py-16 px-5">
        <h1 class="text-2xl font-bold text-center">{{ pengumuman.judul }}</h1>
        <p class="text-sm text-[#5A5A5A] text-center pt-5">{{ pengumuman.konten }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["judul", "gambar", "pengumuman"],
  data() {
    return {
      pengumuman: {
        judul: "Announcement",
        konten: "Sukseskan BLUD SMKN 1 Cibadak! Bersama-sama membangun SMK, untuk membentuk generasi penerus mandiri, cermat, sigap, siap kerja dan siap usaha",
      },
      title: "Partner Trusted",
      gambar: [
        {
          image: this.$settings.imagesPublic + "/cisko.svg",
        },
        {
          image: this.$settings.imagesPublic + "/iso.svg",
        },
        {
          image: this.$settings.imagesPublic + "/cisko.svg",
        },
        {
          image: this.$settings.imagesPublic + "/bogasari.svg",
        },
        {
          image: this.$settings.imagesPublic + "/cisko.svg",
        },
      ],
    };
  },
};
</script>

<style></style>
