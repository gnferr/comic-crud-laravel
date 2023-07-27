
"use strict";

var path = location.pathname.split('/')
var url = location.origin + "/" + path[1] + "/" + path[2]

$('ul.sidebar-menu li a').each(function () {
    if ($(this).attr('href').indexOf(url) !== -1) {
        $(this).parent().addClass('active').parent().parent('li').addClass('active')
    }
})



// document.getElementById('flip-card-btn-turn-to-back').style.visibility = 'visible';
// document.getElementById('flip-card-btn-turn-to-front').style.visibility = 'visible';



// document.getElementById('flip-card-btn-turn-to-front').onclick = function () {
//     document.getElementById('flip-card').classList.toggle('do-flip');
// };




