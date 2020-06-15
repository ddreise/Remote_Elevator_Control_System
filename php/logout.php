<?php
    session_start(); // Required for every page where you call or declare a session
    session_destroy();

    echo "You have been logged out. Click <a href='..\index.html'>here</a> to go back to the home page.";
?>