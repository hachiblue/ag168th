<?php
use Main\Helper;
?>

<style>

    .glyphicon.glyphicon-home{
        font-size: 20px;
        color: #1957a4;
    }


    .labelHighlight{
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

    .divImg{
        width: 350px;
    }

    .infoHighlight{
        font-family: 'thaisans', 'Arial', sans-serif;
        font-size: 16px;
        color: #1957a4;
        margin-top: 10px;
    }

    .infoHighlight2{
        font-family: 'thaisans', 'Arial', sans-serif;
        font-size: 14px;
        color: #1957a4;
        margin-top: 10px;
    }

    .inputText{
        width: 200px;
        margin-top: -90px;
        position: relative;
        z-index: 1;
        float: right;
    }
    .inputText2{
        width: 200px;
        margin-top: -50px;
        position: relative;
        z-index: 1;
        float: right;
    }





</style>
<div class="glyphicon glyphicon-home"></div>
<div class="labelHighlight">Highlight Property</div>
<hr style="margin-top: 0; border: 1px solid #1957a4; width: 100%;">
<div >
    <img class="divImg" src="<?php echo \Main\Helper\URL::absolute("/public/images/highlight.gif")?>"  />
</div>
<div class="infoHighlight">แอสปาย สาทร ตากสิน (ทิมเบอร์ โซน)</div>
<div class="infoHighlight2">ทำเล : สาทร, กรุงเทพมหานคร ขนาด: 26 ตร.ม.<br>
    1 ห้องนอน 1 ห้องน้ำ sell : 1,880,000 บาท
</div>
<div class="in glyphicon glyphicon-envelope"></div>
<div class="labelHighlight">Newsletter sign up</div>
<hr style="margin-top: 0; border: 1px solid #1957a4; width: 100%;">
<div >
    <img class="divImg" src="<?php echo \Main\Helper\URL::absolute("/public/images/mail.gif")?>"  />
</div>
<div class="inputText"><input type="text" class="form-control" placeholder="Email"></div>
<div class="inputText2"><a href="#" class="btn btn-primary">Submit</a></div>