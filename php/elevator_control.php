<?php
    $submitted = !empty($_POST);
    echo isset($_POST['floor1_up']);
    $floor1 = 1;
    $floor2 = 2;
    $floor3 = 3;
?>

<?php 
    // Get the current floor number. Adapted from Michael Galle's code
    function get_currentFloor(): int {
            try { $db = new PDO('mysql:host=127.0.0.1;dbname=projectVI','admin','raspberry');}
            catch (PDOException $e){echo $e->getMessage();}

                    // Query the database to display current floor
                    $rows = $db->query('SELECT currentFloor FROM elevatorNetwork');
                    foreach ($rows as $row) {
                            $current_floor = $row[0];
                    }
                    return $current_floor;
    }

    // Update the elevator network with the current target floor
    function update_elevatorNetwork(int $node_ID, int $new_floor): int {
            $db1 = new PDO('mysql:host=127.0.0.1;dbname=projectVI','admin','raspberry');
            $query = 'UPDATE elevatorNetwork 
                            SET currentFloor = :floor
                            WHERE nodeID = :id';
            $statement = $db1->prepare($query);
            $statement->bindvalue('floor', $new_floor);
            $statement->bindvalue('id', $node_ID);
            $statement->execute();  

            return $new_floor;
    }

    // Check for floor requests upon loading the page
    function get_floorRequest(): int {
        if(isset($_POST['floor1_up'])){
            update_elevatorNetwork(1, 2); 
        }
        else if(isset($_POST['floor2_up'])){
            update_elevatorNetwork(1, 3); 
        }
        else if(isset($_POST['floor2_down'])){
            update_elevatorNetwork(1, 1); 
        }
        else if(isset($_POST['floor3_down'])){
            update_elevatorNetwork(1, 2); 
        }
        header('Refresh:0; url=php/call_stations.php');
        return 0;
    }
    //$curFlr = get_currentFloor();
?>