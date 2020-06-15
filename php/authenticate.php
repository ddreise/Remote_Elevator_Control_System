

<?php
    //SESSIONS
    session_start(); // Starts a session and creates a session variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginsJSON = file_get_contents('../JSON/userlogins.json');
    $loginsArray = json_decode($loginsJSON, true);

    $usernameExists = 0;

    if($username&&$password) {
        $_SESSION['username'] = $username;
        foreach($loginsArray as $logins) {
            if($logins["username"] == $username) {
                $usernameExists = 1;
                if($logins["password"] != $password) {
                    echo "<p>The password you have entered is incorrect.</p>";
                    echo "Click <a href='index.php'>here</a> to try in again.";
                } else {
                    echo "<p>Congratulations, you are now logged into the site.</p>";
                    echo "<p>Please click <a href=\"member.php\">here</a> to be taken to our members only page.</p>";
                }
            }
        }
        if($usernameExists == 0) {
            echo "<p>The username you have entered does not exist.</p>";
            echo "Click <a href='index.php'>here</a> to try in again.";
        }
    } else {
        echo "<p>Please enter a username and password.</p>";
        echo "Click <a href='index.php'>here</a> to try in again.";
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