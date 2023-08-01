<template>
  <div class="container mx-auto flex flex-col items-center px-5">
    <p class="text-32 font-bold">{{ beritajudul }}</p>
    <p class="text-[#969696] text-center">{{ judultitle }}</p>
    <div class="md:flex lg:flex xl:flex gap-4 pt-10 pb-12">
      <div class="relative" v-if="largePost">
        <img class="h-full" :src="bigkonten.beritagambar1" alt="" />
        <div class="absolute flex flex-col bottom-3 px-3 md:px-4 lg:px-8 xl:px-8 gap-3 text-white">
          <p class="text-sm">{{ bigkonten.isiberita }}</p>
          <p class="text-base text-white lg:text-2xl xl:text-2xl font-semibold">{{ bigkonten.konten }}</p>
          <p class="text-sm lg:text-base xl:text-base">{{ bigkonten.tanggal }}</p>
        </div>
      </div>
      <div class="flex flex-col gap-3 md:gap-2 pt-3 md:pt-0 lg:pt-0 xl:pt-0" v-if="beritakonten">
        <div class="flex gap-4" v-for="post in beritakonten" :key="post">
          <img class="w-1/2 md:w-[123px] md:h-[123px] lg:w-[186px] lg:h-[186px] xl:w-[204px] xl:h-[204px]" :src="post.beritagambar" alt="" />
          <div class="flex flex-col gap-1 md:gap-0 lg:gap-3 xl:gap-3 lg:py-2 xl:py-6">
            <p class="text-sm lg:text-lg xl:text-xl font-bold">{{ post.konten }}</p>
            <p class="text-sm text-[#969696]">{{ post.tanggal }}</p>
            <p class="text-sm text-[#969696]">{{ post.title }}</p>
          </div>
        </div>
      </div>
    </div>
    <button><a class="py-3 px-6 text-white bg-[#0DC0C0] rounded-2xl" href="/news">See More</a></button>
  </div>
</template>

<script>
export default {
  props: ["beritajudul", "beritakonten", "bigkonten", "judultitle"],
  data() {
    return {
      posts: [
        {
          image: this.$settings.imagesPublic + "/berita1.png",
          tgl: "September 2, 2022",
          title: "Bully Kerap terjadi di Semua Sekolah",
          sub: "Lörem ipsum mikrolös dongen infodemi. Terapument anteliga deforen laskapet målagisk.",
        },
        {
          subimage: this.$settings.imagesPublic + "/berita2.jpg",
          title1: "Belajar dirumah Ketika Covid-19 Menyebar",
          tgl1: "September 2, 2022",
          sub1: "Lörem ipsum mikrolös dongen infodemi. Terapument anteliga deforen laskapet  ",
        },
        {
          subimage: this.$settings.imagesPublic + "/berita0.jpg",
          title1: "Belajar dirumah Ketika Covid-19 Menyebar",
          tgl1: "September 2, 2022",
          sub1: "Lörem ipsum mikrolös dongen infodemi. Terapument anteliga deforen laskapet  ",
        },
      ],
      judul: {
        title: "Berita Kami",
        sub: "Kami menyediakan beberapa artikel dari kegiatan - kegiatan pembelajaran maupun lorem ipsum donot saas",
      },
      largePost: {},
    };
  },
  mounted() {
    if (this.posts.length > 0) {
      this.largePost = this.posts.shift();
    }
  },
};
</script>

<style></style>
