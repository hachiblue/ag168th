<?php 
extract($params);
$this->import('/template/top-navbar'); 
?>

<section id="projContainer" class="a_container">

<div class="container">

	<div id="searchArea" class="collapse search_bar_pj pds">
	
		<div class="col-xs-12 col-md-12 no_padd">
			<form class="search_proj_form form-inline" action="/list_project">
				

				<div class="form-group col-xs-12 col-sm-12 col-md-5 padd_form">
					<div class="inp_contain shc_pj">
						<span class="icon"></span>
						<input type="search" name="searchBy" id="auto-searchby" class="form-control search-prod opabx" autocomplete="off" placeholder="Search for ..." value="<?=(isset($_GET["searchBy"]))? $_GET["searchBy"] : '';?>">
						<input type="hidden" name="project_id" value="<?=(isset($_GET["project_id"]))? $_GET["project_id"] : '';?>">
					</div>	
				</div>
				
				<div class="col-md-6 no_padd">

					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<!-- <div class="btn-group search-prod_pj">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel">Sell/Rent</span>  
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li><a name="sel_requirement">For Buy</a></li>
									<li><a name="sel_requirement">For Rent</a></li>
								</ul>
							</div> -->

							<div class="btn-group search-prod_pj">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel" class="dsp_drop_txt">Zone</span>  
									<span class="caret"></span>
								</button>
								<input type="hidden" id="zone_id" name="zone_id" value="<?=(isset($_GET["zone_id"]))? $_GET["zone_id"] : '';?>" class="btn_value">
								<ul class="dropdown-menu" role="menu">
									<li><a name="zone_id" value=""> All </a></li>
									<?php
									foreach( $zone['zone'] as $z )
									{
										?>
									<li><a name="zone_id" value="<?=$z['id'];?>"><?=$z['name'];?></a></li>
									<?php
									}
										?>
								</ul>
							</div>

						</div>
					</div>
			
					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod_pj">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel" class="dsp_drop_txt">BTS</span>  
									<span class="caret"></span>
								</button>
								<input type="hidden" id="bts_id" name="bts_id" value="<?=(isset($_GET["bts_id"]))? $_GET["bts_id"] : '';?>" class="btn_value">
								<ul class="dropdown-menu" role="menu">
									<li><a name="bts_id" value=""> All </a></li>
									<?php
									foreach( $bts['bts'] as $z )
									{
										?>
									<li><a name="bts_id" value="<?=$z['id'];?>"><?=$z['name'];?></a></li>
									<?php
									}
										?>
								</ul>
							</div>
						</div>
					</div>

					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod_pj">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel" class="dsp_drop_txt">MRT</span>  
									<span class="caret"></span>
								</button>
								<input type="hidden" id="mrt_id" name="mrt_id" value="<?=(isset($_GET["mrt_id"]))? $_GET["mrt_id"] : '';?>" class="btn_value">
								<ul class="dropdown-menu" role="menu">
									<li><a name="mrt_id" value=""> All </a></li>
									<?php
									foreach( $mrt['mrt'] as $z )
									{
										?>
									<li><a name="mrt_id" value="<?=$z['id'];?>"><?=$z['name'];?></a></li>
									<?php
									}
										?>
								</ul>
							</div>
						</div>
					</div>

				</div>
			
				<div class="col-xs-12 col-sm-12 col-md-1 no_padd">
					<div class="inp_contain">
						<button type="submit" class="btn btn-org">Search</button>
					</div>
				</div>

			</form>
		</div>
		
		<div class="clearfix"></div>
	</div>

	<div class="mgt40 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0">
			<li><a href="/home">Home</a></li>
			<li><a href="/list_project">Projects</a></li>
			<li class="active"><?=$item['name'];?></li>
		</ol>
	</div>

	<div class="row">
		
		<div class="pp-top col-md-8">
			
			<div class="hidden-xs hidden-sm">
				<div class="heading"><?=$item['name'];?></div>
				<div class="sub-heading mgt3"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""> <?=$item['sub_district']['name'];?>, <?=$item['province']['name'];?></div>
			</div>

			<div class="pic_map mgt20">
				<div class="gall" style="background: #fff;">
					
					<div class="swiper-prop-container">
						<div class="swiper-wrapper">
							<?php
							$merge_image = $item['images'];
							
							foreach( $merge_image as $img )
							{
								?>
								<div class="swiper-slide">
									<!-- <img src="<?=$img['url'];?>" class="img-responsive" alt=""> -->
									<div class="swiper-bg-image" style="background: #fff;width:100%;">
										<img src="<?=$img['url'];?>" alt="" style="width:800px;" class="img-responsive">
									</div>
								</div>
								<?php
							}
							?>
						</div>
						<!-- Add Pagination -->
						<div class="swiper-pagination"></div>
						<!-- Add Arrows -->
						<div class="swiper-button-next swiper-button-black"></div>
						<div class="swiper-button-prev swiper-button-black"></div>
					</div>

					<div class="pj-bar hidden-md hidden-lg">
						<div class="pd10">
							<div class="heading-m"><?=$item['name'];?></div>
							<div class="sub-heading mgt3"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""> <?=$item['sub_district']['name'];?>, <?=$item['province']['name'];?></div>
						</div>
						<div class="pj-info mgt15 text-center">
							<div class="col-xs-3 no_padd"><div class="bigtxt"><?=$item['year_built'];?></div><div class="subtxt">Year Built</div></div>
							<div class="col-xs-3"><div class="bigtxt"><?=$item['number_buildings'];?></div><div class="subtxt">Towers</div></div>
							<div class="col-xs-2 text-center pdl6"><div class="bigtxt"><?=$item['number_floors'];?></div><div class="subtxt">Floors</div></div>
							<div class="col-xs-4 no_padd"><div class="bigtxt txt-orange"><?=$item['av_unit'];?></div><div class="subtxt">Available Units</div></div>
						</div>
					</div>
				</div>
				<div class="mapp" style="display:none;"></div>
				<div class="pp-gview hidden-xs hidden-sm">
					<div name="tab-project" class="pp-tab rht col-md-12 text-center active" data-tab="gall">
						<i class="fa fa-picture-o" aria-hidden="true"></i> Photos
					</div>
					<!-- <div name="tab-project" class="pp-tab col-md-6 text-center" data-tab="map">
						<i class="fa fa-map-marker" aria-hidden="true"></i> Map
					</div> -->
				</div>
			</div>
		
			<div class="pp-detail mgt25 pdt10">
				<p>
					<?=$item['project_desc'];?>			
				</p>
			</div>
		</div>

		<div class="col-md-4 enq">

			<div class="row_enq pp-projectinfo pdt10  pdb25 hidden-xs hidden-sm">
				<div class="pp-pjinfo mgt15 text-center">
					<div class="col-md-3 no_padd"><div class="bigtxt"><?=$item['year_built'];?></div><div class="subtxt">Year Built</div></div>
					<div class="col-md-3"><div class="bigtxt"><?=$item['number_buildings'];?></div><div class="subtxt">Towers</div></div>
					<div class="col-md-2 text-center pdl6"><div class="bigtxt"><?=$item['number_floors'];?></div><div class="subtxt">Floors</div></div>
					<div class="col-md-4 no_padd"><div class="bigtxt txt-orange"><?=$item['av_unit'];?></div><div class="subtxt">Available Units</div></div>
				</div>
				<div class="clearfix"></div>
			</div>		

			<div class="row_enq pp-facilities mgt5 bg-white">
					
					<div class="col-md-12 mgt5">
						<div class="heading2">Facilities</div>
						<div class="pp-faci-list  mgt10">
							<ul class="list-group row pdl15">
								<?php if($item['has_swimming_pool'] == 1 ){ ?> <li class="ico_swim col-xs-6 col-md-12">Swimming Pool</li> <?php } ?>
								<?php if($item['has_library'] == 1 ){ ?> <li class="ico_lib col-xs-6 col-md-12">Library</li> <?php } ?>
								<?php if($item['has_garden'] == 1 ){ ?> <li class="ico_garden col-xs-6 col-md-12">Garden</li> <?php } ?>
								<?php if($item['has_conference_room'] == 1 ){ ?> <li class="ico_conroom col-xs-6 col-md-12">Conference room</li> <?php } ?>
								<?php if($item['has_sauna'] == 1 ){ ?> <li class="ico_sauna col-xs-6 col-md-12">Sauna</li> <?php } ?>
								<?php if($item['has_kid_club'] == 1 ){ ?> <li class="ico_kid col-xs-6 col-md-12">Kid's club</li> <?php } ?>
								<?php if($item['has_gym'] == 1 ){ ?> <li class="ico_fitness col-xs-6 col-md-12">Fitness</li> <?php } ?>
								<?php if($item['has_pet'] == 1 ){ ?> <li class="ico_pet col-xs-6 col-md-12">Pet friendly</li> <?php } ?>
								<?php if($item['has_parking_lot'] == 1 ){ ?> <li class="ico_parking col-xs-6 col-md-12">Parking Lot</li> <?php } ?>
								<?php if($item['has_golf'] == 1 ){ ?> <li class="ico_golf col-xs-6 col-md-12">Golf</li> <?php } ?>
								<?php if($item['has_laundry_service'] == 1 ){ ?> <li class="ico_laundry col-xs-6 col-md-12">Laundry</li> <?php } ?>
							</ul>
						</div>
					</div>
					<div class="clearfix"></div>
			</div>			
		
			<div class="row_enq pp-projectinfo pdt10 mgt25 mgb20">
				<div class="box-map">
					<img src="https://maps.googleapis.com/maps/api/staticmap?center=<?=$item['address'];?>&markers=color:blue|<?=$item['address'];?>&zoom=16&size=400x200&key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI" class="img-responsive" alt="">

					<div name="tab-project" class="pp-tab col-md-12 text-center">
						<i class="fa fa-map-marker" aria-hidden="true"></i> Map
					</div>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
				
		</div>

	</div>

</div>

<div class="pp-tab-avail mgt25 ">

	<div class="container">
	
		<div class="head-av-unit pull-left mgt15">Available Units</div>

		<!-- Nav tabs -->
		<ul class="av-tab nav nav-tabs navbar-right" role="tablist">
			<li role="presentation" class="active"><a href="#sale" aria-controls="sale" role="tab" data-toggle="tab">For Sale <div class="sale-total tab-tt pull-right img-circle"><?=count($item['unit']['sale']);?></div></a></li>
			<li role="presentation" class="mgl5"><a href="#rent" aria-controls="rent" role="tab" data-toggle="tab">For Rent <div class="rent-total tab-tt pull-right img-circle"><?=count($item['unit']['rent']);?></div></a></li>
		</ul>
		
	</div>

	<div class="bg-white">
		<div class="container pdb30">
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="sale">
					<table class="av-table table mgt20 hidden-xs hidden-sm">
						<thead>
							<tr>
								<th>Room</th>
								<th>Price</th>
								<th>Bed</th>
								<th>Bath</th>
								<th>Floor</th>
								<th>Size</th>
								<th></th>
								<th></th>
							</tr>	
						</thead>
						<tbody>

							<?php
							foreach( $item['unit']['sale'] as $unit )
							{
								?>
								<tr>
									<td class="col-md-3">
										<div class="col-md-3 no_padd">
											<a href="project.php"><img src="<?=$unit['images'];?>" alt="" class="img-circle"></a>
										</div>
										<div class="room-type col-md-9 mgt15">
											<a href="/property/<?=$unit['id'];?>"><?=$item['name'];?></a>
											<div class="sub-title">Room No. <?=$unit['address_no'];?></div>
										</div>
									</td>
									<td class="col-md-2">
										<div class="room-price mgt20">฿ <?=number_format($unit['sell_price']);?></div>
									</td>
									<td class="col-md-1">
										<div class="fact-bed mgt20"><?=$unit['bedrooms'];?> Bed</div>
									</td>
									<td class="col-md-1">
										<div class="fact-bath mgt20"><?=$unit['bathrooms'];?> Bath</div>
									</td>
									<td class="col-md-1">
										<div class="room-floor mgt20"><?=$unit['floors'];?> fl.</div>
									</td>
									<td class="col-md-1">
										<div class="room-size mgt20"><?=$unit['size'];?> <?=$unit['size_unit']['name'];?></div>
									</td>
									<td class="col-md-1 text-center">
										<div class="mg-auto">
											<div class="opt-fav col-md-6 mgt20" data-prop="<?=$unit['id'];?>"></div>
											<div class="opt-plus col-md-6 mgt20"></div>
										</div>
									</td>
									<td class="col-md-2">
										<div class="room-more-detail col-md-10 mgt20 no_padd"><a href="/property/<?=$unit['id'];?>">View more details <i class="fa fa-caret-right pull-right mgt5" aria-hidden="true"></i></a></div>
									</td>
								</tr>
								<?php
							}
							?>

						</tbody>
					</table>

					<div class="hidden-md hidden-lg">
						<?php
						foreach( $item['unit']['sale'] as $unit )
						{
							?>
						<div class="avail-m-box">
							<div class="av-table-m col-xs-3 no_padd ">
								<a href="/property/<?=$unit['id'];?>"><img src="<?=$unit['images'];?>" alt="" class="img-circle"></a>
							</div>
							<div class="room-type-m col-xs-9 mgt10">
								<a href="/property/<?=$unit['id'];?>"><?=$item['name'];?></a>
								<div class="room-info-m">
									<div class="col-xs-3 no_padd"><?=$unit['bedrooms'];?> Bed</div>
									<div class="col-xs-3 no_padd"><?=$unit['bathrooms'];?> Bath</div>
									<div class="col-xs-2 no_padd"><?=$unit['floors'];?> fl.</div>
									<div class="fact-size-xs col-xs-4 no_padd"><?=$unit['size'];?> m<sup style="font-size:0.5em;">2</sup></div>
								</div>
								<div class="clearfix"></div>
								<div class="room-price-m">฿ <?=number_format($unit['sell_price']);?></div>
							</div>
							<div class="clearfix"></div>
						</div>
							<?php
						}
						?>
					</div>

				</div>
				<div role="tabpanel" class="tab-pane" id="rent">
					<table class="av-table table mgt20 hidden-xs hidden-sm">
						<thead>
							<tr>
								<th>Room</th>
								<th>Price</th>
								<th>Bed</th>
								<th>Bath</th>
								<th>Floor</th>
								<th>Size</th>
								<th></th>
								<th></th>
							</tr>	
						</thead>
						<tbody>
							
							<?php
							foreach( $item['unit']['rent'] as $unit )
							{
								?>
								<tr>
									<td class="col-md-3">
										<div class="col-md-3 no_padd">
											<a href="project.php"><img src="<?=$unit['images'];?>" alt="" class="img-circle"></a>
										</div>
										<div class="room-type col-md-9 mgt15">
											<a href="/property/<?=$unit['id'];?>"><?=$item['name'];?></a>
											<div class="sub-title">Room No. <?=$unit['address_no'];?></div>
										</div>
									</td>
									<td class="col-md-2">
										<div class="room-price mgt20">฿ <?=number_format($unit['rent_price']);?></div>
									</td>
									<td class="col-md-1">
										<div class="fact-bed mgt20"><?=$unit['bedrooms'];?> Bed</div>
									</td>
									<td class="col-md-1">
										<div class="fact-bath mgt20"><?=$unit['bathrooms'];?> Bath</div>
									</td>
									<td class="col-md-1">
										<div class="room-floor mgt20"><?=$unit['floors'];?> fl.</div>
									</td>
									<td class="col-md-1">
										<div class="room-size mgt20"><?=$unit['size'];?> <?=$unit['size_unit']['name'];?></div>
									</td>
									<td class="col-md-1 text-center">
										<div class="mg-auto">
											<div class="opt-fav col-md-6 mgt20" data-prop="<?=$unit['id'];?>"></div>
											<div class="opt-plus col-md-6 mgt20"></div>
										</div>
									</td>
									<td class="col-md-2">
										<div class="room-more-detail col-md-10 mgt20 no_padd"><a href="/property/<?=$unit['id'];?>">View more details <i class="fa fa-caret-right pull-right mgt5" aria-hidden="true"></i></a></div>
									</td>
								</tr>
								<?php
							}
							?>

						</tbody>
					</table>

					<div class="hidden-md hidden-lg">
						<?php
						foreach( $item['unit']['rent'] as $unit )
						{
							?>
						<div class="avail-m-box">
							<div class="av-table-m col-xs-3 no_padd ">
								<a href="/property/<?=$unit['id'];?>"><img src="<?=$unit['images'];?>" alt="" class="img-circle"></a>
							</div>
							<div class="room-type-m col-xs-9 mgt10">
								<a href="/property/<?=$unit['id'];?>"><?=$item['name'];?></a>
								<div class="room-info-m">
									<div class="col-xs-3 no_padd"><?=$unit['bedrooms'];?> Bed</div>
									<div class="col-xs-3 no_padd"><?=$unit['bathrooms'];?> Bath</div>
									<div class="col-xs-2 no_padd"><?=$unit['floors'];?> fl.</div>
									<div class="fact-size-xs col-xs-4 no_padd"><?=$unit['size'];?> m<sup style="font-size:0.5em;">2</sup></div>
								</div>
								<div class="clearfix"></div>
								<div class="room-price-m">฿ <?=number_format($unit['rent_price']);?></div>
							</div>
							<div class="clearfix"></div>
						</div>
							<?php
						}
						?>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>

</div>

</section>


<?php $this->import('/template/footer'); ?>