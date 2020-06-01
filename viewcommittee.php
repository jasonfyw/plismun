
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>View Committee – PLISMUN 2021</title>

        <!-- Bootstrap Core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">

        <!-- bootstrap select -->
        <link href="css/bootstrap-select.min.css" rel="stylesheet">

        <link href="css/checkboxes.css" rel="stylesheet">

        <!-- recycling css from signup page because the layout is basically the same and I can't be bothered to make a new file just for this-->
        <link href="css/pages/viewcommittee.css" rel="stylesheet">
        <link href="color/default.css" rel="stylesheet">


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120398250-1"></script>
        <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-120398250-1');
        </script>

    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-custom">
        <?php
        session_start();
        require_once('config.php');
        ?>


        <!-- Preloader -->
        <div id="preloader-overlay"></div>


        <!-- navbar, inserted via js -->
        <div id="header"></div>




        <?php
        if (isset($_SESSION['id'])) {
            if ($_SESSION['position'] == 'chair' || $_SESSION['position'] == 'delegate') {

                $email = $_SESSION['id'];
                $userid = mysqli_fetch_assoc(mysqli_query($link, "SELECT id FROM users WHERE email = '$email'"))['id'];

                // fetching user information, inefficient but iiabdfi
                if ($_SESSION['position'] == 'chair') {
                    $committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT committee FROM chairs WHERE userid = $userid"))['committee'];
                    $displaycommittee = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname FROM committees where abbvname = '$committee'"))['displayname'];
                } elseif ($_SESSION['position'] == 'delegate') {
                    $committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT committee FROM delegates WHERE userid = $userid"))['committee'];
                    $displaycommittee = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname FROM committees where abbvname = '$committee'"))['displayname'];
                    // $country = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM delegates WHERE userid = $userid"))['country'];
                }

                if ($_SESSION['position'] == 'delegate' && $committee == '')
                { ?>
                    <!-- Applied as delegate, pending application -->

                    <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
                    </section>

                    <div class="container">
                        <h1 style="text-align: center; margin-top: 20%; text-transform: none;">Thank you for submitting your delegate application. It currently has not been approved yet, please wait a bit and check back later! </h1>
                    </div>


                <?php } elseif ($_SESSION['position'] == 'delegate' && $committee == 'REJECTED') { ?>
                    <!-- Applied as delegate but rejected -->
                    <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
                    </section>

                    <div class="container">
                        <h1 style="text-align: center; margin-top: 20%; text-transform: none;">We appreciate your interest in PLISMUN but we have decided to reject your application. If you would like to contact us about the decision, you are free to do so <a href="contact">here</a></h1>
                    </div>
                <?php } elseif ($_SESSION['position'] == 'chair' && $committee == '') { ?>
                    <!-- Applied for chair, pending application -->
                    <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
                    </section>

                    <div class="container">
                        <h1 style="text-align: center; margin-top: 20%; text-transform: none;">Thank you for submitting your chair application! Hopefully you should receive a response via email in the coming weeks!</h1>
                    </div>
                
                <?php } elseif ($_SESSION['position'] == 'chair' && $committee == 'REJECTED') { ?>
                    <!-- Applied for chair but rejected -->
                    <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
                    </section>

                    <div class="container">
                        <h1 style="text-align: center; margin-top: 20%; text-transform: none;">Thank you for submitting your chair application and we appreciate your interest in PLISMUN! Unfortunately, we have decided to reject your application. If you would like to contact us about this decision or if you would like to apply for a different position, please do so <a href="contact">here</a></h1>
                    </div>
                
                
                <?php } else {
                    $committee_iter = $committee;
                    
                    # Fetching name and email of both chairs
                    # Note: while labelled chair and cochair here, db positions are chair1 and chair2 since PLISMUN20 and 21 committees have 2 chairs rather than chair anc cochair
                    $chairid = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid FROM chairs WHERE position = 'chair1' AND committee = '$committee'"))['userid'];
                    $chairinfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email FROM users WHERE id = $chairid"));
                    $chairname = $chairinfo['firstname'] . ' ' . $chairinfo['lastname'];
                    $chairemail = $chairinfo['email'];

                    $cochairid = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid FROM chairs WHERE position = 'chair2' AND committee = '$committee'"))['userid'];
                    $cochairinfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email FROM users WHERE id = $cochairid"));
                    $cochairname = $cochairinfo['firstname'] . ' ' . $cochairinfo['lastname'];
                    $cochairemail = $cochairinfo['email'];

                    ?>


                    <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
                    </section>

                    <div class="container" style="margin-top:30px;">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h1 style="font-size: 50px;"><?php echo $displaycommittee; ?></h1>

                                    <hr class="bottom-line">
                                </div>


                                <div class="col-md-6 text-center">
                                    <p style="font-size:30px;">Chair <br /><b><?php echo $chairname; ?></b></p>
                                    <p><a href="mailto:<?php echo $chairemail; ?>" target="_blank"><?php echo $chairemail; ?></a></p>
                                </div>
                                <div class="col-md-6 text-center">
                                    <p style="font-size:30px;">Co-Chair <br /><b><?php echo $cochairname; ?></b></p>
                                    <p><a href="mailto:<?php echo $cochairemail; ?>" target="_blank"><?php echo $cochairemail; ?></a></p>
                                </div>
                            </div>

                            <hr class="bottom-line">

                            <div class="text-center">
                                <p style="font-size:30px;">Countries</p>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Country</th>
                                            <th scope="col">Delegate</th>
                                            <?php if ($_SESSION['position'] == 'chair') { ?> <th scope="col">Email</th> <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        // iteratively loop through all countries and display them in table
                                        $all_countries = mysqli_query($link, "SELECT * FROM $committee_iter");
                                        while ($country = mysqli_fetch_assoc($all_countries)) {
                                            $displayname = $country["displayname2"];
                                            $country_userid = $country["userid"];
                                            $country_user = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email FROM users WHERE id = $country_userid"));
                                            $country_username = $country_user['firstname'] . ' ' . $country_user['lastname'];

                                            ?>
                                            <tr>
                                                <th scope="row" style="text-align: left"><?php echo $displayname; ?></th>
                                                <td style="text-align: left"><?php echo $country_username; ?></td>
                                                <?php
                                                    // for privacy reasons, only the chairs are allowed to access the emails of each delegate
                                                    if ($_SESSION['position'] == 'chair') {
                                                        ?>
                                                        <td style="text-align: left"><?php echo $country_user['email']; ?></td>
                                                        <?php
                                                    }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>


                                    </tbody>
                                </table>

                            </div>


                        </div>

                    </div>

            <?php
                }
            } else { ?>
                <h1 style="text-align: center; margin-top: 10%;">You do not have the valid credentials to view this page. </h1>

            <?php }
        } else { ?>
            <h1 style="text-align: center; margin-top: 10%;">You do not have the valid credentials to view this page. </h1>
        <?php } ?>





        <!-- Core JavaScript Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollTo.js"></script>
        <!--reveal while scrolling script-->
        <script src="js/wow.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/custom.js"></script>
        <!-- parallax script -->
        <script src="js/parallax.min.js"></script>
        <!-- bootstrap select js -->
        <script src="js/bootstrap-select.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>


        <script type="text/javascript">
            // include footer
            $(function() {
                $("#header").load("navbar");
                $("#footer").load("footer");
                $("#preloader-overlay").load("preloader");
            });

            $('.datepicker').datepicker();

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

    </body>
</html>
