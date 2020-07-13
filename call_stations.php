<?php
	function update_elevatorNetwork(int $node_ID, int $new_floor =1): int {
        $db1 = new PDO('mysql:host=127.0.0.1;dbname=elevator','ddreise6630','Iloveschool24!');
        $db1->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$query = 'UPDATE CAN_subNetwork SET CAN_currentFloor = :floor WHERE CAN_nodeID = :id';
		$statement = $db1->prepare($query);
		$statement->bindvalue('floor', $new_floor);
		$statement->bindvalue('id', $node_ID);
		$statement->execute();	
		
		return $new_floor;
    }
    
    if(isset($_POST['newfloor'])) {
        $curFlr = update_elevatorNetwork(1, $_POST['newfloor']); 
        header('Refresh:0; url=call_stations.php');	
    } 
?>

<!DOCTYPE html>
<html lang="en" >
    <head>
        <title>Call Stations</title>
        <meta name="description" content="This is the Call Stations page" />
        <meta name="robots" content="noindex nofollow" /> <!-- do not want page/links to be indexed-->
        <meta http-equiv="author" content="Daniel Dreise" />
        <meta http-equiv="pragma" content="no-cache" /> <!-- want browser to not store cache -->
        <meta charset="utf-8">
        
        <!-- For Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">      
    
        <!-- For CSS -->
        <link href="css/dans_project_style.css" type="text/css" rel="stylesheet" />
    </head>

    <body onload='showFloorInterval(3000)'>

        <div id="page" class="container">
            <header>
                <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
                    <!-- Enable navbar buttons-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!--Logo-->
                    <a class="navbar-brand" href="#"><img src="images/dan-avatar.png" class="img-responsive" alt="Temporary logo", title="Temporary logo" height=40px/>  ESE Project VI</a>

                    <!--Menu buttons-->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="header_menu" class="navbar-nav mr-auto" > 
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="index.html">Home</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="about.html">About</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="project_plan.html">Project Plan</a></li>
                                    <li class="h_menu nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="logbooksDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Logbooks</a>
                                        <div class="dropdown-menu" aria-labelledby="logbooksDropdown">
                                            <a class="dropdown-item" href="daniel-logbook.html">Dan's Logbook</a>
                                            <a class="dropdown-item" href="brandon-logbook.html">Brandon's Logbook</a>
                                            <a class="dropdown-item" href="justin-logbook.html">Justin's Logbook</a>
                                            <a class="dropdown-item" href="troy-logbook.html">Troy's Logbook</a>
                                        </div>
                                    </li>
                                    <li class="h_menu nav-item dropdown">
                                        <a class="menu nav-link dropdown-toggle" href="#" id="minutesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meeting Minutes</a>
                                        <div class="dropdown-menu" aria-labelledby="minutesDropdown">
                                            <a class="dropdown-item" href="meeting-minutes.html">Meeting Minutes</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="meeting-minutes.html#week1">Week 1</a>
                                            <a class="dropdown-item" href="meeting-minutes.html#week2">Week 2</a>
                                            <a class="dropdown-item" href="meeting-minutes.html#week3">Week 3</a>
                                            <a class="dropdown-item" href="meeting-minutes.html#week4">Week 4</a>
                                        </div>
                                    </li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="videos.html">Videos</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="#">Documents</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="call_stations.html">Elevator GUI</a></li>
                                </ul>
                    </div>
                            
                </nav>

           

                <div class="jumbotron text-center">
                        <h1>Project VI - Elevator GUI</h1>
                </div>

            </header>


            <div id="content">
                <article>
                    <section>
                        <div class="row">
                            <div class="col-xs">
                                <h2>Current Floor</h2>
                                <fieldset>
                                    <!--Get data from server regarding current car location-->
                                    <h2 id="floor"></h2>
                                    <!--
                                    <?php 
                                      /*   if(isset($_POST['newfloor'])) {
                                            $curFlr = update_elevatorNetwork(1, $_POST['newfloor']); 
                                            header('Refresh:0; url=call_stations.php');	
                                        } 
                                        $curFlr = get_currentFloor();
                                        echo "<h2>Current floor # $curFlr </h2>"; */			
                                    ?>	
                                    <

                                    -->
                                    <form action="call_stations.php" method="POST">
				                        Request floor # <input type="number" style="width:50px; height:40px" name="newfloor" max=3 min=1 required />
				                        <input type="submit" value="Go"/>
			                        </form>
                                </fieldset>
                            </div>
                        </div>
                    </section>
                </article>
                
                <!--Up/Down Request -->
                <!--
                <iframe name="up_down_request" style="display:none;"></iframe> Prevents new window opening (along with target=
                -->
                <article>
                    <!-- <form action="php/call_stations.php" method="post" id="access" target="up_down_request"> -->
                    <h2>Call Station Controls</h2>
                        <div class="row">
                            <div id="queue" class="col-md-4">
                                <p>This space reserved for call queue</p>
                            </div>

                            <div class="col-md-4">
                                <p>This space reserved for elevator position image</p>
                            </div>

                            <div class="col-md-4">
                            
                                <section>
                                    <fieldset>
                                        <legend>Floor 3</legend>     
                                            <div class="row">
                                                <div class = "col-md-6">
                                                    <span class="elevator_door3"></span>
                                                </div>

                                                <!--Up arrow button image-->
                                                <div class="col-mid-6">
                                                    <!--Down arrow button image-->
                                                    <input id="floor3_down" class="down_arrow" type="submit" name="floor3_down" value="" alt="down_arrow" />
                                                </div>
                                            
                                            </div>
                                    </fieldset>
                                </section>
        
                                <section>
                                    <fieldset>
                                        <legend>Floor 2</legend>
                                            <div class="row">
                                                <div class = "col-md-6">
                                                    <span class="elevator_door2"></span>
                                                </div>

                                                <!--Up arrow button image-->
                                                <div class="col-mid-6">
                                                    <input id="floor2_up" class="up_arrow" type="button" name="floor2_up" value="" alt="up_arrow" /><br>
            
                                                    <!--Down arrow button image-->
                                                    <input id="floor2_down" class="down_arrow" type="button" name="floor2_down" value="" alt="down_arrow" />
                                                </div>
                                               
                                            </div>
                                  
                                    </fieldset>
                                </section>
        

                                <section> 
                                    <fieldset>
                                        <legend>Floor 1</legend>
                                            <div class="row">
                                                <div class = "col-md-6">
                                                    <span class="elevator_door1"></span>
                                                </div>

                                                <!--Up arrow button image-->
                                                <div class="col-mid-6">
                                                    <input id="floor1_up" class="up_arrow" type="button" name="floor1_up" value="" alt="up_arrow" /><br>
                                                </div>
                                            
                                            </div>
                                    </fieldset>
                                </section>

                                <section>

                                </section>
                            </div>
                 
                        </div>
        
                  <!--  </form> -->
                </article> 
            </div>

            <footer>
                <p>&copy; Daniel Dreise</p>
                <a href="http://www.freepik.com">Elevator Picture: Designed by macrovector / Freepik</a>

            </footer>
        </div>

        <!-- jQuery & JS -->

        <script src="js/show_floor.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    </body>
</html>