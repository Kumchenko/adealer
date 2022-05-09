window.onload=function(){
    const tel = document.querySelector('.info-bar-tel');
    const feedback = document.querySelector('.info-bar-feedback');
    tel.addEventListener("click", function(){click_button("tel:+380637776363")} );
    feedback.addEventListener("click", function(){click_button("./feedback.html")} );
}


function click_button(nlink) {
    window.open(nlink, "_self")
}