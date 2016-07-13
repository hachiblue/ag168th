<div id="content" ng-app="phonereq-app">
    <div ng-view=""></div>
</div>

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.css");?>">

<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-route/angular-route.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/app/phonereq/app.js");?>"></script>
