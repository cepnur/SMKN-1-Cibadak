<template>
   <ul class="pagination">
    <li
      v-for="page in totalPages"
      :key="page"
      :class="{ 'bg-[#005858] text-white': page === currentPage, '': page !== currentPage }"
      @click="changePage(page)"
    >
      {{ page }}
    </li>
  </ul>
</template>

<script>
export default {
  props: {
    currentPage: {
      type: Number,
      required: true
    },
    totalPages: {
      type: Number,
      required: true
    }
  },
  methods: {
    changePage(page) {
      // Memanggil event untuk mengubah halaman
      this.$emit('page-changed', page);
    }
  }
}
</script>

<style>
.pagination {
  list-style: none;
  display: flex;
  justify-content: center;
}
.pagination li {
  cursor: pointer;
  margin: 0 5px;
  width: 30px;
  height: 30px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}
.pagination li.bg-blue-500 {
  color: white;
}
.pagination li.bg-gray-300 {
  color: white;
}

</style>