<?php

session_start();

?>

<form ng-submit="submit()" ng-controller="AddCTL" id="form-edit-prop" ng-show="initSuccess" ng-init="isadmin = <?php echo json_encode($_SESSION['login']['level_id'] == 2 );?>;">

	<div class="row" id="tmpl-owner">

		<div class="col-sm-2 col-md-2 form-group">
			<label>ชื่อ - สกุล</label>
			<input class="form-control" ng-model="form.name" required>
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>ตำแหน่ง</label>
			<input class="form-control" ng-model="form.level">
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>ฝ่าย</label>
			<input class="form-control" ng-model="form.department">
		</div>

	</div>

	<div class="row">

		<div class="col-sm-1 col-md-1 form-group form-inline">
			<label><div>ขอลาในเวลาทำงาน</div><input type="checkbox" class="form-control" ng-model="form.request_leave_intime"> </label>
		</div>


		<div class="col-sm-1 col-md-1 form-group">
			<label>วันที่</label>
			<input class="form-control" ng-model="form.name" required>
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>เดือน</label>
			<input class="form-control" ng-model="form.level">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>พ.ศ.</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>ตั้งแต่เวลา (น.)</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>ถึงเวลา (น.)</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>รวมเป็นเวลา (ช.ม)</label>
			<div class="col-sm-6 col-md-6" style="padding: 0px;">
				<input class="form-control" ng-model="form.department">
			</div>
			<label> - นาที</label>
			<div class="col-sm-6 col-md-6">
				<input class="form-control" ng-model="form.department">
			</div>
		</div>

		<div class="clearfix"></div>

	</div>

	<div class="row">

		<div class="col-sm-1 col-md-1 form-group form-inline">
			<label><div>ขอลาหยุดตั้งแต่</div><input type="checkbox" class="form-control" ng-model="form.request_leave_intime"> </label>
		</div>


		<div class="col-sm-1 col-md-1 form-group">
			<label>วันที่</label>
			<input class="form-control" ng-model="form.name" required>
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>เดือน</label>
			<input class="form-control" ng-model="form.level">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>พ.ศ.</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>ถึงวันที่ </label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>เดือน</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-1 col-md-1 form-group">
			<label>พ.ศ.</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>รวมเป็นเวลา (วัน)</label>
			<input class="form-control" ng-model="form.department">
		</div>

		<div class="clearfix"></div>

	</div>


	<div class="row">
		<div class="col-md-12 form-group">
			<!-- <button class="btn btn-primary">Save</button> -->
			<a class="btn btn-info" href="#/">Back</a>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</div>
</form>


