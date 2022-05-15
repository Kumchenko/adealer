const selectModel = document.getElementById('select-model');
selectModel.addEventListener("change", changeModel);

const selectComponent = document.getElementById('select-component');
selectComponent.addEventListener("change", changeComponent);

const inputCost = document.getElementById('cost');

var first = false;
var second = false;

function changeModel() {
    const modelImage = document.getElementById('form-model-image');
    var url = "url('./assets/images/iphones/" + selectModel.value + ".png')";
    modelImage.style.backgroundImage = url;
    first = true;
    returnCost();
}

function changeComponent() {
    second = true;
    returnCost();
}

function returnCost() {
    if (first && second) {
        inputCost.style.color= "#FF7E36";
        inputCost.value="Розраховую...";

        var url = 'scripts/cost.php?model=' + selectModel.value + "&type=" + selectComponent.value;

        // var formData = new FormData();
        // formData.append('model', selectModel.value);
        // formData.append('type', selectComponent.value);
        fetch(url, {
            method: 'GET',
        }).then(response => response.json())
        .then((data) =>  changeCost(data))
    }
}

function changeCost(cost) {
    inputCost.style.color= "#873101";
    inputCost.value=cost + " грн";
}