/**
 * Created by NuizHome on 8/4/2558.
 */

"use strict";

//angular.module('angularTable', []);
var app = angular.module('property-app', ['ngRoute', 'angular-loading-bar']);
app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function($routeProvider, cfpLoadingBarProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '../public/app/property/list.php'
            }).
            when('/add', {
                templateUrl: '../public/app/property/add.php'
            })
            .when('/edit/:id', {
                templateUrl: '../public/app/property/edit.php'
            }).
            when('/:id/gallery', {
                templateUrl: '../public/app/property/gallery.php'
            }).
            when('/:id/match', {
                templateUrl: '../public/app/property/match.php'
            }).
            when('/:id/projectdetail', {
                templateUrl: '../public/app/property/projectdetail.php'
            }).
            otherwise({
                redirectTo: '/'
            });
    }]);

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route) {

	$scope.props = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15;

    function getProps(query)
	{
        var url = "../api/property";

        if(query)
		{
            url += "?" + $.param($scope.form);
        }

        $http.get(url).success(function(data) {

			$scope.props = data;
			if(data.total > 0)
			{
				$scope.pagination = [];
				var numPage = Math.ceil(data.total / $scope.form.limit);
				for(var i = 1; i <= numPage; i++) 
				{
					$scope.pagination.push(data.paging.page == i);
				}
			}
			else 
			{
				$scope.pagination = null;
			}

        });
    }

    getProps($scope.form);
	
	$scope.sort = function(keyname)
	{
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
		
		$scope.form.orderBy = keyname;
		$scope.form.orderType = !$scope.reverse ? 'ASC' : 'DESC';

		getProps($scope.form);
    };

	$scope.setPage = function($index) 
	{
		if($index < 1 || $index > $scope.pagination.length)
			return;

		$scope.form.page = $index;
		getProps($scope.form);
    };

	$scope.displayDotLeft = function()
	{
		if($scope.form.page > 5) return true;
	};

    $scope.filterProps = function()
	{
		getProps($scope.form);
    };

    $http.get("../api/collection").success(function(data) {
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

    $scope.remove = function(id)
	{
        if(!window.confirm("Are you sure?"))
		{
            return;
        }

        $http.delete("../api/property/"+ id).success(function(data) {

            if(typeof data.error == 'undefined')
			{
                $route.reload();
            }

        });
    };

    $scope.getZoneGroupName = function(id)
	{
		var arr = $.grep($scope.collection.zone_group, function(o){ return o.id == id; });

		if (arr.length == 0) 
		{
			return "";
		} 
		else 
		{
			return arr[0].name;
		}
    };

    $scope.commaNumber = numberWithCommas;

}]);

