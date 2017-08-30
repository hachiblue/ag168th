
var app = angular.module('leave-app', ['ngRoute', 'angular-loading-bar', 'localytics.directives', 'ngMaterial']);

app.config(['$routeProvider', 'cfpLoadingBarProvider', '$mdDateLocaleProvider',
    function ($routeProvider, cfpLoadingBarProvider, $mdDateLocaleProvider)
    {
		//$mdDateLocaleProvider.formatDate = function(date) {
			//return moment(date).format('YYYY-MM-DD');
		//};

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

app.controller('AddCTL', ['$scope', '$compile', '$http', '$location', '$routeParams', function ($scope, $compile, $http, $location, $routeParams) {
	
	$scope.form = {};

    $scope.isSaving = false;
    $scope.initSuccess = true;

    var sv = this;
	
	$http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
		
		var i;
		var acc = $scope.collection.lv_account;
		var acc_self = $scope.collection.lv_self_account[0];
		var strAcc = '';

		$scope.form.account_name = acc_self.name;
		$scope.form.account_id = acc_self.id;
		$scope.form.level_id = acc_self.level_id;

		for( i in acc )
		{
			strAcc += acc[i].name + '#' + acc[i].id + '|';
		}

		$scope.accounts = (strAcc.slice(0, -1)).split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

		var j;
		var lev = $scope.collection.levels;
		var strlev = '';
		for( j in lev )
		{
			strlev += lev[j].name + '#' + lev[j].id + '|';
		}
		$scope.levels = (strlev.slice(0, -1)).split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

		$scope.hours = getHours();
		$scope.minutes = getMinutes();	
    });

	$scope.submit = function ()
    {	
		if( $scope.form.rq_approve_id === undefined || $scope.form.rq_approve_id == '' )
		{
			alert('Need Approver');
			return;
		}

		if( ($scope.form.late_flag === undefined || $scope.form.late_flag == '') &&
			($scope.form.rqshift_flag === undefined || $scope.form.rqshift_flag == '') &&
			($scope.form.rqperiod_flag === undefined || $scope.form.rqperiod_flag == '') 
		  )
		{
			alert('Need Leave Mode');
			return;
		}

		if( ($scope.form.rqshift_flag == 'y') &&
			($scope.form.rqshift_date === undefined || $scope.form.rqshift_date == '') 
		  )
		{
			alert('กรุณาใส่วันที่ลา');
			return;
		}

		if( ($scope.form.rqperiod_flag == 'y') &&
			($scope.form.rqperiod_from_date === undefined || $scope.form.rqperiod_from_date == '') 
		  )
		{
			alert('กรุณาใส่วันที่ลา ตั้งแต่วันที่');
			return;
		}

		$scope.form.rqperiod_from_date = typeof $scope.form.rqperiod_from_date == 'object' ? getDate( $scope.form.rqperiod_from_date ) : '';
		$scope.form.rqperiod_to_date = typeof $scope.form.rqperiod_to_date == 'object' ? getDate( $scope.form.rqperiod_to_date ) : '';
		$scope.form.rqshift_date = typeof $scope.form.rqshift_date == 'object' ? getDate( $scope.form.rqshift_date ) : '';

		/**
		 * rqshift_from_tm
		 */
		var h = '00';
		var m = '00';
		if( typeof $scope.form.f_hours != 'undefined' ) 
		{
			h = $scope.form.f_hours;
		}
		
		if( typeof $scope.form.f_minutes != 'undefined' ) 
		{
			m = $scope.form.f_minutes;
		}

		$scope.form.rqshift_from_tm = h + ':' + m;

		/**
		 * rqshift_to_tm
		 */
		h = '00';
		if( typeof $scope.form.t_hours != 'undefined' ) 
		{
			h = $scope.form.t_hours;
		}
		
		m = '00';
		if( typeof $scope.form.t_minutes != 'undefined' ) 
		{
			m = $scope.form.t_minutes;
		}

		$scope.form.rqshift_to_tm = h + ':' + m;

		/**
		 * rqshift_leave_total_tm
		 */
		h = '00';
		if( typeof $scope.form.total_time_hours != 'undefined' ) 
		{
			h = $scope.form.total_time_hours;
		}
		
		m = '00';
		if( typeof $scope.form.total_time_minutes != 'undefined' ) 
		{
			m = $scope.form.total_time_minutes;
		}

		$scope.form.rqshift_leave_total_tm = h + ':' + m;

        $.post("../api/leave", $scope.form, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            if( data )
            {
            	var fd = new FormData( );
		        angular.forEach( $scope.images_upload, function ( value, key )
		        {
		            fd.append( 'images[' + key + ']', value );
		        } );

		        //console.log(fd); return false;
		        $scope.isUpload = true;
		        $http.post( "../api/leave/upload/"+data, fd,
		        {
		            transformRequest: angular.identity,
		            headers:
		            {
		                'Content-Type': undefined
		            }
		        } ).success( function ( data )
		        {
		        	$scope.isUpload = false;
		            window.location = '';
		        } );
            }

            //window.location.reload();]
			

        }, 'json');
    };

    $scope.images_upload = [ ];
	$scope.parseImagesInput = function ( input )
	{
		$scope.images_upload = input.files;
	};

    window.s = $scope;

    //$.fn.datepicker.defaults.format = "yyyy-mm-dd";
    //$('.rented_expire').datepicker();
}]);

