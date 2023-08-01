<template>
  <div>
    <Hero :title="title" :subtitle="subtitle" />
  </div>
  <div>
    <Data :tablehead="pagedata.tablehead" :tablebody="pagedata.tablebody" />
  </div>
</template>

<script>
import Data from "../Components/Data.vue";
export default {
  props: ["pagedata"],
  components: {
    Data,
  },
  data() {
    return {
      title: "Student Data",
      subtitle: "Lörem ipsum emfoni ose. Kärrtorpa nek eftersom ong. Intrasamma ultrader sädåse.",
    };
  },
};
</script>

<style></style>
