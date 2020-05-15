<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" type="image/x-icon" href="img/plismun19_a_favicon.png">

        <title>Committees – PLISMUN 2021</title>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/animate.css" rel="stylesheet" />
        <!-- css -->
        <link href="css/pages/committees.css" rel="stylesheet">
        <link href="color/default.css" rel="stylesheet">

        <style>
        /* table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            width: 100%
        }
        td {
            padding:10px
        } */
        </style>


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120398250-1"></script>
        <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());

              gtag('config', 'UA-120398250-1');
        </script>


    </head>

    <body id="page-top" data-spy="scroll" data-target=".navbar-custom" width="100%">
        <?php
        session_start();
        require_once('../config.php');
        ?>
        
        <!-- Preloader -->
        <div id="preloader-overlay"></div>

        <!-- navbar, inserted via js -->
        <div id="header"></div>

        <!-- Section: intro -->
        <section id="intro" class="intro parallax-window" data-parallax="scroll" data-image-src="img/school_img2.jpg">
            <div class="slogan">
                <h2>Committees</h2>
            </div>
        </section>
        <!-- /Section: intro -->



        <section id="committees" class="home-section text-center" width="100%" style="padding: 0;margin: 0;border: 0;">




<!--            DETAILS AND COUNTRY MATRIX SIDEMENU THING FOR EVERY COMMITTEE-->



            <div class="container home-section" style="padding: 0;margin: 0;border: 0;">

                
                
                <div id="legalinfo" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav('legal')">&times;</a>
                    <div class="overlay-content">
                        <h2>Legal Committee</h2>
                        <h4 data-toggle="tooltip" title="This committee is more suitable for MUNers with less experience and seeking an easier committee to participate in">Beginner Committee <i class="fas fa-info-circle"></i></h4>
                        <div class="col-lg-2 col-lg-offset-5">
                            <hr class="marginbot-50">
                        </div>
                        <br><br><br><br>

                        <h4>Topic:</h4>
                        <!-- <p><i>Coming soon</i></p> -->
                        <p>1. &nbsp;&nbsp;&nbsp; Defining the Legal Boundaries of International Cryptocurrency Usage</p>
                        <p>2. &nbsp;&nbsp;&nbsp; Establishing a Convention Limiting Experiment and Engineering of the Human Genome</p>

                        <br><br>

                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <h4>Chairs</h4>
                                <p>Sebastian Dulava</p>
                                <p>Jan Kotrc</p>
                            </div>
                        </div>

                        <br><br>

                        <h4>Country matrix:</h4>
                        <div class="col-lg-4 col-lg-offset-4">
                            <!-- <p><i>Coming soon</i></p> -->
                            <table class="table">
                                <tbody>

                                    <tr><td>Brazil, Federative Republic of</tr></td>
                                    <tr><td>Canada</tr></td>
                                    <tr><td>China, People’s Republic of</tr></td>
                                    <tr><td>French Republic</tr></td>
                                    <tr><td>Germany, Federal Republic of</tr></td>
                                    <tr><td>India, Republic of</tr></td>
                                    <tr><td>Italian Republic</tr></td>
                                    <tr><td>Japan</tr></td>
                                    <tr><td>Korea, Democratic People’s Republic of </tr></td>
                                    <tr><td>Korea, Republic of</td></tr>
                                    <tr><td>Nigeria, Federal Republic of</tr></td>
                                    <tr><td>Norway, Kingdom of</tr></td>
                                    <tr><td>Russian Federation</tr></td>
                                    <tr><td>South Africa, Republic of</tr></td>
                                    <tr><td>Spain, Kingdom of</tr></td>
                                    <tr><td>Sweden, Kingdom of</tr></td>
                                    <tr><td>United Arab Emirates</tr></td>
                                    <tr><td>United Kingdom of Great Britain and Northern Ireland</tr></td>
                                    <tr><td>United States of America</td></tr>
                                    <tr><td>Wakanda, Kingdom of</td></tr>
                                    <tr><td></td></tr>
                                </tbody>
                            </table>
                            <br><br><br><br>
                        </div>

                    </div>
                </div>



                <!--side bar-->
                <div class="col-md-3" id="leftCol">
                    <ul class="nav nav-stacked" id="sidebar">
                        <li class="nav-com"><a href="#icj">ICJ</a></li>
                        <!-- <li class="nav-com"><a href="#ecosoc">ECOSOC</a></li> -->
                        <li class="nav-com"><a href="#hrc">Human Rights Council</a></li>
                        <li class="nav-com"><a href="#sec">Security Council</a></li>
                        <li class="nav-com"><a href="#histsec">Historical Security Council</a></li>
                        <li class="nav-com"><a href="#women">UN Women</a></li>
                        <li class="nav-com"><a href="#legal">Legal Committee</a></li>
                        <!-- <li class="nav-section"><a href="#ga">General Assemblies</a></li> -->
                        <!-- <li class="nav-section"><a href="#special">Special Committees</a></li> -->
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-9" style="padding: 0;margin: 0;border: 0;">




                    <!-- <div class="heading-about" id="ga">
                        <div class="container">
                            <div class="row">


                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
                                            <h2>General Assemblies</h2>
                                            <i class="fa fa-2x fa-angle-down"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->



                    <div class="heading-about" id="icj">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
