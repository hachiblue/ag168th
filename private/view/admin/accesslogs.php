<?php

use Main\ThirdParty\Xcrud\Xcrud;

$xcrud = Xcrud::get_instance();
$xcrud->table('access_logs');
$xcrud->unset_title();

$xcrud->fields('accessdt', true);

$xcrud->order_by('accessdt', 'desc');

//$xcrud->before_insert("admin_beforeInsert");

?>

<h2>Access Logs</h2>

<?php echo $xcrud->render(); ?>