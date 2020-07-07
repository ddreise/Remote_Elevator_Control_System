<?php
    require "elevator_control.php";
    get_floorRequest();
?>

<html lang="en">
    <head>
        <title>Call Stations</title>
        <meta name="description" content="This is the Request Access page" />
        <meta name="robots" content="noindex nofollow" /> <!-- do not want page/links to be indexed-->
        <meta http-equiv="author" content="Daniel Dreise" />
        <meta http-equiv="pragma" content="no-cache" /> <!-- want browser to not store cache -->
        
        <!-- For Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">      
    
        <!-- For CSS -->
        <link href="../css/dans_project_style.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <div id="page" class="container">
            <header>
                <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
                    <!-- Enable navbar buttons-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!--Logo-->
                    <a class="navbar-brand" href="#"><img src="../images/dan-avatar.png" class="img-responsive" alt="Temporary logo", title="Temporary logo" height=40px/>  ESE Project VI</a>

                    <!--Menu buttons-->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="header_menu" class="navbar-nav mr-auto" > 
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="../index.html">Home</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="../about.html">About</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="../project_plan.html">Project Plan</a></li>
                                    <li class="h_menu nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="logbooksDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Logbooks</a>
                                        <div class="dropdown-menu" aria-labelledby="logbooksDropdown">
                                            <a class="dropdown-item" href="../daniel-logbook.html">Dan's Logbook</a>
                                            <a class="dropdown-item" href="../brandon-logbook.html">Brandon's Logbook</a>
                                            <a class="dropdown-item" href="../justin-logbook.html">Justin's Logbook</a>
                                            <a class="dropdown-item" href="../troy-logbook.html">Troy's Logbook</a>
                                        </div>
                                    </li>
                                    <li class="h_menu nav-item dropdown">
                                        <a class="menu nav-link dropdown-toggle" href="#" id="minutesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meeting Minutes</a>
                                        <div class="dropdown-menu" aria-labelledby="minutesDropdown">
                                            <a class="dropdown-item" href="../meeting-minutes.html">Meeting Minutes</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="../meeting-minutes.html#week1">Week 1</a>
                                            <a class="dropdown-item" href="../meeting-minutes.html#week2">Week 2</a>
                                            <a class="dropdown-item" href="../meeting-minutes.html#week3">Week 3</a>
                                            <a class="dropdown-item" href="../meeting-minutes.html#week4">Week 4</a>
                                        </div>
                                    </li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="../videos.html">Videos</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="#">Documents</a></li>
                                    <li class="h_menu nav-item"><a class="menu nav-link" href="../call_stations.html">Elevator GUI</a></li>
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
                                    <?php 
                                        $curFlr = get_currentFloor();
                                        echo "<h1>$curFlr</h1>";
                                    ?>
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
                    <form method="post" id="access">
                    <h2>Call Station Controls</h2>
                        <div class="row">
                            <div id="queue" class="col-md-3">
                                <p>This space reserved for call queue</p>
                            </div>

                            <div class="col-md-3">
                                <p>This space reserved for elevator position image</p>
                            </div>

                            <div class="col-md-3">
                                <p>This space reserved for call station door images</p>
                            </div>

                            <div class="col-md-3">
                            
                                <section>
                                    <fieldset>
                                        <legend>Floor 3</legend>        
                                            <!--Down arrow button image-->
                                            <input class="call_station_uparrow" name="floor3_down" type="image" src="../images/call_station_downarrow.png" value="floor3_down" alt="down_arrow" width="80"/>
                                    </fieldset>
                                </section>
        
                                <section>
                                    <fieldset>
                                        <legend>Floor 2</legend>
                                            <!--Up arrow button image-->
                                            <input class="call_station_uparrow" name="floor2_up" type="image" src="../images/call_station_uparrow.png" value="floor2_up" alt="up_arrow" width="80"/><br>
        
                                            <!--Down arrow button image-->
                                            <input class="call_station_downarrow" name="floor2_down" type="image" src="../images/call_station_downarrow.png" value="floor2_down" alt="down_arrow" width="80"/>
                                    </fieldset>
                                </section>
        

                                <section> 
                                    <fieldset>
                                        <legend>Floor 1</legend>
                                            <!--Up arrow button image-->
                                            <button class="call_station_uparrow" type="button" onclick="update_elevatorNetwork(1,2)"> <img src="../images/call_station_uparrow.png" alt="up_arrow" width="80"/></button>
                                    </fieldset>
                                </section>

                                <section>

                                </section>
                            </div>
                 
                        </div>
        
                    </form>
                </article> 
            </div>

            <footer>
                <p>&copy; Daniel Dreise</p>
            </footer>
        </div>

        <!-- jQuery & JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    </body>
</html>