<?php

if(mail("papangping@gmail.com",
    "contact from agent168th backend" ,
    "Name: xxxx
    ========================
    Email: xxxx@xxx.com
    ========================
    Message: mxxxx
    ========================
    Telephone: txxxxx
    ========================
    ยูทีเอฟแปด นะครับ",
    "From: system@agent168th.com")){
  echo "send mail success.";
}
else {
  echo "Can't send mail.";
}
exit();
