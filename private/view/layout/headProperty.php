<?php
use Main\Helper;
$db = \Main\DB\Medoo\MedooFactory::getInstance();
$zones = $db->select("zone", "*");
$zonegroups = $db->select("zone_group", "*");
foreach($zonegroups as &$zonegroup) {
  $zonegroup["zones"] = array_filter($zones, function($zone) use($zonegroup) {
    return $zonegroup["id"] == $zone["zone_group_id"];
  });
}

$projects = $db->select("project", ["id", "name"]);

$btss = $db->select("bts", "*");
$mrts = $db->select("mrt", "*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1600px">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
        <?php
        echo \Main\AppConfig::get("application.title");
        ?>
    </title>

    <!-- Bootstrap -->
    <link href="<?php echo Helper\URL::absolute("/public/css/bootstrap.min.css")?>" rel="stylesheet">
    <link href="<?php echo Helper\URL::absolute("/public/css/style.css")?>" rel="stylesheet">
	<link href="<?php echo Helper\URL::absolute("/public/css/chosen.css")?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/jquery.min.js")?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/bootstrap.min.js")?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/skrollr.js")?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/jquery.nicescroll.min.js")?>"></script>
	<script src="<?php echo \Main\Helper\URL::absolute("/public/js/chosen.jquery.min.js")?>"></script>
</head>



<style type="text/css">
	
.chosen-container {
	margin-left: -64px;
}

.chosen-container .chosen-single {
	background: #fff;
	color:#333;
}

.chosen-container .chosen-drop {
	background: #fff;
}

.chosen-container .chosen-drop li {
	color: #333;
    font-size: 12px;
}

.chosen-container .chosen-drop input {
	color: #333;
    font-size: 12px;
}

</style>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37675183-4', 'auto');
  ga('send', 'pageview');

</script>
<div class="contact-bar">
    <div class="container">
        <ul>
            <li>
                <span class="glyphicon glyphicon-earphone" id="icon" aria-hidden="true"></span>
                087-7605555
            </li>
            <li style="margin-right: 130px">
                <span class="glyphicon glyphicon-envelope" id="icon" aria-hidden="true"></span>
                info@agent168th.com
            </li>
            <!-- <li style="margin-right: 0px"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login" style="padding: 0px">LOGIN</button></li>
            <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register" style="padding: 0px">REGISTER</button></li> -->
            <li><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Facebook.png")?>" /> </li>
            <li><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Twitter.png")?>" /></li>
            <li><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Google+.png")?>" /></li>
            <li><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Rss.png")?>" /></li>
            <li><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Pinterest.png")?>" /></li>
        </ul>
    </div>
