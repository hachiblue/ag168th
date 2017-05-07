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

use Main\Service\PropertyHilightService;
use Main\Service\FeatureUnitService;

/**
 * @Restful
 * @uri /api/collection
 */

class ApiCollection extends BaseCTL {
    /**
     * @GET
     */
    public function index () {
        $db = MedooFactory::getInstance();
        $collection = [];
        $collection['property_type'] = $db->select("property_type", "*");


        $where = [
          "ORDER"=> 'project.name'
        ];

        $collection['project'] = $db->select("project", ['name', 'id', 'province_id', 'district_id', 'sub_district_id', 'bts_id', 'mrt_id', 'airport_link_id', 'zone_id'], $where);


        $collection['key_location'] = $db->select("key_location", "*");
        // $collection['district'] = $db->select("key_location", "*");

        $collection['zone_group'] = $db->select("zone_group", "*");
        $collection['zone'] = $db->select("zone", "*");

        $collection['bts'] = $db->select("bts", "*");
        $collection['mrt'] = $db->select("mrt", "*");
        $collection['airport_link'] = $db->select("airport_link", "*");

        // $collection['zone_zone_group'] = ListDAO::gets("zone_zone_group", [
        //     "limit"=> 100
        // ]);
        // $collection['zone'] = ListDAO::gets("zone", [
        //     "limit"=> 100
        // ]);
        // $collection['zone_group'] = ListDAO::gets("zone_group", [
        //     "limit"=> 100
        // ]);
//        foreach($collection['zone_group']['data'] as $key => $value){
//
//        }

        
        $where = [
          "property_status.id[!]" => array(6, 7)
        ];

        $collection['property_status'] = $db->select("property_status", "*", $where);

        /*
    		$join = [
    		  "[><]account"=> ["comment_by"=> "id"]
    		];
    		$field = [
    			"account.id",
    			"account.name"
    		];
    		$where = [
    			"GROUP"=> "property_comment.comment_by",
    			"ORDER"=> "account.name"
    		];

    		$collection['property_comment'] = ListDAO::gets("property_comment", [
    			"field"=> $field,
    			"join"=> $join,
    			"where"=> $where
    		]);
        */

        $where = [
          "requirement.id[!]" => array(5)
        ];

        $collection['requirement'] = $db->select("requirement", "*", $where);


        $collection['developer'] = ListDAO::gets("developer", [
            "limit"=> 100
        ]);
        $collection['size_unit'] = $db->select("size_unit", "*");
        $collection['customer'] = ListDAO::gets("customer", [
            "limit"=> 100
        ]);

        /** enquiry collection */
        $where = [
          "account.id[!]" => array(4, 10, 11, 14, 15, 17),
          "ORDER"=> 'account.name'
        ];
        $collection['account'] = $db->select("account", "*", $where);

		/** leave collection */
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
		$where = [
		  "ORDER"=> 'account.name'
		];

		switch( (int) $_SESSION['login']['level']['id'] )
		{
			case 3 :
			case 7 :
			case 8 :
			case 9 : $where['account.level_id'] = 6; break;

			case 2 : $where['account.level_id'] = 7; break;
			case 4 : $where['account.level_id'] = 8; break;
			case 5 : $where['account.level_id'] = 9; break;

			default : $where['account.level_id'] = 6;
		}

        $collection['lv_account'] = $db->select("account", "*", $where);


		$where = [
		  "account.id" => $_SESSION['login']['id']
		];
        $collection['lv_self_account'] = $db->select("account", "*", $where);



		/** levels collection 
		if( $_SESSION['login']['level']['id'] == 4 )
		{
			$where = [
			  "level.id" => $_SESSION['login']['level']['id']
			];
		}
		else
		{
			$where = [];
		}*/
		$where = [
			  "level.id" => $_SESSION['login']['level']['id']
			];
        $collection['levels'] = $db->select("level", "*", $where);


        $db = MedooFactory::getInstance();
        $sql = " SELECT * FROM enquiry_status WHERE id NOT IN(2, 8, 11) ORDER BY (CASE id
              WHEN 1   THEN 1
              WHEN 13    THEN 2
              WHEN 3    THEN 3
              WHEN 5 THEN 4
              WHEN 14   THEN 5
              WHEN 6   THEN 6
              WHEN 4   THEN 7
              WHEN 10   THEN 8
              WHEN 9   THEN 9
              ELSE 100 END) ASC ";
        $r = $db->query($sql);
        $row = $r->fetchAll(\PDO::FETCH_ASSOC);

        $collection['enquiry_status'] = $row;


        $collection['enquiry_budget_payment'] = ListDAO::gets("enquiry_budget_payment", [
            "limit"=> 100
        ]);
        $collection['enquiry_budget_purchases'] = ListDAO::gets("enquiry_budget_purchases", [
            "limit"=> 100
        ]);
        $collection['enquiry_reason'] = ListDAO::gets("enquiry_reason", [
            "limit"=> 100
        ]);
        $collection['enquiry_plan_tobuy'] = ListDAO::gets("enquiry_plan_tobuy", [
            "limit"=> 100
        ]);

        /* last collection */
        $collection['property_highlight'] = PropertyHilightService::getItems();
        $collection['feature_unit'] = FeatureUnitService::getItems();

        return $collection;
    }

    /**
     * @GET
     * @uri /thailocation
     */
    public function province()
    {
      $db = MedooFactory::getInstance();
      $collection = [];
      $collection['province'] = $db->select("province", "*");
      $collection['district'] = $db->select("district", "*");
      $collection['sub_district'] = $db->select("sub_district", "*");

      return $collection;
    }

	/**
     * @GET
     * @uri /saleprofile
     */
    public function sale_acc()
    {
		$db = MedooFactory::getInstance();
		$collection = [];
		$collection['data'] = $db->select("account", "*", ['level_id' => 4]);

		return $collection;
    }
	
	/**
     * @GET
     * @uri /propsgroupmessage
     */
	public function propsmessage()
    {
      $db = MedooFactory::getInstance();
      $collection = [];
		
		//$collection['groupcomment'] = $db->select("property_comment", "*", ["GROUP" => "comment_by"]);
		
		
		$field = [ 
			"property_comment.*",
			"account.id(aid)",
			"account.name(aname)"
		];
		$join = [
			"[><]account"=> ["comment_by"=> "id"]	
		];
		$where = [
		  "GROUP"=> "property_comment.comment_by",
      "ORDER"=> 'account.name'
		];

		$collection['groupcomment'] = ListDAO::gets("property_comment", [
			"field"=> $field,
			"join"=> $join,
			"where"=> $where
		]);
		


      return $collection;
    }
}

