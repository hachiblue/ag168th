

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

	<div class="listwrap">

		<div id="heroContainer" class="col-md-4 fixed left0 hidden-xs hidden-sm">

			<div id="searchOverlay">
				<div id="map"></div>
				<!-- <div class="heroImage" style="background-image: url(<?php echo \Main\Helper\URL::absolute("/public/assets/img/gmap.png")?>);"></div> -->
			</div>

		</div>

		<div class="col-md-8 right pull-right">
			
			<div id="searchArea" class="collapse search_bar pdr ">
	
				<div class="col-md-12 no_padd">
					<form action="" class="search_prod_form form-inline">

						<div class="form-group col-xs-12 col-sm-12 col-md-2 padd_form">
							<div class="inp_contain shc">
								<span class="icon"></span>
								<input type="search" name="searchBy" id="auto-searchby" class="form-control search-prod opabx" autocomplete="off" placeholder="Search for ..." value="<?=(isset($_GET["searchBy"]))? $_GET["searchBy"] : '';?>">
								<input type="hidden" name="project_id" value="<?=(isset($_GET["project_id"]))? $_GET["project_id"] : '';?>">
							</div>	
						</div>
						
						<div class="col-md-4 no_padd">

							<div class="form-group col-xs-6 col-sm-6 col-md-3 padd_form">
								<div class="inp_contain">
									<div class="btn-group search-prod" style="display:none;">
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

									<div class="btn-group search-prod">
										<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
											<?php
											$zone_name = '';
											if( isset($_GET["zone_id"]) && !empty($_GET["zone_id"]) )
											{
												foreach( $zone['zone'] as $z )
												{
													$zone_name = $z['name'];
													if( $z['id'] == $_GET["zone_id"] ) break;
												}
											}
											?>
											<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["zone_id"]) && !empty($_GET["zone_id"]))? $zone_name : 'Zone';?></span>  
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

							<div class="form-group col-xs-6 col-sm-6 col-md-3 padd_form">
								<div class="inp_contain">
									<div class="btn-group search-prod">
										<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
											<?php
											$bts_name = '';
											if( isset($_GET["bts_id"]) && !empty($_GET["bts_id"]) )
											{
												foreach( $bts['bts'] as $z )
												{
													$bts_name = $z['name'];
													if( $z['id'] == $_GET["bts_id"] ) break;
												}
											}
											?>
											<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["bts_id"]) && !empty($_GET["bts_id"]))? $bts_name : 'BTS';?></span>  
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

							<div class="form-group col-xs-6 col-sm-6 col-md-3 padd_form">
								<div class="inp_contain">
									<div class="btn-group search-prod">
										<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
											<?php
											$mrt_name = '';
											if( isset($_GET["mrt_id"]) && !empty($_GET["mrt_id"]) )
											{
												foreach( $mrt['mrt'] as $z )
												{
													$mrt_name = $z['name'];
													if( $z['id'] == $_GET["mrt_id"] ) break;
												}
											}
											?>
											<span data-bind="label" id="searchLabel" class="dsp_drop_txt"><?=(isset($_GET["mrt_id"]) && !empty($_GET["mrt_id"]))? $mrt_name : 'MRT';?></span>  
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
					
							<div class="form-group col-xs-6 col-sm-6 col-md-3 padd_form">
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

							<!-- <div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
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
							</div> -->

						</div>
					
						<div class="col-md-1 no_padd">
							
							<div class="form-group col-xs-12 col-sm-12 col-md-12 padd_form">
								<div class="inp_contain">
									<div class="btn-group search-prod dropdown keep-open">
										<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
											<?php
											$txtPrice = 'All Price';
											if( (isset($_GET['price-range-min']) && !empty($_GET['price-range-min'])) ||
												(isset($_GET['price-range-max']) && !empty($_GET['price-range-max'])) )
											{
												$txt_min = !empty($_GET['price-range-min']) ? $_GET['price-range-min'] : 0;
												$txt_max = !empty($_GET['price-range-max']) ? $_GET['price-range-max'] : 0;

												$txtPrice = thinkprice($txt_min) . ' - ' . thinkprice($txt_max);
											}

											function thinkprice($price)
											{
												$divine = ( $price < 1000000 ) ? 10000 : 1000000;
												$unit = ( $price < 1000000 ) ? 'k' : 'm';
												return ( $price / $divine ) . $unit;
											}
											?>
											<span data-bind="label" id="price-range-dsp"><?=$txtPrice;?></span>  
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu multi-column columns-2x right_column">
											<div id="row-pricemn">
												<div class="col-md-6 drop-input_length pdr5">
													<input type="text" id="price-min" name="price-range-min" value="<?=(isset($_GET["price-range-min"]))? $_GET["price-range-min"] : '';?>" class="form-control" placeholder="No Min">
												</div>	
												<div class="col-md-6 drop-input_length pdl5">
													<input type="text" id="price-max" name="price-range-max" value="<?=(isset($_GET["price-range-max"]))? $_GET["price-range-max"] : '';?>" class="form-control" placeholder="No Max">
												</div>	
												<div class="row price-list">
													
													<?php
													if( $_GET['requirement_id'] == 1 )
													{
														?>
													<div class="col-xs-6 col-sm-6 lft">
														<ul id="list-price-min" class="multi-column-dropdown price-selector">
															<li data-price="1000000">฿ 1,000,000</li>
															<li data-price="2000000">฿ 2,000,000</li>
															<li data-price="3000000">฿ 3,000,000</li>
															<li data-price="4000000">฿ 4,000,000</li>
															<li data-price="5000000">฿ 5,000,000</li>
															<li data-price="7000000">฿ 7,000,000</li>
															<li data-price="10000000">฿ 10,000,000</li>
															<li data-price="30000000">฿ 30,000,000</li>
														</ul>
													</div>
													<div class="col-xs-6 col-sm-6 rit">
														<ul id="list-price-max" class="multi-column-dropdown price-selector">
															<li data-price="2000000">฿ 2,000,000</li>
															<li data-price="3000000">฿ 3,000,000</li>
															<li data-price="4000000">฿ 4,000,000</li>
															<li data-price="5000000">฿ 5,000,000</li>
															<li data-price="7000000">฿ 7,000,000</li>
															<li data-price="10000000">฿ 10,000,000</li>
															<li data-price="30000000">฿ 30,000,000</li>
															<li data-price="100000000">฿ 100,000,000</li>
														</ul>
													</div>
														<?php
													}
													?>

													<?php
													if( $_GET['requirement_id'] == 2 )
													{
														?>
													<div class="col-xs-6 col-sm-6 lft">
														<ul id="list-price-min" class="multi-column-dropdown price-selector">
															<li data-price="10000">฿ 10,000</li>
															<li data-price="15000">฿ 15,000</li>
															<li data-price="20000">฿ 20,000</li>
															<li data-price="25000">฿ 25,000</li>
															<li data-price="30000">฿ 30,000</li>
															<li data-price="40000">฿ 40,000</li>
															<li data-price="50000">฿ 50,000</li>
															<li data-price="80000">฿ 80,000</li>
														</ul>
													</div>
													<div class="col-xs-6 col-sm-6 rit">
														<ul id="list-price-max" class="multi-column-dropdown price-selector">
															<li data-price="15000">฿ 15,000</li>
															<li data-price="20000">฿ 20,000</li>
															<li data-price="25000">฿ 25,000</li>
															<li data-price="30000">฿ 30,000</li>
															<li data-price="40000">฿ 40,000</li>
															<li data-price="50000">฿ 50,000</li>
															<li data-price="80000">฿ 80,000</li>
															<li data-price="999999999999">฿ 100,000+</li>
														</ul>
													</div>
													<?php
													}
														?>

												</div>
											</div>
										</ul>
									</div>
								</div>
							</div>

							<!-- <div class="form-group col-xs-6 col-sm-6 col-md-5 padd_form">
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
							</div> -->

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
							<li><a name="sel_requirement">Newest</a></li>
						</ul>
					</div>
				</div>
				
				<div id="searchToggle" class="pull-right hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" href="#searchArea" aria-expanded="false" aria-controls="searchArea">
					<i class="fa fa-search" aria-hidden="true"></i>
				</div>

			</div>

			<div class="col-md-12 a_container rightContain">
				
				<div class="listContain row mgt130">

					<?php
					$i = 0;

					$unit = array(
						'1' => 'Sq. m.',
						'2' => 'Sq. wa',
						'3' => 'Rai'
					);
					
					if( count($items) > 0 )
					{
						foreach( $items as $key=> $props )
						{
							?>
							<div class="cardContainer" data-seq="<?=$key;?>" data-id="<?=$props["id"];?>">
								<div class="property_list col-md-4 mgb20" data-prop="<?php echo $props["id"];?>">
				
									<?php
									if( $props['feature_unit_id'] != '' )
									{
										switch( $props['feature_unit_id'] )
										{
											case '1' : $txt = 'Best Buy'; $cls = 'blue'; break;
											case '2' : $txt = 'Hot Price'; $cls = 'red'; break;
											case '3' : $txt = 'Discount'; $cls = 'yellow'; break;
											case '4' : $txt = 'New Coming'; $cls = 'green'; break;
											default : $txt = '';
										}
							
										if( $txt != '' )
										{
											?>
											<div class="content-box">
											   <div id="ribbon-container" class="<?=$cls;?>">
												  <a href="#" id="ribbon"><?=$txt;?></a>
											   </div>
											</div>
											<?php
										}
									}
									?>

									<div class="pd-top" data-prop="<?php echo $props["id"];?>">
										<div class="img-pd" style="background-image: url(<?php echo $props["picture"]["url"];?>);"></div>
										<div class="info-pd">
											<div class="ppt-name" title="<?php echo $props['project']['name'];?>">
												<?php echo $props['project']['name'];?>
												<div class="pull-right text-right mgt5 hidden-sm hidden-md hidden-lg">
													<div class="opt-plus pull-right" data-prop="<?=$props['id'];?>"></div>
													<div class="opt-fav pull-right mrgrl10" data-prop="<?=$props['id'];?>"></div>
												</div>
											</div>
											<?php
											$price = 'N/A';
											$req = isset($props["requirement_id"]) ? $props["requirement_id"] : 1;
											
											if( $req == 1 )
											{
												if( $props["sell_price"] > 0 )
												{
													$price = number_format($props["sell_price"]);
												}
											}
											elseif( $req == 2 )
											{
												if( $props["rent_price"] > 0 )
												{	
													$price = number_format($props["rent_price"]);
												}	
											}
											?>
											<div class="ptt-location mgt10"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""><?php echo $props['district_name'];?>, <?php echo $props['province_name'];?></div>
											<div class="ptt-fact mgt20">
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
											<div class="opt-plus pull-right" data-prop="<?=$props['id'];?>"></div>
											<div class="opt-fav pull-right mrgrl10" data-prop="<?=$props['id'];?>"></div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}

						// paging
						$i = 1;
						$pag = ( isset($_GET["page"]) )? $_GET["page"] : 0;
						if($params["paging"]["pageLimit"] > 9) 
						{
							$i = $pag - 4;
							$i = $i > 0? $i: 1;
							$i = $i < $params["paging"]["pageLimit"]-7? $i: $params["paging"]["pageLimit"]-7;

							$stop = $i + 8;
						}
						else
						{
							$stop = $params["paging"]["pageLimit"] + 1;
						}
						?>
						<div class="clearfix"></div>
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
						<?php
					}
					else
					{
						?>
						<div class="text-center pdb30"><h3>Project Not Found!</h3></div>
						<?php
					}
					?>
					<div class="clearfix"></div>
				</div>	

			</div>

		</div>
		
		<div class="clearfix"></div>

	</div>

