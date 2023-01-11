 jQuery(document).ready(function($){

 $('#contactform_forms').submit(function(){

  var action = $(this).attr('action');
  
  $("#message").slideUp(750,function() {
  $('#message').hide();



   $('#submit_btns')
   .after('<img src="img/AjaxLoader.gif" class="loader" />')
   .attr('disabled','disabled');
  

  $.ajax({
   url: 'contact.php',
   type: 'POST',
   data: {
     contact_name: $('#contact_name').val(),
     contact_phone: $('#contact_phone').val(),
     contact_email: $('#contact_email').val(),
     contact_message: $('#contact_message').val(),
    },
   success: function(data){
    

    document.getElementById('message').innerHTML = data;
    $('#message').slideDown('slow');
    $('#contactform_forms img.loader').fadeOut('slow',function(){$(this).remove()});
    $('#submit_btns').removeAttr('disabled');
    if(data.match('success') != null) $('#contactform_forms').slideUp('slow');
   }
  });

  });

  return false;

  return false;
 });

});