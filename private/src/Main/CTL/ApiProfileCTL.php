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

        $params = $this->reqInfo->params();

		/**
		 *  # LIST OF ACCESS LEVEL #
		 *  # 1 : System Admin
		 *  # 2 : Admin
		 *  # 3 : Manager
		 *  # 4 : Sale
		 *  # 5 : Marketing
		 *  # 6 : HR
		 *  # 7 : Admin Manager
		 *  # 8 : Sale Manager
		 *  # 9 : Marketing Manager
		 
		switch( (int) $_SESSION['login']['level']['id'] )
		{
			case 2 :
					$see_self = " and ml.account_id = '".$_SESSION['login']['id']."' ";
				break;
			case 7 :
					$see_self = " and ml.level_id IN (2, 7) ";
				break;
			case 4 :
					$see_self = " and ml.account_id = '".$_SESSION['login']['id']."' ";
				break;
			case 8 :
					$see_self = " and ml.level_id IN (4, 8) ";
				break;
			case 5 :
					$see_self = " and ml.account_id = '".$_SESSION['login']['id']."' ";
				break;
			case 9 :
					$see_self = " and ml.level_id IN (5, 9) ";
				break;
			default : 
					$see_self = '';
		}*/
		
		$see_self = " and ml.account_id = '".$_SESSION['login']['id']."' ";

		/**
		 * NON APPROVE
		 */
		$nleave = array();
		$sql = "select count(ml.id) as total, DAY(ml.created_at) as dDay from mng_leave ml where MONTH(ml.created_at) = '$month' and YEAR(ml.created_at) = '$year' and late_flag = 'y' AND status = 1 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
	
		foreach( $rows as $row )
		{
			$nleave[$row['dDay']] = $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqshift_date) as dDay from mng_leave ml where MONTH(ml.rqshift_date) = '$month' and YEAR(ml.rqshift_date) = '$year' and rqshift_flag = 'y' AND status = 1 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$nleave[$row['dDay']] = isset($nleave[$row['dDay']]) ? $nleave[$row['dDay']] + $row['total'] : $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqperiod_from_date) as dDay from mng_leave ml where MONTH(ml.rqperiod_from_date) = '$month' and YEAR(ml.rqperiod_from_date) = '$year' and rqperiod_flag = 'y' AND status = 1 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$nleave[$row['dDay']] = isset($nleave[$row['dDay']]) ? $nleave[$row['dDay']] + $row['total'] : $row['total'];
		}
	
		
		/**
		 * IN APPROVE
		 */
		$leave = array();
		$sql = "select count(ml.id) as total, DAY(ml.created_at) as dDay from mng_leave ml where MONTH(ml.created_at) = '$month' and YEAR(ml.created_at) = '$year' and late_flag = 'y' AND status = 2 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);

		foreach( $rows as $row )
		{
			$leave[$row['dDay']] = $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqshift_date) as dDay from mng_leave ml where MONTH(ml.rqshift_date) = '$month' and YEAR(ml.rqshift_date) = '$year' and rqshift_flag = 'y' AND status = 2 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$leave[$row['dDay']] = isset($leave[$row['dDay']]) ? $leave[$row['dDay']] + $row['total'] : $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqperiod_from_date) as dDay from mng_leave ml where MONTH(ml.rqperiod_from_date) = '$month' and YEAR(ml.rqperiod_from_date) = '$year' and rqperiod_flag = 'y' AND status = 2 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$leave[$row['dDay']] = isset($leave[$row['dDay']]) ? $leave[$row['dDay']] + $row['total'] : $row['total'];
		}


		/**
		 * COMPLETE BY HR
		 */
		$complete = array();
		$sql = "select count(ml.id) as total, DAY(ml.created_at) as dDay from mng_leave ml where MONTH(ml.created_at) = '$month' and YEAR(ml.created_at) = '$year' and late_flag = 'y' AND status = 3 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);

		foreach( $rows as $row )
		{
			$complete[$row['dDay']] = $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqshift_date) as dDay from mng_leave ml where MONTH(ml.rqshift_date) = '$month' and YEAR(ml.rqshift_date) = '$year' and rqshift_flag = 'y' AND status = 3 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$complete[$row['dDay']] = isset($complete[$row['dDay']]) ? $complete[$row['dDay']] + $row['total'] : $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqperiod_from_date) as dDay from mng_leave ml where MONTH(ml.rqperiod_from_date) = '$month' and YEAR(ml.rqperiod_from_date) = '$year' and rqperiod_flag = 'y' AND status = 3 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$complete[$row['dDay']] = isset($complete[$row['dDay']]) ? $complete[$row['dDay']] + $row['total'] : $row['total'];
		}


		/**
		 * REJECT
		 */
		$reject = array();
		$sql = "select count(ml.id) as total, DAY(ml.created_at) as dDay from mng_leave ml where MONTH(ml.created_at) = '$month' and YEAR(ml.created_at) = '$year' and late_flag = 'y' AND status = 4 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);

		foreach( $rows as $row )
		{
			$reject[$row['dDay']] = $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqshift_date) as dDay from mng_leave ml where MONTH(ml.rqshift_date) = '$month' and YEAR(ml.rqshift_date) = '$year' and rqshift_flag = 'y' AND status = 4 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$reject[$row['dDay']] = isset($reject[$row['dDay']]) ? $reject[$row['dDay']] + $row['total'] : $row['total'];
		}

		$sql = "select count(ml.id) as total, DAY(ml.rqperiod_from_date) as dDay from mng_leave ml where MONTH(ml.rqperiod_from_date) = '$month' and YEAR(ml.rqperiod_from_date) = '$year' and rqperiod_flag = 'y' AND status = 4 ";
		$sql .=  $see_self . " group by dDay ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		foreach( $rows as $row )
		{
			$reject[$row['dDay']] = isset($reject[$row['dDay']]) ? $reject[$row['dDay']] + $row['total'] : $row['total'];
		}

        echo '<div class="col-md-6"><h2>'.$months[$month-1].'</h2></div><div>' . $this->draw_calendar($month, $year, $nleave, $leave, $complete, $reject) . '</div>';
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