</section>


<div id="info_tmpl" style="display:none;">
	<div class="" style="min-width: 220px; max-width: 230px;background: #fff;">
		<div class="property_list" data-prop="{name}">
			<div class="pd-top" data-prop="{name}">
				<div class="img-pd" style="background-image: url({picture});"></div>
				<div class="info-pd">
					<div class="ppt-name" title="{name}">
						{name}
						<div class="pull-right text-right mgt5 hidden-sm hidden-md hidden-lg">
							<div class="opt-plus pull-right" data-prop="55668"></div>
							<div class="opt-fav pull-right mrgrl10" data-prop="55668"></div>
						</div>
					</div>
					<div class="ptt-location mgt10">
						<img src="http://agent168th.com/public/assets/img/icon/pin_icon.png" alt="">{district_name} , {province_name}
					</div>
					<div class="ptt-fact mgt20">
						<div class="fact-bed col-xs-2 col-md-2 col-lg-2">{bedrooms}</div>
						<div class="fact-bath col-xs-2 col-md-2 col-lg-2">{bathrooms}</div>
						<div class="fact-size col-xs-4 col-md-4 col-lg-4" style="padding: 0px;text-align: right;">{size} m<sup style="font-size:0.5em;">2</sup></div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_mlBrkkojSUJnMjYKf00nhno1nlO9CCI"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/assets/js/richmarker.js")?>"></script>
<!-- <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/js/infobox.js")?>"></script> -->
<script src="<?php echo \Main\Helper\URL::absolute("/public/assets/js/snazzy-info-window.min.js")?>"></script>

<script type="text/javascript">
<!--

var items = <?=json_encode($items);?>;
var params = <?=json_encode($params);?>;

//-->
</script>

<?php $this->import('/template/footer'); ?>