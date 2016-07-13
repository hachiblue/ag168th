/**
 * Created by NuizHome on 8/4/2558.
 */

"use strict";

var app = angular.module('bookreq-app', ['ngRoute', 'angular-loading-bar']);
app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function($routeProvider, cfpLoadingBarProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '../public/app/bookreq/list.php'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route){
  $scope.items = [];
  var promise1 = Q.promise(function (resolve, reject) {
    $.get("../api/bookreq", function(data){
      resolve(data);
    }, "json");
  });

  promise1.then(function(data){
    $scope.list = data;
    $scope.$apply();
  });

  function upateStatus(id, status_id){
    var item = $scope.list.data.find(function(o, index){
      if(o.id == id) {
        return o;
      }
    });
    if(item) {
      item.status = status_id;
      item.wait_book_approve = 0;
    }
  }

  $scope.onClickApply = function(id){
    $.post("../api/bookreq/" + id + "/accept", function(data){
      if(data.error) {
        alert(data.error.message);
        return;
      }
      upateStatus(id, 1);
      $scope.$apply();
    }, "json");
  };
  $scope.onClickDenine = function(id){
    $.post("../api/bookreq/" + id + "/denine", function(data){
      if(data.error) {
        alert(data.error.message);
        return;
      }
      upateStatus(id, 2);
      $scope.$apply();
    }, "json");
  };
}]);
