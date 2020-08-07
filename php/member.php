<html>
    <head>
        <title>Members Only Page</title>
    </head>
    <body>
        <?php
            // member.php -- Authorized users only
            session_start(); // Required for every page where you call or declare a session

            // Members only content
            if(isset($_SESSION['username'])) {
                echo "<h1>Welcome to the Members Only Page {$_SESSION['username']}!</h1>";
                $db = new PDO(
                    'mysql:host=127.0.0.1;dbname=elevatorProject' ,    // Database name
                    'ese',                                     // Username
                    'ese'                                      // Password
                );
                // Sign out
                echo "Click to <a href='logout.php'>Logout</a>";
            } else {
                echo "<p>You are not authorized!</p>";
            }
        ?>
        <h2>Input NEW data to the database using the form below</h2>
        <form action="member.php" method="POST">
            status: <input type="text" name="status" /><br />
            currentFloor: <input type="text" name="currentFloor" /><br />
            requestedFloor: <input type="text" name="requestedFloor" /><br />
            <input type="submit" value="Add to database" />
        </form>
        <?php
            if(isset($_SESSION['username'])) {
                $query = 'INSERT INTO elevatorNetwork(date, time, status, currentFloor, requestedFloor, otherInfo)
                          VALUES(:date, :time, :status, :currentFloor, :requestedFloor, :otherInfo)'; // Formatted query with parameter identified by ':'
                $statement = $db->prepare($query);
                $curr_date_query = $db->query('SELECT CURRENT_DATE()'); // Use mySQL query to get current date
                $curr_date = $curr_date_query->fetch(PDO::FETCH_ASSOC);
                $curr_time_query = $db->query('SELECT CURRENT_TIME()'); // Use mySQL query to get current time
                $curr_time = $curr_time_query->fetch(PDO::FETCH_ASSOC);
                $status = $_POST['status'];
                $currentFloor = $_POST['currentFloor'];
                $requestedFloor = $_POST['requestedFloor'];
                
                $params = [
                    'date' => $curr_date['CURRENT_DATE()'], // Use the current date
                    'time' => $curr_time['CURRENT_TIME()'], // Use the current time
                    'status' => $status,                    // Get status from user
                    'currentFloor' => $currentFloor,        // Get current floor from user
                    'requestedFloor' => $requestedFloor,    // Get requested floor from user
                    'otherInfo' => 'na'                      // Ignored for now
                ];
                $result = $statement->execute($params);
            }
        ?>
        <h2>Display entire content of the elevatorNetwork table</h2>
        <?php
            $rows = $db->query('SELECT * FROM elevatorNetwork ORDER BY nodeID');
            foreach($rows as $row) {
                for($i=0; $i < sizeof($row)/2; $i++) {
                    echo $row[$i] . " | ";
                }
                echo "<br />";
            }
        ?>
    </body>
</html>
