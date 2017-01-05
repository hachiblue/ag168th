<?php
$this->import('/layout/header');
$db = \Main\DB\Medoo\MedooFactory::getInstance();
$provinces = $db->select("province", "*");
$proptypes = $db->select("property_type", "*");
$requirement = $db->select("requirement", "*");

$projects = $db->select("project", ["id", "name", "province_id", "zone_id"]);

$zone = $db->select("zone", "*");
$province = $db->select("province", "*");

?>

<style>

    .al.start .allLetter{
        opacity: 0;
        -ms-transform: translateY(1000px);
        -webkit-transform: translateY(1000px);
        transform: translateY(1000px);
    }

    .al{

    }

    .allLetter{
        transition: 2s ease;
    }


    .interest{
        color: #FF0000;
        display: inline-block;
    }

    .letter{
        text-align: center;
        position: absolute;
        z-index: 10;
        margin-top: -450px;
        margin-left: 155px;
        color: #1957a4;
        transition: 2s;
        transition-delay: 0.04s;
    }

    .labelText {
        display: inline-block;
        width: 180px;
        text-align: left;
        vertical-align: top;
        margin-left: 50px;
    }

    .formRight{
        display: inline-block;
    }

    .formClass {
        padding-top: 10px;
        font-size: 18px;
    }

    .textareaClass {
        resize: none;
        width: 200px;
    }

    .selected{
        width: 200px;
    }
    .divRight {
        text-align: right;
        margin-top: 7px;
    }

    .textLetter{
        font-size: 24px;
    }

    .textLetter2{
        font-size: 16px;
    }

