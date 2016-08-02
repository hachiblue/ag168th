<?php
$this->import('/layout/headProperty');
?>

<style>

body {
	background: #EEEEEE;
}

.item-property{
	padding:40px 0 0 0;
}

.item-list-type-room {
	position: relative;
  /* margin: 0 20px 20px 0; */
  /* border: 1px solid #1957a4; */
  /* width: 350px; */
  float: left;
  padding: 10px;
  background: white;

	color: #1957a4;
	-moz-box-shadow: 0 0 5px #888;
	-webkit-box-shadow: 0 0 5px#888;
	box-shadow: 0 0 5px #888;

  display: block;
  position: relative;
}

.img-item a img{
	width:100%;
	/*height:100%;*/
}

.item-name{
	padding: 10px 0 6px 0;
	font-size: 14px;
	color: #1957a4;
	display: inline-block;
	border-bottom: 1px solid #dddddd;
	font-weight: bold;
}

.item-code, .item-type, .item-room {
  border-bottom: 1px solid #dddddd;
	color: #555555;
  padding-top: 8px;
}

.button-detail{
	margin:15px 0;
}

.item-list ul{
	padding:0;
}

.text-red{
	color:red;
	margin:10px 0;
}

a.item-type-name:hover,
.item-name a:hover{
	text-decoration:none;
}

.item-price button{
	padding: 7px 30px;
}

.item-price span{
	float: left;
	margin-top: 0px;
	font-size: 12px;
	color: #555555;
	font-weight: bold;
}

.hr{
	margin:10px 0;
}

.item-list-type-room{
	color: #1957a4;
}

.page-next{
	text-align:center;
}

.item-list-type-room {
    overflow: hidden;
}

.map-contain {
	margin-top: 20px;
}

#googleMap {
	height:400px;
	border: 1px solid #bbbbbb;
}

.map-box {
	background-color: #1957a4;
}

html:not(.tablet) .q2-policy-compare {
	font-size: 1rem;
}

.q2-policy-compare {
    display: block;
    height: 40px;
    width: 40px;
    overflow: hidden;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    /* background:#fff url("images/q2-policy-sprites.png?v=1.0") no-repeat -2px -282px; */
    border: 2px solid #4990e2;
    font-size: 0;
    position: absolute;
    top: 24px;
    right: 24px;
}

.q2-policy-compare.active {
    border-color: #4a90e2;
    background-color: #4082e8;
    background-position: -2px -230px
}

.q2-policy-compare.text-style {
    height: 60px;
    width: 60px;
    background-image: none;
    font-weight: 400;
    text-align: center;
    color: #4082e8;
    font-size: 0;
    line-height: 1;
	z-index: 1;
}

.q2-policy-compare.text-style:before,.q2-policy-compare.text-style .inner-text {
    display: inline-block;
    vertical-align: middle;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1
}

.q2-policy-compare.text-style:before {
    content: '';
    height: 100%
}

.q2-policy-compare.text-style:hover {
	background-color: #1B59A5;
	content: '';
}

.q2-policy-compare.text-style:hover:after,.q2-policy-compare.text-style.active:after {
    content: 'เลือก';
    display: block;
	color:#fff;
	font-size:15px;
    height: 100%;
    width: 100%;
    position: absolute;
	top: 0px;
    padding: 20px 13px;
    left: 0;
}

.q2-policy-compare.text-style:hover:after {
    background-position: -54px -302px
}

.q2-policy-compare.text-style.active:after {
    background-color: #4082e8;
    background-position: -54px -230px
}



.pc.no-responsive .q2-policy-compare {
    top: 12px;
    right: 12px
}

.pc.no-responsive .q2-policy-compare:before {
    vertical-align: middle
}

.pc.no-responsive .q2-policy-compare span {
    display: inline-block;
    line-height: 1;
    vertical-align: middle
}

.q2-text {
	margin-top: 17px;
	float: left;
	margin-left: 4px;
}

.com-bx {
	min-height: 100px;
	padding:10px;
}

.com-content {
	min-height: 100px;
	border: 3px solid #999;
}

.com-content.active {
	background: #DCDCDC;
}