</div>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a href="<?php echo \Main\Helper\URL::absolute("/home")?>"><img src="<?php echo \Main\Helper\URL::absolute("/public/images/Logo.png")?>" /></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown" id="buy">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BUY</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=1&property_type_id=1")?>">CONDOMINIUM</a></li>
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=1&property_type_id=2")?>">SINGLE DETACHED HOUSE</a></li>
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=1&property_type_id=10")?>">TOWNHOME</a></li>
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=1&property_type_id=7")?>">HOME OFFICE</a></li>
                    </ul>
                </li>
                <li class="dropdown" id="rent">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RENT</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=2&property_type_id=1")?>">CONDOMINIUM</a></li>
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=2&property_type_id=2")?>">SINGLE DETACHED HOUSE</a></li>
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=2&property_type_id=10")?>">TOWNHOME</a></li>
                        <li><a href="<?php echo \Main\Helper\URL::absolute("/list?requirement_id=2&property_type_id=7")?>">HOME OFFICE</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo \Main\Helper\URL::absolute("/list")?>">PROPERTY SEARCH</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute("/listprops")?>">LIST YOUR PROPERTY</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute("/campaign")?>">EDITORIAL</a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute("/contact")?>">CONTACT US</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="maillogin">
                    <form class="form-horizontal">
                        <div class="form-group" id="id">
                            <label class="control-label col-lg-3" for="">E-Mail :</label>
                            <div class="col-lg-7">
                                <input type="text" class="form-control">
                            </div>

                        </div>
                    </form>
                </div>
                <div class="passlogin">
                    <form class="form-horizontal">
                        <div class="form-group" id="id">
                            <label class="control-label col-lg-3" for="">Password :</label>
                            <div class="col-lg-7">
                                <input type="password" class="form-control">
                            </div>

                        </div>
                    </form>
                </div>
                <img src="<?php echo \Main\Helper\URL::absolute("/public/images/ZW4QC.png")?>" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="regis">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">คำนำหน้าชื่อ : </label>
                            <div class="col-lg-4">
                                <select class="form-control">
                                    <option>นาย / Mr.</option>
                                    <option>นาง / Mrs.</option>
                                    <option>นางสาว / Miss</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">ชื่อ / Name : </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">นามสกุล / Lastname : </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">เบอร์โทรศัพท์ / Tel. : </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">อีเมล / E-Mail : </label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">รหัสผ่าน / Password : </label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">Confirm Password : </label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-lg-4" for="">รหัสยืนยัน / Code :</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox">รับข่าวสาร และโปรโมชั่นต่างๆ จาก Website</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

    .all-head{
        background-color: #1957a4;
        height: 258px;
        margin-top: 30px;
    }
    .head{

    }

    .head-a1{
        background-color: #1957a4;
        border-top-left-radius: 10px;
        padding-right: 0px;

    }

    .head-a1 ul li{
        color: #FFFFFF;
        list-style-type: none;
        font-size: 16px;
        text-align: right;
        font-family: 'thaisans', 'Arial', sans-serif;
        margin-top: -2px;

    }

    .head-a2{
        background-color: #1957a4;
        border-top-right-radius: 10px;
        padding-left: 0px;
    }

    .head-a2 ul li{
        color: #FFFFFF;
        list-style-type: none;
        font-size: 16px;
        display: inline;
        font-family: 'thaisans', 'Arial', sans-serif;

    }

    .head-aa{
        background-color: #1957a4;
        margin-top: 5px;

    }
    .head-aa ul li{
        color: #FFFFFF;
        list-style-type: none;
        font-size: 16px;
        display: inline;
        font-family: 'thaisans', 'Arial', sans-serif;

    }
    .head-ab{
        background-color: #1957a4;
        margin-top: 3px;
    }
    .head-ab ul li{
        color: #FFFFFF;
        list-style-type: none;
        font-size: 16px;
        display: inline;
        float: right;
        font-family: 'thaisans', 'Arial', sans-serif;
        margin-top: -10px;

    }
    .head-ac{
        background-color: #1957a4;

    }
    .head-ac ul li{
        color: #FFFFFF;
        list-style-type: none;
        font-size: 16px;
        display: inline;
        font-family: 'thaisans', 'Arial', sans-serif;


    }

    .head-ad{
        background-color: #1957a4;
    }
    .head-ad ul li{
        color: #FFFFFF;
        list-style-type: none;
        font-size: 16px;
        display: inline;
        font-family: 'thaisans', 'Arial', sans-serif;
    }
</style>

