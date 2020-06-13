require('../css/app.scss');
import $ from 'jquery';
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything

$( document ).ready(function() {
    var $sports = $('#registration_accountType');
    // When sport gets selected ...
    $sports.change(function() {
      // ... retrieve the corresponding form.
      var $form = $(this).closest('form');
      // Simulate form data, but only include the selected sport value.
      var data = {
        accountType:  $('#registration_accountType input:checked').val()
      };
      // Submit data via AJAX to the form's action path.
      $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
          // Replace current position field ...
          $('#accoutTypeForm').replaceWith(
            // ... with the returned one from the AJAX response.
            $(html).find('#accoutTypeForm')
          );
          // Position field now displays the appropriate positions.
        }
      });
    });
});