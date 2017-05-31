<?php
/**
 *  AdminCTL.php
 *  Project : bc
 *
 *  Created by Issarapong Wongyai on 17/3/2558 16:15
 *  Copyright 2015 Issarapong Wongyai. All rights reserved.
 */

namespace Main\CTL;

use Main\Context\Context;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\View\RedirectView;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\Helper\URL;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /admin
 */
class AdminCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () 
	{
		if(empty($_SESSION['login'])) 
		{
			return new RedirectView(URL::absolute('/admin/login'));
		}
		// return new HtmlView('/admin/index');

		return new RedirectView(URL::absolute('/admin/enquiries'));
    }

    /**
     * @GET
     * @uri /login
     */
    public function getLogin () 
	{
		unset($_SESSION['login']);
		return new HtmlView('/admin/login');
    }

    /**
     * @GET
     * @uri /project/[:id]/images
     */
    public function projectImages () 
	{
		if(empty($_SESSION['login'])) 
		{
			return new RedirectView(URL::absolute('/admin/login'));
		}

        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $pqCount = $db->count("request_contact", "*", ["status_id"=> 1]);

        $where = array();
        $where["AND"]['property_status_id'] = ['3'];
        $where["AND"]['rented_expire[<]'] = date("Y-m-d H:i:s", strtotime("+7 days"));
        $where["AND"]['requirement_id[!]'] = "1";

        $exCount = $db->count("property", "*", $where);
        //$exCount = $db->last_query();

		$ex_data = array();
		
		$params = array(
			"view" => 'project_images', 
			"project_id" => $id, 
			"pqCount" => $pqCount, 
			"exCount" => $exCount
		);

		$params['menulist'] = $this->getAccessable($params);

        return new HtmlView('/admin/index', $params);
    }

	/**
     * @GET
     * @uri /member/[:id]/images
     */
    public function memberImages () 
	{
		if(empty($_SESSION['login'])) 
		{
			return new RedirectView(URL::absolute('/admin/login'));
		}

        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $pqCount = $db->count("request_contact", "*", ["status_id"=> 1]);
        return new HtmlView('/admin/index', array("view"=> 'member_images', "member_id"=> $id, "pqCount"=> $pqCount));
    }

	/**
     * @GET
     * @uri /investment/[:id]
     */
    public function investmentData () 
	{
		if(empty($_SESSION['login'])) 
		{
			return new RedirectView(URL::absolute('/admin/login'));
		}

        $id = $this->reqInfo->urlParam("id");
        $db = MedooFactory::getInstance();
        $pqCount = $db->count("request_contact", "*", ["status_id"=> 1]);

		$where = array();

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
        $where["AND"]['property_status_id'] = ['3'];

        $where["AND"]['rented_expire[<]'] = date("Y-m-d H:i:s", strtotime("+7 days"));
        $where["AND"]['requirement_id[!]'] = "1";

        $exCount = $db->count("property", "*", $where);

        $project = $db->get("project", "*", ['id'=>$id]);

        return new HtmlView('/admin/index', array("view" => 'investment_data', "project_id"=> $id, "project_name"=>$project['name'], "pqCount" => $pqCount, "exCount" => $exCount));
    }

    /**
     * @GET
     * @uri /[a:view]
     */
    public function indexView () 
	{
        if(empty($_SESSION['login'])) 
		{
			return new RedirectView(URL::absolute('/admin/login'));
        }

        $view = $this->reqInfo->urlParam("view");
        $db = MedooFactory::getInstance();

        $pqCount = $db->count("request_contact", "*", ["status_id"=> 1]);

        $where = array();

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
        $where["AND"]['property_status_id'] = ['3'];

        $where["AND"]['rented_expire[<]'] = date("Y-m-d H:i:s", strtotime("+7 days"));
        $where["AND"]['requirement_id[!]'] = "1";

        $exCount = $db->count("property", "*", $where);
        //$exCount = $db->last_query();

		$ex_data = array();
		if( $view == 'webmanage' )
		{
			$ex_data['project'] = $db->select("project", "*", ['ORDER'=>'name desc']);
		}
		
		$params = array(
			"view" => $view, 
			"pqCount" => $pqCount, 
			"exCount" => $exCount, 
			"extends" => $ex_data
		);

		$params['menulist'] = $this->getAccessable($params);

        return new HtmlView('/admin/index', $params);
    }

	/**
     * @GET
     * @uri /gen
     */
    public function genView () 
	{
        return new HtmlView('/admin/gen');
    }

    /**
     * @POST
     * @uri /login
     */
    public function postLogin () 
	{
        $db = MedooFactory::getInstance();

        $username = $this->reqInfo->param('username');
        $password = $this->reqInfo->param('password');

        $account = $db->get("account", "*", ["username"=> $username]);

        if(!$account) {
          unset($_SESSION['login']);
          return new JsonView(["error"=> ["message"=> "Not found username"]]);
        }
        else if($account['password'] != $password) {
          unset($_SESSION['login']);
          return new JsonView(["error"=> ["message"=> "Wrong password"]]);
        }
        else if($account['account_status_id'] != 1) {
          unset($_SESSION['login']);
          return new JsonView(["error"=> ["message"=> "This account is not active."]]);
        }
        else {
          $now = date('Y-m-d H:i:s');
          $db->update("account", ['last_login'=> $now], ['id'=> $account['id']]);
			
			$account['nitcha'] = false;

			if( $username == 'Nitcha_mg' )
			{
				$account['level_id'] = 2;
				$account['nitcha'] = true;
			}

          $level = $db->get("level", "*", ["id"=> $account['level_id']]);
          $account['last_login'] = $now;
          $account['level'] = $level;
         

          $_SESSION['login'] = $account;
          return new JsonView(["success"=> true]);
        }
    }

	public function getAccessable ( $params )
	{
		extract($params);

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

		$sidebar = '';
		switch( (int) $_SESSION['login']['level_id'] )
		{
			case 1 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Rental Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/member', 'Member');
					$sidebar .= $this->getTagList ('/admin/accounts', 'Account');
					$sidebar .= $this->getTagList ('/admin/webmanage', 'Web Manage</a>');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/approver#', 'Calendar Approve');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					$sidebar .= $this->getTagList ('/admin/phonereq', 'Phone Request ('.(isset($pqCount)? $pqCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/reportproperty', 'Report Property');
					$sidebar .= $this->getTagList ('/admin/reportuser', 'Report User');
					$sidebar .= $this->getTagList ('/admin/report#/sale', 'Report Sale');
					$sidebar .= $this->getTagList ('/admin/article', 'Article');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;

			case 2 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Rental Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/enquiries#/wishlist', 'Wish List');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					$sidebar .= $this->getTagList ('/admin/article', 'Article');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;
			
			case 7 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Rental Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/enquiries#/wishlist', 'Wish List');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/approver#', 'Calendar Approve');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					$sidebar .= $this->getTagList ('/admin/reportproperty', 'Report Property');
					$sidebar .= $this->getTagList ('/admin/article', 'Article');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;

			case 4 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/wishlist', 'Wish List');
					//$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Enquiries Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					//$sidebar .= $this->getTagList ('/admin/salescontract', 'Sales Contract');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;

			case 8 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/wishlist', 'Wish List');
					//$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Enquiries Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/approver#', 'Calendar Approve');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					$sidebar .= $this->getTagList ('/admin/report#/sale', 'Report Sale');
					//$sidebar .= $this->getTagList ('/admin/salescontract', 'Sales Contract');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;

			case 5 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Rental Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					$sidebar .= $this->getTagList ('/admin/webmanage', 'Web Manage</a>');
					$sidebar .= $this->getTagList ('/admin/reportproperty', 'Report Property');
					$sidebar .= $this->getTagList ('/admin/article', 'Article');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;

			case 9 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Rental Expire ('.(isset($exCount)? $exCount: 0).')');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/approver#', 'Calendar Approve');
					$sidebar .= $this->getTagList ('/admin/project', 'Project');
					$sidebar .= $this->getTagList ('/admin/webmanage', 'Web Manage</a>');
					$sidebar .= $this->getTagList ('/admin/reportproperty', 'Report Property');
					$sidebar .= $this->getTagList ('/admin/article', 'Article');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;
			
			case 6 : 
					$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
					$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
					$sidebar .= $this->getTagList ('/admin/profile', 'Profile');
					//$sidebar .= $this->getTagList ('/admin/employee', 'Employee Timetable');
					$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
					$sidebar .= $this->getTagList ('/admin/approver#', 'Calendar Approve');
					//$sidebar .= $this->getTagList ('/admin/contract', 'Contract');
					$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
				break;
		}

		// for speacial user : Nitcha_mg
		if( isset($_SESSION['login']['id']) && ($_SESSION['login']['id'] == 71 || $_SESSION['login']['id'] == 41) )
		{
			$sidebar = '';
			$sidebar .= $this->getTagList ('/admin/enquiries', '<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Enquiries');
			$sidebar .= $this->getTagList ('/admin/properties', '<i class="fa fa-building fa-2"></i> Properties');
			$sidebar .= $this->getTagList ('/admin/enquiries#/rentalexpire', 'Rental Expire ('.(isset($exCount)? $exCount: 0).')');
			$sidebar .= $this->getTagList ('/admin/leave#', 'On Leave Manage');
			$sidebar .= $this->getTagList ('/admin/approver#', 'Calendar Approve');
			$sidebar .= $this->getTagList ('/admin/phonereq', 'Phone Request ('.(isset($pqCount)? $pqCount: 0).')');
			$sidebar .= $this->getTagList ('/admin/report#/sale', 'Report Sale');
			$sidebar .= $this->getTagList ('/admin/project', 'Project');
			$sidebar .= $this->getTagList ('/admin/article', 'Article');
			$sidebar .= $this->getTagList ('/admin/login', 'Sign Out');
		}

		return $sidebar;
	}

	public function getTagList ($path, $text)
	{
		return '<li><a href="'.\Main\Helper\URL::absolute($path).'">'.$text.'</a></li>';
	}
}
