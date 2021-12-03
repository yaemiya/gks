$($()
   if ($('login_id').val() == '')
   {
      $('#login_id').on('click', function () {
         $('#errors').text('ログインIDは、必ず指定してください。')
         // } else if{

      });
      });