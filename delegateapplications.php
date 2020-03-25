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
                    $updatedelegate2 = mysqli_query($link, "UPDATE $committee SET userid = $userid WHERE country = '$country'");

                    $display_country = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM $committee WHERE country = '$country'"))['display_country'];

                    $delegate_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email FROM users WHERE id=$userid"));





                    if ($committee == 'histsec') {
                        $committee = 'Historical Security Council';
                    } elseif ($committee == 'sec') {
                        $committee = 'Security Council';
                    }





                    // phpmailer EMAIL

                    $mail = new PHPMailer();
                    $body =
                        "<h2>Your delegate application has been accepted by the approval team!</h2>

                        <p>Dear ".$delegate_info['firstname']. ' ' .$delegate_info['lastname'].", </p>
                        <p>We are pleased to inform you that your application to PLISMUN20   has been approved! </p>
                        <p>You have been selected to represent <b>".$display_country."</b> in the <b>".strtoupper($committee)."</b> committee. To view your committee, head over to <a href='plismun.com/viewcommittee'>plismun.com/viewcommittee</a><br /><br /></p>
                        <h4>Payment details:</h4>
                        <p><b>Below you will find the details to which the fee of €44 should be paid to <i><u>within 2 weeks of receiving this email</u></i> with your name and 'PLISMUN20' included in the payment note:</b><br /></p>
                        <p>CZK Account number: 2107914717/2700<br />
                        IBAN: CZ88 2700 0000 0021 0791 4717<br />
                        SWIFT: BACXCZPP<br />
                        Variable code: 190101<br />
                        Bank name: UniCredit bank Na Příkopě 858/20 113 80 Praha 1</p>
                        <p><b>Using Internet banking, you must select either international wire transfer (non-domestic; you are paying with a foreign currency to a CZK account) or domestic payment (paying CZK to CZK account).</b></p>
                        <p><b><i>Once the payment has been made, please email a copy of the invoice to <a href='mailto:plismun.official@gmail.com'>plismun.official@gmail.com</a> so we can confirm your payment</i></b><br /></p>
                        <p>Thank you for your interest and participation in PLISMUN20, we look forward to seeing you in January!</p>



                        <p><br><br><i>This is an automated message generated by <a href='plismun.com'>plismun.com</a>. Please do not reply to this email. If you would like to contact us, head to <a href='plismun.com/contact'>plismun.com/contact</a> </i></p>";



                    $mail->IsSMTP(); // telling the class to use SMTP

                    $mail->SMTPAuth = true;                  // enable SMTP authentication
                    $mail->Host = "mx1.hostinger.com"; // sets the SMTP server
                    $mail->Port = 587;

                    $mail->Username = "info@plismun.com"; // SMTP account username
                    $mail->Password = "plismun123";        // SMTP account password

                    $mail->SetFrom('info@plismun.com', 'PLISMUN Notification');

                    // $mail->AddReplyTo("name@yourdomain.com","First Last");

                    $mail->Subject = "Your PLISMUN20 application has been accepted!";


                    $mail->MsgHTML($body);

                    $address = $delegate_info['email'];
                    $mail->AddAddress($address);


                    if ($updatedelegate && $updatedelegate2) {
                        if(!$mail->Send()) {
                            $verdictresult = '<div class="alert alert-danger">An error occurred. Please try again</div>';
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
                    <p>It is our regret to inform you that your delegate application for PLISMUN20 has not been approved. </p>
                    <p>If you would like to contact us regarding this decision, kindly email us at <a href='mailto:plismun.official@gmail.com'>plismun.official@gmail.com</a> so we may discuss further options</p>
                    <p>Thank you for your interest in PLISMUN20!</p>



                    <p><br><br><i>This is an automated message generated by <a href='plismun.com'>plismun.com</a>. Please do not reply to this email. If you would like to contact us, head to <a href='plismun.com/contact'>plismun.com/contact</a> </i></p>";



                $mail->IsSMTP(); // telling the class to use SMTP

                $mail->SMTPAuth = true; // enable SMTP authentication
                $mail->Host = "mx1.hostinger.com"; // sets the SMTP server
                $mail->Port = 587;

                $mail->Username = "info@plismun.com"; // SMTP account username
                $mail->Password = "plismun123"; // SMTP account password

                $mail->SetFrom('info@plismun.com', 'PLISMUN Notification');

                // $mail->AddReplyTo("name@yourdomain.com","First Last");

                $mail->Subject = "Your PLISMUN20 application has been rejected";


                $mail->MsgHTML($body);

                $address = $delegate_info['email'];
                $mail->AddAddress($address);

                if ($updatedelegate) {
                    if(!$mail->Send()) {
                        $verdictresult = '<div class="alert alert-danger">An error occurred. Please try again</div>';
                    } else {
                        $verdictresult = '<div class="alert alert-success">Verdict delivered successfully. The delegate has been notified via email</div>';
                    }
                }
            }
        }

        ?>


        <!-- Preloader -->
        <div id="preloader">
            <div id="load"><img class="wow fadeInDown" src="img/plismun19_a_notext.png"></div>
        </div>





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
            for ($x = 1; $x <= mysqli_num_rows(mysqli_query($link, 'SELECT * FROM `delegates`')); $x++)
            {
                $y = $x - 1;
                // not efficient, import all data into one array
                $delegateid = mysqli_fetch_assoc(mysqli_query($link, "SELECT delegateid FROM `delegates` LIMIT 1 OFFSET $y"))["delegateid"];

                if (mysqli_fetch_assoc(mysqli_query($link, "SELECT committee FROM `delegates` WHERE delegateid = $delegateid"))["committee"] == '' && mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `delegates` WHERE delegateid = $delegateid"))["country"] == '') {

                    $userid = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid FROM `delegates` WHERE delegateid = $delegateid"))["userid"];
                    $firstname = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname FROM `users` WHERE id = $userid"))["firstname"];
                    $lastname = mysqli_fetch_assoc(mysqli_query($link, "SELECT lastname FROM `users` WHERE id = $userid"))['lastname'];
                    $school = mysqli_fetch_assoc(mysqli_query($link, "SELECT schoolname FROM `users` WHERE id = $userid"))['schoolname'];
                    $delegation = mysqli_fetch_assoc(mysqli_query($link, "SELECT delegation FROM `delegates` WHERE userid = $userid"))['delegation'];


                    $choice1committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT choice1committee FROM `delegates` WHERE userid = $userid"))['choice1committee'];
                    $choice1country = mysqli_fetch_assoc(mysqli_query($link, "SELECT choice1country FROM `delegates` WHERE userid = $userid"))['choice1country'];
                    $choice2committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT choice2committee FROM `delegates` WHERE userid = $userid"))['choice2committee'];
                    $choice2country = mysqli_fetch_assoc(mysqli_query($link, "SELECT choice2country FROM `delegates` WHERE userid = $userid"))['choice2country'];
                    $choice3committee = mysqli_fetch_assoc(mysqli_query($link, "SELECT choice3committee FROM `delegates` WHERE userid = $userid"))['choice3committee'];
                    $choice3country = mysqli_fetch_assoc(mysqli_query($link, "SELECT choice3country FROM `delegates` WHERE userid = $userid"))['choice3country'];

                    $experience = mysqli_fetch_assoc(mysqli_query($link, "SELECT experience FROM `delegates` WHERE userid = $userid"))['experience'];
                    $motivation = mysqli_fetch_assoc(mysqli_query($link, "SELECT motivationletter FROM `delegates` WHERE userid = $userid"))['motivationletter'];

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
                                            <h4><?php echo $firstname . ' ' . $lastname; ?></h4>
                                        </div>
                                    </div>
                                    <div class="app-personal row">
                                        <div class="col-sm-3">
                                            <p><i>School:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo $school; ?></h4>
                                        </div>
                                    </div>
                                    <div class="app-personal row">
                                        <div class="col-sm-3">
                                            <p><i>Delegation:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4><?php echo $delegation; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="app-choice row">
                                        <div class="col-sm-3">
                                            <p><i>Preference 1:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="inline"><?php echo $choice1committee; ?></h4>
                                            <p class="inline"> &nbsp;&nbsp; –– &nbsp;&nbsp; </p>
                                            <h6 class="inline"><?php echo $choice1country; ?></h6>
                                        </div>
                                    </div>
                                    <div class="app-choice row">
                                        <div class="col-sm-3">
                                            <p><i>Preference 2:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="inline"><?php echo $choice2committee; ?></h4>
                                            <p class="inline"> &nbsp;&nbsp; –– &nbsp;&nbsp; </p>
                                            <h6 class="inline"><?php echo $choice2country; ?></h6>
                                        </div>
                                    </div>
                                    <div class="app-choice row">
                                        <div class="col-sm-3">
                                            <p><i>Preference 3:</i></p>
                                        </div>
                                        <div class="col-sm-9">
                                            <h4 class="inline"><?php echo $choice3committee; ?></h4>
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
                                            <?php echo $experience; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <p class="inline"><i>Motivation Letter: &nbsp;&nbsp;&nbsp;  </i></p>
                                    <a class="inline" data-toggle="collapse" data-target="<?php echo '#'.$userid.'motivation'; ?>" aria-expanded="false"><b>Click to view</b></a>
                                    <div class="collapse" id="<?php echo $userid.'motivation'; ?>">
                                        <div class="card card-body">
                                            <?php echo $motivation; ?>
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
                                        <div class="col-md-8">
                                            <select class="selectpicker" id="<?php echo $userid.'committee'; ?>" name="committee" title="Select a committee">
                                                <!-- <optgroup label="General Assemblies">
                                                </optgroup> -->
                                                <option value="ecosoc">ECOSOC</option>
                                                <option value="hrc">Human Rights Council (HRC)</option>
                                                <option value="icj">International Court of Justice (ICJ)</option>
                                                <option value="legal">Legal Committee</option>
                                                <option value="sec">Security Council</option>
                                                <option value="histsec">Historical Security Council</option>
                                                <option value="unwomen">UN Women</option>
                                            </select>


                                        </div>
                                        <label class="control-label col-sm-4"></label>

                                        <!--  -->
                                        <div class="col-md-8">

                                            <!-- ECOSOC -->
                                            <div id="<?php echo $userid.'ecosoccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="ecosoccountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="ECOSOC Countries">
                                                        <?php
                                                        for ($ecosoc = 1; $ecosoc <= 17; $ecosoc++) {
                                                            $ecosocpos = $ecosoc - 1;
                                                            $ecosoccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `ecosoc` LIMIT 1 OFFSET $ecosocpos"))['country'];
                                                            $ecosoccountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `ecosoc` LIMIT 1 OFFSET $ecosocpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `ecosoc` WHERE country = '$ecosoccountry'"))['userid'] == 0) {
                                                                echo '<option value='.$ecosoccountry.'>'.$ecosoccountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$ecosoccountry.' disabled>'.$ecosoccountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <!-- HRC -->
                                            <div id="<?php echo $userid.'hrccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="hrccountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="HRC Countries">
                                                        <?php
                                                        for ($hrc = 1; $hrc <= 18; $hrc++) {
                                                            $hrcpos = $hrc - 1;
                                                            $hrccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `hrc` LIMIT 1 OFFSET $hrcpos"))['country'];
                                                            $hrccountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `hrc` LIMIT 1 OFFSET $hrcpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `hrc` WHERE country = '$hrccountry'"))['userid'] == 0) {
                                                                echo '<option value='.$hrccountry.'>'.$hrccountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$hrccountry.' disabled>'.$hrccountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <!-- ICJ -->
                                            <div id="<?php echo $userid.'icjcountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="icjcountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="ICJ Countries">
                                                        <?php
                                                        for ($icj = 1; $icj <= 15; $icj++) {
                                                            $icjpos = $icj - 1;
                                                            $icjcountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `icj` LIMIT 1 OFFSET $icjpos"))['country'];
                                                            $icjcountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `icj` LIMIT 1 OFFSET $icjpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `icj` WHERE country = '$icjcountry'"))['userid'] == 0) {
                                                                echo '<option value='.$icjcountry.'>'.$icjcountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$icjcountry.' disabled>'.$icjcountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <!-- LEGAL -->
                                            <div id="<?php echo $userid.'legalcountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="legalcountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="Legal Committee Countries">
                                                        <?php
                                                        for ($legal = 1; $legal <= 19; $legal++) {
                                                            $legalpos = $legal - 1;
                                                            $legalcountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `legal` LIMIT 1 OFFSET $legalpos"))['country'];
                                                            $legalcountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `legal` LIMIT 1 OFFSET $legalpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `legal` WHERE country = '$legalcountry'"))['userid'] == 0) {
                                                                echo '<option value='.$legalcountry.'>'.$legalcountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$legalcountry.' disabled>'.$legalcountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <!-- SECURITY -->
                                            <div id="<?php echo $userid.'seccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="seccountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="Security Council Countries">
                                                        <?php
                                                        for ($sec = 1; $sec <= 15; $sec++) {
                                                            $secpos = $sec - 1;
                                                            $seccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `sec` LIMIT 1 OFFSET $secpos"))['country'];
                                                            $seccountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `sec` LIMIT 1 OFFSET $secpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `sec` WHERE country = '$seccountry'"))['userid'] == 0) {
                                                                echo '<option value='.$seccountry.'>'.$seccountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$seccountry.' disabled>'.$seccountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <!-- HISTORICAL SEC -->
                                            <div id="<?php echo $userid.'histseccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="histseccountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="Historical Security Council Countries">
                                                        <?php
                                                        for ($histsec = 1; $histsec <= 15; $histsec++) {
                                                            $histsecpos = $histsec - 1;
                                                            $histseccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `histsec` LIMIT 1 OFFSET $histsecpos"))['country'];
                                                            $histseccountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `histsec` LIMIT 1 OFFSET $histsecpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `histsec` WHERE country = '$histseccountry'"))['userid'] == 0) {
                                                                echo '<option value='.$histseccountry.'>'.$histseccountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$histseccountry.' disabled>'.$histseccountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <!-- UN WOMEN -->
                                            <div id="<?php echo $userid.'unwomencountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                                <select class="selectpicker" name="unwomencountries" title="Select a country" data-live-search="true">
                                                    <optgroup label="UN Women Countries">
                                                        <?php
                                                        for ($unwomen = 1; $unwomen <= 20; $unwomen++) {
                                                            $unwomenpos = $unwomen - 1;
                                                            $unwomencountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `unwomen` LIMIT 1 OFFSET $unwomenpos"))['country'];
                                                            $unwomencountry_display = mysqli_fetch_assoc(mysqli_query($link, "SELECT display_country FROM `unwomen` LIMIT 1 OFFSET $unwomenpos"))['display_country'];
                                                            if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `unwomen` WHERE country = '$unwomencountry'"))['userid'] == 0) {
                                                                echo '<option value='.$unwomencountry.'>'.$unwomencountry_display.'</option>';
                                                            } else {
                                                                echo '<option value='.$unwomencountry.' disabled>'.$unwomencountry_display.'</option>';
                                                            }
                                                        }


                                                        ?>
                                                    </optgroup>
                                                </select>
                                            </div>







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
