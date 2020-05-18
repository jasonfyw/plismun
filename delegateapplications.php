<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>PLISMUN Delegate Applications</title>

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
        <link href="css/pages/delegateapplications.css" rel="stylesheet">
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


        session_start();
        require_once('class.phpmailer.php');
        require_once('config.php');
        require_once('application_mail_config.php');


        if (isset($_POST['submit'])) {
            $verdict = $_POST['verdictradio'];
            $userid = $_POST['userid'];
            if ($verdict == 'approved') {

                $committee = $_POST['committee'];
                $country = $_POST[$committee . 'countries'];


                if (!$_POST['committee']) {
                    $errCommittee = 'Select a committee';
                }
                if(!$_POST[$committee . 'countries']) {
                    $errCountry = 'Select a country';
                }


                if (!$errCommittee && !$errCountry) {
                    $updatedelegate = mysqli_query($link, "UPDATE `delegates` SET committee = '$committee', country = '$country' WHERE userid = $userid");
                    $updatedelegate2 = mysqli_query($link, "UPDATE $committee SET userid = $userid WHERE countrycode = '$country'");

                    $display_country = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname FROM $committee WHERE countrycode = '$country'"))['displayname'];

                    $display_committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname FROM committees WHERE abbvname = '$committee'"))['displayname'];
                    if ($committee != 'legal' && $committee != 'unwomen') {
                        $abbvcommittee = "(".strtoupper($committee).")";
                    }

                    $delegate_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email FROM users WHERE id=$userid"));


                    // phpmailer EMAIL

                    $mail = new PHPMailer();
                    $body =
                        "<h2>Your delegate application has been accepted by the approval team!</h2>

                        <p>Dear ".$delegate_info['firstname']. ' ' .$delegate_info['lastname'].", </p>
                        <p>We are pleased to inform you that your application to PLISMUN21 has been approved! </p>
                        <p>You have been selected to represent <b>".$display_country."</b> in the <b>".$display_committee." ".$abbvcommittee."</b>. To view your committee, head over to <a href='plismun.com/viewcommittee'>plismun.com/viewcommittee</a><br /><br /></p>
                        <h4>Payment details:</h4>
                        <p><b>Below you will find the details to which the fee of €44 should be paid to <i><u>within 2 weeks of receiving this email</u></i> with your name and 'PLISMUN21' included in the payment note:</b><br /></p>
                        <p>CZK Account number: 2107914717/2700<br />
                        IBAN: CZ88 2700 0000 0021 0791 4717<br />
                        SWIFT: BACXCZPP<br />
                        Variable code: 190101<br />
                        Bank name: UniCredit bank Na Příkopě 858/20 113 80 Praha 1</p>
                        <p><b>Using Internet banking, you must select either international wire transfer (non-domestic; you are paying with a foreign currency to a CZK account) or domestic payment (paying CZK to CZK account).</b></p>
                        <p><b><i>Once the payment has been made, please email a copy of the invoice to <a href='mailto:plismun.official@gmail.com'>plismun.official@gmail.com</a> so we can confirm your payment</i></b><br /></p>
                        <p>Thank you for your interest and participation in PLISMUN21, we look forward to seeing you in January!</p>



                        <p><br><br><i>This is an automated message generated by <a href='plismun.com'>plismun.com</a>. Please do not reply to this email. If you would like to contact us, head to <a href='plismun.com/contact'>plismun.com/contact</a> </i></p>";



                    $mail->IsSMTP(); // telling the class to use SMTP
                    $mail->SMTPAuth = true;                  // enable SMTP authentication
                    $mail->Host = $host; // sets the SMTP server
                    $mail->Port = $port;

                    $mail->Username = $username; // SMTP account username
                    $mail->Password = $password;        // SMTP account password

                    $mail->SetFrom($username, 'PLISMUN Notification');

                    // $mail->AddReplyTo("name@yourdomain.com","First Last");

                    $mail->Subject = "Your PLISMUN21 application has been accepted!";


                    $mail->MsgHTML($body);

                    $address = $delegate_info['email'];
                    $mail->AddAddress($address);
                    $address2 = 'archive@plismun.com';
                    $mail->AddAddress($address2);


                    if ($updatedelegate && $updatedelegate2) {
                        if(!$mail->Send()) {
                            $verdictresult = '<div class="alert alert-danger">An error occurred. Please try again. The records have been updated but the delegate has not been emailed</div>';
                        } else {
                            $verdictresult = '<div class="alert alert-success">Verdict delivered successfully. The delegate has been emailed</div>';
                        }
                    }
                }

            } elseif ($verdict == 'rejected') {
                $updatedelegate = mysqli_query($link, "UPDATE `delegates` SET committee = 'REJECTED', country = 'REJECTED', payment_status = 'REJECTED' WHERE userid = $userid");

                $delegate_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email FROM users WHERE id=$userid"));

                // phpmailer EMAIL

                $mail = new PHPMailer();
                $body =
                    "<h2>Your delegate application has been rejected</h2>

                    <p>Dear ".$delegate_info['firstname']. ' ' .$delegate_info['lastname'].", </p>
                    <p>It is our regret to inform you that your delegate application for PLISMUN21 has not been approved. </p>
                    <p>If you would like to contact us regarding this decision, kindly email us at <a href='mailto:secretariat@plismun.com'>secretariat@plismun.com</a> so we may discuss further options</p>
                    <p>Thank you for your interest in PLISMUN21!</p>



                    <p><br><br><i>This is an automated message generated by <a href='plismun.com'>plismun.com</a>. Please do not reply to this email. If you would like to contact us, head to <a href='plismun.com/contact'>plismun.com/contact</a> </i></p>";



                $mail->IsSMTP(); 

                $mail->SMTPAuth = true; 
                $mail->Host = $host;
                $mail->Port = $port;

                $mail->Username = $username; 
                $mail->Password = $password; 

                $mail->SetFrom($username, 'PLISMUN Notification');

                $mail->Subject = "Your PLISMUN21 application has been rejected";


                $mail->MsgHTML($body);

                $address = $delegate_info['email'];
                $mail->AddAddress($address);

                if ($updatedelegate) {
                    $verdictresult = '<div class="alert alert-success">The records have been updated. Please follow up with a manual email to the deleate (<a href="mailto:'.$address.'">'.$address.'</a>)</div>';
                }

                // if ($updatedelegate) {
                //     if(!$mail->Send()) {
                //         $verdictresult = '<div class="alert alert-danger">An error occurred. Please try again. The records have been updated but the delegate has not been emailed</div>';
                //     } else {
                //         $verdictresult = '<div class="alert alert-success">Verdict delivered successfully. The delegate has been notified via email</div>';
                //     }
                // }
            }
        }

        ?>




        <?php
        if(isset($_SESSION['id']) && $_SESSION['position'] == 'admin')
        {
            ?>
            <div class="container" style="margin-top: 30px;">
                <div class="text-center">
                    <h1>Pending Delegate Applications </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <hr class="marginbot-50">
                </div>
            </div>

            <!-- i need:
            - firstname
            - lastname
            - userid
            - delegateid
            - committee/country choices
            -  -->

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php echo $verdictresult ?>
                </div>
            </div>

            <?php
            $alldelegates = mysqli_query($link, "SELECT * FROM delegates");
            while ($delegate = mysqli_fetch_assoc($alldelegates)) {
                if ($delegate['committee'] == '' && $delegate['country'] == '') {
                    $userid = $delegate['userid'];
                    $user = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, schoolname FROM users WHERE id=$userid"));

                    $choice1country = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname2 FROM ".$delegate['choice1committee']. " WHERE countrycode = '".$delegate['choice1country']."'"))['displayname2'];
                    $choice2country = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname2 FROM ".$delegate['choice2committee']. " WHERE countrycode = '".$delegate['choice2country']."'"))['displayname2'];;
                    $choice3country = mysqli_fetch_assoc(mysqli_query($link, "SELECT displayname2 FROM ".$delegate['choice3committee']. " WHERE countrycode = '".$delegate['choice3country']."'"))['displayname2'];;
                    ?>
                    
                    <div class="container app">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="text-center">Application</h5>
                                    <hr class="marginbot-30" />
                                </div>

                                <div class="col-sm-6">
                                    <div class="app-personal row">
                                        <div class="col-sm-3">
                                            <p><i>Name:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="app-personal row">
                                        <div class="col-sm-3">
                                            <p><i>School:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo $user['schoolname']; ?></h4>
                                        </div>
                                    </div>
                                    <div class="app-personal row">
                                        <div class="col-sm-3">
                                            <p><i>Delegation:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo $delegate['delegation']; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="app-choice row">
                                        <div class="col-sm-3">
                                            <p><i>Preference 1:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="inline"><?php echo $delegate['choice1committee']; ?></h4>
                                            <p class="inline"> &nbsp;&nbsp; –– &nbsp;&nbsp; </p>
                                            <h6 class="inline"><?php echo $choice1country; ?></h6>
                                        </div>
                                    </div>
                                    <div class="app-choice row">
                                        <div class="col-sm-3">
                                            <p><i>Preference 2:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="inline"><?php echo $delegate['choice2committee']; ?></h4>
                                            <p class="inline"> &nbsp;&nbsp; –– &nbsp;&nbsp; </p>
                                            <h6 class="inline"><?php echo $choice2country; ?></h6>
                                        </div>
                                    </div>
                                    <div class="app-choice row">
                                        <div class="col-sm-3">
                                            <p><i>Preference 3:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="inline"><?php echo $delegate['choice3committee']; ?></h4>
                                            <p class="inline"> &nbsp;&nbsp; –– &nbsp;&nbsp; </p>
                                            <h6 class="inline"><?php echo $choice3country; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="inline"><i>MUN Experience: &nbsp;&nbsp;&nbsp;  </i></p>
                                    <a class="inline" data-toggle="collapse" data-target="<?php echo '#'.$userid.'experience'; ?>" aria-expanded="false"><b>Click to view</b></a>
                                    <div class="collapse" id="<?php echo $userid.'experience'; ?>">
                                        <div class="card card-body">
                                            <?php echo $delegate['experience']; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="inline"><i>Motivation Letter: &nbsp;&nbsp;&nbsp;  </i></p>
                                    <a class="inline" data-toggle="collapse" data-target="<?php echo '#'.$userid.'motivation'; ?>" aria-expanded="false"><b>Click to view</b></a>
                                    <div class="collapse" id="<?php echo $userid.'motivation'; ?>">
                                        <div class="card card-body">
                                            <?php echo $delegate['motivationletter']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="text-center">Verdict</h5>
                                    <hr class="marginbot-0">
                                </div>

                                <form class="form-horizontal" method="post" action="delegateapplications">
                                    <div class="col-sm-12">
                                            <div class="row">



                                                <div class="col-sm-6 form-check form-check-inline">
                                                    <div class="funkyradio funkyradio-success">
                                                    <input class="form-check-input" type="radio" name="verdictradio" id="<?php echo $userid.'approved'; ?>" value="approved">
                                                    <label class="form-check-label" for="<?php echo $userid.'approved'; ?>">Approved</label>
                                                </div>
                                                </div>
                                                <div class="col-sm-6 form-check form-check-inline">
                                                    <div class="funkyradio funkyradio-danger">
                                                    <input class="form-check-input" type="radio" name="verdictradio" id="<?php echo $userid.'rejected'; ?>" value="rejected">
                                                    <label class="form-check-label" for="<?php echo $userid.'rejected'; ?>">Rejected</label>
                                                </div>
                                                </div>


                                            </div>
                                    </div>

                                    <div class="col-sm-6">


                                        <label class="control-label col-sm-4" for="1"><i>Only if application is approved: </i></label>
                                        <!-- COMMITTEE PICKER -->
                                        <div class="col-md-8">
                                            <select class="selectpicker" id="<?php echo $userid.'committee'; ?>" name="committee" title="Select a committee">
                                                <!-- <optgroup label="General Assemblies">
                                                </optgroup> -->
                                                <?php 
                                                $committees = mysqli_query($link, "SELECT * FROM committees");
                                                while ($committee = mysqli_fetch_assoc($committees)) {
                                                    $abbvname = $committee["abbvname"];
                                                    $displayname = $committee["displayname"];
                                                    ?>
                                                    <option value="<?php echo $abbvname; ?>">
                                                        <?php 
                                                        echo $displayname; 
                                                        if ($abbvname != "legal" && $abbvname != "unwomen") {
                                                            echo " (" . strtoupper($abbvname) . ")";
                                                        }
                                                        ?> 
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>


                                        </div>
                                        <label class="control-label col-sm-4"></label>

                                        <!-- COUNTRY PICKER -->
                                        <div class="col-md-8">
                                            <?php 
                                            $abbvcommittees = mysqli_query($link, "SELECT abbvname FROM committees");
                                            while ($abbvcommittee = mysqli_fetch_assoc($abbvcommittees)) {
                                                $abbvname = $abbvcommittee['abbvname'];
                                                ?>
                                                <div id="<?php echo $userid.$abbvname.'countries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                    <select class="selectpicker" name="<?php echo $abbvname.'countries'; ?>" title="Select a country" data-live-search="true">
                                                        <optgroup label="<?php echo strtoupper($abbvname); ?> Countries" style="color: black">
                                                            <?php
                                                            $country_data = mysqli_query($link, "SELECT countrycode, displayname2, userid FROM ".$abbvname);
                                                            while ($country = mysqli_fetch_assoc($country_data)) {
                                                                if ($country['userid'] == 0) {
                                                                    echo '<option value='.$country['countrycode'].'>'.$country['displayname2'].'</option>';
                                                                } else {
                                                                    echo '<option value='.$country['countrycode'].' disabled>'.$country['displayname2'].'</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-8 col-sm-offset-2">
                                        <hr class="marginbot-20">
                                    </div>
                                    <input type="hidden" value="<?php echo $userid; ?>" name="userid">


                                    <div class="col-sm-4 container">
                                        <input id="<?php echo $userid . 'submit'; ?>" name="submit" type="submit" class="btn btn-success btn-send col-md-3" value="Submit">
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                <?php
                }
            }
            ?>





            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>reeeeeeeeee</b>


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
          });




        </script>

        <?php
        for ($x = 1; $x <= mysqli_num_rows(mysqli_query($link, 'SELECT * FROM `delegates`')); $x++)
        {
            $y = $x - 1;
            $delegateid = mysqli_fetch_assoc(mysqli_query($link, "SELECT delegateid FROM `delegates` LIMIT 1 OFFSET $y"))["delegateid"];
            $userid = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid FROM `delegates` WHERE delegateid = $delegateid"))["userid"];

            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT committee FROM `delegates` WHERE delegateid = $delegateid"))["committee"] == '' && mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `delegates` WHERE delegateid = $delegateid"))["country"] == '')
            { ?>

                <script type="text/javascript">
                    $(function() {
                        $('<?php echo '#'. $userid .'committee';?>').change(function(){
                            $('<?php echo '.'. $userid .'countries' ?>').hide();
                            $('<?php echo '#' . $userid ; ?>' + $(this).val() + 'countries').show();
                        });
                    });
                </script>
            <?php }
        }
        ?>


    </body>

</html>
