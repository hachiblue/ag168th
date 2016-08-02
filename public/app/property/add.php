<?php
session_start();
// if(!(@$_SESSION['login']['level_id'] <= 2 && @$_SESSION['login']['level_id'] > 0)) {
//   return "";
// }
?>
<form ng-submit="submit()" ng-controller="AddCTL" id="form-edit-prop" ng-show="initSuccess">

	<div class="row" id="tmpl-owner">

		<div class="col-sm-2 col-md-2 form-group">
			<label>Owner Name</label>
			<input class="form-control" ng-model="form.owner_name1" pattern="[^\,.]+" required>
			<!-- <input class="form-control" disabled="disabled" value="ปิดไว้จนกว่าจะเสร็จ"> -->
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>Owner Phone</label>
			<input class="form-control" ng-model="form.owner_phone1" pattern="[^\,.]+" required>
			<!-- <input class="form-control" disabled="disabled" value="ปิดไว้จนกว่าจะเสร็จ"> -->
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>Customer VIP</label>
			<input class="form-control" ng-model="form.owner_cust1">
			<!-- <input class="form-control" disabled="disabled" value="ปิดไว้จนกว่าจะเสร็จ"> -->
		</div>

		<div class="col-sm-2 col-md-2 form-group">
			<label>&nbsp;</label>
			<div style="cursor:pointer;" ng-click="addmore_owner();"><i class="fa fa-plus" aria-hidden="true"></i></div>
		</div>

	</div>

	<div id="moreowner" ng-bind-html="moreowner"></div>


  <div class="row">
    <fieldset>

		<div class="col-md-3 form-group">
		  <label>Status</label>
		  <select class="form-control"
		  ng-model="form.property_status_id"
		  ng-change="formPropertyStatusIdChange()"
		  ng-options="item.id*1 as item.name for item in collection.property_status"
		  required>
			  <option value="">Please select</option>
		  </select>
		</div>


      <div class="col-md-3 form-group">
        <label>Property Type</label>
        <select class="form-control"
        ng-model="form.property_type_id"
        ng-options="item.id as item.name for item in collection.property_type"
        ng-change="formPropertyTypeChange()"
        required>
            <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>Project</label>
        <select class="form-control"
        ng-model="form.project_id"
        ng-options="item.id*1 as item.name for item in collection.project"
        ng-change="formProjectIdChange()"
        id="project_id">
            <option value="">-None-</option>
        </select>
      </div>

	  <div class="col-md-3 form-group">
        <label>Size</label>
        <div class="row">
          <div class="col-md-6">
            <input ng-model="form.size" class="form-control">
          </div>
          <div class="col-md-6">
            <select ng-model="form.size_unit_id" class="form-control"
            ng-options="item.id*1 as item.name for item in collection.size_unit"
            >
              <option value="">Please select</option>
            </select>
          </div>
        </div>
      </div>

      <div class="col-md-3 form-group">
        <label>Requirement</label>
        <select class="form-control"
        ng-model="form.requirement_id"
		ng-change="formRequirementChange()"
        ng-options="item.id*1 as item.name for item in getRequirementList()"
        required>
            <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-4 form-group">
        <label>Address no </label> ( * ใส่แค่ตำแหน่งห้องหรือเลขห้องเท่านั้น )
        <input type="text" class="form-control" ng-model="form.address_no">
      </div>

      <div style="clear: both;"></div>

      <div class="col-md-3 form-group">
        <label>Floors</label>
        <input type="text" class="form-control" ng-model="form.floors">
      </div>

	  <div class="col-md-3 form-group">
        <label>Room type</label>
        <select class="form-control"
        ng-model="form.room_type_id">
            <option value="">Please select</option>
            <option value="1">Studio</option>
            <option value="2">Duplex</option>
			<option value="3">Normal</option>
            <option value="4">Triplex</option>
            <option value="5">Pent House</option>
        </select>
      </div>

      
      <div class="col-md-3 form-group">
        <label>bedrooms</label>
		<select class="form-control" ng-model="form.bedrooms">
            <option value="">Please select</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>	
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>bathrooms</label>
		<select class="form-control" ng-model="form.bathrooms">
            <option value="">Please select</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>	
        </select>
      </div>
      <div style="clear: both;"></div>
		
		<div class="col-md-8 form-group">
			<div class="checkboxxx" style="float:left;margin-right: 20px;">
				<label>
					<input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact1" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">ภาษีธุรกิจเฉพาะ 3.3%</div>
				</label>
			</div>
			<div class="checkboxxx" style="float:left;margin-right: 20px;">
				<label>
					<input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact2" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">ค่าอาการแสตมป์ 0.5%</div>
				</label>
			</div>
			<div class="checkboxxx" style="float:left;margin-right: 20px;">
				<label>
					<input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact3" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">ค่าธรรมเนียมการทำนิติกรรม 2%</div>
				</label>
			</div>
			<div class="checkboxxx" style="float:left;margin-right: 20px;">
				<label>
					<input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact4" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">ค่าจดจำนอง 1%</div>
				</label>
			</div>
		</div>



	  <div style="clear: both;"></div>

      <div class="col-md-3 form-group">
        <label>Contract price</label>
        <input type="text" class="form-control" ng-model="form.contract_price" ng-change="formChkContractUpChange()">
      </div>
      <div class="col-md-3 form-group">
        <label>Selling price</label>
        <input type="text" class="form-control" ng-model="form.sell_price" id="input-sellingprice" disabled>
      </div>
      <div class="col-md-3 form-group">
        <label>Rental price</label>
        <input type="text" class="form-control" ng-model="form.rent_price" id="input-rentprice" disabled>
      </div>

      <div style="clear: both;"></div>
      <div class="col-md-3 form-group">
        <label>Contract expire</label>
        <div class="input-group">
          <input class="form-control datepicker" datepicker ng-model="form.contract_expire" placeholder="-">
          <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
        </div>
      </div>
      <div class="col-md-3 form-group">
        <label>Rented expire</label>
        <div class="input-group">
          <input class="form-control datepicker" datepicker ng-model="form.rented_expire" id="input-rented_exp" placeholder="-">
          <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
        </div>
      </div>
      <hr style="clear: both;
    background-color: black;
    height: 2px;
    margin: 30px 10px;">


      <div class="col-md-3 form-group">
        <label>key location</label>
        <select class="form-control"
        ng-model="form.key_location_id"
        ng-options="item.id as item.name for item in collection.key_location"
        >
            <option value="">Please select</option>
        </select>
      </div>
      <div style="clear: both;"></div>

      <div class="col-md-3 form-group">
        <label>road</label>
        <input type="text" class="form-control" ng-model="form.road">
      </div>
      <div class="col-md-3 form-group">
        <label>zone</label>
        <select class="form-control"
        ng-model="form.zone_id"
        ng-options="item.id as item.name group by getZoneGroupName(item.zone_group_id) for item in collection.zone"
        >
            <option value="">Please select</option>
        </select>
      </div>
      <div style="clear: both;"></div>

      <div class="col-md-3 form-group">
        <label>Province</label>
        <select class="form-control"
        ng-model="form.province_id"
        ng-init="form.province_id = null"
        ng-options="item.id as item.name for item in thailocation.province"
        >
            <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>District</label>
        <select class="form-control"
        ng-model="form.district_id"
        ng-options="item.id as item.name for item in getDistrict()"
        >
            <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>Sub District</label>
        <select class="form-control"
        ng-model="form.sub_district_id"
        ng-options="item.id as item.name for item in getSubDistrict()"
        >
            <option value="">Please select</option>
        </select>
      </div>

      <div style="clear: both;"></div>
      
      <div class="col-md-3 form-group">
        <label>bts</label>
        <select class="form-control"
          ng-model="form.bts_id"
          ng-options="item.id as item.name for item in collection.bts"
          >
          <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>mrt</label>
        <select class="form-control"
          ng-model="form.mrt_id"
          ng-options="item.id as item.name for item in collection.mrt"
          >
          <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>Airport link</label>
        <select class="form-control"
          ng-model="form.airport_link_id"
          ng-options="item.id as item.name for item in collection.airport_link"
          >
          <option value="">Please select</option>
        </select>
      </div>

      <hr style="clear: both;
    background-color: black;
    height: 2px;
    margin: 30px 10px;">


      <div class="col-md-3 form-group">
        <label>Web Status</label>
        <select class="form-control" ng-model="form.web_status" >
            <option value="0">Offline</option>
            <option value="1">Online</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>Feature Unit</label>
        <select class="form-control"
        ng-model="form.feature_unit_id"
        ng-options="item.id as item.name for item in collection.feature_unit"
        >
            <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group">
        <label>Highlight</label>
        <select class="form-control"
        ng-model="form.property_highlight_id"
        ng-options="item.id as item.name for item in collection.property_highlight"
        >
            <option value="">Please select</option>
        </select>
      </div>
      <div class="col-md-3 form-group" style="display:none;">
        <label>Web URL search</label>
        <textarea class="form-control"
        ng-model="form.web_url_search"></textarea>
      </div>
    </fieldset>
  </div>
  <div class="row">
    <div class="col-md-12 form-group">
      <label>Comment/Remark</label>
      <textarea class="form-control" ng-model="form.comment"></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 form-group">
      <!-- <button class="btn btn-primary">Save</button> -->
      <a class="btn btn-info" href="#/">Back</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </div>
</form>
