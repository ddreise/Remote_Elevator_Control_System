<?php

$db = new PDO(
        'mysql:host=127.0.0.1;dbname=elevatorProject', // Data source name
        'ese',                            // Username
        'ese'                                  // Password
);

// Return arrays with keys that are the name of the fields.
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// $rowFloor = 0;
// $directon;
// $rowDoors;
// $rowNodeID = 0;
// $f1Visits = 0;
// $f2Visits = 0;
// $f3Visits = 0;

$queueID = 0;
$direction = "";
$doors = "";
$floor1Visits = 0;
$floor2Visits = 0;
$floor3Visits = 0;

$diagnostics = $db->query('SELECT * FROM elevatorDiagnostics ORDER BY nodeID');
foreach ($diagnostics as $diagnostic)
{
    $queueID = $diagnostic['queueID'];
    $direction = $diagnostic['direction'];
    $doors = $diagnostic['doors'];
    $floor1Visits = $diagnostic['floor1Visits'];
    $floor2Visits = $diagnostic['floor2Visits'];
    $floor3Visits = $diagnostic['floor3Visits'];
}

// $rows = $db->query('SELECT * FROM elevatorQueue ORDER BY queueNumber');

// foreach ($rows as $row)
// {
//     if($row['queueNumber'] > $rowNodeID)
//     {
//         $rowFloor = $row['destinationFloor'];
//         //$rowDirection = $row['direction'];
//         //$rowDoors = $row['doors'];
//         $rowNodeID = $row['queueNumber'];
//     }   

//     switch($row['destinationFloor'])
//     {
//         case 1:
//             $f1Visits++;
//         break;
//         case 2:
//             $f2Visits++;
//         break;
//         case 3:
//             $f3Visits++;
//     }
// }

$output = [$queueID, $direction, $doors, $floor1Visits, $floor2Visits, $floor3Visits];

echo json_encode($output);

?>
