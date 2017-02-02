/**
 * Created by NuizHome on 8/4/2558.
 */
"use strict";

//angular.module('angularTable', []);
var app = angular.module('property-app', ['ngRoute', 'angular-loading-bar', 'localytics.directives']);
app.config(['$routeProvider', 'cfpLoadingBarProvider',
    function ($routeProvider, cfpLoadingBarProvider)
    {
        $routeProvider.
        when('/',
        {
            templateUrl: '../public/app/property/list.php'
        }).
        when('/add',
        {
            templateUrl: '../public/app/property/add.php'
        })
        .when('/edit/:id',
        {
            templateUrl: '../public/app/property/edit.php'
        }).
        when('/quotation/:id',
        {
            templateUrl: '../public/app/property/quotation.php'
        }).
        when('/:id/gallery',
        {
            templateUrl: '../public/app/property/gallery.php'
        }).
        when('/:id/match',
        {
            templateUrl: '../public/app/property/match.php'
        }).
        when('/:id/projectdetail',
        {
            templateUrl: '../public/app/property/projectdetail.php'
        }).
        otherwise(
        {
            redirectTo: '/'
        });
    }
]);

app.controller('QuotCTL', ['$scope', '$http', '$location', '$route', function ($scope, $http, $location, $route)
{
    
    $scope.quot = {};

    //var quotationItem = ["46633", "46632", "46631", "46629"];

    var formGetQuotation = function ()
    {
        var qId = '';
        $.each(quotationItem, function(i, e) {
            qId += e + ",";
        });

        $http.get("../api/property/quotation?q=" + qId).success(function (data)
        {
            $scope.quot = data;
        });
    };

    $scope.getExcel = function() 
    {
        var qId = '';
        $.each(quotationItem, function(i, e) {
            qId += e + ",";
        });
        
        window.open("../api/property/quotation2?q=" + qId);

    };

    formGetQuotation();

    window.s = $scope;

}]);

app.controller('ListCTL', ['$scope', '$http', '$location', '$route', function ($scope, $http, $location, $route)
{
    $scope.props = [];

    $scope.form = {};
    $scope.form.page = 1;
    $scope.form.limit = 15;
    $scope.form.total_q_items = 0;

    window.s = $scope;

    function getProps(query)
    {
        var url = "../api/property", i;

        $scope.form = $.extend({}, $scope.form, g_item);

        if (query)
        {
            url += "?" + $.param($scope.form);
        }

        $http.get(url).success(function (data)
        {
            $scope.props = data;
    
            for( i in data.data )
            {
                getImgProps(i, data.data[i].id);
            }

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

            $scope.initSuccess = false;
            var itv = setInterval(function ()
            {
                if ($scope.props)
                {
                    $scope.initSuccess = true;
                
                    var x;
                    $("input[name=chk_q]").each(function() {
                        x = quotationItem.indexOf(this.id.replace("chk_", ""));

                        if( x != -1 )
                        {
                            $(this).prop("checked", true);
                        }
                    });

                    $scope.form.total_q_items = quotationItem.length;

                    clearInterval(itv);
                }
            }, 100);

        });
    }

    getProps($scope.form);

    function getImgProps(i, $id)
    {
        var url = "../api/property/imageprops/"+$id;

        $http.get(url).success(function (data)
        {
            $scope.props.data[i].image_url = data.image_url;
        });
    }

    $scope.sort = function (keyname)
    {
        $scope.sortKey = keyname; //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa

        $scope.form.orderBy = keyname;
        $scope.form.orderType = !$scope.reverse ? 'ASC' : 'DESC';

        getProps($scope.form);
    };

    $scope.setPage = function ($index)
    {
        if ($index < 1 || $index > $scope.pagination.length)
            return;

        $scope.form.page = $index;
        getProps($scope.form);
    };

    $scope.displayDotLeft = function ()
    {
        if ($scope.form.page > 5) return true;
    };

    $scope.filterProps = function ()
    {
        getProps($scope.form);
    };

    $http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
        $scope.collection.project = data.project.sort(function (a, b)
        {
            if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
            if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
            return 0;
        });
    });

    $http.get("../api/collection/thailocation").success(function (thailocation)
    {
        $scope.thailocation = thailocation;
    });

    $scope.remove = function (id)
    {
        if (!window.confirm("Are you sure?"))
        {
            return;
        }

        $http.delete("../api/property/" + id).success(function (data)
        {

            if (typeof data.error == 'undefined')
            {
                $route.reload();
            }

        });
    };

    $scope.getZoneGroupName = function (id)
    {
        var arr = $.grep($scope.collection.zone_group, function (o)
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

    $scope.commaNumber = numberWithCommas;

}]);

