$(function () {

    
    $('openSelectBox').hide();

    // 取引工場／店舗の種別が工場のとき、プルダウンメニューを表示
    $('#businessKind').on('change', function () {
        if ($(this).val() === '2') {
            $('#plantList').show();
        }
        
    });


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
        $('#supplierNameErr, #firstNameErr, #emailErr, #passwordErr, #password_confirmationErr, #telErr, #roleErr').text('');

        var errFlg;

        // 会社名／屋号のバリデーション
        if ($('#supplierName').val() === undefined) {
            $('#supplierNameErr').text('会社名／屋号を入力してください。');
            errFlg = 1;
        } else if ($('#supplierName').val().length > 30) {
            $('#supplierNameErr').text('会社名／屋号は30字以内で入力してください。');
            errFlg = 1;
        }

        // 代表者名のバリデーション
        if ($('#repName').val() === undefined) {
            $('#repNameErr').text('代表者名を入力してください。');
            errFlg = 1;
        } else if ($('#repName').val().length > 30) {
            $('#repNameErr').text('代表者名は30字以内で入力してください。');
            errFlg = 1;
        }

        // 郵便番号のバリデーション
        if ($('postalCode1').val() === '' || $('postalCode2').val() === undefined) {
            $('postalCodeErr').text('郵便番号を入力してください。');
            errFlg = 1;
        } else if (!isNumber($('postalCode1').val()) || !isNumber($('postalCode2').val())) {
            $('postalCodeErr').text('郵便番号は半角数字で入力してください。');
            errFlg = 1;
        } else if ($('postalCode1').val().length > 3) {
            $('postalCodeErr').text('郵便区番号は3桁以内で入力してください。');
            errFlg = 1;
        } else if ($('postalCode2').val().length > 4) {
            $('postalCodeErr').text('町域番号は4桁以内で入力してください。');
            errFlg = 1;
        }

        // 都道府県のバリデーション
        if ($('#prefecture').val() === undefined) {
            $('#prefectureErr').text('都道府県を入力してください。');
            errFlg = 1;
        } else if ($('#prefecture').val().length > 4) {
            $('#prefectureErr').text('都道府県は4字以内で入力してください。');
            errFlg = 1;
        }

        // 住所のバリデーション
        if ($('#address').val() === undefined) {
            $('#addressErr').text('住所を入力してください。');
            errFlg = 1;
        } else if ($('#address').val().length > 50) {
            $('#addressErr').text('住所は50字以内で入力してください。');
            errFlg = 1;
        }

        //番地のバリデーション
        if ($('#houseNum').val() === undefined) {
            $('#houseNumErr').text('番地を入力してください。');
            errFlg = 1;
        } else if ($('#houseNum').val().length > 10) {
            $('#houseNumErr').text('番地は10字以内で入力してください。');
            errFlg = 1;
        }

        //建物のバリデーション
        if ($('#building').val() === undefined) {
            $('#buildingErr').text('建物を入力してください。');
            errFlg = 1;
        } else if ($('#building').val().length > 50) {
            $('#buildingErr').text('建物は50字以内で入力してください。');
            errFlg = 1;
        }

        // メールアドレスのバリデーション
        if ($('#email').val() === undefined) {
            $('#emailErr').text('メールアドレスを入力してください。');
            errFlg = 1;
        } else if (!mailCheck($('#email').val())) {
            $('#emailErr').text('メールアドレスは、有効なメールアドレス形式で指定してください。');
            errFlg = 1;
        } else if ($('#email').val().length > 255) {
            $('#emailErr').text('メールアドレスは255字以内で入力してください。');
            errFlg = 1;
        }

        // 電話番号のバリデーション
        if ($('tel1').val() === '' || $('tel2').val() === '' || $('tel3').val() === '') {
            $('telErr').text('電話番号を入力してください。');
            errFlg = 1;
        } else if (!isNumber($('tel1').val()) || !isNumber($('tel2').val()) || !isNumber($('tel3').val())) {
            $('telErr').text('電話番号は半角数字で入力してください。');
            errFlg = 1;
        } else if ($('tel1, tel2, tel3').val().length > 5) {
            $('telErr').text('電話番号は5桁以内で入力してください。');
            errFlg = 1;
        } else if (($('tel1').val() + $('tel2').val() + $('tel3').val()).length > 11 || ($('tel1').val() + $('tel2').val() + $('tel3').val()).length < 10) {
            $('telErr').text('電話番号の合計桁数は10桁か11桁で入力してください。');
            errFlg = 1;
        }

        // 種別のバリデーション
        if ($('#businessKind').val() === null) {
            $('#businessKindErr').text('種別を選択してください。');
            errFlg = 1;
        } else if (!($('#businessKind').val() === '2' || $('#businessKind').val() === '3')) {
            $('#businessKindErr').text('不正な選択がされています。');
            errFlg = 1;
        }

        // 種別のバリデーション
        if ($('#businessKind').val() === null) {
            $('#businessKindErr').text('種別を選択してください。');
            errFlg = 1;
        } else if (!($('#businessKind').val() === '2' || $('#businessKind').val() === '3')) {
            $('#businessKindErr').text('不正な選択がされています。');
            errFlg = 1;
        }

        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル、エラーなしの場合はモーダル表示
        if (errFlg === 1) {
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
        $('#loginErr, #last_nameErr, #first_nameErr, #emailErr, #passwordErr, #password_confirmationErr, #telErr, #roleErr').text('');

        var errFlg;

        // ログインIDのバリデーション
        if ($('#login_id').val() === '') {
            $('#loginErr').text('ログインIDを入力してください。');
            errFlg = 1;
        } else if (!isLoginFormat($('#login_id').val())) {
            $('#loginErr').text('ログインIDは半角英数字および「.-_」で入力してください。');
            errFlg = 1;
        } else if ($('#login_id').val().length < 8 || $('#login_id').val().length > 16) {
            $('#loginErr').text('ログインIDは8字以上16字以内で入力してください。');
            errFlg = 1;
        }

        // 社員番号のバリデーション
        if ($('#emp_no').val() === '') {
            $('#emp_noErr').text('社員番号を入力してください。');
            errFlg = 1;
        } else if (!isHanEisu($('#emp_no').val())) {
            $('#emp_noErr').text('社員番号は半角英数字で入力してください。');
            errFlg = 1;
        } else if ($('#emp_no').val().length !== 4) {
            $('#emp_noErr').text('社員番号は4字で入力してください。');
            errFlg = 1;
        }

        // 姓のバリデーション
        if ($('#last_name').val() === '') {
            $('#last_nameErr').text('姓を入力してください。');
            errFlg = 1;
        } else if ($('#last_name').val().length > 20) {
            $('#last_nameErr').text('姓は20字以内で入力してください。');
            errFlg = 1;
        }

        // 代表者名のバリデーション
        if ($('#first_name').val() === '') {
            $('#first_nameErr').text('代表者名を入力してください。');
            errFlg = 1;
        } else if ($('#first_name').val().length > 20) {
            $('#first_nameErr').text('代表者名は20字以内で入力してください。');
            errFlg = 1;
        }

        // メールアドレスのバリデーション
        if ($('#email').val() === '') {
            $('#emailErr').text('メールアドレスを入力してください。');
            errFlg = 1;
        } else if (!mailCheck($('#email').val())) {
            $('#emailErr').text('メールアドレスは、有効なメールアドレス形式で指定してください。');
            errFlg = 1;
        } else if ($('#email').val().length > 255) {
            $('#emailErr').text('メールアドレスは255字以内で入力してください。');
            errFlg = 1;
        }

        // パスワードのバリデーション
        if ($('#password').val() === '') {
            $('#passwordErr').text('パスワードを入力してください。');
            errFlg = 1;
        } else if (!isHanEisu($('#password').val())) {
            $('#passwordErr').text('パスワードは半角英数字で入力してください。');
            errFlg = 1;
        } else if ($('#password').val().length < 8 || $('#password').val().length > 16) {
            $('#passwordErr').text('パスワードは8字以上16字以内で入力してください。');
            errFlg = 1;
        }

        // パスワード（確認用）のバリデーション
        if ($('#password_confirmation').val() === '') {
            $('#password_confirmationErr').text('パスワード（確認用）を入力してください。');
            errFlg = 1;
        } else if ($('#password_confirmation').val() !== $('#password').val()) {
            $('#password_confirmationErr').text('パスワードと同じ値を入力してください。');
            errFlg = 1;
        }

        // 電話番号のバリデーション
        if ($('#tel').val() === '') {
            $('#telErr').text('電話番号を入力してください。');
            errFlg = 1;
        } else if (!isNumber($('#tel').val())) {
            $('#telErr').text('電話番号は半角数字で入力してください。');
            errFlg = 1;
        } else if ($('#tel').val().length > 11 || $('#tel').val().length < 10) {
            $('#telErr').text('電話番号の合計桁数は10桁か11桁で入力してください。');
            errFlg = 1;
        }

        // 権限のバリデーション
        if ($('#role').val() === null) {
            $('#roleErr').text('権限を選択してください。');
            errFlg = 1;
        } else if (!($('#role').val() === '1' || $('#role').val() === '2')) {
            $('#roleErr').text('不正な選択がされています。');
            errFlg = 1;
        }

        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル、エラーなしの場合はモーダル表示
        if (errFlg === 1) {
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
