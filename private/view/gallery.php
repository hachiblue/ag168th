<?php
$this->import('/layout/headProperty');
?>

<style>
    .bgGallery{
        background-image: url(<?php echo \Main\Helper\URL::absolute("/public/images/bglist.jpg")?>);
    }

    .labelGallery{
        margin-left: 100px;
    }

    .labelText{
        font-size: 14px;
        margin-left: 100px;
        font-family: 'thaisans', 'Arial', sans-serif;
        color: #1957a4;
    }

    hr{
        border: 1px solid #1957a4;
        width: 100%;
        margin-top: 20px;
        float: left;
        margin-bottom: 0px;
    }

    .divTop, .divCenter{
        margin-top: 20px;

    }

    .divCenter{
        text-align: center;
    }

    .divImg{
        width: 250px;
    }

</style>
<div class="bgGallery">
    <div class="container">
        <div class="labelText divTop"><a href="<?php echo \Main\Helper\URL::absolute("/condo")?>">List</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo \Main\Helper\URL::absolute("/map")?>">Map</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo \Main\Helper\URL::absolute("/gallery")?>">Gallery</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo \Main\Helper\URL::absolute("/table")?>">Table</a></div>
        <div class="labelText"><hr></div>
        <div class="labelGallery">
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
        </div>

        <div class="labelGallery">
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
        </div>

        <div class="labelGallery">
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
            <div class="col-md-3 divCenter divImg"><a href="#"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/picgal.jpg")?>"></a></div>
        </div>
    </div>
    <br><br>
</div>
<?php
$this->import('/layout/footer');
?>
