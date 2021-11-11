var close_wellcom= document.querySelector(".wellcom");
close_wellcom.addEventListener("click",()=>{
    close_wellcom.style.display="none";
});



// header slide 

// var swiper = new Swiper(".mySwiper", {
//     slidesPerView: 4,
//     centeredSlides: true,
//     spaceBetween: 60,
//     pagination: {
//       el: ".swiper-pagination",
//       type: "fraction",
//     },
//     navigation: {
//       nextEl: ".swiper-button-next",
//       prevEl: ".swiper-button-prev",
//     },
//   });

//   var appendNumber = 4;
//   var prependNumber = 1;
//   document
//     .querySelector(".prepend-2-slides")
//     .addEventListener("click", function (e) {
//       e.preventDefault();
//       swiper.prependSlide([
//         '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
//         '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
//       ]);
//     });
//   document
//     .querySelector(".prepend-slide")
//     .addEventListener("click", function (e) {
//       e.preventDefault();
//       swiper.prependSlide(
//         '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
//       );
//     });
//   document
//     .querySelector(".append-slide")
//     .addEventListener("click", function (e) {
//       e.preventDefault();
//       swiper.appendSlide(
//         '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
//       );
//     });
//   document
//     .querySelector(".append-2-slides")
//     .addEventListener("click", function (e) {
//       e.preventDefault();
//       swiper.appendSlide([
//         '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
//         '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
//       ]);
//     });
// var getwidth=window.innerWidth;
// var wd=4;
// setInterval(() => {
//   if(getwidth<=1620){
//     wd=2;
//   }else{
//     wd=4;
//   }
// }, 200);

var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  centeredSlides: true,
  loop:true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    "@1.00": {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    "@1.50": {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    "@2.00": {
      slidesPerView: 4,
      spaceBetween: -50,
    },
  },
    
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + (index + 1) + "</span>";
    },
  },
});


// android games 
const heart__ = document.querySelectorAll(".heart");
var countCLikc=0;

  heart__.forEach(i=>{
    i.onclick=()=>{
      if(countCLikc==0){
        i.setAttribute("style","color:red;");
        countCLikc=1;
    }
    else{
        i.setAttribute("style","color:white;");
        countCLikc=0;
    }
    }
  })
    



  // responsive asiude menu 
  var checksize=0;
  window.addEventListener("resize",()=>{
    checksize=innerWidth;
    if(checksize<=750){
      document.querySelector('.aside_menu').style.display="none";
      }
      else{
      document.querySelector('.aside_menu').style.display="block";
    
      }
  });

  