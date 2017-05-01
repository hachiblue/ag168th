
<?php 
extract($params);
$this->import('/template/top-navbar'); 

?>

<section id="highlightContainer" class="a_container">

	<div class="">
		
		<div class="col-md-12 rightContain pdl5">
		
			<div class="box mgt25">
				<div class="headline">
					<div class="mt20"><?=$topics['name'];?>
					</div>
				</div>
				<?php
				$ck_topic = array_chunk($topics['property'], 9);
				?>
				
				<div class="hl-left col-md-6 pdr0">
					
					<?php
					$reset = 1;
					$count = 0;
					foreach( $ck_topic[0] as $lft_prop )
					{
						if( $reset == 1 )
						{
							$reset = 0;
							$randId = rand(2, 3);
						}

						if( $randId == 2 )
						{
							$sm_col = 'col-sm-6';
							$md_col = 'col-sm-6';
							$prop_banner = 'prop_banner_big';
							$title_class = 'property-title2';
							$price_class = 'property-price2';
							$size_class = 'property-size2';
							$mvn = '';
							$man = '';
							$pull_right = '';
							$txt_center = 'text-center';
							$newLI = '</li><li>';
						}
						else
						{	
							$sm_col = 'col-sm-4';
							$md_col = 'col-sm-4';
							$prop_banner = 'prop_banner';
							$title_class = 'property-title';
							$price_class = 'property-price';
							$size_class = 'property-size';
							$mvn = 'mvn';
							$man = 'man';
							$pull_right = 'pull-right';
							$txt_center = '';
							$newLI = '';
						}

						$count++;

						if( $count == $randId )
						{
							$count = 0;
							$reset = 1;
						}
					?>
						
						<div class="col-xs-12 <?=$sm_col;?> <?=$md_col;?> hl-box pd0">
							<div class="" data-refid="<?=$lft_prop['reference_id'];?>">
								<div class="<?=$prop_banner;?>" style="background-image: url('<?=$lft_prop['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull mg0" data-href="/property/<?=$lft_prop['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText <?=$txt_center;?> clickable" data-href="/property/<?=$lft_prop['id'];?>">
									<ul class="mbm property-card-details">
										<li class="<?=$man;?> pdb3">
											<div class="<?=$man;?> <?=$title_class;?>"><?=$lft_prop['project']['name'];?></div>
										</li>
										<li class="<?=$man;?>">
											<span class="<?=$price_class;?> <?=$mvn;?>">฿ &nbsp;<?=number_format($lft_prop['price']);?></span>
											<?=$newLI;?>
											<span class="<?=$size_class;?> <?=$man;?> noWrap <?=$pull_right;?>"> <?=$lft_prop['size'];?> <?=$lft_prop['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<?php 
					} ?>

				</div>
				
				<?php
				if( isset($ck_topic[1]) )
				{
					?>
				<div class="hl-right col-md-6 pdl0">
					
					<?php
					$reset = 1;
					$count = 0;
					foreach( $ck_topic[1] as $lft_prop )
					{
						if( $reset == 1 )
						{
							$reset = 0;
							$randId = rand(2, 3);
						}

						if( $randId == 2 )
						{
							$sm_col = 'col-sm-6';
							$md_col = 'col-sm-6';
							$prop_banner = 'prop_banner_big';
							$title_class = 'property-title2';
							$price_class = 'property-price2';
							$size_class = 'property-size2';
							$mvn = '';
							$man = '';
							$pull_right = '';
							$txt_center = 'text-center';
							$newLI = '</li><li>';
						}
						else
						{	
							$sm_col = 'col-sm-4';
							$md_col = 'col-sm-4';
							$prop_banner = 'prop_banner';
							$title_class = 'property-title';
							$price_class = 'property-price';
							$size_class = 'property-size';
							$mvn = 'mvn';
							$man = 'man';
							$pull_right = 'pull-right';
							$txt_center = '';
							$newLI = '';
						}

						$count++;

						if( $count == $randId )
						{
							$count = 0;
							$reset = 1;
						}
					?>
						
						<div class="col-xs-12 <?=$sm_col;?> <?=$md_col;?> hl-box pd0">
							<div class="" data-refid="<?=$lft_prop['reference_id'];?>">
								<div class="<?=$prop_banner;?>" style="background-image: url('<?=$lft_prop['picture']['url'];?>');"></div>
								<span class="overlayPhoto overlayFull mg0" data-href="/property/<?=$lft_prop['id'];?>"></span>
								<div class="overlayTransparent overlayBottom typeReversed hpCardText <?=$txt_center;?> clickable" data-href="/property/<?=$lft_prop['id'];?>">
									<ul class="mbm property-card-details">
										<li class="<?=$man;?> pdb3">
											<div class="<?=$man;?> <?=$title_class;?>"><?=$lft_prop['project']['name'];?></div>
										</li>
										<li class="<?=$man;?>">
											<span class="<?=$price_class;?> <?=$mvn;?>">฿ &nbsp;<?=number_format($lft_prop['price']);?></span>
											<?=$newLI;?>
											<span class="<?=$size_class;?> <?=$man;?> noWrap <?=$pull_right;?>"> <?=$lft_prop['size'];?> <?=$lft_prop['size_unit']['name'];?> </span>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<?php 
					} ?>

				</div>
				<?php
				}
				?>

			</div>
		
			<div class="clearfix"></div>
		
		</div>

	</div>	

</section>
	
<?php $this->import('/template/footer'); ?>