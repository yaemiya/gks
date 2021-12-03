$(function () {
   console.log($("#login_id").val());
   console.log($(".:errors").val());
   console.log($(".:errors").val());

   $("#login_btn").on("click", function () {
      // $(".:errors").val("");
      if ($("#errors").val() == undefined) {
         $("#errors").text("ログインIDを入力してください。");
      } else if (!isHanEisu($("#login_id").val())) {
         $("#errors").text("ログインIDは半角英数字で入力してください。");
      } else if ($("#login_id").val().length !== 8) {
         $("#errors").text("ログインIDは8字で入力してください。");
      }
       return false;
    });
});

// 半角英数チェック
function isHanEisu(str) {
    if (str.match(/^[A-Za-z0-9]*$/)) {
        return true;
    } else {
        return false;
    }
}
