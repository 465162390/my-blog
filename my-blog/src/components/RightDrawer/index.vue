<!-- 右边抽屉 -->
<template>
  <div>
    <el-drawer title="文章列表" :visible.sync="visible" direction="rtl" :before-close="handleClose" size="300px">
      <div class="draw">
        <ul class="title">
          <li v-for="title in titles" :key="title.id">
            <router-link :to="'/article/'+ title.id">
              <span>
                <svg v-if="title.public==false" style="vertical-align: text-top;" t="1582184110620" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1161" width="16" height="16">
                  <path d="M829.6 960.6h-634c-35.9 0-65.8-23.9-65.8-65.8V434.2c0-35.9 29.9-65.8 65.8-65.8h634c35.9 0 65.8 29.9 65.8 65.8v460.5c6 41.9-23.9 65.9-65.8 65.9z m-634-532.3c-5.9 0-5.9 5.9 0 0l-6 466.5c0 6 0 6 6 6h634c6 0 6 0 6-6V434.2c0-6 0-6-6-6h-634z" p-id="1162" fill="#2c2c2c"></path>
                  <path d="M590.4 589.8c0-41.9-41.9-77.8-77.8-77.8-41.9 0-71.8 41.9-71.8 77.8 0 29.9 17.9 59.8 47.8 65.8v107.7c0 12 6 17.9 17.9 17.9h23.9c12 0 17.9-6 17.9-17.9V655.5c24.1-5.9 42.1-35.8 42.1-65.7zM763.8 392.4H704v-89.7c0-101.7-83.7-179.4-179.4-179.4-101.7 0-179.4 83.7-179.4 179.4v89.7h-59.8v-89.7c0-131.6 107.7-239.2 239.2-239.2s239.2 107.7 239.2 239.2v89.7z" p-id="1163" fill="#515151"></path>
                </svg>
                <svg viewBox="0 0 1024 1024" width="15" height="15">
                  <path
                    d="M855.04 21.504H471.04c-214.016 0-388.096 174.08-388.096 388.096v504.32c0 50.176 40.96 91.136 91.136 91.136h384c214.016 0 388.096-174.08 388.096-388.096V112.128c0-50.176-40.96-90.624-91.136-90.624z m29.696 594.944c0 180.224-146.432 326.656-326.656 326.656H174.08c-16.384 0-29.696-13.312-29.696-29.696V409.088c0-180.224 146.432-326.656 326.656-326.656h384c16.384 0 29.696 13.312 29.696 29.696v504.32z"
                    fill="#1296db"
                    p-id="2265"
                  />
                  <path
                    d="M314.88 415.744h144.896c16.896 0 30.72-13.824 30.72-30.72s-13.824-30.72-30.72-30.72H314.88c-16.896 0-30.72 13.824-30.72 30.72s13.824 30.72 30.72 30.72zM659.456 610.304H314.88c-16.896 0-30.72 13.824-30.72 30.72s13.824 30.72 30.72 30.72h344.576c16.896 0 30.72-13.824 30.72-30.72s-13.824-30.72-30.72-30.72z"
                    fill="#1296db"
                  />
                </svg>
                <font style="margin-left: 5px; vertical-align: 3px;">{{title.name}}</font>
              </span>
            </router-link>
          </li>
        </ul>
      </div>
    </el-drawer>
  </div>
</template>

<script>
import { fetchHotArticle } from "@/api/article";
import { fetchOther } from "@/api/article";

export default {
  name: "LeftDrawer",
  data() {
    return {
      visible: this.drawer,
    };
  },

  props: {
    drawer: {
      type: Boolean,
    },
    titles: {
      type: Array,
    }
  },

  watch: {
    drawer(newValue, oldValue) {
      this.visible = newValue;
    }
  },

  created() {},

  components: {},

  computed: {},

  methods: {
    // 抽屉关闭回调
    handleClose(done) {
      this.visible = false;
      let params = {
        visible: false,
        location: "right",
      }
      this.$emit("changeDrawer", params);
      done();
    }
  }
};
</script>
<style scoped>
ul {
  padding: 0;
  list-style: none;
}
a {
  text-decoration: none;
}
.draw {
  margin-top: -10px;
  padding: 0 10px;
}
.title li span {
  display: block;
  border-radius: 5px;
  padding: 8px 0 8px 5px;
  cursor: pointer;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  color: #8590a6;
  font-size: 14px;
}
.title li span:hover {
  color: #40a9ff;
  background: #f0f2f5;
}
</style>

<style>
  .el-drawer__body {
    overflow: auto;
    white-space: normal;
  }
</style>