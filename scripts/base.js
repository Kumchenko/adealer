const tel = document.querySelector('.info-bar-tel');
const feedback = document.querySelector('.info-bar-feedback');
const callback = document.querySelector('.footer-callback');

const menu = document.querySelector('.nav-menu-logo');
const header = document.getElementsByClassName('header')[0];
const nav_bar_wrapper = document.querySelector('.nav-bar-wrapper');
const nav_pages = document.querySelector('.nav-pages');
const nav_social_wrapper = document.querySelector('.nav-social-wrapper');

opened = false;

tel.addEventListener("click", function(){click_button("tel:+380637776363")} );
feedback.addEventListener("click", function(){click_button("./feedback.html")} );
callback.addEventListener("click", function(){click_button("./feedback.html")} );
menu.addEventListener("click", function(){menu_show()} );


function click_button(nlink) {
    window.open(nlink, "_self")
}

function menu_changing(hh, nh, display) {
    header.style.height = hh;
    nav_bar_wrapper.style.height = nh;
    nav_pages.style.display = nav_social_wrapper.style.display = display;
}

function menu_show() {
    if(!opened) {
        menu_changing("352px", "282px", "flex");
        opened = true;
    }
    else {
        menu_changing("140px", "70px", "none");
        opened = false;
    }
}

window.addEventListener('resize', function(event){
    if (document.documentElement.clientWidth > 589) {
        header.style.height="140px";
        nav_bar_wrapper.style.height="70px";
        nav_pages.style.display = nav_social_wrapper.style.display = "flex";
    }
    else {
        if(opened)
            menu_changing("352px", "282px", "flex");
        else
            menu_changing("140px", "70px", "none");
    }
});