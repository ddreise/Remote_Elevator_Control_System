<?php
$submitted = !empty($_GET);
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


        <p>&copy; Daniel Dreise</p>

    </body>
</html>