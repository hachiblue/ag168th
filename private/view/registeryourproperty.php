<?php 
extract($params);
$this->import('/template/top-navbar'); 

?>

<section id="listpropContainer" class="a_container">

<div class="lyp-banner">
	<div class="lyp-head">
		<div class="lyp-head-logo"></div>
		<div class="lyp-head-txt">Register Property</div>
	</div>
	<span class="overlayLowlight overlayBG overlayFull"></span>
</div>

<div class="container">

	<div class="mgt25 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0">
			<li><a href="/home">Home</a></li>
			<li class="active">List Your Property</li>
		</ol>
	</div>
	
	<div class="lyp-form mgt30">
		<form action="" name="regis_prop" method="post" enctype="multipart/form-data">

			<div class="lyp-form-header">
				<div class="bullet_1 flol mgt5"></div>
				<div class="flol mgl10  col-xs-10 no_padd">
					<div class="header-main">Contact Information</div>
					<!-- <div class="header-sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ea temporibus dolores.	</div> -->
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">
				<div class="form-group col-md-4">
					<label for="name">Name</label>
					<input type="text" class="form-control" id="name" placeholder="Your Name" required>
				</div>

				<div class="form-group col-md-4">
					<label for="phone">Phone Number</label>
					<input type="text" class="form-control" id="phone" placeholder="Phone Number" required>
				</div>

				<div class="form-group col-md-4">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" placeholder="Your Email" required>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="lyp-form-header mgt50">
				<div class="bullet_2 flol mgt5"></div>
				<div class="flol mgl10 col-xs-10 no_padd">
					<div class="header-main">Contact Information</div>
					<!-- <div class="header-sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ea temporibus dolores.	</div> -->
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">
				<div class="form-group col-md-6">
					<label for="projectname">Project Name</label>
					<input type="text" class="form-control" id="auto-searchby" placeholder="Enter Project Name">
					<input type="hidden" class="form-control" id="projectname" name="projectname">
				</div>

				<div class="form-group col-md-3 hidden-xs">
					<label for="requirement">Requirement</label>
					<div class="dropdown">
						<select class="form-control" id="requirement" name="requirement">
							<option value="" selected>Select Property Requirement</option>
							<?php
							foreach( $requirement as $rq )
							{ ?>
								<option value="<?=$rq['name'];?>"><?=$rq['name'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group col-md-3 hidden-xs">
					<label for="propertytype">Property Type</label>
					<div class="dropdown">
						<select class="form-control" id="propertytype" name="propertytype">
							<option value="" selected>Select Property Type</option>
							<?php
							foreach( $property_type as $pt )
							{ ?>
								<option value="<?=$pt['name'];?>"><?=$pt['name'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label for="zone">Zone</label>
					<input type="text" class="form-control" name="zone" id="zone" placeholder="eg. Phra Kanong, Silom etc.">
				</div>

				<div class="form-group col-md-3 hidden-xs">
					<label for="province">Province</label>
					<div class="dropdown">
						<select class="form-control" id="province" name="province">
							<option>Select Province</option>
							<?php
							foreach( $province as $pv )
							{ ?>
								<option value="<?=$pv['name'];?>"><?=$pv['name'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-xs-6 col-md-2">

					<label for="zone">Size</label>
					<div>
						<div class="col-xs-5 col-md-5 no_padd"><input type="text" class="form-control" name="size" id="size" placeholder="0"></div>
						<div class="col-xs-6 col-md-6 col-xs-offset-1 col-md-offset-1 no_padd">
							<select class="form-control" id="size_unit" name="size_unit">
								<?php
								foreach( $size_unit as $sn )
								{ ?>
									<option value="<?=$sn['name'];?>"><?=$sn['name'];?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group col-xs-6 col-md-2">
					<label for="address">Address No.</label>
					<input type="text" class="form-control" name="address" id="address" placeholder="eg. 9/34">
				</div>
				<div class="form-group col-md-2 hidden-xs">
					<label for="unit">Unit No.</label>
					<input type="text" class="form-control" name="unit" id="unit" placeholder="eg. A85">
				</div>
				<div class="form-group col-md-2 hidden-xs">
					<label for="floor">Floor</label>
					<input type="text" class="form-control" name="floor" id="floor" placeholder="0">
				</div>
				<div class="form-group col-md-4 hidden-xs">
					<label for="direction">Direction</label>
					<input type="text" class="form-control" name="direction" id="direction" placeholder="0">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-4">
					<label for="contract_price">Contract Price</label>
					<div class="input-group">
						<input type="text" class="form-control" name="contract_price" id="contract_price" placeholder="0" aria-describedby="addon1">
						<span class="input-group-addon" id="addon1">฿</span>
					</div>
				</div>
				<div class="form-group col-md-4 hidden-xs">
					<label for="net_price">Net Price</label>
					<div class="input-group">
						<input type="text" class="form-control" name="net_price" id="net_price" placeholder="0" aria-describedby="addon2">
						<span class="input-group-addon" id="addon2">฿</span>
					</div>
				</div>
				<div class="form-group col-md-4 hidden-xs">
					<label for="rental_price">Rental Price</label>
					<div class="input-group">
						<input type="text" class="form-control" name="rental_price" id="rental_price" placeholder="0" aria-describedby="addon3">
						<span class="input-group-addon" id="addon3">฿</span>
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>

			<div class="bg-white">
				<input id="image_file" name="image[]" type="file" multiple class="file-loading">
			</div>
			
			<div class="clearfix"></div>
 
			<div class="row mgt20">
				<div class="form-group col-md-12">
					<label for="description">Full Description</label>
					<div class="input-group full-width">
						<textarea class="form-control" name="description" id="description" rows="8"></textarea>
					</div>
				</div>
			</div>

			<div class="lyp-button mgt10 text-center">
				<button class="btn btn-searchred">Submit Property</button>
			</div>
		
		</form>
	</div>


</div>

</section>

<?php $this->import('/template/footer'); ?>