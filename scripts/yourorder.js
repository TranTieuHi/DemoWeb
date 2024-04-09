var i = 0;
var prewidth = 0;

function move(prewidth) {
    if (i === 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = prewidth;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= prewidth + 25) {
                clearInterval(id);
                i = 0;
            } else {
                width++;
                elem.style.width = width + "%";
            }
        }
    }
}

function changeColor(elementId) {
    var element1 = document.getElementById(elementId);
    element1.style.backgroundColor = "#04AA6D";
}

setTimeout(changeColor, 2000);