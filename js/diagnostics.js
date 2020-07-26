// Function to get the current floor number
function updateStatus() {
    var xmlhttpShow = new XMLHttpRequest();

    // Function to execute whenever readyState changes (e.g. server response ready)
    xmlhttpShow.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var resp = this.responseText;
            var direction;
            var doors;
            document.getElementById("statusFloor").innerHTML = "Floor: " + resp[11];

            if(resp[12] == 0) direction = "down";
            else if(resp[12] == 1) direction = "none";
            else if(resp[12] == 2) direction = "up";
            document.getElementById("statusDirection").innerHTML = "Direction: " + direction;
            
            if(resp[13] == 0) doors = "closed";
            else doors = "open";
            document.getElementById("statusDoors").innerHTML = "Doors: " + doors;
            
            document.getElementById("statusNodeID").innerHTML = "Node ID: " + resp[14];
            document.getElementById("statusCounter").innerHTML = "Counter: " + resp[15];

        }
    };

    xmlhttpShow.open ("GET", "php/diagnostics.php?q=", true);          // access PHP file for information
    xmlhttpShow.send();                                               // Send request
}

function statusUpdateInterval(millisec) {
    setInterval(updateStatus, millisec);
}


window.addEventListener("load", function() {statusUpdateInterval(1000)}, false);
//elfloor.addEventListener("click", function() {showFloor()}, false);