app.controller('EditCTL', ['$scope', '$compile', '$http', '$location', '$routeParams', function ($scope, $compile, $http, $location, $routeParams) {
	
	$scope.form = {};
	$scope.minutes = [];
	$scope.hours = [];
	$scope.acc_self = {};

    $scope.isSaving = false;
    $scope.initSuccess = true;
	
	$http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
		
		var i;
		var acc = $scope.collection.lv_account;
		var acc_self = $scope.collection.lv_self_account[0];
		var strAcc = '';
		
		$scope.acc_self = acc_self;


		for( i in acc )
		{
			strAcc += acc[i].name + '#' + acc[i].id + '|';
		}

		$scope.accounts = (strAcc.slice(0, -1)).split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

		var j;
		var lev = $scope.collection.levels;
		var strlev = '';
		for( j in lev )
		{
			strlev += lev[j].name + '#' + lev[j].id + '|';
		}
		$scope.levels = (strlev.slice(0, -1)).split('|').map(function(state) {
			var states = state.split('#');
			return {abbrev: states[0], va: states[1]};
		});

		$scope.hours = getHours();
		$scope.minutes = getMinutes();	
	});

	function getLeaveData()
	{
		$http.get("../api/leave/edit/" + $routeParams.id).success(function (data)
        {
			data.rqperiod_from_date = setDate( data.rqperiod_from_date );
			data.rqperiod_to_date = setDate( data.rqperiod_to_date );
			data.rqshift_date = setDate( data.rqshift_date );
			

			data.f_hours = setHours( data.rqshift_from_tm );
			data.t_hours = setHours(data.rqshift_to_tm );
			data.total_time_hours = setHours( data.rqshift_leave_total_tm );
			data.f_minutes = setMinutes( data.rqshift_from_tm );
			data.t_minutes = setMinutes( data.rqshift_to_tm );
			data.total_time_minutes = setMinutes( data.rqshift_leave_total_tm );

            $scope.form = data;
			$scope.form.image = '/public/file_pics/' + data.img;

			$scope.form.account_name = $scope.acc_self.name;
			$scope.form.account_id = $scope.acc_self.id;
			$scope.form.level_id = $scope.acc_self.level_id;
        });
	}

    $scope.submit = function ()
    {
		if( $scope.form.rq_approve_id === undefined || $scope.form.rq_approve_id == '' )
		{
			alert('Need Approver');
			return;
		}

		if( ($scope.form.late_flag === undefined || $scope.form.late_flag == '') &&
			($scope.form.rqshift_flag === undefined || $scope.form.rqshift_flag == '') &&
			($scope.form.rqperiod_flag === undefined || $scope.form.rqperiod_flag == '') 
		  )
		{
			alert('Need Leave Mode');
			return;
		}

		if( ($scope.form.rqshift_flag == 'y') &&
			($scope.form.rqshift_date === undefined || $scope.form.rqshift_date == '') 
		  )
		{
			alert('กรุณาใส่วันที่ลา');
			return;
		}

		if( ($scope.form.rqperiod_flag == 'y') &&
			($scope.form.rqperiod_from_date === undefined || $scope.form.rqperiod_from_date == '') 
		  )
		{
			alert('กรุณาใส่วันที่ลา ตั้งแต่วันที่');
			return;
		}

		$scope.form.rqperiod_from_date = typeof $scope.form.rqperiod_from_date == 'object' ? getDate( $scope.form.rqperiod_from_date ) : '';
		$scope.form.rqperiod_to_date = typeof $scope.form.rqperiod_to_date == 'object' ? getDate( $scope.form.rqperiod_to_date ) : '';
		$scope.form.rqshift_date = typeof $scope.form.rqshift_date == 'object' ? getDate( $scope.form.rqshift_date ) : '';
		
		/**
		 * rqshift_from_tm
		 */
		var h = '00';
		var m = '00';
		if( typeof $scope.form.f_hours != 'undefined' ) 
		{
			h = $scope.form.f_hours;
		}
		
		if( typeof $scope.form.f_minutes != 'undefined' ) 
		{
			m = $scope.form.f_minutes;
		}

		$scope.form.rqshift_from_tm = h + ':' + m;

		/**
		 * rqshift_to_tm
		 */
		h = '00';
		if( typeof $scope.form.t_hours != 'undefined' ) 
		{
			h = $scope.form.t_hours;
		}
		
		m = '00';
		if( typeof $scope.form.t_minutes != 'undefined' ) 
		{
			m = $scope.form.t_minutes;
		}

		$scope.form.rqshift_to_tm = h + ':' + m;

		/**
		 * rqshift_leave_total_tm
		 */
		h = '00';
		if( typeof $scope.form.total_time_hours != 'undefined' ) 
		{
			h = $scope.form.total_time_hours;
		}
		
		m = '00';
		if( typeof $scope.form.total_time_minutes != 'undefined' ) 
		{
			m = $scope.form.total_time_minutes;
		}

		$scope.form.rqshift_leave_total_tm = h + ':' + m;



        $.post("../api/leave/edit/" + $routeParams.id, $scope.form, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            if( data )
            {
            	var fd = new FormData( );
		        angular.forEach( $scope.images_upload, function ( value, key )
		        {
		            fd.append( 'images[' + key + ']', value );
		        } );

		        //console.log(fd); return false;
		        $scope.isUpload = true;
		        $http.post( "../api/leave/upload/"+$routeParams.id, fd,
		        {
		            transformRequest: angular.identity,
		            headers:
		            {
		                'Content-Type': undefined
		            }
		        } ).success( function ( data )
		        {
		        	$scope.isUpload = false;
		            window.location = '';
		        } );
            }

        }, 'json');
    };

    $scope.images_upload = [ ];
	$scope.parseImagesInput = function ( input )
	{
		$scope.images_upload = input.files;
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

	getLeaveData();

    window.s = $scope;
}]);


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

function getHours()
{
	var hours = [], h = 0, hh;
	while( h <= 24 )
	{
		if( h < 10 )
		{
			hh = '0' + h;
		}
		else
		{
			hh = '' + h;
		}

		hours.push(hh);
		h++;
	}

	return hours;
}

function getMinutes()
{
	var minutes = [], m = 0, mm;
	while( m <= 59 )
	{
		if( m < 10 )
		{
			mm = '0' + m;
		}
		else
		{
			mm = '' + m;
		}

		minutes.push(mm);
		m++;
	}

	return minutes;
}

function setHours(tm)
{
	var tm = tm.split(':');
	return tm[0];
}

function setMinutes(tm)
{
	var tm = tm.split(':');
	return tm[1];
}