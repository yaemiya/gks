$(function () {
   $('#login_btn').on('click', function () {
      if ($("login_id").val() == undefined) {
         $("#errors").text("ログインIDは、必ず指定してください。");
      } else if(!isHanEisu($("login_id").val())){
         $("#errors").text("ログインIDは、半角英数字で入力してください。");
      }
   });
})

// 半角英数チェック
function isHanEisu(str){
   str = (str == null) ? "" : str;
  １ if (str.match(/^[A-Za-z0-9]*$/)) {
    return true;
  }else{
    return false;
  }
}

