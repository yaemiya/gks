$(function ()
{
   $('#login_btn').on('click', function () {
      alert(111111111111);
      if ($('login_id').val() == '') {
         $('#errors').text('ログインIDは、必ず指定してください。')
         // } else if{

      }
   }));