//var elfloor = document.getElementById("current_floor");


// Function to get the current floor number
function showQueue() {
    var xmlhttpShow = new XMLHttpRequest();

    // Function to execute whenever readyState changes (e.g. server response ready)
    xmlhttpShow.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var resp = this.responseText;
            document.getElementById("queue").innerHTML = resp;
        }
    };

    xmlhttpShow.open ("GET", "php/show_queue.php?q=", true);          // access PHP file for information
    xmlhttpShow.send();                                               // Send request
}

function showQueueInterval(millisec) {
    setInterval(showQueue, millisec);
}


window.addEventListener("load", function() {showQueueInterval(3000)}, false);
//elfloor.addEventListener("click", function() {showFloor()}, false);



