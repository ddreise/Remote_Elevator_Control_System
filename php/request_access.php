<?php
$submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">    
    <head>
        <title>ESE Project VI - Request Access</title>
        <meta name="description" content="This is the Request Access page" />
        <meta name="robots" content="noindex nofollow" /> <!-- do not want page/links to be indexed-->
        <meta http-equiv="author" content="Daniel Dreise & Justin Turcotte" />
        <meta http-equiv="pragma" content="no-cache" /> <!-- want browser to not store cache -->

        <!-- For Bootstrap -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only (Bootstrap) ** See bottom of page for JavaScript and jQuery-->   
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">      
  

        <!-- For CSS -->
        <link href="css/dans_project_style.css" type="text/css" rel="stylesheet" />
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
                        <h1>Project VI - Request Access</h1>
                </div>

            </header>

            <div id="content">
                <article>
                    <section>
                        <p>Form submitted? <?php echo (int) $submitted; ?></p>
                        <p><b>Your Contact Details:</b>
                            <ul>
                                <li>First name:         <?php echo $_POST['firstname']; ?></li>
                                <li>Last name:          <?php echo $_POST['lastname']; ?></li>
                                <li>Email:              <?php echo $_POST['email']; ?></li>
                                <li>Student or Faculty: <?php echo $_POST['student_or_faculty']; ?></li>
                                <li>Burritos:           <?php echo $_POST['burritos']; ?></li>
                                <li>Comments:           <?php echo $_POST['comments']; ?></li>
                            </ul>
                        </p>
                    </section>
                </article>
            </div>
  
            <footer>
                <p>&copy; Daniel Dreise</p>
            </footer>
        </div>

    </body>
</html>
