require('./bootstrap');

import Alpine from 'alpinejs';

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

    // モーダルオープン
    $('#openModal').on('click', function () {
        $('body').css('overflow-y', 'hidden'); // 本文の縦スクロールを無効
        $('#modalArea').fadeIn();
    });

    // 選択モーダルオープン
    $('#openSelectModal').on('click', function () {
        $('body').css('overflow-y', 'hidden'); // 本文の縦スクロールを無効
        $('#selectModalArea').fadeIn();
    });

    // モーダルクローズ
    $('#closeModal , #modalBg').on('click', function () {
        $('#modalArea').fadeOut();
        $('body').css('overflow-y','auto'); // 本文の縦スクロールを有効
    });

    // 選択モーダルクローズ
    $('#closeSelectModal , #selectModalBg').on('click', function () {
        $('#selectModalArea').fadeOut();
        $('body').css('overflow-y','auto'); // 本文の縦スクロールを有効
    });

    // モーダル内で新規登録ボタンクリック時
    $('#registerBtn').on('click', function () {
        $('form').submit();
    });

    // モーダル内で更新ボタンクリック時
    $('#updateBtn').on('click', function () {
        $('form').submit();
    });

    // 選択モーダルで選択後にテキストボックスに値を入れる
    $('#selectModalList li').on('click', function () {
        
        $('#modalSelected').val('aaa');
    })




});
