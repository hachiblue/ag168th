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

	<h2>On Leave Manage</h2>
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

				<a href="#add" class="btn btn-warning pull-right">Add</a>
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

<?php

function draw_calendar($month, $year)
{
	/* draw table */
	$calendar = '<table class="table calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

?>


<script type="text/javascript">
<!--
	

//-->
</script>