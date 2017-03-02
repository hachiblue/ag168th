
var app = angular.module('leave-app', ['ngRoute', 'angular-loading-bar', 'localytics.directives', 'ngMaterial']);

app.config(['$routeProvider', 'cfpLoadingBarProvider', '$mdDateLocaleProvider',
    function ($routeProvider, cfpLoadingBarProvider, $mdDateLocaleProvider)
    {
		
		$mdDateLocaleProvider.formatDate = function(date) {
			return moment(date).format('YYYY-MM-DD');
		};

        $routeProvider.
        when('/',
        {
            templateUrl: '../public/app/leave/index.php'
        }).
        when('/add',
        {
            templateUrl: '../public/app/leave/add.php'
        }).
        when('/edit/:id',
        {
            templateUrl: '../public/app/leave/edit.php'
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

app.controller('IndexCTL', ['$scope', '$mdDialog', '$compile', '$http', '$location', '$route', '$routeParams', function ($scope, $mdDialog, $compile, $http, $location, $route, $routeParams) {

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
		
			var ang_html = $compile(calendar)($scope);
			$('#calendar').html( ang_html );

		});

		//window.open('/admin/leave#/m/'+$scope.form.month+'/y/'+$scope.form.year+'', '_self');
		//window.location.reload();

    };

	$scope.doedit = function ()
	{
		window.location = '/edit';
	};

	$scope.submit();
	
	$scope.showAdvanced = function(ev, m, y, d) {
		$mdDialog.show({
			controller: DialogController,
			templateUrl: '../api/leave/whos?y='+y+'&m='+m+'&d='+d,
			parent: angular.element(document.body),
			targetEvent: ev,
			clickOutsideToClose:true
		})
		.then(function(answer) {
			$scope.status = 'You said the information was "' + answer + '".';
		}, function() {
			$scope.status = 'You cancelled the dialog.';
		});
	};

	function DialogController($scope, $mdDialog) 
	{
		$scope.hide = function() {
			$mdDialog.hide();
		};

		$scope.cancel = function() {
			$mdDialog.cancel();
		};

		$scope.answer = function(answer) {
			$mdDialog.hide(answer);
		};
	}

	window.s = $scope;
}]);

app.controller('AddCTL', ['$scope', '$compile', '$http', '$location', function ($scope, $compile, $http, $location) {
	
	$scope.form = {};

    $scope.isSaving = false;
    $scope.initSuccess = true;
	
	$http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
		
		var i;
		var acc = $scope.collection.account;
		var strAcc = '';

		for( i in acc )
		{
			strAcc += acc[i].name + '#' + acc[i].id + '|';
		}

		$scope.accounts = (strAcc.slice(0, -1)).split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

		$scope.levels = ('System Admin#1|Admin#2|Manager#3|Sale#4').split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

    });

	
	$scope.submit = function ()
    {
		
		if( $scope.form.account_id === undefined || $scope.form.account_id == '' )
		{
			alert('Need Name');
			return;
		}

		if( $scope.form.level_id === undefined || $scope.form.level_id == '' )
		{
			alert('Need ตำแหน่ง');
			return;
		}

		$scope.form.rqperiod_from_date = typeof $scope.form.rqperiod_from_date == 'object' ? getDate( $scope.form.rqperiod_from_date ) : '';
		$scope.form.rqperiod_to_date = typeof $scope.form.rqperiod_to_date == 'object' ? getDate( $scope.form.rqperiod_to_date ) : '';
		$scope.form.rqshift_date = typeof $scope.form.rqshift_date == 'object' ? getDate( $scope.form.rqshift_date ) : '';

		//$scope.form.rqshift_from_tm = typeof $scope.form.rqshift_from_tm == 'object' ? getDate( $scope.form.rqshift_from_tm ) : '';

        $.post("../api/leave", $scope.form, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            //window.location.reload();]
			window.location = '';

        }, 'json');
    };

	function getDate(date)
	{
		if( date === null ) return '';

		var dd = date.getDate();
		var mm = date.getMonth() + 1; //January is 0!

		var yyyy = date.getFullYear();
		if (dd < 10)
		{
			dd = '0' + dd;
		}
		if (mm < 10)
		{
			mm = '0' + mm;
		}
		return yyyy + '-' + mm + '-' + dd;
	}
	
	function setDate(date)
	{
		//2017-02-22

		if( date == '0000-00-00' ) return '';

		var dt1   = parseInt(date.substr(8,2));
		var mon1  = parseInt(date.substr(5,2));
		var yr1   = parseInt(date.substr(0,4));
		var date1 = new Date(yr1, mon1-1, dt1);

		return date1;
	}

    window.s = $scope;

    //$.fn.datepicker.defaults.format = "yyyy-mm-dd";
    //$('.rented_expire').datepicker();
}]);

