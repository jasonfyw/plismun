<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="../img/plismun19_a_favicon.png">

        <title>PLISMUN 2020</title>

        <!-- Bootstrap Core CSS -->

        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="../css/animate.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet">

        <!-- bootstrap select -->
        <link href="../css/bootstrap-select.min.css" rel="stylesheet">

        <link href="../css/checkboxes.css" rel="stylesheet">

        <!-- recycling css from signup page because the layout is basically the same and I can't be bothered to make a new file just for this-->
        <link href="../css/pages/delegateapplications.css" rel="stylesheet">
        <link href="../color/default.css" rel="stylesheet">

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
        require_once('../config.php');
        ?>

        <!-- Preloader -->
        <div id="preloader">
            <div id="load"><img class="wow fadeInDown" src="../img/plismun19_a_notext.png"></div>
        </div>





        <?php
        if(isset($_SESSION['id']) && $_SESSION['position'] == 'admin')
        {
            ?>
            <div class="container" style="margin-top: 30px;">
                <div class="text-center">
                    <h1>View Delegations</h1>
                    <a href="index">Go back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <hr class="marginbot-50">
                </div>
            </div>


            <div class="container">
                <?php

                for ($x = 0; $x < mysqli_num_rows(mysqli_query($link, "SELECT * FROM delegations")); $x++) {
                    $delegation_name = mysqli_fetch_assoc(mysqli_query($link, "SELECT name FROM delegations LIMIT 1 OFFSET $x"))['name'];



                    ?>
                    <div class="row well well-md">
                        <div class="col-sm-12">
                            <h3 class="inline"><i><?php echo $delegation_name; ?> &nbsp;&nbsp;&nbsp;  </i></h3>
                            <a class="inline" data-toggle="collapse" data-target="<?php echo '#'.$x; ?>" aria-expanded="false"><b>Click to view</b></a>
                            <div class="collapse" id="<?php echo $x; ?>">
                                <div class="card card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><b>No. Delegates: </b> <?php echo mysqli_fetch_assoc(mysqli_query($link, "SELECT delegates FROM delegations LIMIT 1 OFFSET $x"))['delegates']; ?></p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><b>Est. No. Delegates: </b> <?php echo mysqli_fetch_assoc(mysqli_query($link, "SELECT est_delegates FROM delegations LIMIT 1 OFFSET $x"))['est_delegates']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Position</th>
                                                <th scope="col">UserID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">School</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Dietary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $delegationleaderid = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid FROM delegations LIMIT 1 OFFSET $x"))['userid'];
                                            $delegationleader_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email, phone, schoolname, gender, dietary FROM users WHERE id = $delegationleaderid"));

                                            ?>
                                            <tr>
                                                <th scope="row">Delegation Leader</th>
                                                <td><?php echo $delegationleaderid; ?></td>
                                                <td><?php echo $delegationleader_info['firstname'].' '.$delegationleader_info['lastname']; ?></td>
                                                <td><?php echo $delegationleader_info['email']; ?></td>
                                                <td><?php echo $delegationleader_info['phone']; ?></td>
                                                <td><?php echo $delegationleader_info['schoolname']; ?></td>
                                                <td><?php echo $delegationleader_info['gender']; ?></td>
                                                <td><?php echo $delegationleader_info['dietary']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">DelegateID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Committee</th>
                                                <th scope="col">Country</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">School</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Dietary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            for ($y = 0; $y < mysqli_fetch_assoc(mysqli_query($link, "SELECT delegates FROM delegations LIMIT 1 OFFSET $x"))['delegates']; $y++) {

                                                $delegate_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid, committee, country FROM delegates WHERE delegation = '$delegation_name' LIMIT 1 OFFSET $y"));
                                                $delegate_userid = $delegate_info['userid'];
                                                $delegate_committee = $delegate_info['committee'];
                                                $delegate_country = $delegate_info['country'];

                                                $delegate_userinfo = mysqli_fetch_assoc(mysqli_query($link, "SELECT email, firstname, lastname, phone, schoolname, gender, dietary FROM users WHERE id = $delegate_userid"));
                                                $delegate_email = $delegate_userinfo['email'];
                                                $delegate_name = $delegate_userinfo['firstname']. ' ' .$delegate_userinfo['lastname'];
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $delegate_userid; ?></th>
                                                    <td><?php echo $delegate_userinfo['firstname'].' '.$delegate_userinfo['lastname']; ?></td>
                                                    <?php
                                                    if ($delegate_info['committee'] == 'REJECTED' && $delegate_info['country'] == 'REJECTED') {
                                                        ?>
                                                        <td class="text-red"><i class="fas fa-times"></i> Rejected</td>
                                                        <?php
                                                    } elseif ($delegate_info['committee'] == '' && $delegate_info['country'] == '') {
                                                        ?>
                                                        <td class="text-yellow"><i class="fas fa-clock"></i> Pending</td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td class="text-green"><i class="fas fa-check"></i> Accepted</td>
                                                        <?php
                                                    }
                                                    ?>
                                                    <td><?php echo $delegate_committee; ?></td>
                                                    <td><?php echo $delegate_country; ?></td>
                                                    <td><?php echo $delegate_userinfo['email']; ?></td>
                                                    <td><?php echo $delegate_userinfo['phone']; ?></td>
                                                    <td><?php echo $delegate_userinfo['schoolname']; ?></td>
                                                    <td><?php echo $delegate_userinfo['gender']; ?></td>
                                                    <td><?php echo $delegate_userinfo['dietary']; ?></td>
                                                </tr>
                                                <?php

                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>




        <?php } else { ?>
            <h1 style="text-align: center; margin-top: 10%;">You do not have the valid credentials to view this page. </h1>
        <?php } ?>











        <!-- Core JavaScript Files -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.scrollTo.js"></script>
        <!--reveal while scrolling script-->
        <script src="../js/wow.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="../js/custom.js"></script>
        <!-- parallax script -->
        <script src="../js/parallax.min.js"></script>
        <!-- bootstrap select js -->
        <script src="../js/bootstrap-select.min.js"></script>

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



    </body>

</html>