.navbar-fixed-bottom {
	background: #fff;
	-moz-box-shadow: 0 -2px 5px rgba(0,0,0,.5);
	-ms-box-shadow: 0 -2px 5px rgba(0,0,0,.5);
	-o-box-shadow: 0 -2px 5px rgba(0,0,0,.5);
	box-shadow: 0 -2px 5px rgba(0,0,0,.5);
}

.remove {
	position: absolute;
    right: 5px;
    background: red;
    color: #fff;
    top: 3px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    width: 21px;
    -o-border-radius: 50%;
    border-radius: 50%;
	text-align: center;
	z-index: 1;
}

.remove {
	cursor:pointer;
}

.remove:hover{
	text-decoration: none;
	color:#333;
}

.remove i {
	width: 100%;
    height: 100%;
}	

.item-com {
	padding: 2px 30px;
}

.item-com .item-com-name {
	color: #2a6496;
	font-weight: bold;
}

.emp-compare {
	text-align: center;
	margin-top: 32px;
	font-weight: bold;
}

.btn-wrap {
	position: absolute;
	width: 200px;
	margin: auto;
	height: 40px;
	background: #fff;
    -moz-box-shadow: 0 -2px 1px rgba(0,0,0,.5);
    -ms-box-shadow: 0 -2px 1px rgba(0,0,0,.5);
    -o-box-shadow: 0 -2px 1px rgba(0,0,0,.5);
    box-shadow: 0 -2px 1px rgba(0,0,0,.5);
	top: -40px;
	right: 44%;
	text-align: center;
}

.btn-wrap button {
	width: 83%;
    margin-top: 3px;
	color: #fff;
	font-weight: bold;
	font-size: 19px;
}

</style>

