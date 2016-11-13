<?php
/**
 * Created by PhpStorm.
 * User: NUIZ
 * Date: 7/4/2558
 * Time: 16:32
 */

namespace Main\CTL;
use FileUpload\FileUpload;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;
use Main\Helper\LastAssignManagerHelper;

/**
 * @Restful
 * @uri /api/enquiry
 */
class ApiEnquiry extends BaseCTL {
    private $table = "enquiry";
    /**
     * @GET
     */
    public function index () {
        $field = [
          "*",
          "enquiry_type.name(enquiry_type_name)",
          "enquiry_status.name(enquiry_status_name)",
          "sale.name(sale_name)",
          "manager.name(manager_name)",
          "project.name(project_name)",
          "enquiry.*"
      ];
        $join = [
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]enquiry_type"=> ["enquiry_type_id"=> "id"],
            "[>]enquiry_status"=> ["enquiry_status_id"=> "id"],
            "[>]account(sale)"=> ["assign_sale_id"=> "id"],
            "[>]account(manager)"=> ["assign_manager_id"=> "id"]
        ];
        $where = ["AND"=> []];

        if(@$_SESSION["login"]["level_id"] == 3) 
        {
          $where["AND"]["assign_manager_id"] = $_SESSION["login"]["id"];
        }
        else if(@$_SESSION["login"]["level_id"] == 4) 
        {
          $where["AND"]["assign_sale_id"] = $_SESSION["login"]["id"];
          $where["AND"]["enquiry_status_id[!]"] = 12;
        }

        $params = $this->reqInfo->params();
        // if(!empty($params['match_enquiry_id'])) {
        //   $where["AND"]['property.inc_vat'] = $params['inc_vat'];
        // }

        if(!empty($params['enquiry_no'])) {
          $where["AND"]['enquiry.enquiry_no[~]'] = $params['enquiry_no'];
        }
        if(!empty($params['enquiry_type_id'])) {
          $where["AND"]['enquiry.enquiry_type_id'] = $params['enquiry_type_id'];
        }
        if(!empty($params['customer'])) {
          $where["AND"]['enquiry.customer[~]'] = $params['customer'];
        }

        if(!empty($params['requirement_id'])) {
          $where["AND"]['enquiry.requirement_id'] = $params['requirement_id'];
        }
        // if(!empty($params['requirement_id'])){
        //     if($params['requirement_id'] != 3) {
        //       $where["AND"]['enquiry.requirement_id'] = [$params['requirement_id'], 3];
        //     }
        //     else {
        //       $where["AND"]['enquiry.requirement_id'] = $params['requirement_id'];
        //     }
        // }

        if(!empty($params['property_type_id'])) {
          $where["AND"]['enquiry.property_type_id'] = $params['property_type_id'];
        }

        if( isset($params['project_id']) && $params['project_id'] != '' ) 
        {
          $where["AND"]['enquiry.project_id'] = $params['project_id'];
        }

        if(!empty($params['province_id'])) {
          $where["AND"]['enquiry.province_id'] = $params['province_id'];
        }

        if((!empty($params['size_start']) || !empty($params['size_end'])) && !empty($params['size_unit_id'])){
            $where["AND"]['enquiry.size_unit_id'] = $params['size_unit_id'];

            if(!empty($params['size_start'])) {
              $where["AND"]['enquiry.size[>=]'] = $params['size_start'];
            }
            if(!empty($params['size_end'])) {
              $where["AND"]['enquiry.size[<=]'] = $params['size_end'];
            }
        }

        if(!empty($params['buy_budget_start']) || !empty($params['buy_budget_end'])){
            if(!empty($params['buy_budget_start'])) {
              $where["AND"]['enquiry.buy_budget_start[>=]'] = $params['buy_budget_start'];
            }
            if(!empty($params['buy_budget_end'])) {
              $where["AND"]['enquiry.buy_budget_end[<=]'] = $params['buy_budget_end'];
            }
        }

        if(!empty($params['rent_budget_start']) || !empty($params['rent_budget_end'])){
            if(!empty($params['rent_budget_start'])) {
              $where["AND"]['enquiry.rent_budget_start[>=]'] = $params['rent_budget_start'];
            }
            if(!empty($params['rent_budget_end'])) {
              $where["AND"]['enquiry.rent_budget_end[<=]'] = $params['rent_budget_end'];
            }
        }

        if(!empty($params['decision_maker'])) {
          $where["AND"]['enquiry.decision_maker'] = $params['decision_maker'];
        }
        if(!empty($params['ptime_to_pol'])) {
          $where["AND"]['enquiry.ptime_to_pol'] = $params['ptime_to_pol'];
        }
        if(!empty($params['bedroom'])) {
          $where["AND"]['enquiry.bedroom'] = $params['bedroom'];
        }
        if(!empty($params['is_studio'])) {
          $where["AND"]['enquiry.is_studio'] = $params['is_studio'];
        }
        if(!empty($params['bts_id'])) {
          $where["AND"]['enquiry.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])) {
          $where["AND"]['enquiry.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['enquiry_status_id'])) {
          $where["AND"]['enquiry.enquiry_status_id'] = $params['enquiry_status_id'];
        }
        if(!empty($params['ex_location'])) {
          $where["AND"]['enquiry.ex_location[~]'] = $params['ex_location'];
        }
        if(!empty($params['contact_type_id'])) {
          $where["AND"]['enquiry.contact_type_id'] = $params['contact_type_id'];
        }

        if(!empty($params['assign_manager_id'])) {
          $where["AND"]['enquiry.assign_manager_id'] = $params['assign_manager_id'];
        }
        if(!empty($params['assign_sale_id'])) {
          $where["AND"]['enquiry.assign_sale_id'] = $params['assign_sale_id'];
        }

        if(!empty($params['created_at_start'])) {
          $where["AND"]['enquiry.created_at[>=]'] = $params['created_at_start'].' 00:00:00';
        }
        if(!empty($params['created_at_end'])) {
          $where["AND"]['enquiry.created_at[<=]'] = $params['created_at_end'].' 00:00:00';
        }
        if(!empty($params['updated_at_start'])) {
          $where["AND"]['enquiry.updated_at[>=]'] = $params['updated_at_start'].' 00:00:00';
        }
        if(!empty($params['updated_at_end'])) {
          $where["AND"]['enquiry.updated_at[<=]'] = $params['updated_at_end'].' 00:00:00';
        }

        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "enquiry.updated_at";
        $order = "{$orderBy} {$orderType}";

        $limit = empty($_GET['limit'])? 15: $_GET['limit'];
        $page = !empty($params['page'])? $params['page']: 1;


        if(count($where["AND"]) > 0){
            $where["ORDER"] = $order;
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                'where'=> ["ORDER"=> $order],
                "page"=> $page,
                "limit"=> $limit
            ]);
        }

