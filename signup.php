<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Sign Up – PLISMUN </title>

        <!-- Bootstrap Core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />
         <!-- Squad theme CSS -->
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

        if (isset($_POST["submit"])) {
            // setting input variables
            $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($link, $_POST['lastname']);
            $email = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);
            $confirmpassword = $_POST['confirmpassword'];

            // error variables (idk to be safe)
            $errFirstname = '';
            $errLastname = '';
            $errEmail = '';
            $errEmail2 = '';
            $errPassword = '';
            $errConfirmpassword = '';

            // handling empty/invalid inputs
            if (!$_POST['firstname']) {
                $errFirstname = 'Please enter your first name';
            }
            if (!$_POST['lastname']) {
                $errLastname = 'Please enter your last name';
            }
            if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errEmail = 'Please enter a valid email address';
            }
            if (!$_POST['password']) {
                $errPassword = 'Please enter a password';
            }
            if ($_POST['confirmpassword'] != $_POST['password']) {
                $errConfirmpassword = 'Please repeat your password correctly';
            }

            // duplicate email/account verification
            $duplicateEmailQuery = "SELECT * FROM `users` where (email = '$email')";
            $duplicateEmailResult = mysqli_query($link, $duplicateEmailQuery);
            if (mysqli_num_rows($duplicateEmailResult) > 0) {
                $errEmail = 'There is already a user registered under that email';
            }

            // signup procedure
            if (!$errFirstname && !$errLastname && !$errEmail && !$errPassword && !$errConfirmpassword) {

                // hash pw
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // insert data
                $query = "INSERT INTO `users` (password, firstname, lastname, email) VALUES ('$hashed_password', '$firstname', '$lastname', '$email')";
                $result = mysqli_query($link, $query);

                // output result
                if ($result) {
                    $signupresult = '<div class="alert alert-success">Registration successful! Click <a href="apply">here</a> to login and continue your PLISMUN application</div>';
                } else {
                    $signupresult = '<div class="alert alert-danger">Sorry, an error occurred while signing up. Please try again</div>';
                }
            }
        }

        ?>


        <!-- Preloader -->
        <div id="preloader">
            <div id="load"><img class="wow fadeInDown" src="img/plismun19_a_notext.png"></div>
        </div>





        <!-- navbar, inserted via js -->
        <div id="header"></div>


        <div class="signup">
            <div class="signup-window">
                <div class="container">
                    <h2>Register Account</h2>



                    <form id="signup" class="form-horizontal" method="post" action="signup">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <?php echo $signupresult ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-4" for="firstname">First Name: </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $_POST['firstname']; ?>">
                                <?php echo "<p class='text-danger'><b>$errFirstname</b></p>";?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-4" for="lastname">Last Name: </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $_POST['lastname']; ?>">
                                <?php echo "<p class='text-danger'><b>$errLastname</b></p>";?>
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
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-4" for="confirmpassword">Confirm password:</label>
                            <div class="col-md-4">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" value="<?php echo $_POST['confirmpassword']; ?>">
                                <?php echo "<p class='text-danger'><b>$errConfirmpassword</b></p>";?>
                            </div>
                        </div>
                        <input id="submit" name="submit" type="submit" class="btn btn-success btn-send col-md-4 col-md-offset-4" value="Sign Up">
<!--
                        <div class="form-group row">
                            <div class="col-md-4 col-md-offset-4">
                                <p>By signing up, you agree to our privacy policy</p>
                            </div>
                        </div>
-->
                    </form>


                </div>
            </div>
        </div>











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
            });
        </script>

    </body>

</html>
