import $ from 'jquery';

$(document).ready(function () {
  $('.select2').select2();
  $(document).on('click', '#appbundle_analytics_forever', function () {
    if ($(this).is(':checked')) {
      $('#appbundle_analytics_startTime').attr('disabled', true);
      $('#appbundle_analytics_endTime').attr('disabled', true);
    } else {
      $('#appbundle_analytics_startTime').attr('disabled', false);
      $('#appbundle_analytics_endTime').attr('disabled', false);
    }
  })
})