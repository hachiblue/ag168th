<?php session_start();?>


<style type="text/css">

/* calendar */
table.calendar		{ border-left:1px solid #999; }
tr.calendar-row:not(:first-child) { height: 90px; }
tr.calendar-row	{  }
td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
td.calendar-day:hover	{ background:#eceff5; }
td.calendar-day-np	{ background:#eee; min-height:80px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { color: #fff; background: #009688; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
div.day-number		{ background:#999; padding:5px; color:#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; }
/* shared */
td.calendar-day, td.calendar-day-np { width:120px; padding:5px; border-bottom:1px solid #999; border-right:1px solid #999; }

.dialogdemoBasicUsage #popupContainer {
  position: relative; }

.dialogdemoBasicUsage .footer {
  width: 100%;
  text-align: center;
  margin-left: 20px; }

.dialogdemoBasicUsage .footer, .dialogdemoBasicUsage .footer > code {
  font-size: 0.8em;
  margin-top: 50px; }

.dialogdemoBasicUsage button {
  width: 200px; }

.dialogdemoBasicUsage div#status {
  color: #c60008; }

.dialogdemoBasicUsage .dialog-demo-prerendered md-checkbox {
  margin-bottom: 0; }

md-backdrop{
	position: fixed !important;
	background-color: #333 !important;
}

</style>

<div ng-controller="IndexCTL">

	<h2>Calendar Approve</h2>
	<br>
	<form ng-submit="submit()">
		   
		<div class="row">
			
			<div class="col-md-2 el-custom-1">
				<label>Month</label>
				<div>
					<select class="form-control" ng-model="form.month" required>
						<option value=""> -- select -- </option>
						<?php
						$i = 1;
						$max = 12;
						while( $i <= 12 )
						{
							echo '<option value="'.$i.'" '.$sel.'>'.date('M', strtotime('2017-'.$i.'-01')).'</option>';
							$i++;
						}
						
						?>
					</select>
				</div>
			</div>

			<div class="col-md-2 el-custom-1">
				<label>Year</label>
				<div>
					<select class="form-control" ng-model="form.year" required>
						<option value=""> -- select -- </option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
					</select>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Search</button>
				<button type="reset" class="btn btn-success">Reset</button>

				<!-- <a href="#add" class="btn btn-warning pull-right">Add</a> -->
			</div>

			<!-- <div class="col-md-6 text-right">
				<button class="btn btn-primary" ng-click="get_reportsale()">Report Sale</button>
			</div> -->

		</div>

	</form>

	
	<div class="">
		<br>
		
		<div class="col md-12" id="calendar"></div>

		<?php
		
		$month = date('m');
		$year = date('Y');

		if( isset($_GET['m']) )
		{
			$month = $_GET['m'];
		}

		if( isset($_GET['y']) )
		{
			$year = $_GET['y'];
		}

		?>
	</div>
	

</div>
