/**
 * Created by NuizHome on 8/4/2558.
 */

"use strict";

var app = angular.module('phonereq-app', ['ngRoute', 'angular-loading-bar']);
app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function($routeProvider, cfpLoadingBarProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '../public/app/phonereq/list.php'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route){
  $scope.items = [];
  $scope.form = {};
  $scope.form.page = 1;
  function getData() {
    var promise1 = Q.promise(function (resolve, reject) {
      $.get("../api/phonereq?page="+$scope.form.page, function(data){
        resolve(data);
      }, "json");
    });

    promise1.then(function(data){
      $scope.list = data;
      if(data.total > 0){
        $scope.pagination = [];
        for(var i = 1; i * data.paging.limit <= data.total; i++) {
          $scope.pagination.push(data.paging.page == i);
        }
      }
      else {
        $scope.pagination = null;
      }
      $scope.$apply();
    });
  }
  getData();

  function upateStatus(id, status_id){
    var item = $scope.list.data.find(function(o, index){
      if(o.id == id) {
        return o;
      }
    });
    if(item) {
      item.status_id = status_id;
    }
  }

  $scope.onClickApply = function(id){
    $.post("../api/phonereq/" + id + "/accept", function(data){
      if(data.error) {
        alert(data.error.message);
        return;
      }
      upateStatus(id, 2);
      $scope.$apply();
    }, "json");
  };
  $scope.onClickDenine = function(id){
    $.post("../api/phonereq/" + id + "/denine", function(data){
      if(data.error) {
        alert(data.error.message);
        return;
      }
      upateStatus(id, 3);
      $scope.$apply();
    }, "json");
  };

  $scope.setPage = function($index) {
    if($index < 1 || $index > $scope.pagination.length)
      return;

    $scope.form.page = $index;
    getData();
  };
}]);
