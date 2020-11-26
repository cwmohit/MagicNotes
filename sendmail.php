<?php
 
 $to_email="mohitkandhari1211krh@gmail.com";
 $subject="Simple email Test via PHP";
 $body="Hi, This is test email send by php script in 2020 from youtube";
 $header="From: cwmohit@gmail.com";

 if(mail($to_email,$subject,$body,$header)){
     echo "Email successfully sent to $to_email";
 }else{
     echo "Email sending failed....";
 }



?>