<?php 
	function get_currentDirection(): string {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','admin123');}
		catch (PDOException $e){echo $e->getMessage();}

            // Get current floor from database
            $query = 'SELECT currentFloor FROM elevatorNetwork WHERE nodeID = 1;';
            $cur_floor = $db1->prepare($query);						
            
            $query = 'SELECT destinationFloor FROM elevatorQueue LIMIT 1;';
            $des_floor = $db1->prepare($query);
    
            if ($cur_floor < $des_floor){
                $currentDirection = "up";
            }
            else if ($cur_floor > $des_floor){
                $currentDirection = "down";
            }
			else {
                $currentDirection = "stationary";
            }

			return $currentDirection;
	}
?>

<?php

    $current_direction = get_currentDirection();

?>