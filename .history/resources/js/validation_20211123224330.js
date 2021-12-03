$(function () {
   $('#login_btn').on('click', function () {
      alert($("login_id").val());
      if ($("login_id").val() == undefined) {
          $("#errors").text("ログインIDは、必ず指定してください。");
          // } else if{
      }
   });
})