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

    // ユーザー新規登録画面のアカウント作成ボタンクリック時
    $('#registerBtn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#login_err, #last_name_err, #first_name_err, #email_err, #password_err, #password_confirmation_err, #tel_err, #role_err').text('');
        var err_flg;
        // ログインIDのバリデーション
        if ($('#login_id').val() === '') {
            $('#login_err').text('ログインIDを入力してください。');
            err_flg = 1;
        } else if (!isLoginFormat($('#login_id').val())) {
            $('#login_err').text('ログインIDは半角英数字および「.-_」で入力してください。');
            err_flg = 1;
        } else if ($('#login_id').val().length < 8 || $('#login_id').val().length > 16) {
            $('#login_err').text('ログインIDは8字以上16字以内で入力してください。');
            err_flg = 1;
        }
        // 社員番号のバリデーション
        if ($('#emp_no').val() === '') {
            $('#emp_no_err').text('社員番号を入力してください。');
            err_flg = 1;
        } else if (!isHanEisu($('#emp_no').val())) {
            $('#emp_no_err').text('社員番号は半角英数字で入力してください。');
            err_flg = 1;
        } else if ($('#emp_no').val().length !== 4) {
            $('#emp_no_err').text('社員番号は4字で入力してください。');
            err_flg = 1;
        }
        // 姓のバリデーション
        if ($('#last_name').val() === '') {
            $('#last_name_err').text('姓を入力してください。');
            err_flg = 1;
        } else if ($('#last_name').val().length > 20) {
            $('#last_name_err').text('姓は20字以内で入力してください。');
            err_flg = 1;
        }
        // 名のバリデーション
        if ($('#first_name').val() === '') {
            $('#first_name_err').text('名を入力してください。');
            err_flg = 1;
        } else if ($('#first_name').val().length > 20) {
            $('#first_name_err').text('名は20字以内で入力してください。');
            err_flg = 1;
        }
        // メールアドレスのバリデーション
        if ($('#email').val() === '') {
            $('#email_err').text('メールアドレスを入力してください。');
            err_flg = 1;
        } else if (!mailCheck($('#email').val())) {
            $('#email_err').text('メールアドレスは、有効なメールアドレス形式で指定してください。');
            err_flg = 1;
        } else if ($('#email').val().length > 255) {
            $('#email_err').text('メールアドレスは255字以内で入力してください。');
            err_flg = 1;
        }
        // パスワードのバリデーション
        if ($('#password').val() === '') {
            $('#password_err').text('パスワードを入力してください。');
            err_flg = 1;
        } else if (!isHanEisu($('#password').val())) {
            $('#password_err').text('パスワードは半角英数字で入力してください。');
            err_flg = 1;
        } else if ($('#password').val().length < 8 || $('#password').val().length > 16) {
            $('#password_err').text('パスワードは8字以上16字以内で入力してください。');
            err_flg = 1;
        }
        // パスワード（確認用）のバリデーション
        if ($('#password_confirmation').val() === '') {
            $('#password_confirmation_err').text('パスワード（確認用）を入力してください。');
            err_flg = 1;
        } else if ($('#password_confirmation').val() !== $('#password').val()) {
            $('#password_confirmation_err').text('パスワードと同じ値を入力してください。');
            // $('#password_confirmation').val(''); // 入力パスワードの消去
            err_flg = 1;
        }
        // 電話番号のバリデーション
        if ($('#tel_1').val() === '' || $('#tel_2').val() === '' || $('#tel_3').val() === '') {
            $('#tel_err').text('電話番号を入力してください。');
            err_flg = 1;
        } else if (!isNumber($('#tel_1').val()) || !isNumber($('#tel_2').val()) || !isNumber($('#tel_3').val())) {
            $('#tel_err').text('電話番号は半角数字で入力してください。');
            err_flg = 1;
        } else if ($('#tel_1, #tel_2, #tel_3').val().length > 5) {
            $('#tel_err').text('電話番号は5桁以内で入力してください。');
            err_flg = 1;
        } else if (($('#tel_1').val()+$('#tel_2').val()+$('#tel_3').val()).length > 11) {
            $('#tel_err').text('電話番号の合計桁数は11桁以内で入力してください。');
            err_flg = 1;
        }
        // 権限のバリデーション
        if ($('#role').val() === null) {
            $('#role_err').text('権限を選択してください。');
            err_flg = 1;
        } else if (!($('#role').val() === '1' || $('#role').val() === '2')) {
            $('#role_err').text('不正な選択がされています。');
            err_flg = 1;
        }
        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル
        if (err_flg === 1) {
        alert(err_flg);
            //  return false;
            // $('form').prepend('<input type="hidden" name="errFlg" value="1"');
            // $('<input>').attr({type:'hidden', id:'errFlg', name:'errFlg', value:1}).appendTo('form');
            $('<p>111111111111111111</p>').prependTo('form');
        }
    });
    //選択処理
    $("ul.info_2116 li").on('mouseover', function () {
        $(">ul:not(:animated)", this).slideDown("fast");
    }, function () {
        $(">ul", this).slideUp("fast");
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
    if (str.match(/^[A-Za-z0-9]*$/)) {
        return true;
    } else {
        return false;
    }
}

// メールチェック
function mailCheck(str) {
    // 全角が含まれず、{1}@{2} のような形式、-._の記号が使用可能
    if (str.match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)) {
        return true;
    } else {
        return false;
    }
}

// 半角数字チェック
function isNumber(str) {
    if (str.match(/^\d*$/)) {
        return true;
    } else {
        return false;
    }
}
