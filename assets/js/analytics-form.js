require('../css/analytics-form.scss');
var $ = require('jquery');

$(document).ready(function () {
    $(document).on('click', '#appbundle_analytics_forever', function () {
        console.log('coucou')
        if ($(this).is(':checked')) {
            $('#appbundle_analytics_startTime').attr('disabled', true);
            $('#appbundle_analytics_endTime').attr('disabled', true);
        } else {
            $('#appbundle_analytics_startTime').attr('disabled', false);
            $('#appbundle_analytics_endTime').attr('disabled', false);
        }
    })
})