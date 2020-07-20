<?php

$db = new PDO(
        'mysql:host=127.0.0.1;dbname=elevator', // Data source name
        'jturcotte',                            // Username
        'pass'                                  // Password
    );

    // Return arrays with keys that are the name of the fields.
    $db->setAttribute(PD0::ATTR_DEFAULT_FETCH_MODE, PD0::FETCH_ASSOC);

    $rows = $db->query('SELECT * FROM log ORDER BY nodeID');
    foreach ($rows as $row)
    {
        var_dump($row);
        echo "<br />";
        echo "<br />";
    }
?>