app.controller('AddCTL', ['$scope', '$compile', '$http', '$location', function($scope, $compile, $http, $location){
    $scope.isSaving = false;
    $scope.initSuccess = false;
    var itv = setInterval(function() {
      if($scope.collection && $scope.thailocation) {
        $scope.initSuccess = true;
        clearInterval(itv);
      }
    }, 100);

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

    $scope.getDistrict = function() {
      if(!$scope.initSuccess) return [];
      return $scope.thailocation.district.filter(function(item){
        return item.province_id == $scope.form.province_id;
      });
    };

    $scope.getSubDistrict = function() {
      if(!$scope.initSuccess) return [];
      return $scope.thailocation.sub_district.filter(function(item){
        return item.
        district_id == $scope.form.district_id;
      });
    };

    $scope.getRequirementList = function(){
	  
	  if( $scope.collection == undefined ) return false;
      return $scope.collection.requirement.filter(function(item){
        return item.id != 5 || $scope.form.property_status_id == 4;
      });
    };

	$scope.formPropertyTypeChange = function()
	{
		if($scope.form.property_type_id == '1') 
		{
			$('#project_id').prop('required', true);
		}
		else 
		{
			$('#project_id').prop('required', false);
			delete $scope.form.project_id;
		}
		
		var u1 = 1;

		switch( +$scope.form.property_type_id )
		{
			case 1 :
					$scope.form.size_unit_id = '1';
				break;
			case 2 :
					$scope.form.size_unit_id = '2';
				break;
			case 8 :
					$scope.form.size_unit_id = '3';
				break;
			default : $scope.form.size_unit_id = '0';
		}
	};

    $scope.formProjectIdChange = function(){
      var project = false;
      if($scope.form.project_id) {
        project = (function(){
          var i = 0;
          for(i=0; i < $scope.collection.project.length; i++) {
            if($scope.collection.project[i].id == $scope.form.project_id)
              return $scope.collection.project[i];
          }
          return false;
        })();
      }
      if(project) {
        $scope.form.zone_id = project.zone_id;
        $scope.form.airport_link_id = project.airport_link_id;
        $scope.form.bts_id = project.bts_id;
        $scope.form.province_id = project.province_id;
        $scope.form.district_id = project.district_id;
        $scope.form.sub_district_id = project.sub_district_id;
        $scope.form.mrt_id = project.mrt_id;
      }
    };

    $scope.formPropertyStatusIdChange = function()
	{
		if($scope.form.property_status_id != 4 && $scope.form.requirement_id == 5) delete $scope.form.requirement_id;
		
		var statusID = this.form.property_status_id;
		
		$("#input-rented_exp").prop("required", false);
		switch( +statusID )
		{
			case 1 : this.form.web_status = 1;break;

			case 2 : 
			case 4 : 
			case 5 : 
			case 6 : 
			case 7 : 
			case 8 : 
			case 9 : this.form.web_status = 0;break;

			case 3 : 
					this.form.web_status = 0;
					$("#input-rented_exp").prop("required", true);
				break;
		}
    };

	$scope.formGetProject = function()
	{
		var projectID = $scope.form.project_id, form = $scope.form;
		$http.get("../api/property/project/" + projectID).success(function(data) {

			form.zone_id = data.zone_id;
			form.province_id = data.province_id;
			form.district_id = data.district_id;
			form.sub_district_id = data.sub_district_id;
			form.bts_id = data.bts_id;
			form.mrt_id = data.mrt_id;
			form.airport_link_id = data.airport_link_id;

		});
	};

	$scope.formRequirementChange = function() 
	{
		switch( +$scope.form.requirement_id )
		{
			case 1 :
					$("#input-sellingprice").prop("disabled", false).prop("required", true);
					$("#input-rentprice").prop("disabled", true).prop("required", false).val('');
				
				break;

			case 2 :
					
					$("#input-sellingprice").prop("disabled", true).prop("required", false).val('');
					$("#input-rentprice").prop("disabled", false).prop("required", true);
				
				break;
			case 3 :
			case 4 :
					
					$("#input-sellingprice").prop("disabled", false).prop("required", true);
					$("#input-rentprice").prop("disabled", false).prop("required", true);
				
				break;
		}

		$scope.formChkContractUpChange();
	};
	
	$scope.formChkContractUpChange = function()
	{
		var up_percent = 0, tmp_plus = 0;

		if( this.form.chkcontact1 === true ) up_percent += 0.033;
		if( this.form.chkcontact2 === true ) up_percent += 0.005;
		if( this.form.chkcontact3 === true ) up_percent += 0.02;
		if( this.form.chkcontact4 === true ) up_percent += 0.01;
		
		tmp_plus = this.form.contract_price * up_percent;

		if( $scope.form.requirement_id != 2 && $scope.form.requirement_id != undefined )
		{
			this.form.sell_price = parseFloat(this.form.contract_price) + tmp_plus;
		}
		
		var chk1 = ( this.form.chkcontact1 === true)? 1 : 0;
		var chk2 = ( this.form.chkcontact2 === true)? 1 : 0;
		var chk3 = ( this.form.chkcontact3 === true)? 1 : 0;
		var chk4 = ( this.form.chkcontact4 === true)? 1 : 0;

		this.form.contract_chk_key = chk1 + ',' + chk2 + ',' + chk3 + ',' + chk4;
	};

    window.s = $scope;

    $scope.submit = function(){
      if(!$scope.form.comment) {
        alert("please comment when add");
        return;
      }
		
		var bedrooms = this.form.bedrooms || '';
		var bathrooms = this.form.bathrooms || '';
		if( this.form.room_type_id == 1 && ((bedrooms == '' || bedrooms == 0) || (bathrooms == '' || bathrooms == 0)) )
		{
			alert("Studio need Bed Room and Bath Room");
			return false;
		}

      // if(!$scope.form.bts_id && !$scope.form.mrt_id && !$scope.form.airport_link_id) {
      //   alert("Please chose mts or mrt or airport link.");
      //   return;
      // }

        // var fd = new FormData();
        // angular.forEach($scope.form, function(value, key) {
        //     fd.append(key, value);
        // });

      //   $scope.isSaving = true;
      //   $http.post("../api/property", $scope.form
      //   // , {
      //   //     transformRequest: angular.identity,
      //   //     headers: {'Content-Type': undefined}
      //   // }
      // ).success(function(data){
      //       $scope.isSaving = false;
      //       if(typeof data.error == 'undefined'){
      //           $location.path("/");
      //       }
      //   });

      if(!window.confirm('Are you sure?')) return;

		var i, k, owner = '';

		for( i in $scope.form )
		{
			if( i.indexOf("owner_name") != -1 )	
			{
				k = i.replace("owner_name", "");
				owner += $scope.form["owner_name"+k] + ',' + $scope.form["owner_phone"+k] + ',' + $scope.form["owner_cust"+k] + ':';
			}
		}

		$scope.form.owner = owner.substring(owner.length-1, -1);

		$.post("../api/property", $scope.form, function(data) {

			if(data.error) 
			{
				alert(data.error.message);
				return;
			}

			// window.location.hash = "/";
			window.location.reload();
		}, 'json');
    };

    $scope.getZoneGroupName = function(id){
      var arr = $.grep($scope.collection.zone_group, function(o){ return o.id == id; });
      if (arr.length == 0) {
        return "";
      } else {
        return arr[0].name;
      }
    };
	
	$scope.addmore_owner = function() {
		
		var 
			moreowner = $("#moreowner"),
			tmpl = $("#tmpl-owner"),
			html, lastrow;
		
		if( moreowner.find('.row').length )
		{
			lastrow = moreowner.find('.row').last()[0].id;
			this.ctn = lastrow.replace('row_', '');
			this.ctn++;
		}
		else
		{
			if( typeof this.ctn == 'undefined' ) this.ctn = 2;
		}

		html = '<div class="row" id="row_'+this.ctn+'">' + tmpl.html()
										.replace('owner_name1', 'owner_name'+this.ctn)
										.replace('owner_phone1', 'owner_phone'+this.ctn)
										.replace('owner_cust1', 'owner_cust'+this.ctn)
										.replace('ng-click="addmore_owner();"', 'onclick="s.delmore_owner(this, ' + this.ctn + ')"')
										.replace("plus", "minus") + '</div>';
		
		moreowner.append( $compile(html)($scope) );

	};

	$scope.delmore_owner = function(obj, c) {
		
		var moreowner = $("#moreowner");

		$(obj).parents(".row").remove();

		delete this.form["owner_name"+c];
		delete this.form["owner_phone"+c];
		delete this.form["owner_cust"+c];
	};


    $scope.images = [];
    $scope.parseImagesInput = function(input){
        $scope.images = input.files;
    };

    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
    $('.rented_expire').datepicker();
}]);

