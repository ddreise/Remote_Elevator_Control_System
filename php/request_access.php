<?php
$submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Access Handler</title>
    </head>
    <body>
        <p>Form submitted? <?php echo (int) $submitted; ?> </p>
        <p>Access info received is:</p>
        <ul>
            <li><b>First Name</b>: <?php echo $_POST['firstname']; ?> </li>
            <li><b>Last Name</b>: <?php echo $_POST['lastname']; ?> </li>
            <li><b>Email</b>: <?php echo $_POST['email']; ?> </li>
            <li><b>Website</b>: <?php echo $_POST['url']; ?> </li>
            <li><b>Birthday</b>: <?php echo $_POST['birthday']; ?> </li>

            <li><b>Faculty or Student</b>: <?php echo $_POST['fac_or_student']; ?> </li>

            <li><b>You currently</b>: <?php echo $_POST['life'][0], $_POST['life'][1], $_POST['life'][2]; ?> </li>

            <li><b>You commented</b>: <?php echo $_POST['comments']; ?> </li>

            <li><b>Were you honest</b>? <?php echo $_POST['honesty']; ?> </li>

        </ul>
</body>
</html>