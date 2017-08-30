
<?php

session_start();

?>
<style type="text/css">
  
  .tbl-timetable tr td {
    padding: 0 4px 0 4px !important;
    vertical-align: middle !important;
  }

  .tbl-timetable tr td input {
    border: none;
  }

  thead th {
    text-align: center;
    vertical-align: middle !important;
  }

</style>

<div ng-controller="IndexCTL as ctrl" layout="column" ng-cloak ng-init="editAllow=<?=json_encode(@$_SESSION['login']['level_id'] == 4);?>">
  <div class="panel panel-primary">
      <div class="panel-heading">
          <h3 class="panel-title text-center">Property Consultant's Time Table</h3>
      </div>
      <div class="panel-body">
        <md-content class="md-padding">
          <form ng-submit="$event.preventDefault()">
          
            <div class="table-responsivex">

              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <table class="tbl-timetable table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th rowspan="2">Date</th>
                            <th colspan="2">Time</th>
                            <th rowspan="2">Ac</th>
                            <th rowspan="2">Enquiry No.</th>
                            <th rowspan="2">Project</th>
                            <th rowspan="2">Description</th>
                            <th rowspan="2">Client</th>
                            <th rowspan="2">Sale</th>
                            <th rowspan="2">Manager</th>
                            <th rowspan="2">
                              
                            </th>
                          </tr>
                          <tr>
                            <th style="width: 5%;">Out</th>
                            <th style="width: 5%;">In</th>
                          </tr>

                        </thead>
                        <tbody>
                          <tr ng-repeat="tt in items">
                            <td>
                              <input ng-model="tt.ondate" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.time_out" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.time_in" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.reference_id" class="form-control" ng-change="getProject($index);" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.enquiry_no" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.project" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.description" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.client" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.sale" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <input ng-model="tt.manager" class="form-control" ng-disabled="!editAllow">
                            </td>
                            <td>
                              <md-button ng-click="Save($index);" class="md-fab md-mini md-primary" aria-label="Save" ng-show="editAllow && !tt.isapprove">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                              </md-button>
                              <md-button ng-click="Save($index);" class="md-fab md-mini md-warn" aria-label="Save" ng-show="!editAllow && !tt.isapprove">
                                <i class="fa fa-check" aria-hidden="true"></i>
                              </md-button>
                              <md-button ng-click="Save($index);" class="md-fab md-mini md-primary" aria-label="Save" ng-show="!editAllow && tt.isapprove" style="background-color: #8BC34A;">
                                <i class="fa fa-check" aria-hidden="true"></i>
                              </md-button>
                              <md-button class="md-fab md-mini md-primary" aria-label="Save" ng-show="editAllow && tt.isapprove" style="background-color: #8BC34A;">
                                <i class="fa fa-check" aria-hidden="true"></i>
                              </md-button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <table class="table" ng-show="editAllow">
                <tr>
                  <td>
                    <md-input-container class="md-block">
                      <label>Date</label>
                      <input ng-model="new_ondate">
                    </md-input-container>
                  </td>
                  <td style="width: 6%;">
                    <md-input-container class="md-block">
                      <label>Out</label>
                      <input ng-model="new_time_out">
                    </md-input-container>
                  </td>
                  <td style="width: 6%;">
                    <md-input-container class="md-block">
                      <label>In</label>
                      <input ng-model="new_time_in">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>AC</label>
                      <input ng-model="new_reference_id" ng-change="getProject('new');">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>Enq No.</label>
                      <input ng-model="new_enquiry_no">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>Project</label>
                      <input ng-model="new_project">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>Desc</label>
                      <input ng-model="new_description">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>Client</label>
                      <input ng-model="new_client">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>Sale</label>
                      <input ng-model="new_sale">
                    </md-input-container>
                  </td>
                  <td>
                    <md-input-container class="md-block">
                      <label>Manager</label>
                      <input ng-model="new_manager">
                    </md-input-container>
                  </td>
                  <td>
                    <md-button class="md-fab md-mini md-warn" aria-label="Add New" ng-click="Add();">
                      <i class="fa fa-plus" aria-hidden="true"></i>
                    </md-button>
                  </td>
                </tr>
              </table>
            </div>

            <div class="clearfix"></div>
         
          </form>
        </md-content>
      </div>
  </div>
</div>
