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
use Main\Helper\ImageHelper;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;

//use Main\Excel\PHPExcel;

if ( ! defined('SPHPEXCEL_ROOT'))
{
    define('SPHPEXCEL_ROOT', dirname(__FILE__) . '/');
    require SPHPEXCEL_ROOT . '/../Excel/PHPExcel.php';
}

/**
 * @Restful
 * @uri /api/property
 */
class ApiProperty extends BaseCTL
{
    /**
     * @var string
     */
    private $table = 'property';

    /**
     * @param $item
     */
    public function _build(&$item)
    {
        if (@$_SESSION['login']['level_id'] > 2)
        {
            $item['owner'] = '';
        }
    }

    /**
     * @param $item
     */
    public function _buildImage(&$item)
    {
        $item['url'] = URL::absolute('/public/prop_pic/' . $item['name']);
    }

    /**
     * @param $items
     */
    public function _buildImages(&$items)
    {
        foreach ($items as $key => $value)
        {
            $this->_buildImage($items[$key]);
        }
    }

    /**
     * @param $items
     */
    public function _builds(&$items)
    {
        foreach ($items as &$item)
        {
            $this->_build($item);
        }
    }

    /**
     * @param  $propTypeId
     * @return mixed
     */
    public function _generateReferenceId($propTypeId)
    {
        $db       = MedooFactory::getInstance();
        $propType = $db->get('property_type', '*', array('id' => $propTypeId));
        if ( ! $propType)
        {
            return false;
        }

        $code = 'A' . $propType['code'];
        $dt   = new \DateTime();
        return $this->_generateReferenceId2($code, $dt);
    }

    /**
     * @param $code
     * @param $dt
     */
    public function _generateReferenceId2($code, $dt)
    {
        $dtStr = $code . $dt->format('dmy');

        $db  = MedooFactory::getInstance();
        $sql = "SELECT reference_id FROM property WHERE SUBSTRING(reference_id, 1, 8) = '{$dtStr}' ORDER BY reference_id DESC LIMIT 1";
        $r   = $db->query($sql);
        $row = $r->fetch(\PDO::FETCH_ASSOC);
        if ( ! empty($row))
        {
            $n = substr($row['reference_id'], -2);
            if ('99' == $n)
            {
                $dt->add(new \DateInterval('P1D'));
                return $this->_generateReferenceId2($code, $dt);
            }
            else
            {
                $n = intval($n) + 1;
                return $code . $dt->format('dmy') . sprintf('%02d', $n);
            }
        }
        else
        {
            return $code . $dt->format('dmy') . '00';
        }
    }

    /**
     * @POST
     */
    public function add()
    {
        $db     = MedooFactory::getInstance();
        $params = $this->reqInfo->params();
        $insert = ArrayHelper::filterKey(array(
            'property_type_id', 'project_id', 'address_no', 'floors', 'size', 'size_unit_id', 'bedrooms', 'bathrooms',
            'requirement_id', 'contract_price', 'sell_price', 'net_sell_price', 'rent_price', 'net_rent_price', 'owner_id',
            'key_location_id', 'zone_id', 'road', 'province_id', 'district_id', 'sub_district_id', 'bts_id', 'mrt_id',
            'airport_link_id', 'property_status_id', 'contract_expire', 'web_status', 'property_highlight_id',
            'feature_unit_id', 'rented_expire', 'inc_vat', 'transfer_status_id', 'web_url_search', 'room_type_id', 'contract_chk_key',
            'property_pending_type', 'property_pending_info', 'property_pending_date', 'building_no', 'unit_no', 'direction'
        ), $params);

        $insert = array_map(function ($item)
        {
            if (is_string($item))
            {
                $item = trim($item);
            }
            return $item;
        }, $insert);

        if (empty($params['comment']))
        {
            return ResposenHelper::error('require comment');
        }

        if ( ! isset($insert['property_type_id']))
        {
            return ResponseHelper::error('require property_type_id');
        }

        if ( ! empty($insert['project_id']) && ! empty($insert['address_no']))
        {
            if ($db->count('property', '*', array(
                'AND' => array(
                    'project_id' => $insert['project_id'],
                    'address_no' => $insert['address_no']
                ))) > 0)
            {
                return ResponseHelper::error('Property ซ้ำ');
            }
        }

        $insert['reference_id'] = $this->_generateReferenceId($insert['property_type_id']);

        if ( ! $insert['reference_id'])
        {
            return ResponseHelper::error("property_type_id '{$insert['property_type_id']}' is invalid");
        }

        if (isset($set['contract_expire']) && trim($set['contract_expire']) == '')
        {
            $set['contract_expire'] = null;
        }

        if (isset($set['contract_expire']) && trim($set['rented_expire']) == '')
        {
            $set['rented_expire'] = null;
        }

        $now                  = date('Y-m-d H:i:s');
        $insert['created_at'] = $now;
        $insert['updated_at'] = $now;

        unset($insert['owner']);

        $db->pdo->beginTransaction();
        $id = $db->insert($this->table, $insert);

        // todo: insert new owner
        /*
        if ($id && ! empty($params['owner']))
        {
            $owner_id = $db->insert('owners', array('owner' => $params['owner']));
            $db->update($this->table, array('owner_id' => $owner_id), array('id' => $id));
        }
        */

        if ( ! $id)
        {
            return ResponseHelper::error("Error can't add property.");
        }

        $accId         = $_SESSION['login']['id'];
        $commentInsert = array(
            'property_id' => $id,
            'comment'     => $params['comment'],
            'comment_by'  => $accId,
            'updated_at'  => $now
        );

        $db->insert('property_comment', $commentInsert);
        $db->pdo->commit();

        $item = $db->get($this->table, '*', array('id' => $id));

        $acc         = $db->get('account', '*', array('id' => $accId));
        $url         = URL::absolute('/admin/properties#/edit/' . $id);
        $mailContent = <<<MAILCONTENT
        Property: <a href="{$url}">{$item['reference_id']}</a> has added by {$acc['name']}. please check property.
MAILCONTENT;

        /**
         * OLD
         * $mailHeader = "From: system@agent168th.com\r\n";
         * $mailHeader = "To: admin@agent168th.com\r\n";
         * $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
         * @mail("admin@agent168th.com", "Added property: ".$item["reference_id"], $mailContent, $mailHeader);
         */
        $this->mailsender('system@agent168th.com', 'admin@agent168th.com', 'Added property: ' . $item['reference_id'], $mailContent);

        return $item;
    }

