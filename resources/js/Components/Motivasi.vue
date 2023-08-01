<template>
  <div class="bg-[#E7F9F9] h-513 px-5">
    <div class="container mx-auto">
      <splide :options="options">
        <splide-slide v-for="(item, index) in motivasi" :key="index">
          <div class="flex flex-col items-center py-24 gap-3">
            <img :src="item.imagemot" alt="" />
            <p class="text-xl lg:text-40 xl:text-40 font-bold text-center leading-normal">{{ item.titlemot }}</p>
            <p>{{ item.subtitlemot }}</p>
            <p class="text-sm">{{ item.asalmot }}</p>
          </div>
        </splide-slide>
      </splide>
    </div>
  </div>
</template>

<script>
import "@splidejs/splide/dist/css/themes/splide-default.min.css";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
export default {
  props: ["motivasi"],
  components: {
    Splide,
    SplideSlide,
  },
  data() {
    return {
      options: {
        rewind: true,
        gap: "1rem",
        autoplay: true,
        interval: 3000,
      },
      motivasi1: [
        {
          image: this.$settings.imagesPublic + "/john.png",
          title: "“ Pendidikan bukan persiapan untuk hidup, pendidikan adalah kehidupan itu sendiri. “",
          nama: "JOHN DEWEY",
          asal: "American Philosopher",
        },
        {
          image: this.$settings.imagesPublic + "/john.png",
          title: "“ Pendidikan bukan persiapan untuk hidup, pendidikan adalah kehidupan itu sendiri. “",
          nama: "JOHN DEWEY",
          asal: "American Philosopher",
        },
        {
          image: this.$settings.imagesPublic + "/john.png",
          title: "“ Pendidikan bukan persiapan untuk hidup, pendidikan adalah kehidupan itu sendiri. “",
          nama: "JOHN DEWEY",
          asal: "American Philosopher",
        },
      ],
    };
  },
};
</script>

<style></style>
