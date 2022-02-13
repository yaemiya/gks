$(function () {

    // ログイン画面のログインボタンクリック時
    $('#login_btn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#errors, #errors_p').text('');
        var err_flg;
        // ログインIDのバリデーション
        if ($('#login_id').val() === '') {
            $('#errors').text('ログインIDを入力してください。');
            err_flg = 1;
        } else if (!isLoginFormat($('#login_id').val())) {
            $('#errors').text('ログインIDは半角英数字および「.-_」で入力してください。');
            err_flg = 1;
        } else if ($('#login_id').val().length < 8 || $('#login_id').val().length > 16) {
            $('#errors').text('ログインIDは8字以上16字以内で入力してください。');
            err_flg = 1;
        }
        // パスワードのバリデーション
        if ($('#password').val() === '') {
            $('#errors_p').text('パスワードを入力してください。');
            err_flg = 1;
        }
        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル
        if (err_flg === 1) {
            return false;
        }
    });

    // メールアドレス入力画面の送信ボタンクリック時
    $('#mail_send_btn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#errors').text('');
        var err_flg;
        // メールアドレスのバリデーション
        if ($('#email').val() === '') {
            $('#errors').text('メールアドレスを入力してください。');
            err_flg = 1;
        } else if (!mailCheck($('#email').val())) {
            $('#errors').text('メールアドレスは、有効なメールアドレス形式で指定してください。');
            err_flg = 1;
        } else if ($('#email').val().length > 255) {
            $('#errors').text('メールアドレスは255字以内で入力してください。');
            err_flg = 1;
        }
        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル
        if (err_flg === 1) {
            return false;
        }
    });

    // パスワード再設定画面のパスワード再設定ボタンクリック時
    $('#pwd_reset_btn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#errors').text('');
        var errors = [];
        // ログインIDのバリデーション
        if ($('#login_id').val() === '') {
            errors.push('ログインIDを入力してください。')
        } else if (!isLoginFormat($('#login_id').val())) {
            errors.push('ログインIDは半角英数字および「.-_」で入力してください。');
        } else if ($('#login_id').val().length < 8 || $('#login_id').val().length > 16) {
            errors.push('ログインIDは8字以上16字以内で入力してください。');
            err_flg = 1;
        }
        // パスワードのバリデーション
        if ($('#password').val() === '') {
            errors.push('パスワードを入力してください。');
        } else if (!isHanEisu($('#password').val())) {
            errors.push('パスワードは半角英数字で入力してください。');
        } else if ($('#password').val().length < 8 || $('#password').val().length > 16) {
            errors.push('パスワードは8字以上16字以内で入力してください。');
        }
        // パスワード（確認用）のバリデーション
        if ($('#password_confirmation').val() === '') {
            errors.push('パスワード（確認用）を入力してください。');
        } else if (!isHanEisu($('#password_confirmation').val())) {
            errors.push('パスワード（確認用）は半角英数字で入力してください。');
        } else if ($('#password_confirmation').val().length < 8 || $('#password').val().length > 16) {
            errors.push('パスワード（確認用）は8字以上16字以内で入力してください。');
        } else if ($('#password_confirmation').val() !== $('#password').val()) {
            errors.push('パスワードとパスワード（確認用）が一致しません。');
        }
        //エラー表示
        if (errors.length) {
            errors.forEach(function (error) {
                $('#errors').append(error + '<br>');
            })
            // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル
            return false;
        }
    });
})

// ログインID形式チェック
function isLoginFormat(str) {
    if (str.match(/^[A-Za-z0-9\._-]*$/)) {
        return true;
    } else {
        return false;
    }
}

// 半角英数チェック
function isHanEisu(str) {
    if (str !== undefined) {
        if (str.match(/^[A-Za-z0-9]*$/)) {
            return true;
        } else {
            return false;
        }
    }
}

// メールチェック
function mailCheck(str) {
    if (str !== undefined) {
        // 全角が含まれず、{1}@{2} のような形式、-._の記号が使用可能
        if (str.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)) {
            return true;
        } else {
            return false;
        }
    }
}

// 半角数字チェック
function isNumber(str) {
    if (str !== undefined)
    {
        if (str.match(/^\d*$/)) {
            return true;
        } else {
            return false;
        }
    }
}
