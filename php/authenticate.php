<?php
    //SESSIONS
    session_start(); // Starts a session and creates a session variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username && $password) {
        // Connect to database
        $db = new PDO(
            'mysql:host=127.0.0.1;dbname=elevatorProject' ,     // Database name
            'ese',                                              // Username
            'ese'                                               // Password
        );
        // Query the authorizedUsers table
        $authenticateted = FALSE;
        $rows = $db->query('SELECT * FROM authorizedUsers ORDER BY id');
        foreach($rows as $row) {
            if ($username == $row[1] && $password == $row[2]) {
                $authenticateted = TRUE;
            }
        }
        if($authenticateted == TRUE) {
            $_SESSION['username']=$username;    // Store a session variable
            //echo "<p>Congratulations, you are now logged into the site.</p>";
            //echo "<p>Please click <a href=\"member.php\">here</a> to be taken to our memers only page </p>";
            header("Location: ../call_stations.html");
        } else {
            //echo "<p>You are not authenticated</p>";
            //echo "Please check your username and password and click <a href='login.html'>here</a> to log in again.";
            header("Location: ../login.html");
        }
    }

    //COOKIES
    /*
    $submitted = !empty($_POST);            // Form submit successful if POST array not empty
    if($submitted == 1) {                   // If user access page for first time
        $username = $_POST['username'];     // Altername is to use $_GET array
        $password = $_POST['password'];     // Alternate is to use $_GET array
        setcookie('username', $username);
        setcookie('password', $password);
    } else {                                // After first login get, login info from $_COOKIE array
        $username = $_COOKIE['username'];
        $password = $_COOKIE['password'];
    }
    

    echo "<p>Form submitted successfully (1 for true): $submitted </p>";
    echo "<p>Username received: $username </p>";
    echo "<p>Password received: $password </p>";
    */
?>