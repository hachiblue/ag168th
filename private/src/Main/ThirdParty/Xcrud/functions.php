<?php
// set timezone Bangkok
date_default_timezone_set("Asia/Bangkok");

function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function exception_example($postdata, $primary, $xcrud)
{
    // get random field from $postdata
    $postdata_prepared = array_keys($postdata->to_array());
    shuffle($postdata_prepared);
    $random_field = array_shift($postdata_prepared);
    // set error message
    $xcrud->set_exception($random_field, 'This is a test error', 'error');
}

function test_column_callback($value, $fieldname, $primary, $row, $xcrud)
{
    return $value . ' - nice!';
}

function after_upload_example($field, $file_name, $file_path, $params, $xcrud)
{
    $ext = trim(strtolower(strrchr($file_name, '.')), '.');
    if ($ext != 'pdf' && $field == 'uploads.simple_upload')
    {
        unlink($file_path);
        $xcrud->set_exception('simple_upload', 'This is not PDF', 'error');
    }
}

function movetop($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != 0)
            {
                array_splice($result, $key - 1, 0, array($item));
                unset($result[$key + 1]);
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}
function movebottom($xcrud)
{
    if ($xcrud->get('primary') !== false)
    {
        $primary = (int)$xcrud->get('primary');
        $db = Xcrud_db::get_instance();
        $query = 'SELECT `officeCode` FROM `offices` ORDER BY `ordering`,`officeCode`';
        $db->query($query);
        $result = $db->result();
        $count = count($result);

        $sort = array();
        foreach ($result as $key => $item)
        {
            if ($item['officeCode'] == $primary && $key != $count - 1)
            {
                unset($result[$key]);
                array_splice($result, $key + 1, 0, array($item));
                break;
            }
        }

        foreach ($result as $key => $item)
        {
            $query = 'UPDATE `offices` SET `ordering` = ' . $key . ' WHERE officeCode = ' . $item['officeCode'];
            $db->query($query);
        }
    }
}

function show_description($value, $fieldname, $primary_key, $row, $xcrud)
{
    $result = '';
    if ($value == '1')
    {
        $result = '<i class="fa fa-check" />' . 'OK';
    }
    elseif ($value == '2')
    {
        $result = '<i class="fa fa-circle-o" />' . 'Pending';
    }
    return $result;
}

function custom_field($value, $fieldname, $primary_key, $row, $xcrud)
{
    return '<input type="text" readonly class="xcrud-input" name="' . $xcrud->fieldname_encode($fieldname) . '" value="' . $value .
        '" />';
}
function unset_val($postdata)
{
    $postdata->del('Paid');
}

function format_phone($new_phone)
{
    $new_phone = preg_replace("/[^0-9]/", "", $new_phone);

    if (strlen($new_phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $new_phone);
    elseif (strlen($new_phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $new_phone);
    else
        return $new_phone;
}

function before_list_example($list, $xcrud)
{
    var_dump($list);
}

// my function

function sale_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 4);
}

function investment_data_beforeInsert($postdata, $xcrud)
{ 
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	//$postdata->set('project_id', 4);
}

function manager_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 3);
}

function admin_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 2);
}

function admin_manager_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 7);
}

function sale_manager_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 8);
}

function marketing_manager_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 9);
}

function marketing_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 5);
}

function hr_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
	$postdata->set('level_id', 6);
}

function article_beforeInsert($postdata, $xcrud)
{
	$postdata->set('created_at', date('Y-m-d H:i:s'));
}

function project_afterUpdate($postdata, $primary, $xcrud)
{
	$db = \Main\DB\Medoo\MedooFactory::getInstance();
	$id = $xcrud->get('primary');

	$zone_id = $postdata->get('zone_id');
	$bts_id = $postdata->get('bts_id');
	$mrt_id = $postdata->get('mrt_id');
	$airport_link_id = $postdata->get('airport_link_id');
	$province_id = $postdata->get('province_id');
	$district_id = $postdata->get('district_id');
	$sub_district_id = $postdata->get('sub_district_id');
	$zone_id = $postdata->get('zone_id');

	$update = [
		'zone_id'=> $zone_id,
		'bts_id'=> $bts_id,
		'mrt_id'=> $mrt_id,
		'airport_link_id'=> $airport_link_id,
		'province_id'=> $province_id,
		'district_id'=> $district_id,
		'sub_district_id'=> $sub_district_id
	];

	$db->update("property", $update, ["project_id"=> $id]);
}