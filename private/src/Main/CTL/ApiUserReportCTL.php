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

            $sql .= " ORDER BY {$order} LIMIT {$start}, {$limit}";
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

            $page = !empty($params['page'])? $params['page']: 1;
            $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
            $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
            $order = "{$orderBy} {$orderType}";

            $order = str_replace('property.', 'enquiry.', $order);
            
            $start = ( $page == 1 )? 0 : ( ($page-1) * $limit);

            $sql .= " ORDER BY {$order} LIMIT {$start}, {$limit}";
        }
        
        else if( $params['report_type'] == 'phonerequest' )
        {
            $sql = "SELECT SQL_CALC_FOUND_ROWS 'properties' as mode, property.id, request_contact.created_at as updated_at, project.name as project_name, request_contact.id as reference_id, enquiry.customer, '' as comment, enquiry.id as enquiry_id , enquiry.enquiry_no as enquiry_no, account.name as sale, account.phone as sphone FROM request_contact, account, enquiry LEFT JOIN enquiry_comment ON enquiry.id = enquiry_comment.enquiry_id, property, project WHERE enquiry.id = request_contact.enquiry_id AND property.id = request_contact.property_id AND property.project_id = project.id AND request_contact.account_id = account.id ";

            if( !empty($params['account_comment_id']) )
            {
                $sql .= " AND enquiry_comment.comment_by = '{$params['account_comment_id']}' ";
            }

            $limit = empty($_GET['limit'])? 15: $_GET['limit'];

            $page = !empty($params['page'])? $params['page']: 1;
            $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
            $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
            $order = "{$orderBy} {$orderType}";

            $order = str_replace('property.', 'enquiry.', $order);
            
            $start = ( $page == 1 )? 0 : ( ($page-1) * $limit);

            $sql .= " ORDER BY {$order} LIMIT {$start}, {$limit}";
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

}
