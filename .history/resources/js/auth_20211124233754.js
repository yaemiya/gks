$(function () {
   $("#login_btn").on("click", function () {
      $("")
      if ($("#login_id").val() == undefined) {
         $("#errors").text("ログインIDを入力してください。");
      } else if (!isHanEisu($("#login_id").val())) {
         $("#errors").text("ログインIDは半角英数字で入力してください。");
      } else if ($("#login_id").val().length !== 8) {
         $("#errors").text("ログインIDは8字で入力してください。");
      }
      return;
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