app.controller('AddCTL', ['$scope', '$compile', '$http', '$location', function ($scope, $compile, $http, $location)
{
    $scope.isSaving = false;
    $scope.initSuccess = false;
    var itv = setInterval(function ()
    {
        if ($scope.collection && $scope.thailocation)
        {
            $scope.initSuccess = true;
            $scope.form.feature_unit_id = 4;
            $scope.form.chkcontact1a = 2;
            $scope.form.chkcontact2a = 2;
            $scope.form.chkcontact3a = 2;
            $scope.form.chkcontact4a = 2;
            $scope.form.web_status = 0;
            clearInterval(itv);
        }
    }, 100);

    $http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
        $scope.collection.project = data.project.sort(function (a, b)
        {
            if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
            if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
            return 0;
        });
    });

    $http.get("../api/collection/thailocation").success(function (thailocation)
    {
        $scope.thailocation = thailocation;
    });

    $scope.setmoneyformat = function ()
    {
        $scope.form.net_sell_price = (+($scope.form.net_sell_price+'' || '').replace(/,/g,'')).format(2); 
        $scope.form.sell_price = (+($scope.form.sell_price+'' || '').replace(/,/g,'')).format(2); 
        $scope.form.contract_price = (+($scope.form.contract_price+'' || '').replace(/,/g,'')).format(2); 
        $scope.form.rent_price = (+($scope.form.rent_price+'' || '').replace(/,/g,'')).format(2); 
    };

    $scope.getDistrict = function ()
    {
        if (!$scope.initSuccess) return [];
        return $scope.thailocation.district.filter(function (item)
        {
            return item.province_id == $scope.form.province_id;
        });
    };

    $scope.getSubDistrict = function ()
    {
        if (!$scope.initSuccess) return [];
        return $scope.thailocation.sub_district.filter(function (item)
        {
            return item.
            district_id == $scope.form.district_id;
        });
    };

    $scope.getRequirementList = function ()
    {

        if ($scope.collection == undefined) return false;
        return $scope.collection.requirement.filter(function (item)
        {
            return item.id != 5 || $scope.form.property_status_id == 4;
        });
    };

    $scope.formPropertyTypeChange = function ()
    {
        if ($scope.form.property_type_id == '1')
        {
            //$('#project_id').prop('required', true);
        }
        else
        {
            //$('#project_id').prop('required', false);
            $scope.form.project_id = 0;
        }

        var u1 = 1;

        switch (+$scope.form.property_type_id)
        {
            case 1:
                $scope.form.size_unit_id = '1';
                break;
            case 2:
                $scope.form.size_unit_id = '2';
                break;
            case 8:
                $scope.form.size_unit_id = '3';
                break;
            default:
                $scope.form.size_unit_id = '0';
        }
    };

    $scope.formProjectIdChange = function ()
    {
        var project = false;
        if ($scope.form.project_id)
        {
            project = (function ()
            {
                var i = 0;
                for (i = 0; i < $scope.collection.project.length; i++)
                {
                    if ($scope.collection.project[i].id == $scope.form.project_id)
                        return $scope.collection.project[i];
                }
                return false;
            })();
        }

        if (project)
        {
            $scope.form.zone_id = project.zone_id;
            $scope.form.airport_link_id = project.airport_link_id;
            $scope.form.bts_id = project.bts_id;
            $scope.form.province_id = project.province_id;
            $scope.form.district_id = project.district_id;
            $scope.form.sub_district_id = project.sub_district_id;
            $scope.form.mrt_id = project.mrt_id;
        }
    };

    $scope.formPropertyStatusIdChange = function ()
    {
        if ($scope.form.property_status_id != 4 && $scope.form.requirement_id == 5) delete $scope.form.requirement_id;

        var statusID = this.form.property_status_id;

        $("#pending-box").hide();
        $("#pending-date-box").hide();
        $("#pending-info-box").hide();
        $("#input-rented_exp").prop("required", false);
        switch (+statusID)
        {
            case 1:
                this.form.web_status = 1;
                this.form.property_pending_type = 0;
                break;

            case 2:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                this.form.web_status = 0;
                this.form.property_pending_type = 0;
                break;

            case 3:
                this.form.web_status = 0;
                this.form.property_pending_type = 0;
                $("#input-rented_exp").prop("required", true);
                break;
            case 10:
                $("#pending-box").show();
                $("#pending-date-box").show();
                break;
            default : $("#pending-box").hide(); $("#pending-date-box").hide();
        }
    };

    $scope.formPendingTypeChange = function()
    {
        if( +this.form.property_pending_type == 4 )
        {
            $("#pending-info-box").show();
        }
        else
        {
            $("#pending-info-box").hide();
        }
    };

    $scope.formGetProject = function ()
    {
        var projectID = $scope.form.project_id,
            form = $scope.form;
        $http.get("../api/property/project/" + projectID).success(function (data)
        {
            form.zone_id = data.zone_id;
            form.province_id = data.province_id;
            form.district_id = data.district_id;
            form.sub_district_id = data.sub_district_id;
            form.bts_id = data.bts_id;
            form.mrt_id = data.mrt_id;
            form.airport_link_id = data.airport_link_id;
        });
    };

    $scope.formRequirementChange = function ()
    {
        switch (+$scope.form.requirement_id)
        {
            case 1:
                $("#input-sellingprice").prop("disabled", false).prop("required", true);
                $("#input-rentprice").prop("disabled", true).prop("required", false)/*.val('')*/;

                break;

            case 2:

                $("#input-sellingprice").prop("disabled", true).prop("required", false)/*.val('')*/;
                $("#input-rentprice").prop("disabled", false).prop("required", true);

                break;
            case 3:
            case 4:

                $("#input-sellingprice").prop("disabled", false).prop("required", true);
                $("#input-rentprice").prop("disabled", false).prop("required", true);

                break;
        }

        $scope.formChkContractUpChange();
    };

    $scope.formChkContractUpChange = function ()
    {
        var up_percent = 0,
            tmp_plus = 0,
            vat7p = 1;

        //if (this.form.chkcontact1 === true) up_percent += 0.033;
        if (this.form.chkcontact1 === true) 
        {
            if( this.form.chkcontact1a == 1 ) up_percent += 0.0165;
            if( this.form.chkcontact1a == 2 ) up_percent += 0.033;
        }

        if (this.form.chkcontact2 === true) 
        {
            if( this.form.chkcontact2a == 1 ) up_percent += 0.0025;
            if( this.form.chkcontact2a == 2 ) up_percent += 0.005;
        }

        if (this.form.chkcontact3 === true) 
        {
            if( this.form.chkcontact3a == 1 ) up_percent += 0.01;
            if( this.form.chkcontact3a == 2 ) up_percent += 0.02;
        }

        if (this.form.chkcontact4 === true) 
        {
            if( this.form.chkcontact4a == 1 ) up_percent += 0.015;
            if( this.form.chkcontact4a == 2 ) up_percent += 0.03;
        }

        if (this.form.chkcontact5 === true) vat7p = 1.002039;

        var net_sell_price = (this.form.net_sell_price || '').replace(/,/g, '');

        tmp_plus = net_sell_price * up_percent || 0;

        //if ($scope.form.requirement_id != 2 && $scope.form.requirement_id != undefined)
        //{
            //this.form.net_sell_price = Math.round( ((parseFloat(this.form.net_sell_price) + tmp_plus) * vat7p) * 100 ) / 100;

        if( net_sell_price !== null )
        {
            this.form.sell_price = ((parseFloat(net_sell_price || 0) + tmp_plus) * vat7p).format(2);
        }
        //}

        var chk1 = 0;
        if (this.form.chkcontact1 === true) 
        { 
            if( this.form.chkcontact1a == 1 ) chk1 = 1;
            if( this.form.chkcontact1a == 2 ) chk1 = 2;
        }

        var chk2 = 0;
        if (this.form.chkcontact2 === true) 
        { 
            if( this.form.chkcontact2a == 1 ) chk2 = 1;
            if( this.form.chkcontact2a == 2 ) chk2 = 2;
        }

        var chk3 = 0;
        if (this.form.chkcontact3 === true) 
        { 
            if( this.form.chkcontact3a == 1 ) chk3 = 1;
            if( this.form.chkcontact3a == 2 ) chk3 = 2;
        }
        
        var chk4 = 0;
        if (this.form.chkcontact4 === true) 
        { 
            if( this.form.chkcontact4a == 1 ) chk4 = 1;
            if( this.form.chkcontact4a == 2 ) chk4 = 2;
        }

        var chk5 = (this.form.chkcontact5 === true) ? 1 : 0;

        this.form.contract_chk_key = chk1 + ',' + chk2 + ',' + chk3 + ',' + chk4 + ',' + chk5;
    };

    $scope.submit = function ()
    {
        if (!$scope.form.comment)
        {
            alert("please comment when add");
            return;
        }

        var bedrooms = this.form.bedrooms || '';
        var bathrooms = this.form.bathrooms || '';
        if (this.form.room_type_id == 1 && ( bedrooms == '' || (bathrooms == '' || bathrooms == 0)))
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

        if (!window.confirm('Are you sure?')) return;

        var i, k, owner = '';

        for (i in $scope.form)
        {
            if (i.indexOf("owner_name") != -1)
            {
                k = i.replace("owner_name", "");
                owner += ($scope.form["owner_name" + k] || '') + ',' + ($scope.form["owner_phone" + k + "a"] || '') 
                + ($scope.form["owner_phone" + k + "b"] || '') + ($scope.form["owner_phone" + k + "c"] || '') + ',' 
                + ($scope.form["owner_cust" + k] || '') + ',' + ($scope.form["owner_email" + k] || '') + ':';
            }
        }


        if ( +$scope.form.property_type_id == 1 && +$scope.form.project_id == 0 )
        {
            alert('Please Select Project if Your Property Type is Condominium!!');
            return false;
        }


        $scope.form.property_pending_date = $("#datetime-pick").val();
        $scope.form.owner = owner.substring(owner.length - 1, -1);

        $scope.form.net_sell_price = +($scope.form.net_sell_price+'' || '').replace(/,/g, '');
        $scope.form.sell_price = +($scope.form.sell_price+'' || '').replace(/,/g, '');
        $scope.form.contract_price = +($scope.form.contract_price+'' || '').replace(/,/g, '');
        $scope.form.rent_price = +($scope.form.rent_price+'' || '').replace(/,/g, '');

        $.post("../api/property", $scope.form, function (data)
        {

            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            // window.location.hash = "/";
            window.location.reload();
        }, 'json');
    };

    $scope.getZoneGroupName = function (id)
    {
        var arr = $.grep($scope.collection.zone_group, function (o)
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

    $scope.addmore_owner = function ()
    {
        var
            moreowner = $("#moreowner"),
            tmpl = $("#tmpl-owner"),
            html, lastrow;

        if (moreowner.find('.row').length)
        {
            lastrow = moreowner.find('.row').last()[0].id;
            this.ctn = lastrow.replace('row_', '');
            this.ctn++;
        }
        else
        {
            if (typeof this.ctn == 'undefined') this.ctn = 2;
        }

        html = '<div class="row" id="row_' + this.ctn + '">' + tmpl.html()
            .replace(/owner_name1/g, 'owner_name' + this.ctn)
            .replace(/owner_phone1/g, 'owner_phone' + this.ctn)
            .replace(/owner_email1/g, 'owner_email' + this.ctn)
            .replace(/owner_cust1/g, 'owner_cust' + this.ctn)
            .replace('ng-click="addmore_owner();"', 'onclick="s.delmore_owner(this, ' + this.ctn + ')"')
            .replace("plus", "minus") + '</div>';

        moreowner.append($compile(html)($scope));

        setphonehop();
    };

    $scope.delmore_owner = function (obj, c)
    {

        var moreowner = $("#moreowner");

        $(obj).parents(".row").remove();

        delete this.form["owner_name" + c];
        delete this.form["owner_phone" + c];
        delete this.form["owner_cust" + c];
    };

    $scope.images = [];
    $scope.parseImagesInput = function (input)
    {
        $scope.images = input.files;
    };

    window.s = $scope;

    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
    $('.rented_expire').datepicker();

    setphonehop();
    set_cntcomment();

}]);

