<html>
        <h1>ESE Project VI Elevator</h1>

                <?php
                        if(isset($_POST['newfloor'])) {
                                $curFlr = update_elevatorNetwork(1, $_POST['newfloor']);
                                header('Refresh:0; url=index.php');
                        }
                        $curFlr = get_currentFloor();
                        echo "<h2>Current floor # $curFlr </h2>";
                ?>

                <h2>
                        <form action="index.php" method="POST">
                                Request floor # <input type="number" style="width:50px; height:40px" name="newfloor" max=3 min=1 required />
                                <input type="submit" value="Go"/>
                        </form>
                </h2>


</html>


pi@raspberrypi:/var/www/default_controls $ nano index.php
  GNU nano 2.7.4                                                               File: index.php

                        $curFlr = get_currentFloor();
                        echo "<h2>Current floor # $curFlr </h2>";
                ?>

                <h2>
                        <form action="index.php" method="POST">
                                Request floor # <input type="number" style="width:50px; height:40px" name="newfloor" max=3 min=1 required />
                                <input type="submit" value="Go"/>
                        </form>
                </h2>