    /**
     * @GET
     * @uri /quotation2
     */
    public function csvVipByBetween()
    {
        ini_set('memory_limit', '512M');
        $db = MedooFactory::getInstance();

        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setKeywords('office 2007 openxml php');

        $sharedStyle1 = new \PHPExcel_Style();
        $style0       = new \PHPExcel_Style();
        $style1       = new \PHPExcel_Style();
        $style2       = new \PHPExcel_Style();

        $_GET['q'] = substr($_GET['q'], 0, -1);

        $q_id = str_replace(',', "','", $_GET['q']);

        $db  = MedooFactory::getInstance();
        $sql = "SELECT pj.name as propjectname, pt.name_th as prop_type, pj.id as proj_id, prop.* FROM property prop, project pj, property_type pt WHERE prop.project_id = pj.id AND prop.property_type_id = pt.id AND prop.id IN ('" . $q_id . "') ";
        $r   = $db->query($sql);
        $row = $r->fetchAll(\PDO::FETCH_ASSOC);

        $proj = array();
        if ( ! empty($row))
        {
            foreach ($row as $i => $r)
            {
                $proj[$r['propjectname']]['list'][] = $r;
            }
        }

        $styleBorder = array(
            'borders' => array(
                'bottom' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '95B3D7')
                )
            )
        );

        $sharedStyle1->applyFromArray(
            array(
                'fill'      => array(
                    'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('argb' => 'DBE5F1')
                ),
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            ));

        $style0->applyFromArray(
            array(
                'fill'      => array(
                    'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('argb' => 'C2D69B')
                ),
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            ));

        $style1->applyFromArray(
            array(
                'fill'      => array(
                    'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('argb' => '92CDDC')
                ),
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            ));

        $style2->applyFromArray(
            array(
                'fill'      => array(
                    'type'  => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('argb' => 'B8CCE4')
                ),
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                )
            ));

        $headerstyle = array('font' => array('size' => 18, 'bold' => true, 'color' => array('rgb' => '1F497D')));
        $signstyle   = array('alignment' => array(
            'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
        ), 'font' => array('size' => 13, 'bold' => true, 'color' => array('rgb' => '000000')));

        $bankstyle1 = array(
            'borders' => array(
                'top'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '548DD4')
                ),
                'right' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '548DD4')
                ),
                'left'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '548DD4')
                ), 'font' => array('bold' => true)
            )
        );

        $bankstyle2 = array(
            'borders' => array(
                'bottom' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '548DD4')
                ),
                'right'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '548DD4')
                ),
                'left'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '548DD4')
                ), 'font' => array('bold' => true)
            )
        );

        $projstyle0 = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );
        $projstyle1 = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '31859B')
                )
            )
        );

        $projstyle2 = array(
            'borders' => array(
                'allborders' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '1F497D')
                )
            )
        );

        $hd10 = array(
            'borders' => array(
                'right' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'left'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'top'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );
        $hd11 = array(
            'borders' => array(
                'right' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '31859B')
                ),
                'left'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'top'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );
        $hd12 = array(
            'borders' => array(
                'right' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '1F497D')
                ),
                'left'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'top'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );

        $hd20 = array(
            'borders' => array(
                'right'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'left'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'bottom' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );
        $hd21 = array(
            'borders' => array(
                'right'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '31859B')
                ),
                'left'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'bottom' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );
        $hd22 = array(
            'borders' => array(
                'right'  => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '1F497D')
                ),
                'left'   => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                ),
                'bottom' => array(
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '4F6128')
                )
            )
        );

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);

        $objPHPExcel->getDefaultStyle()
            ->getAlignment()
            ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet = $objPHPExcel->getActiveSheet();

        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $logo = 'public/images/Logo_new.png'; // Provide path to your logo file
        $objDrawing->setPath($logo);
        $objDrawing->setOffsetX(6);   // setOffsetX works properly
        $objDrawing->setOffsetY(250); //setOffsetY has no effect
        $objDrawing->setCoordinates('B1');
        $objDrawing->setHeight(65); // logo height
        $objDrawing->setWorksheet($sheet);

        $sheet
            ->mergeCells('B6:C6')->setCellValue('B6', 'DATE')
            ->mergeCells('B7:C7')->setCellValue('B7', 'TIME')
            ->mergeCells('B8:C8')->setCellValue('B8', 'Customer name')
            ->mergeCells('B9:C9')->setCellValue('B9', 'Contact no.')
            ->mergeCells('D6:F6')->setCellValue('D6', '')
            ->mergeCells('D7:F7')->setCellValue('D7', '')
            ->mergeCells('D8:F8')->setCellValue('D8', '')
            ->mergeCells('D9:F9')->setCellValue('D9', '')
            ->mergeCells('B11:J11')->setCellValue('B11', 'QUOTATION');

        $sheet->getStyle('B11')->applyFromArray($headerstyle);

        $i      = 13;
        $istyle = 0;
        foreach ($proj as $pid => $p)
        {
            $sty  = 'style' . ($istyle % 3);
            $psty = 'projstyle' . ($istyle % 3);
            $hd2  = 'hd2' . ($istyle % 3);
            $hd1  = 'hd1' . ($istyle % 3);

            $istyle++;

            $sheet->mergeCells('B' . $i . ':C' . $i)->setCellValue('B' . $i, $pid);
            $sheet->setSharedStyle(${
                $sty}, 'B' . $i . ':C' . $i);
            $sheet->getStyle('B' . $i . ':C' . $i)->applyFromArray(${
                $psty});

            $i++;

            $sheet->setCellValue('B' . $i, 'No.');
            $sheet->setCellValue('C' . $i, 'Address');
            $sheet->setCellValue('D' . $i, 'Floor');
            $sheet->setCellValue('E' . $i, 'Area (sq.m)');
            $sheet->setCellValue('F' . $i, 'TYPE');
            $sheet->setCellValue('G' . $i, 'Bedroom/Bathroom');
            $sheet->setCellValue('H' . $i, 'Price/sqm. (Baht)');
            $sheet->setCellValue('I' . $i, 'Unit Price (Baht)');
            $sheet->setCellValue('J' . $i, 'Rent Price (Baht)');

            $sheet->setSharedStyle(${
                $sty}, 'B' . $i . ':J' . $i);
            $sheet->getStyle('B' . $i . ':J' . $i)->applyFromArray(${
                $hd1});

            $i++;

            $sheet->setCellValue('B' . $i, 'ลำดับ');
            $sheet->setCellValue('C' . $i, 'บ้านเลขที่');
            $sheet->setCellValue('D' . $i, 'ชั้น');
            $sheet->setCellValue('E' . $i, 'พื้นที่ (ตร.ม.)');
            $sheet->setCellValue('F' . $i, 'ประเภท');
            $sheet->setCellValue('G' . $i, 'ห้องนอน / ห้องน้ำ');
            $sheet->setCellValue('H' . $i, 'ราคาต่อตร.ม. (บาท)');
            $sheet->setCellValue('I' . $i, 'ราคาสุทธิ (บาท)');
            $sheet->setCellValue('J' . $i, 'ราคาสุทธิ (บาท)');

            $sheet->setSharedStyle(${
                $sty}, 'B' . $i . ':J' . $i);
            $sheet->getStyle('B' . $i . ':J' . $i)->applyFromArray(${
                $hd2});

            $seq = 1;
            foreach ($p['list'] as $j => $list)
            {
                $i++;

                $xsize = (0 == $list['size']) ? 1 : $list['size'];
                $sheet->setCellValue('B' . $i, $seq);
                $sheet->setCellValue('C' . $i, $list['address_no']);
                $sheet->setCellValue('D' . $i, $list['floors']);
                $sheet->setCellValue('E' . $i, $list['size']);
                $sheet->setCellValue('F' . $i, $list['prop_type']);
                $sheet->setCellValue('G' . $i, $list['bedrooms'] . ' / ' . $list['bathrooms']);
                $sheet->setCellValue('H' . $i, number_format($list['sell_price'] / $xsize, 2));
                $sheet->setCellValue('I' . $i, number_format($list['sell_price'], 2));
                $sheet->setCellValue('J' . $i, (isset($list['rent_price']) && ! empty($list['rent_price'])) ? number_format($list['rent_price'], 2) : '-');

                $seq++;
            }

            $i += 3;
        }

        $i += 2;

        $sheet->setCellValue('H' . $i, 'Contact Person :');
        $sheet->setCellValue('J' . $i, '');

        $sheet->getStyle('H' . $i)->applyFromArray($signstyle);

        $i++;

        $sheet->setCellValue('J' . $i, 'Property Consultant - Sales');

        $i++;

        $sheet->setCellValue('H' . $i, 'Mobile :');
        $sheet->setCellValue('J' . $i, '');

        $sheet->getStyle('H' . $i)->applyFromArray($signstyle);

        $i++;

        $sheet->setCellValue('H' . $i, 'Email :');
        $sheet->setCellValue('J' . $i, '');

        $sheet->getStyle('H' . $i)->applyFromArray($signstyle);

        $i += 3;

        $sheet->getStyle('B' . $i . ':J' . $i)->applyFromArray($bankstyle1);

        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo2');
        $objDrawing->setDescription('Logo2');
        $logo2 = 'public/images/kasikornlogo.gif'; // Provide path to your logo file
        $objDrawing->setPath($logo2);

        $objDrawing->setCoordinates('C' . $i);
        $objDrawing->setHeight(40); // logo height
        $objDrawing->setWorksheet($sheet);

        $sheet->mergeCells('D' . $i . ':E' . $i)->setCellValue('D' . $i, 'ชื่อบัญชี  Account Name');
        $sheet->mergeCells('F' . $i . ':G' . $i)->setCellValue('F' . $i, 'เลขที่บัญชี  Account No.');
        $sheet->setCellValue('H' . $i, 'สาขา  Branch');
        $sheet->setCellValue('J' . $i, 'ประเภทบัญชี');

        $i++;

        $sheet->getStyle('B' . $i . ':J' . $i)->applyFromArray($bankstyle2);

        $sheet->mergeCells('D' . $i . ':E' . $i)->setCellValue('D' . $i, 'บริษัท เอเจ้นท์168');
        $sheet->mergeCells('F' . $i . ':G' . $i)->setCellValue('F' . $i, '732-1-02459-3');
        $sheet->setCellValue('H' . $i, 'เดอะมอลล์บางกะปิ');
        $sheet->setCellValue('J' . $i, 'กระแสรายวัน');

        $sheet->setSharedStyle($sharedStyle1, 'B6:C6')->getStyle('B6:C6')->applyFromArray($styleBorder);
        $sheet->setSharedStyle($sharedStyle1, 'B7:C7')->getStyle('B7:C7')->applyFromArray($styleBorder);
        $sheet->setSharedStyle($sharedStyle1, 'B8:C8')->getStyle('B8:C8')->applyFromArray($styleBorder);
        $sheet->setSharedStyle($sharedStyle1, 'B9:C9')->getStyle('B9:C9')->applyFromArray($styleBorder);
        //$sheet->getStyle('B9:J9')->applyFromArray($style);

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="quotation.xls"');
        $objWriter->save('php://output');

        exit();

        //return $list;
    }

    /**
     * @DELETE
     * @uri /[i:id]
     */
    public function delete()
    {
        $id = $this->reqInfo->urlParam('id');

        $db = MedooFactory::getInstance();
        $id = $db->delete($this->table, array('id' => $id));

        if ( ! $id)
        {
            return ResponseHelper::error("Error can't remove property.");
        }

        return array('success' => true);
    }

    /**
     * @DELETE
     * @uri /[i:id]/gallery
     */
    public function deleteGallery()
    {
        $id     = $this->reqInfo->urlParam('id');
        $params = $this->reqInfo->inputs();

        if ( ! is_array($params['id']))
        {
            $params['id'] = array($params['id']);
        }

        $db = MedooFactory::getInstance();
        foreach ($params['id'] as $imgId)
        {
            $where = array('AND' => array('property_id' => $id, 'id' => $imgId));
            $img   = $db->get('property_image', '*', $where);
            $path  = 'public/prop_pic/' . $img['name'];
            @unlink($path);
            $db->delete('property_image', $where);
        }

        return array('success' => true);
    }

    /**
     * @POST
     * @uri /edit/[:id]
     */
    public function edit()
    {
        $id     = $this->reqInfo->urlParam('id');
        $params = $this->reqInfo->params();
        // $insert = ArrayHelper::filterKey([
        //
        // ], $params);
        $set = $params;
        $set = ArrayHelper::filterKey(array(
            'property_type_id', 'project_id', 'address_no', 'floors', 'size', 'size_unit_id', 'bedrooms', 'bathrooms',
            'requirement_id', 'contract_price', 'sell_price', 'net_sell_price', 'rent_price', 'net_rent_price', 'owner_id',
            'key_location_id', 'zone_id', 'road', 'province_id', 'district_id', 'sub_district_id', 'bts_id', 'mrt_id',
            'airport_link_id', 'property_status_id', 'contract_expire', 'web_status', 'property_highlight_id',
            'feature_unit_id', 'rented_expire', 'inc_vat', 'transfer_status_id', 'web_url_search', 'room_type_id', 'contract_chk_key',
            'property_pending_type', 'property_pending_info', 'property_pending_date', 'building_no', 'unit_no', 'direction'
        ), $set);

        $set = array_map(function ($item)
        {
            if (is_string($item))
            {
                $item = trim($item);
            }
            return $item;
        }, $set);

        $set['updated_at'] = date('Y-m-d H:i:s');

        if (isset($set['contract_expire']) && trim($set['contract_expire']) == '')
        {
            $set['contract_expire'] = null;
        }

        if (isset($set['contract_expire']) && trim($set['rented_expire']) == '')
        {
            $set['rented_expire'] = null;
        }

        if (isset($set['comment']))
        {
            unset($set['comment']);
        }

        $where = array('id' => $id);

        $db = MedooFactory::getInstance();

        if ( ! (@$_SESSION['login']['level_id'] <= 2 && @$_SESSION['login']['level_id'] > 0))
        {
            $set = array(
                'updated_at'         => date('Y-m-d H:i:s'),
                'property_status_id' => $set['property_status_id'],
                'rented_expire'      => $set['rented_expire'],
                'web_status'         => $set['web_status']
            );
        }

        unset($set['owner']);

        $old     = $db->get($this->table, '*', $where);
        $updated = $db->update($this->table, $set, $where);

        // todo: insert/update owner
        /*
        if (isset($set['owner_id']) && ! empty($set['owner_id']) && ! empty($params['owner']))
        {
            $updated = $db->update('owners', array('owner' => $params['owner']), array('id' => $params['owner_id']));
        }
        elseif ( ! empty($params['owner']))
        {
            $owner_id = $db->insert('owners', array('owner' => $params['owner']));
            $db->update($this->table, array('owner_id' => $owner_id), $where);
        }
        */

        if ( ! $updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }

        $commentStr = trim($params['comment']);
        $accId      = $_SESSION['login']['id'];
        $db->insert('property_comment',
            array(
                'property_id' => $id,
                'comment'     => $commentStr,
                'comment_by'  => $accId,
                'updated_at'  => date('Y-m-d H:i:s')
            ));

        // mail when comment
        $acc = $db->get('account', '*', array('id' => $accId));
        $url = URL::absolute('/admin/properties#/edit/' . $id);

        $mailContent = 'Property: <a href="' . $url . '">' . $old['reference_id'] . '</a> has comment by ' . $acc['name'] . '. please check property.';

        /**
         * SMTP WAY
         */
        //$this->mailsender ( 'system@agent168th.com', 'admin@agent168th.com', 'Comment property: ' . $old["reference_id"], $mailContent );

        /**
         * OLD
         *
         * $mailHeader = "From: system@agent168th.com\r\n";
         * $mailHeader = "To: admin@agent168th.com\r\n";
         * $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
         * @mail("admin@agent168th.com", "Comment property: ".$old["reference_id"], $mailContent, $mailHeader);
         */
        $db->update('request_contact', array('commented' => 1), array(
            'AND' => array(
                'property_id' => $id,
                'account_id'  => $accId
            )
        ));

        return array('success' => true, 'query' => $db->log());
    }

    /**
     * @GET
     * @uri /[i:id]
     */
    public function get()
    {
        $id = $this->reqInfo->urlParam('id');
        $db = MedooFactory::getInstance();
        if ($this->reqInfo->param('build', false))
        {
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
                'project.number_buildings(proj_num_building)',
                'owners.id(owners_id)',
                'owners.owner(owners)'
            );
            $join = array(
                // "[>]property_type"=> ["property_type_id"=> "id"],
                // "[>]zone_group"=> ["zone_group_id"=> "id"],
                '[>]requirement'     => array('requirement_id' => 'id'),
                '[>]property_status' => array('property_status_id' => 'id'),
                // "[>]developer"=> ["developer_id"=> "id"],
                '[>]size_unit'       => array('size_unit_id' => 'id'),
                '[>]project'         => array('project_id' => 'id'),
                '[>]owners'          => array('owner_id' => 'id')
            );
            $item = $db->get('property', $join, $field, array('property.id' => $id));
        }
        else
        {
            $sql  = " select p.*, o.owner as owners from property p left join owners o on p.owner_id = o.id where p.id = '{$id}'";
            $r    = $db->query($sql);
            $item = $r->fetch(\PDO::FETCH_ASSOC);
        }

        $this->_build($item);
        return $item;
    }

    /**
     * @GET
     * @uri /[i:id]/comment
     */
    public function getComments()
    {
        $id   = $this->reqInfo->urlParam('id');
        $list = ListDAO::gets('property_comment', array(
            'field' => array(
                'property_comment.*', 'account.id(account_id)', 'account.name', 'account.email'
            ),
            'join'  => array(
                '[>]account' => array('comment_by' => 'id')
            ),
            'limit' => 100,
            'where' => array(
                'property_id' => $id,
                'ORDER'       => 'updated_at DESC'
            )
        ));

        foreach ($list['data'] as &$item)
        {
            if (is_null($item['account_id']))
            {
                $item['name'] = 'System';
            }
        }

        return $list;
    }

    /**
     * @GET
     * @uri /[i:id]/for_match
     */
    public function getForMatch()
    {
        $field = array(
            'enquiry.*',
            'enquiry_type.name(enquiry_type_name)',
            'enquiry_status.name(enquiry_status_name)',
            'enquiry.id'
        );
        $join = array(
            '[>]requirement'    => array('requirement_id' => 'id'),
            '[>]size_unit'      => array('size_unit_id' => 'id'),
            '[>]enquiry_type'   => array('enquiry_type_id' => 'id'),
            '[>]enquiry_status' => array('enquiry_status_id' => 'id')
        );
        $where = array('AND' => array());

        if (@$_SESSION['login']['level_id'] == 3)
        {
            $where['AND']['enquiry.assign_manager_id'] = $_SESSION['login']['id'];
        }
        elseif (@$_SESSION['login']['level_id'] == 4)
        {
            $where['AND']['enquiry.assign_sale_id'] = $_SESSION['login']['id'];
        }

        $where['ORDER'] = 'updated_at DESC';
        $list           = ListDAO::gets('enquiry', array(
            'field' => $field,
            'join'  => $join,
            'where' => $where,
            'limit' => 100
        ));

        return $list;
    }

    /**
     * @GET
     * @uri /[i:id]/gallery
     */
    public function getGallery()
    {
        $id = $this->reqInfo->urlParam('id');

        $list = ListDAO::gets('property_image', array(
            'limit' => 100,
            'where' => array(
                'property_id' => $id
            )
        ));

        $this->_buildImages($list['data']);

        return $list;
    }

    /**
     * @GET
     * @uri /[i:id]/matched
     */
    public function getMatched()
    {
        $id = $this->reqInfo->urlParam('id');
        $db = MedooFactory::getInstance();
        // get prop
        $item = $db->get('property', '*', array('id' => $id));
        // get enquiry
        $field = array(
            'enquiry.*',
            'enquiry_type.name(enquiry_type_name)',
            'enquiry_status.name(enquiry_status_name)',
            'requirement.name_for_enquiry(requirement_name)',
            'enquiry.id'
        );
        $join = array(
            '[>]requirement'    => array('requirement_id' => 'id'),
            '[>]size_unit'      => array('size_unit_id' => 'id'),
            '[>]enquiry_type'   => array('enquiry_type_id' => 'id'),
            '[>]enquiry_status' => array('enquiry_status_id' => 'id')
        );
        $where                      = array('AND' => array());
        $where['AND']['enquiry.id'] = $item['match_enquiry_id'];
        $where['LIMIT']             = '1';
        $enq                        = $db->select('enquiry', $join, $field, $where);
        if ( ! $enq[0])
        {
            return ResponseHelper::error('Not found match');
        }

        return $enq[0];
    }

    /**
     * @GET
     * @uri /project/[i:id]
     */
    public function getProject()
    {
        $id = $this->reqInfo->urlParam('id');
        $db = MedooFactory::getInstance();

        $item                 = $db->get('project', '*', array('id' => $id));
        $item['province']     = $db->get('province', '*', array('id' => $item['province_id']));
        $item['district']     = $db->get('district', '*', array('id' => $item['district_id']));
        $item['sub_district'] = $db->get('sub_district', '*', array('id' => $item['sub_district_id']));

        $item['bts']          = $db->get('bts', '*', array('id' => $item['bts_id']));
        $item['mrt']          = $db->get('mrt', '*', array('id' => $item['mrt_id']));
        $item['airport_link'] = $db->get('airport_link', '*', array('id' => $item['airport_link_id']));

        $item['zone']      = $db->get('zone', '*', array('id' => $item['zone_id']));
        $item['image_url'] = URL::absolute('/public/project_pic/' . $item['image_path']);

        return $item;
    }

    /**
     * @GET
     * @uri /quotation
     */
    public function getQuotation()
    {

        //$id = $this->reqInfo->urlParam("q");
        ///$eid = explode("#", $id);

        $_GET['q'] = substr($_GET['q'], 0, -1);

        $q_id = str_replace(',', "','", $_GET['q']);

        $db  = MedooFactory::getInstance();
        $sql = "SELECT pj.name as propjectname, pt.name_th as prop_type, pj.id as proj_id, prop.* FROM property prop, project pj, property_type pt WHERE prop.project_id = pj.id AND prop.property_type_id = pt.id AND prop.id IN ('" . $q_id . "') ";
        $r   = $db->query($sql);
        $row = $r->fetchAll(\PDO::FETCH_ASSOC);

        $proj = array();
        if ( ! empty($row))
        {
            foreach ($row as $i => $r)
            {
                $proj[$r['proj_id']]['list'][] = $r;
            }
        }

        return $proj;
    }

    /**
     * @GET
     * @uri /imageprops/[i:id]
     */
    public function imageprops()
    {

        $id = $this->reqInfo->urlParam('id');

        $db = MedooFactory::getInstance();

        $item = array();
        //$item = $db->get("property_image", "*", ["property_id"=> $id]);

        $sql  = "SELECT name, id FROM property_image WHERE property_id = '{$id}' LIMIT 1";
        $r    = $db->query($sql);
        $item = $r->fetch(\PDO::FETCH_ASSOC);

        if (isset($item['name']) && ! empty($item['name']))
        {
            $item['image_url'] = URL::absolute('/public/prop_pic/' . $item['name']);
        }
        else
        {
            $item['image_url'] = '';
        }

        return $item;
    }

    /**
     * @GET
     */
    public function index()
    {
        $field = array(
            'property.*',
            'owners.owner(owner)',
            'owners.owner(VIP)',
            // "property_type.name(property_type_name)",
            // "property_type.code(property_type_code)",
            // "zone_group.name(zone_group_name)",
            'requirement.name(requirement_name)',
            'property_status.name(property_status_name)',
            // "developer.name(developer_name)",
            'size_unit.name(size_unit_name)',
            'project.name(project_name)',
            'zone.name(zone_name)'
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
            '[>]owners'          => array('owner_id' => 'id')
        );

        $sql_field = array(
            'property.*',
            'owners.owner as owner',
            'owners.owner as VIP',
            'requirement.name as requirement_name',
            'property_status.name as property_status_name',
            'size_unit.name as size_unit_name',
            'project.name as project_name',
            'zone.name as zone_name'
        );

        $sql_join = array(
            'LEFT JOIN requirement ON property.requirement_id = requirement.id',
            'LEFT JOIN property_status ON property.property_status_id = property_status.id',
            'LEFT JOIN size_unit ON property.size_unit_id = size_unit.id',
            'LEFT JOIN project ON property.project_id = project.id',
            'LEFT JOIN zone ON property.zone_id = zone.id',
            'LEFT JOIN owners ON property.owner_id = owners.id'
        );

        $sql_where  = array();
        $sql_params = array();

        $limit = empty($_GET['limit']) ? 15 : $_GET['limit'];
        $where = array('AND' => array());

        $params = $this->reqInfo->params();

        if ( ! empty($params['property_type_id']))
        {
            $where['AND']['property.property_type_id'] = $params['property_type_id'];

            $sql_where[] = "property.property_type_id = '{$params['property_type_id']}'";
        }

        if ( ! empty($params['picture']))
        {
            if ('y' == $params['picture'])
            {
                $sql_join[] = ' INNER JOIN (select * from property_image group by property_id) pm ON pm.property_id = property.id ';
            }
            elseif ('n' == $params['picture'])
            {
                $sql_where[] = ' property.id NOT IN (select property_id from property_image group by property_id)';
            }
        }

        /*
        if(!empty($params['floors']))
        {
        $where["AND"]['property.floors'] = $params['floors'];

        $sql_where[] = "property.floors = '{$params['floors']}'";
        }*/

        if ( ! empty($params['floors_start']))
        {
            $where['AND']['property.floors[>=]'] = $params['floors_start'];

            $sql_where[] = "property.floors >= '{$params['floors_start']}'";
        }

        if ( ! empty($params['floors_end']))
        {
            $where['AND']['property.floors[<=]'] = $params['floors_end'];

            $sql_where[] = "property.floors <= '{$params['floors_end']}'";
        }

        if ( ! empty($params['direction']))
        {
            $where['AND']['property.direction[~]'] = $params['direction'];

            $sql_where[] = "property.direction like '%{$params['direction']}%'";
        }

        if ( ! empty($params['unit_no']))
        {
            $where['AND']['property.unit_no[~]'] = $params['unit_no'];

            $sql_where[] = "property.unit_no = '{$params['unit_no']}'";
        }

        if ( ! empty($params['bedrooms']) || @$params['bedrooms'] === 0 || @$params['bedrooms'] === '0')
        {
            if ('4+' == $params['bedrooms'])
            {
                $where['AND']['property.bedrooms[>=]'] = $params['bedrooms'];
                $sql_where[]                           = "property.bedrooms >= '{$params['bedrooms']}'";
            }
            else
            {
                $where['AND']['property.bedrooms'] = $params['bedrooms'];
                $sql_where[]                       = "property.bedrooms = '{$params['bedrooms']}'";
            }
        }

        if ( ! empty($params['requirement_id']))
        {
            /*
            if(in_array($params['requirement_id'], [2,4]))
            {
            $where["AND"]['property.requirement_id'] = [$params['requirement_id'], 3];
            }
            else
            {
            $where["AND"]['property.requirement_id'] = $params['requirement_id'];
            }*/

            if (1 == $params['requirement_id'])
            {
                $where['AND']['property.requirement_id'] = array($params['requirement_id'], 3, 4);
                $sql_where[]                             = "property.requirement_id IN ({$params['requirement_id']}, 3, 4)";
            }
            elseif (2 == $params['requirement_id'])
            {
                $where['AND']['property.requirement_id'] = array($params['requirement_id'], 3);
                $sql_where[]                             = "property.requirement_id IN ({$params['requirement_id']}, 3)";
            }
            else
            {
                $where['AND']['property.requirement_id'] = $params['requirement_id'];
                $sql_where[]                             = "property.requirement_id IN ({$params['requirement_id']})";
            }
        }

        if (isset($params['project_id']) && '' != $params['project_id'])
        {
            $where['AND']['property.project_id'] = $params['project_id'];
            $sql_where[]                         = "property.project_id = '{$params['project_id']}'";
        }

        if ( ! empty($params['rented_expire']))
        {
            /*
            $where["AND"] = array(
            "OR" => array(
            "web_status" => 1,
            "AND" => array(
            "web_status" => 0,
            "property_status_id" => 1
            )
            )
            );*/

            //$where["AND"]['rented_expire[>]'] = "0000-00-00";

            //$where["AND"]['property_status_id[!]'] = ['1', '4', '5', '9'];
            $where['AND']['property_status_id'] = array('3');
            $sql_where[]                        = 'property.property_status_id = 3';

            $where['AND']['rented_expire[<]'] = date('Y-m-d H:i:s', strtotime('+7 days'));
            $sql_where[]                      = "property.rented_expire < '" . date('Y-m-d H:i:s', strtotime('+7 days')) . "'";

            $where['AND']['requirement_id[!]'] = '1';
            $sql_where[]                       = 'property.requirement_id != 1';
        }

        if ( ! empty($params['property_highlight_id']))
        {
            $where['AND']['property.property_highlight_id'] = $params['property_highlight_id'];
            $sql_where[]                                    = "property.property_highlight_id = '{$params['property_highlight_id']}'";
        }

        if ( ! empty($params['feature_unit_id']))
        {
            $where['AND']['property.feature_unit_id'] = $params['feature_unit_id'];
            $sql_where[]                              = "property.feature_unit_id = '{$params['feature_unit_id']}'";
        }

        if ( ! empty($params['bts_id']))
        {
            $where['AND']['property.bts_id'] = $params['bts_id'];
            $sql_where[]                     = "property.bts_id = '{$params['bts_id']}'";
        }

        if ( ! empty($params['mrt_id']))
        {
            $where['AND']['property.mrt_id'] = $params['mrt_id'];
            $sql_where[]                     = "property.mrt_id = '{$params['mrt_id']}'";
        }

        if ( ! empty($params['airport_link_id']))
        {
            $where['AND']['property.airport_link_id'] = $params['airport_link_id'];
            $sql_where[]                              = "property.airport_link_id = '{$params['airport_link_id']}'";
        }

        // new
        if ( ! empty($params['web_status']) && empty($params['rented_expire']))
        {
            $where['AND']['property.web_status'] = $params['web_status'];
            $sql_where[]                         = "property.web_status = '{$params['web_status']}'";
        }

        if ( ! empty($params['reference_id']))
        {
            $where['AND']['property.reference_id'] = $params['reference_id'];
            $sql_where[]                           = "property.reference_id = '{$params['reference_id']}'";
        }

        if ( ! empty($params['owner']))
        {
            $where['AND']['owners.owner[~]'] = $params['owner'];
            $sql_where[]                     = "owners.owner like '%{$params['owner']}%'";
        }

        if (( ! empty($params['size_start']) || ! empty($params['size_end'])) && ! empty($params['size_unit_id']))
        {
            $where['AND']['property.size_unit_id'] = $params['size_unit_id'];
            $sql_where[]                           = "property.size_unit_id = '{$params['size_unit_id']}'";

            if ( ! empty($params['size_start']))
            {
                $where['AND']['property.size[>=]'] = $params['size_start'];
                $sql_where[]                       = "property.size >= '{$params['size_start']}'";
            }

            if ( ! empty($params['size_end']))
            {
                $where['AND']['property.size[<=]'] = $params['size_end'];
                $sql_where[]                       = "property.size <= '{$params['size_end']}'";
            }
        }

        // sell price
        if ( ! empty($params['sell_price_start']))
        {
            $where['AND']['property.sell_price[>=]'] = $params['sell_price_start'];
            $sql_where[]                             = "property.sell_price >= '{$params['sell_price_start']}'";
        }

        if ( ! empty($params['sell_price_end']))
        {
            $where['AND']['property.sell_price[<=]'] = $params['sell_price_end'];
            $sql_where[]                             = "property.sell_price <= '{$params['sell_price_end']}'";
        }

        // rent price
        if ( ! empty($params['rent_price_start']))
        {
            $where['AND']['property.rent_price[>=]'] = $params['rent_price_start'];
            $sql_where[]                             = "property.rent_price >= '{$params['rent_price_start']}'";
        }

        if ( ! empty($params['rent_price_end']))
        {
            $where['AND']['property.rent_price[<=]'] = $params['rent_price_end'];
            $sql_where[]                             = "property.rent_price <= '{$params['rent_price_end']}'";
        }

        // vat
        if ( ! empty($params['inc_vat']))
        {
            $where['AND']['property.inc_vat'] = $params['inc_vat'];
            $sql_where[]                      = "property.inc_vat = '{$params['inc_vat']}'";
        }

        // address_no
        if ( ! empty($params['address_no']))
        {
            $where['AND']['property.address_no[~]'] = $params['address_no'];
            $sql_where[]                            = "property.address_no like '%{$params['address_no']}%'";
        }

        // status
        if ( ! empty($params['property_status_id']))
        {
            $where['AND']['property.property_status_id'] = $params['property_status_id'];
            $sql_where[]                                 = "property.property_status_id = '{$params['property_status_id']}'";

            // 99 is empty
            if (99 == $params['property_status_id'])
            {
                $where['AND']['property.property_status_id'] = null;
                $sql_where[]                                 = 'property.property_status_id = null';
            }
        }

        if ( ! empty($params['province_id']))
        {
            $where['AND']['property.province_id'] = $params['province_id'];
            $sql_where[]                          = "property.province_id = '{$params['province_id']}'";
        }

        if ( ! empty($params['district_id']))
        {
            $where['AND']['property.district_id'] = $params['district_id'];
            $sql_where[]                          = "property.district_id = '{$params['district_id']}'";
        }

        if ( ! empty($params['room_type_id']))
        {
            $where['AND']['property.room_type_id'] = $params['room_type_id'];
            $sql_where[]                           = "property.room_type_id = '{$params['room_type_id']}'";
        }

        if ( ! empty($params['sub_district_id']))
        {
            $where['AND']['property.sub_district_id'] = $params['sub_district_id'];
            $sql_where[]                              = "property.sub_district_id = '{$params['sub_district_id']}'";
        }

        // zone
        if ( ! empty($params['zone_id']))
        {
            $where['AND']['property.zone_id'] = $params['zone_id'];
            $sql_where[]                      = "property.zone_id = '{$params['zone_id']}'";
        }

        // web url searh
        if ( ! empty($params['web_url_search']))
        {
            $where['AND']['property.web_url_search[~]'] = $params['web_url_search'];
            $sql_where[]                                = "property.web_url_search like '%{$params['web_url_search']}%'";
        }

        $page      = ! empty($params['page']) ? $params['page'] : 1;
        $orderType = ! empty($params['orderType']) ? $params['orderType'] : 'DESC';
        $orderBy   = ! empty($params['orderBy']) ? $params['orderBy'] : 'updated_at';
        $order     = "{$orderBy} {$orderType}";

        $db = MedooFactory::getInstance();
        //print_r($sql_params);
        $skip = ($page - 1) * $limit;
        $sql  = ' SELECT ' . implode(',', $sql_field) . ' FROM ' . $this->table . ' ' . implode(' ', $sql_join) . (count($sql_where) ? ' WHERE ' . implode(' AND ', $sql_where) : '') . ' ORDER BY ' . $order . ' LIMIT ' . $skip . ', ' . $limit;

        $sql_count = ' SELECT count(*) as cnt FROM ' . $this->table . ' ' . implode(' ', $sql_join) . (count($sql_where) ? ' WHERE ' . implode(' AND ', $sql_where) : '');
        //echo $sql;
        $query = $db->query($sql);
        $rows  = $query ? $query->fetchAll() : array();

        //print_r($db->log());
        //print_r($rows);
        $url   = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $total = $db->query($sql_count)->fetch();
        $total = $total['cnt'];

        $res = array(
            'length' => count($rows),
            'total'  => $total,
            'data'   => $rows,
            'paging' => array(
                'page'  => (int) $page,
                'limit' => (int) $limit
            )
        );

        if ($total > $skip + (int) $limit)
        {
            $res['paging']['next'] = ListDAO::_buildUrl($url, array('page' => (int) $page + 1, 'limit' => (int) $limit));
        }

        if ((int) $page > 1)
        {
            $res['paging']['prev'] = ListDAO::_buildUrl($url, array('page' => (int) $page - 1, 'limit' => (int) $limit));
        }

        /*
        if(count($where["AND"]) > 0)
        {
        $where['ORDER'] = $order;
        $list = ListDAO::gets($this->table, [
        "field"=> $field,
        "join"=> $join,
        "where"=> $where,
        "page"=> $page,
        "limit"=> $limit
        ]);
        }
        else
        {
        $list = ListDAO::gets($this->table, [
        "field"=> $field,
        "join"=> $join,
        "page"=> $page,
        'where'=> ["ORDER"=> $order],
        "limit"=> $limit
        ]);
        }
         */

        $this->_builds($res['data']);

        return $res;
    }

    /**
     * @POST
     * @uri /[i:id]/match
     */
    public function matchEnquiry()
    {
        $id      = $this->reqInfo->urlParam('id');
        $db      = MedooFactory::getInstance();
        $matchId = $this->reqInfo->param('match_enquiry_id');
        if (empty($matchId))
        {
            return ResponseHelper::error('require match_enquiry_id');
        }
        $db->update($this->table, array('match_enquiry_id' => $matchId), array('id' => $id));
        return array('success' => true);
    }

    /**
     * @POST
     * @uri /[i:id]/match/cancle
     */
    public function matchEnquiryCancle()
    {
        $id = $this->reqInfo->urlParam('id');
        $db = MedooFactory::getInstance();
        $db->update($this->table, array('match_enquiry_id' => null), array('id' => $id));
        return array('success' => true);
    }

    /**
     * @POST
     * @uri /[i:id]/gallery
     */
    public function postGallery()
    {
        $id = $this->reqInfo->urlParam('id');

        $validator         = new \FileUpload\Validator\Simple(1024 * 1024 * 4, array('image/png', 'image/jpg', 'image/jpeg'));
        $pathresolver      = new \FileUpload\PathResolver\Simple('public/prop_pic');
        $filesystem        = new \FileUpload\FileSystem\Simple();
        $filenamegenerator = new \FileUpload\FileNameGenerator\Random();

        $fileupload = new \FileUpload\FileUpload($_FILES['images'], $_SERVER);
        $fileupload->setPathResolver($pathresolver);
        $fileupload->setFileSystem($filesystem);
        $fileupload->addValidator($validator);

        $fileupload->setFileNameGenerator($filenamegenerator);

        list($files, $headers) = $fileupload->processAll();

        $db = MedooFactory::getInstance();
        // $ffff = [];
        foreach ($files as $file)
        {
            if (0 == $file->error)
            {
                $db->insert('property_image', array('property_id' => $id, 'name' => $file->name));
                // $ffff[] = $file;
                ImageHelper::makeResizeWatermark($file->path);
            }
        }

        $accId = $_SESSION['login']['id'];
        $db->insert('property_comment',
            array(
                'property_id' => $id,
                'comment'     => ' POST IMAGES ALERT',
                'comment_by'  => $accId,
                'updated_at'  => date('Y-m-d H:i:s')
            ));

        return array('success' => true);
    }
}
