/**
 * Created by NuizHome on 8/4/2558.
 */

"use strict";

function numberWithCommas(x) {
  if(!x) {
     return "";
  }
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

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

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route){
    $scope.props = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15;
    function getProps(query){
        var url = "../api/property";
        if(query){
            url += "?" + $.param($scope.form);
        }
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
    }
    getProps($scope.form);

    $scope.setPage = function($index) {
      if($index < 1 || $index > $scope.pagination.length)
        return;

      $scope.form.page = $index;
      getProps($scope.form);
    };

    $scope.displayDotLeft = function(){
      if($scope.form.page > 5) return true;
    };

    $scope.filterProps = function(){
        console.log($scope.form);
        getProps($scope.form);
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

    $scope.remove = function(id){
        if(!window.confirm("Are you sure?")){
            return;
        }
        $http.delete("../api/property/"+ id).success(function(data){
            if(typeof data.error == 'undefined'){
                $route.reload();
            }
        });
    };

    $scope.edit = function(id){

    };

    $scope.getZoneGroupName = function(id){
      var arr = $.grep($scope.collection.zone_group, function(o){ return o.id == id; });
      if (arr.length == 0) {
        return "";
      } else {
        return arr[0].name;
      }
    };

    $scope.commaNumber = numberWithCommas;
}]);


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

app.controller('AddCTL', ['$scope', '$http', '$location', function($scope, $http, $location){
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
      return $scope.collection.requirement.filter(function(item){
        return item.id != 5 || $scope.form.property_status_id == 4;
      });
    };

    $scope.formPropertyTypeChange = function(){
      if($scope.form.property_type_id == 1) {
        $('#project_id').prop('required', true);
      }
      else {
        $('#project_id').prop('required', false);
        delete $scope.form.project_id;
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
        $scope.form.airport_link_id = project.airport_link_id;
        $scope.form.bts_id = project.bts_id;
        $scope.form.province_id = project.province_id;
        $scope.form.district_id = project.district_id;
        $scope.form.sub_district_id = project.sub_district_id;
        $scope.form.mrt_id = project.mrt_id;
      }
    };

    $scope.formPropertyStatusIdChange = function(){
      if($scope.form.property_status_id != 4 && $scope.form.requirement_id == 5)
        delete $scope.form.requirement_id;
    };

    window.s = $scope;

    $scope.submit = function(){
      if(!$scope.form.comment) {
        alert("please comment when add");
        return;
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

      $.post("../api/property", $scope.form, function(data){
        if(data.error) {
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

    $scope.images = [];
    $scope.parseImagesInput = function(input){
        $scope.images = input.files;
    };

    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
    $('.rented_expire').datepicker();
}]);

app.controller('EditCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams) {
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

    if(!window.confirm('Are you sure?')) return;

    $.post("../api/property/edit/" + $routeParams.id, form, function(data){
      if(data.error) {
        alert(data.error.message);
        return;
      }

      // window.location.hash = "/";
      window.location.reload();
    }, 'json');
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
