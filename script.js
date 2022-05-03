window.onload=function(){
    const select = document.getElementById('select-model');
    select.addEventListener("change", changeModel);
}


function changeModel() {
    const modelImage = document.getElementById('form-model-image');
    var url = "url('../assets/images/iphones/" + this.value + ".png')";
    modelImage.style.backgroundImage = url;
}