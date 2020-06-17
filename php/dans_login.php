<?php 
// Variable for how many forms submitted
$submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Form Handler Page</title>
    </head>

    <body>
        <p>Form submitted? <?php echo (int) $submitted; ?></php> <!-- number of forms submitted -->
        <p>Your login info is:</p>
        <ul>
            <li><b>Username:</b> <?php echo $_POST['username']; ?></li> <!-- Looks for inputted "username"-->
            <li><b>Password:</b> <?php echo $_POST['password']; ?></li>
        </ul>

        <p>&copy; Daniel Dreise</p>

    </body>
</html>