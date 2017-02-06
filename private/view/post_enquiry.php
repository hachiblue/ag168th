<?php 
extract($params);
$this->import('/template/top-navbar'); 

?>

<section id="postEnquiryContainer" class="a_container">

<div class="container">

	<div class="mgt25 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0 bg-white">
			<li><a href="/home">Home</a></li>
			<li class="active">Your Enquiry</li>
		</ol>
	</div>
	
	<div class="lyp-form mgt30">
		<form action="" name="post_enquiry" method="post">

			<div class="lyp-form-header">
				<div class="bullet_1 flol mgt5"></div>
				<div class="flol mgl10  col-xs-10 no_padd">
					<div class="header-main">Your Enquiry</div>
					<div class="header-sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ea temporibus dolores.	</div>
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">
				
				<div class="enq-table table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>Client type</th>
								<th>For</th>
								<th>Project</th>
								<th>Zone</th>
								<th>Size</th>
								<th>Bedroom</th>
								<th>Bathroom</th>
								<th>Budget</th>
								<th>Property Consultant</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="seq">1.</td>
								<td>Individual</td>
								<td>Buy</td>
								<td>333riverside</td>
								<td>Bangsue, Toapoon</td>
								<td>48 Sqm.</td>
								<td>1 Bedroom</td>
								<td>1 Bathroom</td>
								<td>3,000,000 ฿ - 4,500,000 ฿</td>
								<td class="text-orange">jiphanu s. 089-654-8511</td>
							</tr>
						</tbody>
					</table>
				</div>

			</div>

			<div class="clearfix"></div>

			<div class="lyp-form-header mgt50">
				<div class="bullet_2 flol mgt5"></div>
				<div class="flol mgl10 col-xs-10 no_padd">
					<div class="header-main">Enquiry Details</div>
					<div class="header-sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ea temporibus dolores.	</div>
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">

				<div class="form-group col-md-3">
					<label for="client_type">Client Type</label>
					<div class="dropdown">
						<select class="form-control" id="client_type" name="client_type">
							<option value="" selected>Select Client Type</option>
						</select>
					</div>
				</div>

				<div class="form-group col-md-3">
					<label for="enquiry_type">Enquiry Type</label>
					<div class="dropdown">
						<select class="form-control" id="enquiry_type" name="enquiry_type">
							<option value="" selected>Select Enquiry Type</option>
						</select>
					</div>
				</div>

				<div class="form-group col-md-3">
					<label for="projectname">Project Name</label>
					<input type="text" class="form-control" id="auto-searchby" placeholder="Enter Project Name">
					<input type="hidden" class="form-control" id="projectname" name="projectname">
				</div>

				<div class="form-group col-md-3">
					<label for="zone">Zone</label>
					<input type="text" class="form-control" name="zone" id="zone" placeholder="eg. Phra Kanong, Silom etc.">
				</div>

			</div>

			<div class="row">
				<div class="form-group col-xs-12 col-md-3">

					<label for="zone">Size</label>
					<div>
						<div class="col-xs-5 col-md-5 no_padd"><input type="text" class="form-control" name="size" id="size" placeholder="0"></div>
						<div class="col-xs-6 col-md-6 col-xs-offset-1 col-md-offset-1 no_padd">
							<div class="dropdown">
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
				</div>
				<div class="form-group col-xs-12 col-md-3">
					<div class="col-xs-5 col-md-5 no_padd">
						<label for="bedroom">Bedroom</label>
						<select class="form-control" id="bedroom" name="bedroom">
							<option value="">1</option>
							<option value="">2</option>
							<option value="">3</option>
							<option value="">4</option>
							<option value="">5</option>
						</select>
					</div>
					<div class="col-xs-6 col-md-5 col-xs-offset-1 col-md-offset-2 no_padd">
						<label for="bedroom">Bathroom</label>
						<select class="form-control" id="bedroom" name="bedroom">
							<option value="">1</option>
							<option value="">2</option>
							<option value="">3</option>
							<option value="">4</option>
							<option value="">5</option>
						</select>
					</div>
				</div>
				
				<div class="form-group col-xs-12 col-md-6">
					<div class="col-xs-5 col-md-5 no_padd">
						<label for="budget_from">Budget</label>
						<input type="text" class="form-control" name="budget_from" id="budget_from" placeholder="0">
					</div>
					<div class="col-xs-2 col-md-2 no_padd">
						<label for="">&nbsp;</label>
						<div class="text-center">to</div>
					</div>
					<div class="col-xs-5 col-md-5  no_padd">
						<label for="budget_to">&nbsp;</label>
						<input type="text" class="form-control" name="budget_to" id="budget_to" placeholder="0">
					</div>
				</div>

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
				<button type="button" class="btn btn-searchred" onclick="alert('not available.');">Submit Enquiry</button>
			</div>
		
		</form>
	</div>


</div>

</section>

<?php $this->import('/template/footer'); ?>