app.controller('EditCTL', ['$scope', '$compile', '$http', '$location', '$route', '$routeParams', function ($scope, $compile, $http, $location, $route, $routeParams)
{
    $scope.form = null;
    $scope.collection = null;
    $scope.thailocation = null;

    $http.get("../api/collection").success(function (data)
    {
        $scope.collection = data;
        $scope.collection.project = data.project.sort(function (a, b)
        {
            if (a.name.toLowerCase() < b.name.toLowerCase()) return -1;
            if (a.name.toLowerCase() > b.name.toLowerCase()) return 1;
            return 0;
        });

        getProperty();
    });

    $http.get("../api/collection/thailocation").success(function (thailocation)
    {
        $scope.thailocation = thailocation;
    });


    function getProperty()
    {
        $http.get("../api/property/" + $routeParams.id).success(function (data)
        {
            $scope.reference_id = data.reference_id;
            $scope.owner = data.owner;
            $scope.form = data;

            $scope.form.chkcontact1a = 2;
            $scope.form.chkcontact2a = 2;
            $scope.form.chkcontact3a = 2;
            $scope.form.chkcontact4a = 2;

            var
                i, j,
                owner = data.owner.split(':'),
                tmpl = $("#tmpl-owner"),
                moreowner = $("#moreowner"),
                html,
                k = 2,
                owner_field,
                oa = '', ob = '', oc = '';

            for( j in $scope.collection.project)
            {
                if( $scope.collection.project[j].id == $scope.form.project_id )
                {
                    var proj = $scope.collection.project[j];
                    $scope.form.airport_link_id = proj.airport_link_id;
                    $scope.form.bts_id = proj.bts_id;
                    $scope.form.district_id = proj.district_id;
                    $scope.form.mrt_id = proj.mrt_id;
                    $scope.form.province_id = proj.province_id;
                    $scope.form.sub_district_id = proj.sub_district_id;
                    $scope.form.zone_id = proj.zone_id;
                    break;
                }
            }


            owner_field = owner[0].replace(/(-)/g,'').split(',');


            $scope.form["owner_name1"] = owner_field[0];
            $scope.form["owner_phone1a"] = (owner_field[1] || '').substring(0, 3);
            $scope.form["owner_phone1b"] = (owner_field[1] || '').substring(3, 6);
            $scope.form["owner_phone1c"] = (owner_field[1] || '').substring(6, 6 + (owner_field[1] || 0).length);
            $scope.form["owner_email1"] = (owner_field[3] || '').replace('undefined','');
            $scope.form["owner_cust1"] = (owner_field[2] || '').replace('undefined','');


            for (i in owner)
            {
                if (i == 0) continue;

                html = '<div class="row" id="row_' + k + '"><div class="col-md-2"></div>' +
                    tmpl.html()
                    .replace(/owner_name1/g, 'owner_name' + k)
                    .replace(/owner_phone1/g, 'owner_phone' + k)
                    .replace(/owner_email1/g, 'owner_email' + k)
                    .replace(/owner_cust1/g, 'owner_cust' + k)
                    .replace('ng-click="addmore_owner();"', 'onclick="s.delmore_owner(this, ' + k + ')"')
                    .replace("plus", "minus") + '</div>';

                $(html).find('div').first().remove();

                moreowner.append($compile(html)($scope));
                moreowner.find('div[name=ref_id]').each(function ()
                {
                    $(this).remove();
                });

                owner_field = owner[i].split(',');

                if( typeof owner_field[1] != 'undefined' && owner_field[1].length > 0 )
                {
                    oa = owner_field[1].substring(0, 3);
                    ob = owner_field[1].substring(3, 6);
                    oc = owner_field[1].substring(6, 6+owner_field[1].length);
                }

                $scope.form["owner_name" + k] = owner_field[0];
                $scope.form["owner_phone" + k + "a"] = oa;
                $scope.form["owner_phone" + k + "b"] = ob;
                $scope.form["owner_phone" + k + "c"] = oc;
                $scope.form["owner_email" + k] = owner_field[3];
                $scope.form["owner_cust" + k] = owner_field[2];

                k++;
            }

            $scope.formSetChkContract();
            $scope.formRequirementChange();
            //$scope.formPropertyStatusIdChange();
            $scope.formPendingTypeChange();        

            $scope.setmoneyformat();
        });
    }

    $scope.initSuccess = false;
    var itv = setInterval(function ()
    {
        if ($scope.form && $scope.collection && $scope.thailocation)
        {
            $scope.initSuccess = true;

            setphonehop();
            set_cntcomment();

            clearInterval(itv);

            var statusID = $scope.form.property_status_id;
            if( +statusID == 10 )
            {
                $("#pending-box").show();
                $("#pending-date-box").show();
            }

        }
    }, 100);

    $scope.setmoneyformat = function ()
    {
        $scope.form.net_sell_price = (+($scope.form.net_sell_price+'' || '').replace(/,/g,'')).format(2); 
        $scope.form.sell_price = (+($scope.form.sell_price+'' || '').replace(/,/g,'')).format(2); 
        $scope.form.contract_price = (+($scope.form.contract_price+'' || '').replace(/,/g,'')).format(2); 
        $scope.form.rent_price = (+($scope.form.rent_price+'' || '').replace(/,/g,'')).format(2); 
    };

    $scope.getZoneGroupName = function (id)
    {
        var arr = $.grep($scope.collection.zone_group, function (o)
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

    $scope.getDistrict = function ()
    {
        if (!$scope.initSuccess) return [];
        return $scope.thailocation.district.filter(function (item)
        {
            return item.province_id == $scope.form.province_id;
        });
    };

    $scope.getSubDistrict = function ()
    {
        if (!$scope.initSuccess) return [];
        return $scope.thailocation.sub_district.filter(function (item)
        {
            return item.
            district_id == $scope.form.district_id;
        });
    };

    $scope.formProjectIdChange = function ()
    {
        var project = false;
        if ($scope.form.project_id)
        {
            project = (function ()
            {
                var i = 0;
                for (i = 0; i < $scope.collection.project.length; i++)
                {
                    if ($scope.collection.project[i].id == $scope.form.project_id)
                        return $scope.collection.project[i];
                }
                return false;
            })();
        }
        if (project)
        {
            $scope.form.zone_id = project.zone_id;
            $scope.form.airport_link_id = project.airport_link_id;
            $scope.form.bts_id = project.bts_id;
            $scope.form.province_id = project.province_id;
            $scope.form.district_id = project.district_id;
            $scope.form.sub_district_id = project.sub_district_id;
            $scope.form.mrt_id = project.mrt_id;
        }
    };

    $scope.formPropertyStatusIdChange = function ()
    {
        var statusID = this.form.property_status_id;

        $("#pending-box").hide();
        $("#pending-date-box").hide();
        $("#pending-info-box").hide();
        $("#input-rented_exp").prop("required", false);
        switch (+statusID)
        {
            case 1:
                this.form.web_status = 1;
                this.form.property_pending_type = 0;
                break;

            case 2:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
                this.form.web_status = 0;
                this.form.property_pending_type = 0;
                break;

            case 3:
                this.form.web_status = 0;
                this.form.property_pending_type = 0;
                $("#input-rented_exp").prop("required", true);
                break;
            case 10:
                $("#pending-box").show();
                $("#pending-date-box").show();
                break;
            default : $("#pending-box").hide(); $("#pending-date-box").hide();
        }
    };

    $scope.formPendingTypeChange = function()
    {
        if( +this.form.property_pending_type == 4 )
        {
            $("#pending-info-box").show();
        }
        else
        {
            $("#pending-info-box").hide();
        }
    };

    $scope.formRequirementChange = function ()
    {
        switch (+$scope.form.requirement_id)
        {
            case 1:

                $("#input-sellingprice").prop("disabled", false).prop("required", true);
                $("#input-rentprice").prop("disabled", true).prop("required", false)/*.val('')*/;

                break;

            case 2:

                $("#input-sellingprice").prop("disabled", true).prop("required", false)/*.val('')*/;
                $("#input-rentprice").prop("disabled", false).prop("required", true);

                break;
            case 3:
            case 4:

                $("#input-sellingprice").prop("disabled", false).prop("required", true);
                $("#input-rentprice").prop("disabled", false).prop("required", true);

                break;
        }

        //$scope.formChkContractUpChange();
    };

    $scope.formPropertyTypeChange = function ()
    {
        if ($scope.form.property_type_id == 1)
        {
            //$('#project_id').prop('required', true);
        }
        else
        {
            //$('#project_id').prop('required', false);
            $scope.form.project_id = 0;
        }

        switch (+$scope.form.property_type_id)
        {
            case 1:
                $scope.form.size_unit_id = '1';
                break;
            case 2:
                $scope.form.size_unit_id = '2';
                break;
            case 8:
                $scope.form.size_unit_id = '3';
                break;
            default:
                $scope.form.size_unit_id = '0';
        }
    };

    $scope.formChkContractUpChange = function ()
    {
        var up_percent = 0,
            tmp_plus = 0,
            vat7p = 1;

        //if (this.form.chkcontact1 === true) up_percent += 0.033;
        if (this.form.chkcontact1 === true) 
        {
            if( this.form.chkcontact1a == 1 ) up_percent += 0.0165;
            if( this.form.chkcontact1a == 2 ) up_percent += 0.033;
        }

        if (this.form.chkcontact2 === true) 
        {
            if( this.form.chkcontact2a == 1 ) up_percent += 0.0025;
            if( this.form.chkcontact2a == 2 ) up_percent += 0.005;
        }

        if (this.form.chkcontact3 === true) 
        {
            if( this.form.chkcontact3a == 1 ) up_percent += 0.01;
            if( this.form.chkcontact3a == 2 ) up_percent += 0.02;
        }

        if (this.form.chkcontact4 === true) 
        {
            if( this.form.chkcontact4a == 1 ) up_percent += 0.015;
            if( this.form.chkcontact4a == 2 ) up_percent += 0.03;
        }

        if (this.form.chkcontact5 === true) vat7p = 1.002039;

        var net_sell_price = this.form.net_sell_price.replace(/,/g, '');

        tmp_plus = net_sell_price * up_percent || 0;

        //if ($scope.form.requirement_id != 2 && $scope.form.requirement_id != undefined)
        //{
            //this.form.net_sell_price = Math.round( ((parseFloat(this.form.net_sell_price) + tmp_plus) * vat7p) * 100 ) / 100;

        if( net_sell_price !== null )
        {
            this.form.sell_price = ((parseFloat(net_sell_price || 0) + tmp_plus) * vat7p).format(2);    
        }
        
        //}

        var chk1 = 0;
        if (this.form.chkcontact1 === true) 
        { 
            if( this.form.chkcontact1a == 1 ) chk1 = 1;
            if( this.form.chkcontact1a == 2 ) chk1 = 2;
        }

        var chk2 = 0;
        if (this.form.chkcontact2 === true) 
        { 
            if( this.form.chkcontact2a == 1 ) chk2 = 1;
            if( this.form.chkcontact2a == 2 ) chk2 = 2;
        }

        var chk3 = 0;
        if (this.form.chkcontact3 === true) 
        { 
            if( this.form.chkcontact3a == 1 ) chk3 = 1;
            if( this.form.chkcontact3a == 2 ) chk3 = 2;
        }
        
        var chk4 = 0;
        if (this.form.chkcontact4 === true) 
        { 
            if( this.form.chkcontact4a == 1 ) chk4 = 1;
            if( this.form.chkcontact4a == 2 ) chk4 = 2;
        }

        var chk5 = (this.form.chkcontact5 === true) ? 1 : 0;

        this.form.contract_chk_key = chk1 + ',' + chk2 + ',' + chk3 + ',' + chk4 + ',' + chk5;
    };

    $scope.formSetChkContract = function ()
    {
        var arr_chk = (this.form.contract_chk_key || '').split(","),
            i, j = 1;

        for (i in arr_chk)
        {
            this.form["chkcontact" + j] = (arr_chk[i] == 1 || arr_chk[i] == 2) ? true : false;

            if( this.form["chkcontact" + j + "a"] !== undefined )
            {
                this.form["chkcontact" + j + "a"] = arr_chk[i];
            }
            else
            {
                this.form["chkcontact" + j + "a"] = 2;
            }

            j++;
        }
    };

    $scope.submit = function ()
    {
        if (!$scope.form.comment)
        {
            alert("please comment when edit");
            return;
        }

        var form = {};
        if ($scope.editAllow)
        {
            form = $scope.form;
        }
        else
        {
            form = {
                comment: $scope.form.comment
            };
        }

        form.property_status_id = $scope.form.property_status_id;
        form.rented_expire = $scope.form.rented_expire;
        form.web_status = $scope.form.web_status;
        
        form.id = $scope.form.id;

        if (form.room_type_id == 1 && ( form.bedrooms == '' || (form.bathrooms == '' || form.bathrooms == 0)))
        {
            alert("Studio need Bed Room and Bath Room");
            return false;
        }

        if (!window.confirm('Are you sure?')) return;

        var i, k, owner = '';

        for (i in form)
        {
            if (i.indexOf("owner_name") != -1)
            {
                k = i.replace("owner_name", "");
                owner += ($scope.form["owner_name" + k] || '') + ',' + ($scope.form["owner_phone" + k + "a"] || '') + ($scope.form["owner_phone" + k + "b"] || '')
                + ($scope.form["owner_phone" + k + "c"] || '') + ',' + ($scope.form["owner_cust" + k] || '') + ',' + ($scope.form["owner_email" + k] || '') 
                + ':';
            }
        }

        form.property_pending_date = $("#datetime-pick").val();

        form.owner = owner.substring(owner.length - 1, -1);

        var rented_exp = $("#input-rented_exp").val();
        if (form.property_status_id == 3 && (rented_exp == "0000-00-00" || rented_exp == ""))
        {
            $("#input-rented_exp").focus();
            return false;
        }

        form.net_sell_price = +(form.net_sell_price+'' || '').replace(/,/g, '');
        form.sell_price = +(form.sell_price+'' || '').replace(/,/g, '');
        form.contract_price = +(form.contract_price+'' || '').replace(/,/g, '');
        form.rent_price = +(form.rent_price+'' || '').replace(/,/g, '');

        if ( +form.property_type_id == 1 && +form.project_id == 0 )
        {
            alert('Please Select Project if Your Property Type is Condominium!!');
            return false;
        }

        $.post("../api/property/edit/" + $routeParams.id, form, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
                return;
            }

            // window.location.hash = "/";
            window.location.reload();
        }, 'json');
    };

    $scope.addmore_owner = function ()
    {
        var
            moreowner = $("#moreowner"),
            tmpl = $("#tmpl-owner"),
            html, lastrow;

        if (moreowner.find('.row').length)
        {
            lastrow = moreowner.find('.row').last()[0].id;
            this.ctn = lastrow.replace('row_', '');
            this.ctn++;
        }
        else
        {
            if (typeof this.ctn == 'undefined') this.ctn = 2;
        }

        var ctn = this.ctn;

        html = '<div class="row" id="row_' + this.ctn + '"><div class="col-md-2"></div>' + tmpl.html()
            .replace(/owner_name1/g, 'owner_name' + this.ctn)
            .replace(/owner_phone1/g, 'owner_phone' + this.ctn)
            .replace(/owner_email1/g, 'owner_email' + this.ctn)
            .replace(/owner_cust1/g, 'owner_cust' + this.ctn)
            .replace('ng-click="addmore_owner();"', 'onclick="s.delmore_owner(this, ' + this.ctn + ')"')
            .replace("plus", "minus") + '</div>';

        $(html).find('div').first().remove();

        moreowner.append($compile(html)($scope));

        moreowner.find('div[name=ref_id]').each(function ()
        {
            $(this).remove();
        });

        var ph = setInterval(function ()
        {
            setphonehop();
        }, 100);
    };

    $scope.delmore_owner = function (obj, c)
    {

        var moreowner = $("#moreowner");

        $(obj).parents(".row").remove();

        delete this.form["owner_name" + c];
        delete this.form["owner_phone" + c];
        delete this.form["owner_cust" + c];
    };

    $scope.id = $routeParams.id;
    $scope.changeHash = function (hash)
    {
        window.location.hash = hash;
    };

    window.s = $scope;

}]);

