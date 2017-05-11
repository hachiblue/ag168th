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
    
    <div style="overflow-x: auto;">
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
            	<th>ชื่อเล่น</th>
                <th>ชื่อ - นามสกุล</th>
                <th></th>
             
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="prop in profiles.data">
                <td>{{prop.nickname}} ({{prop.nickname_en}})</td>
                <td>{{prop.name}} {{prop.surname}}</td>
                <td>
                  <a class="xcrud-action btn btn-warning btn-sm" href="profile#/{{prop.account_id}}" target="_blank"><i class="glyphicon glyphicon-edit"></i></a>
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
