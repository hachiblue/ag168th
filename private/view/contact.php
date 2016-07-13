<?php
$this->import('/layout/header');
?>


<style>
    .allcontact{

    }
    .contact{
    }

    .block-a{
        background-color: #FFFFFF;
        padding: 10px;
        border: 5px solid #1957a4;
        width: 750px;
        margin-top: 25px;
    }

    .block-a ul li{
        color: #000000;
        list-style-type: none;
        font-size: 16px;
        font-family: 'thaisans', 'Arial', sans-serif;
    }

    .block-b{
        background-color: #FFFFFF;
        padding: 20px;
        border: 5px solid #1957a4;
        margin-top: 25px;
    }


    .block-b ul li{
        color: #000000;
        list-style-type: none;
        font-size: 16px;
        font-family: 'thaisans', 'Arial', sans-serif;
        float: right;
    }




    .hl{
        position: relative;
        top: -121px;
    }

    .hl-a{
        background-color: #1957a4;
        width: 320px;
    }

    .hl-b{
        background-color: #1957a4;
        width: 340px;
        margin-left: 90px;
    }

    .hl-a ul li{
        list-style-type: none;
        font-size: 12px;
        margin-left: -40px;
    }

    .hl-b ul li{
        list-style-type: none;
        font-size: 12px;
        margin-left: -40px;
    }

    .mainLeft {
        position: relative;
    }
    #googleMap {
        position: absolute;
        top: 20px;
        right: 20px;
        width:360px;
        height:290px;
        border: 3px solid #bbbbbb;
    }
    .textareaClass {
        resize: none;
        width: 190px;
    }


    .labelText {
        display: inline-block;
        width: 100px;
        text-align: right;
        vertical-align: top;
    }
    .labelText2 {
        display: inline-block;
        text-align: left;
        width: 314px;
    }
    .formRight{
        display: inline-block;
    }

    .formleft{
        display: inline-block;
    }

    .formClass {
        padding-top: 10px;
        font-size: 18px;
    }

    .h6{
        color: #000000;
        font-family: 'thk2d', 'Arial', sans-serif;
        font-size: 18px;
    }

    pre{
        border: none;
        background-color: #1957a4;
        padding: 0;
        color: #ffffff;
        float: left;
        margin-left: -40px;
        font-size: 12px;
        margin-top: 10px;
    }

    .formWidth{
        width: 188px;
    }

    .formCenter{
        text-align: center;
    }

    .spanAll{
        background-color: #1957a4;
        font-size: 18px;
        font-family: 'thk2d', 'Arial', sans-serif;
        height: 40px;
        position: absolute;
        z-index: 0;
        border-top-left-radius:8px;
        border-top-right-radius:8px;
    }

    .span1{
        margin-left: 820px;
    }

    .span2{
        margin-left: 200px;
    }

    .span3{
        margin-top: 400px;
        margin-left: 70px;
    }
    .span4{
        margin-top: 400px;
        margin-left: 490px;
    }
    .textHead {
        color: #1957a4;
        font-family: 'thk2d', 'Arial', sans-serif;
        font-size: 18px;
    }

</style>