<div class="bgList">
    <div class="container">
		
		<div class="row">
			<div class="col-md-12 map-contain">
				<div id="googleMap" ></div>
			</div>
		</div>

    	<div class="item-property">
        <!-- <div class="labelText divTop">
          <a href="<?php echo \Main\Helper\URL::absolute("/condo")?>">List</a>
          &nbsp;&nbsp;/&nbsp;&nbsp;
          <a href="<?php echo \Main\Helper\URL::absolute("/map")?>">Map</a>
          &nbsp;&nbsp;/&nbsp;&nbsp;
          <a href="<?php echo \Main\Helper\URL::absolute("/gallery")?>">Gallery</a>
          &nbsp;&nbsp;/&nbsp;&nbsp;
          <a href="<?php echo \Main\Helper\URL::absolute("/table")?>">Table</a>
        </div> -->
        <!-- <div class="labelText"><hr></div> -->

        <?php foreach($params['items'] as $key=> $item){?>
				<?php if($key % 4 == 0){?><div class="row"><?php }?>
        <div class="col-md-3">

			<div class="hidden">
				<?php //print_r($item); ?>
			</div>

        	<div class="item-list">

				<a class="q2-policy-compare text-style" compare-id="<?=$key;?>" name="btn-compare" href="javascript:;" title="select to compare"><div class="q2-text">เลือก<br>เปรียบเทียบ</div></a>

            	<ul class="item-list-box">
                	<li class="item-list-type-room">
                        <div class="img-item">
							<?php
							switch( (int)$item["feature_unit_id"] )
							{
								case 1 : echo '<div class="ribbon-wrapper"><div class="ribbon r-green">Best Buy</div></div>'; break;
								case 2 : echo '<div class="ribbon-wrapper"><div class="ribbon r-orange">Hot Price</div></div>'; break;
								case 3 : echo '<div class="ribbon-wrapper"><div class="ribbon r-red">Discount</div></div>'; break;
								case 4 : echo '<div class="ribbon-wrapper"><div class="ribbon r-blue">New</div></div>'; break;
							}
							?>
							<a href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">
								<img src="<?php echo $item["picture"]["url"];?>" alt="condo" width="100%" height="246">
							</a>
						</div>
                        <div class="item-name clearfix">
							<a href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">
							<?php echo $item['property_type']['name'];?>
							<?php echo $item['requirement']['name'];?>
							<?php echo $item['project']['name'];?>
							<?php echo $item['road'];?>
							Bangkok </a>
						</div>
                        <div class="item-code clearfix">
							<span class="pull-left">รหัส</span>
							<span class="pull-right"><?php echo $item["reference_id"];?></span>
						</div>
                        <div class="item-type clearfix">
							<span class="pull-left">ประเภทอสังหาฯ</span>
							<span class="pull-right"><a href="" class="item-type-name"><?php echo $item["property_type"]["name_th"];?></a></span>
						</div>
                        <div class="item-room clearfix">
							<span class="pull-left">ห้องนอน</span>
							<span class="pull-right"><a href="" class="item-type-name"><?php echo $item["bedrooms"];?></a></span>
                        </div>
                        <div class="item-room clearfix">
							<span class="pull-left">ห้องน้ำ</span>
							<span class="pull-right"><a href="" class="item-type-name"><?php echo $item["bathrooms"];?></a></span>
                        </div>
                       <div class="item-price text-red">
							<a id="link_<?=$item["reference_id"];?>" href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">
								<button type="button" class="btn btn-primary pull-right">Detail</button>
							</a>
							<span id="price_<?=$item["reference_id"];?>">
								<?php echo empty($item["sell_price"])?"": "ขาย : ".number_format($item["sell_price"])." บาท";?><br>
								<?php echo empty($item["rent_price"])?"": "เช่า : ".number_format($item["rent_price"])." บาท";?>
							</span>
                        </div>
                	</li>
                </ul>

            </div>
         </div>
			 	<?php 
				if( $key % 4 == 3 || ($key+1) == count($params['items']) )
				{ ?>
					</div>
					<?php 
				} 
			}

				// paging
				$i = 1;
				$pag = ( isset($_GET["page"]) )? $_GET["page"] : 0;
				if($params["paging"]["pageLimit"] > 9) 
				{
					$i = $pag - 4;
					$i = $i>0? $i: 1;
					$i = $i<$params["paging"]["pageLimit"]-7? $i: $params["paging"]["pageLimit"]-7;
				}

				$stop = $i + 8;

				?>
        <div class="page-next">
            <nav>
              <ul class="pagination">
                <li>
                  <a href="<?php echo \Main\Helper\Url::absolute("/list?".http_build_query(array_merge($_GET, ["page"=> 1])))?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
								<?php for(; $i < $stop; $i++){?>
                <li <?php if($params["paging"]["page"]==$i){?>class="active"<?php }?>>
									<a href="<?php echo \Main\Helper\Url::absolute("/list?".http_build_query(array_merge($_GET, ["page"=> $i])))?>"><?php echo $i;?></a></li>
								<?php }?>
                <li>
                  <a href="<?php echo \Main\Helper\Url::absolute("/list?".http_build_query(array_merge($_GET, ["page"=> $params["paging"]["pageLimit"]])))?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
		</div>
    </div><br><br>
</div>

<div id="tmp_items" style="display:none;">
	<div class="item-list">
		<ul class="item-list-box">
			<li class="">
				<div class="item-name clearfix">
					<a href="#link#">#title#</a>
				</div>
				<div class="item-code clearfix">
					<span class="pull-left">รหัส</span>
					<span class="pull-right">#code#</span>
				</div>
				<div class="item-type clearfix">
					<span class="pull-left">ประเภทอสังหาฯ</span>
					<span class="pull-right"><a href="" class="item-type-name">#type#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ห้องนอน</span>
					<span class="pull-right"><a href="" class="item-type-name">#bed#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ห้องน้ำ</span>
					<span class="pull-right"><a href="" class="item-type-name">#bath#</span>
				</div>
			   <div class="item-price text-red">
					<a href="#link#">
						<button type="button" class="btn btn-primary pull-right">Detail</button>
					</a>
					<span>
						#price#
					</span>
				</div>
			</li>
		</ul>

	</div>
</div>


