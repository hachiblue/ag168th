<?php session_start();?>

<style>
	.panel-heading {
    	background-color: #009688;
		color: rgba(255,255,255,.84);
    	border: 0;
	}
	thead{
		background-color:#fff;
	}
	tr.read{
		background-color: #D1FFF7 !important;
	}
	.table>tbody+tbody {
		border-top: 1px solid #ddd;
	}
</style>



<div ng-controller="ListCTL">

<div class="content">
	<div class="panel-heading">
    	<h3 class="panel-title">Book Request</h3>
    </div>
    <div class="table-phone">
    	<table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Enquiry</th>
                <th>Property</th>
                <th>Account</th>
                <th></th>
            </tr>
            </thead>
            <!--thead-->
            <tbody>
            	<tr class="table-detail" ng-repeat="item in list.data">
                	<td class="ng-binding enq">
										<div><strong>Enquiry no</strong>: <a href="enquiries#/edit/{{item.id}}" target="_black">{{item.enquiry_no}}</a></div>
										<div><strong>Project</strong>: {{item.project_name_enq}}</div>
										<div><strong>Customer</strong>: {{item.customer}}</div>
										<div><strong>Requirement</strong>: {{item.req_name_for_enquiry}}</div>
									</td>
                  <td class="ng-binding pro">
										<div><strong>Property no</strong>: <a href="properties#/edit/{{item.book_property_id}}" target="_black">{{item.reference_id}}</a></div>
										<div><strong>Project</strong>: {{item.project_name}}</div>
										<div><strong>Address no</strong>: {{item.address_no}}</div>
									</td>
									<td>
										<div><strong>Manager</strong>: {{item.manager_name}}</div>
										<div><strong>Sale</strong>: {{item.sale_name}}, {{item.sale_phone}}</div>
									</td>
                	<td ng-if="item.wait_book_approve == 1">
                  		<a class="xcrud-action btn btn-success btn-sm" ng-click="onClickApply(item.id)">
												<i class="glyphicon glyphicon-ok"></i>
											</a>
                  		<a class="xcrud-action btn btn-danger btn-sm" ng-click="onClickDenine(item.id)">
												<i class="glyphicon glyphicon-remove"></i>
											</a>
                	</td>
									<td ng-if="item.wait_book_approve != 1">
											<span ng-if="item.status == 1">Accepted</span>
											<span ng-if="item.status == 2">Denined</span>
                	</td>
            	</tr>
            </tbody>
            <!--tbody-->
        </table>
    </div><!--table-phone-->
</div>
</div>
