$(function () {
    $('#login_btn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#errors').text('');
        // ログインIDのバリデーション
        if ($('#login_id').val() == '') {
            $('#errors').text('ログインIDを入力してください。');
        } else if (!isHanEisu($('#login_id').val())) {
            $('#errors').text('ログインIDは半角英数字で入力してください。');
        } else if ($('#login_id').val().length !== 8) {
            $('#errors').text('ログインIDは8字で入力してください。');
        }
        // パスワードのバリデーション
        console.log($('#password').val());
        if ($('#password').val() == '') {
            $('#errors').text('ログインIDを入力してください。');
        } else if (!isHanEisu($('#password').val())) {
            $('#errors').text('ログインIDは半角英数字で入力してください。');
        } else if ($('#password').val().length !== 8) {
            $('#errors').text('ログインIDは8字で入力してください。');
        }
        return false;
    });
});

// 半角英数チェック
function isHanEisu(str) {
    str = str == null ? '' : str;
    if (str.match(/^[A-Za-z0-9]*$/)) {
        return true;
    } else {
        return false;
    }
}