<div class="navbar-fixed-bottom" id="compare-panel" style="display:none;">

	<div class="btn-wrap">
		<div class="row">
			<button id="btn-go-compare" class="btn" data-toggle="modal" data-target=".model-compare" disabled>เปรียบเทียบเลย</button>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3 com-bx">
					<div id="com-b1" class="com-content b1"></div>
				</div>
				<div class="col-md-3 com-bx">
					<div id="com-b2" class="com-content b2"></div>
				</div>
				<div class="col-md-3 com-bx">
					<div id="com-b3" class="com-content b3"></div>
				</div>
				<div class="col-md-3 com-bx">
					<div id="com-b4" class="com-content b4"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="tmp_compare_sm_box" style="display:none;">
	<div name="rm-com-box" com-id="#id#" class="remove">
		<i class="glyphicon glyphicon-minus" aria-hidden="true"></i>
	</div>
	<div class="compare_sm_content">
		<div class="row">
			<div class="col-xs-12 item-com">
				<div class="item-com-name clearfix">
					#name#
				</div>
				<div class="item-com-price  text-red">
					#price#				
                </div>
			</div>
		</div>
	</div>
</div>

<div id="tmp_compare_md_box" style="display:none;">
	<div name="rm-com-box-md" com-id="#id#" class="remove">
		<i class="glyphicon glyphicon-minus" aria-hidden="true"></i>
	</div>
	<div class="item-list">
		<ul class="item-list-box">
			<li class="item-list-type-room">
				<div class="img-item">

					<a href="#link#">
						<img src="#pic#" alt="condo" width="100%" height="246" style="margin-left:0px;">
					</a>

				</div>

				<div class="item-name clearfix">
					<a href="#link#">#title#</a>
				</div>
				<div class="item-code clearfix">
					<span class="pull-left">รหัส</span>
					<span class="pull-right">#code#</span>
				</div>
				<div class="item-type clearfix">
					<span class="pull-left">ประเภทอสังหาฯ</span>
					<span class="pull-right"><a href="" class="item-type-name">#type#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ห้องนอน</span>
					<span class="pull-right"><a href="" class="item-type-name">#bed#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ห้องน้ำ</span>
					<span class="pull-right"><a href="" class="item-type-name">#bath#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ชั้น</span>
					<span class="pull-right"><a href="" class="item-type-name">#floor#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ขนาด</span>
					<span class="pull-right"><a href="" class="item-type-name">#size#</a></span>
				</div>
				<div class="item-room clearfix">
					<span class="pull-left">ราคา ต่อ #unit#</span>
					<span class="pull-right"><a href="" class="item-type-name">#priceunit#</a></span>
				</div>
				<div class="item-room clearfix">
					<div class="col-sm-12" style="padding:0;">Indoor amenities</div>
					<div class="pull-left"><a class="item-type-name">#indoor#</a></div>
				</div>
				<div class="item-room clearfix">
					<div class="col-sm-12" style="padding:0;">Outdoor amenities</div>
					<div class="pull-left"><a class="item-type-name">#outdoor#</a></div>
				</div>
			   <div class="item-price text-red">
					<a id="link_#code#" href="#link#">
						<button type="button" class="btn btn-primary pull-right">Detail</button>
					</a>
					<span id="price_#code#">#price#<br> </span>
				</div>
			</li>
		</ul>
	</div>
</div>



<div id="model-compare" class="modal fade model-compare" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" style="width: 88%;">
		<div class="modal-content" style="background: #eee;">
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> <h4 class="modal-title" id="myLargeModalLabel">ตารางเปรียบเทียบ</h4> 
			</div>
			
			<div class="modal-body" style="padding-top:0px;">
				<div class="row">        
					<div class="col-md-3 md-content" id="mc-1">
						
						
					</div>
					<div class="col-md-3 md-content" id="mc-2">
						
						
					</div>
					<div class="col-md-3 md-content" id="mc-3">
						
						
					</div>
					<div class="col-md-3 md-content" id="mc-4">
						
						
					</div>
				</div>
			</div>
        </div>	
	</div>
</div>



<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI"></script>