<div class="allcontact">
    <div class="container">
        <br><br>
        <span class="label label-default spanAll span1" >ติดต่อ agent168</span>
        <span class="label label-default spanAll span2" >รายละเอียดการติดต่อ</span>
        <span class="label label-default spanAll span3" >Highlight Property</span>
        <span class="label label-default spanAll span4" >Newsletter Sign Up</span>
       <div class="contact row">
            <div class="block-a col-lg-8 mainLeft">
                <div class="h6">
                    <div class="labelText2">
                        <span class="textHead"> ที่อยู่ : </span>บริษัท เอเจ้นท์168 จำกัด”<br>
                        เลขประจำตัวผู้เสียภาษีอากร 0105558054793<br>
                        ห้อง A6,B ชั้น 25 อาคารธนภูมิ 1550 ถนนเพชรบุรีตัดใหม่ แขวงมักกะสัน เขตราชเทวี กรุงเทพฯ 10400
                    </div>
                </div>
                <br>
                <div class="h6">
                    <div class="labelText2">
                        <span class="textHead">โทร :</span>  087-7605555 
                    </div>
                </div>

                <div class="h6">
                    <div class="labelText2">
                        <span class="textHead">แฟกซ์ :</span> 02-652-7982
                    </div>
                </div>
                <br>
                <div class="h6">
                    <div class="labelText2">
                        <span class="textHead">อีเมล :</span> info@agent168th.com
                    </div>
                </div>

                <div class="h6">
                    <div class="labelText2">
                        <span class="textHead">เว็บไซต์ :</span> http://www.agent168th.com/
                    </div>
                </div>

                <div class="h6">
                    <div class="labelText2">
                        <span class="textHead">เฟซบุ๊ค :</span> http://www.facebook.com/agent168th
                    </div>
                    <div class="formleft">

                    </div>
                </div>


                    <div id="googleMap" ></div>
            </div>


            <div class="block-b col-lg-4" style="margin-left: 20px" >
                    <div class="formClass">
                        <div class="labelText">
                            เรื่อง :
                        </div>
                        <div class="formRight">
                            <select class="form-control">
                                <option value="buy">ซื้อ</option>
                                <option value="sale">ขาย</option>
                                <option value="rent">เช่่า</option>
                                <option value="audi"></option>
                            </select>
                        </div>
                    </div>
                <div class="formClass ">
                    <div class="labelText">
                        ข้อความ :
                    </div>
                    <div class="formRight">
                        <textarea rows="3" cols="50" class="textareaClass form-control">
                        </textarea>
                    </div>
                </div>
                <div class="formClass">
                    <div class="labelText">
                        ชื่อ :
                    </div>
                    <div class="formRight   formWidth ">
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="formClass ">
                    <div class="labelText" class="form-control">
                        นามสกุล :
                    </div>
                    <div class="formRight formWidth">
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="formClass">
                    <div class="labelText">
                        มือถือ :
                    </div>
                    <div class="formRight formWidth">
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="formClass">
                    <div class="labelText">
                        โทรศัพท์ :
                    </div>
                    <div class="formRight formWidth">
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="formClass">
                    <div class="labelText">
                        อีเมล :
                    </div>
                    <div class="formRight formWidth">
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="formClass">
                    <div class="labelText">
                        รหัสยืนยัน :
                    </div>
                    <div class="formRight formWidth">
                        <input type="text" class="form-control">
                    </div>
                </div>

                <div class="formClass">
                    <div class="formCenter">กรุณากรอกตัวอักษรที่เห็นด้านล่างลงในช่องว่าง</div>
                </div>

                <div style="    text-align: center">
                    <a href="#" class="btn btn-primary">ส่งข้อความ</a>
                </div>

            </div>
        </div>


        <div class="hl row">
            <div class="hl-a col-lg-4">
                <ul>
                    <img src="<?php echo \Main\Helper\URL::absolute("/public/images/highlight.gif")?>" style="margin-left: -40px;height: 200px;width: 290px;margin-top: 15px;">
<pre>แอสปาย สาทร ตากสิน (ทิมเบอร์ โซน)
ทำเล : สาทร, กรุงเทพมหานคร ขนาด: 26 ตร.ม.
1 ห้องนอน 1 ห้องน้ำ sell : 1,880,000 บาท</pre>
                </ul>
            </div>
            <div class="hl-b col-lg-4">
                <ul>
                    <img src="<?php echo \Main\Helper\URL::absolute("/public/images/mail.gif")?>" style="margin-left: -40px;height: 260px;width: 310px;margin-top: 15px;">
                    <form>
                        <div class="form-group" style="padding-left: -20px">
                            <input type="text" class="form-control" placeholder="ใส่อีเมลของคุณ" style="font-size: 12px;height: 24px; width: 120px; margin-top: -100px; margin-left:70px;position: absolute; z-index: 1px">
                            <button type="submit" class="btn btn-default" style="background-color: #1957a4; border-radius: 15px;margin-left: 90px;margin-top: -65px;color: #FFFFFF; height: 30px;position: absolute;z-index: 1px">Submit</button>
                        </div>
                    </form>
                </ul>
            </div>
            <div class="highlight-b col-lg-4"></div>
        </div
    </div>
</div>
<br><br><br>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

<script>
    function initialize() {
        var mapProp = {
            center:new google.maps.LatLng(13.7494989,100.5568042),
            zoom:17,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php
$this->import('/layout/footer');
?>
