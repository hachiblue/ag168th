<?php session_start();?>
<div ng-controller="MatchCTL">
  <ul class="nav nav-tabs tabs-add" >
  	<li><a href="" ng-click="changeHash('/edit/'+id)">Enquiry</a></li>
  	<?php if(@$_SESSION['login']['level_id']==4 || @$_SESSION['login']['level_id']==8){?>
    <li><a href="">Match Property</a></li>
  	<li><a href="" ng-click="changeHash('/matched/'+id)">Matched Property</a></li>
    <?php }?>
  	<!-- <li><a href="">Touring Report</a></li> -->
	</ul>
    <div>
            <div class="panel panel-primary">
                <div class="panel-body" style="">
                    <h3 class="text-center">Project Require: <strong style="color: #1c5fbe;">{{props.enquiry.project.name}}</strong></h3>
                    <hr>
                    <form ng-submit="filterProps()">
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label>reference no.</label>
                              <input type="text" class="form-control" ng-model="form.reference_id">
                          </div>
                          <div class="col-md-4 form-group">
                              <label>Owner</label>
                              <input type="text" class="form-control" ng-model="form.owner">
                          </div>
                          <div class="col-md-4 form-group">
                              <label>Address no</label>
                              <input type="text" class="form-control" ng-model="form.address_no">
                          </div>
                          <div class="col-md-4 form-group">
                              <label class="control-label">Requirement</label>
                              <select class="form-control"
                                  ng-options="item.id as item.name for item in collection.requirement"
                                  ng-model="form.requirement_id">
                                  <option value="">All</option>
                              </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label class="control-label">Property Type</label>
                            <select class="form-control"
                                ng-options="item.id as item.name for item in collection.property_type"
                                ng-model="form.property_type_id">
                                <option value="">All</option>
                            </select>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4 form-group">
                            <label class="control-label">Project</label>
                            <select class="form-control"
                                ng-options="item.id as item.name for item in collection.project"
                                ng-model="form.project_id">
                                <option value="">All</option>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                              <label>bed rooms</label>
                              <select class="form-control"
                                  ng-model="form.bedrooms">
                                  <option value="">All</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4+">4+</option>
                              </select>
                          </div>
                          <div class="col-md-4 form-group">
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
                          <div class="col-md-4 form-group">
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
                          <div class="col-md-4 form-group">
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
                          <div class="col-md-4 form-group">
                              <label>Inc. 7% VAT</label>
                              <select class="form-control" ng-model="form.inc_vat">
                                  <option value="">All</option>
                                  <option value="1">yes</option>
                                  <option value="0">no</option>
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
                              <label>Address No.</label>
                              <input type="text" class="form-control" ng-model="form.address_no">
                          </div>
                          <div class="col-md-4 form-group">
                              <label>Status</label>
                              <select class="form-control" ng-model="form.property_status_id">
                                  <option value="">All</option>
                                  <option value="1">Non-Available</option>
                                  <option value="2">Available</option>
                                  <option value="3">Rented</option>
                                  <option value="4">Individual</option>
                                  <option value="5">Sold</option>
                                  <option value="6">Tend to transfer</option>
                              </select>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-4 form-group">
                              <label>Property Highlight</label>
                              <select class="form-control" ng-model="form.property_highlight_id">
                                  <option value="">All</option>
                                  <option value="1">Sale at Lost and Plus</option>
                                  <option value="2">Sale at Cost</option>
                                  <option value="3">Sale under Market Price</option>
                                  <option value="4">Made Over already</option>
                              </select>
                          </div>
                          <div class="col-md-4 form-group">
                              <label>Feature unit</label>
                              <select class="form-control" ng-model="form.feature_unit_id">
                                  <option value="">All</option>
                                  <option value="1">Best Buy</option>
                                  <option value="2">Hot Rental</option>
                                  <option value="3">With Tenant</option>
                                  <option value="4">New Coming</option>
                              </select>
                          </div>
                          <div class="col-md-4 form-group">
                              <label>Web status</label>
                              <select ng-model="form.web_status" class="form-control">
                                  <option value="">All</option>
                                  <option value="1">Online</option>
                                  <option value="0">Offline</option>
                              </select>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label>Order By</label>
                          <select ng-model="form.orderBy" ng-init="form.orderBy='property.updated_at'" class="form-control">
                              <option value="property.updated_at">update date</option>
                              <option value="property.reference_id">reference ID</option>
                              <option value="property.rented_expire">rent expire</option>
                              <option value="project.name">project name</option>
                              <option value="property.sell_price">sell price</option>
                              <option value="property.rent_price">rent price</option>
                              <option value="property.size">size</option>
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
                              <button type="submit" class="btn btn-success" ng-click="filterProps()">Search</button>
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
    <div style="overflow-x: auto;">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th></th>
                <th>#</th>
                <th>Details</th>
                <th>Requirement</th>
                <th>Size</th>
                <th>Sell</th>
                <th>Rent</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="prop in props.data">
                <td><input type="checkbox" ng-model="inputProps[prop.id.toString()]"></td>
                <td>{{prop.reference_id}}</td>
                <td>
                    <div><strong>Project</strong>: <span>{{prop.project_name}}</span></div>
                    <!-- <div><strong>Type</strong>: <span>{{prop.property_type_name}}</span></div> -->
                    <div><strong>Bed room</strong>: <span>{{prop.bedrooms}}</span></div>
                    <div><strong>Bath room</strong>: <span>{{prop.bathrooms}}</span></div>
                    <div ng-if="prop.address_no"><strong>Address no</strong>: <span>{{prop.address_no}}</span></div>
                    <!-- <div><strong>Transfer Status</strong>: <span>{{prop.property_status_name}}</span></div> -->
                </td>
                <td>{{prop.requirement_name}}</td>
                <td>{{prop.size}} {{prop.size_unit_name}}</td>
                <td><span ng-hide="!prop.sell_price">฿{{commaNumber(prop.sell_price)}}</span></td>
                <td><span ng-hide="!prop.rent_price">฿{{commaNumber(prop.rent_price)}}</span></td>
                <td>{{prop.property_status_name}}</td>
                <td><a class="xcrud-action btn btn-warning btn-sm" href="properties#edit/{{prop.id}}" target="_blank">View</a></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center">
      <button class="btn btn-success" ng-click="importClick()">Import match</button>
    </div>
    <div>
      <ul class="pagination">
        <!-- <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li> -->
        <li ng-repeat="page in pagination track by $index">
          <a href="" ng-click="setPage($index)">{{($index+1)}}</a>
        </li>
        <!-- <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li> -->
      </ul>
    </div>
</div>
