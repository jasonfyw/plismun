<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Forgot Password – PLISMUN</title>

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

        if (isset($_POST["submit"])) {
            // gets email
            $email = mysqli_real_escape_string($link, $_POST['email']);

            // handles incorrect or invalid emails
            if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errEmail = 'Please enter a valid email address';
            }

            if (!$errEmail) {
                // generates 128char reset token
                $token = bin2hex(random_bytes(64));
                // query to update resettoken field
                $query = "UPDATE `users` SET resettoken = '$token' WHERE email = '$email';";
                $result = mysqli_query($link, $query);

                // link to be send to user
                $resetLink = "http://plismun.com/resetpassword?email=$email&token=$token";

                // html body of email
                $message = "<p>Click here to reset your password: <a href='$resetLink'>reset password</a></p>";


                // set content-type header for sending html email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // additional headers
                $headers .= 'From: plismun-noreply' . "\r\n";


                // send email
                if ($result) {
                    if (mail ($email, 'Reset PLISMUN password', $message, $headers)) {
                        $resetResult = '<div class="alert alert-success">An email with a link to reset your password has been sent to your address. This may take a few minutes</div>';
                    } else {
                        $resetResult = '<div class="alert alert-danger">There was an error sending the email with the reset link</div>';
                    }
                } else {
                    $resetResult = '<div class="alert alert-danger">An error occurred. Please try again</div>';
                }
            }
        }

        ?>


        <!-- Preloader -->
        <div id="preloader-overlay"></div>





        <!-- navbar, inserted via js -->
        <div id="header"></div>


        <div class="signup">
            <div class="signup-window">
                <div class="container">
                    <h2>Forgot Password</h2>
                    <form id="signup" class="form-horizontal" method="post" action="forgotpassword">
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <?php echo $resetResult ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-4" for="lastname">Email: </label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $_POST['email']; ?>">
                                <?php echo "<p class='text-danger'><b>$errEmail</b></p>";?>
                            </div>
                        </div>

                        <input id="submit" name="submit" type="submit" class="btn btn-success btn-send col-md-4 col-md-offset-4" value="Reset password">
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
                $("#preloader-overlay").load("preloader");
            });
        </script>

    </body>

</html>
