<template>
  <div class="bg-[#E7F9F9]">
    <div class="container mx-auto px-5 lg:px-4 xl:px-0">
      <div class="py-24">
        <p class="text-[40px] font-bold">{{ title }}</p>
        <p class="text-[#969696] pt-4">{{ subtitle }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    subtitle: {
      type: String,
      required: true,
    },
  },
};
</script>

<style></style>
