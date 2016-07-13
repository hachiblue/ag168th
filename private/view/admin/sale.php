<?php
/**
 *  collection.php
 *  Project : bc
 *
 *  Created by Issarapong Wongyai on 18/3/2558 10:41
 *  Copyright 2015 Issarapong Wongyai. All rights reserved.
 *
 *
 */

use Main\ThirdParty\Xcrud\Xcrud;

$xcrud = Xcrud::get_instance();
$xcrud->table('account');
$xcrud->unset_title();

$xcrud->where('level_id =', 4);
$xcrud->fields('created_at,last_login,level_id', true);
// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
$xcrud->relation('account_status_id', 'account_status', 'id', 'name');
$xcrud->relation('manager_id', 'account', 'id', 'name', 'level_id = 3');
$xcrud->validation_required('manager_id');

$xcrud->before_insert("sale_beforeInsert");
?>
<h1>Sale</h1>
<?php echo $xcrud->render(); ?>
