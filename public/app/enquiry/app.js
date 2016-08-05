/**
 * Created by NuizHome on 8/4/2558.
 */
"use strict";

function numberWithCommas(x)
{
    if (!x)
    {
        return "";
    }

    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

var app = angular.module('enquiry-app', ['ngRoute', 'angular-loading-bar']);

app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function($routeProvider, cfpLoadingBarProvider)
    {
        $routeProvider.
        when('/',
        {
            templateUrl: '../public/app/enquiry/list.php'
        }).
        when('/add',
        {
            templateUrl: '../public/app/enquiry/add.php'
        }).
        when('/rentalexpire',
        {
            templateUrl: '../public/app/enquiry/rentalexpire.php'
        }).
        when('/edit/:id',
        {
            templateUrl: '../public/app/enquiry/edit.php'
        }).
        when('/match/:id',
        {
            templateUrl: '../public/app/enquiry/match.php'
        }).
        when('/matched/:id',
        {
            templateUrl: '../public/app/enquiry/matched.php'
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

    $scope.form2 = {};
    $scope.form2.page = 1;
    $scope.form2.limit = 15;

    function getItems(query)
    {
        var url = "../api/enquiry";
        if (query)
        {
            url += "?" + $.param($scope.form);
        }
        $http.get(url).success(function(data)
        {
            $scope.items = data;
            if (data.total > 0)
            {
                $scope.pagination = [];
                var numPage = Math.ceil(data.total / $scope.form.limit);
                for (var i = 1; i <= numPage; i++)
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

    function getPropertiesExpire(query)
    {
        var url = "../api/property";

        $scope.form2.web_status = 1;
        $scope.form2.rented_expire = '2017-01-31';

        if (query)
        {
            url += "?" + $.param($scope.form2);
        }
        $http.get(url).success(function(data)
        {
            $scope.props = data;
            if (data.total > 0)
            {
                $scope.p_pagination = [];
                var numPage = Math.ceil(data.total / $scope.form2.limit);
                for (var i = 1; i <= numPage; i++)
                {
                    $scope.p_pagination.push(data.paging.page == i);
                }
            }
            else
            {
                $scope.p_pagination = null;
            }
        });
    }

    getItems();
    getPropertiesExpire($scope.form2);

    $("#myModal").toggleClass('show');

    $scope.closeModel = function()
    {
        $("#myModal").removeClass('show').addClass('hide');
    };

    $scope.openModel = function()
    {
        $("#myModal").removeClass('hide').addClass('show');
    };

    $scope.sort = function(keyname)
    {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa

        $scope.form2.orderBy = keyname;
        $scope.form2.orderType = !$scope.reverse ? 'ASC' : 'DESC';

        getPropertiesExpire($scope.form2);
    };

    $scope.setPageProps = function($index)
    {
        if ($index < 1 || $index > $scope.p_pagination.length)
            return;

        $scope.form2.page = $index;
        getPropertiesExpire($scope.form2);
    };

    $scope.setPage = function($index)
    {
        if ($index < 1 || $index > $scope.pagination.length)
            return;

        $scope.form.page = $index;
        getItems($scope.form);
    };

    $scope.filterItems = function()
    {
        getItems($scope.form);
    };

    $http.get("../api/collection").success(function(data)
    {
        $scope.collection = data;
    });

    $http.get("../api/collection/thailocation").success(function(thailocation)
    {
        $scope.thailocation = thailocation;
    });

    $http.get("../api/enquiry/account").success(function(accs)
    {
        $scope.accounts = accs;
    });

    $scope.remove = function(id)
    {
        if (!window.confirm("Are you sure?"))
        {
            return;
        }
        $http.delete("../api/enquiry/" + id).success(function(data)
        {
            if (typeof data.error == 'undefined')
            {
                $route.reload();
            }
        });
    };

    $scope.commaNumber = numberWithCommas;
}]);

app.controller('RentalCTL', ['$scope', '$http', '$location', '$route', function($scope, $http, $location, $route)
{
    $scope.items = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15;

    $scope.form2 = {};
    $scope.form2.page = 1;
    $scope.form2.limit = 15;

    function getPropertiesExpire(query)
    {
        var url = "../api/property";

        $scope.form2.web_status = 1;
        $scope.form2.rented_expire = '2017-01-31';

        if (query)
        {
            url += "?" + $.param($scope.form2);
        }
        $http.get(url).success(function(data)
        {
            $scope.props = data;
            
            if (data.total > 0)
            {
                $scope.p_pagination = [];
                var numPage = Math.ceil(data.total / $scope.form2.limit);
              
                for (var i = 1; i <= numPage; i++)
                {
                    $scope.p_pagination.push(data.paging.page == i);
                }
            }
            else
            {
                $scope.p_pagination = null;
            }
        });
    }

    getPropertiesExpire($scope.form2);

    $scope.sort = function(keyname)
    {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa

        $scope.form2.orderBy = keyname;
        $scope.form2.orderType = !$scope.reverse ? 'ASC' : 'DESC';

        getPropertiesExpire($scope.form2);
    };

    $scope.setPageProps = function($index)
    {
        if ($index < 1 || $index > $scope.p_pagination.length)
            return;

        $scope.form2.page = $index;
        getPropertiesExpire($scope.form2);
    };

    $scope.setPage = function($index)
    {
        if ($index < 1 || $index > $scope.pagination.length)
            return;

        $scope.form.page = $index;
        getItems($scope.form);
    };

    $scope.filterItems = function()
    {
        getItems($scope.form);
    };

    $http.get("../api/collection").success(function(data)
    {
        $scope.collection = data;
    });
}]);

app.controller('AddCTL', ['$scope', '$http', '$location', function($scope, $http, $location)
{
    $scope.addStep = 1;
    $scope.form2 = {};
    $scope.form3 = {};
    $scope.vm = {};

    $scope.vm.changeStudio = function()
    {
        if ($scope.form.is_studio)
        {
            $scope.form.bedroom = 0;
        }
    };

    $scope.form = {};
    $http.get("../api/collection").success(function(data)
    {
        $scope.collection = data;
        // $scope.form.project_id = data.project[0].id;
        $scope.collection.project = data.project.sort(function(a, b)
        {

            if (a.id == 0 || b.id == 0) return -1;
            if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
            if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
            return 0;
        });
    });

    $http.get("../api/collection/thailocation").success(function(thailocation)
    {
        $scope.thailocation = thailocation;

        setphonehop();
    });

    $scope.triggerChangeSource = function()
    {
        // if($scope.form.source_id == 1) {
        //   $scope.form.sub_source_id == 1;
        // }
        // else if($scope.form.source_id == 2) {
        //
        // }
        delete $scope.form.sub_source_id;
    };

    $scope.triggerFromWebsite = function()
    {
        if ($scope.sub_source_id != 1)
        {
            delete $scope.form.from_website_id;
        }
        else
        {
            $scope.form.from_website_id = 1;
        }
    };

    $scope.getZoneGroupName = function(id)
    {
        var arr = $.grep($scope.collection.zone_group, function(o)
        {
            return o.id == id;
        });
        if (arr.length == 0)
        {
            return "";
        }
        else
        {
            return arr[0].name;
        }
    };

    $scope.addSubmit = function()
    {
        if (!$scope.form.comment)
        {
            alert("please comment when add");
            return;
        }

        var fd = new FormData();
        angular.forEach($scope.form, function(value, key)
        {
            fd.append(key, value);
        });

        if (!window.confirm('Are you sure?')) return;

        var cust = $scope.form["ncustomer"] + ',' + $scope.form["t1customer"] + $scope.form["t2customer"] + $scope.form["t3customer"] + ',' + $scope.form["ecustomer"];
        $scope.form.customer = cust;

        $.post("../api/enquiry", $scope.form, function(data)
        {
            // $scope.isSaving = false;
            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            $location.path("/edit/" + data.id);
            $scope.$apply();

            // window.location.hash = "/";
            // window.location.reload();

            // $scope.addStep = 2;
            // $scope.form2.id = data.id;
            // $scope.form3.id = data.id;
            //
            // $.get("../api/enquiry/assign_list_manager", function(data){
            //   $scope.collection2 = data;
            //   $scope.form3.assign_manager_id = data.auto_assign.id;
            //   $scope.form3.is_auto = 1;
            //   $scope.$apply();
            // }, "json");
            //
            // $.get("../api/enquiry/assign_list_sale", function(data){
            //   $scope.collection3 = data;
            //   $scope.form4.assign_sale_id = data.auto_assign.id;
            //   $scope.form5.is_auto = 1;
            //   $scope.$apply();
            // }, "json");
        }, 'json');

        // $scope.isSaving = true;

        // $http.post("../api/enquiry", fd, {
        //     transformRequest: angular.identity,
        //     headers: {'Content-Type': undefined}
        // }).success(function(data){
        //     $scope.isSaving = false;
        //     if(typeof data.error == 'undefined'){
        //         $location.path("/");
        //     }
        // });
    };

    $scope.filter_zone = function(list, zone_group_id)
    {
        if (!Array.isArray(list)) return;
        return list.filter(function(item)
        {
            var res = (function()
            {
                for (var i in $scope.collection.zone_zone_group.data)
                {
                    if (item.id == $scope.collection.zone_zone_group.data[i].zone_id &&
                        $scope.collection.zone_zone_group.data[i].zone_group_id == zone_group_id)
                    {
                        return item;
                    }
                }
                return false;
            })();
            if (res)
            {
                console.log(res);
                return res;
            }
        });
    };

    $scope.addForm2 = function()
    {
        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/assign_manager", $scope.form2, function(data)
        {
            window.location.hash = "/";
        }, "json");
    };

    $scope.addForm3 = function()
    {
        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/assign_manager", $scope.form3, function(data)
        {
            window.location.hash = "/";
        }, "json");
    };

}]);

app.controller('EditCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams)
{
    $scope.id = $routeParams.id;

    var promise1 = Q.promise(function(resolve, reject)
    {
        $.get("../api/enquiry/" + $routeParams.id, function(data)
        {
            resolve(data);
        }, "json");
    });

    var promise2 = Q.promise(function(resolve, reject)
    {
        $.get("../api/collection", function(data)
        {
            resolve(data);
        }, "json");
    });

    var promise3 = Q.promise(function(resolve, reject)
    {
        $.get("../api/collection/thailocation", function(data)
        {
            resolve(data);
        }, "json");
    });

    var promise4 = Q.promise(function(resolve, reject)
    {
        $.get("../api/enquiry/assign_list_manager", function(data)
        {
            // $scope.collection2 = data;
            // $scope.form2.assign_to = data.auto_assign.id;
            resolve(data);
        }, "json");
    });

    var promise5 = Q.promise(function(resolve, reject)
    {
        $.get("../api/enquiry/assign_list_sale", function(data)
        {
            // $scope.collection2 = data;
            // $scope.form2.assign_to = data.auto_assign.id;
            resolve(data);
        }, "json");
    });

    Q.all([promise1, promise2, promise3, promise4, promise5])
        .spread(function(result1, result2, result3, result4, result5)
        {

            $scope.form = result1;
            $scope.collection = result2;
            $scope.collection2 = result4;
            $scope.collection3 = result5;
            $scope.thailocation = result3;

            if (!$scope.collection2.error)
            {
                $scope.assMngForm = {
                    id: $routeParams.id
                };

                $scope.autoAssMngForm = false;
                if ($scope.collection2.auto_assign)
                {
                    $scope.autoAssMngForm = {
                        id: $routeParams.id
                    };
                    $scope.autoAssMngForm.assign_manager_id = $scope.collection2.auto_assign.id;
                    $scope.autoAssMngForm.is_auto = 1;
                }
            }

            if (!$scope.collection3.error)
            {
                $scope.assSaleForm = {
                    id: $routeParams.id
                };

                $scope.autoAssSaleForm = false;
                if ($scope.collection3.auto_assign)
                {
                    $scope.autoAssSaleForm = {
                        id: $routeParams.id
                    };
                    $scope.autoAssSaleForm.assign_sale_id = $scope.collection3.auto_assign.id;
                    $scope.autoAssSaleForm.is_auto = 1;
                }
            }

            $scope.collection.project = $scope.collection.project.sort(function(a, b)
            {
                if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
                if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
                return 0;
            });

            var cust = $scope.form.customer.split(",");
            var tel1 = '', tel2 = '', tel3 = '';
            if( typeof cust[1] != 'undefined' && cust[1] != '' )
            {
                tel1 = cust[1].substring(0, 3);
                tel2 = cust[1].substring(3, 6);
                tel3 = cust[1].substring(6, 10);
            }
            
            $scope.form.ncustomer = cust[0] || '';
            $scope.form.t1customer = tel1;
            $scope.form.t2customer = tel2;
            $scope.form.t3customer = tel3;
            $scope.form.ecustomer = cust[2] || '';

            $scope.prepareDisplayEdit = true;
            $scope.$apply();

            setphonehop();
        });

    (function()
    {
        var url = "../api/enquiry/" + $routeParams.id + "/matched?limit=200";
        $http.get(url).success(function(data)
        {
            $scope.matched = data.data;
        });
    })();

    $scope.changeStatus = function()
    {
        if ($scope.status_id != 7)
        {
            delete $scope.form.book_property_id;
        }
    };
    $scope.changeHash = function(hash)
    {
        window.location.hash = hash;
    };

    $scope.autoAssMng = function()
    {
        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/assign_manager", $scope.autoAssMngForm, function(data)
        {
            $route.reload();
        }, "json");
    };

    $scope.assMng = function()
    {
        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/assign_manager", $scope.assMngForm, function(data)
        {
            $route.reload();
        }, "json");
    };

    $scope.autoAssSale = function()
    {
        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/assign_sale", $scope.autoAssSaleForm, function(data)
        {
            $route.reload();
        }, "json");
    };

    $scope.assSale = function()
    {
        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/assign_sale", $scope.assSaleForm, function(data)
        {
            $route.reload();
        }, "json");
    };

    $scope.submitEdit = function()
    {
        if ($scope.form.enquiry_status_id == 7 && !$scope.form.book_property_id)
        {
            alert("Please select booking property.");
            return;
        }
        if (!$scope.form.comment)
        {
            alert("require comment");
            return;
        }

        var cust = $scope.form["ncustomer"] + ',' + $scope.form["t1customer"] + $scope.form["t2customer"] + $scope.form["t3customer"] + ',' + $scope.form["ecustomer"];
        $scope.form.customer = cust;

        var form = $scope.form;
        if (!$scope.editAllow)
        {
            form = {
                comment: $scope.form.comment
            };
            if ($scope.form.enquiry_status_id)
                form.enquiry_status_id = $scope.form.enquiry_status_id;
            if ($scope.form.book_property_id)
                form.book_property_id = $scope.form.book_property_id;
        }

        if (!window.confirm('Are you sure?')) return;

        $.post("../api/enquiry/edit/" + $scope.id, form, function(data)
        {
            $route.reload();
        }, "json");
    };
}]);

