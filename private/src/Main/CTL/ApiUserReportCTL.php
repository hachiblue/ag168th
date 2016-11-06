<?php

namespace Main\CTL;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /api/user_property
 */

class ApiUserReportCTL extends BaseCTL {

    public function getByWeek()
	{
        $back = (int)$this->reqInfo->param('back');

        $day = date('w');
        //$day -= 1;
        $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
        $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
    }

    /**
     * @GET
     */
    public function getByBetween()
	{
        $db = MedooFactory::getInstance();

        $params = $this->reqInfo->params();


        if( $params['report_type'] == 'property' )
        {
            $sql = "SELECT SQL_CALC_FOUND_ROWS 'properties' as mode, property.id, property_comment.updated_at, project.name as project_name, property.reference_id, property.address_no, property.floors, property.bedrooms, property.bathrooms, property_comment.comment FROM property_comment, property, project WHERE property.id = property_comment.property_id AND property.project_id = project.id ";

            if( !empty($params['account_comment_id']) )
            {
                $sql .= " AND property_comment.comment_by = '{$params['account_comment_id']}' ";
            }

            if( !empty($params['user_updated_at_start']) )
            {
                $sql .= " AND property_comment.updated_at >= '{$params['user_updated_at_start']}' ";
            }

            if( !empty($params['user_updated_at_end']) )
            {
                $sql .= " AND property_comment.updated_at <= '{$params['user_updated_at_end']}' ";
            }

            $limit = empty($_GET['limit'])? 15: $_GET['limit'];

            $page = !empty($params['page'])? $params['page']: 1;
            $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
            $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
            $order = "{$orderBy} {$orderType}";

            $start = ( $page == 1 )? 0 : ( ($page-1) * $limit);

            if( isset($params['mode']) && $params['mode'] == 'getreport' )
            {
                $sql .= " ORDER BY {$order}";
            }
            else
            {
                $sql .= " ORDER BY {$order} LIMIT {$start}, {$limit}";
            }
        }

        else if( $params['report_type'] == 'enquiry' )
        {
            $sql = "SELECT SQL_CALC_FOUND_ROWS 'enquiries' as mode, enquiry.id, enquiry_comment.updated_at, project.name as project_name, enquiry.enquiry_no as reference_id, enquiry.customer, enquiry_comment.comment FROM enquiry_comment, enquiry, project WHERE enquiry.id = enquiry_comment.enquiry_id AND enquiry.project_id = project.id ";

            if( !empty($params['account_comment_id']) )
            {
                $sql .= " AND enquiry_comment.comment_by = '{$params['account_comment_id']}' ";
            }

            if( !empty($params['user_updated_at_start']) )
            {
                $sql .= " AND enquiry_comment.updated_at >= '{$params['user_updated_at_start']}' ";
            }

            if( !empty($params['user_updated_at_end']) )
            {
                $sql .= " AND enquiry_comment.updated_at <= '{$params['user_updated_at_end']}' ";
            }

            $limit = empty($_GET['limit'])? 15: $_GET['limit'];

            $params['orderBy'] = str_replace('property.', 'enquiry.', $params['orderBy']);
            
            $page = !empty($params['page'])? $params['page']: 1;
            $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
            $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
            $order = "{$orderBy} {$orderType}";

            $order = str_replace('property.', 'enquiry.', $order);
            
            $start = ( $page == 1 )? 0 : ( ($page-1) * $limit);

            if( isset($params['mode']) && $params['mode'] == 'getreport' )
            {
                $sql .= " ORDER BY {$order}";
            }
            else
            {
                $sql .= " ORDER BY {$order} LIMIT {$start}, {$limit}";
            }
        }
        
        else if( $params['report_type'] == 'phonerequest' )
        {
            $sql = "SELECT SQL_CALC_FOUND_ROWS 'properties' as mode, property.id, request_contact.created_at as updated_at, project.name as project_name, request_contact.id as reference_id, enquiry.customer, '' as comment, enquiry.id as enquiry_id , enquiry.enquiry_no as enquiry_no, account.name as sale, account.phone as sphone, property.owner FROM request_contact, account, enquiry LEFT JOIN enquiry_comment ON enquiry.id = enquiry_comment.enquiry_id, property, project WHERE enquiry.id = request_contact.enquiry_id AND property.id = request_contact.property_id AND property.project_id = project.id AND request_contact.account_id = account.id ";

            if( !empty($params['account_comment_id']) )
            {
                $sql .= " AND enquiry_comment.comment_by = '{$params['account_comment_id']}' ";
            }

            if( !empty($params['user_updated_at_start']) )
            {
                $sql .= " AND enquiry_comment.updated_at >= '{$params['user_updated_at_start']}' ";
            }

            if( !empty($params['user_updated_at_end']) )
            {
                $sql .= " AND enquiry_comment.updated_at <= '{$params['user_updated_at_end']}' ";
            }

            $limit = empty($_GET['limit'])? 15: $_GET['limit'];

            $page = !empty($params['page'])? $params['page']: 1;
            $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
            $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
            $order = "{$orderBy} {$orderType}";

            $order = str_replace('property.', 'enquiry.', $order);
            
            $start = ( $page == 1 )? 0 : ( ($page-1) * $limit);

            if( isset($params['mode']) && $params['mode'] == 'getreport' )
            {
                $sql .= " ORDER BY {$order}";
            }
            else
            {
                $sql .= " ORDER BY {$order} LIMIT {$start}, {$limit}";
            }
        }

        $r = $db->query($sql);

        $row = $r->fetchAll(\PDO::FETCH_ASSOC);

        
        $sql = 'SELECT FOUND_ROWS() as total';
        $r = $db->query($sql);
        $t = $r->fetch(\PDO::FETCH_ASSOC);

        $list = array(
            "data" => $row,
            "length" => $limit,
            "total" => $t['total'],
            "paging" => array(
                    "limit" => $limit,
                    "next" => '',
                    "page" => $page
                )
        );

        return $list;
    }

