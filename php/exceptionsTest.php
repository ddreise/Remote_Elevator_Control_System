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

function testDatabase($host, $database, $user, $pass)
{
    $message = null;

    try
    {
        $db = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);
    }
    catch (PDOException $e)
    {
        $message = $e->getMessage();
    }

    $message = $message ?: "pass";

    echo "host = $host, db = $database, user = $user, pass = $pass -> " . $message . "<br />";
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
echo "<br />";

# Testing database connection exception
echo "Database test: <br />";
testDatabase("127.0.0.1", "elevatorProject", "ese", "ese");
testDatabase("localhost", "elevatorProject", "ese", "ese");
testDatabase("65.54.32.12", "elevatorProject", "ese", "ese");
testDatabase("localhost", "project", "ese", "ese");
testDatabase("localhost", "elevatorProject", "ese12", "ese");
testDatabase("localhost", "elevatorProject", "ese", "ese12");
?>