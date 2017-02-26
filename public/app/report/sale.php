<?php session_start();?>

<div ng-controller="SaleCTL">

	<form ng-submit="getSaleReport(1)">
		   
		<div class="row">

			<div class="col-md-3 form-group">
				<label class="control-label">Sale</label>
				<div>
					<select class="form-control"
						ng-model="form.sale_id"
						ng-options="item.id*1 as item.name for item in sale.data"
					>
					<option value="">All</option>
					</select>
				</div>
			</div>
			
			<div class="col-md-3 el-custom-1">
				<label>Month</label>
				<div>
					<select class="form-control" ng-model="form.month" required>
						<option value=""> -- select -- </option>
						<?php
						$i = 1;
						$max = 12;
						while( $i <= 12 )
						{
							echo '<option value="'.$i.'">'.date('M', strtotime('2017-'.$i.'-01')).'</option>';
							$i++;
						}
						
						?>
					</select>
				</div>
			</div>

			<div class="col-md-3 el-custom-1">
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
			
		<div class="row" style="display:none;">
		  <div class="col-md-2 el-custom-1">
			<label>Order By</label>
			<select ng-model="form.orderBy" ng-init="form.orderBy='updated_at'" class="form-control">
				<option value="updated_at">Updated at</option>
			</select>
		  </div>
		  <div class="col-md-2 el-custom-1">
			<label></label>
			<select ng-model="form.orderType" ng-init="form.orderType='DESC'" class="form-control">
				<option value="DESC">max -> min</option>
				<option value="ASC">min -> max</option>
			</select>
		  </div>
		</div>

		<div class="row">

			<div class="col-md-6">
				<button type="submit" class="btn btn-success">Search</button>
				<button type="reset" class="btn btn-success">Reset</button>
				<span ng-if="isShowTotal()">Search total: {{lists.total}} item</span>
			</div>

			<!-- <div class="col-md-6 text-right">
				<button class="btn btn-primary" ng-click="get_reportsale()">Report Sale</button>
			</div> -->

		</div>

	</form>

	<table class="table table-striped table-hover text-center" style="border-top: 2px solid #ddd;
    border-left: 2px solid #ddd;">
		<thead>
			<tr>
				<th rowspan='2' style="border-right:2px solid #ddd;vertical-align: middle;">#</th>
				<th rowspan='2' style="border-right:2px solid #ddd;vertical-align: middle;">Property Consultant</th>
				<th rowspan='2' style="border-right:2px solid #ddd;vertical-align: middle;">Case</th>
				<th colspan='6' class="text-center" style="border-right:2px solid #ddd;">Follow up</th>
				<th colspan='4' class="text-center" style="border-right:2px solid #ddd;">FAIL</th>

				<th rowspan='2' class="text-center" style="border-right:2px solid #ddd;vertical-align: middle;">Success</th>
				<th rowspan='2' class="text-center" style="border-right:2px solid #ddd;vertical-align: middle;">Grand Total</th>
				<th rowspan='2' class="text-center" style="border-right:2px solid #ddd;vertical-align: middle;">Touring</th>
				<th colspan='2' class="text-center" style="border-right:2px solid #ddd;vertical-align: middle;">TYPE</th>
				<th colspan='2' class="text-center" style="border-right:2px solid #ddd;vertical-align: middle;">Statistic</th>
			</tr>
			<tr>
				<th style="border-right:2px solid #ddd;">5%</th>
				<th style="border-right:2px solid #ddd;">10%</th>
				<th style="border-right:2px solid #ddd;">25%</th>
				<th style="border-right:2px solid #ddd;">50%</th>
				<th style="border-right:2px solid #ddd;">Potential</th>
				<th style="border-right:2px solid #ddd;">Total</th>
				<th style="border-right:2px solid #ddd;">Ignore</th>
				<th style="border-right:2px solid #ddd;">Fail</th>
				<th style="border-right:2px solid #ddd;">Checked</th>
				<th class="text-center" style="border-right:2px solid #ddd;">Total</th>
				<th class="text-center" style="border-right:2px solid #ddd;">Buy</th>
				<th class="text-center" style="border-right:2px solid #ddd;">Rent</th>
				<th class="text-center" style="border-right:2px solid #ddd;">Percentage of Failure</th>
				<th class="text-center" style="border-right:2px solid #ddd;">Percantage of success</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="list in lists.data ">
				<td>{{$index + 1}}</td>
				<td>{{list.name}}</td>
				<td>{{list.all_case}}</td>
				<td>{{list.f5percent}}</td>
				<td>{{list.f10percent}}</td>
				<td>{{list.f25percent}}</td>
				<td>{{list.f50percent}}</td>
				<td>{{list.potential}}</td>
				<td>{{list.followup_total}}</td>
				<td>{{list.ignore}}</td>
				<td>{{list.fail}}</td>
				<td>{{list.checked}}</td>
				<td>{{list.fail_total}}</td>
				<td>{{list.success}}</td>
				<td>{{list.grand_total}}</td>
				<td>{{list.potential}}</td>
				<td>{{list.buy}}</td>
				<td>{{list.rent}}</td>
				<td>{{list.fail_percentage}}</td>
				<td>{{list.success_percentage}}</td>
			</tr>
		</tbody>
	</table>

</div>