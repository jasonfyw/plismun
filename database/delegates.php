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
        <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link href="../css/animate.css" rel="stylesheet" />

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
                    <h1>View All Delegates</h1>
                    <a href="index">Go back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <hr class="marginbot-50">
                </div>
            </div>

            <div class="container row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">UserID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Delegation</th>
                                <th scope="col">School</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Dietary</th>
                                <th scope="col">Committee</th>
                                <th scope="col">Country</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $accepted_delegates = 0;

                            for ($y = 0; $y < mysqli_num_rows(mysqli_query($link, "SELECT * FROM delegates")); $y++) {
                                $delegate_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT userid, delegation, committee, country FROM delegates LIMIT 1 OFFSET $y"));
                                $userid = $delegate_info['userid'];

                                $user_info = mysqli_fetch_assoc(mysqli_query($link, "SELECT firstname, lastname, email, phone, schoolname, gender, dietary FROM users WHERE id = $userid"));

                                ?>
                                <tr>
                                    <th scope="row"><?php echo $userid; ?></th>
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
                                        $accepted_delegates += 1;
                                        ?>
                                        <td class="text-green"><i class="fas fa-check"></i> Accepted</td>
                                        <?php
                                    }
                                    ?>
                                    <td><?php echo $user_info['firstname'].' '.$user_info['lastname']; ?></td>
                                    <td><?php echo $user_info['email']; ?></td>
                                    <td><?php echo $user_info['phone']; ?></td>
                                    <td><?php echo $delegate_info['delegation']; ?></td>
                                    <td><?php echo $user_info['schoolname']; ?></td>
                                    <td><?php echo $user_info['gender']; ?></td>
                                    <td><?php echo $user_info['dietary']; ?></td>
                                    <td><?php echo $delegate_info['committee']; ?></td>
                                    <td><?php echo $delegate_info['country']; ?></td>
                                </tr>
                                <?php

                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="container">
                <div class="alert alert-primary" role="alert">
                    <h1>We have <?php echo $accepted_delegates; ?> accepted delegates</h1></h1>
                </div>
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
