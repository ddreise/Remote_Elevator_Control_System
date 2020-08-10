//var elfloor = document.getElementById("current_floor");


// Function to get the sabbath mode
function showSabbath() {
    var xmlhttpShow = new XMLHttpRequest();

    // Function to execute whenever readyState changes (e.g. server response ready)
    xmlhttpShow.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var resp = this.responseText;
            document.getElementById("sabbath-display").innerHTML = resp;
        }
    };

    xmlhttpShow.open ("GET", "php/show_sabbath.php?q=", true);          // access PHP file for information
    xmlhttpShow.send();                                               // Send request
}

function showSabbathInterval(millisec) {
    setInterval(showSabbath, millisec);
}


window.addEventListener("load", function() {showSabbathInterval(3000)}, false);
//elfloor.addEventListener("click", function() {showFloor()}, false);



