
<div ng-controller="ListCTL as ctrl" layout="column" ng-cloak>
  <div class="panel panel-primary">
      <div class="panel-heading">
          <h3 class="panel-title">Owner Mapping</h3>
      </div>
      <div class="panel-body">

        <md-content class="md-padding" layout="row" layout-xs="column" layout-align="center top">
          
          <form ng-submit="$event.preventDefault()">
            
            <md-content class="md-padding" layout="column" layout-xs="column" layout-align="center bottom">
              <md-input-container>
                <label>Search Owner</label>
                <input ng-model="owner" ng-change="findowners()">
              </md-input-container>

              <div flex layout-padding>
                <md-button class="md-raised md-warn" ng-click="updateOwner();">Update</md-button>
              </div>
            </md-content>

            <!-- <md-autocomplete
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
            </md-autocomplete> -->
            <!-- <br/>

            <md-checkbox ng-model="ctrl.simulateQuery">Simulate query for results?</md-checkbox>
            <md-checkbox ng-model="ctrl.noCache">Disable caching of queries?</md-checkbox>
            <md-checkbox ng-model="ctrl.isDisabled">Disable the input?</md-checkbox> -->

          </form>

          <div flex="40" layout-padding>
            <div layout="column">
              <md-toolbar layout="row" class="md-accent">
                <div class="md-toolbar-tools">
                  <span>Owner that need to be ( main )</span>
                </div>
              </md-toolbar>

              <md-radio-group ng-model="main_selected">
                <div ng-repeat="list in owner_main" style="margin: 20px 0;">
                  <md-radio-button value="{{list.id}}"><p>{{list.display}}</p></md-radio-button>
                </div>
              </md-radio-group>
            </div>
          </div>

          <div flex="40" layout-padding>
            <div layout="column">
              <md-toolbar layout="row" class="md-hue-1">
                <div class="md-toolbar-tools">
                  <span>Owner that need to replace ( sub )</span>
                </div>
              </md-toolbar>
              <md-list-item ng-repeat="list in owner_sub">
                <md-checkbox ng-model="list.sselected"></md-checkbox>
                <p>{{list.display}}</p>
              </md-list-item>
            </div>
          </div>

          

        </md-content>

      </div>
  </div>
</div>
