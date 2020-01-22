// 判断字符串是否为null
export function isNull(str) {
  return str == null || str == "";
}

// 判断对象属性值是否为空
export function isNullObject(obj) {
  let array = [];
  for(let key in obj) {
    array.push(obj[key] != null && obj[key] != "")
  }
  if(array.indexOf(false) >= 0) {
    return true
  } else {
    return false
  }
}

// 将文章标题前后空格清楚, / 转换为"", " " 空格转换为 -
export function titleFormat(str) {
  str = str.trim();
  str = str.replace(/\//g, "");
  str = str.replace(/\s/g, "-");
  return str;
}

// 格式化当前时间为年月
export function timeFormatter(format) {
  let myDate = new Date();  
  let year = myDate.getFullYear();   //获取完整的年份(4位,1970-????)  
  let month = (myDate.getMonth() < 10 ? "0" + myDate.getMonth() : myDate.getMonth()) + 1;    // 获取当前月份(0-11,0代表1月) 
  let day = myDate.getDate() < 10 ? "0" + myDate.getDate() : myDate.getDate();    // 获取当前日(1-31) 
  let hours = myDate.getHours() < 10 ? "0" + myDate.getHours() : myDate.getHours();    // 获取当前小时数(0-23)  
  let minutes = myDate.getMinutes() < 10 ? "0" + myDate.getMinutes() : myDate.getMinutes();  // 获取当前分钟数(0-59)  
  let seconds = myDate.getSeconds() < 10 ? "0" + myDate.getSeconds() : myDate.getSeconds();  // 获取当前秒数(0-59)

  switch(format) {
    case "YYYY-MM-dd HH:mm:ss":
      return year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
    case "YYYY-MM-dd":
      return year + "-" + month + "-" + day;
    case "YYYY-MM": 
      return  year + "-" + month;
    case "YYYY":
      return year;
    case "MM":
      return month;
    case "dd": 
      return day  
  }
}