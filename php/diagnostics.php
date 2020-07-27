<?php

$db = new PDO(
        'mysql:host=127.0.0.1;dbname=elevatorProject', // Data source name
        'ese',                            // Username
        'ese'                                  // Password
);

// Return arrays with keys that are the name of the fields.
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$rows = $db->query('SELECT * FROM elevatorQueue ORDER BY queueNumber');
$rowFloor = 0;
$rowDirecton = 0;
$rowDoors = 0;
$rowNodeID = 0;
$f1Visits = 0;
$f2Visits = 0;
$f3Visits = 0;

foreach ($rows as $row)
{
    if($row['queueNumber'] > $rowNodeID)
    {
        $rowFloor = $row['destinationFloor'];
        //$rowDirection = $row['direction'];
        //$rowDoors = $row['doors'];
        $rowNodeID = $row['queueNumber'];
    }   

    switch($row['destinationFloor'])
    {
        case 1:
            $f1Visits++;
        break;
        case 2:
            $f2Visits++;
        break;
        case 3:
            $f3Visits++;
    }
}

$output = [$rowFloor, $rowDirection, $rowDoors, $rowNodeID, $f1Visits, $f2Visits, $f3Visits];

echo json_encode($output);

?>
