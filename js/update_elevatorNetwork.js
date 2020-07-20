// * Used to update elevator database when button is pushed

var floor3_down = document.getElementById("floor3_down");
var floor2_up = document.getElementById("floor2_up");
var floor2_down = document.getElementById("floor2_down");
var floor1_up = document.getElementById("floor1_up");


// Function to get the current floor number
function update_elevatorNetwork(floor_request) {
    var xmlhttpShow = new XMLHttpRequest();

    // Function to execute whenever readyState changes (e.g. server response ready)
    xmlhttpShow.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var resp = this.responseText;
            document.getElementById(floor_request).innerHTML = resp;
        }
    };

    console.log(floor_request);
    xmlhttpShow.open ("GET", "php/update_elevatorNetwork.php?q=" + floor_request, true);          // access PHP file for information
    xmlhttpShow.send();                                               // Send request
}

function showFloorInterval(millisec) {
    setInterval(showFloor, millisec);
}


//window.addEventListener("load", function() {showFloorInterval(3000)}, false);
floor3_down.addEventListener("click", function() {update_elevatorNetwork("floor3_down")}, false);



