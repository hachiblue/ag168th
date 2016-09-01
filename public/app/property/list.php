<?php session_start();?>
<style>
.el-custom-1 {
  margin-top: 51px;
}
.chosen-single{  
	background-color: #fff !important; 
}
.prop-img {
	width: 290px;
}
</style>
<div ng-controller="ListCTL">
    <div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Properties Search</h3>
			</div>
			<div class="panel-body" style="">
				<form ng-submit="filterProps()">

				  <div class="row">
					  <div class="col-md-3 form-group">
						  <label>reference no.</label>
						  <input type="text" class="form-control" ng-model="form.reference_id">
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Owner</label>
						  <input type="text" class="form-control" ng-model="form.owner">
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Address no</label>
						  <input type="text" class="form-control" ng-model="form.address_no">
					  </div>
					  <div class="col-md-3 form-group">
						  <label class="control-label">Requirement</label>
						  <select class="form-control"
							  ng-options="item.id as item.name for item in collection.requirement"
							  ng-model="form.requirement_id">
							  <option value="">All</option>
						  </select>
					  </div>
				  </div>

				  <div class="row">
					  <div class="col-md-3 form-group">
						<label class="control-label">Property Type</label>
						<select class="form-control"
							ng-options="item.id as item.name for item in collection.property_type"
							ng-model="form.property_type_id">
							<option value="">All</option>
						</select>
					  </div>

					  <div class="col-md-3 form-group">
						<label class="control-label">Project</label>
						<select chosen class="form-control"
							ng-options="item.id as item.name for item in collection.project"
							ng-model="form.project_id">
							<option value="">All</option>
						</select>
					  </div>
					  <div class="col-md-3 form-group">
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
					  <div class="col-md-3 form-group">
						  <label class="control-label">Size</label>
						  <div class="row">
							  <div class="col-md-3">
								  <input type="text" class="form-control" ng-model="form.size_start">
							  </div>
							  <div class="col-md-1">
								  To
							  </div>
							  <div class="col-md-3">
								  <input type="text" class="form-control" ng-model="form.size_end">
							  </div>
							  <div class="col-md-3">
								  <select class="form-control" ng-init="form.size_unit_id=1" ng-model="form.size_unit_id">
									  <option value="1">Sq. m.</option>
									  <option value="2">Sq. wa</option>
									  <option value="3">Rai</option>
								  </select>
							  </div>
						  </div>
					  </div>

				  </div>

				  <div class="row">
					  
					  <div class="col-md-3 form-group">
						  <label>Room Type</label>
						  <select class="form-control"
							  ng-model="form.room_type_id">
							  <option value="">All</option>
							  <option value="1">Studio</option>
							  <option value="2">Duplex</option>
						  </select>
					  </div>

					  <div class="col-md-3 form-group">
						<label class="control-label">Selling Price</label>
						<div class="row">
							<div class="col-md-5">
								<input type="text" class="form-control" ng-model="form.sell_price_start">
							</div>
							<div class="col-md-2">
								To
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control" ng-model="form.sell_price_end">
							</div>
						</div>
					  </div>
					  <div class="col-md-3 form-group">
						<label class="control-label">Rental Price</label>
						<div class="row">
							<div class="col-md-3">
								<input type="text" class="form-control" ng-model="form.rent_price_start">
							</div>
							<div class="col-md-1">
								To
							</div>
							<div class="col-md-3">
								<input type="text" class="form-control" ng-model="form.rent_price_end">
							</div>
						</div>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Inc. 7% VAT</label>
						  <select class="form-control" ng-model="form.inc_vat">
							  <option value="">All</option>
							  <option value="1">yes</option>
							  <option value="0">no</option>
						  </select>
					  </div>

				  </div>
			
				  <div class="row">
					  <div class="col-md-3 form-group">
						  <label>Zone</label>
						  <select class="form-control"
						  ng-model="form.zone_id"
						  ng-options="item.id as item.name group by getZoneGroupName(item.zone_group_id) for item in collection.zone">
							  <option value="">All</option>
						  </select>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Province</label>
						  <select class="form-control"
													ng-model="form.province_id"
													ng-options="item.id as item.name for item in thailocation.province">
						  <option value="">All</option>
							</select>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Status</label>
						  <select class="form-control" ng-model="form.property_status_id" ng-options="item.id*1 as item.name for item in collection.property_status">
							  <option value="">Please select</option>
						  </select>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>BTS</label>
						  <select class="form-control" ng-model="form.bts_id"
							  ng-options="item.id as item.name for item in collection.bts">
							  <option value="">All</option>
						  </select>
					  </div>
				  </div>

				  <div class="row">
					  <div class="col-md-3 form-group">
						  <label>MRT</label>
						  <select class="form-control" ng-model="form.mrt_id"
							  ng-options="item.id as item.name for item in collection.mrt">
							  <option value="">All</option>
						  </select>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Airport link</label>
						  <select class="form-control" ng-model="form.airport_link_id"
							  ng-options="item.id as item.name for item in collection.airport_link">
							  <option value="">All</option>
						  </select>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Property Highlight</label>
						  <select class="form-control" ng-model="form.property_highlight_id">
							  <option value="">All</option>
							  <option value="1">Sale at Lost and Plus</option>
							  <option value="2">Sale at Cost</option>
							  <option value="3">Sale under Market Price</option>
							  <option value="4">Made Over already</option>
						  </select>
					  </div>
					  <div class="col-md-3 form-group">
						  <label>Feature unit</label>
						  <select class="form-control" ng-model="form.feature_unit_id">
							  <option value="">All</option>
							  <option value="1">Best Buy</option>
							  <option value="2">Hot Price</option>
							  <option value="3">Discount</option>
							  <option value="4">New</option>
						  </select>
					  </div>
				  </div>

				  <div class="row">
					  <div class="col-md-3 form-group">
						  <label>Web status</label>
						  <select ng-model="form.web_status" class="form-control">
							  <option value="">All</option>
							  <option value="1">Online</option>
							  <option value="0">Offline</option>
						  </select>
					  </div>
					  <div class="col-md-3 el-custom-1x">
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
					<div class="col-md-3 el-custom-1x">
					  <label>&nbsp;</label>
					  <select ng-model="form.orderType" ng-init="form.orderType='DESC'" class="form-control">
						  <option value="DESC">max -> min</option>
						  <option value="ASC">min -> max</option>
					  </select>
					</div>
					<div class="col-md-3 form-group" style="display:none;">
					  <label>Web URL search</label>
					  <textarea class="form-control"
					  ng-model="form.web_url_search"></textarea>
					</div>

				  </div>

				  <div class="row">
					  <div class="col-md-12">
						  <button type="submit" class="btn btn-success" ng-click="filterProps()">Search</button>
						  <button type="reset" class="btn btn-success">Reset</button>
					  </div>
				  </div>
				</form>
				<div style="clear: both;"></div>
				<div class="pull-right">
				  <strong>Summary</strong>: {{props.total}}
				</div>
			</div>
		</div>
    </div>
    <div>
        <?php //if(@$_SESSION['login']['level_id'] <= 2){?>
          <a href="#add" class="btn btn-primary">Add</a>
          <a href="#quotation/168" class="btn btn-info"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> [<span id="cnt-quotation">{{form.total_q_items}}</span>] </a>
          <?php //}?>
        <!-- <a class="btn btn-primary" id="add_excel-btn" ng-click="addExcelClick()">{{inputExcelText}}</a> -->
        <!-- <input type="file" class="hidden" id="add_excel-input"> -->
    </div>
    <div style="overflow-x: auto;">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
            	<th></th>
                <th ng-click="sort('reference_id')">
				#
				<span class="glyphicon sort-icon" ng-show="sortKey=='reference_id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
				</th>
                <th>Created</th>
                <th>Details</th>
                <th>Requirement</th>
                <th>Size</th>
                <th>Sell</th>
                <th>Rent</th>
                <th>Status</th>
                <th>Zone</th>
                <!-- <th ng-click="sort('owner')">
				VIP
				<span class="glyphicon sort-icon" ng-show="sortKey=='owner'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
				</th> -->
				<th>VIP</th>
                <th>Updated</th>
                <!-- <th></th> -->
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="prop in props.data">
            	<td><input type="checkbox" name="chk_q" id="chk_{{prop.id}}" onclick="setQuotationItem(this)"></td>
                <td>{{prop.reference_id}}  <span ng-hide="!prop.image_url"><img src="{{prop.image_url}}" class="img-responsive prop-img"></span></td>
                <td>{{prop.created_at}}</td>
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
                <!-- <td>
                  <a class="btn btn-info" href="#/{{prop.id}}/gallery" target="_blank">images</a>
                </td> -->
                <td>{{prop.VIP | fvip}}</td>
                <td>{{prop.updated_at}}</td>
                <td>
                  <a class="xcrud-action btn btn-warning btn-sm" href="#edit/{{prop.id}}" target="_blank"><i class="glyphicon glyphicon-edit"></i></a>
                  <?php if(@$_SESSION["login"]["level_id"]==1){?><a class="xcrud-action btn btn-danger btn-sm" ng-click="remove(prop.id)"><i class="glyphicon glyphicon-remove"></i></a><?php }?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
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
