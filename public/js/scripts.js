let days = document.getElementsByClassName('day');
for (let i = 1; i <= days.length; i++) {
    if (i === new Date().getDate()) continue;
    days[i - 1].style.display = 'none';
}

let display = 'table-row';

function showHide() {
    for (let j = 0; j < days.length; j++) {
        if (j + 1 === new Date().getDate() && display === 'none') continue;
        days[j].style.display = display;
    }
    display === 'table-row' ? display = 'none' : display = 'table-row';
}

$(document).ready(function(){

    $(".monthPicker").datepicker({
        dateFormat: 'mm-yy',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,

        onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, month, 1));
        }
    });

    $(".monthPicker").focus(function () {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
            my: "center top",
            at: "center bottom",
            of: $(this)
        });

    });

});
