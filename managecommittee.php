
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Manage Committee – PLISMUN20</title>

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
        <link href="css/pages/managecommittee.css" rel="stylesheet">
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
        <div id="preloader">
            <div id="load"><img class="wow fadeInDown" src="img/plismun19_a_notext.png"></div>
        </div>


        <!-- navbar, inserted via js -->
        <div id="header"></div>




        <?php
        if (isset($_SESSION['id']) && $_SESSION['position'] == 'chair') {
            $email = $_SESSION['id'];
            $userid = mysqli_fetch_assoc(mysqli_query($link, "SELECT id FROM users WHERE email = '$email'"))['id'];
            $committee = strtoupper(mysqli_fetch_assoc(mysqli_query($link, "SELECT committee FROM chairs WHERE userid = $userid"))['committee']);
            if ($committee == 'HISTSEC') {
                $committee = 'HSC';
            } elseif ($committee == 'SEC') {
                $committee = 'SC';
            }

            $position = ucfirst(mysqli_fetch_assoc(mysqli_query($link, "SELECT position FROM chairs WHERE userid = $userid"))['position'])
            ?>


            <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
            </section>

            <div class="container" style="margin-top:30px;">

                <div class="container">
                    <h1 class="inline" style="font-size: 50px;"><?php echo $committee; ?></h1>
                    <p class="inline" style="font-size:50px;"> – </p>
                    <p class="inline" style="font-size: 50px;"><i><?php echo $position; ?></i></p>
                </div>

            </div>

        <?php } else { ?>
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
            });

            $('.datepicker').datepicker();

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

    </body>
</html>
