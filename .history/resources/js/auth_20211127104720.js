$(function () {
    $('#login_btn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#errors, #errors_p').text('');
        var err_flg;
        // ログインIDのバリデーション
        if ($('#login_id').val() === '') {
            $('#errors').text('ログインIDを入力してください。');
            err_flg = 1;
        } else if (!isHanEisu($('#login_id').val())) {
            $('#errors').text('ログインIDは半角英数字で入力してください。');
            err_flg = 1;
        } else if ($('#login_id').val().length !== 8) {
            $('#errors').text('ログインIDは8字で入力してください。');
            err_flg = 1;
        }
        // パスワードのバリデーション
        if ($('#password').val() === '') {
            $('#errors_p').text('パスワードを入力してください。');
            err_flg = 1;
        } else if (!isHanEisu($('#password').val())) {
            $('#errors_p').text('パスワードは半角英数字で入力してください。');
            err_flg = 1;
        } else if ($('#password').val().length < 8 || $('#password').val().length > 16) {
            $('#errors_p').text('パスワードは8字以上16字以内で入力してください。');
            err_flg = 1;
        }
        if (err_flg === 1)
        {
            
            }
        return;
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