    /**
     * @GET
     * @uri /reportuser
     */
    public function reportuser()
    {
        $data = $this->getByBetween();
        $data = $data['data'];

        $params = $this->reqInfo->params();

        ini_set('memory_limit', '512M');
        $db = MedooFactory::getInstance();

        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setKeywords("office 2007 openxml php");

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(80);

        $sheet = $objPHPExcel->getActiveSheet();

        $sheet->setCellValue('A1', '');
        $sheet->setCellValue('B1', 'Date/Time');
        $sheet->setCellValue('C1', 'Details');
        $sheet->setCellValue('D1', 'Comment');

        $i = 2;
        $lfcr = chr(10) . chr(13);

        foreach( $data as $k => $d )
        {

            $sheet->setCellValue('A'.$i, $d['reference_id']);
            $sheet->getStyle('A'.$i)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

            $sheet->setCellValue('B'.$i, $d['updated_at']);
            $sheet->getStyle('B'.$i)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

            $sheet->setCellValue('C'.$i, 'Project:' . $d['project_name'] 
                . ( ( isset($d['address_no']) )? "\n" . 'Address:' . $d['address_no'] : '' )
                . ( ( isset($d['customer']) )? "\n" . 'Customer:' . $d['customer'] : '' )
                . ( ( isset($d['floors']) )? "\n" . 'Floor:' . $d['floors'] : '' )
                . ( ( isset($d['bedrooms']) )? "\n" . 'Bed room:' . $d['bedrooms'] : '' )
                . ( ( isset($d['bathrooms']) )? "\n" . 'Bath room:' . $d['bathrooms'] : '' )
                . ( ( isset($d['sale']) )? "\n" . 'Sale:' . $d['sale'] : '' )
                . ( ( isset($d['sphone']) )? "\n" . 'Phone:' . $d['sphone'] : '' )
                . ( ( isset($d['owner']) )? "\n" . 'Owner:' . $d['owner'] : '' )
            );
            $sheet->getStyle('C'.$i)->getAlignment()->setWrapText(true);

            $sheet->setCellValue('D'.$i, $d['comment']);
            $sheet->getStyle('D'.$i)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_TOP);

            $i++;
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="report_user.xls"');
        $objWriter->save('php://output');
    }

}
