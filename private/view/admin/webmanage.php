
<style type="text/css">
	
.tb-header {
	border-bottom: 2px solid #009688;
}

.tb-body {
	padding: 15px 0;
	border-bottom: 2px solid #c3c3c3;
}

</style>

<div id="content">

<div class="col-md-12">

	<div class="row tb-header">
		<div class="col-md-3"><h4>Topic</h4></div>
		<div class="col-md-9"><h4>Room</h4></div>
	</div>

	<div class="row tb-body">
		<div class="col-md-3"><input type="text" class="form-control"></div>
		<div class="col-md-9">

		</div>
	</div>

</div>


</div>



<script src="<?php echo \Main\Helper\URL::absolute("/public/js/bootstrap.min.js");?>"></script>


<script type="text/javascript">
<!--
	

var url = "../api/webmanage";
var param = { 'test' : 'ssss'};

$.getJSON(url, param, function(msg) {
	console.log(msg);
});

//-->
</script>