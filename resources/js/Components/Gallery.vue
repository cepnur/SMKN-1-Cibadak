<template>
  <div class="container mx-auto px-5">
    <div class="flex flex-col items-center">
      <p class="text-32 font-bold">{{ judulgallery }}</p>
      <p class="text-center">{{ titlegallery }}</p>
    </div>
    <div class="md:flex lg:flex xl:flex justify-center pt-10 gap-4">
      <div class="flex md:flex lg:flex xl:flex justify-center" v-for="(item, index) in gambargallery" :key="index">
        <img class="pt-3" :src="item.imagegallery" alt="" />
      </div>
    </div>
    <div class="flex flex-col justify-center pt-10">
      <button><a class="py-3 px-6 text-white bg-[#0DC0C0] rounded-2xl" href="/gallery">See More</a></button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["judulgallery", "titlegallery", "gambargallery"],
  data() {
    return {
      judul: {
        title: "Gallery",
        sub: "Lörem ipsum mögunde seråpp pos. Faplasade jer och titeck såryledes. ",
      },
      gambars: [
        {
          image: this.$settings.imagesPublic + "/gam1.png",
        },
        {
          image: this.$settings.imagesPublic + "/gam2.png",
        },
        {
          image: this.$settings.imagesPublic + "/gam3.png",
        },
      ],
    };
  },
};
</script>

<style></style>
