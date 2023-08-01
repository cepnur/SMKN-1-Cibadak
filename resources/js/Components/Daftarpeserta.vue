<template>
  <div class="px-5">
    <div class="flex flex-col gap-4 items-center">
      <h1 class="text-32 text-center font-bold">{{ juduldaftar }}</h1>
      <p class="text-center">{{ konten }}</p>
    </div>
    <div class="grid lg:grid-cols-2 xl:grid-cols2-2 gap-4 container mx-auto items-center mt-10">
      <div class="flex flex-col items-center gap-4 border rounded-lg p-8 hover:shadow-xl" v-for="(item, judul) in konten1" :key="judul">
        <img :src="item.image" alt="" />
        <h1 class="text-2xl font-bold text-center">{{ item.title }}</h1>
        <p class="text-center">{{ item.subtitle }}</p>
        <button class="pt-5"><a class="bg-[#0DC0C0] rounded-lg px-6 py-3 text-white hover:text-black hover:bg-[#E7F9F9] border-2" href="">Registration</a></button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["juduldaftar", "konten", "konten1"],
  data() {
    return {
      content: {
        title: "Pendaftaran Peserta Didik",
        sub: "We provide 4 registration paths to choose from:",
      },
      post: [
        {
          image: this.$settings.imagesPublic + "/ppd.svg",
          title: "Jalur Pendidikan (Nilai)",
          subtitle: "We Provide Achievement Paths for students who have excellence in achievement, who will get developments in their achievements",
          url: "",
        },
        {
          image: this.$settings.imagesPublic + "/ppd.svg",
          title: "Jalur Prestasi (Olahraga)",
          subtitle: "We Provide Achievement Paths for students who have excellence in achievement, who will get developments in their achievements",
          url: "",
        },
        {
          image: this.$settings.imagesPublic + "/ppd.svg",
          title: "Jalur Rumah Dekat",
          subtitle: "We Provide Achievement Paths for students who have excellence in achievement, who will get developments in their achievements",
          url: "",
        },
        {
          image: this.$settings.imagesPublic + "/ppd.svg",
          title: "Jalur Prestasi (Olahraga)",
          subtitle: "We Provide Achievement Paths for students who have excellence in achievement, who will get developments in their achievements",
          url: "",
        },
      ],
    };
  },
};
</script>

<style></style>
