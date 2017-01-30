<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>AGENT168TH</title>

    <!-- Bootstrap -->
    <link href="<?php echo \Main\Helper\URL::absolute("/public/new168/css/bootstrap.min.css")?>" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">


    <link href="<?php echo \Main\Helper\URL::absolute("/public/new168/css/custom.css")?>?<?=date('ymdhis');?>" rel="stylesheet">
    <link href="<?php echo \Main\Helper\URL::absolute("/public/new168/css/list.css")?>?<?=date('ymdhis');?>" rel="stylesheet">
    <link href="<?php echo \Main\Helper\URL::absolute("/public/new168/css/jquery.auto-complete.css")?>?<?=date('ymdhis');?>" rel="stylesheet">

	<style type="text/css">
	
		.autocomplete-suggestions  {
			position: fixed;
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
			border: 2px solid #4e8987;
			font-size: 0;
			position: absolute;
			top: 24px;
			right: 15px;
		}

		.q2-policy-compare.active {
			border-color: #4e8987;
			background-color: #4082e8;
			background-position: -2px -230px
		}

		.q2-policy-compare.text-style {
			height: 21px;
			width: 21px;
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
			background-color: #c1a977;
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
			background-color: #186765;
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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	
<section class="layout">

<?php
use Main\Helper;

$this->import('/layout/new_nav');

$db = \Main\DB\Medoo\MedooFactory::getInstance();

$projects = $db->query('SELECT id, name FROM project')->fetchAll(PDO::FETCH_ASSOC);

?>

	<div id="" class="container-fluid mtm pas pbn">
		
		<div class="clearfix">

			<div class="form">

				<div class="col-md-4">
					<div class="input-group">
					  <input type="text" class="form-control" id="searchBy" placeholder="Search for...">
					  <div id="search_autoc"></div>

					  <input type="hidden" name="proj_id" id="proj_id" value="<?=(isset($_GET["project_id"]))?$_GET["project_id"]:'';?>" />
					  <input type="hidden" name="requirement_id" id="requirement_id" value="<?=(isset($_GET["requirement_id"]))?$_GET["requirement_id"]:'';?>" />

					  <span class="input-group-btn">
						<button class="btn btn-default" id="btn-search" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
					  </span>
					</div><!-- /input-group -->
				</div>

			</div>

		</div>
	
		<div class="clearfix">
			<div class="col-md-6">
				<div id="resultsHeader" class="mvm">
					<div data-reactroot="" data-reactid="1" data-react-checksum="378090250">
						<h1 class="h3" data-reactid="2">Search results</h1>
					</div>
				</div>
			</div>
		</div>
    </div>

	<div class="columns cardsActive">
		

		<div class="mapColumn clearfix">

			<div id="map"></div>
		</div>


		<div id="resultsColumn" class=" resultsColumn">
			<div class="resultsColumn" style="overflow: hidden;">
				<div id="scrollContent">
					<div class="backgroundControls">
						<div class="container-fluid containerFluid">
							<?php
							$i = 0;

							$unit = array(
								'1' => 'Sq. m.',
								'2' => 'Sq. wa',
								'3' => 'Rai'
							);

							foreach( $params['items'] as $key=> $item )
							{
								?>
							<div class="col-sm-12 col-md-4 pblr6 ptm cardContainer" data-seq="<?=$i;?>">
								<div class="card backgroundBasic">
									<button data-test-id="CardSaveButton" class="saveHome hoverPulse pan typeReversed"><span class="stackIcons"><i class="iconHeartInactive iconOnly"></i><i class="iconHeartEmpty typeReversed iconOnly"></i></span>
									</button>

									<a class="q2-policy-compare text-style" compare-id="<?=$key;?>" name="btn-compare" href="javascript:;" title="select to compare"><div class="q2-text">เลือก<br>เปรียบเทียบ</div></a>

									<a id="link_<?=$item["reference_id"];?>" href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>" class="tileLink" alt="">
										<div class="photo overlayContainer">
											<div class="LazyLoad is-visible" style="height:180px;">
												<div class="bbs cardPhoto imageContainerCovered" style="height: 180px; background-image: url(&quot;<?php echo $item["picture"]["url"];?>&quot;);">
												</div>
											</div>
											<div class="cardDetails man ptm phm">
											

												<span class="h4 man pan typeEmphasize">
													<span class="glyphicon glyphicon-tag f80p"></span>  &nbsp;<?php echo empty($item["sell_price"])?"N/A": number_format($item["sell_price"]) ;?><br>
													<!-- เช่า  :  <?php echo empty($item["rent_price"])?"N/A": number_format($item["rent_price"]) . ' บาท';?> -->
												</span>
												
												<p class="typeTruncate"><span class="glyphicon glyphicon-fullscreen f80p"></span>  &nbsp;<?php echo $item['size'];?> &nbsp;<?=$unit[$item['size_unit_id']];?></p>
												<p class="typeTruncate noWrap"><span class="glyphicon glyphicon-home f80p"></span>  &nbsp;<?php echo $item['project']['name'];?></p>
											</div>
										</div>
									</a>
									<div class="man pan typeWeightNormal typeLowlight">
										<a href="<?php echo \Main\Helper\Url::absolute("/property/{$item["id"]}");?>">&nbsp;
											<!-- <?php
											if( !empty($item["sell_price"]) )
											{
												?>
												<b class="typeWarning typeCaps plm">Sold</b> on <?php echo date('M d, Y', strtotime($item["created_at"]));?>
												<?php
											}
											else
											{	
												echo '<b class="typeWarning typeCaps plm">&nbsp;</b>';
											}
											?> -->
											<span id="price_<?=$item["reference_id"];?>" style="display:none;">
												<?php echo empty($item["sell_price"])?"": "ขาย : ".number_format($item["sell_price"])." บาท";?><br>
												<?php echo empty($item["rent_price"])?"": "เช่า : ".number_format($item["rent_price"])." บาท";?>
											</span>

										</a>
									</div>
								</div>
							</div>
							<?php
								$i++;
							}
							?>
						</div>
						<?php
						// paging
						$i = 1;
						$pag = ( isset($_GET["page"]) )? $_GET["page"] : 0;
						if($params["paging"]["pageLimit"] > 9) 
						{
							$i = $pag - 4;
							$i = $i > 0? $i: 1;
							$i = $i < $params["paging"]["pageLimit"]-7? $i: $params["paging"]["pageLimit"]-7;
						}

						$stop = $i + 8;

						?>
						<div class="page-next text-center">
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
				</div>
			</div>
		</div>	
		
		

	</div>

</section>

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
				<div class="item-room clearfix" style="display:#dsppunit#;>
					<span class="pull-left">ราคา ต่อ #unit#</span>
					<span class="pull-right"><a class="item-type-name">#priceunit#</a></span>
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


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo \Main\Helper\URL::absolute("/public/new168/js/bootstrap.min.js")?>"></script>
   
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI"></script>
	
	<script src="<?php echo \Main\Helper\URL::absolute("/public/new168/js/infobox.js")?>"></script>
	<script src="<?php echo \Main\Helper\URL::absolute("/public/new168/js/richmarker.js")?>"></script>
	<script src="<?php echo \Main\Helper\URL::absolute("/public/new168/js/jquery.auto-complete.min.js")?>"></script>

	<script type="text/javascript">
	<!--
		var projects = <?=json_encode($projects);?>;
		var params = <?=json_encode($params);?>;
		var map, geocoder, marker;
		var markers = []; // Create a marker array to hold your markers
		
		var indoor = <?=json_encode($indoor);?>;
		var outdoor = <?=json_encode($outdoor);?>;
		var size_unit = <?=json_encode($size_unit);?>;

		function setMarkers(locations) 
		{
			var i, prop, myLatLng;

			for (i = 0; i < locations.length; i++) 
			{
				prop = locations[i];
				prop.seq = i;

				geocoder.geocode({
					'address': prop.project.address
				}, 
				geoCallback(prop) );
			}

			/*
			$('.mapMarker').hover(
				// when mouse in
				function() {
					var $this = $(this);

					when_hover($('[data-seq='+$this.data('mseq')+']'));
				}
				,
				// when mouse out
				when_offhover
			);*/

		}

		function geoCallback(prop)
		{
			var price = 0;
			var geoCB = function(results, status) {
				
				if( null !== prop.sell_price  )
				{
					price = prop.sell_price;
				}

				if (status === 'OK') 
				{
					marker = new RichMarker({
						position: results[0].geometry.location,
						map: map,
						address: prop.project.address,
						animation: google.maps.Animation.DROP,
						title: prop.name,
						content: '<a href="#" class="activeLink markerPrimary mapMarker typeEmphasize noWrap"><span class="typeReversed">'+prop.project.name || 'N/A'+'</span></a>',
						zIndex: 1
					});

					// Push marker to markers array
					markers.push(marker);					
				}
				else 
				{
					myLatLng = new google.maps.LatLng(prop.project.location_lat, prop.project.location_lng);
					marker = new RichMarker({
						position: myLatLng,
						map: map,
						animation: google.maps.Animation.DROP,
						title: prop.name,
						content: '<a href="#" class="activeLink markerPrimary mapMarker typeEmphasize noWrap" data-mseq="'+prop.seq+'"><span class="typeReversed">'+prop.project.name || 'N/A'+'</span></a>',
						zIndex: 1
					});

					// Push marker to markers array
					markers.push(marker);	
				}
			};

			return geoCB;
		}

		function reloadMarkers() 
		{
			// Loop through markers and set map to null for each
			for (var i = 0; i < markers.length; i++) 
			{
				markers[i].setMap(null);
			}
			
			// Reset the markers array
			markers = [];
			
			// Call set markers to re-add markers
			setMarkers(params.items);
		}

		function initialize() 
		{
			var mapOptions = {
				zoom: 12,
				center: new google.maps.LatLng(13.781556, 100.541233)
			};
			
			map = new google.maps.Map(document.getElementById('map'), mapOptions);
			
			geocoder = new google.maps.Geocoder();

			setMarkers(params.items);
			
			// Bind event listener on button to reload markers
			//document.getElementById('reloadMarkers').addEventListener('click', reloadMarkers);
		}
		
		var infowindow = null;
		
		
		function when_hover(elem)
		{
			/*
			if( undefined !== elem )
			{
				var $this = elem.eq(0);
			}
			else
			{
				var $this = $(this);
			}*/

			var $this = $(this);

			if (infowindow) 
			{
				infowindow.close();
			}
			
			var myOptions = {
				content: '<div class="mts" style="1px solid #bbb">' + $this.html() + '</div>'
				,maxWidth: 0
				,pixelOffset: new google.maps.Size(-140, 0)
				,zIndex: null
				,boxStyle: { 
					background: "url('<?php echo \Main\Helper\URL::absolute("/public/new168/js/tipbox.gif")?>') no-repeat"
					,width: "280px"
				}
				,closeBoxURL : ''
				,closeBoxMargin: "10px 2px 2px 2px"
				,isHidden: false
				,infoBoxClearance: new google.maps.Size(1, 1)
				,enableEventPropagation: false
			};

			infowindow = new InfoBox(myOptions);
			
			var seq = $this.data('seq');
		
			if( undefined !== markers[seq] )
			{
				infowindow.open(map, markers[seq]);
			}
		}

		function when_offhover()
		{
			if (infowindow) 
			{
				infowindow.close();
			}
		}	
		
		
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

		var compare_items = 0;
		var compare_box = {};
		var items = <?=json_encode($params['items']);?>;


		$(function() {
			
			$('.cardContainer').hover(
				// when mouse in
				when_hover
				,
				// when mouse out
				when_offhover
			);


			$('#searchBy').autoComplete({
				minChars: 1,
				source: function(term, suggest) {
					term = term.toLowerCase();
					var choices = projects;
					var suggestions = [];
					for (i=0;i<choices.length;i++)
						if (~choices[i]['name'].toLowerCase().indexOf(term)) suggestions.push(choices[i]['name']);
					suggest(suggestions);
				},
				onSelect: function(e, term, item) {
					
					var i;
					for( i in projects )
					{
						if( projects[i].name == item.data().val )
						{
							$('#proj_id').val(projects[i].id);

							break;
						}
					}

				}
			});
			
			$('#btn-search').click(function() {
		
				var 
					$proj_id = $('#proj_id'),
					$requirement_id  = $('#requirement_id');

				window.open('list?requirement_id='+$requirement_id.val()+'&project_id='+($proj_id.val() || ''), '_self');
			});
			
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
						.replace("#dsppunit#", ( (locations.sell_price == 0)? "none" : "" ) )
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

			initialize(); // map
		});
		

	//-->
	</script>

  </body>
</html>