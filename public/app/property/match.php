<?php
session_start();
if(@$_SESSION['login']['level_id']!=4) {
  exit();
}
?>
<div ng-controller="MatchCTL">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="background: white; border-radius: 8px; padding: 10px;">
      <div class="row">
        <div class="col-md-6 text-right">Reference ID: </div>
        <strong><a href="#/property/{{prop.id}}" target="_blank">{{prop.reference_id}}</a></strong>
      </div>
      <div class="row"><div class="col-md-6 text-right">Address no: </div><strong>{{prop.address_no}}</strong></div>
      <div class="row"><div class="col-md-6 text-right">Project: </div><strong>{{prop.project_name}}</strong></div>
      <div class="row"><div class="col-md-6 text-right">Requirement: </div><strong>{{prop.requirement_name}}</strong></div>
    </div>
    <div class="col-md-4"></div>
  </div>
  <hr />
  <div ng-if="!prop.match_enquiry_id && prop">
    <div style="overflow-x: auto;">
        <table class="table table-striped table-hover ">
            <thead>
              <tr>
                <th></th>
                <th>Date</th>
                <th>Enquiry no</th>
                <th>Customer</th>
                <th>Requirement</th>
                <th>Property Type</th>

                <th>Buying Budget</th>
                <th>Rental Budget</th>
                <th>Status</th>

                <th>Update</th>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="item in items.data">
                  <td><input type="radio" name="formMatch.match_enquiry_id" ng-model="formMatch.match_enquiry_id" value="{{item.id}}"></td>
                  <td>{{item.created_at}}</td>
                  <td>{{item.enquiry_no}}</td>
                  <td>{{item.customer}}</td>
                  <td>{{item.name_for_enquiry}}</td>
                  <td>{{item.enquiry_type_name}}</td>

                  <td>฿{{commaNumber(item.buy_budget_start)}} - ฿{{commaNumber(item.buy_budget_end)}}</td>
                  <td>฿{{commaNumber(item.rent_budget_start)}} - ฿{{commaNumber(item.rent_budget_end)}}</td>
                  <td>{{item.enquiry_status_name}}</td>

                  <td>{{item.updated_at}}</td>
              </tr>
            </tbody>
        </table>
    </div>
    <div class="text-center">
      <button class="btn btn-success" ng-click="onClickMatch()">Match</button>
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
  <div ng-if="prop.match_enquiry_id && prop">
    <h3 class="text-center">Matched</h3>
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4" style="background: white; border-radius: 8px; padding: 10px;">
        <div class="row">
          <div class="col-md-6 text-right">Enquiry no: </div>
          <strong><a href="#/enquiry/{{matched.id}}" target="_blank">{{matched.enquiry_no}}</a></strong>
        </div>
        <div class="row"><div class="col-md-6 text-right">Customer: </div><strong>{{matched.customer}}</strong></div>
        <div class="row"><div class="col-md-6 text-right">Requirement: </div><strong>{{matched.requirement_name}}</strong></div>

        <div class="text-center">
          <button class="btn btn-danger" ng-click="onClickCancle()">Cancle Match</button>
        </div>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
</div>
