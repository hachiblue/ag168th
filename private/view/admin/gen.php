<?php 
use Main\ThirdParty\Xcrud\Xcrud;

$xcrud = Xcrud::get_instance();
$xcrud->table('property');
$xcrud->where('sell_price >=', 10000000)->where('requirement_id =', 1)->where('property_status_id =', 1);
$xcrud->relation('property_type_id','property_type','id','name');
$xcrud->relation('project_id','project','id','name');
$xcrud->relation('requirement_id','requirement','id','name');
$xcrud->relation('property_status_id','property_status','id','name');
$xcrud->relation('bts_id','bts','id','name');
$xcrud->relation('mrt_id','mrt','id','name');
$xcrud->relation('airport_link_id','airport_link','id','name');
$xcrud->relation('key_location_id','key_location','id','name');
$xcrud->relation('province_id','province','id','name');
$xcrud->relation('district_id','district','id','name');

$xcrud->limit(500);
$xcrud->columns('created_at',true);
$xcrud->limit_list(array('500','1000','2000','all'));
$xcrud->unset_add();
$xcrud->unset_edit();
echo $xcrud->render();
?>