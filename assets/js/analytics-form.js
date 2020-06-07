require('../css/analytics-form.scss');
var $ = require('jquery');

$(document).ready(function () {
    $(document).on('click', '#appbundle_analytics_forever', function () {
        if ($(this).is(':checked')) {
            $('#appbundle_analytics_startDate').attr('disabled', true);
            $('#appbundle_analytics_endDate').attr('disabled', true);
        } else {
            $('#appbundle_analytics_startDate').attr('disabled', false);
            $('#appbundle_analytics_endDate').attr('disabled', false);
        }
    })
})