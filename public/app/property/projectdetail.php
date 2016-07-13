<?php session_start();?>
<div ng-controller="ProjectdetailCTL">
<?php include(dirname(__FILE__).'/head.php');?>
<div>
  <h3>Project name: {{project.name}}</h3>

<div class="detailProjectUndeline">

    <div class="row">
      <div class="col-md-12">
        <div class="row" style="border: none;">
          <div class="col-md-8"><img src="{{project.image_url}}"></div>
        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Telephone</div>
          <div class="col-md-8">{{project.tel_company}}</div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Number building</div>
          <div class="col-md-8">{{project.number_buildings}}</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Number units</div>
          <div class="col-md-8">{{project.number_units}}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Number Floors</div>
          <div class="col-md-8">{{project.number_floors}}</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Common area floor</div>
          <div class="col-md-8">{{project.common_area_floor}}</div>
        </div>
      </div>
    </div>
    <!-- has options -->

    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Builder by</div>
          <div class="col-md-8">{{project.builder_by}}</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Address</div>
          <div class="col-md-8">{{project.address}}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Province</div>
          <div class="col-md-8">{{project.province.name}}</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">District</div>
          <div class="col-md-8">{{project.district.name}}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Sub District</div>
          <div class="col-md-8">{{project.sub_district.name}}</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Near BTS</div>
          <div class="col-md-8">{{project.bts.name}}</div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Near MRT</div>
          <div class="col-md-8">{{project.mrt.name}}</div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">Near Airport link</div>
          <div class="col-md-8">{{project.airport_link.name}}</div>
        </div>
      </div>
    </div>

      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">Location</div>
            <div class="col-md-8">{{project.location_lat}}, {{project.location_lng}}</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4">Zone</div>
            <div class="col-md-8">{{project.zone.name}}</div>
          </div>
        </div>
      </div>
</div>

  <hr>
  <h3>Feature</h3>
  <div class="row">
    <div class="col-md-12" ng-if="project.has_swimming_pool">+ Swimming Pool</div>
    <div class="col-md-12" ng-if="project.has_onsen">+ Onsen</div>
    <div class="col-md-12" ng-if="project.has_gym">+ Gym</div>
    <div class="col-md-12" ng-if="project.has_garden">+ Garden</div>
    <div class="col-md-12" ng-if="project.has_futsal">+ Futsal</div>
    <div class="col-md-12" ng-if="project.has_badminton">+ Badminton</div>
    <div class="col-md-12" ng-if="project.has_basketball">+ Basketball</div>
    <div class="col-md-12" ng-if="project.has_tennis">+ Tennis</div>
    <div class="col-md-12" ng-if="project.has_bowling">+ Bowling</div>
    <div class="col-md-12" ng-if="project.has_pool_room">+ Pool Room</div>
    <div class="col-md-12" ng-if="project.has_game_room">+ Game Room</div>
    <div class="col-md-12" ng-if="project.has_playground">+ Playground</div>
    <div class="col-md-12" ng-if="project.has_meeting_room">+ Meeting Room</div>
    <div class="col-md-12" ng-if="project.has_private_butler">+ Private Butler</div>
    <div class="col-md-12" ng-if="project.has_shuttle_bus">+ Shuttle Bus</div>
    <div class="col-md-12" ng-if="project.has_minimart_supermarket">+ Minimart Supermarket</div>
    <div class="col-md-12" ng-if="project.has_restaurant">+ Restaurant</div>
    <div class="col-md-12" ng-if="project.has_laundry_service">+ Swimming pool</div>
    <div class="col-md-12" ng-if="project.has_private_parking">+ Private Parking</div>
    <div class="col-md-12" ng-if="project.has_bathtub_inside_unit">+ Bathtub Inside Unit</div>
  </div>
</div>
</div>
<style>
.detailProjectUndeline > .row .row {
  margin-bottom: 5px;
  border-bottom: 1px solid #333;
}
</style>
