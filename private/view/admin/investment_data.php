<?php
/**
 *  collection.php
 *  Project : bc
 *
 *
 */

use Main\ThirdParty\Xcrud\Xcrud;

$_POST['project_id'] = $params['project_id'];


$xcrud = Xcrud::get_instance();
$xcrud->table('investment_data');
$xcrud->unset_title();

$xcrud->pass_var('project_id', $params['project_id']);

$xcrud->where('project_id =', $params['project_id']);

$xcrud->fields('created_at', true);
$xcrud->fields('project_id', $params['project_id']);
// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
//$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
//$xcrud->relation('manager_id', 'account', 'id', 'name', 'level_id = 3');
//$xcrud->validation_required('manager_id');

$xcrud->before_insert("investment_data_beforeInsert");
//print_r($xcrud);
?>
<h1>Investment Data ( <?=$params['project_name'];?> )</h1>
<?php echo $xcrud->render(); ?>
