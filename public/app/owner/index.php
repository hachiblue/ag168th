
<div ng-controller="ListCTL as ctrl" layout="column" ng-cloak>
  <div class="panel panel-primary">
      <div class="panel-heading">
          <h3 class="panel-title">Owner Search</h3>
      </div>
      <div class="panel-body">
        <md-content class="md-padding">
          <form ng-submit="$event.preventDefault()">
           
            <md-autocomplete
                ng-disabled="ctrl.isDisabled"
                md-no-cache="ctrl.noCache"
                md-selected-item="ctrl.selectedItem"
                md-search-text-change="ctrl.searchTextChange(ctrl.searchText)"
                md-search-text="ctrl.searchText"
                md-selected-item-change="ctrl.selectedItemChange(item)"
                md-items="item in ctrl.querySearch(ctrl.searchText)"
                md-item-text="item.display"
                md-min-length="0"
                placeholder="ค้นหา owner">
              <md-item-template>
                <span md-highlight-text="ctrl.searchText" md-highlight-flags="i">{{item.display}}</span>
              </md-item-template>
              <md-not-found>
                No states matching "{{ctrl.searchText}}" were found.
              </md-not-found>
            </md-autocomplete>
            <!-- <br/>

            <md-checkbox ng-model="ctrl.simulateQuery">Simulate query for results?</md-checkbox>
            <md-checkbox ng-model="ctrl.noCache">Disable caching of queries?</md-checkbox>
            <md-checkbox ng-model="ctrl.isDisabled">Disable the input?</md-checkbox> -->

          </form>
          <br>
          <br>
          <form ng-submit="saveOwner()" id="form-owner" name="form-owner">
            <div id="owners">
              
              <div id="row_1" class="row">
                <div class="col-sm-2 col-md-2 form-group">
                  <label>Owner Name</label>
                  <input class="form-control" ng-model="form.owner_name1" pattern="[^,:.]+" required>
                </div>

                <div class="col-sm-2 col-md-3 form-group">
                  <label>Owner Phone</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <input class="form-control" name="cphone" ng-model="form.owner_phone1a" pattern="[^,:.]+" maxlength="3">
                    </div>
                    <div class="col-sm-4">
                      <input class="form-control" name="cphone" ng-model="form.owner_phone1b" pattern="[^,:.]+" maxlength="3">
                    </div>
                    <div class="col-sm-5">
                      <input class="form-control" name="cphone" ng-model="form.owner_phone1c" pattern="[^,:.]+">
                    </div>
                  </div>
                </div>

                <div class="col-sm-1 col-md-2 form-group">
                  <label>Email, Line Id</label>
                  <input class="form-control" ng-model="form.owner_email1" pattern="[^,:]+">
                </div>

                <div class="col-sm-2 col-md-2 form-group">
                  <label>Customer VIP</label>
                  <input class="form-control" ng-model="form.owner_cust1" pattern="[^,:]+">
                </div>

                <div class="col-sm-2 col-md-2 form-group">
                  <label>&nbsp;</label>
                  <div class="md-fab md-mini md-primary" aria-label="Add Owner" style="cursor:pointer;" ng-click="addOwner();">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </div>
                </div>
              </div>

            </div>
          

            <br>

            <div class="row">

              <div class="col-md-2 pull-right">
                <button class="btn btn-warning" ng-click="deleteOwners()">Delete This Owners</button>
              </div>

              <div class="col-md-2 pull-right">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              
            </div>
          </form>

          <div id="tmpl-owners">
          
            <div class="col-sm-2 col-md-2 form-group">
              <label>Owner Name</label>
              <input class="form-control" ng-model="form.owner_name1" pattern="[^,:.]+" required>
            </div>

            <div class="col-sm-2 col-md-3 form-group">
              <label>Owner Phone</label>
              <div class="row">
                <div class="col-sm-3">
                  <input class="form-control" name="cphone" ng-model="form.owner_phone1a" pattern="[^,:.]+" maxlength="3">
                </div>
                <div class="col-sm-4">
                  <input class="form-control" name="cphone" ng-model="form.owner_phone1b" pattern="[^,:.]+" maxlength="3">
                </div>
                <div class="col-sm-5">
                  <input class="form-control" name="cphone" ng-model="form.owner_phone1c" pattern="[^,:.]+">
                </div>
              </div>
            </div>

            <div class="col-sm-1 col-md-2 form-group">
              <label>Email, Line Id</label>
              <input class="form-control" ng-model="form.owner_email1" pattern="[^,:]+">
            </div>

            <div class="col-sm-2 col-md-2 form-group">
              <label>Customer VIP</label>
              <input class="form-control" ng-model="form.owner_cust1" pattern="[^,:]+">
            </div>

            <div class="col-sm-2 col-md-2 form-group">
              <label>&nbsp;</label>
              <div class="md-fab md-mini md-warn" aria-label="Delete Owner" style="cursor:pointer;" onclick="delOwner(this, 1);">
                <i class="fa fa-minus" aria-hidden="true"></i>
              </div>
            </div>

          </div>

        </md-content>
      </div>
  </div>
</div>
