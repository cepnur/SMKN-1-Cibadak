<template v-if="term">
  <div>
    <Loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true" />
    <div class="bg-primary text-white py-4 font-bold text-center">{{ term.name }}</div>
    <table class="table-fixed items-center w-full regulation-table">
      <thead>
        <tr>
          <th class="col-1 py-2 px-3">Tanggal Dikeluarkan</th>
          <th class="col-2 py-2 px-3">File</th>
        </tr>
      </thead>
      <tbody class="items-center text-base ml-2">
        <template v-if="regulations">
          <tr v-for="post in regulations" :key="post">
            <td class="py-2 px-3">{{ post.meta_field.download_setting.tanggal_di_keluarkan ?? "" }}</td>
            <td class="py-2 px-3 text-primary text-left">
              <a
                v-if="post.meta_field && post.meta_field.download_setting"
                :href="post.meta_field.download_setting.download_from === 'upload' ? post.meta_field.download_setting.file.url : post.meta_field.download_setting.download_from_url"
                class="link-download"
                :download="post.meta_field.download_setting.download_from === 'upload' ? post.title : 'false'"
                >{{ post.title }}</a
              >
            </td>
          </tr>
        </template>
      </tbody>
    </table>

    <div class="flex justify-center items-center pt-10" v-if="pagination && pagination.next_page">
      <button @click="loadRegulationPosts" class="bg-[#005046] rounded-xl py-3 px-4 text-sm text-white hover:bg-green-800 hover:text-white min-w-[100px] text-center">View More</button>
    </div>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/css/index.css";
import dateFormat from "dateformat";
export default {
  name: "Regulations",
  props: ["posts", "pagination", "term"],
  components: {
    Loading,
  },
  data() {
    return {
      isLoading: false,
      currentPage: 1,
      nextPage: false,
      regulations: [],
    };
  },
  created() {},
  mounted() {
    this.currentPage = this.pagination.current_page ?? 1;
    this.nextPage = this.pagination.next_page;
    this.regulations = this.posts ?? [];
  },
  methods: {
    customdate(tempdate) {
      let postDate = new Date(tempdate);
      return dateFormat(postDate, "mmmm dd, yyyy");
    },
    loadRegulationPosts() {
      this.isLoading = true;
      let formData = {
        paged: this.currentPage + 1,
        term: this.term.slug,
      };
      this.$api.Posts.fetchPostRegulations(formData).then((result) => {
        this.isLoading = false;
        if (result.status == 200) {
          this.regulations.push(...result.data.posts);
          this.currentPage = result.data.pagination.current_page ?? 1;
          this.nextPage = result.data.pagination.next_page;
        }
      });
    },
  },
};
</script>
<style lang="scss">
table.regulation-table {
  thead {
    tr {
      @apply border-b border-b-[#EAEAEA];
      th {
        @apply font-normal text-start paragraph;
      }
      .col-1 {
        @apply w-2/6;
      }
      .col-2 {
        @apply w-4/6;
      }
    }
  }
  tbody {
    tr {
      @apply border-b border-b-[#EAEAEA];
    }
  }
}
</style>
