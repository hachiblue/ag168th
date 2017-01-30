<?php
use Main\Helper;
use Main\Helper\URL;

$this->import('/layout/new_header');
$this->import('/layout/new_nav');

$db = \Main\DB\Medoo\MedooFactory::getInstance();

$projects = $db->query('SELECT id, name FROM project')->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Important stylesheet -->
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("");?>/public/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("");?>/public/css/owl.theme.css">

<style type="text/css">

	#map {
		height: 100%;
	}

	.img_top_content {
		max-height : 400px;
	}

	.map_top_content {
		height : 400px;
	}

	.fixOverlayDiv{
		position: relative;
		width:100%; 
		padding:0px;
		background: #f5f6f7;
	}

	.category-banner {
		max-height: 200px;
		margin: auto;
		background: #333;
	}

	.OverlayText{
		bottom: 0;
		color: #fff;
		left: 0;
		opacity: 0.9;
		position: absolute;
		padding: 10px;
		width: 100%;
	}

	.autocomplete-suggestions  {
		position: fixed;
	}

</style>


<div id="" class="" style="box-shadow: 0 2px 3px #f8f5f2;">
	
	<div class="container mtm pas">
		<div class="clearfix">

			<div class="form">

				<div class="col-md-4">
					<div class="input-group">
					  <input type="text" class="form-control" id="searchBy" placeholder="Search for..." autocomplete="off">
					  <div id="search_autoc"><div class="autocomplete-suggestions " style="display: none; top: 82px; left: 20px; width: 408px;"></div></div>

					  <input type="hidden" name="proj_id" id="proj_id" value="<?=(isset($_GET["project_id"]))?$_GET["project_id"]:'';?>" />
					  <input type="hidden" name="requirement_id" id="requirement_id" value="<?=(isset($_GET["requirement_id"]))?$_GET["requirement_id"]:'';?>" />

					  <span class="input-group-btn">
						<button class="btn btn-default" id="btn-search" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
					  </span>
					</div><!-- /input-group -->
				</div>
			</div>
		</div>
	</div>

</div>

