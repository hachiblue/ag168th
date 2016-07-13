<?php
$this->import('/layout/headProperty');
?>
    <style>

        .labelText, .labelText2{
            font-family: 'thaisans', 'Arial', sans-serif;
            color: #1957a4;
        }
        .labelText{
            font-size: 14px;
            margin-left: 100px;
        }

        .divTop{
            margin-top: 20px;
        }

        hr{
            border: 1px solid #1957a4;
            width: 100%;
            margin-top: 20px;
            float: left;
            margin-bottom: 0px;
        }


        #googleMap {
            position: absolute;
            margin-top: 50px;
            margin-left: 100px;
            width:1050px;
            height:400px;
            border: 3px solid #bbbbbb;
        }
    </style>
    <div class="container">
        <div class="labelText divTop"><a href="<?php echo \Main\Helper\URL::absolute("/office")?>">List</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo \Main\Helper\URL::absolute("/map_o")?>">Map</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo \Main\Helper\URL::absolute("/gallery_o")?>">Gallery</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="<?php echo \Main\Helper\URL::absolute("/table_o")?>">Table</a></div>
        <div class="labelText"><hr></div>
        <div id="googleMap" ></div>
    </div>



    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

    <script>
        function initialize() {
            var mapProp = {
                center:new google.maps.LatLng(51.508742,-0.120850),
                zoom:5,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
$this->import('/layout/footer');
?>