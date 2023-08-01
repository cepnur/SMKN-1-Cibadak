<template>
  <div class="pt-20 relative px-5">
    <div class="flex flex-col items-center">
      <h1 class="text-32 font-bold">{{ judulguru }}</h1>
      <p class="text-[#5A5A5A] text-center">{{ titleguru }}</p>
    </div>
    <splide :options="options" class="relative center">
      <splide-slide class="py-10" v-for="(item, index) in visibleguru" :key="index">
        <div class="container mx-auto flex flex-col gap-2 justify-center">
          <img class="rounded-full" :src="item.imguru" alt="" />
          <p class="text-center">{{ item.titlegambarguru }}</p>
          <p class="text-center">{{ item.subtitleguru }}</p>
        </div>
      </splide-slide>
    </splide>
  </div>
</template>
<script>
import "slick-carousel/slick/slick.css"; // Impor CSS Slick Carousel
import "slick-carousel/slick/slick-theme.css"; // Impor tema CSS Slick Carousel
import $ from "jquery"; // Impor jQuery
import "slick-carousel"; // Impor Slick Carousel

export default {
  props: ["judulguru", "titleguru", "visibleguru"],
  data() {
    return {
      judul: {
        title: "Guru - Guru Kami",
        sub: "Lörem ipsum mögunde seråpp pos. Faplasade jer och titeck ",
      },
      guru: [
        {
          image: this.$settings.imagesPublic + "/guru1.png",
          title: "Iwan S.Pd",
          sub: "Kepala Sekolah",
        },
        {
          image: this.$settings.imagesPublic + "/guru1.png",
          title: "Iwan S.Pd",
          sub: "Kepala Sekolah",
        },
        {
          image: this.$settings.imagesPublic + "/guru1.png",
          title: "Iwan S.Pd",
          sub: "Kepala Sekolah",
        },
        {
          image: this.$settings.imagesPublic + "/guru1.png",
          title: "Iwan S.Pd",
          sub: "Kepala Sekolah",
        },
        {
          image: this.$settings.imagesPublic + "/guru1.png",
          title: "Iwan S.Pd",
          sub: "Kepala Sekolah",
        },
        {
          image: this.$settings.imagesPublic + "/guru1.png",
          title: "Iwan S.Pd",
          sub: "Kepala Sekolah",
        },
      ],
    };
  },
  name: "MyCarousel",
  mounted() {
    this.initSlickCarousel();
  },
  methods: {
    initSlickCarousel() {
      const slickOptions = {
        centerMode: true,
        centerPadding: "60px",
        slidesToShow: 5,
        padding: "2rem",
        arrows: true,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: "40px",
              slidesToShow: 3,
            },
          },
          {
            breakpoint: 480,
            settings: {
              arrows: true,
              centerMode: true,
              centerPadding: "40px",
              slidesToShow: 1,
            },
          },
        ],
      };

      $(".center").slick(slickOptions);
    },
  },
};
</script>

<style>
/* Gaya tambahan yang dibutuhkan oleh Slick Carousel */
</style>
