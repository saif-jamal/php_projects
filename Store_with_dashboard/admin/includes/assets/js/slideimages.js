var currentPic = 0;
var opacity = 1;
var numOfPics = 4;
var maxOpacity = 1;
var minOpacity = 0;
var speed = 50;
var timer = 3000;
var pics = [];

pics[0] = "includes/assets/img/01.jpg";
pics[1] = "includes/assets/img/02.jpg";
pics[2] = "includes/assets/img/03.jpg";
pics[3] = "includes/assets/img/04.jpg";

function fadeOut(element, speed) {

  opacity-=0.1

  element.style.opacity = opacity;

  if(opacity<=minOpacity) {

    return true;
  }

  setTimeout(fadeOut.bind(null, element, speed), speed);
}

function fadeIn(element, speed) {

  opacity+=0.1

  element.style.opacity = opacity;

  if(opacity>=maxOpacity) {

    return true;
  }

  setTimeout(fadeIn.bind(null, element, speed), speed);
}

function imageSliderOut() {

  var slider = document.getElementById("slider");

  fadeOut(slider, speed);

  currentPic++;

  if(currentPic===numOfPics) {

    currentPic=0;
  }

  setTimeout("imageSliderIn()", (timer/3));
}

function imageSliderIn() {

  var slider = document.getElementById("slider");

  slider.src = pics[currentPic];

  fadeIn(slider, speed);

  setTimeout("imageSliderOut()", timer);
}

window.onload = imageSliderIn;