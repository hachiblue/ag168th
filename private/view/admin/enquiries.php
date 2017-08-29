

<div id="content" ng-app="enquiry-app">
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

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.css");?>">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/css/bootstrap-datepicker3.min.css");?>">

<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-route/angular-route.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/app/enquiry/app.js")?>?<?=date('hisymd');?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/bootstrap.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/angular-chosen.min.js")?>"></script>


