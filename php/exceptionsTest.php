<?php

require_once("exceptions.php");
require_once("helpfulFunctions.php");

function testFloorNodeID(int $floorID)
{
    $message = null;

    try
    {
        $floor = new FloorNode($floorID);
    }
    catch (InvalidNodeIDException $e)
    {
        $message = $e->getMessage();
    }

    $message = $message ?: "pass";

    echo "Floor Node ID = " . $floorID . ": " . $message . "<br />";
}

function testFloor(int $floorNumber)
{
    $message = null;
    $SC = new SupervisoryController();

    try
    {
        $SC->setFloor($floorNumber);
    }
    catch (InvalidFloorException $e)
    {
        $message = $e->getMessage();
    }

    $message = $message ?: "pass";

    echo "Floor = " . $floorNumber . ": " . $message . "<br />";
}

function testStatus($status)
{
    $message = null;
    $SC = new SupervisoryController();

    try
    {
        $SC->setStatus($status);
    }
    catch (InvalidStatusException $e)
    {
        $message = $e->getMessage();
    }

    $message = $message ?: "pass";

    if(is_bool($status) && $status == false) $status = "false";
    else if(is_bool($status) && $status == true) $status = "true";

    echo "Status = " . $status . ": " . $message . "<br />";
}

function testDirection($direction)
{
    $message = null;
    $SC = new SupervisoryController();

    try
    {
        $SC->setStatus($status);
    }
    catch (InvalidStatusException $e)
    {
        $message = $e->getMessage();
    }

    $message = $message ?: "pass";

    if(is_bool($status) && $status == false) $status = "false";
    else if(is_bool($status) && $status == true) $status = "true";

    echo "Status = " . $status . ": " . $message . "<br />";
}

#Testing node ID exception
echo "Node ID Test: <br />";
testFloorNodeID(-1);
testFloorNodeID(0);
testFloorNodeID(1);
echo "<br />";

# Testing floor exception
echo "Floor Test: <br />";
testFloor(-1);
testFloor(0);
testFloor(1);
testFloor(4);
echo "<br />";

# Testing status exception
echo "Status Test: <br />";
testStatus(true);
testStatus(false);
testStatus(21);

# Testing direction exception
echo "Direction Test: <br />";
?>