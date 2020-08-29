import { Row,Col,Menu,Button,Select,MenuItem,Divider,Dialog,Drawer,DatePicker,Input,Submenu,Form,FormItem,Tag,Table,Pagination, TableColumn,Timeline,
  TimelineItem,Card,Badge,Avatar,Rate,Popover,Option,Switch,Upload,Tooltip,Notification,MessageBox,Confirm } from 'element-ui'

const element = {
  // install 方法表示在 main.js 中，如果使用 Vue.use() 方法的话，则该方法默认会调用 install 方法,并把Vue传递过来
  install: function(Vue) {
    Vue.use(Button)
    Vue.use(Select)
    Vue.use(Row)
    Vue.use(Col)
    Vue.use(Menu)
    Vue.use(MenuItem)
    Vue.use(Divider)
    Vue.use(Dialog)
    Vue.use(Drawer)
    Vue.use(DatePicker)
    Vue.use(Input)
    Vue.use(Submenu)
    Vue.use(Form)
    Vue.use(FormItem)
    Vue.use(TableColumn)
    Vue.use(Tag)
    Vue.use(Table)
    Vue.use(Pagination)
    Vue.use(Timeline)
    Vue.use(TimelineItem)
    Vue.use(Card)
    Vue.use(Badge)
    Vue.use(Avatar)
    Vue.use(Rate)
    Vue.use(Popover)
    Vue.use(Option)
    Vue.use(Switch)
    Vue.use(Upload)
    Vue.use(Tooltip)
    Vue.prototype.$notify = Notification
    Vue.prototype.$msgbox = MessageBox
    Vue.prototype.$confirm = MessageBox.confirm
  }
}

export default element