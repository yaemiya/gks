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
    $("ul.dropdwn_menu li").on('hover',
        function () {
            $(">ul:not(:animated)", this).slideDown("slow");
        },
        function () {
            $(">ul", this).slideUp("slow");
        }
    );

    // モーダルオープン & クローズ
  $('#openModal').on('click', function(){
      $('#modalArea').fadeIn();
  });
  $('#closeModal , #modalBg').on('click', function(){
    $('#modalArea').fadeOut();
  });
    
$(function(){
  $('ここにaタグを指定').click( function(){
    $('ここにフォームを指定').submit();
   });
})
});