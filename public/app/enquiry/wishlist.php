<?php session_start();?>
<style>
.chosen-single{  
  background-color: #fff !important; 
}
.no-padd {
  padding: 0px;
}
</style>
<div ng-controller="WishListCTL">
    <div>
        <form name="searchForm" ng-submit="addSubmit()">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Wish List</h3>
                </div>
                <div class="panel-body">
                  <div class="row">

                      <div class="col-md-3 form-group">
                          <label class="control-label">Project</label>
                          <div>
                              <select chosen class="form-control"
                              ng-model="form.project_id"
                              ng-options="item.id as item.name for item in collection.project">
                                  <option value="">All</option>
                              </select>
                          </div>
                      </div>

                      <div class="col-md-1">
                        <label class="control-label">Unit</label>
                          <select class="form-control" ng-init="form.size_unit_id=1" ng-model="form.size_unit_id">
                              <option value="1">Sq. m.</option>
                              <option value="2">Sq. wa</option>
                              <option value="3">Rai</option>
                          </select>
                      </div>

                      <div class="col-md-2">
                        <label>Building</label>
                        <input type="text" class="form-control" ng-model="form.building" id="building">
                      </div>

                      <div class="col-md-2">

                        <label class="control-label">Floor</label>

                        <div>
                          <div class="col-md-5 no-padd">
                            <input type="number" class="form-control" ng-model="form.floor_start" id="floor_start">
                          </div>
                          <div class="col-md-2"> to </div>
                          <div class="col-md-5 no-padd">
                            <input type="number" class="form-control" ng-model="form.floor_end" id="floor_end">
                          </div>
                        </div>

                      </div>

                      <div class="col-md-2">

                        <label class="control-label">Sqm</label>

                        <div>
                          <div class="col-md-5 no-padd">
                            <input type="number" class="form-control" ng-model="form.sqm_start" id="sqm_start">
                          </div>
                          <div class="col-md-2"> to </div>
                          <div class="col-md-5 no-padd">
                            <input type="number" class="form-control" ng-model="form.sqm_end" id="sqm_end">
                          </div>
                        </div>

                      </div>

                  </div>

                  <div class="row">
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

                    <div class="col-md-2 form-group">
                        <label class="control-label">BTS</label>
                        <div>
                          <select class="form-control"
                          ng-model="form.bts_id"
                          ng-options="item.id as item.name for item in collection.bts"
                          >
                          <option value="">All</option>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-2 form-group">
                        <label class="control-label">MRT</label>
                        <div>
                          <select class="form-control"
                          ng-model="form.mrt_id"
                          ng-options="item.id as item.name for item in collection.mrt"
                          >
                          <option value="">All</option>
                        </select>
                        </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-2">
                      <label>Selling price from</label>
                      <input type="number" class="form-control" ng-model="form.selling_start" id="selling_start">
                    </div>
                    <div class="col-md-1">
                      <label>&nbsp;</label>
                      <div><b>to</b></div>
                    </div>
                    <div class="col-md-2">
                      <label>&nbsp;</label>
                      <input type="number" class="form-control" ng-model="form.selling_end" id="selling_end">
                    </div>

                    <div class="col-md-2">
                      <label>Rental price from</label>
                      <input type="number" class="form-control" ng-model="form.rental_start" id="rental_start">
                    </div>
                    <div class="col-md-1">
                      <label>&nbsp;</label>
                      <div><b>to</b></div>
                    </div>
                    <div class="col-md-2">
                      <label>&nbsp;</label>
                      <input type="number" class="form-control" ng-model="form.rental_end" id="rental_end">
                    </div>

                  </div>

                  <div class="row">
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-success">Submit</button>
                      </div>
                  </div>
                </div>
            </div>
        </form>
        <div class="pull-right"><strong>Summary</strong>: {{items.total}}</div>
    </div>

    <div style="overflow-x: auto;">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>no.</th>
                <th>Project</th>
                <th>Unit</th>
                <th>Building</th>
                <th>Floor</th>
                <th>Sqm</th>
                <th>Selling Price</th>
                <th>Rental Price</th>
                <th>In Stock</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="item in items.data">
                <td>{{$index + 1}}</td>
                <td>{{item.project_name}}</td>
                <td>{{item.size_name}}</td>
                <td>{{item.building}}</td>
                <td>{{item.floor_start}} - {{item.floor_end}}</td>
                <td>{{item.sqm_start}} - {{item.sqm_end}}</td>
                <td>{{item.selling_start}} - {{item.selling_end}}</td>
                <td>{{item.rental_start}} - {{item.rental_end}}</td>
                <td>
                  <a href="properties?project_id={{item.project_id}}&size_unit_id={{item.size_unit_id}}&building_no={{item.building}}&zone_id={{item.zone_id}}&size_start={{item.sqm_start}}&size_end={{item.sqm_end}}&sell_price_start={{item.selling_start}}&sell_price_end={{item.selling_end}}&rent_price_start={{item.rental_start}}&rent_price_end={{item.rental_end}}&mrt_id={{item.mrt_id}}&bts_id={{item.bts_id}}#/" ng-show="item.ismatch"><button class="btn btn-success">Property</button></a> 
                  <a ng-click="delete_wishlist(item.id)"><button class="btn btn-warning">Del</button></a>
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





<script>
$(function(){
  $.fn.datepicker.defaults.format = "yyyy-mm-dd";
  $('#created_at_start').datepicker();
  $('#created_at_end').datepicker();
  $('#updated_at_start').datepicker();
  $('#updated_at_end').datepicker();
});
</script>
