<!-- 新增/修改文章 -->
<template>
  <div>
    <el-form :model="article" class="demo-form-inline" size="small">
      <el-form-item label="标题">
        <el-input v-model="article.title" placeholder="请输入文章标题" clearable></el-input>
      </el-form-item>
      <!-- 标签 -->
      <el-form-item label="标签">
        <el-tag
          :key="index"
          v-for="(tag, index) in newTags"
          :disable-transitions="false"
          :type="tag.type"
          :effect="tag.effect"
          size="small"
          @click="selectTag(index, 'newTags')"
        >{{tag.name}}</el-tag>

        <el-input
          class="input-new-tag"
          v-if="tagVisible"
          v-model="inputValue"
          ref="saveTagInput"
          size="small"
          @keyup.enter.native="handleInputConfirm('tagVisible')"
          @blur="handleInputConfirm('tagVisible')"
        ></el-input>
        <el-button class="button-new-tag" size="small" @click="showInput('tagVisible')">+ New Tag</el-button>
      </el-form-item>

      <!-- 分类 -->
      <el-form-item label="分类">
        <el-tag
          :key="index"
          v-for="(category, index) in newCategories"
          :disable-transitions="false"
          :type="category.type"
          :effect="category.effect"
          size="small"
          @click="selectTag(index, 'newCategories')"
        >{{category.name}}</el-tag>

        <el-input
          class="input-new-tag"
          v-if="categoryVisible"
          v-model="inputValue"
          ref="saveCategoryInput"
          size="small"
          @keyup.enter.native="handleInputConfirm('categoryVisible')"
          @blur="handleInputConfirm('categoryVisible')"
        ></el-input>
        <el-button
          class="button-new-tag"
          size="small"
          @click="showInput('categoryVisible')"
        >+ New Category</el-button>
      </el-form-item>

      <!-- 是否公开 -->
      <el-form-item label="是否公开">
        <el-switch v-model="article.public" @change="editPublic"></el-switch>
      </el-form-item>
    </el-form>

    <!-- 富文本框 -->
    <tui-editor ref="mdeditor" :id="id" :content="article.content" v-if="showMark"/>

    <div class="submit-button">
      <el-button type="primary" @click="submitArticle">提交文章</el-button>
    </div>
  </div>
</template>

<script>
import TuiEditor from "@/components/TuiEditor"
import { addArticle } from '@/api/article'
import { editArticle } from '@/api/article'
import { isNull } from "@/utils/vaildata"
import { Message } from "element-ui"
import { fetchOther } from "@/api/article"
import { fetchDetail } from "@/api/article"

export default {
  name: "EditArticle",
  data() {
    return {
      article: {
        title: "",
        tags: [],
        categories: [],
        content: "",
        public: true,
      },
      id: "markdown",
      newTags: [],
      newCategories: [],
      tagVisible: false,
      categoryVisible: false,
      inputValue: "",
      showMark: false,
      value: "",
      state: "false",  // 该状态用于判断用户修改完是否有提交保存
    };
  },

  created() {
    // 路径有id是修改文章，无id则是新增文章
    if(this.$route.params.id != undefined) {
      fetchDetail({id: this.$route.params.id}).then(response => {
        let { data } = response;
        this.article.title = data.title;
        this.article.public = data.public;
        this.article.content = data.content;
        this.newTags = response.data.tags;
        this.newCategories = response.data.categories;
        this.showMark = true;
      })
    } else {
      // 查询分类和标签数据
      fetchOther().then(response => {
        let { categories, tags } = response.data;
        this.newCategories = categories;
        this.newTags = tags;
      })
      this.showMark = true;
    }
  },

  components: {
    TuiEditor,
  },

  computed: {},

  methods: {
    showInput(type) {
      this[type] = true;
      this.$nextTick(_ => {
        type == "tagVisible"
          ? this.$refs.saveTagInput.$refs.input.focus()
          : this.$refs.saveCategoryInput.$refs.input.focus();
      });
    },

    handleInputConfirm(type) {
      let newTag = {
        name: this.inputValue,
        type: "primary",
        effect: "dark"
      };
      if (this.inputValue) {
        if (type == "tagVisible") {
          this.newTags.push(newTag);
        } else {
          this.newCategories.push(newTag);
        }
      }
      this[type] = false;
      this.inputValue = "";
    },

    // 选择、取消 标签/分类
    selectTag(index, type, e) {
      if (this[type][index].type == "info") {
        this[type][index].type = "primary";
        this[type][index].effect = "dark";
      } else {
        this[type][index].type = "info";
        this[type][index].effect = "plain";
      }
    },

    // 筛选出已选的标签/分类
    isSelect(array, type) {
      array.map((value, index) => {
        if (value.effect == "dark" && value.type == "primary") {
          delete value.type
          delete value.effect
          this.article[type].push(value);
        }
      })
    },

    // 提交文章
    async submitArticle() {
      // refs上的mdeditor里面的editor就是生成的富文本编辑器的实例
      // 将富文本编辑器的html源码保存到数据库中
      // getMarkdown() 获取markdown语法的内容， gerHtml() 获取编辑器html源码
      this.article.content = this.$refs.mdeditor.instance.getMarkdown();

      // 将选择的标签和分类保存到后端
      this.isSelect(this.newCategories, "categories")
      this.isSelect(this.newTags, "tags")
      
      if(!isNull(this.article.title) && !isNull(this.article.content)) {  
        // 有id是修改文章，没有则是新增文章
        let responseData;
        if(this.$route.params.id == undefined) {
          await addArticle(this.article).then( response => {
            responseData = response;
          })
        } else {
          this.article.id = this.$route.params.id
          await editArticle(this.article).then( response => {
            responseData = response;
          })
        }
        Message({
          message: responseData.message,
          type: responseData.type,
          duration: 2000
        });
        responseData.code == 200 ? setTimeout(() => {
          this.state = "true";
          this.$router.push("/admin/articleManage")
        }, 1000) : "";
      } else {
        Message({
          message: "文章题目与文章内容都不能为空!",
          type: "error",
          duration: 2000
        });
      }
    },

    // 修改文章是否公开
    editPublic(status) {
      this.article.public = status;
    },
  },
  beforeRouteLeave (to, from , next) {
    // 离开该页面前如没保存修改的内容，则提示用户
    if(this.state == "true") {
      next();
    } else {
      this.$confirm('文章尚未保存，是否保存修改的内容?', '文章尚未保存', {
        confirmButtonText: '确定保存',
        cancelButtonText: '放弃保存',
        type: 'warning',
        center: true,
        distinguishCancelAndClose: true,
      }).then(() => {
        this.submitArticle();
      }).catch( (action) => {
        action == "cancel" ? next() : next(false);
      });
    }
      
  }
};
</script>

<style scoped>
.el-tag {
  cursor: pointer;
  margin-left: 10px;
}
.button-new-tag {
  margin-left: 10px;
  height: 32px;
  line-height: 30px;
  padding-top: 0;
  padding-bottom: 0;
}
.input-new-tag {
  width: 60px;
  margin-left: 10px;
  vertical-align: bottom;
}
.submit-button {
  margin-top: 10px;
  float: right;
  margin-bottom: 10px;
}
</style>