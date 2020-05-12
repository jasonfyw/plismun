<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Contact – PLISMUN</title>

        <!-- Bootstrap Core CSS -->

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />
        <!-- css -->
        <link href="css/pages/contact.css" rel="stylesheet">
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
        error_reporting( error_reporting() & ~E_NOTICE );

        if (isset($_POST["submit"])) {
            // setting variables
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            require_once('class.phpmailer.php');

            $errEmail = '';
            $errFirstname = '';
            $errLastname = '';
            $errMessage = '';
            $errSubject = '';

            // phpmailer EMAIL

            $mail = new PHPMailer();
            $body =
                "<h2>Message from PLISMUN contact form</h2>

                <p><b>From: </b>".$firstname. ' ' .$lastname." </p>
                <p><b>Email: </b>".$email." </p>
                <p><b>Subject: </b>".$subject."</p>
                <p><b>Message:</b>".$message."</p>";



            $mail->IsSMTP(); // telling the class to use SMTP

            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->Host = "mx1.hostinger.com"; // sets the SMTP server
            $mail->Port = 587;

            $mail->Username = "info@plismun.com"; // SMTP account username
            $mail->Password = "plismun123";        // SMTP account password

            $mail->SetFrom('info@plismun.com', 'PLISMUN Notification');

            // $mail->AddReplyTo("name@yourdomain.com","First Last");

            $mail->Subject = "Message from website contact page from ".$firstname." ".$lastname;


            $mail->MsgHTML($body);

            $address = 'plismun.official@gmail.com';
            $mail->AddAddress($address);
            $address2 = 'pupil.jason.wang@parklane-is.com';
            $mail->AddAddress($address2);

            // $to = 'plismun.official@gmail.com';

            // $body = "From: $firstname $lastname\n E-Mail: $email\n Message:\n $message";

            // Check if name has been entered
            if (!$_POST['firstname']) {
                $errFirstname = 'Please enter your first name';
            }
            if (!$_POST['lastname']) {
                $errLastname = 'Please enter your last name';
            }

            if (!$_POST['subject']) {
                $errSubject = 'Please enter a subject';
            }

            // check if email entered and valid
            if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errEmail = 'Please enter a valid email address';
            }

            // check if message has been entered
            if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
            }

            // if there are no errors, send the email
            if (!$errFirstname && !$errLastname && !$errEmail && !$errSubject && !$errMessage) {
                if (!$mail->Send()) {
                    $result='<div class="alert alert-danger">Sorry, there was an error sending your message. Please try again</div>';
                } else {
                    $result='<div class="alert alert-success">Thank you for your message, we will get back as soon as possible!</div>';
                }
            }
        }
        ?>




        <!-- Preloader -->
        <div id="preloader-overlay"></div>





        <!-- navbar, inserted via js -->
        <div id="header"></div>



        <!-- Section: intro -->
        <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
            <div class="slogan">
                <h2>Contact Us</h2>
            </div>
        </section>
        <!-- /Section: intro -->






        <section id="main" class="home-section">

            <div class="container social-media">
                <div class="wow fadeInDown" data-wow-delay="0s">
                    <div class="row container contactbuttons">
                        <div class="col-sm-3">
                            <p><a href="mailto:plismun.official@gmail.com" class="fa fa-envelope-o fa-large"></a></p>
                            <p><b><a href="mailto:plismun.official@gmail.com">plismun.official@gmail.com</a></b></p>
                        </div>
                        <div class="col-sm-3">
                            <p><a href="https://www.facebook.com/Park-Lane-International-School-MUN-211767739632155/" class="fa fa-facebook fa-large"></a></p>
                            <p><b><a href="https://www.facebook.com/Park-Lane-International-School-MUN-211767739632155/">Facebook</a></b></p>
                        </div>
                        <div class="col-sm-3">
                            <p><a href="https://www.instagram.com/plismun/" class="fa fa-instagram fa-large"></a></p>
                            <p><b><a href="https://www.instagram.com/plismun/">Instagram</a></b></p>
                        </div>
                        <div class="col-sm-3">
                            <p><a href="https://twitter.com/plismun" class="fa fa-twitter fa-large"></a></p>
                            <p><b><a href="https://twitter.com/plismun">Twitter</a></b></p>
                        </div>
                    </div>
                </div>
                <div class="container row">
                    <div class="col-lg-2 col-lg-offset-5">
                        <hr class="marginbot-50">
                    </div>
                </div>
            </div>


            <!-- email form -->
            <div class="container">
                <h3>Via email contact form</h3>
                <form id="contact-form" class="form-horizontal" method="post" action="contact" role="form">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <?php echo $result ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="firstname">First Name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name" value="<?php echo htmlspecialchars($_POST['firstname']); ?>">
                            <?php echo "<p class='text-danger'>$errFirstname</p>";?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="lastname">Last Name: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name" value="<?php echo htmlspecialchars($_POST['lastname']); ?>">
                            <?php echo "<p class='text-danger'>$errLastname</p>";?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email: </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="email@website.com" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                            <?php echo "<p class='text-danger'>$errEmail</p>";?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="subject">Subject: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="subject" placeholder="Brief subject title" name="subject" value="<?php echo htmlspecialchars($_POST['subject']); ?>">
                            <?php echo "<p class='text-danger'>$errSubject</p>";?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="message">Message: </label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="message" placeholder="Enter your message here" name="message" rows="5" value="<?php echo htmlspecialchars($_POST['message']); ?>"></textarea>
                            <?php echo "<p class='text-danger'>$errMessage</p>";?>
                        </div>
                    </div>
                    <input id="submit" name="submit" type="submit" class="btn btn-success btn-send col-sm-3 offset-sm-3" value="Send Message">

                </form>
            </div>

        </section>





        <!-- footer.html inserted using jquery-->
        <div id="footer"></div>










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
