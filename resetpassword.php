<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>PLISMUN</title>

        <!-- Bootstrap Core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />

<!--        recycling css from signup page because the layout is basically the same and I can't be bothered to make a new file just for this-->
        <link href="css/pages/signup.css" rel="stylesheet">
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

        <!-- PHP -->
        <?php

        require_once('config.php');


        // get values from path name
        $email = $_GET['email'];
        $token = $_GET['token'];
        // validate token
        $validationQuery = "SELECT resettoken FROM `users` WHERE email = '$email'";
        $validationResult = mysqli_fetch_assoc(mysqli_query($link, $validationQuery));

        $tokenValid = '';

        if($validationResult["resettoken"] == $token && $validationResult["resettoken"] != null) {
            $tokenValid = true;
        } else {
            $tokenValid = false;
        }



        // submit password reset form
        if ($tokenValid && isset($_POST["submit"])) {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmpassword'];

            $errPassword = '';
            $errConfirmpassword = '';

            if (!$_POST['password']) {
                $errPassword = 'Please enter a password';
            }
            if ($_POST['confirmpassword'] != $_POST['password']) {
                $errConfirmpassword = 'Please repeat your password correctly';
            }

            if (!$errPassword && !$errConfirmpassword) {

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $query = "UPDATE `users` SET resettoken = null, password = '$hashed_password' WHERE email = '$email';";
                $result = mysqli_query($link, $query);

                if ($result) {
                    $resetResult = '<div class="alert alert-success">Password reset successful! Click <a href="apply">here</a> to login</div>';
                } else {
                    $resetResult = '<div class="alert alert-danger">An error occurred while changing the password</div>';
                }
            }

        }
        ?>


        <!-- Preloader -->
        <div id="preloader-overlay"></div>





        <!-- navbar, inserted via js -->
        <div id="header"></div>


        <?php
        if ($tokenValid)
        {

            ?>

            <div class="signup">
                <div class="signup-window">
                    <div class="container">
                        <h2>Reset password</h2>
                        <form id="signup" class="form-horizontal" method="post" action="resetpassword?email=<?php echo $email;?>&token=<?php echo $token;?>">
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <?php echo $resetResult ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="lastname">Password: </label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>">
                                    <?php echo "<p class='text-danger'><b>$errPassword</b></p>";?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-4" for="lastname">Confirm password:</label>
                                <div class="col-md-4">
                                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $_POST['confirmpassword']; ?>">
                                    <?php echo "<p class='text-danger'><b>$errConfirmpassword</b></p>";?>
                                </div>
                            </div>

                            <input id="submit" name="submit" type="submit" class="btn btn-success btn-send col-md-4 col-md-offset-4" value="Reset password">
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>

        <?php
        if (!$tokenValid) {

            ?>
            <div class="signup">
                <div class="signup-window">
                    <div class="container">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="alert alert-danger">Reset password credentials incorrect. Please try again or resend the email <a href="forgotpassword">here</a></div>
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
                $("#footer").load("footer");
                $("#preloader-overlay").load("preloader");
            });
        </script>

    </body>

</html>
