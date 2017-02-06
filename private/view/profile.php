<?php 
extract($params);
$this->import('/template/top-navbar'); 

?>

<section id="profileContainer" class="a_container">

<div class="container">

	<div class="mgt25 hidden-xs hidden-sm">
		<ol class="breadcrumb pd0 bg-white">
			<li><a href="/home">Home</a></li>
			<li class="active">Profile</li>
		</ol>
	</div>
	
	<div class="lyp-form mgt30 mgb30">

		<div class="col-md-3">
			<div id="kv-avatar-errors-1" class="center-block" style="display:none"></div>
			<form class="text-center" action="/member/upload_picture" method="post" enctype="multipart/form-data">
				<div class="kv-avatar center-block" style="width:200px">
					<input id="pf-picture" name="pf-picture" type="file" class="file-loading">
				</div>
				<input type="hidden" name="pf-id" value="">
				<!-- include other inputs if needed and include a form submit (save) button -->
			</form>
		</div>
		<div class="col-md-9">

			<div class="lyp-form-header tab_profile">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
					<li role="presentation"><a href="#change_password" aria-controls="change_password" role="tab" data-toggle="tab">Change Password</a></li>
				</ul>
			</div>

			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="profile">
					<form class="" id="form-profile" action="/member/update_profile" method="post">
						<div class="mgt30">
							<div class="form-group col-md-6">
								<label for="pf-name">Name * </label>
								<input type="text" class="form-control" id="pf-name" name="name" value="<?=$profile['name'];?>" placeholder="Name" required>
							</div>
							<div class="form-group col-md-6">
								<label for="pf-surname">Surname * </label>
								<input type="text" class="form-control" id="pf-surname" name="surname" value="<?=$profile['surname'];?>" placeholder="Surname" required>
							</div>

							<div class="form-group col-md-6">
								<label for="pf-email">Email * </label>
								<input type="email" class="form-control" id="pf-email" name="email" value="<?=$profile['email'];?>" placeholder="Email" required>
							</div>
							<div class="form-group col-md-6">
								<label for="pf-line">Line</label>
								<input type="text" class="form-control" id="pf-line" name="line" value="<?=$profile['line'];?>" placeholder="Line">
							</div>

							<div class="form-group col-md-6">
								<label for="pf-phone">Mobile Phone * </label>
								<input type="text" class="form-control" id="pf-phone" name="phone" value="<?=$profile['phone'];?>" placeholder="Mobile Phone" required>
							</div>

							<div class="clearfix"></div>

							<div class="form-group col-md-12">
								<label for="pf-phone">Address</label>
								<textarea class="form-control" id="pf-address" name="address" placeholder="Address"><?=$profile['address'];?></textarea>
							</div>
							
							<div class="clearfix"></div>

							<div class="lyp-button mgt10 text-center">
								<button type="submit" class="btn btn-searchred">Save</button>
							</div>
						</div>
					</form>
				</div>

				<div role="tabpanel" class="tab-pane" id="change_password">
					<form class="" id="form-chg_password" action="/member/change_password" method="post">
						<div class="mgt30">
							<div class="form-group col-md-6">
								<label for="pf-oldpassword">Old Password * </label>
								<input type="password" class="form-control" id="pf-oldpassword" name="old_password" placeholder="Old Password" required>
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<label for="pf-newpassword">New Password * </label>
								<input type="password" class="form-control" id="pf-newpassword" name="new_password" placeholder="New Password" required>
							</div>
							<div class="clearfix"></div>
							<div class="form-group col-md-6">
								<label for="pf-repassword">Re-Password * </label>
								<input type="password" class="form-control" id="pf-repassword" name="re_password" placeholder="Re-Password" required>
							</div>

							<div class="clearfix"></div>

							<div class="lyp-button mgt10 text-center">
								<button class="btn btn-searchred">Save</button>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="clearfix"></div>
		
			

		</div>

		<div class="clearfix"></div>
		
	</div>


</div>

</section>

<script type="text/javascript">
<!--
	
var profile_picture = '<?=$_SESSION["member"]["picture"];?>';

//-->
</script>

<?php $this->import('/template/footer'); ?>