<!--                                            <div class="avatar"><img src="img/committees/unlogo.png" alt="" class="img-responsive"></div>-->
                                            <h3>International Court of Justice (ICJ)</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <!-- <p><i>Coming soon</i></p> -->
                                            <p>1. &nbsp;&nbsp;&nbsp; Reviewing the Definition of Terrorism through the Lens of the War in Donbass.</p>
                                            <p>2. &nbsp;&nbsp;&nbsp; Reviewing the Legitimacy of Nation States Established After WW1</p>
                                            <p>3. &nbsp;&nbsp;&nbsp; Exploring American War Crimes Throughout The Vietnam War</p>

                                            <!-- <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/GA1_Study_Guide_Topic_1.pdf">Download (Topic 1) </a></li>
                                                    <li class="dropdown-item"><a href="studyguides/GA1_Study_Guide_Topic_2.pdf">Download (Topic 2) </a></li>
                                                </ul>
                                            </div> -->
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('icj');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="heading-about" id="ecosoc">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">

                                            <h3>UN Economic and Social Council (ECOSOC)</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <p>1. &nbsp;&nbsp;&nbsp; Combating racial discrimination of Haitians in the Dominican Republic</p>
                                            <p>2. &nbsp;&nbsp;&nbsp; Addressing the rising effects of international migration on urbanisation.</p>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/GA3_Study_Guide_Topic_1.pdf">Download (Topic 1) </a></li>
                                                    <li class="dropdown-item"><a href="studyguides/GA3_Study_Guide_Topic_2.pdf">Download (Topic 2) </a></li>
                                                </ul>
                                            </div>
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('ecosoc');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <div class="heading-about" id="hrc">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">

                                            <h3>Human Rights Council (HRC)</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <!-- <p><i>Coming soon</i></p> -->
                                            <p>1. &nbsp;&nbsp;&nbsp; Combating Global Modern Slavery</p>
                                            <p>2. &nbsp;&nbsp;&nbsp; Establishing Laws Regarding Extrajudicial Killings</p>
                                            <!--<div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/GA6_Study_Guide_Topic_1.pdf">Download (Topic 1) </a></li>
                                                    <li class="dropdown-item"><a href="studyguides/GA6_Study_Guide_Topic_2.pdf">Download (Topic 2) </a></li>
                                                </ul>
                                            </div> -->
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('hrc');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                    <!-- <div class="heading-about" id="special">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
                                            <h2>Special Committees</h2>
                                            <i class="fa fa-2x fa-angle-down"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <div class="heading-about" id="sec">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
