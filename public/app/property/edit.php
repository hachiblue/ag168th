<?php session_start();?>
<div ng-controller="EditCTL as ctrl" layout="column" ng-cloak>

  <?php include dirname(__FILE__) . '/head.php';?>

  <md-content class="md-padding">

    <form ng-submit="submit()" id="form-edit-prop" ng-show="initSuccess"
      ng-init="editAllow = <?php echo json_encode(@$_SESSION['login']['level_id'] != 3 && @$_SESSION['login']['level_id'] != 4 && @$_SESSION['login']['level_id'] > 0); ?>; isadmin = <?php echo json_encode((2 == $_SESSION['login']['level_id'] || 7 == $_SESSION['login']['level_id'])); ?>;"
      >

      <fieldset>
        <div class="row">

          <div class="col-md-2 form-group" name="ref_id">
            <label>Reference ID</label>
            <input class="form-control" value="{{reference_id}}" ReadOnly>
          </div>


          <div class="col-md-5" ng-show="<?=json_encode(@$_SESSION['login']['level_id'] != 4);?>">
              <label>Owner ID</label>
              <md-autocomplete
                ng-disabled="ctrl.isDisabled"
                md-no-cache="ctrl.noCache"
                md-selected-item="ctrl.selectedItem"
                md-search-text-change="ctrl.searchTextChange(ctrl.searchText)"
                md-search-text="ctrl.searchText"
                md-selected-item-change="ctrl.selectedItemChange(item)"
                md-items="item in ctrl.querySearch(ctrl.searchText)"
                md-item-text="item.display"
                md-min-length="0"
                placeholder="ค้นหา owner">
                <md-item-template>
                  <span md-highlight-text="ctrl.searchText" md-highlight-flags="i">{{item.display}}</span>
                </md-item-template>
                <md-not-found>
                  No states matching "{{ctrl.searchText}}" were found.
                </md-not-found>
              </md-autocomplete>

          </div>


          <div class="clearfix"></div>

          <div class="col-md-2" ng-show="<?=json_encode(@$_SESSION['login']['level_id'] != 4);?>"></div>

          <div id="owners" class="col-md-10" ng-show="<?=json_encode(@$_SESSION['login']['level_id'] != 4);?>">

            <div id="row_1" class="row">
              <div class="col-sm-2 col-md-4 form-group">
                <label>Owner Name</label>
                <input class="form-control" ng-model="form.owner_name1" pattern="[^,:.]+" disabled>
              </div>

              <div class="col-sm-2 col-md-2 form-group">
                <label>Owner Phone</label>
                <input class="form-control" ng-model="form.owner_phone1" pattern="[^,:.]+" disabled>
              </div>

              <div class="col-sm-1 col-md-2 form-group">
                <label>Email, Line Id</label>
                <input class="form-control" ng-model="form.owner_email1" pattern="[^,:]+" disabled>
              </div>

              <div class="col-sm-2 col-md-2 form-group">
                <label>Customer VIP</label>
                <input class="form-control" ng-model="form.owner_cust1" pattern="[^,:]+" disabled>
              </div>

            </div>

          </div>

          <div id="tmpl-owners" ng-show="<?=json_encode(@$_SESSION['login']['level_id'] != 4);?>">


            <div class="col-sm-2 col-md-4 form-group">
              <label>Owner Name</label>
              <input class="form-control" ng-model="form.owner_name1" pattern="[^,:.]+" disabled>
            </div>

            <div class="col-sm-2 col-md-2 form-group">
              <label>Owner Phone</label>
              <input class="form-control" ng-model="form.owner_phone1" pattern="[^,:.]+" disabled>
            </div>

            <div class="col-sm-1 col-md-2 form-group">
              <label>Email, Line Id</label>
              <input class="form-control" ng-model="form.owner_email1" pattern="[^,:]+" disabled>
            </div>

            <div class="col-sm-2 col-md-2 form-group">
              <label>Customer VIP</label>
              <input class="form-control" ng-model="form.owner_cust1" pattern="[^,:]+" disabled>
            </div>

            <div class="clearfix"></div>

          </div>

        </div>
      </fieldset>

      <div class="row">

        <fieldset ng-disabled="!editAllow">

          <div id="pending-box" class="col-md-2 form-group" style="display:none;">
            <label>Pending</label>
             <select class="form-control"
            ng-model="form.property_pending_type"
            ng-change="formPendingTypeChange()">
              <option value="">Please select</option>
              <option value="1">No Answer</option>
              <option value="2">Follow Up</option>
              <!--<option value="2">Line Busy</option>
              <option value="3">Leave message</option>
              <option value="4">Etc.</option>-->
            </select>
          </div>

          <div id="pending-info-box" class="col-md-2 form-group" style="display:none;">
            <label>&nbsp;</label>
             <input class="form-control" ng-model="form.property_pending_info">
          </div>

          <div id="pending-date-box" class="col-md-2 form-group" style="display:none;">
            <label>&nbsp;</label>
            <div class="input-group">
              <input id="datetime-pick" class="form-control datepicker" datetimepicker ng-model="form.property_pending_date" placeholder=" - ">
              <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
            </div>
          </div>

          <div style="clear:both;"></div>

          <div class="col-md-2 form-group">
            <label>Status</label>
            <select class="form-control"
            ng-model="form.property_status_id"
            ng-change="formPropertyStatusIdChange()"
            ng-options="item.id as item.name for item in collection.property_status"
            required>
              <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>Property Type</label>
            <select class="form-control"
            ng-model="form.property_type_id"
            ng-change="formPropertyTypeChange()"
            ng-options="item.id as item.name for item in collection.property_type"
            required>
                <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>Project</label>
            <select  chosen id="project_id" class="form-control"
              ng-model="form.project_id"
              ng-change="formProjectIdChange()"
              ng-options="item.id as item.name for item in collection.project"
              >
                <option value="">Please select</option>
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
                ng-options="item.id as item.name for item in collection.size_unit"
                required>
                  <option value="">Please select</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-3 form-group">
            <label>requirement</label>
            <select class="form-control"
              ng-model="form.requirement_id"
              ng-change="formRequirementChange()"
              ng-options="item.id as item.name for item in collection.requirement"
              required>
                <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>Address no</label> ( * ใส่แค่ตำแหน่งห้องหรือเลขห้องเท่านั้น )
            <input type="text" class="form-control" ng-model="form.address_no">
          </div>

          <div class="col-md-1 form-group">
            <label>Unit no</label>
            <input type="text" class="form-control" ng-model="form.unit_no">
          </div>

          <div class="col-md-1 form-group">
            <label>Building no</label>
            <input type="text" class="form-control" ng-model="form.building_no">
          </div>

          <div class="col-md-1 form-group">
            <label>Floors</label>
            <input type="text" class="form-control" ng-model="form.floors">
          </div>

          <div class="col-md-2 form-group">
            <label>Direction</label>
            <input type="text" class="form-control" ng-model="form.direction">
          </div>

          <div class="col-md-2 form-group">
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

          <div class="col-md-1 form-group">
            <label>bedrooms</label>
            <select class="form-control" ng-model="form.bedrooms">
              <option value="">Please select</option>
              <option value="0">0</option>
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

          <div class="col-md-1 form-group">
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

          <div class="col-md-12 form-group">
            <div class=" col-md-2 checkboxxx">
              <label class="col-xs-6 nopadd">
                <input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact1" ng-click="formChkContractUpChange()" style="float: left;">
                <div style="margin-left: 20px;">ภาษีธุรกิจเฉพาะ</div>
              </label>
              <div class="col-xs-2 nopadd fee_percent_sel">
                <select class="form-control" id="fee-sel" ng-model="form.chkcontact1a"  ng-change="formChkContractUpChange()">
                  <option value="1">1.65%</option>
                  <option value="2" selected>3.3%</option>
                </select>
              </div>
            </div>

            <div class=" col-md-2 checkboxxx">
              <label class="col-xs-8 nopadd">
                <input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact2" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">ค่าอากรแสตมป์</div>
              </label>
              <div class="col-xs-2 nopadd fee_percent_sel">
                <select class="form-control" id="fee-sel" ng-model="form.chkcontact2a"  ng-change="formChkContractUpChange()">
                  <option value="1">0.25%</option>
                  <option value="2" selected>0.5%</option>
                </select>
              </div>
            </div>

            <div class=" col-md-2 checkboxxx">
              <label class="col-xs-8 nopadd">
                <input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact3" ng-click="formChkContractUpChange()" style="float: left;">
                <div style="margin-left: 20px;">ค่าธรรมเนียมการโอน</div>
              </label>
              <div class="col-xs-2 nopadd fee_percent_sel">
                <select class="form-control" id="fee-sel" ng-model="form.chkcontact3a"  ng-change="formChkContractUpChange()">
                  <option value="1">1%</option>
                  <option value="2" selected>2%</option>
                </select>
              </div>
            </div>

            <div class="col-md-2 checkboxxx">
              <label class="col-xs-8 nopadd">
                <input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact4" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">Commission</div>
              </label>
              <div class="col-xs-2 nopadd fee_percent_sel">
                <select class="form-control" id="fee-sel" ng-model="form.chkcontact4a"  ng-change="formChkContractUpChange()">
                  <option value="1">1.5%</option>
                  <option value="2" selected>3%</option>
                </select>
              </div>
            </div>

            <div class="col-md-2 checkboxxx">
              <label>
                <input type="checkbox" name="chk_contract_up" ng-model="form.chkcontact5" ng-click="formChkContractUpChange()" style="float: left;"><div style="margin-left: 20px;">Vat 7%</div>
              </label>
            </div>
          </div>

          <div style="clear: both;"></div>

          <div class="col-md-3 form-group">
            <label>Contract price</label>
            <input type="text" class="form-control" ng-model="form.contract_price" ng-blur="setmoneyformat()">
          </div>

          <div class="col-md-3 form-group">
            <label>Net price</label>
            <input type="text" class="form-control" ng-model="form.net_sell_price" id="input-net_sell_price" ng-blur="setmoneyformat()" ng-change="formChkContractUpChange()">
          </div>

          <div class="col-md-3 form-group">
            <label>Selling price</label>
            <input type="text" class="form-control" ng-model="form.sell_price" id="input-sellingprice" ng-blur="setmoneyformat()" disabled>
          </div>

          <div class="col-md-3 form-group">
            <label>Price/sqm.</label>
            <input type="text" class="form-control" value="{{ ((form.sell_price | num) / form.size) | money }}" disabled >
          </div>

          <div style="clear: both;"></div>

          <div class="col-md-3 form-group">
            <label>Rental price</label>
            <input type="text" class="form-control" ng-model="form.rent_price" id="input-rentprice" ng-blur="setmoneyformat()" disabled>
          </div>

          <div class="col-md-3 form-group" style="display:none;">
            <label>Contract expire</label>
            <div class="input-group">
              <input class="form-control datepicker" datepicker ng-model="form.contract_expire" placeholder="-">
              <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
            </div>
          </div>

        </fieldset>

        <fieldset>

          <div class="col-md-3 form-group">
            <label>Rented expire</label>
            <div class="input-group">
              <input class="form-control datepicker" datepicker ng-model="form.rented_expire" id="input-rented_exp" placeholder="-">
              <div class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></div>
            </div>
          </div>

        </fieldset>

        <fieldset ng-disabled="!editAllow">

          <hr style="clear: both; background-color: black; height: 2px; margin: 30px 10px;">

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
            ng-disabled="form.property_type_id.toString() == '1' || isadmin">
                <option value="">Please select</option>
            </select>
          </div>

          <div style="clear: both;"></div>

          <div class="col-md-3 form-group">
            <label>Province</label>
            <select class="form-control"
            ng-model="form.province_id"
            ng-options="item.id as item.name for item in thailocation.province"
            ng-disabled="form.property_type_id.toString() == '1' || isadmin">
                <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>District</label>
            <select class="form-control"
            ng-model="form.district_id"
            ng-options="item.id as item.name for item in getDistrict()"
            ng-disabled="form.property_type_id.toString() == '1' || isadmin">
                <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>Sub District</label>
            <select class="form-control"
            ng-model="form.sub_district_id"
            ng-options="item.id as item.name for item in getSubDistrict()"
            ng-disabled="form.property_type_id.toString() == '1' || isadmin">
                <option value="">Please select</option>
            </select>
          </div>

          <div style="clear: both;"></div>

          <div class="col-md-3 form-group">
            <label>bts</label>
            <select class="form-control"
              ng-model="form.bts_id"
              ng-options="item.id as item.name for item in collection.bts"
              ng-disabled="form.property_type_id.toString() == '1' || isadmin">
              <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>mrt</label>
            <select class="form-control"
              ng-model="form.mrt_id"
              ng-options="item.id as item.name for item in collection.mrt"
              ng-disabled="form.property_type_id.toString() == '1' || isadmin">
              <option value="">Please select</option>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>Airport link</label>
            <select class="form-control"
              ng-model="form.airport_link_id"
              ng-options="item.id as item.name for item in collection.airport_link"
              ng-disabled="form.property_type_id.toString() == '1' || isadmin">
              <option value="">Please select</option>
            </select>
          </div>

          <hr style="clear: both; background-color: black; height: 2px; margin: 30px 10px;">

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
          <textarea class="form-control" id="bt_comment" ng-model="form.comment"></textarea>
          (<span id="cnt_comment">0</span>/400)
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 form-group">
          <!-- <button class="btn btn-primary">Save</button> -->
          <a class="btn btn-info" href="#/">Back</a>
          <button type="submit" class="btn btn-primary">Save</button>
          <a class="btn btn-info" href="#/{{form.id}}/match" target="_blank">Match</a>
        </div>
      </div>

    </form>

  </md-content>

</div>


<div ng-controller="CommentCTL">
  <table class="table table-bodered">
    <thead>
      <tr>
        <th>วันที่</th>
        <th>ข้อความ</th>
        <th>โดย</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="item in comments">
        <td>{{item.updated_at}}</td>
        <td>{{item.comment}}</td>
        <td>{{item.name}}</td>
      </tr>
    </tbody>
  </table>
</div>

