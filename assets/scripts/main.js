"use strict";

// Make header hide and show when scrolling
let prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar-nav").style.top = "0";
    } else {
        document.getElementById("navbar-nav").style.top = "-150px";
    }
    prevScrollpos = currentScrollPos;
};

// Go to previous page
function goBack() {
    window.history.back();
}
