<template>
  <div class="flex flex-col container mx-auto justify-center items-center gap-4 pt-10 px-5">
    <h1 class="text-32 font-bold text-center">{{ judul }}</h1>
    <p class="text-[#5A5A5A] text-center">{{ konten }}</p>
    <div class="flex gap-6 container mx-auto justify-center">
      <div class="posts-wrap lg:flex xl:flex gap-6">
        <div v-for="(item, naroto) in vidioLink" :key="naroto" class="post-item">
          <iframe class="pt-5" :src="vidioLink" frameborder="0"></iframe>
        </div>
      </div>
    </div>
    <button class="bg-[#0DC0C0] py-3 px-8 text-center rounded-lg text-white">See More</button>
  </div>
</template>

<script>
export default {
  props: ["judul", "konten", "video"],
  data() {
    return {
      sectioContent: {
        tittle: "Video Terbaru SMKN 1 Cibadak",
        description: "Lörem ipsum mögunde seråpp pos. Faplasade jer och titeck såryledes. e jer och titeck såryledes. ",
      },

      vidioLink: ["https://www.youtube.com/embed/_JZCMNIRXr4", "https://www.youtube.com/embed/_JZCMNIRXr4", "https://www.youtube.com/embed/_JZCMNIRXr4"],
    };
  },
};
</script>

<style></style>
