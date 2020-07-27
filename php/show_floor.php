<?php 
	function get_currentFloor(): int {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevatorProject','ese', 'ese');}
		catch (PDOException $e){echo $e->getMessage();}

            // Query the database to display current floor
            $query = 'SELECT currentFloor FROM elevatorNetwork WHERE nodeID = 1';
			$rows = $db->query($query);
			foreach ($rows as $row) {
                $current_floor = $row[0];
			}
			return $current_floor;
	}
?>

<?php

    $currentFloor = get_currentFloor();
	echo $currentFloor;
	
	

?>