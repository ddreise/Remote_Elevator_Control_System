<?php 
	function update_elevatorNetwork(int $node_ID, int $new_floor =1, $sourceNode, $requested_direction): int {
		
		$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','Iloveschool24!');

		// ! STATE LOGIC
/* 		// get current direction
		include 'get_currentDirection.php';

		// get current position
		include 'show_floor.php';

		// Get oldest in queue (next in queue)
		$query = 'SELECT requestedFloor FROM elevatorQueue ORDER BY Q_queue_number LIMIT 1';	// Prepare query to look at last in queue
		$statement = $db1->prepare($query);														// Get current last current direction
		
		if ($requested_direction == $current_direction){
			// if requested floor number is in same direction AND NOT behind, add to queue
			if ($current_direction == "up"){
				if ($destination_floor >= $currentFloor){
					// IF floor request is lower than next in queue, add to next in queue
					if ($destination_floor <= $statement){

					}
					// ELSE add above next down direction request
					else {

					}
				}
				else {
					// put at end of queue
				}
			}

			else if ($current_direction == "down"){
				if($destination_floor <= $currentFloor){
					// add to next in queue
					// if floor request is higher than next in queue request, add to next in queue
				}
				else {
					// put at end of queue
				}
			}

			else if ($current_direction == NULL) {		// empty queue
				// put next in queue
			}

			else {
				// put nothing in queue
			}
		}

		else if ($requested_direction != $current_direction){
			// add request to end of queue
		} */

		// * UPDATE ELEVATOR QUEUE
		$query = 'INSERT INTO elevatorQueue (sourceNode, destinationFloor) VALUES ( :source, :destination);';
		$statement = $db1->prepare($query);
		$statement->bindvalue('source', $sourceNode);
		$statement->bindvalue('destination', $new_floor);
		$statement->execute();
		
		// * UPDATE ELEVATOR NETWORK
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

	// Get request
	$temp = $_GET['q'];

	// Convert requests to integer
	switch ($temp) {
		
		// * CALL STATION REQUESTS
		case "floor3_down":
			$destination_floor = 3;
			$source_nodeID = 4;
			$requested_direction = "down";
		break;

		case "floor2_up":
			$destination_floor = 2;
			$source_nodeID = 3;
			$requested_direction = "up";
		break;

		case "floor2_down":
			$destination_floor = 2;
			$source_nodeID = 3;
			$requested_direction = "down";
		break;

		case "floor1_up":
			$destination_floor  = 1;
			$source_nodeID = 2;
			$requested_direction = "up";
		break;

		// * ELEVATOR CAR REQUESTS
		case "car_button1":
			$destination_floor  = 1;
			$source_nodeID = 1;
		break;

		case "car_button2":
			$destination_floor  = 2;
			$source_nodeID = 1;
		break;

		case "car_button3":
			$destination_floor  = 3;
			$source_nodeID = 1;
		break;

		// Error or Default requests
		default:
			$destination_floor  = NULL;
			$requested_direction = NULL;
	}

	
	

	
	// Get current floor 
	//$current_floor = include 'show_floor.php';


/* 	// If elevator car buttons pressed
	if($temp == "car_button1" || "car_button2" || "car_button3"){
		// If lower floor request
		if ($destination_floor  < $current_floor) {
			$direction = "down";			// up, down, and null (for no direction (nothing in queue))
		}

		// If current floor request (open door)
		// TODO: add open door function
		else if ($destination_floor == $current_floor) {
			$direction = NULL;
		}

		// If higher floor request
		else if ($destination_floor  > $current_floor) {
			$direction = "up";
		}

		else {
			$direction = NULL;				// If error or other number than 1, 2, 3, send NULL
		} */
	//}

	$new_floor = update_elevatorNetwork(1, $destination_floor, $source_nodeID, $requested_direction);		// Send request to elevator network (put into queue)
?>