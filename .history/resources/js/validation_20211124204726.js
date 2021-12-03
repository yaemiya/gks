$(function () {
   $('#login_btn').on('click', function () {
      if ($("login_id").val() == undefined) {
          $("#errors").text("ログインIDは、必ず指定してください。");
      } else if（$("login_id").val()）{
             
         return false;
      }
   });
})

// 半角英数チェック
function isHanEisu(str){
  str = (str == null) ? "" : str;
  if(str.match(/^[A-Za-z0-9]*$/)){
    return true;
  }else{
    return false;
  }
}

