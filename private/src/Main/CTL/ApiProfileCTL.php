<?php

namespace Main\CTL;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;
use Main\Helper\ImageHelper;

/**
 * @Restful
 * @uri /api/profile
 */

class ApiProfileCTL extends BaseCTL {

    /**
     * @GET
     */
    public function profiles()
	{
        $db = MedooFactory::getInstance();

		$field = [
            "pfs.*",
        ];

        $join = [

        ];

        $limit = empty($_GET['limit'])? 15: $_GET['limit'];
        $where = ["AND"=> []];

        $params = $this->reqInfo->params();
       
        $page = !empty($params['page'])? $params['page']: 1;
        $orderType = !empty($params['orderType'])? $params['orderType']: "DESC";
        $orderBy = !empty($params['orderBy'])? $params['orderBy']: "updated_at";
        $order = "{$orderBy} {$orderType}";

        if(count($where["AND"]) > 0)
		{
            $where['ORDER'] = $order;
            $list = ListDAO::gets('pfs', [
                "field"=> $field,
                //"join"=> $join,
                //"where"=> $where,
                "page"=> $page,
                "limit"=> $limit
            ]);
        }
        else 
		{
            $list = ListDAO::gets('pfs', [
                "field"=> $field,
                //"join"=> $join,
                "page"=> $page,
                'where'=> ["ORDER"=> $order],
                "limit"=> $limit
            ]);
        }

        return $list;
    }
	

	/**
     * @GET
	 * @uri /edit/[:id]
     */
    public function index()
	{
        $db = MedooFactory::getInstance();
		$id = $this->reqInfo->urlParam("id");
		
		$r = $db->query("SELECT * FROM pfs WHERE account_id = '".$id."' ");
		$row = $r->fetch(\PDO::FETCH_ASSOC);
		
		return $row;
    }
	

	/**
     * @POST
     */
    public function add() 
	{
        $db = MedooFactory::getInstance();
        $params = $this->reqInfo->params();
		
		$sql = "SELECT COLUMN_NAME AS cols FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='mng_leave'";
		$r = $db->query($sql);
        $rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		$columns = array();
		foreach( $rows as $row )
		{
			$columns[] = $row['cols'];
		}

        $insert = ArrayHelper::filterKey($columns, $params);

		$insert = array_map(function($item) {
			if(is_string($item)) 
			{
				$item = trim($item);
			}
			return $item;
		}, $insert);

        //$now = date('Y-m-d H:i:s');
        //$insert['created_at'] = $now;
        //$insert['updated_at'] = $now;
		
		$accId = $_SESSION['login']['id'];
		$insert['updated_by'] = $accId;
		
		if( $_SESSION['login']['level']['id'] == '2' || $_SESSION['login']['level']['id'] == '4' || $_SESSION['login']['level']['id'] == '5' )
		{
			$insert['status'] = 1;
		}

		if( $_SESSION['login']['level']['id'] == '3' || $_SESSION['login']['level']['id'] == '7' || $_SESSION['login']['level']['id'] == '8' || $_SESSION['login']['level']['id'] == '9' )
		{
			$insert['status'] = 2;
			$insert['supervisor_approve_id'] = $accId;
		}

		if( $_SESSION['login']['level']['id'] == '6' ) // HR
		{
			$insert['status'] = 3;
			$insert['hr_id'] = $accId;
			$insert['supervisor_approve_id'] = $accId;
		}

        $db->pdo->beginTransaction();
        $id = $db->insert('mng_leave', $insert);

        if( ! $id ) 
		{
            return ResponseHelper::error("Error can't add form.");
        }

        $db->pdo->commit();

        return $id;
    }


	/**
     * @POST
     * @uri /edit/[:id]
     */
    public function edit () 
	{
		$db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();
      
        $sql = "SELECT COLUMN_NAME AS cols FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='pfs'";
		$r = $db->query($sql);
        $rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		$columns = array();
		foreach( $rows as $row )
		{
			$columns[] = $row['cols'];
		}

        $set = ArrayHelper::filterKey($columns, $params);

		$set = array_map(function($item) {
			if(is_string($item)) 
			{
				$item = trim($item);
			}
			return $item;
		}, $set);
		
		$accId = $_SESSION['login']['id'];
		$set['updated_by'] = $accId;
        $set['updated_at'] = date('Y-m-d H:i:s');

        $where = ["account_id" => $id];

		if( $db->count("pfs", "*", ["account_id"=> $id]) )
		{
			unset($set['account_id']);
	        $updated = $db->update('pfs', $set, $where);
		}
		else
		{
			$set['created_by'] = $accId;
			$inserted = $db->insert('pfs', $set);
		}

		
		/*
        if( ! $updated )
        {
            return ResponseHelper::error("Error can't update property.");
        }
		*/

        return ["success"=> true];
    }


    /**
     * @DELETE
     * @uri /[i:id]
     */
    public function delete() 
	{
        $id = $this->reqInfo->urlParam("id");

        $db = MedooFactory::getInstance();
        $id = $db->delete('pfs', ["id"=> $id]);

        if( ! $id )
		{
            return ResponseHelper::error("Error can't remove property.");
        }

        return ["success"=> true];
    }


}
