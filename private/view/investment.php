<?php 
extract($params);
$this->import('/template/top-navbar'); 
?>

<section id="homepageContainer" class="a_container">

	<div id="heroContainer"  class="investHero col-md-6 left  bg-white">

		<div class="inv-top-banner text-center">
			<div class=""><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/invest.png")?>" alt=""></div>
			<div class="inv-banner-text mgt5">Project of the month</div>
			<!-- <div class="inv-banner-subtext mgt5">Lorem ipsum dolor sit amet.</div> -->
		</div>

	
			<div class="inv-project col-md-6 mgt25 clearfix">

				<div class="pp-pjtag col-xs-3 col-md-3">
					<a href="/project/<?=$project_of_month['id'];?>"><img src="<?=$project_of_month['url'];?>" alt="" class="img-circle"></a>
				</div>
				<div class="top-txt col-xs-9 col-md-9 no_padd">
					<div class="mgl10"><a href="/project/<?=$project_of_month['id'];?>"><?=$project_of_month['name'];?></a></div>
					<div class="sub-pjheading mgt3 mgl10"><img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/icon/pin_icon.png")?>" alt=""><?=$project_of_month['district_name'];?>, <?=$project_of_month['province_name'];?></div>
				</div>
				
				<div class="clearfix"></div>

				<div class="inv-prop col-md-12 mgt30">
					<div class="inv-prop-headtxt3">Price Chart (THB)</div>
					<div class="mgt30 mgb20">
						<!-- <img src="<?php echo \Main\Helper\URL::absolute("/public/assets/img/graph.png")?>" alt="">  -->
						<canvas id="invest-chart" style="width: 100%;"></canvas>
					</div>
				</div>

			</div>

			<div class="inv-project col-md-6 mgt25 clearfix">

				<div class="inv-prop col-md-12 clearfix">
					<div class="inv-prop-headtxt3">Current Market Price</div>
					<div class="inv-have-bborder mgt10 mgb20"><div><span class="inv-currency">฿</span> <span class="inv-prop-price">n/a</span></div></div>
				</div>
				
				<div class="inv-prop col-md-12">
					
					<div class="inv-prop-headtxt3">Buy</div>
					<div class="inv-prop-lefttxt mgt15 mgb10">Change from last quarter <div class="pull-right"><div class="inv-up"></div><span class="inv-num-up pdl5 pdr5">n/a</span> %</div></div>
					<div class="inv-prop-lefttxt mgt15 mgb10">Change from last quarter <div class="pull-right"><div class="inv-down"></div><span class="inv-num-down pdl5 pdr5">n/a</span> %</div></div>
					<div class="inv-prop-lefttxt mgt15 inv-have-bborder pdb20">Capital gain <div class="pull-right"><span class="inv-num-bd pdl5 pdr5">n/a</span> /y</div></div>
					
				</div>

				<div class="inv-prop col-md-12">
							
					<div class="inv-prop-headtxt3 mgt15">Rent</div>
					<div class="inv-prop-lefttxt mgt15 mgb10">Change from last year <div class="pull-right"><div class="inv-down"></div><span class="inv-num-down pdl5 pdr5">n/a</span> %</div></div>
					<div class="inv-prop-lefttxt mgt15 mgb10">Yield <div class="pull-right"><span class="inv-num-bd pdl5 pdr5">n/a</span> %</div></div>

				</div>	

			</div>
	
			<div class="col-md-12 text-center mgt15">
				<a href="/project/<?=$project_of_month['id'];?>"><button class="btn btn-vewproject">View Project</button></a>
			</div>
			
			<div class="clearfix"></div>

			<div class="inv-topic mgt30">
				
				<div class="swiper-investment-container">
					<div class="swiper-wrapper">
			
						<?php 
						foreach( $article as $at )
						{
							?>
							<div class="inv-news swiper-slide">
								<div class="news-img col-xs-12 col-md-4 no_padd">
									<a href="/editorial?topic=<?=$at['id'];?>"><img src="<?php echo \Main\Helper\URL::absolute("/public/article_pic/".$at['image_path'])?>" class="img-responsive" alt=""></a></div>
								<div class="col-xs-12 col-md-8">
									<div class="news-headline"><a href="/editorial?topic=<?=$at['id'];?>"><?=$at['name'];?></a></div>
									<div class="news-icon-sub mgt5"><div class="bd-investment">Investment</div><div class="bd-card-date"><?=date('d M Y', strtotime($at['created_at']));?></div></div>
									<div class="news-short-detail mgt15">
										<?=$out = mb_strlen($at['description']) > 200 ? mb_substr($at['description'],0,200)."..." : $at['description'];?>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<?php
						}
							?>

						<!-- <div class="inv-news swiper-slide mgt3">
							<div class="news-img col-xs-12 col-md-4 no_padd"><img src="http://agent168th.com/public/project_pic/20y9l7xewp6scwcoso.jpg" class="img-responsive" alt=""></div>
							<div class="col-xs-12 col-md-8">
								<div class="news-headline">Blindsided by SUV boom, Hyundai Motor trims costs, perks</div>
								<div class="news-icon-sub mgt5"><div class="bd-investment">Investment</div><div class="bd-card-date">10 Nov 2016</div></div>
								<div class="news-short-detail mgt15">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem mollitia libero. Fugit consequuntur mollitia cumque est expedita in et necessitatibus id aliquid animi. Aliquam repudiandae alias provident laboriosam quis quidem.</div>
							</div>
							<div class="clearfix"></div>
						</div> -->
			
					</div>
				</div>


			</div>	

	</div>

	<div class="inv-right-contain hpRtContain">
		
		<div class="col-md-12 rightContain bg-gray">
			
			<?php
			unset($topics[0]);
			foreach( $topics as $i => $tp )
			{
				$mgt = $i != 0 ? 'mgt30' : 'mgt25';

				if( $i == 1 )
				{
					$htext = 'Capital Gain '.$tp['name'].'%/year';		
				}
				else
				{
					$htext = 'Rental Yield '.$tp['name'].'%/year';	
				}

			?>

			<div class="box">
				<div class="headline2">
					<div class="mt20">
						<div><?=$htext;?></div>
						<!-- <div class="mt-5"><small>Lorem ipsum dolor sit amet, consectetur adipisicing.</small></div> -->
					</div>
				</div>
				<div class="prop_list">
				
					<div class="hidden-xs">
						<?php if( isset($tp['property'][0]) ) { ?>
						<div class="col-xs-12 col-sm-4 col-md-4 pd0">
							<div class="" data-refid="<?=$tp['property'][0]['reference_id'];?>">
								<div class="prop_banner" style="background-image: url('<?=$tp['property'][0]['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull mg0" data-href="/property/<?=$tp['property'][0]['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable" data-href="/property/<?=$tp['property'][0]['id'];?>">
									<ul class="mbm property-card-details">
										<li class="man pdb3">
											<div class="man property-title"><?=$tp['property'][0]['project']['name'];?></div>
										</li>
										<li class="man">
											<span class="property-price  mvn">฿ &nbsp;<?=number_format($tp['property'][0]['price']);?></span>
											<span class="property-size man noWrap pull-right"> <?=$tp['property'][0]['size'];?> <?=$tp['property'][0]['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if( isset($tp['property'][1]) ) { ?>
						<div class="col-xs-12 col-sm-4 col-md-4 pd0">
							<div class="ml3" data-refid="<?=$tp['property'][1]['reference_id'];?>">
								<div class="prop_banner" style="background-image: url('<?=$tp['property'][1]['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull ml3" data-href="/property/<?=$tp['property'][1]['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable" data-href="/property/<?=$tp['property'][1]['id'];?>">
									<ul class="mbm property-card-details">
										<li class="man pdb3">
											<div class="man property-title"><?=$tp['property'][1]['project']['name'];?></div>
										</li>
										<li class="man">
											<span class="property-price  mvn">฿ &nbsp;<?=number_format($tp['property'][1]['price']);?></span>
											<span class="property-size man noWrap pull-right"> <?=$tp['property'][1]['size'];?> <?=$tp['property'][1]['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
						
						<?php if( isset($tp['property'][2]) ) { ?>
						<div class="col-xs-12 col-sm-4 col-md-4 pd0">
							<div class="ml3" data-refid="<?=$tp['property'][2]['reference_id'];?>">
								<div class="prop_banner" style="background-image: url('<?=$tp['property'][2]['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull ml3" data-href="/property/<?=$tp['property'][2]['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable" data-href="/property/<?=$tp['property'][2]['id'];?>">
									<ul class="mbm property-card-details">
										<li class="man pdb3">
											<div class="man property-title"><?=$tp['property'][2]['project']['name'];?></div>
										</li>
										<li class="man">
											<span class="property-price  mvn">฿ &nbsp;<?=number_format($tp['property'][2]['price']);?></span>
											<span class="property-size man noWrap pull-right"> <?=$tp['property'][2]['size'];?> <?=$tp['property'][2]['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<?php } ?>
					
					</div>

					<div class="clearfix"></div>
					
					<?php if( isset($tp['property'][3]) ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-6 pd0">
						<div class="mgt3" data-refid="<?=$tp['property'][3]['reference_id'];?>">
							<div class="prop_banner_big" style="background-image: url('<?=$tp['property'][3]['picture']['url'];?>');"></div>
							<span class="overlayPhoto overlayFull mgt3" data-href="/property/<?=$tp['property'][3]['id'];?>"></span>
							<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable text-center b5p" data-href="/property/<?=$tp['property'][3]['id'];?>">
								<ul class="mbm property-card-details">
									<li class="pdb3">
										<div class="property-title2"><?=$tp['property'][3]['project']['name'];?></div>
									</li>
									<li class="">
										<span class="property-price2 ">฿ &nbsp;<?=number_format($tp['property'][3]['price']);?></span>
									</li>
									<li class="">
										<span class="property-size2  noWrap"><?=$tp['property'][3]['size'];?> <?=$tp['property'][3]['size_unit']['name'];?> </span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>	

					<?php if( isset($tp['property'][4]) ) { ?>
					<div class="col-xs-12 col-sm-6 col-md-6 pd0">
						<div class="ml3 mgt3" data-refid="<?=$tp['property'][4]['reference_id'];?>">
							<div class="prop_banner_big" style="background-image: url('<?=$tp['property'][4]['picture']['url'];?>');"></div>
							<span class="overlayPhoto overlayFull ml3 mgt3" data-href="/property/<?=$tp['property'][4]['id'];?>"></span>
							<div class="overlayTransparent overlayBottom typeReversed hpCardText clickable text-center b5p" data-href="/property/<?=$tp['property'][4]['id'];?>">
								<ul class="mbm property-card-details">
									<li class="pdb3">
										<div class="property-title2"><?=$tp['property'][4]['project']['name'];?></div>
									</li>
									<li class="">
										<span class="property-price2 ">฿ &nbsp;<?=number_format($tp['property'][4]['price']);?></span>
									</li>
									<li class="">
										<span class="property-size2  noWrap"><?=$tp['property'][4]['size'];?> <?=$tp['property'][4]['size_unit']['name'];?> </span>
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
			}
			?>

		</div>

	</div>	

</section>

<?php $this->import('/template/footer'); ?>