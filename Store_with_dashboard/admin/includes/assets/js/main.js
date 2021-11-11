// show admin here 
var admin_show = document.getElementById("show_ad");
var admin_close_show = document.getElementById("close_ad");
var admin_view =document.querySelector(".show_admin");


admin_show.addEventListener("click",()=>{
    admin_view.classList.add("sh_ad");
    admin_show.style.display="none";
    admin_close_show.style.display="inline-block";
});

admin_close_show.addEventListener("click",()=>{
    admin_view.classList.remove("sh_ad");
    admin_show.style.display="inline-block";
    admin_close_show.style.display="none";
});

// show and close aside mnue 
var menu_show = document.getElementById("sh_aside_menu");
var menu_close = document.getElementById("close_aside_menu");
var menu_view =document.querySelector(".aside-nav");

menu_show.addEventListener("click",()=>{
    menu_view.classList.add("sh_menu");
    menu_show.style.display="none";
    menu_close.style.display="inline-block";
});

menu_close.addEventListener("click",()=>{
    menu_view.classList.remove("sh_menu");
    menu_show.style.display="inline-block";
    menu_close.style.display="none";
});