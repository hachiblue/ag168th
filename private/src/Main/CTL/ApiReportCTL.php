<?php

namespace Main\CTL;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /api/report
 */

class ApiReportCTL extends BaseCTL {

    /**
     * @GET
	 * @uri /sale
     */
    public function sale()
	{
        $db = MedooFactory::getInstance();

        $params = $this->reqInfo->params();
		
		$sql = "SELECT id, name FROM account WHERE level_id = '4' ";

		if( !empty($params['sale_id']) )
		{
			$sql .= " AND id = '{$params['sale_id']}' ";
		}

		$r = $db->query($sql);
        $rows = $r->fetchAll(\PDO::FETCH_ASSOC);

		foreach( $rows as &$row )
		{
			$sql_count = "select count(*) as cnt from enquiry_comment where comment_by = ".$row['id']." and enquiry_status_id xxStatusxx and month(updated_at) = ".$params['month'] . " and year(updated_at) =".$params['year'];
		
			$q = $db->query(str_replace("xxStatusxx", "!= ''", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['all_case'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='2'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['f5percent'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='3'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['f10percent'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='5'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['f25percent'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='6'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['f50percent'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='14'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['potential'] = $q['cnt'];
	
			$row['followup_total'] = $row['f5percent'] + $row['f10percent'] + $row['f25percent'] + $row['f50percent'];
			
			$q = $db->query(str_replace("xxStatusxx", "='4'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['ignore'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='10'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['fail'] = $q['cnt'];

			$q = $db->query(str_replace("xxStatusxx", "='12'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['checked'] = $q['cnt'];
			
			$row['fail_total'] = $row['ignore'] + $row['fail'] + $row['checked'];

			$q = $db->query(str_replace("xxStatusxx", "='9'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['success'] = $q['cnt'];

			$row['grand_total'] = $row['followup_total'] + $row['fail_total'] + $row['success'];

			$q = $db->query(str_replace("xxStatusxx", "='5'", $sql_count))->fetch(\PDO::FETCH_ASSOC);
			$row['touring'] = $q['cnt'];

			$row['fail_percentage'] = number_format($row['fail_total'] > 0 ? (( $row['fail_total'] * 100 ) / $row['grand_total']) : 0, 2);
			$row['success_percentage'] = number_format($row['success'] > 0 ? (( $row['success'] * 100 ) / $row['grand_total']) : 0, 2);
		}

        $list = array(
            "data" => $rows,
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