app.controller('GalleryCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function ($scope, $http, $location, $route, $routeParams)
{
    $scope.images = [];

    $scope.refreshList = function ()
    {
        $http.get("../api/property/" + $routeParams.id + "/gallery").success(function (data)
        {
            $scope.images = data.data;
        });
    };
    $scope.refreshList();

    $scope.isUpload = false;
    $scope.images_upload = [];
    $scope.parseImagesInput = function (input)
    {
        $scope.images_upload = input.files;
    };

    $scope.addSubmit = function ()
    {
        var fd = new FormData();
        angular.forEach($scope.images_upload, function (value, key)
        {
            fd.append('images[' + key + ']', value);
        });

        $scope.isUpload = true;
        $http.post("../api/property/" + $routeParams.id + "/gallery", fd,
        {
            transformRequest: angular.identity,
            headers:
            {
                'Content-Type': undefined
            }
        }).success(function (data)
        {
            $scope.isUpload = false;
            $scope.refreshList();
        });
    };

    $scope.removeAllSelect = function ()
    {
        var listId = [];
        angular.forEach($scope.images, function (value, key)
        {
            if (value.selected)
            {
                listId.push(value.id);
            }
        });

        $http.delete("../api/property/" + $routeParams.id + "/gallery?" + $.param(
        {
            "id": listId
        })).success(function (data)
        {
            $scope.refreshList();
        });
    };

    $scope.id = $routeParams.id;
    $scope.changeHash = function (hash)
    {
        window.location.hash = hash;
    };
}]);

