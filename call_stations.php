<?php
	function update_elevatorNetwork(int $node_ID, int $new_floor =1): int {
        $db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','Iloveschool24!');
        $db1->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'UPDATE CAN_subNetwork SET CAN_currentFloor = :floor WHERE CAN_nodeID = :id';
		$statement = $db1->prepare($query);
		$statement->bindvalue('floor', $new_floor);
		$statement->bindvalue('id', $node_ID);
		$statement->execute();	
		
		return $new_floor;
    }
    
    if(isset($_POST['newfloor'])) {
        $curFlr = update_elevatorNetwork(1, $_POST['newfloor']); 
        header('Refresh:0; url=call_stations.php');	
    } 

    require('call_stations.html');      // Use call_stations.html as user interface
?>

