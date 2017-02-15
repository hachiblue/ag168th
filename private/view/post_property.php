<?php 
extract($params);
$this->import('/template/top-navbar'); 

?>

<section id="postPropertyContainer" class="a_container">

<div class="lyp-banner">
	<div class="lyp-head">
		<div class="lyp-head-logo"></div>
		<div class="lyp-head-txt">Register Property</div>
	</div>
	<span class="overlayLowlight overlayBG overlayFull"></span>
</div>

<div class="container">

	<div class="mgt25 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0 bg-white">
			<li><a href="/home">Home</a></li>
			<li class="active">Your Property</li>
		</ol>
	</div>
	
	<div class="lyp-form mgt30">
		<form id="form-property" name="form-property" method="post" enctype="multipart/form-data">

			<div class="lyp-form-header">
				<div class="bullet_1 flol mgt5"></div>
				<div class="flol mgl10  col-xs-10 no_padd">
					<div class="header-main">Your Property</div>
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">

				<div class="enq-table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>Project</th>
								<th>Address no.</th>
								<th>Unit</th>
								<th>BLD.</th>
								<th>Floor</th>
								<th>Size</th>
								<th>Bedroom</th>
								<th>Bathroom</th>
								<th>Direction</th>
								<th>Contract price</th>
								<th>Net price</th>
								<th>Rent price</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach( $property as $i => $prop )
						{
							?>
							<tr>
								<td class="seq"><?=($i+1);?>.</td>
								<td><?=$prop['project']['name'];?></td>
								<td><?=$prop['address_no'];?></td>
								<td>n/a</td>
								<td>n/a</td>
								<td><?=$prop['floors'];?></td>
								<td><?=$prop['size'];?> <?=$prop['size_unit']['name'];?></td>
								<td><?=($prop['bedrooms'])?$prop['bedrooms']:'n/a';?></td>
								<td>n/a</td>
								<td>n/a</td>
								<td><?=number_format($prop['contract_price']);?> ฿</td>
								<td><?=number_format($prop['sell_price']);?> ฿</td>
								<td><?=number_format($prop['rent_price']);?> ฿</td>
								<td><a href="?edit=<?=$prop['id'];?>#property_detail"><button type="button" class="btn btn-sm btn-edit">edit</button></a></td>
							</tr>
							<?php
						}
							?>
						</tbody>
					</table>
				</div>

			</div>

			<div class="clearfix"></div>

			<div class="lyp-form-header mgt50" id="property_detail">
				<div class="bullet_2 flol mgt5"></div>
				<div class="flol mgl10 col-xs-10 no_padd">
					<div class="header-main">Property Details</div>
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">
				<div class="form-group col-md-6">
					<label for="auto-search_project">Project Name</label>
					<input type="text" class="form-control" id="auto-search_project" placeholder="Enter Project Name" required>
					<input type="hidden" class="form-control" id="project_id" name="project_id">
				</div>

				<div class="form-group col-md-3 hidden-xs">
					<label for="requirement">Requirement</label>
					<div class="dropdown">
						<select class="form-control" id="requirement_id" name="requirement_id">
							<option value="" selected>Select Property Requirement</option>
							<?php
							foreach( $requirement as $rq )
							{ ?>
								<option value="<?=$rq['id'];?>"><?=$rq['name'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group col-md-3 hidden-xs">
					<label for="property_type_id">Property Type</label>
					<div class="dropdown">
						<select class="form-control" id="property_type_id" name="property_type_id" required>
							<option value="" selected>Select Property Type</option>
							<?php
							foreach( $property_type as $pt )
							{ ?>
								<option value="<?=$pt['id'];?>"><?=$pt['name'];?></option>
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
					<select class="form-control" id="zone_id" name="zone_id">
						<option value="" selected>eg. Phra Kanong, Silom etc.</option>
						<?php
						foreach( $zone as $sn )
						{ ?>
							<option value="<?=$sn['id'];?>"><?=$sn['name'];?></option>
							<?php
						}
						?>
					</select>
				</div>

				<div class="form-group col-md-3 hidden-xs">
					<label for="province">Province</label>
					<div class="dropdown">
						<select class="form-control" id="province_id" name="province_id">
							<option>Select Province</option>
							<?php
							foreach( $province as $pv )
							{ ?>
								<option value="<?=$pv['id'];?>"><?=$pv['name'];?></option>
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
							<select class="form-control" id="size_unit_id" name="size_unit_id">
								<?php
								foreach( $size_unit as $sn )
								{ ?>
									<option value="<?=$sn['id'];?>"><?=$sn['name'];?></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group col-xs-6 col-md-2">
					<label for="address">Address No.</label>
					<input type="text" class="form-control" name="address_no" id="address_no" placeholder="eg. 9/34">
				</div>
				<div class="form-group col-md-2 hidden-xs">
					<label for="unit">Unit No.</label>
					<input type="text" class="form-control" name="unit" id="unit" placeholder="eg. A85">
				</div>
				<div class="form-group col-md-2 hidden-xs">
					<label for="floor">Floor</label>
					<input type="text" class="form-control" name="floors" id="floors" placeholder="0">
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
						<input type="text" class="form-control" name="sell_price" id="sell_price" placeholder="0" aria-describedby="addon2">
						<span class="input-group-addon" id="addon2">฿</span>
					</div>
				</div>
				<div class="form-group col-md-4 hidden-xs">
					<label for="rental_price">Rental Price</label>
					<div class="input-group">
						<input type="text" class="form-control" name="rent_price" id="rent_price" placeholder="0" aria-describedby="addon3">
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
						<textarea class="form-control" name="comment" id="comment" rows="8"></textarea>
					</div>
				</div>
			</div>

			<div class="lyp-button mgt10 text-center">
				<?php
				if( isset($_GET['edit']) && !empty($_GET['edit']) )
				{
					?>
					<button type="submit" class="btn btn-searchred">Save Property</button>
					<input type="hidden" name="property_id" id="property_id">
				<?php
				}
				else
				{
					?>
					<button type="submit" class="btn btn-searchred">Submit Property</button>
					<?php
				}
					?>
			</div>
		
		</form>
	</div>


</div>

</section>

<script type="text/javascript">
<!--

<?php
if( isset($_GET['edit']) && !empty($_GET['edit']) )
{
?>
	var e_property = <?=json_encode($e_property);?>;
<?php
}
?>

//-->
</script>

<?php $this->import('/template/footer'); ?>