app.controller('CommentCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function ($scope, $http, $location, $route, $routeParams)
{
    var propId = $routeParams.id;
    $http.get("../api/property/" + $routeParams.id + "/comment").success(function (data)
    {
        $scope.comments = data.data;
    });
}]);

app.controller('ProjectdetailCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function ($scope, $http, $location, $route, $routeParams)
{
    $scope.id = $routeParams.id;
    $scope.project = {};
    $http.get("../api/property/" + $routeParams.id).success(function (data)
    {
        $http.get("../api/property/project/" + data.project_id).success(function (data2)
        {
            $scope.project = data2;
        });
    });
    $scope.id = $routeParams.id;
    $scope.changeHash = function (hash)
    {
        window.location.hash = hash;
    };
}]);

app.controller('MatchCTL', ['$scope', '$http', '$location', '$route', '$routeParams', function ($scope, $http, $location, $route, $routeParams)
{
    $scope.items = [];
    $scope.id = $routeParams.id;

    var promise1 = Q.Promise(function (resolve, reject)
    {
        $http.get("../api/property/" + $routeParams.id + "?build=1").success(function (data)
        {
            resolve(data);
        });
    });
    promise1.then(function (data)
    {
        $scope.prop = data;
        if (!data.match_enquiry_id)
        {
            getItems();
        }
        else
        {
            getMatched(data);
        }
    });

    function getMatched(prop)
    {
        $scope.matched = {};
        $.get("../api/property/" + $routeParams.id + "/matched", function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
            }
            $scope.matched = data;
        }, "json");
    }

    function getItems(query)
    {
        var url = "../api/enquiry";
        $http.get(url).success(function (data)
        {
            $scope.items = data;
            if (data.total > 0)
            {
                $scope.pagination = [];
                for (var i = 1; i * data.limit <= data.total; i++)
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
    $scope.formMatch = {};
    $scope.onClickMatch = function ()
    {
        if (!$scope.formMatch.match_enquiry_id)
        {
            alert("Please select enquiry");
            return;
        }
        $.post("../api/property/" + $routeParams.id + "/match", $scope.formMatch, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
            }
            $route.reload();
        }, 'json');
    };
    $scope.onClickCancle = function ()
    {
        $.post("../api/property/" + $routeParams.id + "/match/cancle", $scope.formMatch, function (data)
        {
            if (data.error)
            {
                alert(data.error.message);
            }
            $route.reload();
        }, 'json');
    };
}]);

