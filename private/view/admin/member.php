<?php
/**
 *  collection.php
 *  Project : bc
 *
 */

use Main\ThirdParty\Xcrud\Xcrud;

$xcrud = Xcrud::get_instance();
$xcrud->table('member');
$xcrud->change_type('picture','image','', [
	'path'=> dirname($_SERVER["SCRIPT_FILENAME"]).'/public/member_pics',
	'thumbs'=> [
		['width'=> 50, 'marker'=>'_small'],
		['width'=> 100, 'marker'=>'_middle'],
		['width' => 150, 'folder' => 'thumbs']
	]
]);

$xcrud->unset_title();

$xcrud->button('member/{id}/images','Images','glyphicon glyphicon-picture','',array('target'=>'_blank'));

//$xcrud->where('level_id =', 9);
//$xcrud->fields('created_at,last_login,manager_id,level_id', true);
// $xcrud->relation('level_id', 'level', 'id', 'name', 'level.id > 2');
//$xcrud->relation('account_status_id', 'account_status', 'id', 'name');

// $xcrud->condition('level_id','<=','3','disabled','manager_id');
// $xcrud->relation('manager_id', 'account', 'id', 'name', 'level_id = 3');

///$xcrud->before_insert("member_beforeInsert");
?>
<h1>Member</h1>
<?php echo $xcrud->render(); ?>
