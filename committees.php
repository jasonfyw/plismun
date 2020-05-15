<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Committees – PLISMUN 2021</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />
        <!-- css -->
        <link href="css/pages/committees.css" rel="stylesheet">
        <link href="color/default.css" rel="stylesheet">

        <style>
        /* table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            width: 100%
        }
        td {
            padding:10px
        } */
        </style>


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120398250-1"></script>
        <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-120398250-1');
        </script>


    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-custom" width="100%">
        <?php
        session_start();
        require_once('./config.php');
        ?>

        <!-- Preloader -->
        <div id="preloader-overlay"></div>

        <!-- navbar, inserted via js -->
        <div id="header"></div>

        <!-- Section: intro -->
        <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
            <div class="slogan">
                <h2>Committees</h2>
            </div>
        </section>
        <!-- /Section: intro -->



        <section id="committees" class="home-section text-center" width="100%" style="padding: 0;margin: 0;border: 0;">

            <div class="container home-section" style="padding: 0;margin: 0;border: 0;">
                <!-- DETAILS AND COUNTRY MATRIX SIDEMENU THING FOR EVERY COMMITTEE-->
                <?php
                $committees = mysqli_query($link, "SELECT * FROM committees");
                while ($committee = mysqli_fetch_assoc($committees)) {
                    // fetch committee information from db
                    $abbvname = $committee["abbvname"];
                    $displayname = $committee["displayname"];
                    // $difficulty = $committee["difficulty"];
                    // $chair1 = $committee["chair1"];
                    // $chair2 = $committee["chair2"];
                    $chair1 = "<i>TBD</i>";
                    $chair2 = "";
                    $topic1 = $committee["topic1"];
                    $topic2 = $committee["topic2"];
                    
                    // fetch country names from the respective committee table
                    $countries = mysqli_query($link, "SELECT displayname2 FROM $abbvname");
                ?>

                    <div id="<?php echo $abbvname; ?>info" class="overlay">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav('<?php echo $abbvname; ?>')">&times;</a>
                        <div class="overlay-content">
                            <h2>
                                <?php 
                                echo $displayname; 
                                if ($abbvname != "legal" && $abbvname != "unwomen") {
                                    echo " (" . strtoupper($abbvname) . ")";
                                }
                                ?> 
                            </h2>
                            <!-- <h4 data-toggle="tooltip" title="This committee is more suitable for MUNers with less experience and seeking an easier committee to participate in">Beginner Committee <i class="fas fa-info-circle"></i></h4> -->
                            <div class="col-lg-2 col-lg-offset-5">
                                <hr class="marginbot-50">
                            </div>
                            <br><br><br><br>

                            <h4>Topic:</h4>
                            <?php 
                            if (strlen($topic2) == 0) {
                                ?>
                                <p><?php echo $topic1; ?></p>
                                <?php
                            } else {
                                ?>
                                <p>1. &nbsp;&nbsp;&nbsp; <?php echo $topic1; ?></p>
                                <p>2. &nbsp;&nbsp;&nbsp; <?php echo $topic2; ?></p>
                                <?php
                            }
                            ?>

                            <br><br>

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <h4>Chairs</h4>
                                    <p><?php echo $chair1; ?></p>
                                    <p><?php echo $chair2; ?></p>
                                </div>
                            </div>

                            <br><br>

                            <h4>Country matrix:</h4>
                            <div class="col-lg-4 col-lg-offset-4">
                                <!-- <p><i>Coming soon</i></p> -->
                                <table class="table">
                                    <tbody>
                                        <?php 
                                            while ($country = mysqli_fetch_assoc($countries)) {
                                                ?>
                                                <tr><td><?php echo $country['displayname2']; ?></td></tr>
                                                <?php
                                            }
                                        ?>
                                        <tr><td></td></tr>
                                    </tbody>
                                </table>
                                <br><br><br><br>
                            </div>

                        </div>
                    </div>
                <?php 
                }
                ?>


                <!--side bar-->
                <div class="col-md-3" id="leftCol">
                    <ul class="nav nav-stacked" id="sidebar">
                        <?php 
                        $committees = mysqli_query($link, "SELECT * FROM committees");
                        while ($committee = mysqli_fetch_assoc($committees)) {
                        ?>
                        <li class="nav-com"><a href="#<?php echo $committee["abbvname"] ?>"><?php echo $committee["displayname"] ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>



                <!-- content -->
                <div class="col-md-9" style="padding: 0;margin: 0;border: 0;">




                    <!-- <div class="heading-about" id="ga">
                        <div class="container">
                            <div class="row">


                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
                                            <h2>General Assemblies</h2>
                                            <i class="fa fa-2x fa-angle-down"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <?php 
                    $committees = mysqli_query($link, "SELECT * FROM committees");
                    while ($committee = mysqli_fetch_assoc($committees)) {
                         // fetch committee information from db
                        $abbvname = $committee["abbvname"];
                        $displayname = $committee["displayname"];
                        $topic1 = $committee["topic1"];
                        $topic2 = $committee["topic2"];
                        ?>
                    

                        <div class="heading-about" id="<?php echo $abbvname; ?>">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-2 col-lg-offset-5">
                                        <hr class="marginbot-50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-lg-offset-2">
                                        <div class="wow fadeInRight" data-wow-delay="0s">
                                            <div class="section-heading">
                                                <h3>
                                                <?php 
                                                echo $displayname; 
                                                if ($abbvname != "legal" && $abbvname != "unwomen") {
                                                    echo " (" . strtoupper($abbvname) . ")";
                                                }
                                                ?> 
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">

                            <div class="row">
                                <div class="col-md-auto">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="team boxed-grey">
                                            <div class="inner">
                                                <?php 
                                                if (strlen($topic2) == 0) {
                                                    ?>
                                                    <p><?php echo $topic1; ?></p>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p>1. &nbsp;&nbsp;&nbsp; <?php echo $topic1; ?></p>
                                                    <p>2. &nbsp;&nbsp;&nbsp; <?php echo $topic2; ?></p>
                                                    <?php
                                                }
                                                ?>

                                                <!-- <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li class="dropdown-item"><a href="studyguides/GA1_Study_Guide_Topic_1.pdf">Download (Topic 1) </a></li>
                                                        <li class="dropdown-item"><a href="studyguides/GA1_Study_Guide_Topic_2.pdf">Download (Topic 2) </a></li>
                                                    </ul>
                                                </div> -->
                                                <button type="button" class="btn btn-default" href="#" onclick="openNav('<?php echo $abbvname; ?>');">View details and country matrix</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <!--small buffer between footer-->
                    <div class="container">
                        <div class="col-lg-2 col-lg-offset-5">
                            <hr class="marginbot-50">
                        </div>
                    </div>






                </div>
            </div>

        </section>







        <!-- footer-->
        <div id="footer"></div>
        <!-- /footer -->



        <!-- Core JavaScript Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollTo.js"></script>
        <script src="js/popper.min.js"></script>
        <!--reveal while scrolling script-->
        <script src="js/wow.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/committees.js"></script>
        <!-- parallax script -->
        <script src="js/parallax.min.js"></script>

        <script type="text/javascript">
            // include footer
            $(function() {
                $("#header").load("navbar");
                $("#footer").load("footer");
                $("#preloader-overlay").load("preloader");
            });

            function openNav(committee) {
//                document.getElementById(committee+"info").setAttribute('aria-hidden', false);
                document.getElementById(committee+"info").style.width = "100%";
                document.body.classList.toggle('noscroll', true);
                location.href = "#"+committee;
            }
            function closeNav(committee) {
//                document.getElementById(committee+"info").setAttribute('aria-hidden', true);
                document.getElementById(committee+"info").style.width = "0%";
                document.body.classList.toggle('noscroll', false);
                location.href = "#"+committee;
            }
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })


        </script>

    </body>

</html>
