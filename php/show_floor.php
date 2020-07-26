<?php 
	function get_currentFloor(): int {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','Iloveschool24!');}
		catch (PDOException $e){echo $e->getMessage();}

            // Query the database to display current floor
            $query = 'SELECT CAN_currentFloor FROM CAN_subNetwork';
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