<?php session_start();?>
<div ng-controller="RentalCTL">

	<div style="overflow-x: auto;">
		<table class="table table-striped table-hover ">
			<thead>
			<tr>
				<th></th>
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
				<td><a href="properties#/edit/{{prop.id}}"><button class="btn btn-success">View</button></a></td>
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
			&& $index > 0 && $index < p_pagination.length - 1">
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