<!--                                            <div class="avatar"><img src="img/committees/unesco.png" alt="" class="img-responsive">-->
                                            <h3>Security Council</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <!-- <p><i>Coming soon</i></p> -->
                                            <p>The Deteriorating Situation of Muslim Uighurs in the People’s Republic of China</p>
                                            <!--<div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/SC_Study_Guide.pdf">Download </a></li>
                                                </ul>
                                            </div> -->
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('sec');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="heading-about" id="histsec">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
                                            <h3>Historical Security Council</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <!-- <p><i>Coming soon</i></p> -->
                                           <p>Urging the end of the Genocide and Settling Peace in Rwanda, 1994</p>
                                           <!--
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/HSC_Study_Guide.pdf">Download</a></li>
                                                </ul>
                                            </div> -->
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('histsec');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="heading-about" id="women">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
<!--                                            <div class="avatar"><img src="img/committees/unlogo.png" alt="" class="img-responsive"></div>-->
                                            <h3>UN Women</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <!-- <p><i>Coming soon</i></p> -->
                                            <p>1. &nbsp;&nbsp;&nbsp; Combating Social Stigmata surrounding Women's Sexual Freedom and their implications on Adultery Laws</p>
                                            <p>2. &nbsp;&nbsp;&nbsp; Creating International Standards for Mothers in the Workforce</p>
                                            <!--<div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/ECOSOC_Study_Guide.pdf">Download </a></li>
                                                </ul>
                                            </div> -->
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('women');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="heading-about" id="legal">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-5">
                                    <hr class="marginbot-50">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="wow fadeInRight" data-wow-delay="0s">
                                        <div class="section-heading">
<!--                                            <div class="avatar"><img src="img/committees/unlogo.png" alt="" class="img-responsive"></div>-->
                                            <h3>Legal Committee</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">

                        <div class="row">
                            <div class="col-md-auto">
                                <div class="wow fadeInRight" data-wow-delay="0s">
                                    <div class="team boxed-grey">
                                        <div class="inner">
                                            <!-- <p><i>Coming soon</i></p> -->
                                            <p>1. &nbsp;&nbsp;&nbsp; Defining the Legal Boundaries of International Cryptocurrency Usage</p>
                                            <p>2. &nbsp;&nbsp;&nbsp; Establishing a Convention Limiting Experiment and Engineering of the Human Genome</p>
                                            <!--<div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Study Guides</button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li class="dropdown-item"><a href="studyguides/ECOSOC_Study_Guide.pdf">Download </a></li>
                                                </ul>
                                            </div> -->
                                            <button type="button" class="btn btn-default" href="#" onclick="openNav('legal');">View details and country matrix</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--small buffer between footer-->
                    <div class="container">
                        <div class="col-lg-2 col-lg-offset-5">
                            <hr class="marginbot-50">
                        </div>
                    </div>






                </div>
            </div>

        </section>







        <!-- footer-->
        <div id="footer"></div>
        <!-- /footer -->



        <!-- Core JavaScript Files -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollTo.js"></script>
        <script src="js/popper.min.js"></script>
        <!--reveal while scrolling script-->
        <script src="js/wow.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/committees.js"></script>
        <!-- parallax script -->
        <script src="js/parallax.min.js"></script>

        <script type="text/javascript">
            // include footer
            $(function() {
                $("#header").load("navbar");
                $("#footer").load("footer");
                $("#preloader-overlay").load("preloader");
            });

            function openNav(committee) {
//                document.getElementById(committee+"info").setAttribute('aria-hidden', false);
                document.getElementById(committee+"info").style.width = "100%";
                document.body.classList.toggle('noscroll', true);
                location.href = "#"+committee;
            }
            function closeNav(committee) {
//                document.getElementById(committee+"info").setAttribute('aria-hidden', true);
                document.getElementById(committee+"info").style.width = "0%";
                document.body.classList.toggle('noscroll', false);
                location.href = "#"+committee;
            }
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })


        </script>

    </body>

</html>