app.controller('EditCTL', ['$scope', '$compile', '$http', '$location', '$routeParams', function ($scope, $compile, $http, $location, $routeParams) {
	
	$scope.form = {};

    $scope.isSaving = false;
    $scope.initSuccess = true;
	
	$http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
		
		var i;
		var acc = $scope.collection.account;
		var strAcc = '';

		for( i in acc )
		{
			strAcc += acc[i].name + '#' + acc[i].id + '|';
		}

		$scope.accounts = (strAcc.slice(0, -1)).split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

		$scope.levels = ('System Admin#1|Admin#2|Manager#3|Sale#4').split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

    });

	function getLeaveData()
	{
		$http.get("../api/leave/edit/" + $routeParams.id).success(function (data)
        {
			data.rqperiod_from_date = setDate( data.rqperiod_from_date );
			data.rqperiod_to_date = setDate( data.rqperiod_to_date );
			data.rqshift_date = setDate( data.rqshift_date );

            $scope.form = data;
        });
	}

    $scope.submit = function ()
    {
		
		if( $scope.form.account_id === undefined || $scope.form.account_id == '' )
		{
			alert('Need Name');
			return;
		}

		if( $scope.form.level_id === undefined || $scope.form.level_id == '' )
		{
			alert('Need ตำแหน่ง');
			return;
		}

		$scope.form.rqperiod_from_date = typeof $scope.form.rqperiod_from_date == 'object' ? getDate( $scope.form.rqperiod_from_date ) : '';
		$scope.form.rqperiod_to_date = typeof $scope.form.rqperiod_to_date == 'object' ? getDate( $scope.form.rqperiod_to_date ) : '';
		$scope.form.rqshift_date = typeof $scope.form.rqshift_date == 'object' ? getDate( $scope.form.rqshift_date ) : '';

		//$scope.form.rqshift_from_tm = typeof $scope.form.rqshift_from_tm == 'object' ? getDate( $scope.form.rqshift_from_tm ) : '';

        $.post("../api/leave/edit/" + $routeParams.id, $scope.form, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            //window.location.reload();]
			window.location = '';

        }, 'json');
    };

	$scope.remove = function (id)
    {
        if (!window.confirm("Are you sure?"))
        {
            return;
        }

        $http.delete("../api/leave/" + id).success(function (data)
        {

            if (typeof data.error == 'undefined')
            {
                //$route.reload();
            }

			window.location = 'leave';

        });
    };

	function getDate(date)
	{
		if( date === null ) return '';

		var dd = date.getDate();
		var mm = date.getMonth() + 1; //January is 0!

		var yyyy = date.getFullYear();
		if (dd < 10)
		{
			dd = '0' + dd;
		}
		if (mm < 10)
		{
			mm = '0' + mm;
		}
		return yyyy + '-' + mm + '-' + dd;
	}
	
	function setDate(date)
	{
		//2017-02-22

		if( date == '0000-00-00' ) return '';

		var dt1   = parseInt(date.substr(8,2));
		var mon1  = parseInt(date.substr(5,2));
		var yr1   = parseInt(date.substr(0,4));
		var date1 = new Date(yr1, mon1-1, dt1);

		return date1;
	}
	
	getLeaveData();

    window.s = $scope;

}]);