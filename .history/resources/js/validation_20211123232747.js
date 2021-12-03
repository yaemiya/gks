$(function () {
   $('#login_btn').on('click', function () {
      if ($("login_id").val() == undefined) {
          $("#errors").text("ログインIDは、必ず指定してください。");
      } else if（$("login_id").val() == ）{
             
         return false;
      }
   });
})