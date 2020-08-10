// * Used to update elevator database when button is pushed

var floor3_down = document.getElementById("floor3_down");
var floor2_up = document.getElementById("floor2_up");
var floor2_down = document.getElementById("floor2_down");
var floor1_up = document.getElementById("floor1_up");
var car_button1 = document.getElementById("car_button1");
var car_button2 = document.getElementById("car_button2");
var car_button3 = document.getElementById("car_button3");
var sabbath_operation = document.getElementById("sabbath_operation");


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
floor2_up.addEventListener("click", function() {update_elevatorNetwork("floor2_up")}, false);
floor2_down.addEventListener("click", function() {update_elevatorNetwork("floor2_down")}, false);
floor1_up.addEventListener("click", function() {update_elevatorNetwork("floor1_up")}, false);
car_button1.addEventListener("click", function() {update_elevatorNetwork("car_button1")}, false);
car_button2.addEventListener("click", function() {update_elevatorNetwork("car_button2")}, false);
car_button3.addEventListener("click", function() {update_elevatorNetwork("car_button3")}, false);
sabbath_operation.addEventListener("click", function() {update_elevatorNetwork("sabbath_operation")}, false);





