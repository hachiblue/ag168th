<?php session_start();?>
<div ng-controller="ListCTL">
  <form ng-submit="getProps(1)">
       
    <div class="row">


      <div class="col-md-3 form-group">
            <label class="control-label">User</label>
            <div>
              <select class="form-control"
              ng-model="form.account_comment_id"
              ng-options="item.aid*1 as item.aname for item in gmessages.groupcomment.data"
              >
              <option value="">All</option>
            </select>
            </div>
        </div>

        <div class="col-md-3 form-group">
            <label class="control-label">Report Type</label>
            <div>
              <select class="form-control"
              ng-model="form.report_type"
              >
              <option value="property" selected>Property</option>
              <option value="enquiry">Enquiry</option>
              <option value="phonerequest">Phone Request</option>
            </select>
            </div>
        </div>

    </div>

    <div class="row">
      <div class="col-md-3 el-custom-1">
        <label>User Updated start</label>
        <input type="text" class="form-control" ng-model="form.user_updated_at_start"
        id="user_updated_at_start">
      </div>
      <div class="col-md-3 el-custom-1">
        <label>User Updated end</label>
        <input type="text" class="form-control" ng-model="form.user_updated_at_end"
        id="user_updated_at_end">
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
            <button type="reset" class="btn btn-success">Reset</button>
            <span ng-if="isShowTotal()">Search total: {{props.total}} item</span>
        </div>
    </div>
  </form>



    <table class="table table-striped table-hover ">
      <thead>
      <tr>
          <th>#</th>
          <th>Date/Time</th>
          <th>Details</th>
          <th>Comment</th>
          <!-- <th>Total Unit</th> -->
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="prop in props.data ">
          <td>{{prop.reference_id}}</td>
          <td>{{prop.updated_at}}</td>
          <td>
              <div><strong>Project</strong>: <span>{{prop.project_name}}</span></div>
              <div ng-if="prop.address_no"><strong>Address no</strong>: <span>{{prop.address_no}}</span></div>
              <div ng-if="prop.floors"><strong>Floor</strong>: <span>{{prop.floors}}</span></div>
              <!-- <div><strong>Type</strong>: <span>{{prop.property_type_name}}</span></div> -->
              <div ng-if="prop.bedrooms"><strong>Bed room</strong>: <span>{{prop.bedrooms}}</span></div>
              <div ng-if="prop.bathrooms"><strong>Bath room</strong>: <span>{{prop.bathrooms}}</span></div>
              <div ng-if="prop.customer"><strong>Customer</strong>: <span>{{prop.customer}}</span></div>
              <!-- <div><strong>Transfer Status</strong>: <span>{{prop.property_status_name}}</span></div> -->
          </td>
          <td style="width:40%;">{{prop.comment}}</td>
         
          <td><a class="btn btn-info" href="{{prop.mode}}#/edit/{{prop.id}}" target="_blank">View</a></td>
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

  $('#user_updated_at_start').datepicker();
  $('#user_updated_at_end').datepicker();
});
</script>
