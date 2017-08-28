<div id="content" ng-app="property-app">
    <div ng-view=""></div>
</div>

<script type="text/javascript">
	
var g_item = <?=json_encode($_GET);?>; 

var quotationItem = [];
var setQuotationItem = function(elem)
{
    var 
        $this = $(elem),
        id = elem.id.replace("chk_", ""), index;

    if( $this.prop("checked") )
    {
        quotationItem.push(id);    
    }
    else
    {
        index = quotationItem.indexOf(id);
        quotationItem.splice(index, 1);
    }

    $("#cnt-quotation").html(quotationItem.length);
};

</script>

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute('/bower_components/angular-loading-bar/build/loading-bar.min.css'); ?>">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.20.0/select.css">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute('/public/app/owner/layout.css'); ?>">

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/css/bootstrap-datepicker3.min.css");?>">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/css/bootstrap-datetimepicker.min.css");?>">



<style type="text/css">
.md-autocomplete-suggestions-container.md-default-theme li .highlight, .md-autocomplete-suggestions-container li .highlight {
    color: #009688;
}
.md-button {
  padding: 0 6px 0 6px;
  margin: 6px 8px 6px 8px;
  min-width: 88px;
  border-radius: 3px;
  font-size: 14px;
  text-align: center;
  text-transform: uppercase;
  text-decoration:none;
  border: none;
  outline: none;
}
#tmpl-owners {
    display: none;
}
md-autocomplete md-autocomplete-wrap {
    height: 30px;
}
md-autocomplete input:not(.md-input) {
    height: 30px;
}
md-autocomplete {
    height: 31px;
    top: -2px;
}
</style>


<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-route/angular-route.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.js");?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.20.0/select.js"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/moment.js");?>"></script>

<script src="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/angular-chosen.min.js")?>"></script>

<!-- Angular Material Dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

<!-- Angular Material Library -->
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>


<script src="<?php echo \Main\Helper\URL::absolute("/public/app/property/app.js");?>"></script>