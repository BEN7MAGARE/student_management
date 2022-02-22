'use strict';
$(document).ready(function () {

    // Date picker
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true,
        autoclose: true,
        orientation:"bottom"
    });
    $('#dp2').datepicker({
        todayHighlight: true,
        autoclose: true,
        orientation:"bottom"
    });
    $('#dp3').datepicker({
        todayHighlight: true,
        autoclose: true,
        orientation:"bottom"
    });
    $('#dpYears').datepicker({
        todayHighlight: true,
        autoclose: true,
        orientation:"bottom"
    });
    $('#dpMonths').datepicker({
        todayHighlight: true,
        autoclose: true,
        startView: "months",
        minViewMode: "months",
        orientation:"bottom"
    });
});