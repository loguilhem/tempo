import $ from 'jquery';

$( document ).ready(function() {
  var $accountType = $('#registration_accountType');
    
  $accountType.change(function() {
      
    var $form = $(this).closest('form');
      
    var data = {
      registration:  {
        accountType: $('#registration_accountType input:checked').val()
      }
    };
     
    $.ajax({
      url : $form.attr('action'),
      type: $form.attr('method'),
      data : data,
      success: function(html) {
        $('#accoutTypeForm').replaceWith(
          $(html).find('#accoutTypeForm')
        );
      }
    });
  });
});