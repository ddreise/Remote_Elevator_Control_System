<?php
$submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Request Access</title>
    </head>

    <body>
        <p>Form submitted? <?php echo (int) $submitted; ?></p>
        <p><b>Your Contact Details:</b>
            <ul>
                <li>First name:         <?php echo $_POST['firstname']; ?></li>
                <li>Last name:          <?php echo $_POST['lastname']; ?></li>
                <li>Email:              <?php echo $_POST['email']; ?></li>
                <li>Student or Faculty: <?php echo $_POST['student_or_faculty']; ?></li>
                <li>Burritos:           <?php echo $_POST['burritos']; ?></li>
                <li>Comments:           <?php echo $_POST['comments']; ?></li>
            </ul>
        </p>

        <p>&copy; Daniel Dreise</p>

    </body>
</html>