<?php

	$indoor = array(
		"has_bowling" => "Bowline",
		"has_pool_room" => "Pool Room",
		"has_game_room" => "Game Room",
		"has_meeting_room" => "Meeting Room",
		"has_private_butler" => "Private Butler",
		"has_minimart_supermarket" => "Minimart Supermarket",
		"has_restaurant" => "Restaurant",
		"has_laundry_service" => "Laundry Servic",
		"has_bathtub_inside_unit" => "Bathtub Inside Unit"
	);

	$outdoor = array(
		"has_swimming_pool" => "Swimming Pool",
		"has_gym" => "Gym",
		"has_garden" => "Garden",
		"has_futsal" => "Futsal",
		"has_badminton" => "Badminton",
		"has_basketball" => "Basketball",
		"has_tennis" => "Tennis",
		"has_playground" => "Playground",
		"has_shuttle_bus" => "Shuttle Bus",
		"has_private_parking" => "Private Parking"
	);

	$size_unit = array(
		"1" => "Sq. m.",
		"2" => "Sq. wa.",
		"3" => "Rai"
	);

?>

<script type="text/javascript">

	var indoor = <?=json_encode($indoor);?>;
	var outdoor = <?=json_encode($outdoor);?>;
	var size_unit = <?=json_encode($size_unit);?>;

	function initialize(proj) 
	{
		var locations = [
		  ['Bondi Beach', -33.890542, 151.274856, 4],
		  ['Coogee Beach', -33.923036, 151.259052, 5],
		  ['Cronulla Beach', -34.028249, 151.157507, 3],
		  ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
		  ['Maroubra Beach', -33.950198, 151.259302, 1]
		];

		var mapProp = {
			center:new google.maps.LatLng(13.756325, 100.501729),
			zoom:12,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
		
		geocoder = new google.maps.Geocoder();
		
		for( i in proj )
		{
			geocodeAddress(proj[i], i);
		}
	}

	function geocodeAddress(locations, i)
	{
		var title = locations.project.name;
		var address = locations.project.address;

		geocoder.geocode({
			'address': address
		}, 
		
		function(results, status) {
			
			if (status === google.maps.GeocoderStatus.OK) 
			{
				map.setCenter(results[0].geometry.location);

				marker = new google.maps.Marker({
					icon: 'http://maps.google.com/mapfiles/ms/icons/rangerstation.png',
					map: map,
					position: results[0].geometry.location,
					address: address
				});

				infoWindow(marker, map, title, locations);

				
			}
			else 
			{
				//alert('Geocode was not successful for the following reason: ' + status);
			}
		});
		
	}
	
	var prev_infowindow = false; 

	function infoWindow(marker, map, title, locations) 
	{
		google.maps.event.addListener(marker, 'click', function () {
			
			if( prev_infowindow ) 
			{
			   prev_infowindow.close();
			}

			var html = $("#tmp_items").html()
				.replace("#title#", locations.property_type.name + " " + locations.requirement.name + " " + locations.project.name + " " + locations.road)
				.replace("#code#", locations.reference_id)
				.replace("#bed#", locations.bedrooms || 0)
				.replace("#bath#", locations.bathrooms || 0)
				.replace("#price#", $("#price_"+locations.reference_id).html())
				.replace(/#link#/g, $("#link_"+locations.reference_id).attr("href"))
				.replace("#type#", locations.property_type.name_th);

			iw = new google.maps.InfoWindow({
				content: html,
				maxWidth: 350
			});

			prev_infowindow = iw;

			iw.open(map, marker);

			//$('#iw').parent().parent().parent().parent().addClass("map-box");
			
		});
	}


	var items = <?=json_encode($params['items']);?>;

	initialize(items);

	var compare_items = 0;
	var compare_box = {};

	(function() {

		$(function() {

			$("a[name=btn-compare]").click(function() {
				
				var $this = $(this), compare_id = $this.attr("compare-id");
				
				if( !$this.hasClass("active") && compare_items < 4 )
				{
					compare_items++;
					$(this).toggleClass("active");

					$("#compare-panel").show();

					compare_box["c"+compare_id] = items[compare_id];
					
				}
				else if( $this.hasClass("active") )
				{
					compare_items--;
					$(this).toggleClass("active");
					
					delete compare_box["c"+compare_id];

					if( compare_items == 0 )
					{
						$("#compare-panel").hide();
					}
				}

				setComparePanel();
			});

			function setComparePanel()
			{
				var i, b=1, tmp = $("#tmp_compare_sm_box"), html; 

				$(".com-content").each(function(){
					$(this).html("<div class='emp-compare'>Compare</div>").removeClass("active");
				});

				for( i in compare_box )
				{
					html = tmp.html();
					html = html.replace("#name#", compare_box[i].name + " " + compare_box[i].project.name );	
					html = html.replace("#price#", $("#price_"+compare_box[i].reference_id).html().replace("<br>", ""));
					html = html.replace("#id#", "com-bx-"+i);		

					$("#com-b"+b).eq(0).html(html).addClass("active");

					b++;
				}

				$("div[name=rm-com-box]").unbind().click(function(){

					var id = $(this).attr("com-id").replace("com-bx-c", "");
					
					$("a[name=btn-compare][compare-id="+id+"]").removeClass("active");
					delete compare_box["c"+id];

					compare_items--;

					setComparePanel();

				});
				
				if( compare_items == 0 )
				{
					$("#compare-panel").hide();
				}

				if( compare_items > 1 )
				{
					$("#btn-go-compare").prop("disabled", false).addClass("btn-primary");
				}
				else
				{
					$("#btn-go-compare").prop("disabled", true).removeClass("btn-primary");
				}
			}

			function setCompareModel()
			{
				var i,j=0, b=1, tmp = $("#tmp_compare_md_box"), html, locations, ind, ond; 

				$(".md-content").each(function(){
					$(this).html("<div class='md-emp-compare text-center'><button class='btn btn-danger'>เลือกกล่องเปรียบเทียบ</button></div>").removeClass("active");
				});

				for( i in compare_box )
				{
					locations = compare_box[i];

					ind = '';
					for( j in indoor )
					{
						if( typeof locations.project[j] != 'undefined' && locations.project[j] != 0 )
						{
							ind += indoor[j] + ", ";
						}
					}
					
					j = 0;
					ond = '';
					for( j in outdoor )
					{
						if( typeof locations.project[j] != 'undefined' && locations.project[j] != 0 )
						{
							ond += outdoor[j] + ", ";
						}
					}

					html = tmp.html()
						.replace("#title#", locations.property_type.name + " " + locations.requirement.name + " " + locations.project.name + " " + locations.road)
						.replace("#id#", "com-bx-"+i)
						.replace("#pic#", locations.picture.url)
						.replace("#code#", locations.reference_id)
						.replace("#bed#", locations.bedrooms || 0)
						.replace("#bath#", locations.bathrooms || 0)
						.replace("#floor#", locations.floors || 0)
						.replace("#indoor#", ind)
						.replace("#outdoor#", ond)
						.replace("#unit#", size_unit[locations.size_unit_id])
						.replace("#priceunit#", (locations.sell_price / locations.size).format(2))
						.replace("#size#", locations.size + " " + size_unit[locations.size_unit_id])
						.replace("#price#", $("#price_"+locations.reference_id).html())
						.replace(/#link#/g, $("#link_"+locations.reference_id).attr("href"))
						.replace("#type#", locations.property_type.name_th);		

					$("#mc-"+b).eq(0).html(html).addClass("active");

					b++;
				}

				$("div[name=rm-com-box-md]").unbind().click(function() {

					var id = $(this).attr("com-id").replace("com-bx-c", "");
					
					$("a[name=btn-compare][compare-id="+id+"]").removeClass("active");
					delete compare_box["c"+id];

					compare_items--;

					setCompareModel();
					setComparePanel();

				});

				$("div.md-emp-compare").unbind().click(function() {
					$('#model-compare').modal('hide'); 
				});
				
				if( compare_items == 0 )
				{
					$("#compare-panel").hide();
					$('#model-compare').modal('hide'); 
				}

				if( compare_items > 1 )
				{
					$("#btn-go-compare").prop("disabled", false).addClass("btn-primary");
				}
				else
				{
					$("#btn-go-compare").prop("disabled", true).removeClass("btn-primary");
				}
			}

			$('#model-compare').on('shown.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				
				var modal = $(this);

				setCompareModel();

			});

		});

		

	})(jQuery);



	/**
	 * Number.prototype.format(n, x)
	 * 
	 * @param integer n: length of decimal
	 * @param integer x: length of sections
	 */
	Number.prototype.format = function(n, x) {
	    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
	    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
	};

	//google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php
$this->import('/layout/footer');
?>
