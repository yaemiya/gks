$(function () {
    // 子要素があれば下矢印を入れる
    $('ul.dropdwn_menu>li').each(function () {
        var num = $(this).children().children().length;
        if (num !== 0) {
            $(this).children('a').append('<span class="triangle_down float-right mr-3 mt-4"></span>');
        }
    });

    // 子要素があれば右矢印を入れる
    $('ul.sub2>li').each(function () {
        var num = $(this).children().children().length;
        if (num !== 0) {
            $(this).children('a').append('<span class="triangle_right float-right mr-3 mt-3"></span>');
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
});