app.controller('EditCTL', ['$scope', '$compile', '$http', '$location', '$route', '$routeParams', function($scope, $compile, $http, $location, $route, $routeParams) {

	$scope.form = null;
	$scope.collection = null;
	$scope.thailocation = null;

	$http.get("../api/collection").success(function(data) {
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

	$http.get("../api/property/" + $routeParams.id).success(function(data) {

		$scope.reference_id = data.reference_id;
		$scope.owner = data.owner;
		$scope.form = data;

		var 
			i, 
			owner = data.owner.split(':'),
			tmpl = $("#tmpl-owner"), 
			moreowner = $("#moreowner"), 
			html, 
			k=2, 
			owner_field;
		
		owner_field = owner[0].split(',');

		$scope.form["owner_name1"] = owner_field[0];
		$scope.form["owner_phone1"] = owner_field[1];
		$scope.form["owner_cust1"] = owner_field[2];

		for( i in owner )
		{
			if( i == 0 ) continue;

			html = '<div class="row" id="row_'+k+'"><div class="col-md-4"></div>' 
					+ tmpl.html()
						.replace('owner_name1', 'owner_name'+k)
						.replace('owner_phone1', 'owner_phone'+k)
						.replace('owner_cust1', 'owner_cust'+k)
						.replace('ng-click="addmore_owner();"', 'onclick="s.delmore_owner(this, ' + k + ')"')
						.replace("plus", "minus") + '</div>';
			
			$(html).find('div').first().remove();

			moreowner.append( $compile(html)($scope) );
			moreowner.find('div[name=ref_id]').each(function() { $(this).remove(); });		
			
			owner_field = owner[i].split(',');

			$scope.form["owner_name"+k] = owner_field[0];
			$scope.form["owner_phone"+k] = owner_field[1];
			$scope.form["owner_cust"+k] = owner_field[2];

			k++;
		}

		$scope.formRequirementChange();
		$scope.formSetChkContract();

	});

  $scope.initSuccess = false;
  var itv = setInterval(function() {
    if($scope.form && $scope.collection && $scope.thailocation) {
      $scope.initSuccess = true;
      clearInterval(itv);
    }
  }, 100);

  $scope.getZoneGroupName = function(id){
    var arr = $.grep($scope.collection.zone_group, function(o){ return o.id == id; });
    if (arr.length == 0) {
      return "";
    } else {
      return arr[0].name;
    }
  };

  $scope.getDistrict = function() {
    if(!$scope.initSuccess) return [];
    return $scope.thailocation.district.filter(function(item){
      return item.province_id == $scope.form.province_id;
    });
  };

  $scope.getSubDistrict = function() {
    if(!$scope.initSuccess) return [];
    return $scope.thailocation.sub_district.filter(function(item){
      return item.
      district_id == $scope.form.district_id;
    });
  };
	

	$scope.formProjectIdChange = function(){
      var project = false;
      if($scope.form.project_id) {
        project = (function(){
          var i = 0;
          for(i=0; i < $scope.collection.project.length; i++) {
            if($scope.collection.project[i].id == $scope.form.project_id)
              return $scope.collection.project[i];
          }
          return false;
        })();
      }
      if(project) {
        $scope.form.zone_id = project.zone_id;
        $scope.form.airport_link_id = project.airport_link_id;
        $scope.form.bts_id = project.bts_id;
        $scope.form.province_id = project.province_id;
        $scope.form.district_id = project.district_id;
        $scope.form.sub_district_id = project.sub_district_id;
        $scope.form.mrt_id = project.mrt_id;
      }
    };

	$scope.formPropertyStatusIdChange = function()
	{
		var statusID = this.form.property_status_id;
		
		$("#input-rented_exp").prop("required", false);
		switch( +statusID )
		{
			case 1 : this.form.web_status = 1;break;

			case 2 : 
			case 4 : 
			case 5 : 
			case 6 : 
			case 7 : 
			case 8 : 
			case 9 : this.form.web_status = 0;break;

			case 3 : 
					this.form.web_status = 0;
					$("#input-rented_exp").prop("required", true);
				break;
		}
    };

	$scope.formRequirementChange = function() 
	{
		switch( +$scope.form.requirement_id )
		{
			case 1 :
					
					$("#input-sellingprice").prop("disabled", false).prop("required", true);
					$("#input-rentprice").prop("disabled", true).prop("required", false).val('');
				
				break;

			case 2 :
					
					$("#input-sellingprice").prop("disabled", true).prop("required", false).val('');
					$("#input-rentprice").prop("disabled", false).prop("required", true);
				
				break;
			case 3 :
			case 4 :
					
					$("#input-sellingprice").prop("disabled", false).prop("required", true);
					$("#input-rentprice").prop("disabled", false).prop("required", true);
				
				break;
		}

		$scope.formChkContractUpChange();
	};

	$scope.formPropertyTypeChange = function()
	{
		if($scope.form.property_type_id == 1) 
		{
			$('#project_id').prop('required', true);
		}
		else 
		{
			$('#project_id').prop('required', false);
			delete $scope.form.project_id;
		}

		switch( +$scope.form.property_type_id )
		{
			case 1 :
					$scope.form.size_unit_id = '1';
				break;
			case 2 :
					$scope.form.size_unit_id = '2';
				break;
			case 8 :
					$scope.form.size_unit_id = '3';
				break;
			default : $scope.form.size_unit_id = '0';
		}
	};

	$scope.formChkContractUpChange = function()
	{
		var up_percent = 0, tmp_plus = 0;

		if( this.form.chkcontact1 === true ) up_percent += 0.033;
		if( this.form.chkcontact2 === true ) up_percent += 0.005;
		if( this.form.chkcontact3 === true ) up_percent += 0.02;
		if( this.form.chkcontact4 === true ) up_percent += 0.01;
		
		tmp_plus = this.form.contract_price * up_percent;

		if( $scope.form.requirement_id != 2 && $scope.form.requirement_id != undefined )
		{
			this.form.sell_price = parseFloat(this.form.contract_price) + tmp_plus;
		}

		var chk1 = ( this.form.chkcontact1 === true)? 1 : 0;
		var chk2 = ( this.form.chkcontact2 === true)? 1 : 0;
		var chk3 = ( this.form.chkcontact3 === true)? 1 : 0;
		var chk4 = ( this.form.chkcontact4 === true)? 1 : 0;

		this.form.contract_chk_key = chk1 + ',' + chk2 + ',' + chk3 + ',' + chk4;
	};

	$scope.formSetChkContract = function()
	{		
		var arr_chk = this.form.contract_chk_key.split(","), i, j = 1;
		
		for( i in arr_chk )
		{
			this.form["chkcontact"+j] = (arr_chk[i] == 1)? true: false;
			j++;
		}
	};

	window.s = $scope;

  $scope.submit = function() {
    if(!$scope.form.comment) {
      alert("please comment when edit");
      return;
    }
    var form;
    if($scope.editAllow) {
      form = $scope.form;
    }
    else {
      form = {
        comment: $scope.form.comment
      };
    }

	if( form.room_type_id == 1 && ((form.bedrooms == '' || form.bedrooms == 0) || (form.bathrooms == '' || form.bathrooms == 0)) )
	{
		alert("Studio need Bed Room and Bath Room");
		return false;
	}

    if(!window.confirm('Are you sure?')) return;
	
	var i, k, owner = '';

	for( i in form )
	{
		if( i.indexOf("owner_name") != -1 )	
		{
			k = i.replace("owner_name", "");
			owner += form["owner_name"+k] + ',' + form["owner_phone"+k] + ',' + form["owner_cust"+k] + ':';
		}
	}

	form.owner = owner.substring(owner.length-1, -1);

	var rented_exp = $("#input-rented_exp").val();
	if( this.form.property_status_id == 3 && ( rented_exp == "0000-00-00" || rented_exp == "") )
	{
		$("#input-rented_exp").focus();
		return false;
	}

    $.post("../api/property/edit/" + $routeParams.id, form, function(data){
      if(data.error) {
        alert(data.error.message);
        return;
      }

      // window.location.hash = "/";
      window.location.reload();
    }, 'json');
  };
	
	$scope.addmore_owner = function() {
		
		var 
			moreowner = $("#moreowner"),
			tmpl = $("#tmpl-owner"),
			html, lastrow;
		
		if( moreowner.find('.row').length )
		{
			lastrow = moreowner.find('.row').last()[0].id;
			this.ctn = lastrow.replace('row_', '');
			this.ctn++;
		}
		else
		{
			if( typeof this.ctn == 'undefined' ) this.ctn = 2;
		}
		
		html = '<div class="row" id="row_'+this.ctn+'"><div class="col-md-4"></div>' + tmpl.html()
										.replace('owner_name1', 'owner_name'+this.ctn)
										.replace('owner_phone1', 'owner_phone'+this.ctn)
										.replace('owner_cust1', 'owner_cust'+this.ctn)
										.replace('ng-click="addmore_owner();"', 'onclick="s.delmore_owner(this, ' + this.ctn + ')"')
										.replace("plus", "minus") + '</div>';
		
		$(html).find('div').first().remove();

		moreowner.append( $compile(html)($scope) );

		moreowner.find('div[name=ref_id]').each(function() { $(this).remove(); });

	};

	$scope.delmore_owner = function(obj, c) {
		
		var moreowner = $("#moreowner");

		$(obj).parents(".row").remove();

		delete this.form["owner_name"+c];
		delete this.form["owner_phone"+c];
		delete this.form["owner_cust"+c];
	};

	$scope.id = $routeParams.id;
	$scope.changeHash = function(hash){
		window.location.hash = hash;
	};
}]);

app.controller('GalleryCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams){
    $scope.images = [];

    $scope.refreshList = function(){
        $http.get("../api/property/" + $routeParams.id + "/gallery").success(function(data){
            $scope.images = data.data;
        });
    };
    $scope.refreshList();

    $scope.isUpload = false;
    $scope.images_upload = [];
    $scope.parseImagesInput = function(input){
        $scope.images_upload = input.files;
    };

    $scope.addSubmit = function(){
        var fd = new FormData();
        angular.forEach($scope.images_upload, function(value, key) {
            fd.append('images['+key+']', value);
        });

        $scope.isUpload = true;
        $http.post("../api/property/"+ $routeParams.id + "/gallery", fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        }).success(function(data){
            $scope.isUpload = false;
            $scope.refreshList();
        });
    };

    $scope.removeAllSelect = function(){
        var listId = [];
        angular.forEach($scope.images, function(value, key){
            if(value.selected){
                listId.push(value.id);
            }
        });

        $http.delete("../api/property/"+ $routeParams.id + "/gallery?" + $.param({"id": listId})).success(function(data){
            $scope.refreshList();
        });
    };

    $scope.id = $routeParams.id;
    $scope.changeHash = function(hash){
      window.location.hash = hash;
    };
}]);

