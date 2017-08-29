"use strict";
var app = angular.module( 'owner-app', [ 'ngRoute', 'angular-loading-bar', 'localytics.directives', 'ngMaterial' ] );
app.config( [ '$routeProvider', 'cfpLoadingBarProvider',
    function ( $routeProvider, cfpLoadingBarProvider )
    {
        $routeProvider.
        when( '/',
        {
            templateUrl: '../public/app/owner/index.php'
        } ).
        otherwise(
        {
            redirectTo: '/'
        } );
    }
] );
app.controller( 'ListCTL', IndexCTL );
var delOwner = function ( obj )
{
    var owners = $( "#owners" );
    var $row = $( obj ).parents( ".row" );
    $row.remove( );
    var c = $row[ 0 ].id.replace( 'row_', '' );
    delete s.form[ "owner_name" + c ];
    delete s.form[ "owner_phone" + c + 'a' ];
    delete s.form[ "owner_phone" + c + 'b' ];
    delete s.form[ "owner_phone" + c + 'c' ];
    delete s.form[ "owner_cust" + c ];
};

function IndexCTL( $scope, $compile, $http, $timeout, $q, $log )
{
    var self = this;
    self.simulateQuery = false;
    self.isDisabled = false;
    self.noCache = false;
    // list of `state` value/display objects
    self.states = {};
    self.querySearch = querySearch;
    self.selectedItemChange = selectedItemChange;
    self.searchTextChange = searchTextChange;
    self.newState = newState;
    $scope.form = {};
    $scope.item_id = 'new';
    setphonehop( );
    $scope.addOwner = function ( )
    {
        var owners = $( "#owners" ),
            tmpl = $( "#tmpl-owners" ),
            html, lastrow, ctn = 0;
        if ( owners.find( '> .row' ).length )
        {
            lastrow = owners.find( '> .row' ).last( )[ 0 ].id;
            ctn = lastrow.replace( 'row_', '' );
            ctn++;
        }
        html = '<div class="row" id="row_' + ctn + '">' + tmpl.html( ).replace( /owner_name1/g, 'owner_name' + ctn ).replace( /owner_phone1/g, 'owner_phone' + ctn ).replace( /owner_email1/g, 'owner_email' + ctn ).replace( /owner_cust1/g, 'owner_cust' + ctn ) + '</div>';
        owners.append( $compile( html )( $scope ) );
        setphonehop( );
    };
    $scope.saveOwner = function ( )
    {
        if ( !window.confirm( 'Are you sure?' ) ) return;
        var i, k, owner = '';
        for ( i in $scope.form )
        {
            if ( i.indexOf( "owner_name" ) != -1 )
            {
                k = i.replace( "owner_name", "" );
                owner += ( $scope.form[ "owner_name" + k ] || '' ) + ',' + ( $scope.form[ "owner_phone" + k + "a" ] || '' ) + ( $scope.form[ "owner_phone" + k + "b" ] || '' ) + ( $scope.form[ "owner_phone" + k + "c" ] || '' ) + ',' + ( $scope.form[ "owner_cust" + k ] || '' ) + ',' + ( $scope.form[ "owner_email" + k ] || '' ) + ':';
            }
        }
        owner = owner.substring( owner.length - 1, -1 );
        $scope.form.id = $scope.item_id;
        $scope.form.owner = owner;
        $.post( "../api/owner", $scope.form, function ( data )
        {
            if ( data.error )
            {
                alert( data.error.message );
                return;
            }
            // window.location.hash = "/";
            $scope.form.id == 'new' && window.location.reload( );
        }, 'json' );
    };
    $scope.deleteOwners = function ( )
    {
        if ( !window.confirm( 'Are you sure?' ) ) return;
        if ( s.item_id != 'new' )
        {
            $.post( "../api/owner/delete/" + s.item_id,
            {}, function ( data )
            {
                if ( data.error )
                {
                    alert( data.error.message );
                    return;
                }
                // window.location.hash = "/";
                window.location.reload( );
            }, 'json' );
        }
    }

    function newState( state )
    {
        alert( "Sorry! You'll need to create a Constitution for " + state + " first!" );
    }
    // ******************************
    // Internal methods
    // ******************************
    /**
     * Search for states... use $timeout to simulate
     * remote dataservice call.
     */
    function querySearch( query )
    {
        var results,
            deferred,
            url = '../api/owner';
        deferred = $q.defer( );
        if ( query )
        {
            url += '?q=' + query;
        }
        $http.get( url ).success( function ( data )
        {
            self.states = data;
            results = query ? self.states.filter( createFilterFor( query ) ) : self.states;
            deferred.resolve( results );
        } );
        return deferred.promise;
    }

    function searchTextChange( text )
    {
        $log.info( 'Text changed to ' + text );
    }

    function selectedItemChange( item )
    {
        $( '[id^=row][id!=row_1]' ).remove( );
        s.form = {};
        setToEditOwner( item );
        //$log.info( 'Item changed to ' + JSON.stringify( item ) );
    }

    function setToEditOwner( item )
    {
        s.item_id = 'new';
        if ( item )
        {
            s.item_id = item.id;
            var owners = item.display.split( ':' ),
                owner;
            var i, x = 1;
            for ( i in owners )
            {
                owner = owners[ i ].split( ',' );
                s.form[ 'owner_name' + x ] = owner[ 0 ];
                s.form[ 'owner_phone' + x + 'a' ] = ( owner[ 1 ] || '' ).substring( 0, 3 );
                s.form[ 'owner_phone' + x + 'b' ] = ( owner[ 1 ] || '' ).substring( 3, 6 );
                s.form[ 'owner_phone' + x + 'c' ] = ( owner[ 1 ] || '' ).substring( 6, 6 + ( owner[ 1 ] || 0 ).length );
                s.form[ 'owner_email' + x ] = owner[ 3 ];
                s.form[ 'owner_cust' + x ] = owner[ 2 ];
                ( 'undefined' !== typeof owners[ +i + 1 ] ) && s.addOwner( );
                x++;
            }
        }
    }
    /**
     * Build `states` list of key/value pairs
     
    function loadAll( )
    {
        var allStates = 'Alabama, Alaska, Arizona, Arkansas, California, Colorado, Connecticut, Delaware,\
          Florida, Georgia, Hawaii, Idaho, Illinois, Indiana, Iowa, Kansas, Kentucky, Louisiana,\
          Maine, Maryland, Massachusetts, Michigan, Minnesota, Mississippi, Missouri, Montana,\
          Nebraska, Nevada, New Hampshire, New Jersey, New Mexico, New York, North Carolina,\
          North Dakota, Ohio, Oklahoma, Oregon, Pennsylvania, Rhode Island, South Carolina,\
          South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia,\
          Wisconsin, Wyoming';
        return allStates.split( /, +/g ).map( function ( state )
        {
            return {
                value: state.toLowerCase( ),
                display: state
            };
        } );
    }*/
    /**
     * Create filter function for a query string
     */
    function createFilterFor( query )
    {
        var lowercaseQuery = angular.lowercase( query );
        return function filterFn( state )
        {
            return ( state.value.indexOf( lowercaseQuery ) !== -1 );
        };
    }
    window.s = $scope;
}
app.controller( 'IndexCTL', [ '$scope', '$http', '$location', '$route', function ( $scope, $http, $location, $route )
{
    $scope.items = [ ];
    var getOwnerItems = function getOwnerItems( query )
    {
        var url = "../api/owner";
        if ( query )
        {
            url += "?" + $.param( $scope.form );
        }
        $http.get( url ).success( function ( data )
        {
            $scope.items = data;
        } );
    }
    getOwnerItems( );
    $scope.remove = function ( id )
    {
        if ( !window.confirm( "Are you sure?" ) )
        {
            return;
        }
        $http.delete( "../api/owner/" + id ).success( function ( data )
        {
            if ( typeof data.error == 'undefined' )
            {
                $route.reload( );
            }
        } );
    };
    window.s = $scope;
} ] );

function setphonehop( )
{
    $( "input[name=cphone]" ).keyup( function ( )
    {
        if ( this.value.length >= 3 ) $( this ).parent( ).next( ).find( "input" ).focus( );
    } );
}
Array.prototype.indexOf || ( Array.prototype.indexOf = function ( d, e )
{
    var a;
    if ( null == this ) throw new TypeError( '"this" is null or not defined' );
    var c = Object( this ),
        b = c.length >>> 0;
    if ( 0 === b ) return -1;
    a = +e || 0;
    Infinity === Math.abs( a ) && ( a = 0 );
    if ( a >= b ) return -1;
    for ( a = Math.max( 0 <= a ? a : b - Math.abs( a ), 0 ); a < b; )
    {
        if ( a in c && c[ a ] === d ) return a;
        a++
    }
    return -1
} );