app.controller('MatchCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams)
{
    $scope.id = $routeParams.id;

    $scope.changeHash = function(hash)
    {
        window.location.hash = hash;
    };

    $scope.props = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15;

    function getProps(query)
    {
        var url = "../api/enquiry/" + $scope.id + "/for_match";
        if (query)
        {
            url += "?" + $.param($scope.form);
        }
        $http.get(url).success(function(data)
        {
            $scope.props = data;
            if (data.total > 0)
            {
                $scope.pagination = [];
                for (var i = 1; i * $scope.form.limit <= data.total; i++)
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

    $scope.setPage = function($index)
    {
        $scope.form.page = $index + 1;
        getProps($scope.form);
    };

    $scope.filterProps = function()
    {
        console.log($scope.form);
        getProps($scope.form);
    };

    $http.get("../api/collection").success(function(data)
    {
        $scope.collection = data;
        $scope.collection.project = data.project.sort(function(a, b)
        {
            if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
            if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
            return 0;
        });
    });

    $scope.getZoneGroupName = function(id)
    {
        var arr = $.grep($scope.collection.zone_group, function(o)
        {
            return o.id == id;
        });
        if (arr.length == 0)
        {
            return "";
        }
        else
        {
            return arr[0].name;
        }
    };

    $scope.inputProps = {};
    $scope.importClick = function()
    {
        var listPropsId = [];
        for (var key in $scope.inputProps)
        {
            if ($scope.inputProps[key]) listPropsId.push(parseInt(key));
        }
        $.post("../api/enquiry/" + $scope.id + "/match",
        {
            props_id: listPropsId
        }, function(data)
        {
            $route.reload();
        }, "json");
    };
    $scope.commaNumber = numberWithCommas;
}]);

app.controller('MatchedCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams)
{
    $scope.id = $routeParams.id;

    $scope.changeHash = function(hash)
    {
        window.location.hash = hash;
    };

    $scope.props = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 100;

    function getProps(query)
    {
        var url = "../api/enquiry/" + $scope.id + "/matched";
        $http.get(url).success(function(data)
        {
            $scope.props = data;
            if (data.total > 0)
            {
                $scope.pagination = [];
                for (var i = 1; i * $scope.form.limit <= data.total; i++)
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

    $scope.setPage = function($index)
    {
        $scope.form.page = $index + 1;
        getProps($scope.form);
    };

    $scope.filterProps = function()
    {
        getProps($scope.form);
    };

    $http.get("../api/collection").success(function(data)
    {
        $scope.collection = data;
        $scope.collection.project = data.project.sort(function(a, b)
        {
            if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
            if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
            return 0;
        });
    });

    $scope.getZoneGroupName = function(id)
    {
        var arr = $.grep($scope.collection.zone_group, function(o)
        {
            return o.id == id;
        });
        if (arr.length == 0)
        {
            return "";
        }
        else
        {
            return arr[0].name;
        }
    };

    $scope.inputProps = {};
    $scope.clickRequestContact = function()
    {
        var listPropsId = [];
        for (var key in $scope.inputProps)
        {
            if ($scope.inputProps[key]) listPropsId.push(parseInt(key));
        }

        $.post("../api/enquiry/request_contact",
        {
            enquiry_id: $scope.id,
            props_id: listPropsId
        }, function(data)
        {
            if (data.error)
            {
                alert(data.error.message);
                return;
            }
            $route.reload();
        }, "json");
    };
    $scope.removeMathClick = function(prop)
    {
        if (!window.confirm('Request contact'))
        {
            return;
        }
        $.get("../api/enquiry/matched/delete/" + prop.id, function(data)
        {
            $route.reload();
        }, "json");
    };
    $scope.commaNumber = numberWithCommas;
}]);

app.controller('CommentCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function($scope, $http, $location, $route, $routeParams)
{
    var propId = $routeParams.id;
    $http.get("../api/enquiry/" + $routeParams.id + "/comment").success(function(data)
    {
        $scope.comments = data.data;
    });
}]);

function setphonehop()
{
     $("input[name=cphone]").keyup(function() {
        if( this.value.length >= 3 ) $(this).parent().next().find("input").focus();
    });   
}