app.controller('CommentCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams) {
  var propId = $routeParams.id;
  $http.get("../api/property/" + $routeParams.id + "/comment").success(function(data){
      $scope.comments = data.data;
  });
}]);

app.controller('ProjectdetailCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams) {
  $scope.id = $routeParams.id;
  $scope.project = {};
  $http.get("../api/property/" + $routeParams.id).success(function(data){
    $http.get("../api/property/project/" + data.project_id).success(function(data2){
      $scope.project = data2;
      console.log($scope.project);
    });
  });
  $scope.id = $routeParams.id;
  $scope.changeHash = function(hash){
    window.location.hash = hash;
  };
}]);

app.controller('MatchCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams) {
  $scope.items = [];
  $scope.id = $routeParams.id;

  var promise1 = Q.Promise(function (resolve, reject) {
    $http.get("../api/property/" + $routeParams.id +"?build=1").success(function(data) {
      resolve(data);
    });
  });
  promise1.then(function(data){
    $scope.prop = data;
    if(!data.match_enquiry_id) {
      getItems();
    }
    else {
      getMatched(data);
    }
  });

  function getMatched(prop)
  {
    $scope.matched = {};
    $.get("../api/property/" + $routeParams.id +"/matched", function(data){
      if(data.error) {
        alert(data.error.message);
      }
      $scope.matched = data;
    }, "json");
  }

  function getItems(query){
      var url = "../api/enquiry";
      $http.get(url).success(function(data){
          $scope.items = data;
          if(data.total > 0){
            $scope.pagination = [];
            for(var i = 1; i * data.limit <= data.total; i++) {
              $scope.pagination.push(data.paging.page == i);
            }
          }
          else {
            $scope.pagination = null;
          }
      });
  }
  $scope.formMatch = {};
  $scope.onClickMatch = function(){
    if(!$scope.formMatch.match_enquiry_id) {
      alert("Please select enquiry");
      return;
    }
    $.post("../api/property/" + $routeParams.id +"/match", $scope.formMatch, function(data){
      if(data.error) {
        alert(data.error.message);
      }
      $route.reload();
    }, 'json');
  };
  $scope.onClickCancle = function(){
    $.post("../api/property/" + $routeParams.id +"/match/cancle", $scope.formMatch, function(data){
      if(data.error) {
        alert(data.error.message);
      }
      $route.reload();
    }, 'json');
  };
}]);

app.directive('datepicker',function($compile){
    return {
        // replace:true,
        // templateUrl:'custom-datepicker.html',
        scope: {
            ngModel: '=',
            dateOptions: '='
        },
        link: function($scope, $element, $attrs, $controller){
            $element.datepicker({
              format: 'yyyy-mm-dd'
            });
        }
    };
});

app.filter('fvip', function() {
	return function(str) {
		var vip = str.split(':');
		var first_vip = vip[0].split(',');
		return first_vip[2];
	};
});

function getDate(date){
    var dd = date.getDate();
    var mm = date.getMonth()+1; //January is 0!

    var yyyy = date.getFullYear();
    if(dd<10){
        dd='0'+dd;
    }
    if(mm<10){
        mm='0'+mm;
    }
    return yyyy+'-'+mm+'-'+dd;
}

function numberWithCommas(x) {
  if(!x) {
     return "";
  }
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}