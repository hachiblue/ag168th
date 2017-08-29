"use strict";
var app = angular.module( 'timetable-app', [ 'ngRoute', 'angular-loading-bar', 'localytics.directives', 'ngMaterial' ] );
app.config( [ '$routeProvider', 'cfpLoadingBarProvider',
    function ( $routeProvider, cfpLoadingBarProvider )
    {
        $routeProvider.
        when( '/',
        {
            templateUrl: '../public/app/timetable/index.php'
        } ).
        otherwise(
        {
            redirectTo: '/'
        } );
    }
] );
app.controller( 'IndexCTL', [ '$scope', '$http', '$location', '$route',
    function ( $scope, $http, $location, $route )
    {
        function getTimeTables( )
        {
            $http.get( "../api/timetable" ).success( function ( data )
            {
                $scope.items = data;
            } );
        }
        getTimeTables( );
        $scope.Reset = function ( )
        {
            $scope.new_ondate = '';
            $scope.new_time_out = '';
            $scope.new_time_in = '';
            $scope.new_reference_id = '';
            $scope.new_enquiry_no = '';
            $scope.new_project = '';
            $scope.new_description = '';
            $scope.new_client = '';
            $scope.new_sale = '';
            $scope.new_manager = '';
        }
        $scope.Reset( );
        $scope.Add = function ( )
        {
            $('#input_0').css('border-color', 'rgba(0,0,0,0.12)');
            $('#input_1').css('border-color', 'rgba(0,0,0,0.12)');

            if ( !$scope.new_ondate || !$scope.new_time_out )
            {
                !$scope.new_ondate && $('#input_0').css('border-color', 'red');
                !$scope.new_time_out && $('#input_1').css('border-color', 'red');
                return false;
            }
            // Add to main records
            var params = {
                ondate: $scope.new_ondate,
                time_out: $scope.new_time_out,
                time_in: $scope.new_time_in,
                reference_id: $scope.new_reference_id,
                enquiry_no: $scope.new_enquiry_no,
                project: $scope.new_project,
                project_id: $scope.new_project_id,
                description: $scope.new_description,
                client: $scope.new_client,
                sale: $scope.new_sale,
                manager: $scope.new_manager
            };
            $.post( "../api/timetable", params, function ( data )
            {
                if ( data.error )
                {
                    alert( data.error.message );
                    return;
                }
                //$scope.items.push(data);
                getTimeTables( );
            }, 'json' );
            // See $Scope.Reset...
            $scope.Reset( );
        };
        $scope.Save = function ( idx )
        {
            var sid = $scope.items[ idx ].id;
            $.post( "../api/timetable/edit/" + sid, $scope.items[ idx ], function ( data )
            {
                if ( data.error )
                {
                    alert( data.error.message );
                    return;
                }
                //$scope.items.push(data);
                getTimeTables( );
            }, 'json' );
        };
        $scope.getProject = function ( idx )
        {
            var ref = 'new' == idx ? $scope.new_reference_id : $scope.items[idx].reference_id;
            $http.get( "../api/timetable/project/"+ref).success( function ( data )
            {
                if( 'new' !== idx )
                {
                    $scope.items[idx].project = data.project || '';
                    $scope.items[idx].project_id = data.project_id || '';
                }
                else
                {
                    $scope.new_project = data.project;
                    $scope.new_project_id = data.project_id;
                }
                
            } );
        };

        window.s = $scope;
    }
] );
