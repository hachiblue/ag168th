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
 * @uri /api/leave
 */

class ApiLeaveCTL extends BaseCTL {

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

		$r = $db->query("select count(ml.id) as total, DAY(ml.created_at) as dDay from mng_leave ml where MONTH(ml.created_at) = '$month' and YEAR(ml.created_at) = '$year' group by dDay ");
		$rows = $r->fetchAll(\PDO::FETCH_ASSOC);
		
		$groups = array();
		foreach( $rows as $row )
		{
			$groups[$row['dDay']] = $row['total'];
		}

        echo '<div class="col-md-6"><h2>'.$months[$month-1].'</h2></div><div>' . $this->draw_calendar($month, $year, $groups) . '</div>';
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
      
        $sql = "SELECT COLUMN_NAME AS cols FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='mng_leave'";
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

        $where = ["id"=> $id];

        $updated = $db->update('mng_leave', $set, $where);

        if(!$updated)
        {
            return ResponseHelper::error("Error can't update property.");
        }

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
		
		$r = $db->query("SELECT ac.name AS account_name, lv.name AS level_name, ml.* FROM mng_leave ml, account ac, level lv WHERE ml.account_id = ac.id AND ml.level_id = lv.id AND DATE_FORMAT(ml.created_at,'%Y-%m-%d') ='".$date."' order by ml.created_at desc ");
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
				  <md-content class="md-padding">

					<a href="#edit/'.$row['id'].'">
						<md-button class="btn-success md-raised pull-right">
							EDIT
						</md-button>
					</a>				

					<h1 class="md-display-1">'.$row['account_name'].' <small>'.$row['level_name'].'</small></h1>
					
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla venenatis ante augue. Phasellus volutpat neque ac dui mattis vulputate. Etiam consequat aliquam cursus. In sodales pretium ultrices. Maecenas lectus est, sollicitudin consectetur felis nec, feugiat ultricies mi.</p>
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

	private function draw_calendar($month, $year, $dDay)
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
				if( isset($dDay[$list_day]) && !empty($dDay[$list_day]) )
				{
					$calendar .= '<p><md-button class="md-primary md-raised" ng-click="showAdvanced($event, '.$month.', '.$year.', '.$list_day.')">
										ลา '.$dDay[$list_day].' คน
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
