$(function () {
    // 新規登録ボタンクリック時
    $("#registerBtn").on("click", function () {
        window.location.href = '/account/register';
    });
    // 編集ボタンクリック時
    $("#editBtn").on("click", function () {
        window.location.href = '/account/edit/data('id';
    });
    // 削除ボタンクリック時
    $("#deleteBtn").on("click", function () {
        window.location.href = '/account/delete';
    });
});
