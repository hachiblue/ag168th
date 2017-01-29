
<?php $this->import('/template/top-navbar'); ?>

<section id="propContainer" class="a_container">

<div class="container">

	<div id="searchArea" class="collapse search_bar pds  pos_relative no_padd">
	
		<div class="col-md-12 no_padd">
			<form action="/list" class="search_prod_form form-inline">

				<div class="form-group col-xs-12 col-sm-12 col-md-3 padd_form">
					<div class="inp_contain shc">
						<span class="icon"></span>
						<input type="search" name="searchBy" id="auto-searchby" class="form-control search-prod opabx" autocomplete="off" placeholder="Search for ..." value="<?=(isset($_GET["searchBy"]))? $_GET["searchBy"] : '';?>">
						<input type="hidden" name="project_id" value="<?=(isset($_GET["project_id"]))? $_GET["project_id"] : '';?>">
					</div>	
				</div>
				
				<div class="col-md-4 no_padd">

					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod">
								<?php
								$req = array( '1' => 'For Buy', '2' => 'For Rent' );
								?>
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["requirement_id"]) && !empty($_GET["requirement_id"]))? $req[$_GET["requirement_id"]]: 'Sell/Rent';?></span>  
									<span class="caret"></span>
								</button>
								<input type="hidden" id="requirement_id" name="requirement_id" value="<?=(isset($_GET["requirement_id"]))?$_GET["requirement_id"]:1;?>" class="btn_value">
								<ul class="dropdown-menu" role="menu">
									<li><a value="1">For Buy</a></li>
									<li><a value="2">For Rent</a></li>
								</ul>
							</div>
						</div>
					</div>
			
					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="btn_beds" class="dsp_drop_txt"><?=(isset($_GET["bedrooms"]) && !empty($_GET["bedrooms"]))? $_GET["bedrooms"] : 'All Beds';?></span>
									<span class="caret"></span>
								</button>
								<input type="hidden" id="bedrooms" name="bedrooms" value="<?=(isset($_GET["bedrooms"]))? $_GET["bedrooms"] : '';?>" class="btn_value">
								<ul class="dropdown-menu" role="menu">
									<li><a name="bedrooms" value="1">1</a></li>
									<li><a name="bedrooms" value="2">2</a></li>
									<li><a name="bedrooms" value="3">3</a></li>
									<li><a name="bedrooms" value="4+">4+</a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["bathrooms"]) && !empty($_GET["bathrooms"]))? $_GET["bathrooms"] : 'All Baths';?></span>  
									<span class="caret"></span>
								</button>
								<input type="hidden" id="bathrooms" name="bathrooms" value="<?=(isset($_GET["bathrooms"]))? $_GET["bathrooms"] : '';?>" class="btn_value">
								<ul class="dropdown-menu" role="menu">
									<li><a name="bathrooms" value="1">1</a></li>
									<li><a name="bathrooms" value="2">2</a></li>
									<li><a name="bathrooms" value="3">3</a></li>
									<li><a name="bathrooms" value="4+">4+</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>
			
				<div class="col-md-4 no_padd">
					
					<div class="form-group col-xs-6 col-sm-6 col-md-7 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod dropdown keep-open">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="price-range-dsp">All Price</span>  
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu multi-column columns-2x right_column">
									<div id="row-pricemn">
										<div class="col-md-6 drop-input_length pdr5">
											<input type="text" id="price-min" name="price-range-min" class="form-control" placeholder="No Min">
										</div>	
										<div class="col-md-6 drop-input_length pdl5">
											<input type="text" id="price-max" name="price-range-max" class="form-control" placeholder="No Max">
										</div>	
										<div class="row price-list">
											<div class="col-xs-6 col-sm-6 lft">
												<ul id="list-price-min" class="multi-column-dropdown price-selector">
													<li data-price="1000000">฿ 1,000,000</li>
													<li data-price="2000000">฿ 2,000,000</li>
													<li data-price="3000000">฿ 3,000,000</li>
													<li data-price="4000000">฿ 4,000,000</li>
												</ul>
											</div>
											<div class="col-xs-6 col-sm-6 rit">
												<ul id="list-price-max" class="multi-column-dropdown price-selector">
													<li data-price="1000000">฿ 1,000,000</li>
													<li data-price="2000000">฿ 2,000,000</li>
													<li data-price="3000000">฿ 3,000,000</li>
													<li data-price="4000000">฿ 4,000,000</li>
												</ul>
											</div>
										</div>
									</div>
								</ul>
							</div>
						</div>
					</div>

					<div class="form-group col-xs-6 col-sm-6 col-md-5 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod dropdown keep-open">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
									<span data-bind="label" id="searchLabel">More Filters</span>  
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu multi-column columns-2">
									<div class="col-xs-12 drop-title">Facilities</div>	
									<div class="row row-facility">
										<div class="col-sm-6">
											<ul class="multi-column-dropdown">
												<li>
													<div class="checkbox">
														<input id="chk-swimming_pool" name="swimming_pool" type="checkbox">
														<label for="chk-swimming_pool">
															<span class="chk-list">&nbsp;Swimming Pool</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-garden" name="garden" type="checkbox">
														<label for="chk-garden">
															<span class="chk-list">&nbsp;Garden</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-suana" name="suana" type="checkbox">
														<label for="chk-suana">
															<span class="chk-list">&nbsp;Suana</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-gym" name="gym" type="checkbox">
														<label for="chk-gym">
															<span class="chk-list">&nbsp;Fitness</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-private_parking" name="private_parking" type="checkbox">
														<label for="chk-private_parking">
															<span class="chk-list">&nbsp;Parking Lot</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-laundry_service" name="laundry_service" type="checkbox">
														<label for="chk-laundry_service">
															<span class="chk-list">&nbsp;Laundry</span>
														</label>
													</div>
												</li>
											</ul>
										</div>
										<div class="col-sm-6">
											<ul class="multi-column-dropdown">
												<li>
													<div class="checkbox">
														<input id="chk-library" name="library" type="checkbox">
														<label for="chk-library">
															<span class="chk-list">&nbsp;Library</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-conf" name="meeting_room" type="checkbox">
														<label for="chk-conf">
															<span class="chk-list">&nbsp;Conference room</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-kid" name="kid_club" type="checkbox">
														<label for="chk-kid">
															<span class="chk-list">&nbsp;Kid's club</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-pet" name="pet" type="checkbox">
														<label for="chk-pet">
															<span class="chk-list">&nbsp;Pet friendly</span>
														</label>
													</div>
												</li>
												<li>
													<div class="checkbox">
														<input id="chk-golf" name="golf" type="checkbox">
														<label for="chk-golf">
															<span class="chk-list">&nbsp;Golf</span>
														</label>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</ul>
							</div>
						</div>
					</div>

				</div>
			
				<div class="col-xs-12 col-sm-12 col-md-1 no_padd">
					<div class="inp_contain">
						<button type="submit" class="btn btn-grn">Search</button>
					</div>
				</div>

			</form>
		</div>
		
		<div class="clearfix"></div>
	</div>

	<div class="mgt40 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0">
			<li><a href="/home">Home</a></li>
			<li><a href="/list"><?php echo ((isset($item["requirement_id"]) && $item["requirement_id"] == 1) ? 'Buy' : 'Rent');?></a></li>
			<li class="active"><?=$item['project']['name'];?></li>
		</ol>
	</div>

	<div class="row">
		
		<div class="pp-top col-md-8">
			<?php
			$price = 'N/A';
			$req = isset($item["requirement_id"]) ? $item["requirement_id"] : '';
			if( $item["sell_price"] > 0 && $req == 1 )
			{
				$price = number_format($item["sell_price"]);
			}
			elseif( $item["rent_price"] > 0 && $req == 2 )
			{	
				$price = number_format($item["rent_price"]);
			}
			elseif( $req == '' )
			{	
				$price = isset($item["sell_price"]) ? number_format($item["sell_price"]) : 'N/A';
			}

			$req_txt = strtoupper($item['requirement']['name']);
			?>
			<div class="hidden-xs hidden-sm">
				<div class="heading">Room <?=$item['address_no'];?>, <?=$item['project']['name'];?> </div>
				<div class="sub-heading mgt3"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""> <?=$item['sub_district']['name'];?>, <?=$item['province']['name'];?></div>
			</div>

			<div class="pic_map mgt20">
				<div class="gall" style="background: #fff url(<?=$item['picture']['url'];?>) no-repeat center;background-size:cover;">
					<div class="pp-map-butt hidden-md hidden-lg"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/map_butt.png")?>" alt=""></div>
					<div class="pp-bar hidden-md hidden-lg">
						<div class="pp-price">
							<div class="price"><span class="font-green">฿</span> <?=$price;?></div>
							<div class="tag"><?=$req_txt;?></div>
						</div>
						<div class="pp-fact text-center">
							<div class="col-xs-3 col-md-3 pp-bed no_padd no_margin"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/bed_icon_act.png")?>" alt=""><span><b><?=$item['bedrooms'];?></b> Bed</span></div>
							<div class="col-xs-3 col-md-3 pp-bath no_padd"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/bath_icon_act.png")?>" alt="" class="img-sp"><span><b><?=$item['bathrooms'];?></b> Bath</span></div>
							<div class="col-xs-2 col-md-3 pp-floor no_padd"><b><?=$item['floors'];?></b> fl.</div>
							<div class="col-xs-3 col-md-3 pp-size no_padd"><b><?=$item['size'];?></b> Sq.M.</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
				<div class="mapp" style="display:none;"></div>
				<div class="pp-gview hidden-xs hidden-sm">
					<div class="pp-tab rht col-md-6 text-center active">
						<i class="fa fa-picture-o" aria-hidden="true"></i> Photos
					</div>
					<div class="pp-tab col-md-6 text-center">
						<i class="fa fa-map-marker" aria-hidden="true"></i> Map
					</div>
				</div>
			</div>

			<div class="pp-tabopt col-md-12 hidden-md hidden-lg text-center">
					<div class="left fst col-xs-6 add_to_fav"><div class="ico opt-fav"></div>Add to Favorite</div>
					<div class="right col-xs-6 add_to_compare"><div class="ico opt-plus"></div>Compare</div>
					<div class="clearfix"></div>
			</div>
			
			<div class="colrl-15  hidden-md hidden-lg">
				<div class="heading-m mgt15">
					Room <?=$item['address_no'];?>, <?=$item['project']['name'];?>
				</div>
				<div class="sub-pjheading-m mgt10">
					<div class="col-xs-7 no_padd bd-right">
						<img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""> <?=$item['sub_district']['name'];?>, <?=$item['province']['name'];?>
					</div>
					<div class="col-xs-4 no_padd mgl10">Ref Code: <?=$item['reference_id'];?></div>
				</div>

				<div class="clearfix"></div>
			</div>

			<div class="pp-detail mgt25">
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates error illo ab tenetur rem dignissimos tempore necessitatibus modi aperiam officiis cumque deleniti neque placeat nisi dolorum saepe ipsa suscipit tempora maxime id. Amet dolorum illo impedit qui velit in neque dolores et officia repellendus atque consequuntur perferendis accusantium ipsa eos fugit error quidem odit nisi iste aspernatur perspiciatis sit quasi. Excepturi aut similique nam sint doloremque aliquam minus deserunt in repudiandae nulla voluptatibus accusamus vel tempore officiis labore dignissimos doloribus. Corporis quasi doloremque voluptatibus molestiae. Necessitatibus optio quam error cupiditate tenetur dolorum laudantium possimus quos itaque soluta illum ducimus beatae.			
				</p>
			</div>

			<div class="pp-facilities mgt25">

				<div class="heading2">Facilities</div>

				<div class="hidden-xs hidden-sm">
					<div class="pp-faci-list col-md-4 mgt10 no_padd">
						<ul>
							<li class="ico_swim">Swimming Pool</li>
							<li class="ico_garden">Garden</li>
							<li class="ico_sauna">Sauna</li>
							<li class="ico_fitness">Fitness</li>
						</ul>
					</div>
					<div class="pp-faci-list col-md-4 mgt10 no_padd">
						<ul>
							<li class="ico_parking">Parking Lot</li>
							<li class="ico_laundry">Laundry</li>
							<li class="ico_lib">Library</li>
							<li class="ico_conroom">Conference room</li>
						</ul>
					</div>
					<div class="pp-faci-list col-md-4 mgt10 no_padd">
						<ul>
							<li class="ico_kid">Kid's club</li>
							<li class="ico_pet">Pet friendly</li>
							<li class="ico_golf">Golf</li>
						</ul>
					</div>
				</div>

				<div class="hidden-md hidden-lg">
					<div class="pp-faci-list  mgt10 no_padd">
						<ul class="list-group row pdl15">
							<li class="ico_swim col-xs-6">Swimming Pool</li>
							<li class="ico_lib col-xs-6">Library</li>
							<li class="ico_garden col-xs-6">Garden</li>
							<li class="ico_conroom col-xs-6">Conference room</li>
							<li class="ico_sauna col-xs-6">Sauna</li>
							<li class="ico_kid col-xs-6">Kid's club</li>
							<li class="ico_fitness col-xs-6">Fitness</li>
							<li class="ico_pet col-xs-6">Pet friendly</li>
							<li class="ico_parking col-xs-6">Parking Lot</li>
							<li class="ico_golf col-xs-6">Golf</li>
							<li class="ico_laundry col-xs-6">Laundry</li>
						</ul>
					</div>
				</div>
			</div>

		</div>

		<div class="col-md-4 enq">

			<div class="row_enq pp-propinfo hidden-xs hidden-sm">
				<div class="col-md-8 pp-price">
					<div class="price"><span class="font-green">฿</span> <?=$price;?></div>
					<div class="tag"><?=$req_txt;?></div>
				</div>
				<div class="col-md-4 pp-code">
					<div class="ref">Ref Code:</div>
					<div class="rcode"><?=$item['reference_id'];?></div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12 no_padd">
					<div class="pp-fact text-center">
						<div class="col-xs-3 col-md-3 pp-bed no_padd"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/bed_icon_act.png")?>" alt=""><span><b><?=$item['bedrooms'];?></b> Bed</span></div>
						<div class="col-xs-3 col-md-3 pp-bath no_padd"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/bath_icon_act.png")?>" alt="" class="img-sp"><span><b><?=$item['bathrooms'];?></b> Bath</span></div>
						<div class="col-xs-2 col-md-2 pp-floor no_padd"><b><?=$item['floors'];?></b> fl.</div>
						<div class="col-xs-3 col-md-3 pp-size no_padd"><b><?=$item['size'];?></b> <?=$item['size_unit']['name'];?></div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>	
	
			<div class="row_enq pp-enquiry mgt5">
					
					<div class="pp-tabopt col-md-12  text-center no_padd  hidden-xs hidden-sm">
							<div class="left fst col-xs-6 add_to_fav"><div class="ico opt-fav"></div>Add to Favorite</div>
							<div class="right col-xs-6 add_to_compare"><div class="ico opt-plus"></div>Compare</div>
							<div class="clearfix"></div>
					</div>

					<div class="clearfix"></div>

					<div class="col-md-12 form-enq pdt10 pdb20">
						
						<form id="form_enq" action="" name="enquiry">

							<div class="form-group">
								<label for="exampleInputEmail1">Enquiry this to this unit</label>
								<div class="dropdown">
									<select class="form-control" id="enq_to">
										<option value="">Buy</option>
									</select>
								</div>
							</div>
							<div class="form-group pdt10">
								<label for="exampleInputEmail1">Want to see this unit</label>
								<input type="text" class="form-control" id="enq_date" placeholder="Select Date">
							</div>
							<div class="form-group">
								<input type="txt" class="form-control" id="enq_phone" placeholder="Phone number">
							</div>
							<div class="form-group">
								<input type="email" class="form-control" id="enq_email" placeholder="Your Email">
							</div>

							<button class="btn btn-searchred col-md-12">Send Request</button>
						
						</form>

					</div>	
					
					<div class="clearfix"></div>
			</div>			

			<div class="row_enq pp-projectinfo pdt10 mgt25 pdb25 hidden-xs hidden-sm">
				<div class="col-md-12 pp-pjheadline mgt5">Project Info</div>
				<div class="col-md-12 pp-pjtag mgt15">
					<div class="col-md-3 no_padd">
						<a href="project.php"><img src="<?=$item['project']['pic'];?>" alt="" class="img-circle"></a>
					</div>
					<div class="top-txt col-md-9 no_padd">
						<div><a href="project.php"><?=$item['project']['name'];?> </a></div>
						<div class="sub-pjheading mgt3"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""> <?=$item['sub_district']['name'];?>, <?=$item['province']['name'];?></div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="pp-pjinfo mgt15 text-center">
					<div class="col-md-3 no_padd"><div class="bigtxt">2016</div><div class="subtxt">Year Built</div></div>
					<div class="col-md-3"><div class="bigtxt"><?=$item['project']['number_buildings'];?></div><div class="subtxt">Towers</div></div>
					<div class="col-md-2 text-center pdl6"><div class="bigtxt"><?=$item['project']['number_floors'];?></div><div class="subtxt">Floors</div></div>
					<div class="col-md-4 no_padd"><div class="bigtxt txt-orange"><?=$item['project']['number_units'];?></div><div class="subtxt">Available Units</div></div>
				</div>
				<div class="clearfix"></div>
			</div>			
		</div>

	</div>

	<div class="row mgt25">
		<div class="pp-similar col-md-12 no_padd ">
			<div class="heading3 text-center mgb25">Similar Listings</div>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
					$i = 0;
					$pd = 7;
					while( $i < $pd )
					{
					?>
					<div class="property_list col-md-3 bx-m mgb20 swiper-slide">
						<div class="pd-top"  data-prop="9999">
							<div class="img-pd" style="background: url(http://agent168th.com/public/prop_pic/GM1lV5F3nbYsmtdH89W2fiEzCyxNZuBD.jpg);"></div>
							<div class="info-pd">
								<div class="ppt-name">
									WaterMark Chaophraya
								</div>
								<div class="ptt-location mgt10"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt="">Phra Kanong, Bangkok</div>
								<div class="ptt-fact mgt25">
									<div class="fact-bed col-xs-2 col-md-2 ">1</div>
									<div class="fact-bath col-xs-2 col-md-2 ">1</div>
									<div class="fact-size col-xs-4 col-md-4 pull-right  text-right no_padd">93 Sq.M.</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="pd-bottom">
							<div class="pd-price col-xs-6">฿ 12,000</div>
							<div class="pd-opt col-xs-6 text-right">
								<div class="opt-plus pull-right"></div>
								<div class="opt-fav pull-right mrgrl10"></div>
							</div>
						</div>
					</div>
					<?php
						$i++;
					}
					?>
				</div>
			</div>

		</div>
	</div>

</div>

</section>


<?php $this->import('/template/footer'); ?>