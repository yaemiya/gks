$(function () {

    // ログインボタンクリック時
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
            $('#password').val(''); // 入力パスワードの消去
            err_flg = 1;
        } else if ($('#password').val().length < 8 || $('#password').val().length > 16) {
            $('#errors_p').text('パスワードは8字以上16字以内で入力してください。');
            $('#password').val(''); // 入力パスワードの消去
            err_flg = 1;
        }
        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル
        if (err_flg === 1) {
            return false;
        }
    });

    // メールアドレス入力画面の送信ボタンクリック時
    $('#mail_send_btn').on(click, function () {
        // 既存エラーメッセージの消去
        $('#errors').text('');
        var err_flg;
        // メールアドレスのバリデーション
        if ($('#email').val() === '') {
            $('#errors').text('メールアドレスを入力してください。');
            err_flg = 1;
        } else if (!isHanEisu($('#login_id').val())) {
            $('#errors').text('メールアドレスは、有効なメールアドレス形式で指定してください。。');
            err_flg = 1;
        } else if ($('#login_id').val().length > 255) {
            $('#errors').text('ログインIDは8字で入力してください。');
            err_flg = 1;
        }
        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル
        if (err_flg === 1) {
            return false;
        }
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
