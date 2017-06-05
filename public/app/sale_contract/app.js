
"use strict";

var app = angular.module('sale_contract-app', ['ngRoute', 'angular-loading-bar', 'localytics.directives']);

app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function($routeProvider, cfpLoadingBarProvider)
    {
        $routeProvider.
        when('/',
        {
            templateUrl: '../public/app/sale_contract/list.php'
        }).
        otherwise(
        {
            redirectTo: '/'
        });
    }
]);

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route)
{
    $scope.items = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15;

    function getItems(query)
    {
       

    }

  
}]);
