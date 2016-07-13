/**
 * Created by NuizHome on 8/4/2558.
 */

 function numberWithCommas(x) {
   if(!x) {
      return "";
   }
   return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
 }

var app = angular.module('enquiry-app', ['ngRoute', 'angular-loading-bar']);
app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function($routeProvider, cfpLoadingBarProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '../public/app/reportproperty/list.php'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);


app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route){
    $scope.props = [];
    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15

    $scope.getProps = function(page){
      if(page) $scope.page = page;
        // if(!$scope.form.created_at_start || !$scope.form.created_at_start) {
        //   alert('Require created start and created end');
        //   return;
        // }

        var url = "../api/report_property";
        url += "?" + $.param($scope.form);
        $http.get(url).success(function(data){
            $scope.props = data;
            if(data.total > 0){
              $scope.pagination = [];
              var numPage = Math.ceil(data.total/$scope.form.limit);
              for(var i = 1; i <= numPage; i++) {
                $scope.pagination.push(data.paging.page == i);
              }
            }
            else {
              $scope.pagination = null;
            }
        });
    };

    $scope.downloadCsv = function(){
      var url = "../api/report_property/csv";
      url += "?" + $.param($scope.form);
      document.location = url;
    };

	$scope.downloadCsvVip = function(){
      var url = "../api/report_property/csv_vip";
      url += "?" + $.param($scope.form);
      document.location = url;
    };

    $scope.setPage = function($index) {
      if($index < 1 || $index > $scope.pagination.length)
        return;

      $scope.form.page = $index;
      $scope.getProps();
    };

    $http.get("../api/collection").success(function(data){
        $scope.collection = data;
        $scope.collection.project = data.project.sort(function(a, b) {
          if(a.name.toLowerCase() < b.name.toLowerCase()) return -1;
          if(a.name.toLowerCase() > b.name.toLowerCase()) return 1;
          return 0;
        });
    });

    $http.get("../api/collection/thailocation").success(function(thailocation) {
      $scope.thailocation = thailocation;
    });

    $scope.filterProps = function(){
        $scope.getProps($scope.form);
    };

    $scope.isShowTotal = function(){
      return typeof $scope.props.total != 'undefined';
    };

    $scope.commaNumber = numberWithCommas;
}]);
