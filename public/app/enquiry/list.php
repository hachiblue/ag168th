<?php session_start();?>
<div ng-controller="ListCTL">
    <div>
        <form id="searchForm">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Enquiry Search</h3>
                </div>
                <div class="panel-body">
                    <form ng-submit="filterItems()">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label">Enquiry No.</label>
                                <div>
                                    <input type="text" class="form-control" ng-model="form.enquiry_no">
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Enquiry type</label>
                                <div>
                                  <select class="form-control" id="type" ng-model="form.enquiry_type_id">
                                    <option value="">All</option>
                                    <option value="1">Individual</option>
                                    <option value="2">Investment</option>
                                    <option value="3">Corporate</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Customer</label>
                                <div>
                                    <input type="text" class="form-control" ng-model="form.customer">
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Requirement Type</label>
                                <div>
                                  <select class="form-control"
                                  ng-model="form.requirement_id"
                                  ng-options="item.id as item.name_for_enquiry for item in collection.requirement | filter: {id: '!4'}">
                                      <option value="">All</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Property Type</label>
                                <div>
                                  <select class="form-control"
                                  ng-model="form.property_type_id"
                                  ng-options="item.id as item.name for item in collection.property_type">
                                      <option value="">All</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Project</label>
                                <div>
                                    <select class="form-control"
                                    ng-model="form.project_id"
                                    ng-options="item.id as item.name for item in collection.project">
                                        <option value="">All</option>
                                    </select>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Zone</label>
                                <div>
                                  <select class="form-control"
                                  ng-model="form.zone_id"
                                  ng-options="item.id as item.name group by getZoneGroupName(item.zone_group_id) for item in collection.zone">
                                      <option value="">All</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Branch</label>
                                <div>
                                    <select class="form-control"
                                    ng-model="form.province_id"
                                    ng-options="item.id as item.name for item in thailocation.province">
                                        <option value="">All</option>
                                    </select>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Buying Budget</label>
                                <div class="row">
                                    <div class="col-md-5"><input type="text" class="form-control" ng-model="form.buy_budget_start"></div>
                                    <div class="col-md-2">to</div>
                                    <div class="col-md-5"><input type="text" class="form-control" ng-model="form.buy_budget_end"></div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Rental Budget</label>
                                <div class="row">
                                    <div class="col-md-5"><input type="text" class="form-control" ng-model="form.rent_budget_start"></div>
                                    <div class="col-md-2">to</div>
                                    <div class="col-md-5"><input type="text" class="form-control" ng-model="form.rent_budget_end"></div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Enquiry is the decision maker</label>
                                <div>
                                      <select class="form-control"
                                      ng-model="form.decision_maker">
                                          <option value="">All</option>
                                          <option value="1">Yes</option>
                                          <option value="0">No</option>
                                      </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Period time to purchasing or leasing</label>
                                <div>
                                  <select class="form-control" ng-model="form.ptime_to_pol">
                                    <option value="">All</option>
                                   <option>Within a week</option>
                                     <option>Within a month</option>
                                     <option>Within 3 months</option>
                                  </select>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Bed room</label>
                                <div>
                                    <select class="form-control" ng-model="form.bedroom">
                                      <option value="">All</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                              <div class="checkbox">
                                <label style="padding-left: 20px">
                                  <input
                                  type="checkbox"
                                  ng-model="form.is_studio">
                                  is studio
                                </label>
                              </div>
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
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
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
                            <div class="col-md-3 form-group">
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
                            <div class="col-md-3 form-group">
                                <label class="control-label">Nearest Airport-link</label>
                                <div>
                                  <select class="form-control"
                                  ng-model="form.airport_link_id"
                                  ng-options="item.id as item.name for item in collection.airport_link"
                                  >
                                  <option value="">All</option>
                                </select>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Status</label>
                                <div>
                                  <select class="form-control"
                                  ng-model="form.enquiry_status_id"
                                  ng-options="item.id as item.name for item in collection.enquiry_status"
                                  >
                                  <option value="">All</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Exact location required</label>
                                <div>
                                    <input type="text" class="form-control" ng-model="form.ex_location">
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Contact Type</label>
                                <div>
                                  <select class="form-control" ng-model="form.contact_type_id">
                                      <option value="">-Please select-</option>
                                      <option value="1">Online</option>
                                      <option value="2">Walkin</option>
                                      <option value="3">Call</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <?php if(@$_SESSION['login']['level_id'] == 1 || @$_SESSION['login']['level_id'] == 2){?>
                          <div class="col-md-3 form-group">
                              <label class="control-label">Manager</label>
                              <div>
                                <select
                                  class="form-control"
                                  ng-model="form.assign_manager_id"
                                  ng-options="item.id as item.name for item in accounts | filter: {level_id: '3'}">
                                    <option value="">-Please select-</option>
                                </select>
                              </div>
                          </div>
                          <?php }?>
                          <?php if(@$_SESSION['login']['level_id'] == 1 || @$_SESSION['login']['level_id'] == 2 || @$_SESSION['login']['level_id'] == 3){?>
                          <div class="col-md-3 form-group">
                              <label class="control-label">Sale</label>
                              <div>
                                <select
                                  class="form-control"
                                  ng-model="form.assign_sale_id"
                                  ng-options="item.id as item.name for item in accounts | filter: {level_id: '4'}">
                                    <option value="">-Please select-</option>
                                </select>
                              </div>
                          </div>
                          <?php }?>
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
                          <div class="col-md-2">
                            <label>Order By</label>
                            <select ng-model="form.orderBy" ng-init="form.orderBy='enquiry.updated_at'" class="form-control">
                                <option value="enquiry.updated_at">Updated at</option>
                                <option value="enquiry.created_at">Created at</option>
                                <option value="enquiry.enquiry_no">Enquiry No.</option>
                            </select>
                          </div>
                          <div class="col-md-2">
                            <label></label>
                            <select ng-model="form.orderType" ng-init="form.orderType='DESC'" class="form-control">
                                <option value="DESC">max -> min</option>
                                <option value="ASC">min -> max</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success" ng-click="filterItems()">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>
        <div class="pull-right"><strong>Summary</strong>: {{items.total}}</div>
    </div>
    <div>
      <?php if(@$_SESSION['login']['level_id'] <= 2){?>
        <a href="#add" class="btn btn-primary">Add</a>
      <?php }?>
    </div>
    <div style="overflow-x: auto;">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Enquiry no.</th>
                <th>Created</th>
                <th>Assign to</th>
                <th style="width: 10%;">Customer</th>
                <th>Project</th>
                <th>Requirement</th>
                <th>Enquiry Type</th>

                <th>Buying Budget</th>
                <th>Rental Budget</th>
                <th>Status</th>

                <th>Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="item in items.data">
                <td>{{item.enquiry_no}}</td>
                <td>{{item.created_at}}</td>
                <?php if(@$_SESSION['login']['level_id'] <= 3){?>
                <td>
                  <?php if(@$_SESSION['login']['level_id'] <= 2){?>
                  <div ng-if="item.manager_name"><strong>Manager</strong>: <span>{{item.manager_name}}</span></div>
                  <?php }?>
                  <div ng-if="item.sale_name"><strong>Sale</strong>: <span>{{item.sale_name}}</span></div>
                </td>
                <?php }?>
                <td>{{item.customer}}</td>
                <td>{{item.project_name}}</td>
                <td>{{item.name_for_enquiry}}</td>
                <td>{{item.enquiry_type_name}}</td>

                <td>฿{{commaNumber(item.buy_budget_start)}} - ฿{{commaNumber(item.buy_budget_end)}}</td>
                <td>฿{{commaNumber(item.rent_budget_start)}} - ฿{{commaNumber(item.rent_budget_end)}}</td>
                <td>{{item.enquiry_status_name}}</td>

                <td>{{item.updated_at}}</td>
                <td>
                  <a class="xcrud-action btn btn-warning btn-sm" href="#/edit/{{item.id}}" target="_blank"><i class="glyphicon glyphicon-edit"></i></a>
                  <?php if(@$_SESSION["login"]["level_id"]==1){?><a class="xcrud-action btn btn-danger btn-sm" ng-click="remove(item.id)"><i class="glyphicon glyphicon-remove"></i></a><?php }?>
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



	<!-- Modal -->
	<div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="overflow: scroll;">
	  <div class="modal-dialog modal-lg" role="document" style="width: 90%;">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" ng-click="closeModel()" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Properties Expire</h4>
		  </div>
		  <div class="modal-body">
			
			<div style="overflow-x: auto;">
				<table class="table table-striped table-hover ">
					<thead>
					<tr>
						<th ng-click="sort('reference_id')">
						#
						<span class="glyphicon sort-icon" ng-show="sortKey=='reference_id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
						</th>
						<th>Rented Expire</th>
						<th>Created</th>
						<th>Details</th>
						<th>Requirement</th>
						<th>Size</th>
						<th>Sell</th>
						<th>Rent</th>
						<th>Status</th>
						<th>Zone</th>
						<th ng-click="sort('owner')">
						Owner
						<span class="glyphicon sort-icon" ng-show="sortKey=='owner'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
						</th>
						<th>Updated</th>
					</tr>
					</thead>
					<tbody>
					<tr ng-repeat="prop in props.data">
						<td>{{prop.reference_id}}</td>
						<td>{{prop.rented_expire}}</td>
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
						<td>{{prop.owner}}</td>
						<td>{{prop.updated_at}}</td>
					</tr>
					</tbody>
				</table>
			</div>
			<div>
			  <ul class="pagination">
				<li>
				  <a href="" aria-label="Previous" ng-click="setPageProps(form2.page - 1)">
					<span aria-hidden="true">&#60;</span>
				  </a>
				</li>
				<li ng-class="{'active': form2.page == 1}">
				  <a href="" aria-label="Previous" ng-click="setPageProps(1)">
					<span aria-hidden="true">1</span>
				  </a>
				</li>
				<li ng-show="form2.page > 5">
				  <a aria-label="Previous">
					<span aria-hidden="true">..</span>
				  </a>
				</li>
				<li
				  ng-repeat="page in p_pagination track by $index"
				  ng-class="{'active': $index == (form2.page - 1)}"
				  ng-if="form2.page <= $index + 4 && form2.page > $index - 3
					&& $index > 0 && $index < pagination.length - 1">
				  <a href="" ng-click="setPageProps($index + 1)">{{($index+1)}}</a>
				</li>
				<li ng-show="form2.page <= p_pagination.length - 5">
				  <a aria-label="Previous">
					<span aria-hidden="true">..</span>
				  </a>
				</li>
				<li ng-class="{'active': form2.page == p_pagination.length}">
				  <a href="" aria-label="Previous" ng-click="setPageProps(p_pagination.length)">
					<span aria-hidden="true">{{p_pagination.length}}</span>
				  </a>
				</li>
				<li>
				  <a href="" aria-label="Next" ng-click="setPageProps(form2.page + 1)">
					<span aria-hidden="true">&#62;</span>
				  </a>
				</li>
			  </ul>
			</div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" ng-click="closeModel()" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
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
