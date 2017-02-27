
var app = angular.module('leave-app', ['ngRoute', 'angular-loading-bar', 'localytics.directives']);

app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function ($routeProvider, cfpLoadingBarProvider)
    {
        $routeProvider.
        when('/',
        {
            templateUrl: '../public/app/leave/index.php'
        }).
        when('/add',
        {
            templateUrl: '../public/app/leave/add.php'
        }).
        when('/m/:month/y/:year',
        {
            templateUrl: '../public/app/leave/index.php'
        }).
        otherwise(
        {
            redirectTo: '/'
        });
    }
]);


app.controller('IndexCTL', ['$scope', '$compile', '$http', '$location', '$route', '$routeParams', function ($scope, $compile, $http, $location, $route, $routeParams) {

    $scope.form = {};
	
	var d = new Date();
	var m = d.getMonth();
	var y = d.getFullYear();
	
	if( typeof $routeParams.month != 'undefined' )
	{
		m = $routeParams.month;
	}

	if( typeof $routeParams.year != 'undefined' )
	{
		y = $routeParams.year;
	}

	$scope.form.month = +m+1;
	$scope.form.year = y;
	
	$scope.submit = function ()
    {
		
		$.get("../api/leave", $scope.form, function ( calendar ) {

			$('#calendar').html( $compile(calendar)($scope) );

		});

		//window.open('/admin/leave#/m/'+$scope.form.month+'/y/'+$scope.form.year+'', '_self');
		//window.location.reload();

    };

	$scope.submit();

	window.s = $scope;

}]);