<?php 
	function update_elevatorNetwork(int $node_ID, int $new_floor =1): int {
		$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','Iloveschool24!');
		$query = 'UPDATE CAN_subNetwork 
				SET CAN_currentFloor = :floor
				WHERE CAN_nodeID = :id';
		$statement = $db1->prepare($query);
		$statement->bindvalue('floor', $new_floor);
		$statement->bindvalue('id', $node_ID);
		$statement->execute();	
		
		return $new_floor;
	}
?>

<?php

	$request = $_GET['q'];
	if ($request == "floor3_down"){
		$sendRequest = 2;
	}
	else if ($request == "floor2_up"){
		$sendRequest = 3;
	}
	else if ($request == "floor2_down"){
		$sendRequest = 1;
	}
	else if ($request == "floor1_up"){
		$sendRequest = 2;
	}
	else {
		$sendRequest = NULL;
	}

	$new_floor = update_elevatorNetwork(1, $sendRequest);
	//echo $new_floor;



?>