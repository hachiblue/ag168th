<?php

session_start();

?>

<form ng-submit="submit()" ng-controller="EditCTL" id="form-edit-prop" layout="column" ng-cloak class="md-inline-form" ng-show="initSuccess">

	<md-content layout-padding>
		<div>
			<div layout-gt-xs="row">

				<md-input-container class="md-block" flex="20">
					<label>คำนำหน้า</label>
					<input ng-model="form.prefix">
				</md-input-container>

				<md-input-container class="md-block" flex>
					<label>ชื่อ</label>
					<input ng-model="form.name">
				</md-input-container>

				<md-input-container class="md-block" flex>
					<label>สกุล</label>
					<input ng-model="form.surname">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>ชื่อเล่น</label>
					<input ng-model="form.nickname">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">

				<div class="md-block" flex="20">
					<div class="h5 text-danger text-right" style="margin-top: 23px;margin-right: 15px;"> ( พิมพ์ภาษาอังกฤษ ) </div>
				</div>

				<md-input-container class="md-block" flex>
					<label>ชื่อ</label>
					<input ng-model="form.name_en">
				</md-input-container>

				<md-input-container class="md-block" flex>
					<label>สกุล</label>
					<input ng-model="form.surname_en">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>ชื่อเล่น</label>
					<input ng-model="form.nickname_en">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
			
				<md-input-container class="md-block" flex="20">
					<label>เกิดวันที่</label>
					<input ng-model="form.born_date">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>เดือน</label>
					<input ng-model="form.born_month">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>ปี</label>
					<input ng-model="form.born_year">
				</md-input-container>

				<!-- <div class="md-block" flex="20">
					<div class="h5 text-left text-primary" style="margin-top: 23px;margin-left: 35px;"> อายุ  <span>0</span> ปี </div>
				</div> -->

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="20">
					<label>บัตรประจำตัวประชาชนเลขที่</label>
					<input ng-model="form.idcard_number">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>ออกให้ ณ ( เขต, จังหวัด )</label>
					<input ng-model="form.idcard_place">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>วันที่ออกบัตร</label>
					<input ng-model="form.idcard_date">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>เดือน</label>
					<input ng-model="form.idcard_month">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>พ.ศ.</label>
					<input ng-model="form.idcard_year">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="40"></md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>บัตรหมดอายุวันที่</label>
					<input ng-model="form.idcard_exdate">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>เดือน</label>
					<input ng-model="form.idcard_exmonth">
				</md-input-container>

				<md-input-container class="md-block" flex="33">
					<label>พ.ศ.</label>
					<input ng-model="form.idcard_exyear">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="30">
					<label>บ้านเลขที่</label>
					<input ng-model="form.house_number">
				</md-input-container>

				<md-input-container class="md-block" flex="30">
					<label>หมู่บ้าน/คอนโด/โครงการ</label>
					<input ng-model="form.house_project">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>หมู่ที่</label>
					<input ng-model="form.house_group">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="30">
					<label>ซอย</label>
					<input ng-model="form.allay">
				</md-input-container>

				<md-input-container class="md-block" flex="30">
					<label>ถนน</label>
					<input ng-model="form.road">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>ตำบล/แขวง</label>
					<input ng-model="form.subdistrict">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="30">
					<label>อำเภอ/เขต</label>
					<input ng-model="form.district">
				</md-input-container>

				<md-input-container class="md-block" flex="30">
					<label>จังหวัด</label>
					<input ng-model="form.province">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>รหัสไปรษณีย์</label>
					<input ng-model="form.postcode">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="40">
					<label>โทรศัพท์บ้าน</label>
					<input ng-model="form.mobile_phone">
				</md-input-container>

				<md-input-container class="md-block" flex="40">
					<label>โทรศัพท์มือถือ</label>
					<input ng-model="form.home_phone">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="40">
					<label>บัญชีธนาคารกสิกรไทย เลขที่</label>
					<input ng-model="form.bank_account_number">
				</md-input-container>

				<md-input-container class="md-block" flex="40">
					<label>สาขา</label>
					<input ng-model="form.bank_account_branch">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="40">
					<label>ประเภทใบขับขี่</label>
					<input ng-model="form.license_type">
				</md-input-container>

				<md-input-container class="md-block" flex="40">
					<label>เลขที่ใบอนุญาตขับขี่</label>
					<input ng-model="form.license_number">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				<div class="col-md-12">
					
					<h3>ประหวัติการศึกษา</h3>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>ระดับการศึกษา</th>
								<th>สถาบันการศึกษา</th>
								<th>สาขาวิชา</th>
								<th>ตั้งแต่</th>
								<th>ถึง</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							while( $i <= 4 )
							{
								?>
							<tr>
								<td>
									<md-input-container class="md-block" flex="33">
										<label></label>
										<input ng-model="form.education_level<?=$i;?>">
									</md-input-container>
								</td>
								<td>
									<md-input-container class="md-block" flex="33">
										<label></label>
										<input ng-model="form.education_uni<?=$i;?>">
									</md-input-container>
								</td>
								<td>
									<md-input-container class="md-block" flex="33">
										<label></label>
										<input ng-model="form.education_major<?=$i;?>">
									</md-input-container>
								</td>
								<td>
									<md-input-container class="md-block" flex="33">
										<label></label>
										<input ng-model="form.education_start<?=$i;?>">
									</md-input-container>
								</td>	
								<td>
									<md-input-container class="md-block" flex="33">
										<label></label>
										<input ng-model="form.education_end<?=$i;?>">
									</md-input-container>
								</td>	
							</tr>
								<?php
								$i++;
							}
							?>
						</tbody>
					</table>	

				</div>
			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="40">
					<label>สถานภาพการสมรส</label>
					<input ng-model="form.issingle">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>มีบุตรจำนวณ (คน)</label>
					<input ng-model="form.kids">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="10">
					สถานะประกันสังคม
				</md-input-container>

				<md-input-container class="md-block" flex="20">
						<md-radio-group ng-model="form.insur">
							<md-radio-button value="1" class="md-primary"> มี </md-radio-button>
							<md-radio-button value="0"> ไม่มี </md-radio-button>
						</md-radio-group>
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>สิทธิอยู่ ณ โรงพยาบาล</label>
					<input ng-model="form.kids">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="20">
					บุคคลอ้างอิง/ญาติสนิท
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>1.</label>
					<input ng-model="form.ref_name1">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>ความสัมพันธ์</label>
					<input ng-model="form.ref_relate1">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>โทรศัพท์ติดต่อ</label>
					<input ng-model="form.ref_phone1">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				
				<md-input-container class="md-block" flex="20"></md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>2.</label>
					<input ng-model="form.ref_name2">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>ความสัมพันธ์</label>
					<input ng-model="form.ref_relate2">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>โทรศัพท์ติดต่อ</label>
					<input ng-model="form.ref_phone2">
				</md-input-container>

			</div>

			<div layout-gt-xs="row">
				<md-input-container class="md-block" flex="20">
					<label>วันเริ่มทำงาน</label>
					<input ng-model="form.start_date">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>เดือน</label>
					<input ng-model="form.start_month">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>พ.ศ.</label>
					<input ng-model="form.start_year">
				</md-input-container>
			</div>

			<div layout-gt-xs="row">
				<md-input-container class="md-block" flex="30">
					<label>ตำแหน่ง</label>
					<input ng-model="form.position">
				</md-input-container>

				<md-input-container class="md-block" flex="20">
					<label>ฝ่าย/แฝนก</label>
					<input ng-model="form.department">
				</md-input-container>
			</div>

			<div layout-gt-xs="row">
				<md-input-container class="md-block" flex="40">
					<label>เงินเดือน (แรกเข้า)</label>
					<input ng-model="form.salary">
				</md-input-container>
			</div>

			<div layout-gt-xs="row">
				<md-input-container class="md-block" flex="30">
					<label>เบอร์บริษัทที่ใช้อยู่ 1.</label>
					<input ng-model="form.phone_used1">
				</md-input-container>
				<md-input-container class="md-block" flex="30">
					<label>เบอร์บริษัทที่ใช้อยู่ 2.</label>
					<input ng-model="form.phone_used2">
				</md-input-container>
			</div>

		</div>

			
		<div layout-gt-sm="row">
			<button type="submit" class="btn btn-primary">Save</button>
		</div>

	</md-content>

</form>