<div class="container clrb">
	
	<div id="homeDetails" class="row line asideFloaterContainer title_rt_bx1 pvl">
		<div class="col cols24">
			<h1 class="mbn">
				<?php echo $params["item"]['property_type']['name'];?>
				<span class="typeLowLight" style="font-weight: 400!important;">
				<?php echo $params["item"]['requirement']['name'];?>
				<?php echo $params["item"]['project']['name'];?>
				<?php echo $params["item"]['road'];?>
				Bangkok</span>
			</h1>
		</div>
	</div>

	<div class="row" style="background-color: #f8f5f2;">
		
		<div class="col-xs-12 col-sm-8">
			
			<div id="owl-demo" class="owl-carousel owl-theme">
				<?php
				$imgs = count($params["item"]["images"]) > 0? $params["item"]["images"]: $params["item"]['project']["images"];
				if(count($imgs) == 0) $imgs = [$params["item"]["picture"]];
				?>
				<?php foreach($imgs as $img) {?>
				<div class="item text-center"><img src="<?php echo $img["url"];?>" class="img-responsive img_top_content" alt="" style="margin: auto;"></div>
				<?php }?>
			</div>

		</div>

		<div class="col-xs-12 col-sm-4 map_top_content">
			<div id="map"></div>
		</div>

	</div>
	
	<br>
	<div class="row">
		<div class="col-xs-12 col-sm-8">
		
			

			<div class="line">

				<!-- <div class="col cols14">
					<div class="h5"><?=$params["item"]['address_no'] . ' ' . $params["item"]['project']['address'];?></div>
					<div class="pts"></div>
				</div> -->


				<div class="col lastCol">
					
					<div class="boxBody mvs">

						<div class="h7 mvn typeCapitalize">
							<?php
							$price = $params["item"]["sell_price"];

							if( $price != 0 ) 
							{
								$price = number_format($price);
							}
							else
							{
								$price = ' N/A ';
							}

							?>
							<strong>Price : </strong><span class="red"><?php echo $price;?> </span>
						</div>

						<hr class="mtn">
						  
						<!-- <div class="h7 mvn typeCapitalize">
							<strong>ราคาเช่า : </strong><span class="red"><?php echo number_format($params["item"]["rent_price"]);?> บาท </span>
						</div>

						<hr class="mtn"> -->
						  
						<div class="h7 mvn typeCapitalize">
							<strong>sqm : </strong><span> <?php echo $params["item"]["size"];?> ตร.ว.</span>
						</div>

						<hr class="mtn">
						  
						<div class="h7 mvn typeCapitalize">
							<strong>Floor : </strong><span> <?php echo $params["item"]["floors"];?> </span>
						</div>

						<hr class="mtn">
						  
						<!-- <div class="h7 mvn typeCapitalize">
							<strong>ทำเล :</strong><a><?php echo @$params["item"]["zone"]["name"];?></a>
						</div>

						<hr class="mtn"> -->
						  
						<div class="h7 mvn typeCapitalize">
							<strong>Bedroom : </strong><span> <?php echo $params["item"]["bedrooms"];?> </span>
						</div>

						<hr class="mtn">
						  
						<div class="h7 mvn typeCapitalize">
							<strong>Bathroom : </strong><span> <?php echo $params["item"]["bathrooms"];?> </span>
						</div>

						<hr class="mtn">

						<div class="h7 mvn typeCapitalize">	
							<?php
							$pricesqm = $params["item"]["sell_price"];
							$sqm = $params["item"]["size"];

							if( $pricesqm != 0 && $sqm != 0 ) 
							{
								$pricesqm = number_format( $pricesqm / $sqm );
							}
							else
							{
								$pricesqm = ' N/A ';
							}

							?>
							<strong>Price / sqm : </strong><span> <?php echo $pricesqm;?> </span>
						</div>

						<hr class="mtn">

					</div>

				</div>
				
			</div>

		</div>

		<div class="col-xs-12 col-sm-4">
			<div data-action="showCrimePopup" class="box boxBasic mtn backgroundLowlight clickable crime_glance_details" data-track="AtAGlance|Crime">
				<div class="boxBody media pvs h5 factsheet">
					
					<div class="h5 typeWeightNormal mediaImg mediaImgExt">
						By : <?=$params["item"]["project"]["builder_by"];?>
					</div>

					<hr class="mtn">

					<div class="h5 typeWeightNormal mediaImg mediaImgExt">
						Floor : <?=$params["item"]["project"]["number_floors"];?>
					</div>

					<hr class="mtn">

					<div class="h5 typeWeightNormal mediaImg mediaImgExt">
						Tower : <?=$params["item"]["project"]["number_buildings"];?>
					</div>

					<hr class="mtn">

					<div class="h5 typeWeightNormal mediaImg mediaImgExt">
						Unit : <?=$params["item"]["project"]["number_units"];?>
					</div>

					<hr class="mtn">

					<div class="h5 typeWeightNormal mediaImg mediaImgExt">
						Facility
					</div>
					<div class="typeWeightNormal mediaBody">
						<ul>
							<?php if(@$params['item']['project']['has_onsen']){?><li><span class="glyphicon glyphicon-ok"></span> Onsen</li><?php }?>
							<?php if(@$params['item']['project']['has_bowling']){?><li><span class="glyphicon glyphicon-ok"></span> Bowling</li><?php }?>
							<?php if(@$params['item']['project']['has_pool_room']){?><li><span class="glyphicon glyphicon-ok"></span> Pool Room</li><?php }?>
							<?php if(@$params['item']['project']['has_game_room']){?><li><span class="glyphicon glyphicon-ok"></span> Game Room</li><?php }?>
							<?php if(@$params['item']['project']['has_meeting_room']){?><li><span class="glyphicon glyphicon-ok"></span> Meeting Room</li><?php }?>
							<?php if(@$params['item']['project']['has_private_butler']){?><li><span class="glyphicon glyphicon-ok"></span> Private Butler</li><?php }?>
							<?php if(@$params['item']['project']['has_minimart_supermarket']){?><li><span class="glyphicon glyphicon-ok"></span> Minimart Supermarket</li><?php }?>
							<?php if(@$params['item']['project']['has_restaurant']){?><li><span class="glyphicon glyphicon-ok"></span> Restaurant</li><?php }?>
							<?php if(@$params['item']['project']['has_laundry_service']){?><li><span class="glyphicon glyphicon-ok"></span> Laundry Servic</li><?php }?>
							<?php if(@$params['item']['project']['has_bathtub_inside_unit']){?><li><span class="glyphicon glyphicon-ok"></span> Bathtub Inside Unit</li><?php }?>

							<?php if(@$params['item']['project']['has_swimming_pool']){?><li><span class="glyphicon glyphicon-ok"></span> Swimming Pool</li><?php }?>
                      		<?php if(@$params['item']['project']['has_gym']){?><li><span class="glyphicon glyphicon-ok"></span> Gym</li><?php }?>
                      		<?php if(@$params['item']['project']['has_garden']){?><li><span class="glyphicon glyphicon-ok"></span> Garden</li><?php }?>
                      		<?php if(@$params['item']['project']['has_futsal']){?><li><span class="glyphicon glyphicon-ok"></span> Futsal</li><?php }?>
                      		<?php if(@$params['item']['project']['has_badminton']){?><li><span class="glyphicon glyphicon-ok"></span> Badminton</li><?php }?>
                      		<?php if(@$params['item']['project']['has_basketball']){?><li><span class="glyphicon glyphicon-ok"></span> Basketball</li><?php }?>
                      		<?php if(@$params['item']['project']['has_tennis']){?><li><span class="glyphicon glyphicon-ok"></span> Tennis</li><?php }?>
                      		<?php if(@$params['item']['project']['has_playground']){?><li><span class="glyphicon glyphicon-ok"></span> Playground</li><?php }?>
                      		<?php if(@$params['item']['project']['has_shuttle_bus']){?><li><span class="glyphicon glyphicon-ok"></span> Shuttle Bus</li><?php }?>
                      		<?php if(@$params['item']['project']['has_private_parking']){?><li><span class="glyphicon glyphicon-ok"></span> Private Parking</li><?php }?>

						</ul>
					</div>

				</div>

			</div>
		</div>

	</div>


	<div class="row">

		<div class="phmx">

			<div class="box boxBasic pam backgroundLowlight">
				<form id="frmQuickSendEnquiry" class="form-horizontal">
					<div class="col-sm-12 col-sm-3 col-md-6">
						<div class="head-form h4 ">Enquiry to this unit</div>
						<div class="item-form cf phm">
							<input type="radio" name="requirement" value="Buy" class="mvs" checked=""><span> Buy</span>
							<br>
							<input type="radio" name="requirement" class="mvs" value="Rent"><span> Rent</span>
							<!-- <input type="radio" name="requirement" value="Buy/Rent"><span>ซื้อ / เช่า</span> -->
						</div>
					</div>

					<div class="col-sm-12 col-sm-9 col-md-6">
						
						<div class="head-form h4 ">Want to see this unit</div>

						<div class="item-form cf">
	
							<div class="form-inline form-group">
								<div class="col-sm-4">
									<input type="text" class="form-control datepicker" id="inputCalandar3" name="daterequest" placeholder="Calandar" required>
								</div>

								<label for="inputPhone3" class="col-sm-2 control-label">Tel</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="phone" id="inputPhone3" placeholder="Tel" required>
								</div>

							</div>
							
							<div class="form-inline form-group">
								<label for="inputName3" class="col-sm-2 col-sm-offset-4 control-label">Name</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="first_name" id="inputName3" placeholder="Name" required>
									<input type="hidden" class="form-control" name="last_name">
									<input type="hidden" class="form-control" name="email" >
								</div>
								
								<div class="col-sm-2">
								  <button type="submit" class="btn btn-default">OK</button>
								</div>
							</div>
						
						</div>
						<!-- <div class="item-form cf">
							<p>นามสกุล</p>
							<div>
								<input name="last_name" type="text">
							</div>
						</div>
						<div class="item-form cf">
							<p>Tel</p>
							<div>
								<input name="phone" type="text" class="number-only">
							</div>
						</div>
						<div class="item-form cf">
							<p>อีเมล</p>
							<div>
								<input name="email" type="text">
							</div>
						</div>

						<div class="box-btn-toggle">
							<button type="submit" style="display:none;" class="btn-search transit btnSubmit">Send</button>
							<button class="btn-search transit btnSubmit">SEND</button>
						</div> -->
						<input type="hidden" name="reference_id" value="<?php echo $params['item']['reference_id'];?>">
						<input type="hidden" name="id" value="<?php echo $params['item']['id'];?>">

					</div>
				</form>

				<div class="clear"></div>

				<div id="message-success" style="display:none; text-align:center; line-height:30px;">Success send form</div>
			</div>
		
		</div>

	</div>


	<div class="mtl">
		<hr class="mtn">
		<?php
		$update = $params["item"]["updated_at"];
		$date_update = strtotime($update);
		$dt = date('d/m/Y H:i', $date_update);
		?>
		<span>Information last updated on <?=$dt;?> </span>  
	</div>

	<div data-role="foreclosureModuleMain" class="ptl">
		<div data-view="foreclosureModuleUserLoggedOutView" class=""></div>
		<div data-view="foreclosureModuleUserLoggedInView" class="hideVisually"></div>
	</div> 


	<div class="row pbl mbm">

		<div class="h5 mtm mbl mls">
			<span class="h4 headingDoubleSuper typeEmphasize ptl">You might also like </span>
			<!-- <span class="headlineDoubleSub typeWeightNormal typeLowlight man">By <?=$params["item"]["project"]["builder_by"];?></span>	 -->
		</div>
	
		<?php
		$prop_other = $db->query(' SELECT p.*, pm.name as img, s.name as unit_name, pj.name as project_name FROM property p, size_unit s, property_image pm, project pj WHERE p.id = pm.property_id AND p.size_unit_id = s.id AND p.project_id = pj.id AND p.project_id = '.$params["item"]['project']['id'].' GROUP BY p.id LIMIT 4')->fetchAll(PDO::FETCH_ASSOC);

		foreach( $prop_other as $prop )
		{
			$img = URL::share("/public/prop_pic/".$prop['img']);
		?>
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 wrapper">
			<a href="<?php echo \Main\Helper\Url::absolute("/property/".$prop['id']);?>">
				<div class="fixOverlayDiv">
					<img alt="offer banner1" class="category-banner img-responsive" src="<?=$img;?>">
					<div class="OverlayText">
						<?php
						if( $prop['sell_price'] != 0 )
						{
							$price = number_format($prop['sell_price'], 2);
						}
						else
						{
							$price = 'N/A';
						}
						?>
						<span class="property-price typeEmphasize mvn h4"><span class="glyphicon glyphicon-tag f80p"></span>  &nbsp;<?=$price;?></span>
						<br>
						<span class="man noWrap h5"><span class="glyphicon glyphicon-fullscreen f80p"></span>  &nbsp;<?php echo $prop['size']." ".$prop['unit_name'];?></span>
						<br>
						<span class="man noWrap h5"><span class="glyphicon glyphicon-home f80p"></span>  &nbsp;<?php echo $prop['project_name'];?></span>
					</div>
				</div>
			</a>
		</div>
		<?php
		}
		?>

	</div>
	
</div>


<a href="#" id="back-to-top" title="Back to top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>


<script type="text/javascript">
<!--
	
var projects = <?=json_encode($projects);?>;
var params = <?=json_encode($params);?>;

//-->
</script>

<?php

$this->import('/layout/new_sitemap');
$this->import('/layout/new_footer');

?>