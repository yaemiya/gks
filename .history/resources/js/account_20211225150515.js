$(function () {
    // 新規登録ボタンクリック時
    $("#registerBtn").on("click", function () {
        window.location.href = '/account/register';
    });
    // 編集ボタンクリック時
    $("#editBtn").on("click", function () {
        alert($('#user_id'data('id'));
        window.location.href = '/account/edit/';
    });
    // 削除ボタンクリック時
    $("#deleteBtn").on("click", function () {
        window.location.href = '/account/delete';
    });
});