.chosen-container {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

.chosen-container .chosen-single {
	background: #fff;
	color:#333;
	padding: 0px;
	height: 24px;
}

.chosen-container .chosen-drop {
	background: #fff;
}

.chosen-container .chosen-drop li {
	color: #333;
    font-size: 12px;
}

.chosen-container .chosen-drop input {
	color: #333;
    font-size: 12px;
}

.chosen-container-single .chosen-single span {
   
    margin-top: -2px;
}

</style>


<form name='regis-form' method='post' action='' enctype="multipart/form-data">
<div class="container">

	<div class="row">
		<div class=" col-md-12 text-center" >
			<h2>Register Property</h2>
		</div>
	</div>
	<br>

	<div class="form-group row">
	  <label for="data-name" class="col-xs-1 col-form-label">Name</label>
	  <div class="col-xs-3">
	    <input class="form-control" type="text" value="" id="data-name" name="Name" required>
	  </div>

	  <label for="data-mobile" class="col-xs-1 col-form-label">Mobile Number</label>
	  <div class="col-xs-3">
	    <input class="form-control" type="text" value="" id="data-mobile" name="Mobile Number" required>
	  </div>

	  <label for="data-email" class="col-xs-1 col-form-label">Email, LineId</label>
	  <div class="col-xs-3">
	    <input class="form-control" type="text" value="" id="data-email" name="Email,LineId" required>
	  </div>

	</div>

	<div class="form-group row">
	  <label for="data-requirement" class="col-xs-1 col-form-label">Requirement</label>
	  <div class="col-xs-3">
	    <select class="form-control" id="data-requirement" name="Requirement">
			<option value=''> -- select -- </option>
			<?php foreach($requirement as $pt) {?>
			<option><?php echo $pt["name"];?></option>
			<?php }?>
		</select>
	  </div>

	  <label for="data-property_type" class="col-xs-1 col-form-label">Property Type</label>
	  <div class="col-xs-3">
	    <select class="form-control" id="data-property_type" name="Property Type">
	    	<option value=''> -- select -- </option>
			<?php foreach($proptypes as $pt) {?>
			<option><?php echo $pt["name"];?></option>
			<?php }?>
		</select>
	  </div>

	</div>


	<div class="form-group row">

		<label for="data-project" class="col-xs-1 col-form-label">Project</label>
		<div class="col-xs-3">
			<select class="form-control" id="data-project" name="Project Name">
				<option value=''> -- select -- </option>
				<?php foreach($projects as $project){?>
				<option><?php echo $project["name"];?></option>
				<?php }?>
			</select>
		</div>

		<label for="data-project_own" class="col-xs-1 col-form-label">Or</label>
		<div class="col-xs-3">
			<input class="form-control" type="text" value="" name="Project Name By Own" id="data-project_own" placeholder="Your Project Name">
		</div>

	</div>

	<div class="form-group row">

		<label for="data-zone" class="col-xs-1 col-form-label">Zone</label>
		<div class="col-xs-3">
			<input class="form-control" type="text" value="" id="data-zone" name="Zone">
		</div>

		<label for="data-province" class="col-xs-1 col-form-label">Province</label>
		<div class="col-xs-3">
			<input class="form-control" type="text" value="" id="data-province" name="Province">
		</div>

	</div>

	<div class="form-group row">

		<label for="data-size" class="col-xs-1 col-form-label">Size</label>
		<div class="col-xs-1">
			<input class="form-control" type="number" value="" id="data-size" name="Size">
		</div>
		<div class="col-xs-2">
			<select class="form-control size" id="data-size_unit" name="Size Unit" required>
    			<option>Sq. m.</option>
    			<option>Sq. wa</option>
    			<option>Rai</option>
  			</select>
		</div>	

		<label for="data-address" class="col-xs-1 col-form-label">Address No</label>
		<div class="col-xs-3">
			<input class="form-control" type="text" value="" id="data-address" name="Address">
		</div>

		<label for="data-unit" class="col-xs-1 col-form-label">Unit No</label>
		<div class="col-xs-3">
			<input class="form-control" type="text" value="" id="data-unit" name="Unit No">
		</div>

	</div>

	<div class="form-group row">

		<label for="data-floor" class="col-xs-1 col-form-label">Floor</label>
		<div class="col-xs-3">

			<input class="form-control" type="number" name="Floor" class="form-control" id="data-floor">

		</div>

		<label for="data-direction" class="col-xs-1 col-form-label">Direction</label>
		<div class="col-xs-3">
			<input class="form-control" type="text" value="" id="data-direction" name="Direction">
		</div>

	</div>

	<div class="form-group row">

		<label for="data-contract" class="col-xs-1 col-form-label">Contract Price</label>
		<div class="col-xs-3">
			<input class="form-control" type="number" value="" id="data-contract" name="Contract Price">
		</div>

		<label for="data-net" class="col-xs-1 col-form-label">Net Price</label>
		<div class="col-xs-3">
			<input class="form-control" type="number" value="" id="data-net" name="Net Price">
		</div>

		<label for="data-rental" class="col-xs-1 col-form-label">Rental Price</label>
		<div class="col-xs-3">
			<input class="form-control" type="number" value="" id="data-rental" name="Rental Price">
		</div>

	</div>

	<div class="form-group row">

		<label for="data-contract" class="col-xs-2 col-form-label">Upload a photo :</label>
		
		<div class="row" style="margin-bottom: 10px;float:left;">
			<div class="formRight">
				<div class="formRight formWidth ">
					<div>
						<a id="img-a1" class="btn btn-primary">SELECT FILE 1</a>
						<span id="img-name1"></span>
						<input type="file" name="image1" id="img-input1" style="display: none;" />
					</div>Allow .jpg .gif .png and Max file size per image is not 1Mb
				</div>
			</div>
		</div>

		<?php
		$i = 2;
		while( $i <= 9 )
		{
		?>
		<label for="data-contract" class="col-xs-2 col-form-label">&nbsp;</label>

		<div class="row" style="margin-bottom: 10px;float:left;">
			<div class="formRight">
				<div class="formRight formWidth ">
					<div>
						<a id="img-a<?php echo $i; ?>" class="btn btn-primary">SELECT FILE <?php echo $i; ?></a>
						<span id="img-name<?php echo $i; ?>"></span>
						<input type="file" name="image<?php echo $i; ?>" id="img-input<?php echo $i; ?>" style="display: none;" />
					</div>Allow .jpg .gif .png and Max file size per image is not 1Mb
				</div>
			</div>
		</div>
		<?php
			$i++;
		}
		?>

	</div>

	<div class="form-group row">

		<label for="data-contract" class="col-xs-2 col-form-label">Full Description :</label>
		<div class="col-md-8">
			<textarea name="Description" rows="4" class="form-control"></textarea>
		</div>
	</div>

	<div class="form-group row">
		<br><br>
		<div class="col-xs-12 text-center">
			<button href="#" class="btn btn-primary" type='submit'>Submit</button>
		</div>
	</div>
</div>
</form>

<br><br>

<script>


var projects = <?=json_encode($projects);?>;
var zone = <?=json_encode($zone);?>;
var province = <?=json_encode($province);?>;

$(document).ready(function() {

	$("#data-project").chosen({disable_search_threshold: 10});

	$("#data-project").change(function() {

		$('#data-zone').val('');
		$('#data-province').val('');

		for( i in projects )
		{
			if( projects[i].name == this.value )
			{
				if( undefined !== zone[projects[i].zone_id-1] ) $('#data-zone').val(zone[projects[i].zone_id-1].name);
				if( undefined !== province[projects[i].province_id-1] ) $('#data-province').val(province[projects[i].province_id-1].name);
				return false;
			}
		}

	});

	$("#data-requirement").change(function() {

		$('#data-net').prop('required', false);
		$('#data-rental').prop('required', false);

		if( 'For Sale' === this.value || 'For Sale/Rent' === this.value )
		{
			$('#data-net').prop('required', true);
		}

		if( 'For Rent' === this.value || 'For Sale/Rent' === this.value )
		{
			$('#data-rental').prop('required', true);
		}

		if( 'Sale With Tenant' === this.value )
		{
			$('#data-rental').prop('required', true);
			$('#data-net').prop('required', true);
		}
	});


	$('a[id^=img-a]').click(function(e) {
		var id = this.id.replace('img-a', '');
        $('#img-input'+id).click();
      });

	//var $imgName = $('[id^=img-name]');
	$('[id^=img-input]').change(function(e){
		var id = this.id.replace('img-input', '');
        try {
          var f = e.target.files[0];
          $('#img-name'+id).text(f.name);
        }
        catch (err) {
          $('#img-name'+id).text(f.name);
        }
      });

});

</script>

<?php
$this->import('/layout/footer');
?>
