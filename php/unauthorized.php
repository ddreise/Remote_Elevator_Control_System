<?php
        // member.php -- Authorized users only
        session_start(); // Required for every page where you call or declare a session
        session_destroy();

        // Unauthorized Message
        echo "<p>You are not authorized! Unknown username/password combination.</p>";
        echo "Click to <a href='../login.html'>Login</a>";
?>