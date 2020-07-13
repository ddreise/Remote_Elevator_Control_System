/* var $floor1_up = document.getElementById("floor1_up");
var $floor2_up = document.getElementById("floor2_up");
var $floor2_down = document.getElementById("floor2_down");
var $floor3_down = document.getElementById("floor3_down"); */

//var elfloor = document.getElementById("current_floor");


// Function to get the current floor number
function showFloor() {
    var xmlhttpShow = new XMLHttpRequest();

    // Function to execute whenever readyState changes (e.g. server response ready)
    xmlhttpShow.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var resp = this.responseText;
            document.getElementById("floor").innerHTML = resp;
        }
    };

    xmlhttpShow.open ("GET", "php/show_floor.php?q=", true);          // access PHP file for information
    xmlhttpShow.send();                                               // Send request
}

function showFloorInterval(millisec) {
    setInterval(showFloor, millisec);
}


window.addEventListener("load", function() {showFloorInterval(3000)}, false);
//elfloor.addEventListener("click", function() {showFloor()}, false);



