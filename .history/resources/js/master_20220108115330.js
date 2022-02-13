$(function () {

    // 一覧画面の新規登録ボタンクリック時
    $('#createBtn').on('click', function () {
        if ($(this).data('role') === 1)
        {
            window.location.href = '/supplier/create';
        }
    });

    // 新規登録画面のアカウント作成ボタンクリック時
    $('#validationBtn').on('click', function () {
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
        if ($('#last_name').val() === undefined) {
            $('#last_name_err').text('姓を入力してください。');
            err_flg = 1;
        } else if ($('#last_name').val().length > 20) {
            $('#last_name_err').text('姓は20字以内で入力してください。');
            err_flg = 1;
        }

        // 名のバリデーション
        if ($('#first_name').val() === ) {
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
        } else if (($('#tel_1').val() + $('#tel_2').val() + $('#tel_3').val()).length > 11 || ($('#tel_1').val() + $('#tel_2').val() + $('#tel_3').val()).length < 10) {
            $('#tel_err').text('電話番号の合計桁数は10桁か11桁で入力してください。');
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

        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル、エラーなしの場合はモーダル表示
        if (err_flg === 1) {
            return false;
        } else {
            $('#modalArea').fadeIn();
                return false;
        }
    });

    // 編集ボタンクリック時
    $("#editBtn").on("click", function () {
        var userId = $(this).data('user_id');
        window.location.href = '/account/edit/' + userId;
    });

    // ユーザー編集画面の更新ボタンクリック時
    $('#validationBtn').on('click', function () {
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
            err_flg = 1;
        }

        // 電話番号のバリデーション
        if ($('#tel').val() === '') {
            $('#tel_err').text('電話番号を入力してください。');
            err_flg = 1;
        } else if (!isNumber($('#tel').val())) {
            $('#tel_err').text('電話番号は半角数字で入力してください。');
            err_flg = 1;
        } else if ($('#tel').val().length > 11 || $('#tel').val().length < 10) {
            $('#tel_err').text('電話番号の合計桁数は10桁か11桁で入力してください。');
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

        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル、エラーなしの場合はモーダル表示
        if (err_flg === 1) {
            return false;
        } else {
        $('#modalArea').fadeIn();
            return false;
        }
    });
});

// ログインID形式チェック
function isLoginFormat(str) {
    if (str !== undefined) {
        if (str.match(/^[A-Za-z0-9\._-]*$/)) {
            return true;
        } else {
            return false;
        }
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