app.directive('datepicker', function ($compile)
{
    return {
        // replace:true,
        // templateUrl:'custom-datepicker.html',
        scope:
        {
            ngModel: '=',
            dateOptions: '='
        },
        link: function ($scope, $element, $attrs, $controller)
        {
            $element.datepicker(
            {
                format: 'yyyy-mm-dd'
            });
        }
    };
});

app.directive('datetimepicker', function ($compile)
{
    return {
        // replace:true,
        // templateUrl:'custom-datepicker.html',
        scope:
        {
            ngModel: '=',
            dateOptions: '='
        },
        link: function ($scope, $element, $attrs, $controller)
        {
            $element.datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        }
    };
});

app.filter('fvip', function ()
{
    return function (str)
    {
        var vip = str.split(':'), i, item_vip;
        for( i in vip )
        {
            item_vip = vip[i].split(',');

            if( undefined !== item_vip[2] && item_vip[2] != '' && item_vip[2].toLowerCase().trim() != 'vim' )
            {
                return 'VIP';
            }
        }
       
        return '';
    };
});


function getDate(date)
{
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

function numberWithCommas(x)
{
    if (!x)
    {
        return "";
    }
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function setphonehop()
{
     $("input[name=cphone]").keyup(function() {
        if( this.value.length >= 3 ) $(this).parent().next().find("input").focus();
    });   
}

Array.prototype.indexOf || (Array.prototype.indexOf = function(d, e) {
    var a;
    if (null == this) throw new TypeError('"this" is null or not defined');
    var c = Object(this),
        b = c.length >>> 0;
    if (0 === b) return -1;
    a = +e || 0;
    Infinity === Math.abs(a) && (a = 0);
    if (a >= b) return -1;
    for (a = Math.max(0 <= a ? a : b - Math.abs(a), 0); a < b;) {
        if (a in c && c[a] === d) return a;
        a++
    }
    return -1
});


Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

app.filter('num', function() {
    return function(input) {
        if( undefined !== input )
        {
            input = +(( input+'' || '').replace(/,/g,''));
        }
        
        return input;
    };
});

app.filter('money', function() {
    return function(input) {
        return (input || 0).format(2);
    };
});