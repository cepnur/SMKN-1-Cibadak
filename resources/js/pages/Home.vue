<template>
  <div class="pb-20" v-if="herodata">
    <splide :options="options" class="">
      <splide-slide class="" v-for="(item, index) in herodata" :key="index">
        <img :src="item.image" alt="" class="w-full h-full object-contain" />
        <div class="hero-content py-3 px-5 md:px-6 lg:px-10 xl:px-28 absolute top-14 md:top-1/4 lg:top-1/4 xl:top-1/4 lg:w-3/5 xl:w-3/4">
          <p class="lg:text-sm md:text-sm hidden md:block xl:text-base text-white">{{ item.title }}</p>
          <p class="text-xs md:text-xl lg:text-4xl xl:text-64 xl:leading-normal text-white font-bold">{{ item.sub1 }}</p>
          <p class="text-white text-xs md:text-sm lg:text-base xl:text-base">{{ item.sub2 }}</p>
          <div class="pt-4 md:pt-14 lg:pt-14 xl:pt-14 flex xl:gap-10 lg:gap-10 md:gap-10 gap-2">
            <button class="md:py-3 lg:py-3 py-1 text-xs md:text-sm lg:text-sm xl:text-sm px-1 xl:py-3 md:px-6 lg:px-6 xl:px-6 bg-[#0DC0C0] text-white rounded-lg"><a href="/contacus">Contact Us</a></button>
            <a :href="item.url" class="flex gap-3">
              <img :src="this.$settings.imagesPublic + '/play.svg'" alt="" />
              <p class="text-white py-2">Play Video</p>
            </a>
          </div>
        </div>
      </splide-slide>
    </splide>
    <div class="partner">
      <Partner :judul="pagemetas.judul" :gambar="pagemetas.gambar" :pengumuman="pagemetas.pengumuman" />
    </div>
    <div class="video">
      <Video :judul="pagemetas.judul" :konten="pagemetas.konten" :video="pagemetas.video" />
    </div>
    <div class="pt-20 daftar">
      <Daftarpeserta :juduldaftar="pagemetas.juduldaftar" :konten="pagemetas.konten" :konten1="pagemetas.konten1" />
    </div>
    <div class="pt-20 sambutan">
      <Sambutan :imagesam1="pagemetas.imagesam1" :imagesam2="pagemetas.imagesam2" :samtitle="pagemetas.samtitle" :samsubtitle="pagemetas.samsubtitle" :samnama="pagemetas.samnama" :samgelar="pagemetas.samgelar" />
    </div>
    <div class="guru">
      <Guru :judulguru="pagemetas.judulguru" :titleguru="pagemetas.titleguru" :visibleguru="pagemetas.visibleguru" />
    </div>
    <div class="pt-20 kompetensi">
      <Kompetensi :komimage="pagemetas.komimage" :komtitle="pagemetas.komtitle" :komsub="pagemetas.komsub" :keahlian="pagemetas.keahlian" />
    </div>

    <div class="pt-20 berita">
      <Berita :beritajudul="pagemetas.beritajudul" :beritakonten="pagemetas.beritakonten" :bigkonten="pagemetas.bigkonten" :judultitle="pagemetas.judultitle" />
    </div>
    <div class="pt-20 motivasi">
      <Motivasi :motivasi="pagemetas.motivasi" />
    </div>
    <div class="pt-20 gallery">
      <Gallery :judulgallery="pagemetas.judulgallery" :titlegallery="pagemetas.titlegallery" :gambargallery="pagemetas.gambargallery" />
    </div>
  </div>
</template>

