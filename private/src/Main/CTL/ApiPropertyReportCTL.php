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

class ApiPropertyReportCTL extends BaseCTL {
    public function getByWeek(){
        $back = (int)$this->reqInfo->param('back');

        $day = date('w');
//        $day -= 1;
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));


    }

    /**
     * @GET
     */
    public function getByBetween(){
        $db = MedooFactory::getInstance();

        $field = [
            "property.*",
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            // "developer.name(developer_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)",
            "zone.name(zone_name)",
            "province.name(province_name)"
        ];
        $join = [
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            // "[>]developer"=> ["developer_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]zone"=> ["zone_id"=> "id"],
            "[>]province"=> ["province_id"=> "id"]
        ];

        $params = $this->reqInfo->params();
        $limit = empty($_GET['limit'])? 15: $_GET['limit'];
        $where = ["AND"=> []];

        if(!empty($params['property_type_id'])){
            $where["AND"]['property.property_type_id'] = $params['property_type_id'];
        }
        if(!empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0'){
            if($params['bedrooms'] == "4+") {
                $where["AND"]['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else {
                $where["AND"]['property.bedrooms'] = $params['bedrooms'];
            }
        }

        if(!empty($params['project_id'])) {
            $where["AND"]['property.project_id'] = $params['project_id'];
        }

        // zone
        if(!empty($params['zone_id'])) {
            $where["AND"]['property.zone_id'] = $params['zone_id'];
        }
        if(!empty($params['province_id'])) {
            $where["AND"]['property.province_id'] = $params['province_id'];
        }
        if(!empty($params['property_status_id'])) {
            $where["AND"]['property.property_status_id'] = $params['property_status_id'];
        }
        if(!empty($params['bts_id'])) {
            $where["AND"]['property.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])) {
            $where["AND"]['property.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['created_at_start'])) {
            $where["AND"]['property.created_at[>=]'] = $params['created_at_start'].' 00:00:00';
        }
        if(!empty($params['created_at_end'])) {
            $where["AND"]['property.created_at[<=]'] = $params['created_at_end'].' 00:00:00';
        }
        if(!empty($params['updated_at_start'])) {
            $where["AND"]['property.updated_at[>=]'] = $params['updated_at_start'].' 00:00:00';
        }
        if(!empty($params['updated_at_end'])) {
            $where["AND"]['property.updated_at[<=]'] = $params['updated_at_end'].' 00:00:00';
        }

        $page = !empty($params['page'])? $params['page']: 1;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";

        if(count($where["AND"]) > 0){
            $where['ORDER'] = $order;
            $list = ListDAO::gets("property", [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets("property", [
                "field"=> $field,
                "join"=> $join,
                "page"=> $page,
                'where'=> ["ORDER"=> $order],
                "limit"=> $limit
            ]);
        }

        // $list['sql'] = $db->last_query();

        return $list;
    }

    /**
     * @GET
     * @uri /csv
     */
    public function csvByBetween(){
        ini_set('memory_limit', '512M');
        $db = MedooFactory::getInstance();

        $field = [
            "property.*",
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            // "developer.name(developer_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)",
            "zone.name(zone_name)",
            "province.name(province_name)"
        ];
        $join = [
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            // "[>]developer"=> ["developer_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]zone"=> ["zone_id"=> "id"],
            "[>]province"=> ["province_id"=> "id"]
        ];

        $params = $this->reqInfo->params();
        $where = ["AND"=> []];

        if(!empty($params['property_type_id'])){
            $where["AND"]['property.property_type_id'] = $params['property_type_id'];
        }
        if(!empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0'){
            if($params['bedrooms'] == "4+") {
                $where["AND"]['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else {
                $where["AND"]['property.bedrooms'] = $params['bedrooms'];
            }
        }

        if(!empty($params['project_id'])) {
            $where["AND"]['property.project_id'] = $params['project_id'];
        }

        // zone
        if(!empty($params['zone_id'])) {
            $where["AND"]['property.zone_id'] = $params['zone_id'];
        }
        if(!empty($params['province_id'])) {
            $where["AND"]['property.province_id'] = $params['province_id'];
        }
        if(!empty($params['property_status_id'])) {
            $where["AND"]['property.property_status_id'] = $params['property_status_id'];
        }
        if(!empty($params['bts_id'])) {
            $where["AND"]['property.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])) {
            $where["AND"]['property.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['created_at_start'])) {
            $where["AND"]['property.created_at[>=]'] = $params['created_at_start'].' 00:00:00';
        }
        if(!empty($params['created_at_end'])) {
            $where["AND"]['property.created_at[<=]'] = $params['created_at_end'].' 00:00:00';
        }
        if(!empty($params['updated_at_start'])) {
            $where["AND"]['property.updated_at[>=]'] = $params['updated_at_start'].' 00:00:00';
        }
        if(!empty($params['updated_at_end'])) {
            $where["AND"]['property.updated_at[<=]'] = $params['updated_at_end'].' 00:00:00';
        }

        $page = 1;
        $limit = 999999;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";

        if(count($where["AND"]) > 0){
            $where['ORDER'] = $order;
            $list = ListDAO::gets("property", [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets("property", [
                "field"=> $field,
                "join"=> $join,
                "page"=> $page,
                'where'=> ["ORDER"=> $order],
                "limit"=> $limit
            ]);
        }

        $filename = "export.csv";
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");

        if (count($list["data"]) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($list["data"])));
        foreach ($list["data"] as $row) {
            // foreach($row as &$col) { $col = mb_convert_encoding($col, 'WINDOWS-874', 'UTF-8'); }
            foreach($row as &$col) { $col = iconv("UTF-8", "windows-874", $col); }
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
    public function csvVipByBetween(){
        ini_set('memory_limit', '512M');
        $db = MedooFactory::getInstance();

        $field = [
            "property.*",
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            // "developer.name(developer_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)",
            "zone.name(zone_name)",
            "province.name(province_name)"
        ];
        $join = [
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            // "[>]developer"=> ["developer_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]zone"=> ["zone_id"=> "id"],
            "[>]province"=> ["province_id"=> "id"]
        ];

        $params = $this->reqInfo->params();
        $where = ["AND"=> ["owner[~]"=>"vip"]];

        if(!empty($params['property_type_id'])){
            $where["AND"]['property.property_type_id'] = $params['property_type_id'];
        }
        if(!empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0'){
            if($params['bedrooms'] == "4+") {
                $where["AND"]['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else {
                $where["AND"]['property.bedrooms'] = $params['bedrooms'];
            }
        }

        if(!empty($params['project_id'])) {
            $where["AND"]['property.project_id'] = $params['project_id'];
        }

        // zone
        if(!empty($params['zone_id'])) {
            $where["AND"]['property.zone_id'] = $params['zone_id'];
        }
        if(!empty($params['province_id'])) {
            $where["AND"]['property.province_id'] = $params['province_id'];
        }
        if(!empty($params['property_status_id'])) {
            $where["AND"]['property.property_status_id'] = $params['property_status_id'];
        }
        if(!empty($params['bts_id'])) {
            $where["AND"]['property.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])) {
            $where["AND"]['property.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['created_at_start'])) {
            $where["AND"]['property.created_at[>=]'] = $params['created_at_start'].' 00:00:00';
        }
        if(!empty($params['created_at_end'])) {
            $where["AND"]['property.created_at[<=]'] = $params['created_at_end'].' 00:00:00';
        }
        if(!empty($params['updated_at_start'])) {
            $where["AND"]['property.updated_at[>=]'] = $params['updated_at_start'].' 00:00:00';
        }
        if(!empty($params['updated_at_end'])) {
            $where["AND"]['property.updated_at[<=]'] = $params['updated_at_end'].' 00:00:00';
        }

        $page = 1;
        $limit = 999999;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";

        if(count($where["AND"]) > 0){
            $where['ORDER'] = $order;
            $list = ListDAO::gets("property", [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets("property", [
                "field"=> $field,
                "join"=> $join,
                "page"=> $page,
                'where'=> ["ORDER"=> $order],
                "limit"=> $limit
            ]);
        }

        $filename = "export.csv";
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");

        if (count($list["data"]) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($list["data"])));
        foreach ($list["data"] as $row) {
            // foreach($row as &$col) { $col = mb_convert_encoding($col, 'WINDOWS-874', 'UTF-8'); }
            foreach($row as &$col) { $col = iconv("UTF-8", "windows-874", $col); }
            fputcsv($df, $row);
        }
        fclose($df);
        echo ob_get_clean();
        exit();

        return $list;
    }

}
