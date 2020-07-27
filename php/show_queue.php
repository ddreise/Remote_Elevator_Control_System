<?php 
	function get_queue() {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevatorProject','ese', 'ese');}
		catch (PDOException $e){echo $e->getMessage();}

            // Query the database to display queue
            $query = 'SELECT * FROM elevatorQueue';
            $rows = $db->query($query);
            
            echo '<table>';
            echo '<tr>';
            echo '<th>Queue Number</th>';
            echo '<th>Date/Time Requested</th>';
            echo '<th>Source Node</th>';
            echo '<th>Destination Floor</th>';
            echo '</tr>';
            
			foreach ($rows as $row) {
                $row1 = $row[0];
                $row2 = $row[1];
                $row3 = $row[2];
                $row4 = $row[3];
                
                echo '<tr>';
                echo '<td>'.$row1.'</td>';
                echo '<td>'.$row2.'</td>';
                echo '<td>'.$row3.'</td>';
                echo '<td>'.$row4.'</td>';
                echo '</tr>';
            }

            echo '</table>';
	}
?>

<?php

    
    get_queue();
	
?>