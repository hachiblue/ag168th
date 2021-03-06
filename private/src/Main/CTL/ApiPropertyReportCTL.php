<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 8/5/2558
 * Time: 11:27
 */
namespace Main\CTL;

use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /api/report_property
 */
class ApiPropertyReportCTL extends BaseCTL
{

    public function getByWeek()
    {
        $back = (int) $this->reqInfo->param('back');

        $day = date('w');
        //$day -= 1;
        $week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
        $week_end   = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));
    }

    /**
     * @GET
     */
    public function getByBetween()
    {
        $db = MedooFactory::getInstance();

        $params = $this->reqInfo->params();

        if ( ! empty($params['account_comment_id']) || ! empty($params['user_updated_at_start']) || ! empty($params['user_updated_at_end']))
        {
            $sql = 'SELECT property_id FROM property_comment
            WHERE 1=1 ';

            if ( ! empty($params['account_comment_id']))
            {
                $sql .= " AND comment_by = '{$params['account_comment_id']}' ";
            }

            if ( ! empty($params['user_updated_at_start']))
            {
                $sql .= " AND updated_at >= '{$params['user_updated_at_start']}' ";
            }

            if ( ! empty($params['user_updated_at_end']))
            {
                $sql .= " AND updated_at <= '{$params['user_updated_at_end']}' ";
            }

            $sql .= ' GROUP BY property_id ';

            $r = $db->query($sql);

            $row = $r->fetchAll(\PDO::FETCH_ASSOC);

            $data_id = array();
            foreach ($row as $v)
            {
                $data_id[] = $v['property_id'];
            }
            //print_r($row);exit;
        }

        $field = array(
            'property.*',
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            'requirement.name(requirement_name)',
            'property_status.name(property_status_name)',
            // "developer.name(developer_name)",
            'size_unit.name(size_unit_name)',
            'project.name(project_name)',
            'zone.name(zone_name)',
            'province.name(province_name)',
            'owners.id(owners_id)',
            'owners.owner(owner)'
        );

        $join = array(
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            '[>]requirement'     => array('requirement_id' => 'id'),
            '[>]property_status' => array('property_status_id' => 'id'),
            // "[>]developer"=> ["developer_id"=> "id"],
            '[>]size_unit'       => array('size_unit_id' => 'id'),
            '[>]project'         => array('project_id' => 'id'),
            '[>]zone'            => array('zone_id' => 'id'),
            '[>]province'        => array('province_id' => 'id'),
            '[>]owners'          => array('owner_id' => 'id')
        );

        $limit = empty($_GET['limit']) ? 15 : $_GET['limit'];
        $where = array('AND' => array());

        if ( ! empty($params['account_comment_id']) || ! empty($params['user_updated_at_start']) || ! empty($params['user_updated_at_end']))
        {
            $where['AND']['property.id'] = $data_id;
        }

        if ( ! empty($params['property_type_id']))
        {
            $where['AND']['property.property_type_id'] = $params['property_type_id'];
        }

        if ( ! empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0')
        {
            if ('4+' == $params['bedrooms'])
            {
                $where['AND']['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else
            {
                $where['AND']['property.bedrooms'] = $params['bedrooms'];
            }
        }

        if ( ! empty($params['project_id']))
        {
            $where['AND']['property.project_id'] = $params['project_id'];
        }

        // zone
        if ( ! empty($params['zone_id']))
        {
            $where['AND']['property.zone_id'] = $params['zone_id'];
        }

        if ( ! empty($params['province_id']))
        {
            $where['AND']['property.province_id'] = $params['province_id'];
        }

        if ( ! empty($params['property_status_id']))
        {
            $where['AND']['property.property_status_id'] = $params['property_status_id'];
        }

        if ( ! empty($params['bts_id']))
        {
            $where['AND']['property.bts_id'] = $params['bts_id'];
        }

        if ( ! empty($params['mrt_id']))
        {
            $where['AND']['property.mrt_id'] = $params['mrt_id'];
        }

        if ( ! empty($params['created_at_start']))
        {
            $where['AND']['property.created_at[>=]'] = $params['created_at_start'] . ' 00:00:00';
        }

        if ( ! empty($params['created_at_end']))
        {
            $where['AND']['property.created_at[<=]'] = $params['created_at_end'] . ' 00:00:00';
        }

        if ( ! empty($params['updated_at_start']))
        {
            $where['AND']['property.updated_at[>=]'] = $params['updated_at_start'] . ' 00:00:00';
        }

        if ( ! empty($params['updated_at_end']))
        {
            $where['AND']['property.updated_at[<=]'] = $params['updated_at_end'] . ' 00:00:00';
        }

        $page      = ! empty($params['page']) ? $params['page'] : 1;
        $orderType = ! empty($params['orderType']) ? $params['orderType'] : 'DESC';
        $orderBy   = ! empty($params['orderBy']) ? $params['orderBy'] : 'updated_at';
        $order     = "{$orderBy} {$orderType}";

        if (count($where['AND']) > 0)
        {
            $where['ORDER'] = $order;
            $list           = ListDAO::gets('property', array(
                'field' => $field,
                'join'  => $join,
                'where' => $where,
                'page'  => $page,
                'limit' => $limit
            ));
        }
        else
        {
            $list = ListDAO::gets('property', array(
                'field' => $field,
                'join'  => $join,
                'page'  => $page,
                'where' => array('ORDER' => $order),
                'limit' => $limit
            ));
        }

        $where = array();
        foreach ($list['data'] as &$ls)
        {
            $where['AND']['property_id'] = $ls['id'];
            $where['ORDER']              = 'updated_at DESC';
            $where['LIMIT']              = 1;
            $row                         = $db->select('property_comment', '*', $where);
            $comment_by                  = $db->get('account', 'name', array('id' => $row[0]['comment_by']));

            $ls['last_comment'] = $row[0]['comment'];
            $ls['comment_by']   = $comment_by;
        }

        //$list['sql'] = $db->log();

        return $list;
    }

    /**
     * @GET
     * @uri /csv
     */
    public function csvByBetween()
    {
        ini_set('memory_limit', '1024M');
        $db = MedooFactory::getInstance();

        $params = $this->reqInfo->params();

        if ( ! empty($params['account_comment_id']) || ! empty($params['user_updated_at_start']) || ! empty($params['user_updated_at_end']))
        {
            $sql = 'SELECT property_id FROM property_comment
            WHERE 1=1 ';

            if ( ! empty($params['account_comment_id']))
            {
                $sql .= " AND comment_by = '{$params['account_comment_id']}' ";
            }

            if ( ! empty($params['user_updated_at_start']))
            {
                $sql .= " AND updated_at >= '{$params['user_updated_at_start']}' ";
            }

            if ( ! empty($params['user_updated_at_end']))
            {
                $sql .= " AND updated_at <= '{$params['user_updated_at_end']}' ";
            }

            $sql .= ' GROUP BY property_id ';

            $r = $db->query($sql);

            $row = $r->fetchAll(\PDO::FETCH_ASSOC);

            $data_id = array();
            foreach ($row as $v)
            {
                $data_id[] = $v['property_id'];
            }
            //print_r($row);exit;
        }

        $field = array(
            'property.*',
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            'requirement.name(requirement_name)',
            'property_status.name(property_status_name)',
            // "developer.name(developer_name)",
            'size_unit.name(size_unit_name)',
            'project.name(project_name)',
            'zone.name(zone_name)',
            'province.name(province_name)',
            'owners.id(owners_id)',
            'owners.owner(owner)'
        );

        $join = array(
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            '[>]requirement'     => array('requirement_id' => 'id'),
            '[>]property_status' => array('property_status_id' => 'id'),
            // "[>]developer"=> ["developer_id"=> "id"],
            '[>]size_unit'       => array('size_unit_id' => 'id'),
            '[>]project'         => array('project_id' => 'id'),
            '[>]zone'            => array('zone_id' => 'id'),
            '[>]province'        => array('province_id' => 'id'),
            '[>]owners'          => array('owner_id' => 'id')
        );

        $where = array('AND' => array());

        if ( ! empty($params['account_comment_id']) || ! empty($params['user_updated_at_start']) || ! empty($params['user_updated_at_end']))
        {
            $where['AND']['property.id'] = $data_id;
        }

        if ( ! empty($params['property_type_id']))
        {
            $where['AND']['property.property_type_id'] = $params['property_type_id'];
        }

        if ( ! empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0')
        {
            if ('4+' == $params['bedrooms'])
            {
                $where['AND']['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else
            {
                $where['AND']['property.bedrooms'] = $params['bedrooms'];
            }
        }

        if ( ! empty($params['project_id']))
        {
            $where['AND']['property.project_id'] = $params['project_id'];
        }

        // zone
        if ( ! empty($params['zone_id']))
        {
            $where['AND']['property.zone_id'] = $params['zone_id'];
        }

        if ( ! empty($params['province_id']))
        {
            $where['AND']['property.province_id'] = $params['province_id'];
        }

        if ( ! empty($params['property_status_id']))
        {
            $where['AND']['property.property_status_id'] = $params['property_status_id'];
        }

        if ( ! empty($params['bts_id']))
        {
            $where['AND']['property.bts_id'] = $params['bts_id'];
        }

        if ( ! empty($params['mrt_id']))
        {
            $where['AND']['property.mrt_id'] = $params['mrt_id'];
        }

        if ( ! empty($params['created_at_start']))
        {
            $where['AND']['property.created_at[>=]'] = $params['created_at_start'] . ' 00:00:00';
        }

        if ( ! empty($params['created_at_end']))
        {
            $where['AND']['property.created_at[<=]'] = $params['created_at_end'] . ' 00:00:00';
        }

        if ( ! empty($params['updated_at_start']))
        {
            $where['AND']['property.updated_at[>=]'] = $params['updated_at_start'] . ' 00:00:00';
        }

        if ( ! empty($params['updated_at_end']))
        {
            $where['AND']['property.updated_at[<=]'] = $params['updated_at_end'] . ' 00:00:00';
        }

        $page      = 1;
        $limit     = 999999;
        $orderType = ! empty($params['orderType']) ? $params['orderType'] : 'DESC';
        $orderBy   = ! empty($params['orderBy']) ? $params['orderBy'] : 'updated_at';
        $order     = "{$orderBy} {$orderType}";

        if (count($where['AND']) > 0)
        {
            $where['ORDER'] = $order;
            $list           = ListDAO::gets('property', array(
                'field' => $field,
                'join'  => $join,
                'where' => $where,
                'page'  => $page,
                'limit' => $limit
            ));
        }
        else
        {
            $list = ListDAO::gets('property', array(
                'field' => $field,
                'join'  => $join,
                'page'  => $page,
                'where' => array('ORDER' => $order),
                'limit' => $limit
            ));
        }

        $filename = 'export.csv';
        $now      = gmdate('D, d M Y H:i:s');
        header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        header('Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate');
        header("Last-Modified: {$now} GMT");

        // force download
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');
        header('Content-type: application/vnd.ms-excel; charset=UTF-8');

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header('Content-Transfer-Encoding: binary');

        if (count($list['data']) == 0)
        {
            return null;
        }

        foreach ($list['data'] as &$row)
        {
            unset($row['net_rent_price']);
            unset($row['property_highlight_id']);
            unset($row['feature_unit_id']);
            unset($row['transfer_status_id']);
            unset($row['room_type_id']);
            unset($row['contract_chk_key']);
            unset($row['property_pending_type']);
            unset($row['property_pending_info']);
            unset($row['property_pending_date']);

            $cnt             = $db->count('property_image', array('property_id' => $row['id']));
            $row['pictures'] = $cnt > 0 ? 1 : 0;
        }

        ob_start();
        $df = fopen('php://output', 'w');
        fwrite($df, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
        fputcsv($df, array_keys(reset($list['data'])));
        foreach ($list['data'] as $row)
        {
            // foreach($row as &$col) { $col = mb_convert_encoding($col, 'WINDOWS-874', 'UTF-8'); }
            //foreach($row as &$col) { $col = iconv("UTF-8", "windows-874", $col); }
            fputcsv($df, $row);
        }

        fclose($df);
        echo ob_get_clean();
        exit();

        return $list;
    }

    /**
     * @GET
     * @uri /csv_vip
     */
    public function csvVipByBetween()
    {
        ini_set('memory_limit', '1024M');
        $db = MedooFactory::getInstance();

        $field = array(
            'property.*',
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            'requirement.name(requirement_name)',
            'property_status.name(property_status_name)',
            // "developer.name(developer_name)",
            'size_unit.name(size_unit_name)',
            'project.name(project_name)',
            'zone.name(zone_name)',
            'province.name(province_name)'
        );

        $join = array(
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            '[>]requirement'     => array('requirement_id' => 'id'),
            '[>]property_status' => array('property_status_id' => 'id'),
            // "[>]developer"=> ["developer_id"=> "id"],
            '[>]size_unit'       => array('size_unit_id' => 'id'),
            '[>]project'         => array('project_id' => 'id'),
            '[>]zone'            => array('zone_id' => 'id'),
            '[>]province'        => array('province_id' => 'id')
        );

        $params = $this->reqInfo->params();
        $where  = array('AND' => array('owner[~]' => 'vip'));

        if ( ! empty($params['property_type_id']))
        {
            $where['AND']['property.property_type_id'] = $params['property_type_id'];
        }

        if ( ! empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0')
        {
            if ('4+' == $params['bedrooms'])
            {
                $where['AND']['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else
            {
                $where['AND']['property.bedrooms'] = $params['bedrooms'];
            }
        }

        if ( ! empty($params['project_id']))
        {
            $where['AND']['property.project_id'] = $params['project_id'];
        }

        // zone
        if ( ! empty($params['zone_id']))
        {
            $where['AND']['property.zone_id'] = $params['zone_id'];
        }

        if ( ! empty($params['province_id']))
        {
            $where['AND']['property.province_id'] = $params['province_id'];
        }
        if ( ! empty($params['property_status_id']))
        {
            $where['AND']['property.property_status_id'] = $params['property_status_id'];
        }
        if ( ! empty($params['bts_id']))
        {
            $where['AND']['property.bts_id'] = $params['bts_id'];
        }
        if ( ! empty($params['mrt_id']))
        {
            $where['AND']['property.mrt_id'] = $params['mrt_id'];
        }
        if ( ! empty($params['created_at_start']))
        {
            $where['AND']['property.created_at[>=]'] = $params['created_at_start'] . ' 00:00:00';
        }
        if ( ! empty($params['created_at_end']))
        {
            $where['AND']['property.created_at[<=]'] = $params['created_at_end'] . ' 00:00:00';
        }
        if ( ! empty($params['updated_at_start']))
        {
            $where['AND']['property.updated_at[>=]'] = $params['updated_at_start'] . ' 00:00:00';
        }
        if ( ! empty($params['updated_at_end']))
        {
            $where['AND']['property.updated_at[<=]'] = $params['updated_at_end'] . ' 00:00:00';
        }

        $page      = 1;
        $limit     = 999999;
        $orderType = ! empty($params['orderType']) ? $params['orderType'] : 'DESC';
        $orderBy   = ! empty($params['orderBy']) ? $params['orderBy'] : 'updated_at';
        $order     = "{$orderBy} {$orderType}";

        if (count($where['AND']) > 0)
        {
            $where['ORDER'] = $order;
            $list           = ListDAO::gets('property', array(
                'field' => $field,
                'join'  => $join,
                'where' => $where,
                'page'  => $page,
                'limit' => $limit
            ));
        }
        else
        {
            $list = ListDAO::gets('property', array(
                'field' => $field,
                'join'  => $join,
                'page'  => $page,
                'where' => array('ORDER' => $order),
                'limit' => $limit
            ));
        }

        $filename = 'export.csv';
        $now      = gmdate('D, d M Y H:i:s');
        header('Expires: Tue, 03 Jul 2001 06:00:00 GMT');
        header('Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate');
        header("Last-Modified: {$now} GMT");

        // force download
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header('Content-Transfer-Encoding: binary');

        if (count($list['data']) == 0)
        {
            return null;
        }

        foreach ($list['data'] as &$row)
        {
            unset($row['net_rent_price']);
            unset($row['property_highlight_id']);
            unset($row['feature_unit_id']);
            unset($row['transfer_status_id']);
            unset($row['room_type_id']);
            unset($row['contract_chk_key']);
            unset($row['property_pending_type']);
            unset($row['property_pending_info']);
            unset($row['property_pending_date']);

            $cnt             = $db->count('property_image', array('property_id' => $row['id']));
            $row['pictures'] = $cnt > 0 ? 1 : 0;
        }

        ob_start();
        $df = fopen('php://output', 'w');
        fputcsv($df, array_keys(reset($list['data'])));
        foreach ($list['data'] as $row)
        {
            // foreach($row as &$col) { $col = mb_convert_encoding($col, 'WINDOWS-874', 'UTF-8'); }
            foreach ($row as &$col)
            {
                $col = iconv('UTF-8', 'windows-874', $col);}
            fputcsv($df, $row);
        }
        fclose($df);
        echo ob_get_clean();
        exit();

        return $list;
    }

}
