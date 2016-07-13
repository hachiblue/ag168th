<?php
use Main\Helper;
?>


<style>

    .glyphicon.glyphicon-phone{
        font-size: 20px;
        color: #1957a4;
    }

    .tel{
        color: #1957a4;
        display: inline-block;
        font-size: 24px;
        font-family: 'thaisans', 'Arial', sans-serif;
    }

    .in.glyphicon.glyphicon-envelope {

        font-size: 20px;
        color: #1957a4;
        margin-top: 50px;
    }

    .glyphicon.glyphicon-home{
        font-size: 20px;
        margin-left: -10px;
        color: #1957a4;
    }


    .envelope{
        color: #1957a4;
        font-family: 'thaisans', 'Arial', sans-serif;
        font-size: 24px;
        display: inline-block;

    }


    .labelLogin{
        color: #1957a4;
        font-size: 24px;
        font-family: 'thaisans', 'Arial', sans-serif;
        float: left;
    }

    .infoLogin{
        color: #1957a4;
        font-family: 'thaisans', 'Arial', sans-serif;
        margin-top: 50px;
        float: left;
        margin-left: -55PX;
        margin-bottom: 15px;
    }

    .enterText{
        margin-top: 20px;
    }

    .divText{
        text-align: left;
    }

    .btLogin{
        display: inline-block;
        font-family: 'thaisans', 'Arial', sans-serif;
        font-size: 18px;
        width: 100px;
        margin-top: -55px;
    }

</style>
<div class="glyphicon glyphicon-phone"></div>
<div class="tel">087-7605555</div>
<hr style="margin-top: 0; border: 1px solid #1957a4; width: 100%;">
<div class="in glyphicon glyphicon-envelope"></div>
<div class="envelope">info@agent168.com</div>
<hr style="margin-top: 0; border: 1px solid #1957a4; width: 100%;">
<div class="labelLogin">Login</div>
<div class="infoLogin">Please fill in your information :</div>
<input type="text" class="form-control" placeholder="Email">
<input type="text" class="form-control enterText" placeholder="Password">
<br>
<div class="divText"><a href="#">forgot a new password ?</a></div>
<div class="divText"><a href="#">Creat a new account</a></div>
<div>
    <a href="#" class="btn btn-primary btLogin">Login</a>
</div>
