$(function () {

    // 取引工場／店舗が変更されたとき
    $('#businessKind').on('change', function () {
        // 取引工場／店舗の種別が工場のとき、プルダウンメニューを表示
        if ($(this).val() === '2') {
            $('#modalSelected').hide();
            $('#plantList').show();
        }
        // 取引工場／店舗の種別が店舗のとき、プルダウンメニューを非表示
        if ($(this).val() === '3'){
            $('#plantList').hide();
            $('#modalSelected').show();
        }
    });

    // 取引工場／店舗の種別が店舗のとき、取引工場／店舗（ID）がクリックされたら選択モーダルを表示
    $('#selectBox').on('click', function () {
    if ($('#businessKind').val() === '3') {
            $('#selectModalArea').show();
        }
    });

    // 一覧画面の新規登録ボタンクリック時
    $('#createBtn').on('click', function () {
        if ($(this).data('role') === 1)
        {
            window.location.href = '/supplier/create';
        }
    });

    // 新規登録画面の新規登録ボタンクリック時
    $('#validationBtn').on('click', function () {
        // 既存エラーメッセージの消去
        $('#supplierNameErr, #repNameErr, #postalCodeErr, #prefectureErr, #addressErr, #addressErr, #houseNumErr, #buildingErr, #emailErr, #telErr, #businessKindErr').text('');

        var errFlg;
        // 会社名／屋号のバリデーション
        if ($('#supplierName').val() === '') {
            $('#supplierNameErr').text('会社名／屋号を入力してください。');
            errFlg = 1;
        } else if ($('#supplierName').val().length > 30) {
            $('#supplierNameErr').text('会社名／屋号は30字以内で入力してください。');
            errFlg = 1;
        }

        // 代表者名のバリデーション
        if ($('#repName').val() === '') {
            $('#repNameErr').text('代表者名を入力してください。');
            errFlg = 1;
        } else if ($('#repName').val().length > 30) {
            $('#repNameErr').text('代表者名は30字以内で入力してください。');
            errFlg = 1;
        }

        // 郵便番号のバリデーション
        if ($('#postalCode1, #postalCode2').val() === '') {
            $('#postalCodeErr').text('郵便番号を入力してください。');
            errFlg = 1;
        } else if (!isNumber($('#postalCode1').val()) || !isNumber($('#postalCode2').val())) {
            $('#postalCodeErr').text('郵便番号は半角数字で入力してください。');
            errFlg = 1;
        } else if ($('#postalCode1').val().length > 3) {
            $('#postalCodeErr').text('郵便区番号は3桁以内で入力してください。');
            errFlg = 1;
        } else if ($('#postalCode2').val().length > 4) {
            $('#postalCodeErr').text('町域番号は4桁以内で入力してください。');
            errFlg = 1;
        }
        console.log($('#postalCode1').val());
        // 都道府県のバリデーション
        if ($('#prefecture').val() === '') {
            $('#prefectureErr').text('都道府県を入力してください。');
            errFlg = 1;
        } else if ($('#prefecture').val().length > 4) {
            $('#prefectureErr').text('都道府県は4字以内で入力してください。');
            errFlg = 1;
        }

        // 住所のバリデーション
        if ($('#address').val() === '') {
            $('#addressErr').text('住所を入力してください。');
            errFlg = 1;
        } else if ($('#address').val().length > 50) {
            $('#addressErr').text('住所は50字以内で入力してください。');
            errFlg = 1;
        }

        //番地のバリデーション
        if ($('#houseNum').val() === '') {
            $('#houseNumErr').text('番地を入力してください。');
            errFlg = 1;
        } else if ($('#houseNum').val().length > 10) {
            $('#houseNumErr').text('番地は10字以内で入力してください。');
            errFlg = 1;
        }

        //建物のバリデーション
        if ($('#building').val().length > 50) {
            $('#buildingErr').text('建物は50字以内で入力してください。');
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

        // 電話番号のバリデーション
        if ($('#tel1').val() === '' || $('#tel2').val() === '' || $('#tel3').val() === '') {
            $('#telErr').text('電話番号を入力してください。');
            errFlg = 1;
        } else if (!isNumber($('#tel1').val()) || !isNumber($('#tel2').val()) || !isNumber($('#tel3').val())) {
            $('#telErr').text('電話番号は半角数字で入力してください。');
            errFlg = 1;
        } else if ($('#tel1, #tel2, #tel3').val().length > 5) {
            $('#telErr').text('電話番号は5桁以内で入力してください。');
            errFlg = 1;
        } else if (($('#tel1').val() + $('#tel2').val() + $('#tel3').val()).length > 11 || ($('#tel1').val() + $('#tel2').val() + $('#tel3').val()).length < 10) {
            $('#telErr').text('電話番号の合計桁数は10桁か11桁で入力してください。');
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

        // 取引工場／店舗（ID）のバリデーション
        if ($('#businessKind').val() === '2' && $('#plantList').val() === null) {
            $("#businessKindErr").text("工場を選択してください。");
        }
        if (
            $("#businessKind").val() === "3" && $("#modalSelected").val() === null
        ) {
            $("#businessKindErr").text("店舗を選択してください。");
        }
        alert();

        // フロント側でエラー表示する場合はサーバー側バリデーションのキャンセル、エラーなしの場合はモーダル表示
        if (errFlg === 1) {
            return false;
        } else {
            $('#modalArea').fadeIn();
                return false;
        }
    });

    // 編集ボタンクリック時
  
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
