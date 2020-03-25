<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>PLISMUN 2020</title>

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
        require_once('config.php');


        if (isset($_POST['submit'])) {
            $verdict = $_POST['verdictradio'];
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
                    $updatedelegate = mysqli_query($link, "UPDATE `delegates` SET committee = '$committee', country = '$country'");

                    if ($updatedelegate) {
                        $verdictresult = '<div class="alert alert-success">Verdict delivered successfully</div>';
                    }
                }

            } elseif ($verdict == 'rejected') {
                $updatedelegate = mysqli_query($link, "UPDATE `delegates` SET committee = 'REJECTED', country = 'REJECTED'");

                if ($updatedelegate) {
                    $verdictresult = '<div class="alert alert-success">Verdict delivered successfully</div>';
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

                                <div class="col-sm-12">
                                    <form class="form-horizontal" method="post" action="delegateapplications">
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
                                    </form>
                                </div>

                                <div class="col-sm-6">


                                    <label class="control-label col-sm-4" for="1"><i>Only if application is approved: </i></label>
                                    <div class="col-md-8">
                                        <select class="selectpicker" id="<?php echo $userid.'committee'; ?>" name="committee" title="Select a committee">
                                            <optgroup label="General Assemblies">
                                                <option value="ga1">GA1</option>
                                                <option value="ga3">GA3</option>
                                                <option value="ga6">GA6</option>
                                            </optgroup>
                                            <optgroup label="Special Committees">
                                                <option value="sec">Security Council</option>
                                                <option value="historicalsec">Historical Security Council</option>
                                                <option value="ecosoc">ECOSOC</option>
                                            </optgroup>
                                        </select>


                                    </div>
                                    <label class="control-label col-sm-4"></label>

                                    <!--  -->
                                    <div class="col-md-8">
                                        <div id="<?php echo $userid.'ga1countries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                            <select class="selectpicker" name="ga1countries" title="Select a country" data-live-search="true">
                                                <optgroup label="GA1 Countries">
                                                    <?php
                                                    for ($ga1 = 1; $ga1 <= 16; $ga1++) {
                                                        $ga1pos = $ga1 - 1;
                                                        $ga1country = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `ga1` LIMIT 1 OFFSET $ga1pos"))['country'];
                                                        if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `ga1` WHERE country = '$ga1country'"))['userid'] == 0) {
                                                            echo '<option value='.$ga1country.'>'.$ga1country .'</option>';
                                                        } else {
                                                            echo '<option value='.$ga1country.' disabled>'.$ga1country.'</option>';
                                                        }
                                                    }


                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>


                                        <div id="<?php echo $userid.'ga3countries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                            <select class="selectpicker" name="ga3countries" title="Select a country" data-live-search="true">
                                                <optgroup label="GA3 Countries">
                                                    <?php
                                                    for ($ga3 = 1; $ga3 <= 16; $ga3++) {
                                                        $ga3pos = $ga3 - 1;
                                                        $ga3country = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `ga3` LIMIT 1 OFFSET $ga3pos"))['country'];
                                                        if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `ga3` WHERE country = '$ga3country'"))['userid'] == 0) {
                                                            echo '<option value='.$ga3country.'>'.$ga3country .'</option>';
                                                        } else {
                                                            echo '<option value='.$ga3country.' disabled>'.$ga3country.'</option>';
                                                        }
                                                    }


                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>



                                        <div id="<?php echo $userid.'ga6countries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                            <select class="selectpicker" name="ga6countries" title="Select a country" data-live-search="true">
                                                <optgroup label="GA6 Countries">
                                                    <?php
                                                    for ($ga6 = 1; $ga6 <= 16; $ga6++) {
                                                        $ga6pos = $ga6 - 1;
                                                        $ga6country = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `ga6` LIMIT 1 OFFSET $ga6pos"))['country'];
                                                        if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `ga6` WHERE country = '$ga6country'"))['userid'] == 0) {
                                                            echo '<option value='.$ga6country.'>'.$ga6country .'</option>';
                                                        } else {
                                                            echo '<option value='.$ga6country.' disabled>'.$ga6country.'</option>';
                                                        }
                                                    }


                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>



                                        <div id="<?php echo $userid.'seccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                            <select class="selectpicker" name="seccountries>" title="Select a country" data-live-search="true">
                                                <optgroup label="SC Countries">
                                                    <?php
                                                    for ($sec = 1; $sec <= 14; $sec++) {
                                                        $secpos = $sec - 1;
                                                        $seccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `sec` LIMIT 1 OFFSET $secpos"))['country'];
                                                        if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `sec` WHERE country = '$seccountry'"))['userid'] == 0) {
                                                            echo '<option value='.$seccountry.'>'.$seccountry .'</option>';
                                                        } else {
                                                            echo '<option value='.$seccountry.' disabled>'.$seccountry.'</option>';
                                                        }
                                                    }


                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>






                                        <div id="<?php echo $userid.'historicalseccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                            <select class="selectpicker" name="historicalseccountries" title="Select a country" data-live-search="true">
                                                <optgroup label="HSC Countries">
                                                    <?php
                                                    for ($historicalsec = 1; $historicalsec <= 11; $historicalsec++) {
                                                        $historicalsecpos = $historicalsec - 1;
                                                        $historicalseccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `historicalsec` LIMIT 1 OFFSET $historicalsecpos"))['country'];
                                                        if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `historicalsec` WHERE country = '$historicalseccountry'"))['userid'] == 0) {
                                                            echo '<option value='.$historicalseccountry.'>'.$historicalseccountry .'</option>';
                                                        } else {
                                                            echo '<option value='.$historicalseccountry.' disabled>'.$historicalseccountry.'</option>';
                                                        }
                                                    }


                                                    ?>
                                                </optgroup>
                                            </select>
                                        </div>

                                        <div id="<?php echo $userid.'ecosoccountries'; ?>" class="<?php echo $userid.'countries'; ?>" style="display: none">
                                            <select class="selectpicker" name="ecosoccountries" title="Select a country" data-live-search="true">
                                                <optgroup label="ECOSOC Countries">
                                                    <?php
                                                    for ($ecosoc = 1; $ecosoc <= 20; $ecosoc++) {
                                                        $ecosocpos = $ecosoc - 1;
                                                        $ecosoccountry = mysqli_fetch_assoc(mysqli_query($link, "SELECT country FROM `ecosoc` LIMIT 1 OFFSET $ecosocpos"))['country'];
                                                        if (mysqli_fetch_assoc(mysqli_query($link, "SELECT `userid` FROM `ecosoc` WHERE country = '$ecosoccountry'"))['userid'] == 0) {
                                                            echo '<option value='.$ecosoccountry.'>'.$ecosoccountry .'</option>';
                                                        } else {
                                                            echo '<option value='.$ecosoccountry.' disabled>'.$ecosoccountry.'</option>';
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


                                <div class="col-sm-4 container">
                                    <input id="<?php echo $userid . 'submit'; ?>" name="submit" type="submit" class="btn btn-success btn-send col-md-3" value="Submit">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
            ?>


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
