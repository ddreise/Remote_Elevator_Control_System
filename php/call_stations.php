<?php
$submitted = !empty($_GET);
?>

<!-- Function for getting current floor number. Taken from Michael Galle's code -->
<?php 
        function get_currentFloor(): int {
                try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevator','ese','ese');}
                catch (PDOException $e){echo $e->getMessage();}

                        // Query the database to display current floor
                        $rows = $db->query('SELECT currentFloor FROM elevatorNetwork');
                        foreach ($rows as $row) {
                                $current_floor = $row[0];
                        }
                        return $current_floor;
        }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Call Stations</title>
    </head>

    <body>
        <p>Form submitted? <?php echo (int) $submitted; ?></p>
        <h3>Floor 1</h3>
        <ul>
            <li>Up button pressed:  <?php echo $_GET['floor1_up_x']; ?></li>
            <li>Down button pressed:  <?php echo $_GET['floor1_down_x']; ?></li>
        </ul>

        <h3>Floor 2</h3>
        <ul>
            <li>Up button pressed:  <?php echo $_GET['floor2_up_x']; ?></li>
            <li>Down button pressed:  <?php echo $_GET['floor2_down_x']; ?></li>
        </ul>

        <h3>Floor 3</h3>
        <ul>
            <li>Up button pressed:  <?php echo $_GET['floor3_up_x']; ?></li>
            <li>Down button pressed:  <?php echo $_GET['floor3_down_x']; ?></li>
        </ul>

        <!-- Whatever is received, send command to Elevator Controller to move the car to that floor (state machine dependent) -->

        <p>&copy; Daniel Dreise</p>

    </body>
</html>