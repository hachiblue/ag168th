<?php session_start();?>
<div ng-controller="ListCTL">
  <form ng-submit="getProps(1)">
    <div class="row">
        <div class="col-md-4 form-group">
          <label class="control-label">Property Type</label>
          <select class="form-control"
              ng-options="item.id as item.name for item in collection.property_type"
              ng-model="form.property_type_id">
              <option value="">All</option>
          </select>
        </div>
        <div class="col-md-4 form-group">
            <label>bed rooms</label>
            <select class="form-control"
                ng-model="form.bedrooms">
                <option value="">All</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4+">4+</option>
            </select>
        </div>
        <div class="col-md-4 form-group">
          <label class="control-label">Project</label>
          <select class="form-control"
              ng-options="item.id as item.name for item in collection.project"
              ng-model="form.project_id">
              <option value="">All</option>
          </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 form-group">
            <label>Zone</label>
            <select class="form-control"
            ng-model="form.zone_id"
            ng-options="item.id as item.name group by getZoneGroupName(item.zone_group_id) for item in collection.zone">
                <option value="">All</option>
            </select>
        </div>
        <div class="col-md-4 form-group">
            <label>Province</label>
            <select class="form-control"
            ng-model="form.province_id"
            ng-options="item.id as item.name for item in thailocation.province">
            <option value="">All</option>
          </select>
        </div>
        <div class="col-md-4 form-group">
            <label>Status</label>
            <select class="form-control" ng-model="form.property_status_id" ng-options="item.id*1 as item.name for item in collection.property_status">
			    <option value="">Please select</option>
		    </select>
        </div>
        <div class="col-md-4 form-group">
            <label class="control-label">Nearest BTS</label>
            <div>
              <select class="form-control"
              ng-model="form.bts_id"
              ng-options="item.id as item.name for item in collection.bts"
              >
              <option value="">All</option>
            </select>
            </div>
        </div>
        <div class="col-md-4 form-group">
            <label class="control-label">Nearest MRT</label>
            <div>
              <select class="form-control"
              ng-model="form.mrt_id"
              ng-options="item.id as item.name for item in collection.mrt"
              >
              <option value="">All</option>
            </select>
            </div>
        </div>

        <div class="col-md-4 form-group">
            <label class="control-label">Admin</label>
            <div>
              <select class="form-control"
              ng-model="form.account_id"
              ng-options="item.id*1 as item.name for item in collection.property_comment.data"
              >
              <option value="">All</option>
            </select>
            </div>
        </div>

    </div>
    <div class="row">
      <div class="col-md-4 el-custom-1">
        <label>Created start</label>
        <input type="text" class="form-control" ng-model="form.created_at_start"
        id="created_at_start">
      </div>
      <div class="col-md-4 el-custom-1">
        <label>Created end</label>
        <input type="text" class="form-control" ng-model="form.created_at_end"
        id="created_at_end">
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 el-custom-1">
        <label>Updated start</label>
        <input type="text" class="form-control" ng-model="form.updated_at_start"
        id="updated_at_start">
      </div>
      <div class="col-md-4 el-custom-1">
        <label>Updated end</label>
        <input type="text" class="form-control" ng-model="form.updated_at_end"
        id="updated_at_end">
      </div>
    </div>
    <div class="row">
      <div class="col-md-2 el-custom-1">
        <label>Order By</label>
        <select ng-model="form.orderBy" ng-init="form.orderBy='property.updated_at'" class="form-control">
            <option value="property.updated_at">Updated at</option>
            <option value="property.created_at">Created at</option>
            <option value="property.reference_id">Reference ID</option>
            <option value="property.rented_expire">Rent expire</option>
            <option value="project.name">Project name</option>
            <option value="property.sell_price">Sell price</option>
            <option value="property.rent_price">Rent price</option>
            <option value="property.size">Size</option>
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
      <div class="col-md-6"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Search</button>
            <?php if(@$_SESSION['login']['level_id'] == 1){?>
            <button type="button" class="btn btn-primary" ng-click="downloadCsv()">Download</button>
			<button type="button" class="btn btn-primary" ng-click="downloadCsvVip()">Download Vip</button>
            <?php }?>
            <span ng-if="isShowTotal()">Search total: {{props.total}} item</span>
        </div>
    </div>
  </form>
    <table class="table table-striped table-hover ">
      <thead>
      <tr>
          <th>#</th>
          <th>Details</th>
          <th>Requirement</th>
          <th>Size</th>
          <th>Sell</th>
          <th>Rent</th>
          <th>Status</th>
          <th>Zone</th>
          <th>Owner</th>
          <th>Province</th>
          <!-- <th>Total Unit</th> -->
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="prop in props.data ">
          <td>{{prop.reference_id}}</td>
          <td>
              <div><strong>Project</strong>: <span>{{prop.project_name}}</span></div>
              <div ng-if="prop.address_no"><strong>Address no</strong>: <span>{{prop.address_no}}</span></div>
              <div ng-if="prop.floors"><strong>Floor</strong>: <span>{{prop.floors}}</span></div>
              <!-- <div><strong>Type</strong>: <span>{{prop.property_type_name}}</span></div> -->
              <div ng-if="prop.bedrooms"><strong>Bed room</strong>: <span>{{prop.bedrooms}}</span></div>
              <div ng-if="prop.bathrooms"><strong>Bath room</strong>: <span>{{prop.bathrooms}}</span></div>
              <!-- <div><strong>Transfer Status</strong>: <span>{{prop.property_status_name}}</span></div> -->
          </td>
          <td>{{prop.requirement_name}}</td>
          <td>{{prop.size}} {{prop.size_unit_name}}</td>
          <td><span ng-hide="!prop.sell_price">฿{{commaNumber(prop.sell_price)}}</span></td>
          <td><span ng-hide="!prop.rent_price">฿{{commaNumber(prop.rent_price)}}</span></td>
          <td>{{prop.property_status_name}}</td>
          <td>{{prop.zone_name}}</td>
          <td>{{prop.owner}}</td>
          <td>{{prop.province_name}}</td>
          <td><a class="btn btn-info" href="properties#/edit/{{prop.id}}" target="_blank">View</a></td>
      </tr>
      </tbody>
    </table>
    <div>
      <ul class="pagination">
        <li>
          <a href="" aria-label="Previous" ng-click="setPage(form.page - 1)">
            <span aria-hidden="true">&#60;</span>
          </a>
        </li>
        <li ng-class="{'active': form.page == 1}">
          <a href="" aria-label="Previous" ng-click="setPage(1)">
            <span aria-hidden="true">1</span>
          </a>
        </li>
        <li ng-show="form.page > 5">
          <a aria-label="Previous">
            <span aria-hidden="true">..</span>
          </a>
        </li>
        <li
          ng-repeat="page in pagination track by $index"
          ng-class="{'active': $index == (form.page - 1)}"
          ng-if="form.page <= $index + 4 && form.page > $index - 3
            && $index > 0 && $index < pagination.length - 1">
          <a href="" ng-click="setPage($index + 1)">{{($index+1)}}</a>
        </li>
        <li ng-show="form.page <= pagination.length - 5">
          <a aria-label="Previous">
            <span aria-hidden="true">..</span>
          </a>
        </li>
        <li ng-class="{'active': form.page == pagination.length}">
          <a href="" aria-label="Previous" ng-click="setPage(pagination.length)">
            <span aria-hidden="true">{{pagination.length}}</span>
          </a>
        </li>
        <li>
          <a href="" aria-label="Next" ng-click="setPage(form.page + 1)">
            <span aria-hidden="true">&#62;</span>
          </a>
        </li>
      </ul>
    </div>
</div>
<script>
$(function(){
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  $('#created_at_start').datepicker();
  $('#created_at_end').datepicker();
  $('#updated_at_start').datepicker();
  $('#updated_at_end').datepicker();
});
</script>
