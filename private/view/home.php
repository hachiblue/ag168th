
<?php $this->import('/template/top-navbar'); ?>

<section id="homepageContainer" class="a_container">

	<div id="heroContainer"  class="col-md-6 left fixed">

		<div id="searchOverlay">
			<div class="heroImage" style="background-image: url(<?php echo \Main\Helper\URL::absolute("/public/assets/img/bg3.jpg")?>);"></div>
	
			<div class="banner">
				<div class="col-md-12 box-holder text-center">
					<div class="logo_s">
						<img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/AGENT168_1.png")?>" alt="" class="img-responsive">
					</div>
					<div class="txt-headline mgt30">Find Property with Profressional Agency</div>

				
					<div class="form_s col-xs-12 col-sm-12 col-md-10 col-md-offset-1 mrt15">
						<form action="list" class="">
							<div class="form-group col-md-10 pdr5">
								<div class="input-group">
									<div class="input-group-btn">
										<div class="btn-group search-bar">
											<button class="btn btn-default dropdown-toggle"  type="button" data-toggle="dropdown">
												<span data-bind="label" class="dsp_drop_txt"><span class="hidden-xs hidden-sm">For</span> Buy</span>  
												<span class="caret"></span>
											</button>
											<input type="hidden" id="requirement_id" name="requirement_id" value="1" class="btn_value">
											<ul class="dropdown-menu" role="menu">
												<li><a name="sel_requirement" value="1">For Buy</a></li>
												<li><a name="sel_requirement" value="2">For Rent</a></li>
											</ul>
										</div>
									</div>

								

									<input type="search" name="searchBy" id="auto-searchby" class="form-control search-bar opabx" autocomplete="off" placeholder="Where do you like to live" value="<?=(isset($_GET["searchBy"]))? $_GET["searchBy"] : '';?>">
									<input type="hidden" name="project_id" value="<?=(isset($_GET["project_id"]))? $_GET["project_id"] : '';?>">


								</div>
								
								<div class="nopadd">
									<div class="input-group" id="search_autoc">
										<div class="input-group-btn" style="width:20%"></div>
									<div class="autocomplete-suggestions " style="display: none; top: 1500px; left: 199.906px; width: 322px;"></div></div>
								</div>

							</div>
							<button type="submit" class="btn btn-searchred col-md-2">Search</button>
						</form>
					</div>
				</div>
			</div>

		</div>

	</div>

	<div class="hpRtContain">
		
		<div class="col-md-12 rightContain">
			
			<?php
			$topic = array('HIGHLIGHT PROPERTIES', 'HIGHLIGHT OF THE MONTH', 'NEW COMING', 'AROUND XXX M.', 'A BEAUTY OF RIVER', 'IN THE MIDDLE OF EVERYWHERE');

			$box_content = array_merge( array( 'HighLight Properties' => $highlight ), $feature_unit );
			$i = 0;
			foreach( $box_content as $name => $tp )
			{
				$mgt = $i != 0 ? 'mgt30' : 'mgt25';
			?>

			<div class="box <?=$mgt;?>">
				<div class="headline">
					<div class="mt20"><?=$name;?>
						<!-- <div class="mt-5"><small>Lorem ipsum dolor sit amet, consectetur adipisicing.</small></div> -->
					</div>
				</div>
				<div class="prop_list">
				
					<div class="hidden-xs">
						<?php if( isset($tp[0]) ) { ?>
						<div class="col-xs-12 col-sm-4 col-md-4 pd0">
							<div class="">
								<div class="prop_banner" style="background-image: url('<?=$tp[0]['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull mg0" data-href="/property/<?=$tp[0]['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable">
									<ul class="mbm property-card-details">
										<li class="man pdb3">
											<div class="man property-title"><?=$tp[0]['project']['name'];?></div>
										</li>
										<li class="man">
											<span class="property-price  mvn">฿ &nbsp;<?=number_format($tp[0]['price']);?></span>
											<span class="property-size man noWrap pull-right"> <?=$tp[0]['size'];?> <?=$tp[0]['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if( isset($tp[1]) ) { ?>
						<div class="col-xs-12 col-sm-4 col-md-4 pd0">
							<div class="ml3">
								<div class="prop_banner" style="background-image: url('<?=$tp[1]['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull ml3" data-href="/property/<?=$tp[1]['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable">
									<ul class="mbm property-card-details">
										<li class="man pdb3">
											<div class="man property-title"><?=$tp[1]['project']['name'];?></div>
										</li>
										<li class="man">
											<span class="property-price  mvn">฿ &nbsp;<?=number_format($tp[1]['price']);?></span>
											<span class="property-size man noWrap pull-right"> <?=$tp[1]['size'];?> <?=$tp[1]['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if( isset($tp[2]) ) { ?>
						<div class="col-xs-12 col-sm-4 col-md-4 pd0">
							<div class="ml3">
								<div class="prop_banner" style="background-image: url('<?=$tp[2]['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull ml3" data-href="/property/<?=$tp[2]['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable">
									<ul class="mbm property-card-details">
										<li class="man pdb3">
											<div class="man property-title"><?=$tp[2]['project']['name'];?></div>
										</li>
										<li class="man">
											<span class="property-price  mvn">฿ &nbsp;<?=number_format($tp[2]['price']);?></span>
											<span class="property-size man noWrap pull-right"> <?=$tp[2]['size'];?> <?=$tp[2]['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
					
					</div>

					<div class="clearfix"></div>
					
					<?php if( isset($tp[3]) ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-6 pd0">
						<div class="mgt3">
							<div class="prop_banner_big" style="background-image: url('<?=$tp[3]['picture']['url'];?>');"></div>
							<span class="overlayPhoto overlayFull mgt3" data-href="/property/<?=$tp[3]['id'];?>"></span>
							<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable text-center b5p">
								<ul class="mbm property-card-details">
									<li class="pdb3">
										<div class="property-title2"><?=$tp[3]['project']['name'];?></div>
									</li>
									<li class="">
										<span class="property-price2 ">฿ &nbsp;<?=number_format($tp[3]['price']);?></span>
									</li>
									<li class="">
										<span class="property-size2  noWrap"><?=$tp[3]['size'];?> <?=$tp[3]['size_unit']['name'];?> </span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>	

					<?php if( isset($tp[4]) ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-6 pd0">
						<div class="ml3 mgt3">
							<div class="prop_banner_big" style="background-image: url('<?=$tp[4]['picture']['url'];?>');"></div>
							<span class="overlayPhoto overlayFull ml3 mgt3" data-href="/property/<?=$tp[4]['id'];?>"></span>
							<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable text-center b5p">
								<ul class="mbm property-card-details">
									<li class="pdb3">
										<div class="property-title2"><?=$tp[4]['project']['name'];?></div>
									</li>
									<li class="">
										<span class="property-price2 ">฿ &nbsp;<?=number_format($tp[4]['price']);?></span>
									</li>
									<li class="">
										<span class="property-size2  noWrap"><?=$tp[4]['size'];?> <?=$tp[4]['size_unit']['name'];?> </span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>	

				</div>
			</div>
		
			<div class="clearfix"></div>
			
			<?php

				$i++;
			}
			?>

		</div>

	</div>	

</section>
	
<?php $this->import('/template/footer'); ?>