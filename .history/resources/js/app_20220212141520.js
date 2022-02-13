require("./bootstrap");

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

$(function () {
    // ドロップダウンメニュー
    // 子要素があれば下矢印を入れる
    $("ul.dropdwn_menu>li").each(function () {
        var num = $(this).children().children().length;
        if (num !== 0) {
            $(this)
                .children("a")
                .append(
                    '<span class="triangle_down float-right mr-2 mt-4"></span>'
                );
        }
    });

    // 子要素があれば右矢印を入れる
    $("ul.sub2>li").each(function () {
        var num = $(this).children().children().length;
        if (num !== 0) {
            $(this)
                .children("a")
                .append(
                    '<span class="triangle_right float-right mr-1 mt-2"></span>'
                );
        }
    });

    // 選択処理
    $("ul.dropdwn_menu li").hover(
        function () {
            $(">ul:not(:animated)", this).slideDown("slow");
        },
        function () {
            $(">ul", this).slideUp("slow");
        }
    );

    // ば

    // モーダルオープン
    $("#openModal").on("click", function () {
        $("body").css("overflow-y", "hidden"); // 本文の縦スクロールを無効
        $("#modalArea").fadeIn();
    });

    // 選択モーダルオープン
    $("#openSelectModal").on("click", function () {
        $("body").css("overflow-y", "hidden"); // 本文の縦スクロールを無効
        $("#selectModalArea").fadeIn();
    });

    // モーダルクローズ
    $("#closeModal , #modalBg").on("click", function () {
        $("#modalArea").fadeOut();
        $("body").css("overflow-y", "auto"); // 本文の縦スクロールを有効
    });

    // 選択モーダルクローズ
    $("#closeSelectModal , #selectModalBg").on("click", function () {
        $("#selectModalArea").fadeOut();
        $("body").css("overflow-y", "auto"); // 本文の縦スクロールを有効
    });

    // モーダル内で新規登録ボタンクリック時
    $("#registerBtn").on("click", function () {
        $("form").submit();
    });

    // モーダル内で更新ボタンクリック時
    $("#updateBtn").on("click", function () {
        $("form").submit();
    });

    // 選択モーダルで選択後にテキストボックスに値を入れる
    $("#selectModalList li").on("click", function () {
        var modalSelected = $(this).find("a").text();
        $("#modalSelected").text(modalSelected);
        $("#selectedId").val($(this).data('id'));
        $("#closeSelectModal").trigger("click");
    });

    $("#searchrBtn").on("click", function () {
        //半角スペース区切りの文字を配列に格納する
        var searchArr = $("#searchBox").val().trim().split(/\s+/);
        // 格納した文字が店舗リストにマッチすれば表示
        $("#selectModalList ul li").each(function () {
            var list = $(this);
            var cnt = 0;
            searchArr.forEach(function (word) {
                if (list.text().indexOf(word) === -1) {
                    cnt++;
                }
            });
            if (cnt > 0) {
                list.hide();
            } else {
                list.show();
            }
        });
    });
});
