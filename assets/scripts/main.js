"use strict";

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

function hoverCamera() {
    document.getElementById("camera").src = "/icons/camera2.png";
}
function unhoverCamera() {
    document.getElementById("camera").src = "/icons/camera.png";
}

function hoverUser() {
    document.getElementById("user").src = "/icons/user2.png";
}
function unhoverUser() {
    document.getElementById("user").src = "/icons/user.png";
}
