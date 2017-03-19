<?php
/**
 *  collection.php
 *  Project : bc
 *
 */

use Main\ThirdParty\Xcrud\Xcrud;

$xcrud = Xcrud::get_instance();
$xcrud->table('account');
$xcrud->unset_title();

$xcrud->where('level_id =', 6);
$xcrud->fields('created_at,last_login,manager_id,level_id', true);
// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
$xcrud->relation('account_status_id', 'account_status', 'id', 'name');

// $xcrud->condition('level_id','<=','3','disabled','manager_id');
// $xcrud->relation('manager_id', 'account', 'id', 'name', 'level_id = 3');

$xcrud->before_insert("hr_beforeInsert");
?>
<h1>HR</h1>
<?php echo $xcrud->render(); ?>
