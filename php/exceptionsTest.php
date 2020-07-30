<?php

include "exceptions.php";
include "helpfulFunctions.php";

# Testing node ID exception
function getNodeID(int $id)
{
    if($id < 0)
    {
        throw new InvalidNodeIDException('Node IDs cannot be negative.');
    }
    else
    {
        throw new Exception('Node ID acceptable');
    }
}

function testNodeID(int $id)
{
    try
    {
        getNodeID($id);
    }
    catch (InvalidNodeIDException $e)
    {
        echo $e->getMessage();
    }
    catch (Exception $e)
    {
        echo $e->getMessage();
    }
}

echo "Node ID Test: <br />";
echo "Get ID = -1: "; testNodeID(-1);
echo "<br />Get ID = 0: "; testNodeID(0);
echo "<br />Get ID = 1: "; testNodeID(1);

# Testing floor exception


?>