        // print_r(\Main\DB\Medoo\MedooFactory::getInstance()->error()); exit();

        $this->_builds($list["data"]);
        return $list;
    }


    /**
    * @GET
    * @uri /reportenquiry
    */
    public function reportenquiry()
    {
        ini_set('memory_limit', '512M');

        $field = [
            "project.name(project_name)",
            "enquiry.enquiry_no",
            "enquiry.customer",
            "enquiry_comment.updated_at(comm_update)",
            "enquiry_comment.comment",
            "enquiry.chk1",
            "enquiry.chk2",
            "enquiry.chk3",
            "comm.name(comment_name)"
        ];

        $join = [
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]enquiry_type"=> ["enquiry_type_id"=> "id"],
            "[>]enquiry_status"=> ["enquiry_status_id"=> "id"],
            "[>]account(sale)"=> ["assign_sale_id"=> "id"],
            "[>]account(manager)"=> ["assign_manager_id"=> "id"],
            "[>]enquiry_comment"=> ["id"=> "enquiry_id"],
            "[>]account(comm)"=> ["enquiry_comment.comment_by"=> "id"]
        ];

        $where = ["AND"=> []];

        if(@$_SESSION["login"]["level_id"] == 3) {
          $where["AND"]["assign_manager_id"] = $_SESSION["login"]["id"];
        }
        else if(@$_SESSION["login"]["level_id"] == 4) {
          $where["AND"]["assign_sale_id"] = $_SESSION["login"]["id"];
        }

        $params = $this->reqInfo->params();
        // if(!empty($params['match_enquiry_id'])) {
        //   $where["AND"]['property.inc_vat'] = $params['inc_vat'];
        // }

        if(!empty($params['enquiry_no'])) {
          $where["AND"]['enquiry.enquiry_no[~]'] = $params['enquiry_no'];
        }
        if(!empty($params['enquiry_type_id'])) {
          $where["AND"]['enquiry.enquiry_type_id'] = $params['enquiry_type_id'];
        }
        if(!empty($params['customer'])) {
          $where["AND"]['enquiry.customer[~]'] = $params['customer'];
        }

        if(!empty($params['requirement_id'])) {
          $where["AND"]['enquiry.requirement_id'] = $params['requirement_id'];
        }
        // if(!empty($params['requirement_id'])){
        //     if($params['requirement_id'] != 3) {
        //       $where["AND"]['enquiry.requirement_id'] = [$params['requirement_id'], 3];
        //     }
        //     else {
        //       $where["AND"]['enquiry.requirement_id'] = $params['requirement_id'];
        //     }
        // }

        if(!empty($params['property_type_id'])) {
          $where["AND"]['enquiry.property_type_id'] = $params['property_type_id'];
        }

        if( isset($params['project_id']) && $params['project_id'] != '' ) 
        {
          $where["AND"]['enquiry.project_id'] = $params['project_id'];
        }

        if(!empty($params['province_id'])) {
          $where["AND"]['enquiry.province_id'] = $params['province_id'];
        }

        if((!empty($params['size_start']) || !empty($params['size_end'])) && !empty($params['size_unit_id'])){
            $where["AND"]['enquiry.size_unit_id'] = $params['size_unit_id'];

            if(!empty($params['size_start'])) {
              $where["AND"]['enquiry.size[>=]'] = $params['size_start'];
            }
            if(!empty($params['size_end'])) {
              $where["AND"]['enquiry.size[<=]'] = $params['size_end'];
            }
        }

        if(!empty($params['buy_budget_start']) || !empty($params['buy_budget_end'])){
            if(!empty($params['buy_budget_start'])) {
              $where["AND"]['enquiry.buy_budget_start[>=]'] = $params['buy_budget_start'];
            }
            if(!empty($params['buy_budget_end'])) {
              $where["AND"]['enquiry.buy_budget_end[<=]'] = $params['buy_budget_end'];
            }
        }

        if(!empty($params['rent_budget_start']) || !empty($params['rent_budget_end'])){
            if(!empty($params['rent_budget_start'])) {
              $where["AND"]['enquiry.rent_budget_start[>=]'] = $params['rent_budget_start'];
            }
            if(!empty($params['rent_budget_end'])) {
              $where["AND"]['enquiry.rent_budget_end[<=]'] = $params['rent_budget_end'];
            }
        }

        if(!empty($params['decision_maker'])) {
          $where["AND"]['enquiry.decision_maker'] = $params['decision_maker'];
        }
        if(!empty($params['ptime_to_pol'])) {
          $where["AND"]['enquiry.ptime_to_pol'] = $params['ptime_to_pol'];
        }
        if(!empty($params['bedroom'])) {
          $where["AND"]['enquiry.bedroom'] = $params['bedroom'];
        }
        if(!empty($params['is_studio'])) {
          $where["AND"]['enquiry.is_studio'] = $params['is_studio'];
        }
        if(!empty($params['bts_id'])) {
          $where["AND"]['enquiry.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])) {
          $where["AND"]['enquiry.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['enquiry_status_id'])) {
          $where["AND"]['enquiry.enquiry_status_id'] = $params['enquiry_status_id'];
        }
        if(!empty($params['ex_location'])) {
          $where["AND"]['enquiry.ex_location[~]'] = $params['ex_location'];
        }
        if(!empty($params['contact_type_id'])) {
          $where["AND"]['enquiry.contact_type_id'] = $params['contact_type_id'];
        }

        if(!empty($params['assign_manager_id'])) {
          $where["AND"]['enquiry.assign_manager_id'] = $params['assign_manager_id'];
        }
        if(!empty($params['assign_sale_id'])) {
          $where["AND"]['enquiry.assign_sale_id'] = $params['assign_sale_id'];
        }

        if(!empty($params['created_at_start'])) {
          $where["AND"]['enquiry.created_at[>=]'] = $params['created_at_start'].' 00:00:00';
        }
        if(!empty($params['created_at_end'])) {
          $where["AND"]['enquiry.created_at[<=]'] = $params['created_at_end'].' 00:00:00';
        }
        if(!empty($params['updated_at_start'])) {
          $where["AND"]['enquiry.updated_at[>=]'] = $params['updated_at_start'].' 00:00:00';
        }
        if(!empty($params['updated_at_end'])) {
          $where["AND"]['enquiry.updated_at[<=]'] = $params['updated_at_end'].' 00:00:00';
        }

        $page = 1;
        $limit = 999999;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";


        if(count($where["AND"]) > 0){
            $where["ORDER"] = $order;
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                'where'=> ["ORDER"=> $order],
                "page"=> $page,
                "limit"=> $limit
            ]);
        }

        $enq = array();

        foreach( $list['data'] as $e )
        {
          $enq[$e['enquiry_no']][] = $e;
        }

        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $sheet = $objPHPExcel->getActiveSheet();

        $sheet->setCellValue('A1', '');
        $sheet->setCellValue('B1', 'Date/Time');
        $sheet->setCellValue('C1', 'Details');
        $sheet->setCellValue('D1', 'Comment');

        $i = 1;
        $lfcr = chr(10) . chr(13);

        foreach( $enq as $en )
        {
          $i++;

          $sheet->setCellValue('A'.$i, 'Enquiry No');
          $sheet->getStyle('A'.$i)->getFont()->setBold(true);
          $sheet->setCellValue('B'.$i, $en[0]['enquiry_no']);

          if( isset($en[0]['chk1']) && $en[0]['chk1'] == 'Y' )
          {
            $sheet->setCellValue('C'.$i, 'Agent 168');
            $sheet->getStyle('C'.$i)->getFont()->setBold(true);  
          }

          $i++;

          $sheet->setCellValue('A'.$i, 'Project');
          $sheet->getStyle('A'.$i)->getFont()->setBold(true);
          $sheet->setCellValue('B'.$i, $en[0]['project_name']);

          if( isset($en[0]['chk2']) && $en[0]['chk2'] == 'Y' )
          {
            $sheet->setCellValue('C'.$i, 'Hot Stock');  
            $sheet->getStyle('C'.$i)->getFont()->setBold(true);  
          }

          $i++;

          $sheet->setCellValue('A'.$i, 'Customer');
          $sheet->getStyle('A'.$i)->getFont()->setBold(true);
          $sheet->setCellValue('B'.$i, $en[0]['customer']);

          if( isset($en[0]['chk3']) && $en[0]['chk3'] == 'Y' )
          {
            $sheet->setCellValue('C'.$i, 'Individual');  
            $sheet->getStyle('C'.$i)->getFont()->setBold(true);  
          }

          $i++;

          $sheet->setCellValue('A'.$i, 'วันที่');
          $sheet->getStyle('A'.$i)->getFont()->setBold(true);
          $sheet->setCellValue('B'.$i, 'ข้อความ');
          $sheet->getStyle('B'.$i)->getFont()->setBold(true);
          $sheet->setCellValue('C'.$i, 'โดย');
          $sheet->getStyle('C'.$i)->getFont()->setBold(true);
          $i++;

          foreach( $en as $cm )
          {
            $sheet->setCellValue('A'.$i, $cm['comm_update']);
            $sheet->setCellValue('B'.$i, $cm['comment']);
            $sheet->setCellValue('C'.$i, $cm['comment_name']);
            $i++;
          }
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="enquiry_report.xls"');
        $objWriter->save('php://output');
    }

    /**
     * @GET
     * @uri /csv
     */
    public function csvByBetween () {

        ini_set('memory_limit', '512M');

        $field = [
            "*",
            "enquiry_type.name(enquiry_type_name)",
            "enquiry_status.name(enquiry_status_name)",
            "sale.name(sale_name)",
            "manager.name(manager_name)",
            "project.name(project_name)",
            "enquiry.*"
        ];
        $join = [
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"],
            "[>]enquiry_type"=> ["enquiry_type_id"=> "id"],
            "[>]enquiry_status"=> ["enquiry_status_id"=> "id"],
            "[>]account(sale)"=> ["assign_sale_id"=> "id"],
            "[>]account(manager)"=> ["assign_manager_id"=> "id"]
        ];
        $where = ["AND"=> []];

        if(@$_SESSION["login"]["level_id"] == 3) {
          $where["AND"]["assign_manager_id"] = $_SESSION["login"]["id"];
        }
        else if(@$_SESSION["login"]["level_id"] == 4) {
          $where["AND"]["assign_sale_id"] = $_SESSION["login"]["id"];
        }

        $params = $this->reqInfo->params();
        // if(!empty($params['match_enquiry_id'])) {
        //   $where["AND"]['property.inc_vat'] = $params['inc_vat'];
        // }

        if(!empty($params['enquiry_no'])) {
          $where["AND"]['enquiry.enquiry_no[~]'] = $params['enquiry_no'];
        }
        if(!empty($params['enquiry_type_id'])) {
          $where["AND"]['enquiry.enquiry_type_id'] = $params['enquiry_type_id'];
        }
        if(!empty($params['customer'])) {
          $where["AND"]['enquiry.customer[~]'] = $params['customer'];
        }

        if(!empty($params['requirement_id'])) {
          $where["AND"]['enquiry.requirement_id'] = $params['requirement_id'];
        }
        // if(!empty($params['requirement_id'])){
        //     if($params['requirement_id'] != 3) {
        //       $where["AND"]['enquiry.requirement_id'] = [$params['requirement_id'], 3];
        //     }
        //     else {
        //       $where["AND"]['enquiry.requirement_id'] = $params['requirement_id'];
        //     }
        // }

        if(!empty($params['property_type_id'])) {
          $where["AND"]['enquiry.property_type_id'] = $params['property_type_id'];
        }

        if( isset($params['project_id']) && $params['project_id'] != '' ) 
        {
          $where["AND"]['enquiry.project_id'] = $params['project_id'];
        }

        if(!empty($params['province_id'])) {
          $where["AND"]['enquiry.province_id'] = $params['province_id'];
        }

        if((!empty($params['size_start']) || !empty($params['size_end'])) && !empty($params['size_unit_id'])){
            $where["AND"]['enquiry.size_unit_id'] = $params['size_unit_id'];

            if(!empty($params['size_start'])) {
              $where["AND"]['enquiry.size[>=]'] = $params['size_start'];
            }
            if(!empty($params['size_end'])) {
              $where["AND"]['enquiry.size[<=]'] = $params['size_end'];
            }
        }

        if(!empty($params['buy_budget_start']) || !empty($params['buy_budget_end'])){
            if(!empty($params['buy_budget_start'])) {
              $where["AND"]['enquiry.buy_budget_start[>=]'] = $params['buy_budget_start'];
            }
            if(!empty($params['buy_budget_end'])) {
              $where["AND"]['enquiry.buy_budget_end[<=]'] = $params['buy_budget_end'];
            }
        }

        if(!empty($params['rent_budget_start']) || !empty($params['rent_budget_end'])){
            if(!empty($params['rent_budget_start'])) {
              $where["AND"]['enquiry.rent_budget_start[>=]'] = $params['rent_budget_start'];
            }
            if(!empty($params['rent_budget_end'])) {
              $where["AND"]['enquiry.rent_budget_end[<=]'] = $params['rent_budget_end'];
            }
        }

        if(!empty($params['decision_maker'])) {
          $where["AND"]['enquiry.decision_maker'] = $params['decision_maker'];
        }
        if(!empty($params['ptime_to_pol'])) {
          $where["AND"]['enquiry.ptime_to_pol'] = $params['ptime_to_pol'];
        }
        if(!empty($params['bedroom'])) {
          $where["AND"]['enquiry.bedroom'] = $params['bedroom'];
        }
        if(!empty($params['is_studio'])) {
          $where["AND"]['enquiry.is_studio'] = $params['is_studio'];
        }
        if(!empty($params['bts_id'])) {
          $where["AND"]['enquiry.bts_id'] = $params['bts_id'];
        }
        if(!empty($params['mrt_id'])) {
          $where["AND"]['enquiry.mrt_id'] = $params['mrt_id'];
        }
        if(!empty($params['enquiry_status_id'])) {
          $where["AND"]['enquiry.enquiry_status_id'] = $params['enquiry_status_id'];
        }
        if(!empty($params['ex_location'])) {
          $where["AND"]['enquiry.ex_location[~]'] = $params['ex_location'];
        }
        if(!empty($params['contact_type_id'])) {
          $where["AND"]['enquiry.contact_type_id'] = $params['contact_type_id'];
        }

        if(!empty($params['assign_manager_id'])) {
          $where["AND"]['enquiry.assign_manager_id'] = $params['assign_manager_id'];
        }
        if(!empty($params['assign_sale_id'])) {
          $where["AND"]['enquiry.assign_sale_id'] = $params['assign_sale_id'];
        }

        if(!empty($params['created_at_start'])) {
          $where["AND"]['enquiry.created_at[>=]'] = $params['created_at_start'].' 00:00:00';
        }
        if(!empty($params['created_at_end'])) {
          $where["AND"]['enquiry.created_at[<=]'] = $params['created_at_end'].' 00:00:00';
        }
        if(!empty($params['updated_at_start'])) {
          $where["AND"]['enquiry.updated_at[>=]'] = $params['updated_at_start'].' 00:00:00';
        }
        if(!empty($params['updated_at_end'])) {
          $where["AND"]['enquiry.updated_at[<=]'] = $params['updated_at_end'].' 00:00:00';
        }

        $page = 1;
        $limit = 999999;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";


        if(count($where["AND"]) > 0){
            $where["ORDER"] = $order;
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                "where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else {
            $list = ListDAO::gets($this->table, [
                "field"=> $field,
                "join"=> $join,
                'where'=> ["ORDER"=> $order],
                "page"=> $page,
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

        if (count($list["data"]) == 0) 
        {
            return null;
        }

        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($list["data"])));
        foreach ($list["data"] as $row) 
        {
          // foreach($row as &$col) { $col = mb_convert_encoding($col, 'WINDOWS-874', 'UTF-8'); }
          foreach($row as &$col) { $col = iconv("UTF-8", "windows-874", $col); }
          fputcsv($df, $row);
        }

        fclose($df);
        echo ob_get_clean();
        exit();
    }

    /**
     * @POST
     */
    public function add () {
        $params = $this->reqInfo->params();
        $insert = ArrayHelper::filterKey([
          "enquiry_type_id", "customer", "requirement_id", "property_type_id", "province_id", "project_id",
          "buy_budget_start", "buy_budget_end", "rent_budget_start", "rent_budget_end", "zone_id",
          "desicion_maker", "bedroom", "is_studio", "size", "size_unit_id", "bts_id", "mrt_id",
          "airport_link_id", "enquiry_status_id", "ex_location", "ptime_to_pol", "sq_furnish",
          "sq_hospital", "sq_school", "sq_park", "sq_bts", "sq_shopmall", "sq_airport", "sq_mainroad",
          "sq_other", "contact_type_id", "chk1", "chk2", "chk3", "contact_method", "website"
        ], $params);

        $insert = array_map(function($item) 
        {
          if(is_string($item)) 
          {
            $item = trim($item);
          }
          return $item;
        }, $insert);

        if(empty($params['comment'])) 
        {
          return ResposenHelper::error("require comment");
        }
        $now = date('Y-m-d H:i:s');;
        $insert['created_at'] = $now;
        $insert['updated_at'] = $now;
        $insert['enquiry_no'] = $this->_generateReferenceId($insert["enquiry_type_id"]);

        $insert['chk1'] = ( isset($params["chk1"]) )? $params["chk1"] : 'N';
        $insert['chk2'] = ( isset($params["chk2"]) )? $params["chk2"] : 'N';
        $insert['chk3'] = ( isset($params["chk3"]) )? $params["chk3"] : 'N';
        $insert['contact_method'] = ( ( isset($params["contact_method"]) ) ? $params["contact_method"] : '');
        $insert['website'] = ( ( isset($params["website"]) ) ? $params["website"] : '');

        $db = MedooFactory::getInstance();
        $db->pdo->beginTransaction();
        $id = $db->insert($this->table, $insert);
        if(!$id) {
           return ResponseHelper::error("Error can't add enquiry.".$db->error()[2]);
        }

        $accId = $_SESSION['login']['id'];
        $commentInsert = [
          "enquiry_id"=> $id,
          "comment"=> $params["comment"],
          "comment_by"=> $accId,
          "updated_at"=> $now,
          "user_remind"=> ( ( isset($params["account"]) ) ? $params["account"] : '')          
        ];

        $db->insert("enquiry_comment", $commentInsert);
        $db->pdo->commit();

        $item = $db->get($this->table, "*", ["id"=> $id]);
        return $item;
    }

    /**
     * @DELETE
     * @uri /[i:id]
     */
    public function delete() {
        $id = $this->reqInfo->urlParam("id");

        $db = MedooFactory::getInstance();
        $id = $db->delete($this->table, ["id"=> $id]);

        if(!$id){
            return ResponseHelper::error("Error can't remove property.");
        }

        return ["success"=> true];
    }

    /**
     * @POST
     */
    public function rentalexpire() {
      echo 'xx';exit;
    }

    /**
     * @POST
     * @uri /edit/[i:id]
     */
    public function edit() {
        $id = $this->reqInfo->urlParam("id");

        $params = $this->reqInfo->params();
        $set = ArrayHelper::filterKey([
          "enquiry_type_id", "customer", "requirement_id", "property_type_id", "province_id", "project_id",
          "buy_budget_start", "buy_budget_end", "rent_budget_start", "rent_budget_end", "zone_id",
          "desicion_maker", "bedroom", "is_studio", "size", "size_unit_id", "bts_id", "mrt_id",
          "airport_link_id", "enquiry_status_id", "ex_location", "ptime_to_pol", "sq_furnish",
          "sq_hospital", "sq_school", "sq_park", "sq_bts", "sq_shopmall", "sq_airport", "sq_mainroad",
          "sq_other", "contact_type_id", "book_property_id"
        ], $params);

        $now = date('Y-m-d H:i:s');
        $set['updated_at'] = $now;

        $db = MedooFactory::getInstance();
        // $old = $db->get("request_contact", "*", ["id"=> $id]);
        $old = $db->get("enquiry", "*", ["id"=> $id]);

        $fnIsChangeToBook = function() use ($set, $old)
        {
          return !empty($set['enquiry_status_id'])
            && $set['enquiry_status_id'] == 7
            && $old['enquiry_status_id'] != 7;
        };

        if($_SESSION['login']['level_id'] == 4 && $fnIsChangeToBook()) 
        {
          unset($set['enquiry_status_id']);
          $set['wait_book_approve'] = 1;
        }

        if(!empty($set['enquiry_status_id']) && $set['enquiry_status_id'] != 7) 
        {
          $set['wait_book_approve'] = 0;
          $set['book_property_id'] = NULL;
        }

        $set['chk1'] = ( isset($params["chk1"]) )? $params["chk1"] : 'N';
        $set['chk2'] = ( isset($params["chk2"]) )? $params["chk2"] : 'N';
        $set['chk3'] = ( isset($params["chk3"]) )? $params["chk3"] : 'N';
        $set['contact_method'] = ( ( isset($params["contact_method"]) ) ? $params["contact_method"] : '');
        $set['website'] = ( ( isset($params["website"]) ) ? $params["website"] : '');

        $db->update($this->table, $set, ['id'=> $id]);

        $accId = $_SESSION['login']['id'];
        $commentInsert = [
          "enquiry_id"=> $id,
          "comment"=> $params["comment"],
          "comment_by"=> $accId,
          "updated_at"=> $now,
          "user_remind"=> ( ( isset($params["account"]) ) ? $params["account"] : '')
        ];

        $db->insert("enquiry_comment", $commentInsert);

        $item = $db->get($this->table, "*", ["id"=> $id]);
        $acc = $db->get("account", "*", ["id"=> $accId]);

        // mail when comment
        $url = URL::absolute("/admin/enquiries#/edit/".$id);
        $mailContent = <<<MAILCONTENT
        Enquiry: <a href="{$url}">{$old["enquiry_no"]}</a> has comment by {$acc["name"]}. please check enquiry.
MAILCONTENT;

        $mailHeader = "From: system@agent168th.com\r\n";
        $mailHeader = "To: admin@agent168th.com\r\n";
        $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
        @mail("admin@agent168th.com", "Comment enquiry: ".$old["enquiry_no"], $mailContent, $mailHeader);

        if($_SESSION['login']['level_id'] == 3 && $fnIsChangeToBook()) {
          $url = URL::absolute("/admin/enquiries#/edit/".$id);
          $urlProp = URL::absolute("/admin/properties#/edit/".$item['book_property_id']);
          $prop = $db->get("property", ["reference_id"], ['id'=> $item['book_property_id']]);

          $mailContent = <<<MAILCONTENT
          Enquiry has booked.<br />
          Please go to property and change status to booked.<br />
          Enquiry: <a href="{$url}">{$old["enquiry_no"]}</a>.<br />
          Property: <a href="{$urlProp}">{$prop["reference_id"]}</a>.<br />
          Approve by: {$acc['name']}.<br />
MAILCONTENT;

          $mailHeader = "From: system@agent168th.com\r\n";
          $mailHeader = "To: admin@agent168th.com\r\n";
          $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";

          @mail("admin@agent168th.com", "Booked enquiry: ".$item["enquiry_no"], $mailContent, $mailHeader);
        }

        $db->update("request_contact", ["commented"=> 1], [
          "AND"=> [
            "property_id"=> $id,
            "account_id"=> $accId
            ]
          ]);

        return $item;
    }

    /**
     * @GET
     * @uri /[i:id]
     */
    public function get() {
        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $item = $db->get($this->table, "*", ["id"=> $id]);
        $this->_build($item);
        return $item;
    }

    /**
     * @GET
     * @uri /assign_list_manager
     */
    public function assignListManager()
    {
      $level_id = (int)$_SESSION['login']['level_id'];
      if($level_id > 2) {
        return ResponseHelper::error("You do not have permission");
      }

      $db = MedooFactory::getInstance();

      $las = $db->get("last_assign_sale", "*", ["manager_id"=> $_SESSION['login']['id']]);
      $lastId = LastAssignManagerHelper::get();

      $condition = ["level_id"=> 3];
      $accounts = $db->select("account", "*", [
        "AND"=> $condition,
        "ORDER"=> "id ASC"
      ]);

      $next = array_reduce($accounts, function($carry, $item) use($lastId){
        if(is_null($carry)) {
          return $lastId < $item["id"]? $item: null;
        }
        else {
          return $item["id"] < $carry["id"]? $item: $carry;
        }
      });
      if(is_null($next)) $next = @$accounts[0];

      return [
        "auto_assign"=> $next,
        "accounts"=> $accounts
        ];
    }

    /**
     * @GET
     * @uri /assign_list_sale
     */
    public function assignListSale()
    {
      $level_id = (int)$_SESSION['login']['level_id'];
      if($level_id > 3) {
        return ResponseHelper::error("You do not have permission");
      }

      $db = MedooFactory::getInstance();

      $las = $db->get("last_assign_sale", "*", ["manager_id"=> $_SESSION['login']['id']]);
      $lastId = !$las? 0: $las['sale_id'];

      $condition = ["level_id"=> 4];
      if(!in_array($level_id, [1, 2])) {
        $condition["manager_id"] = $_SESSION["login"]["id"];
      }
      else if(!empty($params["enquiry_id"])) {
        $params = $this->reqInfo->params();
        $enq = $db->get("enquiry", "manager_id", ["id"=> $params["enquiry_id"]]);
        $condition["manager_id"] = $enq["manager_id"];
      }
      $accounts = $db->select("account", "*", [
        "AND"=> $condition,
        "ORDER"=> "id ASC"
      ]);

      $next = array_reduce($accounts, function($carry, $item) use($lastId){
        if(is_null($carry)) {
          return $lastId < $item["id"]? $item: null;
        }
        else {
          return $item["id"] < $carry["id"]? $item: $carry;
        }
      });
      if(is_null($next)) $next = @$accounts[0];

      return [
        "auto_assign"=> $next,
        "accounts"=> $accounts
        ];
    }



    /**
    * @GET
    * @uri /[i:id]/accept_comment
    */
    public function accept_comment()
    {
      $id = $this->reqInfo->urlParam("id");

      $set = array();
      $set['read_status'] = 'read';

      $db = MedooFactory::getInstance();
      $db->update('enquiry_comment', $set, ['id'=> $id]);

      echo json_encode(array('id'=>$id));
    }


    /**
    * @GET
    * @uri /[i:id]/comment
    */
    public function getComments()
    {
      $id = $this->reqInfo->urlParam("id");
      $list = ListDAO::gets("enquiry_comment", [
          "field"=> [
            "enquiry_comment.*", "account.id(account_id)", "account.name", "account.email",
          ],
          "join"=> [
            "[>]account"=> ["comment_by"=> "id"]
          ],
          "limit"=> 100,
          "where"=> [
              "enquiry_id"=> $id,
              "ORDER"=> "updated_at DESC"
          ]
      ]);

      foreach($list['data'] as &$item) 
      {
        if(is_null($item['account_id'])) 
        {
          $item['name'] = "System";
        }

        if( $item['user_remind'] == $_SESSION['login']['id'] && $item['read_status'] == 'noread') 
        {
          $item['btn_read'] = 'READ';
        }
        else
        {
          $item['btn_read'] = "";
        }
      }

      return $list;
    }

    /**
     * @POST
     * @uri /assign_manager
     */
    public function assignManager()
    {
      $params = $this->reqInfo->params();
      $id = $params['id'];

      $set = [];
      $set['assign_manager_id'] = empty($params['assign_manager_id'])? NULL: $params['assign_manager_id'];
      $set['assign_manager_at'] = $set['assign_manager_id'] == NULL? NULL: date('Y-m-d H:i:s');
      $set['assign_sale_id'] = NULL;
      $set['assign_sale_at'] = NULL;

      $db = MedooFactory::getInstance();
      $item = $db->get("enquiry", "*", ["id"=> $id]);
      $acc = $db->get("account", "*", ["id"=> $set['assign_manager_id']]);

      $db->update($this->table, $set, ['id'=> $id]);
      if(@$params['is_auto'] == 1) {
        LastAssignManagerHelper::set($set["assign_manager_id"]);
      }

      $mailContent = <<<MAILCONTENT
      Assign enquiry: {$item["enquiry_no"]} to you. please check enquiry.
MAILCONTENT;

      $mailHeader = "From: system@agent168th.com\r\n";
      $mailHeader = "To: {$acc['email']}\r\n";
      $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
      @mail($acc["email"], "Assign enquiry: ".$item["enquiry_no"], $mailContent, $mailHeader);

      $item = $db->get($this->table, "*", ["id"=> $id]);

      return $item;
    }

    /**
     * @POST
     * @uri /assign_sale
     */
    public function assignSale()
    {
      $params = $this->reqInfo->params();
      $id = $params['id'];

      $db = MedooFactory::getInstance();

      $old = $db->get("enquiry", "*", ["id"=> $id]);

      $set = [];
      $set['assign_sale_id'] = empty($params['assign_sale_id'])? NULL: $params['assign_sale_id'];
      $set['assign_sale_at'] = $set['assign_sale_id'] == NULL? NULL: date('Y-m-d H:i:s');

      if(!is_null($set['assign_sale_id'])) {
        $sale = $db->get("account", "*", ["id"=> $set['assign_sale_id']]);
        if($old['assign_manager_id'] != $sale["manager_id"]) {
          $set["assign_manager_id"] = $sale["manager_id"];
          $set["assign_manager_at"] = $set['assign_sale_at'];
        }
      }

      $item = $db->get("enquiry", "*", ["id"=> $id]);
      $acc = $db->get("account", "*", ["id"=> $set['assign_sale_id']]);

      $db->update($this->table, $set, ['id'=> $id]);

      if(@$params['is_auto'] == 1) {
        if($db->get("last_assign_sale", "*", ["manager_id"=> @$_SESSION["login"]["id"]])) {
          $db->update("last_assign_sale", ["sale_id"=> $params['assign_sale_id']]);
        }
        else {
          $db->insert("last_assign_sale", [
            "sale_id"=> $params['assign_sale_id'],
            "manager_id"=> @$_SESSION["login"]["id"]
          ]);
        }
      }

      $mailContent = <<<MAILCONTENT
      Assign enquiry: {$item["enquiry_no"]} to you. please check enquiry.
MAILCONTENT;
      $mailHeader = "From: system@agent168th.com\r\n";
      $mailHeader = "To: {$acc['email']}\r\n";
      $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
      @mail($acc["email"], "Assign enquiry: ".$item["enquiry_no"], $mailContent, $mailHeader);

      $item = $db->get($this->table, "*", ["id"=> $id]);

      return $item;
    }


    /**
     * @GET
     * @uri /[i:id]/for_match
     */
    public function getForMatch()
    {
      $id = $this->reqInfo->urlParam("id");
      // $sql = "SELECT
      //   property.*,
      //   requirement.name as requirement_name,
      //   property_status.name as property_status_name,
      //   size_unit.name as size_unit_name
      //   project.name as project_name
      //     FROM property
      //     LEFT JOIN requirement ON property.requirement_id = requirement.id
      //     LEFT JOIN property_status ON property.property_status_id = property_status.id
      //     LEFT JOIN size_unit ON property.size_unit_id = size_unit.id
      //     LEFT JOIN project ON property.project_id = project.id
      //     WHERE ";

        $field = [
            "property.*",
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            // "developer.name(developer_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)"
        ];
        $join = [
            // "[>]property_type"=> ["property_type_id"=> "id"],
            // "[>]zone_group"=> ["zone_group_id"=> "id"],
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            // "[>]developer"=> ["developer_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"]
        ];

        $limit = empty($_GET['limit'])? 15: $_GET['limit'];
        $where = ["AND"=> []];

        $params = $this->reqInfo->params();
        $where["AND"]['property.match_enquiry_id'] = NULL;
        $where["AND"]['property.match_enquiry_id'] = NULL;

        if(!empty($params['property_type_id'])){
            $where["AND"]['property.property_type_id'] = $params['property_type_id'];
        }
        if(!empty($params['bedrooms'])){
            if($params['bedrooms'] == "4+") {
              $where["AND"]['property.bedrooms[>=]'] = $params['bedrooms'];
            }
            else {
              $where["AND"]['property.bedrooms'] = $params['bedrooms'];
            }
        }
        if(!empty($params['requirement_id'])){
            $where["AND"]['property.requirement_id'] = $params['requirement_id'];
        }
        if(!empty($params['project_id'])){
            $where["AND"]['property.project_id'] = $params['project_id'];
        }
        if(!empty($params['web_status'])){
            $where["AND"]['property.web_status'] = $params['web_status'];
        }
        if(!empty($params['property_highlight_id'])){
            $where["AND"]['property.property_highlight_id'] = $params['property_highlight_id'];
        }
        if(!empty($params['feature_unit_id'])){
            $where["AND"]['property.feature_unit_id'] = $params['feature_unit_id'];
        }


        // new
        if(!empty($params['web_status'])){
            $where["AND"]['property.web_status'] = $params['web_status'];
        }
        if(!empty($params['reference_id'])){
            $where["AND"]['property.reference_id'] = $params['reference_id'];
        }
        if(!empty($params['owner'])){
            $where["AND"]['property.owner[~]'] = $params['owner'];
        }
        if((!empty($params['size_start']) || !empty($params['size_end'])) && !empty($params['size_unit_id'])){
            $where["AND"]['property.size_unit_id'] = $params['size_unit_id'];

            if(!empty($params['size_start'])) {
              $where["AND"]['property.size[>=]'] = $params['size_start'];
            }
            if(!empty($params['size_end'])) {
              $where["AND"]['property.size[<=]'] = $params['size_end'];
            }
        }

        // sell price
        if(!empty($params['sell_price_start'])) {
          $where["AND"]['property.sell_price[>=]'] = $params['sell_price_start'];
        }
        if(!empty($params['sell_price_end'])) {
          $where["AND"]['property.sell_price[<=]'] = $params['sell_price_end'];
        }

        // rent price
        if(!empty($params['rent_price_start'])) {
          $where["AND"]['property.rent_price[>=]'] = $params['rent_price_start'];
        }
        if(!empty($params['rent_price_end'])) {
          $where["AND"]['property.rent_price[<=]'] = $params['rent_price_end'];
        }

        // vat
        if(!empty($params['inc_vat'])) {
          $where["AND"]['property.inc_vat'] = $params['inc_vat'];
        }

        // address_no
        if(!empty($params['address_no'])) {
          $where["AND"]['property.address_no[~]'] = $params['address_no'];
        }

        // status
        if(!empty($params['property_status_id'])) {
          $where["AND"]['property.property_status_id'] = $params['property_status_id'];
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

        $db = MedooFactory::getInstance();
        $enquiry = $db->get("enquiry", "*", ["id"=> $id]);
        $enquiry["project"] = $db->get("project", "*", ["id"=> $enquiry["project_id"]]);
        $list["enquiry"] = $enquiry;

        // $this->_proBuilds($list['data']);

        return $list;
    }

    /**
     * @POST
     * @uri /[i:id]/match
     */
    public function match()
    {
      $id = $this->reqInfo->urlParam("id");
      $params = $this->reqInfo->params();
      $db = MedooFactory::getInstance();
      foreach($params["props_id"] as $propId) {
        $db->update("property", ["match_enquiry_id"=> $id], ["id"=> $propId]);
      }
      return ["success"=> true];
    }

    /**
     * @GET
     * @uri /[i:id]/matched
     */
    public function matched()
    {
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();

        $field = [
            "property.*",
            "requirement.name(requirement_name)",
            "property_status.name(property_status_name)",
            "size_unit.name(size_unit_name)",
            "project.name(project_name)"
        ];
        $join = [
            "[>]requirement"=> ["requirement_id"=> "id"],
            "[>]property_status"=> ["property_status_id"=> "id"],
            "[>]size_unit"=> ["size_unit_id"=> "id"],
            "[>]project"=> ["project_id"=> "id"]
        ];

        $limit = empty($_GET['limit'])? 15: $_GET['limit'];
        $where = ["AND"=> ["property.match_enquiry_id"=> $id]];

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

        $db = MedooFactory::getInstance();
        foreach($list["data"] as &$item) {
          $item["request_contact"] = $db->get("request_contact", "*", [
            "AND"=> [
              "property_id"=> $item["id"],
              "enquiry_id"=> $id,
              "account_id"=> $_SESSION['login']['id']
            ],
            "ORDER"=> 'id DESC'
          ]);
        }

        return $list;
    }

    /**
     * @POST
     * @uri /request_contact
     */
    public function requestContact()
    {
      //status_id: 1 request, 2 accept, 3 denine

      $params = $this->reqInfo->params();
      $db = MedooFactory::getInstance();

      $cCommented = $db->count("request_contact", [
          "AND"=> [
            "enquiry_id"=> $params["enquiry_id"],
            // "property_id"=> $params["property_id"],
            "account_id"=> $_SESSION["login"]["id"],
            "commented"=> 0
          ]
        ]);

      if($cCommented > 0) {
        return ResponseHelper::error("You need to comment previous enquiry you request before request more contact");
      }

      $props_id = $this->reqInfo->param("props_id", []);
      foreach($props_id as $prop_id) {
        $reqContact = $db->get("request_contact", "*", [
            "AND"=> [
              "enquiry_id"=> $params["enquiry_id"],
              "property_id"=> $prop_id,
              "account_id"=> $_SESSION["login"]["id"],
              "status_id"=> 1
            ]
          ]);

        if($reqContact) {
          continue;
        }

        $insert = [
          "enquiry_id"=> $params["enquiry_id"],
          "property_id"=> $prop_id,
          "account_id"=> $_SESSION["login"]["id"],
          "status_id"=> 1,
          "created_at"=> date("Y-m-d H:i:s")
        ];
        $db->insert("request_contact", $insert);
      }

      return ['success'=> true];

      // return $list = ListDAO::gets($this->table, [
      //     "field"=> $field,
      //     "join"=> $join,
      //     "where"=> $where,
      //     "limit"=> 100
      // ]);
    }

    /**
     * @GET
     * @uri /matched/delete/[i:id]
     */
    public function matchedDelete()
    {
      $id = $this->reqInfo->urlParam("id");
      $params = $this->reqInfo->params();
      $db = MedooFactory::getInstance();
      $db->update("property", ["match_enquiry_id"=> NULL], ["id"=> $id]);
      $db->delete("request_contact", ["property_id"=> $id]);

      return ['success'=> true];
    }

    /**
     * @GET
     * @uri /account
     */
    public function account()
    {
      $db = MedooFactory::getInstance();
      return $db->select("account", ['id', 'name', 'level_id']);
    }

    // internal function

    private $managers = [];
    private $sales = [];

    public function getManager($id)
    {
      $db = MedooFactory::getInstance();
      $keyId = strval($id);
      if(isset($this->managers[$keyId])) {
        return $this->managers[$keyId];
      }
      else {
        $this->managers[$keyId] = $db->get("account", ["id", "name", "username", "email"], [
          "AND"=> [
            "id"=> $id,
            "level_id"=> 3
          ]
        ]);
        return $this->managers[$keyId];
      }
    }

    public function getSale($id)
    {
      $db = MedooFactory::getInstance();
      $keyId = strval($id);
      if(isset($this->sales[$keyId])) {
        return $this->sales[$keyId];
      }
      else {
        $this->sales[$keyId] = $db->get("account", ["id", "name", "username", "email"], [
          "AND"=> [
            "id"=> $id,
            "level_id"=> 4
          ]
        ]);
        return $this->sales[$keyId];
      }
    }

    public function _build(&$item)
    {
      $db = MedooFactory::getInstance();
      $item["assign_manager"] = $this->getManager($item["assign_manager_id"]);
      $item["assign_sale"] = $this->getSale($item["assign_sale_id"]);
    }

    public function _builds(&$items)
    {
      foreach($items as &$item) {
        $this->_build($item);
      }
    }



    public function _generateReferenceId($propTypeId)
    {
      $db = MedooFactory::getInstance();
      $propType = $db->get("enquiry_type", "*", ["id"=> $propTypeId]);
      if(!$propType) {
        return false;
      }

      $code = "E".$propType["code"];
      $dt = new \DateTime();
      return $this->_generateReferenceId2($code, $dt);
    }

    public function _generateReferenceId2($code, $dt) {
      $dtStr = $code.$dt->format('dmy');

      $db = MedooFactory::getInstance();
      $sql = "SELECT enquiry_no FROM enquiry WHERE SUBSTRING(enquiry_no, 1, 8) = '{$dtStr}' ORDER BY enquiry_no DESC LIMIT 1";
      $r = $db->query($sql);
      $row = $r->fetch(\PDO::FETCH_ASSOC);
      if(!empty($row)) {
        $n = substr($row['enquiry_no'], -2);
        if($n == '99') {
          $dt->add(new \DateInterval('P1D'));
          return $this->_generateReferenceId2($code, $dt);
        }
        else {
          $n = intval($n) + 1;
          return $code.$dt->format("dmy").sprintf("%02d", $n);
        }
      }
      else {
        return $code.$dt->format("dmy")."00";
      }
    }
}
