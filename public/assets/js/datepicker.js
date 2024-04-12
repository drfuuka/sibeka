$(function () {
    "use strict";

    if ($("#datePickerExample").length) {
        $("#datePickerExample").datepicker({
            format: "mm/dd/yyyy",
            todayHighlight: true,
            autoclose: true,
        });
    }
});