<div class="all-head" >
    <div class="container" style="margin-top: -40px">
        <div class="head row" style="margin-top: 50px">
            <div class="head-a1 col-lg-3" style="margin-top: -40px">
                <br>
                <ul>
                    <li>Advance Search</li><br>
                    <li style="margin-top: 1px">Property Type</li><br>
                    <li style="margin-top: 1px">Bedroom(s)</li><br>
                    <li style="margin-top: 1px">Near BTS</li> <br>
                    <li style="margin-top: 1px">Project Name</li><br>
                </ul>

            </div>
            <div class="head-a2 col-lg-9"style="margin-top: -40px">
                <br>
                <form>
                <ul>
                    <span class="glyphicon glyphicon-play" aria-hidden="true" style="color: #FFFFFF;height: 18px"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li>  Requirement</li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <li>
                        <label class="radio-inline" style="margin-top: -5px"><input type="radio" name="requirement_id" value="1" <?php if(@$_GET['requirement_id']==1) echo "checked";?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Buy</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline" style="margin-top: -5px"><input type="radio" name="requirement_id" value="2" <?php if(@$_GET['requirement_id']==2) echo "checked";?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rent</label><br><br>
                        <div class="head-aa col-lg-3">
                                <div class="form-group" style="margin-top: -15px">
                                    <ul>
                                        <li>
                                          <select name="property_type_id" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <option value="1" <?php if(@$_GET['property_type_id']==1) echo "selected";?>>Condominium</option>
                                            <option value="2" <?php if(@$_GET['property_type_id']==2) echo "selected";?>>Single detached house</option>
                                            <option value="10" <?php if(@$_GET['property_type_id']==10) echo "selected";?>>Townhome</option>
                                            <option value="7" <?php if(@$_GET['property_type_id']==7) echo "selected";?>>Home office</option>
                                          </select>
                                        </li><br><br>
                                        <li>
                                          <select name="bedrooms" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <option value="1" <?php if(@$_GET['bedrooms']==1) echo "selected";?>>1</option>
                                            <option value="2" <?php if(@$_GET['bedrooms']==2) echo "selected";?>>2</option>
                                            <option value="3" <?php if(@$_GET['bedrooms']==3) echo "selected";?>>3</option>
                                            <option value="4+" <?php if(@$_GET['bedrooms']=="4+") echo "selected";?>>4+</option>
                                          </select>
                                        </li><br><br>
                                        <li>
                                          <select name="bts_id" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <?php foreach($btss as $bts) {?>
                                              <option value="<?php echo $bts["id"];?>" <?php if(@$_GET['bts_id']==$bts["id"]) echo "selected";?>><?php echo $bts["name"];?></option>
                                            <?php }?>
                                          </select>
                                        </li><br><br>
                                        <li>
                                          <!-- <input name="keyword" type="text" class="form-control" style="font-size: 12px; width: 200px;  float: right"> -->
                                          <select name="project_id" id="project_id" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <?php foreach($projects as $project){?>
                                            <option value="<?php echo $project["id"];?>" <?php if(@$_GET['project_id']==$project["id"]) echo "selected";?>><?php echo $project["name"];?></option>
                                            <?php }?>
                                          </select>
                                        </li>
                                        <br>
                                    </ul>
                                </div>
                        </div>
                        <div class="head-ab col-lg-3">
                            <ul>
                                <li>Locations</li> <br><br>
                                <li>Bathroom(s)</li> <br><br>
                                <li>Near MRT</li> <br><br>
                                <li>Price Range</li> <br><br>
                            </ul>
                        </div>
                        <div class="head-ac col-lg-3" style="margin-top: -13px">
                                <div class="form-group">
                                    <ul>
                                        <li>
                                          <select name="zone_id" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <?php foreach($zonegroups as $zonegroup) {?>
                                              <optgroup label="<?php echo $zonegroup["name"];?>">
                                              <?php foreach($zonegroup["zones"] as $zone) {?>
                                                <option value="<?php echo $zone["id"];?>" <?php if(@$_GET['zone_id']==$zone["id"]) echo "selected";?>><?php echo $zone["name"];?></option>
                                              <?php }?>
                                              </optgroup>
                                            <?php }?>
                                          </select>
                                        </li><br><br>
                                        <li>
                                          <select name="bathrooms" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <option value="1" <?php if(@$_GET['bathrooms']==1) echo "selected";?>>1</option>
                                            <option value="2" <?php if(@$_GET['bathrooms']==2) echo "selected";?>>2</option>
                                            <option value="3" <?php if(@$_GET['bathrooms']==3) echo "selected";?>>3</option>
                                            <option value="4+" <?php if(@$_GET['bathrooms']=="4+") echo "selected";?>>4+</option>
                                          </select>
                                        </li><br><br>
                                        <li>
                                          <select name="mrt_id" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>
                                            <?php foreach($mrts as $mrt) {?>
                                              <option value="<?php echo $mrt["id"];?>" <?php if(@$_GET['mrt_id']==$mrt["id"]) echo "selected";?>><?php echo $mrt["name"];?></option>
                                            <?php }?>
                                          </select>
                                        </li><br><br>
                                        <li>
                                          <select name="price-range" id="price-range" class="form-control" style="padding-top: 3px; width: 200px;  float: right">
                                            <option value="">-Please Select-</option>

                                          </select>
                                        </li><br><br>
                                    </ul>
                                </div>
                        </div>
                        <div class="head-ad col-lg-1">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default" style="background-color: #FFFFFF; color: #1957a4; border-radius: 10px;margin-left: 60px;margin-top: 40px; height: 35px">Search</button>
                            </div>
                        </div>
                    </li>
                </ul>
              </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){

	$("#project_id").chosen({disable_search_threshold: 10});


  var buyPrice = [
    [1000000,3000000],
    [3000001,5000000],
    [5000001,7000000],
    [7000001,10000000],
    [10000001,15000000],
    [15000001,30000000],
    [30000001]
  ];
  var rentPrice = [
    [10000,30000],
    [30001,50000],
    [50001,70000],
    [70001,100000],
    [100001]
  ];

  function refreshPriceRage()
  {
    var reqTypeId = $("input[name='requirement_id']:checked").val();
    $('#price-range option.price-js').remove();
    var items = reqTypeId == 1? buyPrice: rentPrice;

    $(items).each(function(key, item){
      var value = item[0];
      var text = item[0].toString().replace(/./g, function(c, i, a) {
          return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
      });
      if(item[1]){
        value += '-' + item[1];
        text += '-' + item[1].toString().replace(/./g, function(c, i, a) {
            return i && c !== "." && ((a.length - i) % 3 === 0) ? ',' + c : c;
        });
      }
      else {
        text += '+';
      }
      $('#price-range').append('<option class="price-js" value="'+value+'">'+text+'</option>');
    });
  }
  refreshPriceRage();
  $("input[name='requirement_id']").change(function(e){
    refreshPriceRage();
  });
});
</script>
