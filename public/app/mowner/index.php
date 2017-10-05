
<div ng-controller="ListCTL as ctrl" layout="column" ng-cloak>
  <div class="panel panel-primary">
      <div class="panel-heading">
          <h3 class="panel-title">Owner Mapping</h3>
      </div>
      <div class="panel-body">

        <md-content class="md-padding" layout="row" layout-xs="column" layout-align="center center">

          <div flex="30" layout-padding>
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
          </div>

          <div flex layout-padding>
            <div layout="column">
              <md-list-item ng-repeat="list in owner_lists">
                <md-checkbox ng-model="list.selected"></md-checkbox>
                <p>{{list.title}}</p>
              </md-list-item>
            </div>
          </div>

          <div flex layout-padding>
            <md-button class="md-raised md-warn" ng-click="updateOwner();">Update</md-button>
          </div>

        </md-content>

      </div>
  </div>
</div>
