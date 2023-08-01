<template>
  <div class="bg-[#E7F9F9] h-auto md:h-[670px] lg:h-638 xl:h-638 px-5">
    <div class="container mx-auto md:flex lg:flex xl:flex lg:gap-14 xl:gap-14 pt-24">
      <div class="relative">
        <img class="lg:w-full xl:w-full" :src="imagesam1" alt="" />
        <img class="absolute top-12 left-10 md:left-16 lg:left-16 xl:left-16" :src="imagesam2" alt="" />
      </div>
      <div class="flex flex-col gap-4 md:w-2/5 lg:w-1/2 xl:w-1/2 pt-20 md:pt-10 lg:pt-20 xl:pt-20">
        <p class="font-bold text-lg md:text-32 lg:text-32 xl:text-32 leading-normal">{{ samtitle }}</p>
        <p class="text-[#5A5A5A]">{{ samsubtitle }}</p>
        <p class="font-bold">{{ samnama }}</p>
        <p class="text-sm text-[#5A5A5A]">{{ samgelar }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["imagesam1", "imagesam2", "samtitle", "samsubtitle", "samnama", "samgelar"],
  data() {
    return {
      sambutan: {
        title: "Sambutan Kepala Sekolah SMKN 1 Cibadak",
        subtitle:
          "“ Lörem ipsum astrobel sar direlig. Kronde est konfoni med kelig. Terabel pov por danseoke. Pol peben: heteroska. Röfösade uv. Bijarade ren defagt, mivis pott. Trar visat til. Naturvin Facebookfest så doren, i tera. Ber begyng. Lörem ipsum astrobel sar direlig. Kronde est konfoni med kelig. Terabel pov por danseoke. Pol peben: heteroska. Röfösade uv. Bijarade ren defagt, mivis pott. Trar visat til. Naturvin Facebookfest så doren, i tera. Ber begyng.Lörem ipsum astrobel sar direlig. Kronde est konfoni med kelig. Terabel pov por danseoke. Pol peben: heteroska. Röfösade uv. Bijarade ren defagt, mivis pott. Trar visat til. Naturvin Facebookfest så doren, i tera. Ber begyng.Lörem ipsum astrobel sar direlig. Kronde est konfoni med kelig. Terabel pov por danseoke. Pol peben: heteroska. Röfösade uv. Bijarade ren defagt, mivis pott. Trar visat til. Naturvin Facebookfest så doren, i tera. Ber begyng. “",
        nama: "Bpk. Iwan M.Kom",
        gelar: "Kepala Sekolah",
      },
      foto: {
        image: this.$settings.imagesPublic + "/Group1.png",
        gambar: this.$settings.imagesPublic + "/group1.2.png",
      },
    };
  },
};
</script>

<style></style>
