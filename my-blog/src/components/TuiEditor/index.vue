<!-- tui-editor 富文本编辑器 -->
<template>
  <div>
    <!-- 自定义的上传图片方式 -->
    <el-upload
      style="display: none"
      action="/img/upload.php"
      list-type="picture-card"
      :before-upload="beforeUpload"
      :http-request="uploadImg"
      :multiple="false">
      <el-button size="small" type="primary" id="uploadImg">点击上传</el-button>
    </el-upload>

    <div id="tuiEditor" ref="tuiEditor" v-highlight></div>
  </div>
</template>

<script>
import { upload } from '@/api/upload'

export default {
  name: 'TuiEditor',
  data () {
    return {};
  },

  created() {},

  props: {
    /** 父组件传过来的挂载元素的id **/
    id: {
      type: String,
    },
    /** 父组件传过来的文章内容 **/
    content: {
      type: String
    }
  },

  components: {},

  mounted() {
    let vm = this
    vm.instance = new tui.Editor({
      el: document.querySelector('#tuiEditor'),
      initialEditType: 'markdown',
      previewStyle: 'vertical',
      height: 'auto',
      minHeight: '400px',
      language: 'zh',
      toolbarItems: [
        'heading',
        'bold',
        'italic',
        'strike',
        'divider',
        'hr',
        'quote',
        'divider',
        'ul',
        'ol',
        'image',
        'indent',
        'outdent',
        'divider',
        'table',
        'link',
        'divider',
        'code',
        'codeblock',
      ],
    });

    this.instance.getCodeMirror().replaceSelection(this.content);

    // 自定义工具栏上的上传图片
    let toolbar = vm.instance.getUI().getToolbar();
    vm.instance.eventManager.addEventType('upload');
    vm.instance.eventManager.listen('upload', function() {
      document.getElementById("uploadImg").click();
    });
    toolbar.addButton({
      type: 'button',
      name: 'Img',
      event: 'upload',
      tooltip: '上传图片',
      $el: $(
        '<button>' +
        '<svg t="1575275125219" style="margin-top: -1px; margin-left: -1.5px" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1776" width="17" height="17">' +
        '<path d="M818.17 825.846H206.92c-39.813 0-72.208-32.39-72.208-72.208V270.7c0-39.814 32.39-72.208 72.208-72.208h611.246c39.813 0 72.207 32.39 72.207 72.208v482.944c0 39.813-32.389 72.202-72.202 72.202zM206.92 250.742a19.978 19.978 0 0 0-19.953 19.952v482.944a19.978 19.978 0 0 0 19.953 19.953h611.246a19.973 19.973 0 0 0 19.952-19.953V270.7a19.973 19.973 0 0 0-19.952-19.953H206.92z" fill="#2c2c2c" p-id="1777"></path>' +
        '<path d="M162.294 710.129a26.127 26.127 0 0 1-18.473-44.6l195.41-195.41a26.122 26.122 0 0 1 36.946 0l84.567 84.566 179.292-179.292a26.127 26.127 0 0 1 36.946 0l197.325 197.325a26.138 26.138 0 0 1 0 36.951 26.138 26.138 0 0 1-36.951 0L658.504 430.812 479.212 610.104a26.132 26.132 0 0 1-36.946 0l-84.562-84.567L180.767 702.48a26.06 26.06 0 0 1-18.473 7.65z m130.985-307.2c-24.991 0-45.328-20.332-45.328-45.328s20.332-45.327 45.328-45.327 45.327 20.331 45.327 45.327-20.337 45.328-45.327 45.328z" fill="#2c2c2c" p-id="1778"></path>' +
        '</svg>' +
        '</button>'
      )
    }, 12);

  },

  computed: {},

  methods: {
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
      let isMarkdownMode = this.instance.isMarkdownMode();
      let img = new FormData();
      img.append('img',file.file);
      upload('/img/upload.php', img).then( response => {
        if(isMarkdownMode) {
            this.instance.getCodeMirror().replaceSelection(`![img](${response.data.url})`);
        } else {
          let range = this.instance.getCurrentModeEditor().getRange()
          let img = document.createElement('img');
          img.src = response.url;
          img.alt = 'img';
          range.insertNode(img);
        };
      })
    },
  }
}

</script>

<style>
.CodeMirror-sizer {
  height: 335px;
}
@media(max-width: 550px) {
  .tui-editor-defaultUI-toolbar {
    padding: 0px;
  }
}
</style>