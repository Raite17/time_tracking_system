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

// $(document).ready(function () {
//
//     var start = $('#start_button');
//     var stop = $('#stop_button');
//
//     stop.css('display', 'none');
//
//     start.on('click',function () {
//         start.css('display', 'none');
//         stop.css('display', 'block');
//     });
//
//     stop.on('click',function () {
//         start.css('display', 'block');
//         stop.css('display', 'none');
//     })
//
// });