window.onload=function(){
    const select = document.getElementById('select-model');
    const tel = document.querySelector('.info-bar-tel');
    const feedback = document.querySelector('.info-bar-feedback');
    const callback = document.querySelector('.footer-callback');
    tel.addEventListener("click", function(){click_button("tel:+380637776363")} );
    feedback.addEventListener("click", function(){click_button("./feedback.html")} );
    callback.addEventListener("click", function(){click_button("./feedback.html")} );
    select.addEventListener("change", changeModel);
}


function changeModel() {
    const modelImage = document.getElementById('form-model-image');
    var url = "url('./assets/images/iphones/" + this.value + ".png')";
    modelImage.style.backgroundImage = url;
}

function click_button(nlink) {
    window.open(nlink, "_self")
}