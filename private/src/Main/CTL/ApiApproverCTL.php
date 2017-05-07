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
 * @uri /api/approver
 */

class ApiApproverCTL extends BaseCTL {

    /**
     * @GET
     */
    public function calendar()
	{
        $db = MedooFactory::getInstance();

        $params = $this->reqInfo->params();

		$months = array(
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July ',
			'August',
			'September',
			'October',
			'November',
			'December',
		);

		$month = date('m');
		$year = date('Y');

		if( isset($params['month']) )
		{
			$month = $params['month'];
		}

		if( isset($params['year']) )
		{
			$year = $params['year'];
		}
		
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
		 */
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
		}

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

        echo '<div class="col-md-6"><h2>'.$months[$month-1].'</h2></div><div>' . $this->draw_calendar($month, $year, $nleave, $leave, $complete) . '</div>';
    }
	

	/**
     * @GET
	 * @uri /edit/[:id]
     */
    public function index()
	{
        $db = MedooFactory::getInstance();
		$id = $this->reqInfo->urlParam("id");
		
		$r = $db->query("SELECT * FROM mng_leave WHERE id = '".$id."' ");
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
     * @GET
     * @uri /mngapprove/[:id]
     */
    public function mngapprove () 
	{ 
		$db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();
      		
		$accId = $_SESSION['login']['id'];
		$set['updated_by'] = $accId;
        $set['updated_at'] = date('Y-m-d H:i:s');
		
		$set['supervisor_approve_id'] = $accId;
		$set['status'] = 2;

        $where = ["id"=> $id];

        $updated = $db->update('mng_leave', $set, $where);

        if(!$updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }
		
		header("Location: /admin/approver#/");exit;

        return ["success"=> true];
    }


	/**
     * @GET
     * @uri /mngreject/[:id]
     */
    public function mngreject () 
	{ 
		$db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();
      		
		$accId = $_SESSION['login']['id'];
		$set['updated_by'] = $accId;
        $set['updated_at'] = date('Y-m-d H:i:s');
		
		$set['supervisor_approve_id'] = $accId;
		$set['status'] = 4;

        $where = ["id"=> $id];

        $updated = $db->update('mng_leave', $set, $where);

        if(!$updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }
		
		header("Location: /admin/approver#/");exit;

        return ["success"=> true];
    }


	/**
     * @GET
     * @uri /hrapprove/[:id]
     */
    public function hrapprove () 
	{ 
		$db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();
      		
		$accId = $_SESSION['login']['id'];
		$set['updated_by'] = $accId;
        $set['updated_at'] = date('Y-m-d H:i:s');
		
		//$set['supervisor_approve_id'] = $accId;
		$set['status'] = 3;

        $where = ["id"=> $id];

        $updated = $db->update('mng_leave', $set, $where);

        if(!$updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }
		
		header("Location: /admin/approver#/");exit;

        return ["success"=> true];
    }


	/**
     * @GET
     * @uri /hrreject/[:id]
     */
    public function hrreject () 
	{ 
		$db = MedooFactory::getInstance();
        $id = $this->reqInfo->urlParam("id");
        $params = $this->reqInfo->params();
      		
		$accId = $_SESSION['login']['id'];
		$set['updated_by'] = $accId;
        $set['updated_at'] = date('Y-m-d H:i:s');
		
		$set['supervisor_approve_id'] = $accId;
		$set['status'] = 4;

        $where = ["id"=> $id];

        $updated = $db->update('mng_leave', $set, $where);

        if(!$updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }
		
		header("Location: /admin/approver#/");exit;

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
        $id = $db->delete('mng_leave', ["id"=> $id]);

        if( ! $id )
		{
            return ResponseHelper::error("Error can't remove property.");
        }

        return ["success"=> true];
    }

	/**
     * @GET
     * @uri /whos
     */
	public function whos()
	{
		$db = MedooFactory::getInstance();
        $params = $this->reqInfo->params();
		
		$year = $params['y'];
		$month =  str_pad($params['m'], 2, "0", STR_PAD_LEFT); 
		$day = str_pad($params['d'], 2, "0", STR_PAD_LEFT); 

		$date = $year . '-' . $month . '-' . $day;
		
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
		 */
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
			case 6 :
					$see_self = " and ml.status != 1 ";
				break;
			default : 
					$see_self = '';
		}

		$sql = "SELECT ac.name AS account_name, lv.name AS level_name, ml.* FROM mng_leave ml, account ac, level lv WHERE ml.account_id = ac.id AND ml.level_id = lv.id AND DATE_FORMAT(ml.created_at,'%Y-%m-%d') ='".$date."' AND late_flag='y' " . $see_self;

		$sql .= "UNION SELECT ac.name AS account_name, lv.name AS level_name, ml.* FROM mng_leave ml, account ac, level lv WHERE ml.account_id = ac.id AND ml.level_id = lv.id AND DATE_FORMAT(ml.rqshift_date,'%Y-%m-%d') ='".$date."' AND rqshift_flag='y' " . $see_self;

		$sql .= "UNION SELECT ac.name AS account_name, lv.name AS level_name, ml.* FROM mng_leave ml, account ac, level lv WHERE ml.account_id = ac.id AND ml.level_id = lv.id AND DATE_FORMAT(ml.rqperiod_from_date,'%Y-%m-%d') ='".$date."' AND rqperiod_flag='y' " . $see_self;

		//$sql .= " order by ml.created_at desc ";

		$r = $db->query($sql);
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);

		echo '<md-dialog aria-label="'.$date.'">
		  <form>
			<md-toolbar>
			  <div class="md-toolbar-tools">
				<h2>ลาในวันที่  '.date('d M Y', strtotime($date)).'</h2>
				<span flex></span>
				<md-button class="md-icon-button" ng-click="cancel()">
				  <md-icon aria-label="Close dialog"><i class="fa fa-times" aria-hidden="true"></i></md-icon>
				</md-button>
			  </div>
			</md-toolbar>
			<md-dialog-content style="max-width:800px;max-height:810px; ">
			  <md-tabs md-dynamic-height md-border-bottom>';

			foreach( $rows as $row )
			{
				echo '<md-tab label="'.$row['account_name'].'">
				  <md-content class="md-padding">';
				
					if( strtotime($row['created_at']) > strtotime("-1 days") )
					{
						if( $_SESSION['login']['level']['id'] == 6 && $row['status'] == 2 )
						{
							echo '
								<a href="/api/approver/hrapprove/'.$row['id'].'">
									<md-button class="btn-success md-raised pull-right">
										APPROVE
									</md-button>
								</a>
								<a href="/api/approver/hrreject/'.$row['id'].'">
									<md-button class="btn-danger md-raised pull-right">
										REJECT
									</md-button>
								</a>';
						}

						if( $_SESSION['login']['level']['id'] != 6 && $row['status'] == 1 )
						{
							echo '
								<a href="/api/approver/mngapprove/'.$row['id'].'">
									<md-button class="btn-success md-raised pull-right">
										APPROVE
									</md-button>
								</a>
								<a href="/api/approver/mngreject/'.$row['id'].'">
									<md-button class="btn-danger md-raised pull-right">
										REJECT
									</md-button>
								</a>';
						}
					}

				if( $row['supervisor_approve_id'] == '' )
				{	
					echo '<div class="row text-danger" style="padding:10px;">manager ยังไม่ได้ approve</div>';
				}

				if( $row['status'] == 2 )
				{	
					echo '<div class="row text-info" style="padding:10px;">รอ  hr approve</div>';
				}

				if( $row['status'] == 3 )
				{	
					echo '<div class="row text-success" style="padding:10px;">hr approve แล้ว</div>';
				}

				if( $row['status'] == 4 )
				{	
					echo '<div class="row text-danger" style="padding:10px;">ไม่ได้รับการ approve</div>';
				}
				
				$is_late = $row['late_flag'] == 'y' ? '(สาย)' : '';
				echo '
					<div class="row" style="min-width: 800px">
						<div class="col-md-3">
							<b>ชื่อ - สกุล : </b>'.$row['account_name'].'
							'  . $is_late . '
						</div>
						<div class="col-md-3">
							<b>ตำแหน่ง: </b>'.$row['level_name'].'
						</div>
						<div class="col-md-3">
							<b>ฝ่าย: </b>'.$row['department'].'
						</div>
						<div class="clearfix"></div>
						<br>';

				if( $row['rqshift_flag'] == 'y' )
				{
					echo '<div class="col-md-3">
								<b>ขอลาในเวลาทำงาน</b>
							</div>
							<div class="col-md-2">
								<b>วันที่</b> '.$row['rqshift_date'].'
							</div>
							<div class="col-md-2">
								<b>ตั้งแต่เวลา</b> '.$row['rqshift_from_tm'].'
							</div>
							<div class="col-md-2">
								<b>ถึงเวลา</b> '.$row['rqshift_to_tm'].'
							</div>
							<div class="col-md-2">
								<b>รวมเป็นเวลา</b> '.$row['rqshift_leave_total_tm'].'
							</div>
							<div class="clearfix"></div>
							<br>';
				}
				
				if( $row['rqperiod_flag'] == 'y' )
				{
					echo '<div class="col-md-3">
							<b>ขอลาหยุดตั้งแต่</b>
						</div>
						<div class="col-md-3">
							<b>วันที่</b> '.$row['rqperiod_from_date'].'
						</div>
						<div class="col-md-3">
							<b>ถึงวันที่</b> '.$row['rqperiod_to_date'].'
						</div>
						<div class="col-md-3">
							<b>รวมเป็นเวลา</b> '.$row['rqperiod_total_day'].' วัน
						</div>
						<div class="clearfix"></div>
						<br>';
				}
		
				echo '<br>
					<div class="col-md-3">
						<b>ประเภทของการลาหยุด</b>
					</div>
					<div class="clearfix"></div>
					<br>';
				
				if( $row['lv_vacation_flag'] == 'y' )
				{
					echo '<div class="col-md-3">
							<b>พักร้อน</b>
						</div>
						<div class="col-md-3">
							<b>เหตุผล</b> '.$row['lv_vacation_reason'].'
						</div>
						<div class="col-md-3">
							<b>หมายเหตุ</b> '.$row['lv_vacation_ps'].'
						</div>
						<div class="clearfix"></div>
						<br>';
				}

				if( $row['lv_personal_flag'] == 'y' )
				{
					echo '<div class="col-md-3">
							<b>ลากิจ</b>
						</div>
						<div class="col-md-3">
							<b>เหตุผล</b> '.$row['lv_personal_reason'].'
						</div>
						<div class="col-md-3">
							<b>หมายเหตุ</b> '.$row['lv_personal_ps'].'
						</div>
						<div class="clearfix"></div>
						<br>';
				}

				if( $row['lv_sick_flag'] == 'y' )
				{
					echo '<div class="col-md-3">
							<b>ลาป่วย</b>
						</div>
						<div class="col-md-3">
							<b>เหตุผล</b> '.$row['lv_sick_reason'].'
						</div>
						<div class="col-md-3">
							<b>หมายเหตุ</b> '.$row['lv_sick_ps'].'
						</div>
						<div class="clearfix"></div>
						<br>';
				}

				if( $row['lv_etc_flag'] == 'y' )
				{
					echo '<div class="col-md-3">
							<b>อื่นๆ : </b> '.$row['lv_etc_desc'].'
						</div>
						<div class="col-md-3">
							<b>เหตุผล</b> '.$row['lv_etc_reason'].'
						</div>
						<div class="col-md-3">
							<b>หมายเหตุ</b> '.$row['lv_etc_ps'].'
						</div>
						<div class="clearfix"></div>
						<br>';
				}

				echo '</div>
				  </md-content>
				</md-tab>';
			}
			echo '
			  </md-tabs>
			</md-dialog-content>

			<md-dialog-actions layout="row">
			  <span flex></span>
			  <md-button ng-click="answer(\'useful\')" style="margin-right:20px;" >
				Close
			  </md-button>
			</md-dialog-actions>
		  </form>
		</md-dialog>';
	}

	private function draw_calendar($month, $year, $nleave, $leave, $complete)
	{
		/* draw table */
		$calendar = '<table class="table calendar">';

		/* table headings */
		$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

		/* days and weeks vars now ... */
		$running_day = date('w',mktime(0,0,0,$month,1,$year));
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array();

		/* row for week one */
		$calendar.= '<tr class="calendar-row">';

		/* print "blank" days until the first of the current week */
		for($x = 0; $x < $running_day; $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
			$days_in_this_week++;
		endfor;

		/* keep going with days.... */
		for($list_day = 1; $list_day <= $days_in_month; $list_day++):
			$calendar.= '<td class="calendar-day">';
				/* add in the day number */
				$calendar.= '<div class="day-number">'.$list_day.'</div>';
				
				/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
				//$calendar.= str_repeat('<p> </p>',2);
		
				/*
				if( $list_day == 10 )
				{
					$calendar .= '<p><md-button class="md-primary md-raised" ng-click="showAdvanced($event)">
										ลา 9 คน
									</md-button></p>';
				}
				*/
				if( isset($nleave[$list_day]) && !empty($nleave[$list_day]) )
				{
					/*$calendar .= '<p><md-button class="md-warn md-raised sm" ng-click="showAdvanced($event, '.$month.', '.$year.', '.$list_day.')">
										รอ approve <br>รวม '.$nleave[$list_day].' คน
									</md-button></p>';*/

					$calendar .= '<p><md-button class="md-warn md-raised sm" ng-click="showAdvanced($event, '.$month.', '.$year.', '.$list_day.')">
										รอ Manager Approve
									</md-button></p>';
				}

				if( isset($leave[$list_day]) && !empty($leave[$list_day]) )
				{
					$calendar .= '<p><md-button class="md-primary md-raised sm" ng-click="showAdvanced($event, '.$month.', '.$year.', '.$list_day.')">
										รอ HR Approve
									</md-button></p>';
				}

				if( isset($complete[$list_day]) && !empty($complete[$list_day]) )
				{
					$calendar .= '<p><md-button class="btn-success md-raised sm" ng-click="showAdvanced($event, '.$month.', '.$year.', '.$list_day.')">
										HR Approve แล้ว
									</md-button></p>';
				}
				
			$calendar.= '</td>';
			if($running_day == 6):
				$calendar.= '</tr>';
				if(($day_counter+1) != $days_in_month):
					$calendar.= '<tr class="calendar-row">';
				endif;
				$running_day = -1;
				$days_in_this_week = 0;
			endif;
			$days_in_this_week++; $running_day++; $day_counter++;
		endfor;

		/* finish the rest of the days in the week */
		if($days_in_this_week < 8):
			for($x = 1; $x <= (8 - $days_in_this_week); $x++):
				$calendar.= '<td class="calendar-day-np"> </td>';
			endfor;
		endif;

		/* final row */
		$calendar.= '</tr>';

		/* end the table */
		$calendar.= '</table>';
		
		/* all done, return result */
		return $calendar;
	}

}
