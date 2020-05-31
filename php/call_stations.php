<?php
$submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Call Stations</title>
    </head>

    <body>
        <p>Form submitted? <?php echo (int) $submitted; ?></p>
        <p>Up button pressed:       <?php echo $_POST['up_arrow']; ?></p>
        <p>Down button pressed:     <?php echo $_POST['down_arrow']; ?></p>

        <p>&copy; Daniel Dreise</p>

    </body>
</html>