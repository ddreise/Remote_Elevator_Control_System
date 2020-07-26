<?php 
	function get_currentDirection(): int {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','Iloveschool24!');}
		catch (PDOException $e){echo $e->getMessage();}

            // Get current floor from database
            $query = 'SELECT CAN_currentFloor FROM CAN_subNetwork;';
            $cur_floor = $db1->prepare($query);						
            
            $query = 'SELECT destinationFloor FROM elevatorQueue LIMIT 1;';
            $des_floor = $db1->prepare($query);
    
            if ($cur_floor < $des_floor){
                $direction = "up";
            }
            else if ($cur_floor > $des_floor){
                $direction = "down";
            }
			else {
                $direction = "stationary";
            }

			return $direction;
	}
?>

<?php

    $current_direction = get_currentDirection();

?>