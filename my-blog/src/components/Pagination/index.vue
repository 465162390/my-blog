<!-- 分页 -->
<template>
  <el-pagination
    background
    layout="total, sizes, prev, pager, next"
    :total="total"
    :page-sizes="[10, 20, 50]"
    :page-size="pagesize"
    :current-page="page"
    @size-change="handleSizeChange"
    @current-change="handleCurrentChange"
  ></el-pagination>
</template>

<script>
export default {
  name: "Pagination",
  data() {
    return {};
  },
  props: {
    page: {
      type: Number,
    },
    pagesize: {
      type: Number,
    },
    total: {
      type: Number,
    },
  },
  created() {},

  components: {},

  computed: {},

  methods: {
    handleSizeChange(val) {
      this.$emit("handleSizeChange", val);
    },
    handleCurrentChange(val) {
      this.$emit("handleCurrentChange", val);
    },
  }
};
</script>
<style scoped>
.el-pagination {
  font-weight: 500;
}
</style>