
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">


        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="css/animate.css" rel="stylesheet" />
        <!-- css -->
        <link href="css/pages/navbar.css" rel="stylesheet">
        <link href="color/default.css" rel="stylesheet">

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">
        <?php
        session_start();
        require_once('config.php');
        ?>



        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse" id="navbar-toggle">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand js-scroll-trigger" href="index">
                        <h1>PLISMUN 2021</h1>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse">

                    <ul class="nav navbar-nav">
                        <li><a href="index">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">About &nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="about">About us</a></li>
                                <li><a href="prague">Prague</a></li>
                                <!-- <li><a href="teams">The Team</a></li> -->
                                <div class="dropdown-divider"></div>
                                <li><a href="tos">Terms and Conditions</a></li>
                                <li><a href="privacy">Privacy Policy</a></li>
                                <li><a href="credits">Website Credits</a></li>
                            </ul>
                        </li>
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media &nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="https://drive.google.com/open?id=1rsiv_NV4jxfOlM7UvEuEJM5w1pOsRpgd">PLISMUN19 Photos</a></li>
                                <li><a href="content">Newspaper</a></li>
                                <li><a href="videos">Videos</a></li>
                                <li></li>
                                <li><a target="_blank" href="Delegate%20Handbook.pdf">Delegate Handbook</a></li>
                            </ul>
                        </li> -->
                        <!-- <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Newspaper &nbsp;<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="media/PLISMUN20–Day1.pdf">Day 1 – Thursday</a></li>
                                <li><a target="_blank" href="media/PLISMUN20–Day2.pdf">Day 2 – Friday</a></li>
                                <li><a target="_blank" href="media/PLISMUN20–Day3.pdf">Day 3 – Saturday</a></li>
                                <li><a target="_blank" href="media/PLISMUN20–Day4.pdf">Day 4 – Sunday</a></li>
                            </ul>
                        </li> -->
                        <!-- <li><a href="https://drive.google.com/drive/u/3/folders/1QyB6VypqcuFHZCqpKik3SXAte-V1Ngh7">Photos</a></li> -->
                        <!-- <li><a href="schedule">Schedule</a></li> -->
                        <li><a href="committees">Committees</a></li>
                        <li><a href="partners-en">Partners</a></li>
                        <li><a href="contact">Contact</a></li>


                        <!-- not logged in -->
                        <?php
                        if(!isset($_SESSION['id']))
                        {
                            ?>
                            <li><a href="apply">Login</a></li>
                        <?php } ?>


                        <!-- logged in, yet to register -->
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['position'] == '')
                        {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Apply &nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="apply">Apply</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>


                        <!-- registered as delegationleader -->
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['position'] == 'delegationleader')
                        {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> &nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="managedelegation">View Delegation</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>


                        <!-- registered as delegate -->
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['position'] == 'delegate') {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> &nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="viewcommittee">
                                        <?php
                                        $email = $_SESSION['id'];
                                        $userid = mysqli_fetch_assoc(mysqli_query($link, "SELECT id FROM users WHERE email = '$email'"))['id'];
                                        $committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT committee FROM delegates WHERE userid = $userid"))['committee'];
                                        if ($committee == '' || $committee == 'REJECTED') {
                                            echo 'View application';
                                        } else {
                                            echo 'View committee';
                                        }
                                        ?>
                                    </a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>


                        <!-- registered as chair -->
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['position'] == 'chair')
                        {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> &nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="viewcommittee">View Committee</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <!-- admin controls -->
                        <?php
                        if (isset($_SESSION['id']) && $_SESSION['position'] == 'admin')
                        {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-user"></i> &nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="delegateapplications">View Delegate Applications</a></li>
                                    <li><a href="database/index">View User Database</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a href="logout">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>






        <!-- Core JavaScript Files -->
        <script src="js/jquery.min.js"></script>
<!--        <script src="js/bootstrap.min.js"></script>-->

</html>
