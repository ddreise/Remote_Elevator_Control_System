<?php 
	function update_elevatorNetwork(int $node_ID, int $requestedDestination =1, $sourceNode, $requestedDirection): int {
		
		// get current direction
		//include 'get_currentDirection.php';

		// get current position
		//include 'show_floor.php';
		
		$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevatorProject','ese', 'ese');

		// Get next in queue
		$query = 'SELECT destinationFloor FROM elevatorQueue ORDER BY destinationFloor LIMIT 1';	// Prepare query to look at last in queue
		
		// * For state logic 
		//$currentDestination = $db1->prepare($query);										// Get current last current direction

		// * For basic testing
		$nextDestination = $requestedDestination;

		


		// ! STATE LOGIC
/* 
		// if requested destination is greater than current location, go up, unless you're going down
		if ($requestedDestination > $currentFloor){

			if ($currentDestination == NULL || $current_direction != "down"){				// Nothing in queue
				$current_direction = "up";					// Set direction to up
				$nextDestination = $requestedDestination;	// ? Set next destination in queue 
			}

			// If already going up, stop at next floor
			else if ($requestedDirection == "up" && $current_direction == "up"){
				
				// If requested desination is less than next in queue, add to next destination
				if ($requestedDestination < $currentDestination){
					// Add to next immediate in queue
						// Set query to put at top of queue
						// Set next destination and node_ID variables accordingly

				}

				// If requested destination is greater than next in queue, add to queue after greatest next in queue number
				else if ($requestedDestination > $currentDestination){
					// Add after next highest number in queue going up
				}
				
				// If requested destination is current destination, do nothing
				else if ($requestedDestination == $currentDestination);
					// Open doors to go up
				
			}

			// If current direction is down, add to queue after up direction requests are complete
			else if ($requestedDirection == "down" && $current_direction == "up"){
				
				// Add to next "down" section in queue (descending)

			}

			else if ($requestedDirection == "stationary" && $current_direction == "up"){
				// Stay at current location
			}
		}

		// if requested destination is lesser than current location, go down
		if ($requestedDestination < $currentFloor){
			$current_direction = "down";

		}

		// If requested destination is the same as current location, go nowhere
		if ($requestedDestination == $currentFloor){
			$current_direction = "stationary";

		}
 */
		// * UPDATE ELEVATOR QUEUE
	
		$query = 'INSERT INTO elevatorQueue (sourceNode, destinationFloor) VALUES ( :source, :destination);';
		$statement = $db1->prepare($query);
		$statement->bindvalue('source', $sourceNode);
		$statement->bindvalue('destination', $nextDestination);
		$statement->execute();
		
		// * UPDATE ELEVATOR NETWORK DIRECTION
		// Get current destination floor
		$query = 'SELECT destinationFloor FROM elevatorQueue LIMIT 1';
		$rows1 = $db1->query($query);
		foreach ($rows1 as $row1) {
			$desFloor = $row1[0];
		}
		// Get current floor
		$query = 'SELECT currentFloor FROM elevatorNetwork WHERE nodeID = 1';
		$rows2 = $db1->query($query);
		foreach ($rows2 as $row2) {
			$curFloor = $row2[0];
		}
		//echo "<script>console.log('desFloor: " . $desFloor["destinationFloor"] . "     curFloor: " . $curFloor["currentFloor"] . "');</script>";

		if ($desFloor != 1 && $desFloor != 2 && $desFloor != 3) {
			$direction = 'stopped';
		}
		
		// If destination floor is greater than current floor, set to UP
		else if ($desFloor > $curFloor){
			$direction = 'up';
		}

		// If destination floor is less than current floor, set to DOWN
		else if ($desFloor < $curFloor) {
			$direction = 'down';
		}

		// If destination floor is the same as current floor, set to STOPPED
/* 		else if ($desFloor == $curFloor) {
			$direction = 'stopped';
		} */

		// Update elevator network with current direction
		$query = 'UPDATE elevatorNetwork SET status = :direction WHERE nodeID = 1';
		$statement = $db1->prepare($query);
		$statement->bindvalue('direction', $direction);
		$statement->execute();	
		
		return $nextDestination;
	}
?>

<?php
	function update_sabbath($sabbathOperation): int 
	{
		if($sabbathOperation == "toggle")
		{
			$db1 = new PDO('mysql:host=127.0.0.1;dbname=elevatorProject','ese', 'ese');

			$query = 'SELECT sabbathMode FROM elevatorDiagnostics WHERE nodeID=1';
			$rows = $db1->query($query);
			foreach ($rows as $row) {
				$sabbathCurrent = $row[0];
			}

			if($sabbathCurrent == "enabled")
			{
				$sabbathNew = "disabled";
			}
			else 
			{
				$sabbathNew = "enabled";
			}

			$query = 'UPDATE elevatorDiagnostics SET sabbathMode = :sabbath WHERE nodeID=1 ;';
			$statement = $db1->prepare($query);
			$statement->bindvalue('sabbath', $sabbathNew);
			$statement->execute();
		}

		return 0;
	}
?>

<?php



	// Get request
	$temp = $_GET['q'];
	//$destination_floor = NULL;
	//$source_nodeID = NULL;
	//$requested_direction = NULL;

	//include 'get_currentDirection.php';

	$sabbath_operation = "nothing";

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

			if ($current_floor < $destination_floor){
				$requested_direction = "up";
			}

			else if ($current_floor > $destination_floor){
				$requested_direction = "down";
			}

			else {
				$requested_direction = "stationary";
			}

		break;

		case "car_button2":
			$destination_floor  = 2;
			$source_nodeID = 1;

			if ($current_floor < $destination_floor){
				$requested_direction = "up";
			}

			else if ($current_floor > $destination_floor){
				$requested_direction = "down";
			}

			else {
				$requested_direction = "stationary";
			}
			
		break;

		case "car_button3":
			$destination_floor  = 3;
			$source_nodeID = 1;

			if ($current_floor < $destination_floor){
				$requested_direction = "up";
			}

			else if ($current_floor > $destination_floor){
				$requested_direction = "down";
			}

			else {
				$requested_direction = "stationary";
			}
			
		break;

		// * SABBATH MODE
		case "sabbath-operation":
			$destination_floor = NULL;
			$requested_direction = "stationary";
			$sabbath_operation = "toggle";

		// Error or Default requests
		default:
			$destination_floor  = NULL;
			$requested_direction = "stationary";
	}

	$requested_destination = update_elevatorNetwork(1, $destination_floor, $source_nodeID, $requested_direction);		// Send request to elevator network (put into queue)
	$sabbath_result = update_sabbath($sabbath_operation);
?>
