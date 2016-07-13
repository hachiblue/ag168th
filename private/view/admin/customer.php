<?php
/*
<div ng-app="customer-app">
    <h2>Customer</h2>
    <div ng-view></div>
</div>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-route/angular-route.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/app/customer/app.js");?>"></script>
*/

use Main\ThirdParty\Xcrud\Xcrud;

$xcrud = Xcrud::get_instance();
$xcrud->table('customer');
// $xcrud->where('level_id >', 2);
$xcrud->fields('created_at', true);
// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
// $xcrud->relation('account_status_id', 'account_status', 'id', 'name');
$xcrud->change_type('address', 'textarea');

function account_beforeInsert($postdata, $xcrud)
{
  $postdata->set('created_at', date('Y-m-d H:i:s'));
}
$xcrud->before_insert("account_beforeInsert");

echo $xcrud->render();
