<?php 
extract($params);
$this->import('/template/top-navbar'); 

?>

<section id="postEnquiryContainer" class="a_container">

<div class="lyp-banner">
	<div class="lyp-head">
		<div class="lyp-head-logo"></div>
		<div class="lyp-head-txt">Register Enquiry</div>
	</div>
	<span class="overlayLowlight overlayBG overlayFull"></span>
</div>

<div class="container">

	<div class="mgt25 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0 bg-white">
			<li><a href="/home">Home</a></li>
			<li class="active">Your Enquiry</li>
		</ol>
	</div>
	
	<div class="lyp-form mgt30">
		<form id="form-enquiry" name="enquiry" method="post">

			<div class="lyp-form-header">
				<div class="bullet_1 flol mgt5"></div>
				<div class="flol mgl10  col-xs-10 no_padd">
					<div class="header-main">Your Enquiry</div>
					<!-- <div class="header-sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ea temporibus dolores.	</div> -->
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
						<?php
						foreach( $enquiry as $i => $enq )
						{
							?>
							<tr>
								<td class="seq"><?=($i+1);?>.</td>
								<td><?=$enq['enquiry_type']['name'];?></td>
								<td><?=$enq['requirement']['name_for_enquiry'];?></td>
								<td><?=$enq['project']['name'];?></td>
								<td><?=$enq['zone']['name'];?></td>
								<td><?=$enq['size'];?> <?=$enq['size_unit']['name'];?>.</td>
								<td><?=$enq['bedroom'];?> Bedroom</td>
								<td>1 Bathroom</td>
								<td><?=number_format($enq['buy_budget_start']);?> ฿ - <?=number_format($enq['buy_budget_end']);?> ฿</td>
								<td class="text-orange"><?=$enq['sale']['name'];?> <?=$enq['sale']['phone'];?></td>
							</tr>
							<?php
						}
							?>
						</tbody>
					</table>
				</div>

			</div>

			<div class="clearfix"></div>

			<div class="lyp-form-header mgt50">
				<div class="bullet_2 flol mgt5"></div>
				<div class="flol mgl10 col-xs-10 no_padd">
					<div class="header-main">Enquiry Details</div>
					<!-- <div class="header-sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint ea temporibus dolores.	</div> -->
				</div>	
			</div>

			<div class="clearfix"></div>
		
			<div class="row mgt30">

				<div class="form-group col-md-3">
					<label for="enquiry_type_id">Client Type</label>
					<div class="dropdown">
						<select class="form-control" id="enquiry_type_id" name="enquiry_type_id" required>
							<option value="" selected>Select Client Type</option>
							<?php
							foreach( $enquiry_type as $sn )
							{ ?>
								<option value="<?=$sn['id'];?>"><?=$sn['name'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group col-md-3">
					<label for="requirement_id">Enquiry Type</label>
					<div class="dropdown">
						<select class="form-control" id="requirement_id" name="requirement_id" required>
							<option value="" selected>Select Enquiry Type</option>
							<?php
							foreach( $requirement as $sn )
							{ ?>
								<option value="<?=$sn['id'];?>"><?=$sn['name_for_enquiry'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group col-md-3">
					<label for="projectname">Project Name</label>
					<input type="text" class="form-control" id="auto-search_project" placeholder="Enter Project Name">
					<input type="hidden" class="form-control" id="project_id" name="project_id">
				</div>

				<div class="form-group col-md-3">
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

			</div>

			<div class="row">
				<div class="form-group col-xs-12 col-md-3">

					<label for="zone">Size</label>
					<div>
						<div class="col-xs-5 col-md-5 no_padd"><input type="text" class="form-control" name="size" id="size" placeholder="0"></div>
						<div class="col-xs-6 col-md-6 col-xs-offset-1 col-md-offset-1 no_padd">
							<div class="dropdown">
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
				</div>
				<div class="form-group col-xs-12 col-md-3">
					<div class="col-xs-5 col-md-5 no_padd">
						<label for="bedroom">Bedroom</label>
						<select class="form-control" id="bedroom" name="bedroom">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<div class="col-xs-6 col-md-5 col-xs-offset-1 col-md-offset-2 no_padd">
						<label for="bathroom">Bathroom</label>
						<select class="form-control" id="bathroom" name="bathroom">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>
				
				<div class="form-group col-xs-12 col-md-6">
					<div class="col-xs-5 col-md-5 no_padd">
						<label for="buy_budget_start">Budget</label>
						<input type="text" class="form-control" name="buy_budget_start" id="buy_budget_start" placeholder="0">
					</div>
					<div class="col-xs-2 col-md-2 no_padd">
						<label for="">&nbsp;</label>
						<div class="text-center">to</div>
					</div>
					<div class="col-xs-5 col-md-5  no_padd">
						<label for="buy_budget_end">&nbsp;</label>
						<input type="text" class="form-control" name="buy_budget_end" id="buy_budget_end" placeholder="0">
					</div>
				</div>

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
				<button type="submit" class="btn btn-searchred">Submit Enquiry</button>
			</div>
		
		</form>
	</div>


</div>

</section>

<?php $this->import('/template/footer'); ?>