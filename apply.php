<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Apply – PLISMUN 2021</title>

        <!-- Bootstrap Core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />
         <!-- Squad theme CSS -->
        <link href="css/pages/apply.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
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

        // login form
        if (isset($_POST["submit"])) {
            // retrieve values for the email and password on login screen when submit button pressed
            // escapes special characters to protect from sql injections
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);
            
            // initialise error messages
            $errEmail = '';
            $errPassword = '';

            // handling empty/invalid inputs
            if (!$_POST['password']) {
                $errPassword = 'Please enter a password';
            }
            if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errEmail = 'Please enter a valid email address';
            }

            // fetching row with given email
            $emailQuery = "SELECT * FROM `users` WHERE email='$email'";
            $result = mysqli_query($link, $emailQuery);

            // fetching hashed password associated with email
            $passwordQuery = "SELECT password FROM `users` WHERE email='$email'";
            $passwordResult = mysqli_fetch_assoc(mysqli_query($link, $passwordQuery));

            // login validation
            if(!$errEmail && !$errPassword) {
                // if user record is present
                if (mysqli_num_rows($result) >= 1) {
                    // verify password by comparing its hash to the stored value
                    if (password_verify($password, $passwordResult["password"])) {
                        // set the session data for the logged in user
                        // this is an inefficient implementation because it queries the db every time; could be done with just one query
                        $_SESSION['id'] = $email;
                        $_SESSION['firstname'] = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname FROM `users` WHERE email='$email'"))["firstname"];
                        $_SESSION['lastname'] = mysqli_fetch_assoc(mysqli_query($link, "SELECT lastname FROM `users` WHERE email='$email'"))["lastname"];
                        $_SESSION['position'] = mysqli_fetch_assoc(mysqli_query($link, "SELECT position FROM `users` WHERE email='$email'"))["position"];
                    } else {
                        $errPassword = 'Incorrect password';
                    }
                } else {
                    $errEmail = 'That account doesnt exist :/ ';
                }
            }
        }

        ?>



        <!-- Preloader -->
        <div id="preloader-overlay"></div>





        <!-- navbar, inserted via js -->
        <div id="header"></div>

        <?php
        // if there is no logged in user, display the login form
        if(!isset($_SESSION['id']))
        {

            ?>
            <div class="login">
                <div class="login-window">
                    <div class="container">
                        <h2>Login</h2>
                        <form id="login" class="form-horizontal" method="post" action="apply">
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <?php echo $loginresult ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="email">Email: </label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $_POST['email']; ?>">
                                    <?php echo "<p class='text-danger'><b>$errEmail</b></p>";?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="password">Password: </label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>">
                                    <?php echo "<p class='text-danger'><b>$errPassword</b></p>";?>
                                    <a href="forgotpassword">Forgot password?</a>
                                </div>
                            </div>

                            <input id="submit" name="submit" type="submit" class="btn btn-success btn-send col-md-4 col-md-offset-4" value="Login">

                        </form>
                    </div>
                    <div class="container" style="padding-top: 15px;">
                        <p class="signup-alternative">OR</p>
                        <a href="signup" class="btn btn-info col-md-4 col-md-offset-4">Make an account</a>
                    </div>
                </div>
            </div>
            <?php } ?>

        <?php
        // if there is a session with a valid id (hence logged in), display options to apply for positions
        if (isset($_SESSION['id'])) {

            ?>
            <div class="login">
                <div class="login-window">
                    <div class="container">
                        <div class="row">
                            <div class="alert alert-info col-md-4 col-md-offset-4">If you need any help registering, check out the <a href="registrationguide">registration guide by clicking on this link</a></div>
                            <!-- <div class="alert alert-danger col-md-5 col-md-offset-5"><b>All delegate positions have been filled! Applications are now closed. </b></a></div> -->
                        </div>

                    </div>
                    <div class="container">
                        <h2>Choose what to apply as</h2>
                        <!-- <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <div class="pricing">
                                    <h5>Pricing</h5>
                                    <p>Chairs and delegates: <b>€10 / CZK260</b></p>
                                </div>
                            </div>
                        </div> -->



                        <!-- 

                        when opening applications for the following positions, remove the 'disabled' attribute on the <a> tag and set the 'data-title' attribute on the <div> tag to empty

                         -->

                        <div class="col-md-4 col-md-offset-4" id="disabled-button-wrapper" data-placement="top" data-toggle="tooltip" data-title="">
                        </div>

                        <div class="col-md-4 col-md-offset-4" id="disabled-button-wrapper" data-placement="top" data-toggle="tooltip" data-title="">
                            <a href="applydelegate" class="btn btn-info btn-block" id="chooseposition" >Delegate</a>
                        </div>

                        <div class="col-md-4 col-md-offset-4" id="disabled-button-wrapper" data-placement="top" data-toggle="tooltip" data-title="">
                            <a href="applydelegation" class="btn btn-info btn-block" id="chooseposition" >Delegation</a>
                        </div>

                        <div class="col-md-4 col-md-offset-4" id="disabled-button-wrapper" data-placement="top" data-toggle="tooltip" data-title="">
                            <a href="applychair" class="btn btn-info btn-block" id="chooseposition" >Chair</a>
                        </div>

                        <!-- <div class="col-md-4 col-md-offset-4" id="disabled-button-wrapper" data-placement="top" data-toggle="tooltip" data-title="Chairing positions have all been filled and no vacancies are currently available">
                            <a href="applychair" class="btn btn-info btn-block" id="chooseposition" disabled>Chair</a>
                        </div> -->
                    </div>
                    <div class="container">
                        <h2>Or view your committee</h2>
                        <div class="col-md-4 col-md-offset-4" id="disabled-button-wrapper" data-placement="top" data-toggle="tooltip" data-title="">
                            <a href="viewcommittee" class="btn btn-info btn-block" id="" disabled>View Your Committee</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>










        <!-- footer-->
        <div id="footer"></div>
        <!-- /footer -->



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
        <script type="text/javascript">
            // include footer
            $(function() {
                $("#header").load("navbar");
                $("#footer").load("footer.html");
                $("#preloader-overlay").load("preloader");
            });

            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })

        </script>

    </body>

</html>
