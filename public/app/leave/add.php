<?php

session_start();

?>
<form ng-submit="submit()" ng-controller="AddCTL" id="form-edit-prop" layout="column" ng-cloak class="md-inline-form" ng-show="initSuccess" enctype="multipart/form-data">

	<md-content layout-padding>
		<div>
			<div layout-gt-xs="row">
				<md-input-container class="md-block" flex>
					<label>ชื่อ - สกุล</label>
					<input ng-model="form.account_name">
				</md-input-container>

				<md-input-container class="md-block" flex>
					<label>ตำแหน่ง</label>
					<md-select ng-model="form.level_id">
						<md-option ng-repeat="level in levels" value="{{level.va}}">
							{{level.abbrev}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block" flex>
					<label>Approver</label>
					<md-select ng-model="form.rq_approve_id" required>
						<md-option ng-repeat="account in accounts" value="{{account.va}}">
							{{account.abbrev}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block" flex>
					<label>ฝ่าย</label>
					<input ng-model="form.department">
				</md-input-container>

			</div>

			<div layout-gt-sm="row">

				<div>
					<md-input-container class="md-block" flex>
						<md-checkbox name="tos" ng-model="form.late_flag" ng-true-value="'y'" ng-false-value="'n'" style="margin: 4px 0 18px;">
							มาสาย
						</md-checkbox>
					</md-input-container>
				</div>

			</div>

			<div layout-gt-sm="row">

				<div>
					<md-input-container class="md-block" flex>
						<md-checkbox name="tos" ng-model="form.rqshift_flag" ng-true-value="'y'" ng-false-value="'n'" style="margin: 4px 0 18px;">
							ขอลาในเวลาทำงาน
						</md-checkbox>
					</md-input-container>
				</div>

				<md-input-container>
					<label>วันที่ลา</label>
					<md-datepicker ng-model="form.rqshift_date"></md-datepicker>
				</md-input-container>

				<md-input-container class="md-block">
					<label>ตั้งแต่เวลา (น.)</label>
					<md-select ng-model="form.f_hours">
						<md-option ng-repeat="hour in hours" value="{{hour}}">
							{{hour}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block">
					<label>นาที</label>
					<md-select ng-model="form.f_minutes">
						<md-option ng-repeat="minute in minutes" value="{{minute}}">
							{{minute}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block">
					<label>ถึงเวลา (น.)</label>
					<md-select ng-model="form.t_hours">
						<md-option ng-repeat="hour in hours" value="{{hour}}">
							{{hour}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block">
					<label>นาที</label>
					<md-select ng-model="form.t_minutes">
						<md-option ng-repeat="minute in minutes" value="{{minute}}">
							{{minute}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block">
					<label>รวมเป็นเวลา</label>
					<md-select ng-model="form.total_time_hours">
						<md-option ng-repeat="hour in hours" value="{{hour}}">
							{{hour}}
						</md-option>
					</md-select>
				</md-input-container>

				<md-input-container class="md-block">
					<label>นาที</label>
					<md-select ng-model="form.total_time_minutes">
						<md-option ng-repeat="minute in minutes" value="{{minute}}">
							{{minute}}
						</md-option>
					</md-select>
				</md-input-container>

			</div>

			<div layout-gt-sm="row">

				<div>
					<md-input-container class="md-block" flex>
						<md-checkbox name="rqperiod_flag" ng-model="form.rqperiod_flag" ng-true-value="'y'" ng-false-value="'n'" style="margin: 4px 0 18px;">
							ขอลาหยุด
						</md-checkbox>
					</md-input-container>
				</div>

				<md-input-container>
					<label>ตั้งแต่วันที่</label>
					<md-datepicker ng-model="form.rqperiod_from_date"></md-datepicker>
				</md-input-container>

				<md-input-container>
					<label>ถึงวันที่</label>
					<md-datepicker ng-model="form.rqperiod_to_date"></md-datepicker>
				</md-input-container>

				<md-input-container class="md-block">
					<label>รวมเป็นเวลา (วัน)</label>
					<input ng-model="form.rqperiod_total_day">
				</md-input-container>

			</div>

			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th>ประเภทของการลาหยุด</th>
							<th>เหตุผลที่ลาหยุด</th>
							<th>หมายเหตุ</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="width: 225px;">
								<div>
									<md-input-container class="md-block">
										<md-checkbox name="lv_vacation_flag" ng-model="form.lv_vacation_flag" ng-true-value="'y'" ng-false-value="'n'" >
											พักร้อน
										</md-checkbox>
									</md-input-container>
								</div>
							</td>
							<td>
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_vacation_reason" md-maxlength="150" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
							<td style="width: 250px;">
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_vacation_ps" md-maxlength="50" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<md-input-container class="md-block">
										<md-checkbox name="lv_personal_flag" ng-model="form.lv_personal_flag" ng-true-value="'y'" ng-false-value="'n'" >
											ลากิจ
										</md-checkbox>
									</md-input-container>
								</div>
							</td>
							<td>
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_personal_reason" md-maxlength="150" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
							<td style="width: 250px;">
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_personal_ps" md-maxlength="50" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<md-input-container class="md-block">
										<md-checkbox name="lv_sick_flag" ng-model="form.lv_sick_flag" ng-true-value="'y'" ng-false-value="'n'" >
											ลาป่วย
										</md-checkbox>
									</md-input-container>
								</div>
							</td>
							<td>
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_sick_reason" md-maxlength="150" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
							<td style="width: 250px;">
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_sick_ps" md-maxlength="50" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<md-input-container class="md-block">
										<md-checkbox name="lv_etc_flag" ng-model="form.lv_etc_flag" ng-true-value="'y'" ng-false-value="'n'" >
											อื่นๆ
										</md-checkbox>
									</md-input-container>
									<md-input-container class="md-block">
										<label>ระบุ</label>
										<input ng-model="form.lv_etc_desc">
									</md-input-container>
								</div>
							</td>
							<td>
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_etc_reason" md-maxlength="150" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
							<td style="width: 250px;">
								<md-input-container class="md-block">
									<label></label>
									<textarea ng-model="form.lv_etc_ps" md-maxlength="50" rows="4" md-select-on-focus></textarea>
								</md-input-container>
							</td>
						</tr>
						<tr>
							<td style="border: none;">
								<div>
									<label>เอกสารประกอบ ( เป็นรูปภาพ )</label>
								    <input type="file" multiple onchange="angular.element(this).scope().parseImagesInput(this);" accept="image/*">
									
								</div>
							</td>
						</tr>
					</tbody>
				</table>


			</div>



		</div>


		<div layout-gt-sm="row">
			<!-- <button class="btn btn-primary">Save</button> -->
			<a class="btn btn-info" href="#/">Back</a>
			<button type="submit" class="btn btn-primary">Save</button>
			<button type="button" class="btn btn-danger" ng-click="remove(form.id)">Delete</button>
		</div>

	</md-content>

</form>
