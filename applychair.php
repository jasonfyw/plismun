<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Chair Application – PLISMUN 2020</title>

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
        <link href="css/pages/applyposition.css" rel="stylesheet">
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
        require_once('config.php');

        if (isset($_POST["submit"])) {
            $email = $_SESSION['id'];
            // userid from `users`
            $userid = mysqli_fetch_assoc(mysqli_query($link, "SELECT id FROM `users` WHERE email='$email'"))["id"];
            // input variables
            $birthdate = $_POST['birthdate'];

            $nationality = $_POST['nationality'];
            $diet = $_POST['diet'];

            $phone = str_replace(' ', '', mysqli_real_escape_string($link, $_POST['phonenum']));
            $gender = $_POST['gender'];
            $school = mysqli_real_escape_string($link, $_POST['school']);

            // $position1 = $_POST['position1'];
            $committee1 = $_POST['committee1'];
            $suggestion1 = $_POST['suggestion1'];
            // $position2 = $_POST['position2'];
            $committee2 = $_POST['committee2'];
            $suggestion2 = $_POST['suggestion2'];
            // $position3 = $_POST['position3'];
            $committee3 = $_POST['committee3'];
            $suggestion3 = $_POST['suggestion3'];

            $experience = mysqli_real_escape_string($link, $_POST['experience']);
            $motivation = mysqli_real_escape_string($link, $_POST['motivation']);

            if (!$_POST['birthdate']) {
                $errBirthdate = 'Please enter your birthdate';
            }
            if (!$_POST['nationality']) {
                $errNationality = 'Please enter a valid nationality';
            }
            if (!$_POST['diet']) {
                $errDiet = 'Please confirm your dietary preference';
            }

            if(!$_POST['phonenum']){
                $errPhonenum = 'Please enter a phone number';
            }
            if(!$_POST['gender']) {
                $errGender = 'Please select a gender';
            }
            // school not necessary

            // if(!$_POST['position1']) {
            //     $errPosition1 = 'Please select a position';
            // }
            if(!$_POST['committee1']) {
                $errCommittee1 = 'Please select a committee';
            }
            if(!$_POST['suggestion1']) {
                $errSuggestion1 = 'Please enter a topic suggestion';
            }
            // if(!$_POST['position2']) {
            //     $errPosition2 = 'Please select a position';
            // }
            if(!$_POST['committee2']) {
                $errCommittee2 = 'Please select a committee';
            }
            if(!$_POST['suggestion2']) {
                $errSuggestion1 = 'Please enter a topic suggestion';
            }
            // if(!$_POST['position3']) {
            //     $errPosition3 = 'Please select a position';
            // }
            if(!$_POST['committee3']) {
                $errCommittee3 = 'Please select a committee';
            }



            if(!$_POST['experience']) {
                $errExperience = 'Please describe your experience';
            }
            if(!$_POST['motivation']) {
                $errMotivation = 'Please describe your motivation';
            }

            if(!$_POST['agreetos']) {
                $errAgreetos = 'Please read and agree to the Rules and Regulations';
            }

            // check if user is applying again
            $checkPosition = mysqli_fetch_assoc(mysqli_query($link, "SELECT position FROM `users` WHERE email='$email'"))["position"];
            if ($checkPosition != '' || $checkPosition == 'chair') {
                $applyResult = '<div class="alert alert-danger">You have already applied for a position. If you believe this is an error, kindly contact us.</div>';
                $errCheckPosition = 'You have already applied for a position. If you believe this is an error, kindly contact us.';
            }

            if(!$errBirthdate && !$errNationality && !$errDiet && !$errPhonenum && !$errGender && !$errCommittee1 && !$errCommittee2 && !$errSuggestion1 && !$errSuggestion2 && !$errCommittee3 && !$errExperience && !$errMotivation && !$errAgreetos && !$errCheckPosition) {

                //convert birthdate to compatible format
                $birthdate_insert = date('Y-m-d', strtotime(str_replace('/', '-', $birthdate)));

                // email
                // subject title
                $subject = 'PLISMUN20 Chair application from '.$_SESSION['firstname']. ' '.$_SESSION['lastname'];
                // html body
                $message =
                    "<h2>Chair application</h2>
                    <p><b>Name:</b> ".$_SESSION['firstname']. ' '.$_SESSION['lastname']."</p>
                    <p><b>Email:</b> ".$_SESSION['id']."</p>
                    <p><b>Birthdate: </b> $birthdate</p>
                    <p><b>Nationality: </b> $nationality</p>
                    <p><b>Phone: </b> $phone</p>
                    <p><b>Gender: </b> $gender</p>
                    <p><b>School (if applicable): </b> $school</p>
                    <p><b>Dietary prefs.: </b> $diet</p>
                    <br><br>
                    <p><b>Position choice 1: </b> $position1</p>
                    <p><b>Committee choice 1: </b> $committee1</p>
                    <p><b>Suggestion for topic: </b> $suggestion1</p>
                    <br />
                    <p><b>Position choice 2: </b> $position2</p>
                    <p><b>Committee choice 2: </b> $committee2</p>
                    <p><b>Suggestion for topic: </b> $suggestion2</p>
                    <br />
                    <p><b>Position choice 3: </b> $position3</p>
                    <p><b>Committee choice 3: </b> $committee3</p>
                    <p><b>Suggestion for topic: </b> $suggestion3</p>
                    <br><br>
                    <p><b>MUN experience: </b> $experience</p>
                    <br>
                    <p><b>Motivation letter: </b> $motivation</p>";
                // set content-type header for sending html email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // additional headers
                $headers .= 'From: plismun-chair-applications' . "\r\n";



                // db queries to insert data
                $query1 = "UPDATE `users` SET phone = '$phone', birthdate = '$birthdate_insert', nationality = '$nationality', gender = '$gender', schoolname = '$school', position = 'chair', dietary = '$diet' WHERE email = '$email';";
                $result1 = mysqli_query($link, $query1);

                $query2 = "INSERT INTO `chairs` (userid, choice1position, choice1committee, choice2position, choice2committee, choice3position, choice3committee, experience, motivationletter) VALUES ('$userid', '$position1', '$committee1', '$position2', '$committee2', '$position3', '$committee3', '$experience', '$motivation')";
                $result2 = mysqli_query($link, $query2);

                if ($result1 && $result2) {
                    if (mail ('plismun.communication@gmail.com', $subject, $message, $headers)) {
                        if (mail ('plismun.official@gmail.com', $subject, $message, $headers)) {
                            $applyResult = '<div class="alert alert-success">Your chair application has been successfully submitted. You will receive an email in the following weeks with a response.</div>';


                        } else {
                            $applyResult = '<div class="alert alert-danger">There was an error while submitting your chair application. Please try again</div>';
                        }
                    } else {
                        $applyResult = '<div class="alert alert-danger">There was an error while submitting your chair application. Please try again</div>';
                    }
                } else {
                    $signupresult = '<div class="alert alert-danger">Sorry, an error occurred while sumbitting your application Please try again</div>';
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


        <?php
        if(isset($_SESSION['id']))
        {
            ?>
            <div class="apply parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
                <div class="containers">
                    <!-- <div class="alert alert-danger col-md-5 col-md-offset-5">NOTICE: chairing applications have been filled and no vacancies are currently available</div> -->
                    <!-- <div class="alert alert-info col-md-5 col-md-offset-5">PLISMUN20 Theme: <b>Implementing Legal Justice and Reducing Discrimination</b></div> -->


                </div>
                <div class="apply-window">
                    <div class="container">
                        <h2>Apply as a chair</h2>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <?php echo $applyResult ?>
                                <div class="alert alert-info">PLISMUN20 Theme: <b>Securing Justice</b></div>
                            </div>
                        </div>

                        <form id="applychair" class="form-horizontal" method="post" action="applychair">
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <?php echo $signupresult ?>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-md-4 col-md-offset-2">

                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="firstname">First name: </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $_SESSION['firstname']; ?>">
                                            <?php echo "<p class='text-danger'><b>$errFirstname</b></p>"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="lastname">Last name: </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $_SESSION['lastname']; ?>">
                                            <?php echo "<p class='text-danger'><b>$errLastname</b></p>"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="email">Email: </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $_SESSION['id']; ?>">
                                            <?php echo "<p class='text-danger'><b>$errEmail</b></p>"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="nationality">Nationality: </label>
                                        <div class="col-md-8">
                                            <select class="selectpicker" data-live-search="true" name="nationality" title="Select a nationality" selected="<?php echo $nationality; ?>">
                                                <option value="">-- select one --</option>
                                                <option value="afghan">Afghan</option>
                                                <option value="albanian">Albanian</option>
                                                <option value="algerian">Algerian</option>
                                                <option value="american">American</option>
                                                <option value="andorran">Andorran</option>
                                                <option value="angolan">Angolan</option>
                                                <option value="antiguans">Antiguans</option>
                                                <option value="argentinean">Argentinean</option>
                                                <option value="armenian">Armenian</option>
                                                <option value="australian">Australian</option>
                                                <option value="austrian">Austrian</option>
                                                <option value="azerbaijani">Azerbaijani</option>
                                                <option value="bahamian">Bahamian</option>
                                                <option value="bahraini">Bahraini</option>
                                                <option value="bangladeshi">Bangladeshi</option>
                                                <option value="barbadian">Barbadian</option>
                                                <option value="barbudans">Barbudans</option>
                                                <option value="batswana">Batswana</option>
                                                <option value="belarusian">Belarusian</option>
                                                <option value="belgian">Belgian</option>
                                                <option value="belizean">Belizean</option>
                                                <option value="beninese">Beninese</option>
                                                <option value="bhutanese">Bhutanese</option>
                                                <option value="bolivian">Bolivian</option>
                                                <option value="bosnian">Bosnian</option>
                                                <option value="brazilian">Brazilian</option>
                                                <option value="british">British</option>
                                                <option value="bruneian">Bruneian</option>
                                                <option value="bulgarian">Bulgarian</option>
                                                <option value="burkinabe">Burkinabe</option>
                                                <option value="burmese">Burmese</option>
                                                <option value="burundian">Burundian</option>
                                                <option value="cambodian">Cambodian</option>
                                                <option value="cameroonian">Cameroonian</option>
                                                <option value="canadian">Canadian</option>
                                                <option value="cape verdean">Cape Verdean</option>
                                                <option value="central african">Central African</option>
                                                <option value="chadian">Chadian</option>
                                                <option value="chilean">Chilean</option>
                                                <option value="chinese">Chinese</option>
                                                <option value="colombian">Colombian</option>
                                                <option value="comoran">Comoran</option>
                                                <option value="congolese">Congolese</option>
                                                <option value="costa rican">Costa Rican</option>
                                                <option value="croatian">Croatian</option>
                                                <option value="cuban">Cuban</option>
                                                <option value="cypriot">Cypriot</option>
                                                <option value="czech">Czech</option>
                                                <option value="danish">Danish</option>
                                                <option value="djibouti">Djibouti</option>
                                                <option value="dominican">Dominican</option>
                                                <option value="dutch">Dutch</option>
                                                <option value="east timorese">East Timorese</option>
                                                <option value="ecuadorean">Ecuadorean</option>
                                                <option value="egyptian">Egyptian</option>
                                                <option value="emirian">Emirian</option>
                                                <option value="equatorial guinean">Equatorial Guinean</option>
                                                <option value="eritrean">Eritrean</option>
                                                <option value="estonian">Estonian</option>
                                                <option value="ethiopian">Ethiopian</option>
                                                <option value="fijian">Fijian</option>
                                                <option value="filipino">Filipino</option>
                                                <option value="finnish">Finnish</option>
                                                <option value="french">French</option>
                                                <option value="gabonese">Gabonese</option>
                                                <option value="gambian">Gambian</option>
                                                <option value="georgian">Georgian</option>
                                                <option value="german">German</option>
                                                <option value="ghanaian">Ghanaian</option>
                                                <option value="greek">Greek</option>
                                                <option value="grenadian">Grenadian</option>
                                                <option value="guatemalan">Guatemalan</option>
                                                <option value="guinea-bissauan">Guinea-Bissauan</option>
                                                <option value="guinean">Guinean</option>
                                                <option value="guyanese">Guyanese</option>
                                                <option value="haitian">Haitian</option>
                                                <option value="herzegovinian">Herzegovinian</option>
                                                <option value="honduran">Honduran</option>
                                                <option value="hungarian">Hungarian</option>
                                                <option value="icelander">Icelander</option>
                                                <option value="indian">Indian</option>
                                                <option value="indonesian">Indonesian</option>
                                                <option value="iranian">Iranian</option>
                                                <option value="iraqi">Iraqi</option>
                                                <option value="irish">Irish</option>
                                                <option value="israeli">Israeli</option>
                                                <option value="italian">Italian</option>
                                                <option value="ivorian">Ivorian</option>
                                                <option value="jamaican">Jamaican</option>
                                                <option value="japanese">Japanese</option>
                                                <option value="jordanian">Jordanian</option>
                                                <option value="kazakhstani">Kazakhstani</option>
                                                <option value="kenyan">Kenyan</option>
                                                <option value="kittian and nevisian">Kittian and Nevisian</option>
                                                <option value="kuwaiti">Kuwaiti</option>
                                                <option value="kyrgyz">Kyrgyz</option>
                                                <option value="laotian">Laotian</option>
                                                <option value="latvian">Latvian</option>
                                                <option value="lebanese">Lebanese</option>
                                                <option value="liberian">Liberian</option>
                                                <option value="libyan">Libyan</option>
                                                <option value="liechtensteiner">Liechtensteiner</option>
                                                <option value="lithuanian">Lithuanian</option>
                                                <option value="luxembourger">Luxembourger</option>
                                                <option value="macedonian">Macedonian</option>
                                                <option value="malagasy">Malagasy</option>
                                                <option value="malawian">Malawian</option>
                                                <option value="malaysian">Malaysian</option>
                                                <option value="maldivan">Maldivan</option>
                                                <option value="malian">Malian</option>
                                                <option value="maltese">Maltese</option>
                                                <option value="marshallese">Marshallese</option>
                                                <option value="mauritanian">Mauritanian</option>
                                                <option value="mauritian">Mauritian</option>
                                                <option value="mexican">Mexican</option>
                                                <option value="micronesian">Micronesian</option>
                                                <option value="moldovan">Moldovan</option>
                                                <option value="monacan">Monacan</option>
                                                <option value="mongolian">Mongolian</option>
                                                <option value="moroccan">Moroccan</option>
                                                <option value="mosotho">Mosotho</option>
                                                <option value="motswana">Motswana</option>
                                                <option value="mozambican">Mozambican</option>
                                                <option value="namibian">Namibian</option>
                                                <option value="nauruan">Nauruan</option>
                                                <option value="nepalese">Nepalese</option>
                                                <option value="new zealander">New Zealander</option>
                                                <option value="ni-vanuatu">Ni-Vanuatu</option>
                                                <option value="nicaraguan">Nicaraguan</option>
                                                <option value="nigerien">Nigerien</option>
                                                <option value="north korean">North Korean</option>
                                                <option value="northern irish">Northern Irish</option>
                                                <option value="norwegian">Norwegian</option>
                                                <option value="omani">Omani</option>
                                                <option value="pakistani">Pakistani</option>
                                                <option value="palauan">Palauan</option>
                                                <option value="palestinian">Palestinian</option>
                                                <option value="panamanian">Panamanian</option>
                                                <option value="papua new guinean">Papua New Guinean</option>
                                                <option value="paraguayan">Paraguayan</option>
                                                <option value="peruvian">Peruvian</option>
                                                <option value="polish">Polish</option>
                                                <option value="portuguese">Portuguese</option>
                                                <option value="qatari">Qatari</option>
                                                <option value="romanian">Romanian</option>
                                                <option value="russian">Russian</option>
                                                <option value="rwandan">Rwandan</option>
                                                <option value="saint lucian">Saint Lucian</option>
                                                <option value="salvadoran">Salvadoran</option>
                                                <option value="samoan">Samoan</option>
                                                <option value="san marinese">San Marinese</option>
                                                <option value="sao tomean">Sao Tomean</option>
                                                <option value="saudi">Saudi</option>
                                                <option value="scottish">Scottish</option>
                                                <option value="senegalese">Senegalese</option>
                                                <option value="serbian">Serbian</option>
                                                <option value="seychellois">Seychellois</option>
                                                <option value="sierra leonean">Sierra Leonean</option>
                                                <option value="singaporean">Singaporean</option>
                                                <option value="slovakian">Slovakian</option>
                                                <option value="slovenian">Slovenian</option>
                                                <option value="solomon islander">Solomon Islander</option>
                                                <option value="somali">Somali</option>
                                                <option value="south african">South African</option>
                                                <option value="south korean">South Korean</option>
                                                <option value="spanish">Spanish</option>
                                                <option value="sri lankan">Sri Lankan</option>
                                                <option value="sudanese">Sudanese</option>
                                                <option value="surinamer">Surinamer</option>
                                                <option value="swazi">Swazi</option>
                                                <option value="swedish">Swedish</option>
                                                <option value="swiss">Swiss</option>
                                                <option value="syrian">Syrian</option>
                                                <option value="taiwanese">Taiwanese</option>
                                                <option value="tajik">Tajik</option>
                                                <option value="tanzanian">Tanzanian</option>
                                                <option value="thai">Thai</option>
                                                <option value="togolese">Togolese</option>
                                                <option value="tongan">Tongan</option>
                                                <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                                <option value="tunisian">Tunisian</option>
                                                <option value="turkish">Turkish</option>
                                                <option value="tuvaluan">Tuvaluan</option>
                                                <option value="ugandan">Ugandan</option>
                                                <option value="ukrainian">Ukrainian</option>
                                                <option value="uruguayan">Uruguayan</option>
                                                <option value="uzbekistani">Uzbekistani</option>
                                                <option value="venezuelan">Venezuelan</option>
                                                <option value="vietnamese">Vietnamese</option>
                                                <option value="welsh">Welsh</option>
                                                <option value="yemenite">Yemenite</option>
                                                <option value="zambian">Zambian</option>
                                                <option value="zimbabwean">Zimbabwean</option>
                                            </select>
                                            <?php echo "<p class='text-danger'><b>$errNationality</b></p>"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="diet">Dietary requirements: </label>
                                        <div class="col-md-8">
                                            <select class="selectpicker" name="diet" title="Select one" value="<?php echo $diet; ?>">
                                                <option value="none" <?php if ($_POST['diet'] == "none") echo 'selected'; ?>>None</option>
                                                <option value="vegetarian" <?php if ($_POST['diet'] == "vegetarian") echo 'selected'; ?>>Vegetarian</option>
                                                <option value="vegan" <?php if ($_POST['diet'] == "vegan") echo 'selected'; ?>>Vegan</option>
                                            </select>
                                            <?php echo "<p class='text-danger'><b>$errDiet</b></p>"; ?>
                                        </div>
                                    </div>

                                </div>





                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="firstname">Birth date: </label>
                                        <div class="col-md-8">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" name="birthdate" value="<?php echo $birthdate; ?>">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                            <?php echo "<p class='text-danger'><b>$errBirthdate</b></p>"; ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="phonenum">Phone number: </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="phonenum" name="phonenum" placeholder="Phone Number" value="<?php echo $phone; ?>">
                                            <?php echo "<p class='text-danger'><b>$errPhonenum</b></p>"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="gender">Gender: </label>
                                        <div class="col-md-8">
                                            <select class="selectpicker" name="gender" title="Select a gender" value="<?php echo $gender; ?>">
                                                <option value="male" <?php if ($_POST['gender'] == "male") echo 'selected'; ?>>Male</option>
                                                <option value="female"  <?php if ($_POST['gender'] == "female") echo 'selected'; ?>>Female</option>
                                            </select>
                                            <?php echo "<p class='text-danger'><b>$errGender</b></p>"; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="school">School: </label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="school" name="school" placeholder="School Name" value="<?php echo $school; ?>">
                                            <?php echo "<p class='text-danger'><b>$errSchool</b></p>"; ?>
                                        </div>
                                    </div>


                                </div>


                            </div>


                            <div class="col-lg-2 col-lg-offset-5">
                                <hr class="marginbot-50">
                            </div>

                            <br><br><br><br>


                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="committee1">Committee choice 1: </label>
                                        <div class="col-md-8">
                                            <select class="selectpicker" name="committee1" title="Select a committee">
                                                <option value="icj" <?php if ($_POST['committee1'] == "icj") echo 'selected'; ?> disabled>ICJ</option>
                                                <option value="ecosoc" <?php if ($_POST['committee1'] == "ecosoc") echo 'selected'; ?> disabled >ECOSOC</option>
                                                <option value="sec" <?php if ($_POST['committee1'] == "sec") echo 'selected'; ?> >Security Council</option>
                                                <option value="historicalsec" <?php if ($_POST['committee1'] == "historicalsec") echo 'selected'; ?> >Historical Security Council</option>
                                                <option value="unwomen" <?php if ($_POST['committee1'] == "unwomen") echo 'selected'; ?> disabled >UN Women</option>
                                                <option value="hrc" <?php if ($_POST['committee1'] == "hrc") echo 'selected'; ?> disabled>Human Rights Council</option>
                                                <option value="legal" <?php if ($_POST['committee1'] == "legal") echo 'selected'; ?> disabled>Legal Council</option>
                                            </select>
                                            <?php echo "<p class='text-danger'><b>$errCommittee1</b></p>"; ?>
                                        </div>
                                        <label class="control-label col-sm-4" for="suggestion1">Please enter a topic suggestion (required)</label>
                                        <div class="col-md-8">
                                            <textarea type="text" class="form-control" id="suggestion1" name="suggestion1" rows="2" placeholder="Required"><?php echo $suggestion1; ?></textarea>
                                            <?php echo "<p class='text-danger'>$errSuggestion1</p>";?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="committee2">Committee choice 2: </label>
                                        <div class="col-md-8">
                                            <select class="selectpicker" name="committee2" title="Select a committee">
                                                <option value="icj" <?php if ($_POST['committee2'] == "icj") echo 'selected'; ?> disabled>ICJ</option>
                                                <option value="ecosoc" <?php if ($_POST['committee2'] == "ecosoc") echo 'selected'; ?> disabled >ECOSOC</option>
                                                <option value="sec" <?php if ($_POST['committee2'] == "sec") echo 'selected'; ?> >Security Council</option>
                                                <option value="historicalsec" <?php if ($_POST['committee2'] == "historicalsec") echo 'selected'; ?> >Historical Security Council</option>
                                                <option value="unwomen" <?php if ($_POST['committee2'] == "unwomen") echo 'selected'; ?> disabled >UN Women</option>
                                                <option value="hrc" <?php if ($_POST['committee2'] == "hrc") echo 'selected'; ?> disabled >Human Rights Council</option>
                                                <option value="legal" <?php if ($_POST['committee2'] == "legal") echo 'selected'; ?> disabled>Legal Council</option>
                                            </select>
                                            <?php echo "<p class='text-danger'><b>$errCommittee2</b></p>"; ?>
                                        </div>
                                        <label class="control-label col-sm-4" for="suggestion2">Please enter a topic suggestion (required)</label>
                                        <div class="col-md-8">
                                            <textarea type="text" class="form-control" id="suggestion2" name="suggestion2" rows="2" placeholder="Required"><?php echo $suggestion2; ?></textarea>
                                            <?php echo "<p class='text-danger'>$errSuggestion2</p>";?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4" for="committee3">Committee choice 3: </label>
                                        <div class="col-md-8">
                                            <select class="selectpicker" name="committee3" title="Select a committee">
                                                <option value="icj" <?php if ($_POST['committee3'] == "icj") echo 'selected'; ?> disabled>ICJ</option>
                                                <option value="ecosoc" <?php if ($_POST['committee3'] == "ecosoc") echo 'selected'; ?> disabled >ECOSOC</option>
                                                <option value="sec" <?php if ($_POST['committee3'] == "sec") echo 'selected'; ?> >Security Council</option>
                                                <option value="historicalsec" <?php if ($_POST['committee3'] == "historicalsec") echo 'selected'; ?> >Historical Security Council</option>
                                                <option value="unwomen" <?php if ($_POST['committee3'] == "unwomen") echo 'selected'; ?> disabled>UN Women</option>
                                                <option value="hrc" <?php if ($_POST['committee3'] == "hrc") echo 'selected'; ?> disabled>Human Rights Council</option>
                                                <option value="legal" <?php if ($_POST['committee3'] == "legal") echo 'selected'; ?> disabled>Legal Council</option>
                                            </select>
                                            <?php echo "<p class='text-danger'><b>$errCommittee3</b></p>"; ?>
                                        </div>
                                        <label class="control-label col-sm-4" for="suggestion3">Please enter a topic suggestion (optional)</label>
                                        <div class="col-md-8">
                                            <textarea type="text" class="form-control" id="suggestion3" name="suggestion3" rows="2" placeholder="Optional"><?php echo $suggestion3; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-lg-offset-5">
                                <hr class="marginbot-50">
                            </div>

                            <br><br><br><br>


                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1 row">
                                    <label class="control-label col-sm-3" for="experience">Describe your experience with MUNs: (~100 words)</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" id="experience" name="experience" rows="5"><?php echo $experience; ?></textarea>
                                        <?php echo "<p class='text-danger'>$errExperience</p>";?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1 row">
                                    <label class="control-label col-sm-3" for="motivation">Why do you want to chair a committee at PLISMUN? (~100 words)</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" id="motivation" name="motivation" rows="5"><?php echo $motivation; ?></textarea>
                                        <?php echo "<p class='text-danger'>$errMotivation</p>";?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <div class="funkyradio">
                                        <div class="funkyradio-success">
                                            <input type="checkbox" name="agreetos" id="agreetos">
                                            <label for="agreetos">I have read and agree to the <a href="tos">Terms and Conditions</a></label>
                                            <?php echo "<p class='text-danger'>$errAgreetos</p>";?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input id="submit" name="submit" type="submit" class="btn btn-success btn-send col-md-3" value="Submit">
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
            <?php } else { ?>
                <h1 style="text-align: center; margin-top: 10%;">Please login or signup to access this page</h1>
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
