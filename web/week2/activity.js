function clickMe() {

    alert("You clicked the button");
}


function changeColor() {

    var textbox_id = "divColor";
    var textbox = document.getElementById(textbox_id);

    var div_id = "div";
    var div = document.getElementById(div_id);

    var color = textbox.value;
    div.style.backgroundColor = color;
}