<script>
import Daftarpeserta from "../Components/Daftarpeserta.vue";
import Sambutan from "../Components/Sambutan.vue";
import Kompetensi from "../Components/Kompetensi.vue";
import Berita from "../Components/Berita.vue";
import Guru from "../Components/Guru.vue";
import Motivasi from "../Components/Motivasi.vue";
import Gallery from "../Components/Gallery.vue";
import "@splidejs/splide/dist/css/themes/splide-default.min.css";
import { Splide, SplideSlide } from "@splidejs/vue-splide";
import Partner from "../Components/VuePartner.vue";
import Video from "../Components/VueVideo.vue";
import VueAIcarousel from "vue-ai-carousel";
import "slick-carousel/slick/slick.css"; // Impor CSS Slick Carousel
import "slick-carousel/slick/slick-theme.css"; // Impor tema CSS Slick Carousel
import $ from "jquery"; // Impor jQuery
import "slick-carousel"; // Impor Slick Carousel
export default {
  components: {
    Splide,
    SplideSlide,
    Partner,
    Video,
    Daftarpeserta,
    Sambutan,
    Kompetensi,
    Berita,
    Guru,
    Motivasi,
    Gallery,
    VueAIcarousel,
  },
  props: ["herodata", "pagemetas"],
  data() {
    return {
      kontens: [
        {
          image: this.$settings.imagesPublic + "/bghome.png",
          title: "Go to School",
          sub1: "Welcome To SMKN 1 Cibadak Website",
          sub2: "Lorem, ipsum dolor sit am runmet consectetur adipisicing elit. Nulla sunt magni quos ducimus libero illo!",
          url: "google.com",
        },
        {
          image: this.$settings.imagesPublic + "/bghome.png",
          title: "Go to School",
          sub1: "Welcome To SMKN 1 Cibadak Website",
          sub2: "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla sunt magni quos ducimus libero illo!",
        },
        {
          image: this.$settings.imagesPublic + "/bghome.png",
          title: "Go to School",
          sub1: "Welcome To SMKN 1 Cibadak Website",
          sub2: "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla sunt magni quos ducimus libero illo!",
        },
      ],
      options: {
        rewind: true,
        gap: "1rem",
      },
    };
  },
  methods: {
    animateContent() {
      // Ambil semua elemen yang akan di-animasikan
      const heroContents = document.querySelectorAll(".hero-content");
      const partner = document.querySelectorAll(".partner");
      const video = document.querySelectorAll(".video");
      const daftar = document.querySelectorAll(".daftar");
      const sambutan = document.querySelectorAll(".sambutan");
      const guru = document.querySelectorAll(".guru");
      const kompetensi = document.querySelectorAll(".kompetensi");
      const berita = document.querySelectorAll(".berita");
      const motivasi = document.querySelectorAll(".motivasi");
      const gallery = document.querySelectorAll(".gallery");

      // Fungsi ini akan dipanggil ketika scroll ke elemen yang diberi class fade-in-right
      const callback = (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("fade-in-right");
            observer.unobserve(entry.target); // Hentikan pemantauan setelah animasi dilakukan
          }
        });
      };

      // Buat observer untuk animasi saat elemen muncul di tampilan
      const options = {
        rootMargin: "0px",
        threshold: 0.3, // Ubah nilai threshold sesuai kebutuhan
      };
      const observer = new IntersectionObserver(callback, options);

      // Observasi setiap elemen yang akan di-animasikan
      heroContents.forEach((content) => {
        observer.observe(content);
      });
      partner.forEach((content) => {
        observer.observe(content);
      });
      video.forEach((content) => {
        observer.observe(content);
      });
      daftar.forEach((content) => {
        observer.observe(content);
      });
      sambutan.forEach((content) => {
        observer.observe(content);
      });
      guru.forEach((content) => {
        observer.observe(content);
      });
      kompetensi.forEach((content) => {
        observer.observe(content);
      });
      berita.forEach((content) => {
        observer.observe(content);
      });
      motivasi.forEach((content) => {
        observer.observe(content);
      });
      gallery.forEach((content) => {
        observer.observe(content);
      });
    },
  },

  mounted() {
    // Panggil fungsi animateContent setelah komponen dimuat
    this.animateContent();
  },
};
</script>

<style>
.hero-content,
.partner,
.video,
.daftar,
.sambutan,
.guru,
.kompetensi,
.berita,
.motivasi,
.gallery {
  opacity: 0; /* Awalnya atur ke opasitas 0 */
  transform: translateX(50px); /* Geser 50px ke arah kanan */
  transition: opacity 1s ease, transform 1s ease;
}

/* Animasi untuk menampilkan konten saat masuk tampilan */
.fade-in-right {
  opacity: 1;
  transform: translateX(0);
}
</style>
