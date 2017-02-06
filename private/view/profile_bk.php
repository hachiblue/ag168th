<?php
$this->import('/layout/header');
?>

    <style>
        .divRight{
            float: right;
        }

        .labelText{
            margin-left: 50px;
            font-family: 'thk2d', 'Arial', sans-serif;
            color: #1957a4;
            font-size: 24px;
        }

        .text1{
            font-size: 36px;
            margin-top: 50px;
        }

        .text2{
            font-size: 24px;
            padding-right: 100px;
            display: inline-block;
        }
        hr{
            border: 1px solid #1957a4;
            width: 100%;
            margin-top: 20px;
            float: left;
            margin-bottom: 0;
        }

        .divTop{
            margin-top: 20px;
        }

        .divImg{
            width: 300px;
            margin-top: 50px;
            margin-left: 100px;
        }
        .divCenter{
            text-align: center;
        }

        .formRight{
            display: inline-block;
            float: right;
        }
        .line{
            background-image: url(<?php echo \Main\Helper\URL::absolute("/public/images/linetable.jpg")?>);
            margin-top: 20px;
            width: 91%;
            margin-left: 100px;
        }

    </style>

    <div class="container">
        <div class="divRight divTop"><a href="<?php echo \Main\Helper\URL::absolute("/editprofile")?>" class="btn btn-primary">Edit Profile</a></div>
        <div class="col-md-12 line"></div>
        <div class="col-md-6">
            <div class="divCenter"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/mugshot.png")?>" class="divImg"></div>
        </div>
        <div class="col-md-6">
            <div class="labelText text1">K.Gasemsit</div>
            <div class="labelText">
                <div class="text2">Birthday :</div>
                <div class="formRight text2">1983/07/22</div>
            </div>
            <div class="labelText">
                <div class="text2">Gender :</div>
                <div class="formRight text2">M</div>
            </div>
            <div class="labelText">
                <div class="text2">Interested In :</div>
                <div class="formRight text2">Not Specified</div>
            </div>
            <div class="labelText">
                <div class="text2">Identifies As :</div>
                <div class="formRight text2">Not Specified</div>
            </div>
            <div class="labelText text2">Has been a member since 2/8/2015</div>
            <div class="labelText text2">Activities :</div>
            <div class="labelText">Interested :</div>
        </div>
    </div>
    <br><br>
<?php
$this->import('/layout/footer');
?>