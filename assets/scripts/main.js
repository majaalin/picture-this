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
    document.getElementById("camera").src = "/camera2.png";
}
function unhoverCamera() {
    document.getElementById("camera").src = "/camera.png";
}

function hoverUser() {
    document.getElementById("user").src = "/user2.png";
}
function unhoverUser() {
    document.getElementById("user").src = "/user.png";
}

function hoverSettings() {
    document.getElementById("settings").src = "/settings2.png";
}
function unhoverSettings() {
    document.getElementById("settings").src = "/settings.png";
}
