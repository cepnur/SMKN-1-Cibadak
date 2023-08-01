<template>
  <div>
    <Hero :title="title" :subtitle="subtitle" />
  </div>
  <div class="container mx-auto py-20" v-if="programdata">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-4 px-5 lg:px-0 xl:px-0 gap-y-5">
      <a :href="item.link" v-for="(item, index) in programdata" :key="index" class="bg-[#F6F6F6] items-center flex flex-col p-14 rounded-3xl gap-4 transition duration-700 ease-in-out hover:scale-110">
        <img :src="item.image" alt="" />
        <p class="text-lg font-bold text-center">{{ item.title }}</p>
        <p class="text-sm text-[#969696] text-center">{{ item.titlesub }}</p>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  props: ["programdata"],
  components: {},
  data() {
    return {
      title: "Study Program",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",

      studies: [
        {
          image: this.$settings.imagesPublic + "/pengawasanmutu.svg",
          title: "Agribisnis Mutu Hasil Pertanian / Agriteknologi Pertanian",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
        {
          image: this.$settings.imagesPublic + "/pengolahanhasil.svg",
          title: "Agribisnis Tanaman Pangan dan Holtikultura / Agribisnis Pertanian",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
        {
          image: this.$settings.imagesPublic + "/tanamanpangan.svg",
          title: "Agribisnis Ternak Ruminansia / Agribisnis Ternak",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
        {
          image: this.$settings.imagesPublic + "/ternakunggas.svg",
          title: "Agribisnis Ternak Unggas / Agribisnis Ternak",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
        {
          image: this.$settings.imagesPublic + "/ikantawar.svg",
          title: "Agribisnis Perikanan Air Tawar / Agribisnis Perikanan",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
        {
          image: this.$settings.imagesPublic + "/multimedia.svg",
          title: "Multimedia / Desain Komunikasi Visual",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
        {
          image: this.$settings.imagesPublic + "/agroindustri.svg",
          title: "Agroindustri / Agriteknologi Pertanian",
          subTitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
          url: "/detailprogram",
        },
      ],
    };
  },

  mounted() {
    console.log(this.$settings.images);
  },
};
</script>

<style></style>
