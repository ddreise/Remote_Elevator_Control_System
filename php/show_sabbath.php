<?php 
	function get_sabbathMode(): int {
		try { $db = new PDO('mysql:host=127.0.0.1;dbname=elevatorProject','ese', 'ese');}
		catch (PDOException $e){echo $e->getMessage();}

            // Query the database to display current floor
            $query = 'SELECT sabbathMode FROM elevatorDiagnostics WHERE nodeID = 1';
			$rows = $db->query($query);
			foreach ($rows as $row) {
                $sabbath_mode = $row[0];
			}
			return $sabbath_mode;
	}
?>

<?php

	
    $sabbathMode = get_sabbathMode();
	echo $sabbathMode;
	
	

?>