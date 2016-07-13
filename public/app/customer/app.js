/**
 * Created by NuizHome on 8/4/2558.
 */

var app = angular.module('customer-app', ['ngRoute']);
app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '../public/app/customer/list.html'
            }).
            when('/add', {
                templateUrl: '../public/app/customer/add.html',
                controller: 'AddCTL'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route){
    $scope.customers = [];
    $http.get("../api/customer").success(function(data){
        $scope.customers = data.data;
    });

    $scope.remove = function(id){
        if(!window.confirm("Are you sure?")){
            return;
        }
        $http.delete("../api/customer/"+ id).success(function(data){
            if(typeof data.error == 'undefined'){
                $route.reload();
            }
        });
    };
}]);

app.controller('AddCTL', ['$scope', '$http', '$location', function($scope, $http, $location){
    $scope.form = {};
    $scope.form.sex = "male";
    $scope.addSubmit = function(){
        $http.post("../api/customer", $scope.form).success(function(data){
            if(typeof data.error == 'undefined'){
                $location.path("/");
            }
        });
    };
}]);
