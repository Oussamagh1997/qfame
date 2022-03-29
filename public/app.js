require('../resources/js/bootstrap');



function UpdateForm() {

    let x = document.getElementById('year');
    x.value = selectedIndex;
    document.getElementId('yr').innerHTML = x.value;
}

$(document).ready(function() {
    $("#year").change(function(){
        $("#country_hidden").val(("#year").find(":selected").text());
    });
});



