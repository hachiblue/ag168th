<?php session_start();?>
<div ng-controller="MatchedCTL">
  <ul class="nav nav-tabs tabs-add" >
  	<li><a href="" ng-click="changeHash('/edit/'+id)">Enquiry</a></li>
  	<?php if(@$_SESSION['login']['level_id']==4 || @$_SESSION['login']['level_id']==8){?>
  	<li><a href="" ng-click="changeHash('/match/'+id)">Match Property</a></li>
    <li><a href="">Matched Property</a></li>
    <?php }?>
  	<!-- <li><a href="">Touring Report</a></li> -->
	</ul>
    <div style="overflow-x: auto;" class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Resference ID</th>
                <th>Details</th>
                <th>Requirement</th>
                <th>Size</th>
                <th>Sell</th>
                <th>Rent</th>
                <th>Status</th>
                <th>Comented</th>
                <th>Request status</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="prop in props.data">
                <td><input type="checkbox" ng-if="!prop.request_contact" ng-model="inputProps[prop.id.toString()]" name="chk_q" id="chk_{{prop.id}}" onclick="setQuotationItem(this)"></td>
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
                <td class="text-center">
                  <span ng-if="prop.request_contact.commented.toString()=='1'" class="badge" style="background-color: green;">Yes</span>
                  <span ng-if="prop.request_contact.commented.toString()=='0'" class="badge" style="background-color: red;">No</span>
                </td>
                <td>
                  <span ng-if="prop.request_contact.status_id.toString()=='1'" class="badge" style="background-color: gray;">Waiting approve..</span>
                  <span ng-if="prop.request_contact.status_id.toString()=='2'" class="badge" style="background-color: green;">Approved</span>
                  <span ng-if="prop.request_contact.status_id.toString()=='3'" class="badge" style="background-color: red;">Denine</span>
                </td>
                <td><a class="xcrud-action btn btn-warning btn-sm" href="properties#/edit/{{prop.id}}" target="_blank">View</a></td>
                <td><button ng-show="<?php echo json_encode(@$_SESSION['login']['level_id'] == 2);?>" class="xcrud-action btn btn-danger btn-sm" ng-click="removeMathClick(prop)">Delete Match</button></td>
            </tr>
            </tbody>
        </table>
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
    <div class="text-center">

		<a href="#quotation/168" class="btn btn-info">Request Quotation</a>

		<button class="btn btn-success"
		ng-hide="prop.request_contact"
		ng-click="clickRequestContact()">Request Contact</button>

    </div>
</div>
