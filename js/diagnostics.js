// Function to get the current floor number
function updateStatus() {
    var xmlhttpShow = new XMLHttpRequest();

    // Function to execute whenever readyState changes (e.g. server response ready)
    xmlhttpShow.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var resp = JSON.parse(this.responseText);
            var direction;
            var doors;
            document.getElementById("statusFloor").innerHTML = "Floor: " + resp[0];

            if(resp[1] == 0) direction = "down";
            else if(resp[1] == 1) direction = "none";
            else if(resp[1] == 2) direction = "up";
            document.getElementById("statusDirection").innerHTML = "Direction: " + direction;
            
            if(resp[2] == 0) doors = "closed";
            else doors = "open";
            document.getElementById("statusDoors").innerHTML = "Doors: " + doors;
            
            document.getElementById("statusNodeID").innerHTML = "Node ID: " + resp[3];
            document.getElementById("statusF1Visits").innerHTML = "Floor 1 Visits: " + resp[4];
            document.getElementById("statusF2Visits").innerHTML = "Floor 2 Visits: " + resp[5];
            document.getElementById("statusF3Visits").innerHTML = "Floor 3 Visits: " + resp[6];
        }
    };

    xmlhttpShow.open ("GET", "php/diagnostics.php?q=", true);          // access PHP file for information
    xmlhttpShow.send();                                               // Send request
}

function statusUpdateInterval(millisec) {
    setInterval(function() {updateStatus();}, millisec);
}

function graph()
{
    var ctx = document.getElementById('chartFloorVisits').getContext('2d');
    var floorVisits = [0, 0, 0];
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Floor 1', 'Floor 2', 'Floor 3'],
            datasets: [{
                label: 'Floor Visits',
                data: floorVisits,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    setInterval(function(){
        var xmlhttpShow = new XMLHttpRequest();

        // Function to execute whenever readyState changes (e.g. server response ready)
        xmlhttpShow.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                var resp = JSON.parse(this.responseText);

                myChart.data.datasets[0].data[0] = resp[4];
                myChart.data.datasets[0].data[1] = resp[5];
                myChart.data.datasets[0].data[2] = resp[6];
            }
        };

        xmlhttpShow.open ("GET", "php/diagnostics.php?q=", true);          // access PHP file for information
        xmlhttpShow.send();                                               // Send request

        myChart.update();
    }, 2000);
}

window.addEventListener("load", function() {statusUpdateInterval(2000); graph();}, false);
//elfloor.addEventListener("click", function() {showFloor()}, false);



