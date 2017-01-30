

<style type="text/css">

	.row-offcanvas {
		background: #f5f5f5;
	}

</style>


<?php 
extract($params);
$this->import('/template/top-navbar'); 
?>

<section id="listContainer" class="a_container">

	<div id="searchArea" class="collapse search_bar pds ">
	
		<div class="col-md-12 no_padd">
			<form action="" class="search_prod_form form-inline">

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
			
				<div class="col-md-3 no_padd">
					
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
			
				<div class="col-xs-12 col-sm-12 col-md-2 no_padd">
					<div class="inp_contain">
						<button type="submit" class="btn btn-grn">Search</button>
					</div>
				</div>

			</form>
		</div>
		
		<div class="clearfix"></div>
	</div>
	
	<div class="listwrap">

		<div class="col-md-8 left ">
			
			<div class="drop_sort">
				
				<div  class="sort_text" style="float:left;">
					SORT BY : 
				</div>
				<div class="inp_contain shc no-bg-drop" style="float:left;">
					<div class="btn-group search-prod">
						<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
							<span data-bind="label" id="searchLabel">Newest</span>  
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a name="sel_requirement">For Buy</a></li>
							<li><a name="sel_requirement">For Rent</a></li>
						</ul>
					</div>
				</div>
				
				<div id="searchToggle" class="pull-right hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#searchArea" aria-expanded="false" aria-controls="searchArea">
					<i class="fa fa-search" aria-hidden="true"></i>
				</div>

			</div>

			<div class="col-md-12 a_container rightContain">
				
				<div class="listContain row mgt70">

					<?php
					$i = 0;

					$unit = array(
						'1' => 'Sq. m.',
						'2' => 'Sq. wa',
						'3' => 'Rai'
					);

					foreach( $items as $key=> $props )
					{
						?>
						<div class="cardContainer" data-seq="<?=$key;?>">
							<div class="property_list col-md-4 mgb20" data-prop="<?php echo $props["id"];?>">
								<div class="pd-top" data-prop="<?php echo $props["id"];?>">
									<div class="img-pd" style="background-image: url(<?php echo $props["picture"]["url"];?>);"></div>
									<div class="info-pd">
										<div class="ppt-name" title="<?php echo $props['project']['name'];?>">
											<?php echo $props['project']['name'];?>
											<div class="pull-right text-right mgt5 hidden-sm hidden-md hidden-lg">
												<div class="opt-plus pull-right"></div>
												<div class="opt-fav pull-right mrgrl10"></div>
											</div>
										</div>
										<?php
										$price = 'N/A';
										$req = isset($props["requirement_id"]) ? $props["requirement_id"] : '';
										if( $props["sell_price"] > 0 && $req == 1 )
										{
											$price = number_format($props["sell_price"]);
										}
										elseif( $props["rent_price"] > 0 && $req == 2 )
										{	
											$price = number_format($props["rent_price"]);
										}
										elseif( $req == '' )
										{	
											$price = isset($props["sell_price"]) ? number_format($props["sell_price"]) : 'N/A';
										}
										?>
										<div class="ptt-location mgt10"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""><?php echo $props['district_name'];?>, <?php echo $props['province_name'];?></div>
										<div class="ptt-fact mgt25">
											<div class="fact-bed col-xs-2 col-md-2 "><?php echo $props['bedrooms'];?></div>
											<div class="fact-bath col-xs-2 col-md-2 "><?php echo $props['bathrooms'];?></div>
											<div class="fact-size-xs col-xs-2 col-md-2 hidden-sm hidden-md hidden-lg"><?php echo $props['size'];?> m<sup style="font-size:0.5em;">2</sup></div>
											<div class="fact-size col-xs-4 col-md-4 pull-right  text-right no_padd hidden-xs"><?php echo $props['size'];?> <?=(isset($unit[$props['size_unit_id']]))? $unit[$props['size_unit_id']] : 'Sq.M.';?></div>
											<div class="pd-price-xs col-xs-4 text-right pull-right hidden-sm hidden-md hidden-lg">฿ <?php echo $price;?></div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="pd-bottom hidden-xs">
									<div class="pd-price col-xs-6">฿ <?php echo $price;?></div>
									<div class="pd-opt col-xs-6 text-right">
										<div class="opt-plus pull-right"></div>
										<div class="opt-fav pull-right mrgrl10"></div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
					?>
					<div class="clearfix"></div>
				</div>	

			</div>

		</div>	

		<div id="heroContainer"  class="col-md-4 fixed right0 hidden-xs hidden-sm">

			<div id="searchOverlay">
				<div id="map"></div>
				<!-- <div class="heroImage" style="background-image: url(<?php echo \Main\Helper\URL::absolute("/public/assets/img/gmap.png")?>);"></div> -->
			</div>

		</div>
		
		<div class="clearfix"></div>

	</div>

</section>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/assets/js/richmarker.js")?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/assets/js/infobox.js")?>"></script>

<script type="text/javascript">
<!--

var items = <?=json_encode($items);?>;
var params = <?=json_encode($params);?>;

//-->
</script>

<?php $this->import('/template/footer'); ?>