
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

	<div id="searchArea" class="collapse search_bar_pj pds">
	
		<div class="col-xs-12 col-md-12 no_padd">
			<form class="search_proj_form form-inline">
				

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
			
					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod_pj">
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

					<div class="form-group col-xs-6 col-sm-6 col-md-4 padd_form">
						<div class="inp_contain">
							<div class="btn-group search-prod_pj">
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
	
	<div class="listwrap">

		<div class="col-md-8 left pdl30">
			
			<div class="drop_sort">
				
				<div  class="sort_text" style="float:left;">
					SORT BY : 
				</div>
				<div class="inp_contain shc no-bg-drop" style="float:left;">
					<div class="btn-group search-prod_pj">
						<button class="btn btn-default text-org dropdown-toggle" type="button" data-toggle="dropdown">
							<span data-bind="label" id="searchLabel"><?=(isset($_GET['sortby']))? $_GET['sortby'] : 'Newest';?></span>  
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<?php
							unset($_GET['sortby']);
							?>
							<li><a href="?<?=http_build_query($_GET);?>&sortby=Newest" name="sortby" value="Newest">Newest</a></li>
							<li><a href="?<?=http_build_query($_GET);?>&sortby=Popular" name="sortby" value="Popular">Popular</a></li>
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
					if( count($items) > 0 )
					{
						foreach( $items as $key=> $proj )
						{
							if( $proj['av_unit'] > 0 )
							{
							?>
							<div class="cardContainer map_project" data-seq="<?=$key;?>" data-id="<?php echo $proj["id"];?>" data-name="<?php echo $proj['name'];?>" data-pic="<?php echo $proj["image_path"];?>">
								<div class="project_list col-md-4 mgb20" data-prop="<?php echo $proj["id"];?>">
									<div class="pj-top" data-prop="<?php echo $proj["id"];?>">
										<div class="img-pd" style="background: url(<?php echo $proj["image_path"];?>);"></div>
										<div class="info-pj">
											<div class="ppt-name">
												<?php echo $proj['name'];?>
											</div>
											<div class="ptt-location mgt10"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""><?php echo $proj['district_name'];?>, <?php echo $proj['province_name'];?></div>
											<div class="ptt-fact mgt20">
												<div class="pj-year col-xs-12 col-md-12 no_padd">Year Built: <?php echo $proj['year_built'];?></div>
											</div>
										</div>
									</div>
									<div class="pj-bottom">
										<div class="col-xs-4 col-md-4 no_padd">
											<div class="pj-val"><?php echo $proj['number_buildings'];?></div>
											<div class="pj-unit">Towers</div>
										</div>
										<div class="col-xs-3 col-md-3 no_padd">
											<div class="pj-val"><?php echo $proj['number_floors'];?></div>
											<div class="pj-unit">Floors</div>
										</div>
										<div class="col-xs-5 col-md-5 no_padd">
											<div class="pj-val txt-org"><?php echo $proj['av_unit'];?></div>
											<div class="pj-unit">Available Units</div>
										</div>
									</div>
								</div>
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
								  <a href="<?php echo \Main\Helper\Url::absolute("/list_project?".http_build_query(array_merge($_GET, ["page"=> 1])))?>" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								  </a>
								</li>
								<?php for(; $i < $stop; $i++){?>
								<li <?php if($params["paging"]["page"]==$i){?>class="active"<?php }?>>
									<a href="<?php echo \Main\Helper\Url::absolute("/list_project?".http_build_query(array_merge($_GET, ["page"=> $i])))?>"><?php echo $i;?></a></li>
								<?php }?>
								<li>
								  <a href="<?php echo \Main\Helper\Url::absolute("/list_project?".http_build_query(array_merge($_GET, ["page"=> $params["paging"]["pageLimit"]])))?>" aria-label="Next">
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

		<div id="heroContainer"  class="col-md-4 fixed right0 hidden-xs hidden-sm">

			<div id="searchOverlay">
				<div id="map"></div>
			</div>

		</div>
		
		<div class="clearfix"></div>

	</div>

</section>

<div id="info_tmpl" style="display:none;">
	<div class="" style="width: 200px; height: 55px; background: #fff;">
		<div style="padding: 18px;">
			{name}
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

<?php require_once 'template/footer.php'; ?>