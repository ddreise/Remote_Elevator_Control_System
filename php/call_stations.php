<?php
/*     session_start();

    if(!isset($_SESSION['username'])) {
        header("Location: ../index.html");
    } else {
        header("Location: ../call_stations.html");
    } */
?>

<?php
    $submitted = !empty($_POST);
    $floor1 = 1;
    $floor2 = 2;
    $floor3 = 3;
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
<?php
        function update_elevatorNetwork(int $node_ID, int $new_floor =1): int {
                $db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ese','ese');
                $query = 'UPDATE elevatorNetwork 
                                SET currentFloor = :floor
                                WHERE nodeID = :id';
                $statement = $db1->prepare($query);
                $statement->bindvalue('floor', $new_floor);
                $statement->bindvalue('id', $node_ID);
                $statement->execute();  

                return $new_floor;
        }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Call Stations</title>
    </head>

    <body>
        <h1>Call Stations</h1> 

        <h2>Current Floor</h2>
        <fiedset>
            <!-- need to compensate for floor1_up convert to number -->
            <?php 
                    if(isset($_POST['floor1_up'||'floor1_down'])){
                        $curFlr = update_elevatorNetwork(1, $floor1); 
                        header('Refresh:0; url=php/call_stations.php');
                    }
                    $curFlr = get_currentFloor();
                    echo "<h2>Current floor # $curFlr </h2>";
            ?>
        </fielset>

        <h2>Floor Request</h2>  
        <form action="php/call_stations.php" method="POST">
                Request floor # <input type="number" style="width:50px; height:40px" name="newfloor" max=3 min=1 required />
                <input type="submit" value="Go"/>
        </form>

        <form action="php/call_stations.php" method="POST">
            <h2>Call Elevator</h2>
            <fieldset>
                <legend>Floor 1</legend>
                    <!--Up arrow button image-->
                    <input name="floor1_up" type="image" src="images/up_arrow.png" value="UP" alt="up_arrow" width="40"/>

                    <!--Down arrow button image-->
                    <input name="floor1_down" type="image" src="images/down_arrow.png" value="DOWN" alt="down_arrow" width="40"/>
                </p> 
            </fieldset>

            <fieldset>
                <legend>Floor 2</legend>
                    <!--Up arrow button image-->
                    <input name="floor2_up" type="image" src="images/up_arrow.png" value="UP" alt="up_arrow" width="40"/>

                    <!--Down arrow button image-->
                    <input name="floor2_down" type="image" src="images/down_arrow.png" value="DOWN" alt="down_arrow" width="40"/>
                </p> 
            </fieldset>

            <fieldset>
                <legend>Floor 3</legend>
                    <!--Up arrow button image-->
                    <input name="floor3_up" type="image" src="images/up_arrow.png" value="UP" alt="up_arrow" width="40"/>

                    <!--Down arrow button image-->
                    <input name="floor3_down" type="image" src="images/down_arrow.png" value="DOWN" alt="down_arrow" width="40"/>
                </p> 
            </fieldset>
        </form>



        <!--
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

            -->

        <p>&copy; Daniel Dreise</p>

    </body>
</html>