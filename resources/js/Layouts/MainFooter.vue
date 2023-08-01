<template>
  <div class="">
    <div class="bg-[#032626] md:h-659 lg:h-659 xl:h-659">
      <div class="container mx-auto px-5 py-10 md:py-5 lg:py-5 xl:py-5">
        <div class="flex gap-4 pt-20">
          <img class="w-14" :src="judul.image" alt="" />
          <p class="text-white text-2xl py-3">{{ judul.title }}</p>
        </div>
        <div class="lg:flex xl:flex lg:gap-10 xl:gap-10">
          <div class="flex gap-3">
            <div class="flex flex-col gap-4 pt-10 md:w-3/12 lg:w-4/12 xl:w-4/12">
              <div class="text-white" v-for="(item, index) in Navigasis" :key="index">
                <p class="font-bold">{{ item.nav }}</p>
                <a :href="item.url"
                  ><p>{{ item.title }}</p></a
                >
              </div>
            </div>
            <div class="flex flex-col gap-4 pt-10">
              <p class="font-bold text-white">Program Study</p>
              <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4 w-full">
                <div class="text-white" v-for="(item, ind) in studis" :key="ind">
                  <div class="">
                    <a href="">
                      <p>{{ item.title }}</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="md:flex lg:flex xl:flex md:gap-7 lg:gap-7 xl:gap-7">
            <div class="flex flex-col gap-4 md:w-7/12 lg:w-fit xl:w-fit">
              <p class="text-white font-bold pt-10">Alamat</p>
              <div class="flex gap-2">
                <p class="w-14 h-14">
                  <img class="" :src="this.$settings.images + '/fot.svg'" alt="" />
                </p>
                <p class="text-white">Jl. Al-Muwahhiddin, Karangtengah, Cibadak, Kab. Sukabumi.Sukabumi 43351</p>
              </div>
            </div>
            <div class="flex flex-col gap-4">
              <p class="text-white font-bold pt-10">Kontak</p>
              <div class="flex gap-3">
                <img :src="this.$settings.images + '/telp.svg'" alt="" />
                <p class="text-white">(0266) 532510</p>
              </div>
              <div class="flex gap-2">
                <img :src="this.$settings.images + '/pesan.svg'" alt="" />
                <p class="text-white">smkn1_cibadak@yahoo.co.id</p>
              </div>
              <div class="flex gap-8">
                <a class="flex gap-8" v-for="(item, index) in logos" :key="index" :src="item.logo" href="">
                  <img class="h-5" alt="" :src="item.logo" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Footer",
  data() {
    return {
      judul: {
        image: this.$settings.imagesPublic + "/logo.png",
        title: "SMKN1 Cibadak",
      },
      Navigasis: [
        {
          nav: "Navigasi",
          url: "null",
        },
        {
          title: "Home",
          url: "/home",
        },
        {
          title: "Info",
          url: "/info",
        },
        {
          title: "Berita",
          url: "/news",
        },
        {
          title: "Tentang Kami",
          url: "/about",
        },
        {
          title: "Kontak",
          url: "/contact",
        },
      ],
      studis: [
        {
          title: "Pengawasan Mutu Hasil Pertanian / Agriteknologi Pertanian",
          url: "/detailprogram",
        },
        {
          title: "Agribisnis Pengolahan Hasil Pertanian / Agriteknologi Pertanian",
          url: "/detailprogram",
        },
        {
          title: "Agribisnis Tanaman Pangan dan Holtikultura / Agribisnis Pertanian",
          url: "/detailprogram",
        },
        {
          title: "Agribisnis Ternak Ruminansia / Agribisnis Ternak",
          url: "/detailprogram",
        },
        {
          title: "Agribisnis Ternak Unggas / Agribisnis Ternak",
          url: "/detailprogram",
        },
        {
          title: "Agribisnis Perikanan Air Tawar / Agribisnis Perikanan",
          url: "/detailprogram",
        },
        {
          title: "Multimedia / Desain Komunikasi Visual",
          url: "/detailprogram",
        },
        {
          title: "Agroindustri / Agriteknologi Pertanian",
          url: "/detailprogram",
        },
      ],
      kontak: {
        telp: "(0266) 532510",
        pesan: "smkn1_cibadak@yahoo.co.id",
      },
      logos: [
        {
          logo: this.$settings.imagesPublic + "/fblogo.svg",
          url: "",
        },
        {
          logo: this.$settings.imagesPublic + "/Twlogo.svg",
          url: "",
        },
        {
          logo: this.$settings.imagesPublic + "/linlogo.svg",
          url: "",
        },
        {
          logo: this.$settings.imagesPublic + "/iglogo.svg",
          url: "",
        },
      ],
    };
  },
  mounted() {
    console.log(this.$settings.images);
  },
};
</script>

<style lang="scss" scoped></style>
