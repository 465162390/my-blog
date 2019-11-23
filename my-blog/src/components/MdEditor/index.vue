<!-- MdEditor富文本编辑器 -->
<template>
<div>
  <el-upload
    style="display: none"
    action="/img/upload.php"
    list-type="picture-card"
    :before-upload="beforeUpload"
    :http-request="uploadImg"
    :multiple="false">
    <el-button size="small" type="primary" id="uploadImg">点击上传</el-button>
  </el-upload>
  <div id="markdown">
    <textarea v-model="content"></textarea>
  </div>
</div>
</template>

<script>
import $ from "jquery";
import uuid from "uuid/v4";

export default {
  name: "MdEditor",
  data: function() {
    return {
      //最终生成的编辑器
      editor: null,

      //默认选项
      defaultOptions: {
        width: "100%",
        height: "100%",
        // autoHeight : true,
        path: "/static/editor.md/lib/",
        theme: "light",  // 工具栏主题
        previewTheme: "light",  // 预览主题
        editorTheme: "pastel-on-light",   // 编辑主题
        //markdown : md,   //动态设置的markdown文本
        codeFold: true,
        //syncScrolling : false,
        saveHTMLToTextarea: true, // 保存 HTML 到 Textarea
        searchReplace: true,
        watch : false,                // 实时预览
        htmlDecode: "style,script,iframe|on*", // 开启 HTML 标签解析，为了安全性，默认不开启
        previewCodeHighlight: true, // 代码块高亮，默认开启
        emoji: false,  // 表情
        taskList: false,
        tocm: false, // Using [TOCM]
        tex: false, // 开启科学公式TeX语言支持，默认关闭
        flowChart: true, // 开启流程图支持，默认关闭
        sequenceDiagram: true, // 开启时序/序列图支持，默认关闭,
        //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
        //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
        //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
        //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
        //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
        toolbarIcons : function() {
          // return editormd.toolbarModes["simple"]
          return ["undo", "redo", "|", "h1", "h2", "|", "h4", "h5", "|", "list-ul", "list-ol", "|", "bold", "italic", "hr", "|", "watch", "preview", "fullscreen", "|", "img", "quote", "image", "code", "|", "link", "help", "info", "|"]
        },
        // 自定义上传图片icon
        toolbarIconsClass: {
          img: "fa-picture-o"
        },
        // 自定义上传图片方法
        toolbarHandlers: {
          img: function() {            
            document.getElementById("uploadImg").click();
          }
        },
        imageUpload: false,
        imageFormats: ["jpg", "jpeg", "gif", "png"],
        imageUploadURL: "http://localhost:8084/api/img/upload.php",
        uploadCallbackURL: "http://localhost:80/admin/addArticle",
        onload: function() {
          //console.log('onload', this);
          //this.fullscreen();
          //this.unwatch();
          //this.watch().fullscreen();
          // this.setMarkdown("向富文本框插入内容");
          //this.width("100%");
          this.height($(window).height() - 400);
          // this.resize("100%", $(window).height() - 350);
        }
      },
    };
  },

  props: {
    /** 父组件传过来的挂载元素的id **/
    id: {
      type: String,
      default: uuid()
    },
    /** 父组件传过来的选项对象 **/
    options: {
      type: Object
    },
    /** 父组件传过来的文章内容 **/
    content: {
      type: String
    }
  },

  mounted() {
    let vm = this;
    //加载editormd
    vm.editor = editormd(vm.id, vm.getOptions());
  },

  methods: {
    // 异步加载editor.md的js文件，callback是成功后的回调函数
    // requireEditor(callback) {
    //   // let vm = this;
    //   // 引入jq
    //   window.$ = window.jQuery = $;
    //   //异步加载并执行editor.md的js文件
    //   $.getScript("/static/editor.md/editormd.min.js", function(script) {
    //     callback();
    //   });
    //   //加载css
    //   $("head").append($('<link rel="stylesheet" type="text/css" />').attr("href","/static/editor.md/css/editormd.min.css"));
    // },

    // 父组件传过来的editor.md的option覆盖默认的option
    getOptions() {
      return Object.assign(this.defaultOptions, this.options);
    },

    // 限制上传图片格式
    beforeUpload(file) {
      const isJPG = file.type === 'image/jpeg';   // 判断是否为jpg图片
      const isPNG = file.type === 'image/png';    // 判断是否为png图片
      const isLt2M = file.size / 1024 / 1024 < 2;   // 判断大小是否小于2M

      if (!isJPG && !isPNG) {
        alert('上传的图片只能是 JPG/PNG 格式!');
      }
      if (!isLt2M) {
        alert('上传的图片大小不能超过 2MB!');
      }
      return isJPG || isPNG && isLt2M;
    },

    // 卡片图片的上传方式
    uploadImg(file) {
      let img = new FormData();
      img.append('img',file.file);
      this.upload.post('/img/upload.php',img)
        .then( response => {
          this.editor.appendMarkdown("![]("+ response.data.url +")");
          console.log(response.data.url)
      })
    }
  },
};
</script>

<style>
</style>