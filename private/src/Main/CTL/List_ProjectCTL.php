<?php
/**
 * Created by PhpStorm.
 * User: p2
 * Date: 7/15/14
 * Time: 11:27 AM
 */

namespace Main\CTL;


use Main\Context\Context;
use Main\Http\RequestInfo;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\URL;

/**
 * @Restful
 * @uri /list_project
 */
class List_ProjectCTL extends BaseCTL {

    private $projects = [];

    /**
     * @GET
     */
    public function index ()
    {
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$searchQuery = "1";
		$excParams = [];

		if(!empty($params['project_id'])) 
		{
			$searchQuery .= " AND pj.id=:id";
			$excParams[":id"] = $params['project_id'];
		}

		if(!empty($params['zone_id'])) 
		{
			$searchQuery .= " AND pj.zone_id=:zone_id";
			$excParams[":zone_id"] = $params['zone_id'];
		}

		if(!empty($params['bts_id'])) 
		{
			$searchQuery .= " AND pj.bts_id=:bts_id";
			$excParams[":bts_id"] = $params['bts_id'];
		}

		if(!empty($params['mrt_id'])) 
		{
			$searchQuery .= " AND pj.mrt_id=:mrt_id";
			$excParams[":mrt_id"] = $params['mrt_id'];
		}

		if(!empty($params['sortby']) && $params['sortby'] == 'Popular') 
		{
			$searchQuery .= " AND pj.is_popular=1";
		}

		// paging attribute
		$limit = empty($_GET['limit'])? 9: $_GET['limit'];
		$page = !empty($params['page'])? $params['page']: 1;
		$start = ($page-1)*$limit;

		$query = "SELECT pj.*, pv.name as province_name, sd.name as district_name, (select count(*) as avail_unit from property where web_status=1 and project_id=pj.id) as av_unit FROM project pj, province pv, sub_district sd
		WHERE pj.province_id = pv.id AND pj.sub_district_id = sd.id
		AND ({$searchQuery}) AND pj.name != 'Unspecified'
		ORDER BY created_at DESC, (CASE pj.bts_id
           WHEN 15 THEN 1
           WHEN 12 THEN 0
         END) DESC
		LIMIT :start,:limit";

		$queryCount = "SELECT COUNT(pj.id) as c FROM project pj, province pv, sub_district sd
		WHERE pj.province_id = pv.id AND pj.sub_district_id = sd.id 
		AND ({$searchQuery}) AND pj.name != 'Unspecified' ";

		$stmt = $db->pdo->prepare($query);
		$stmtCount = $db->pdo->prepare($queryCount);

		$stmt->execute(array_merge($excParams, [":start"=> $start, ":limit"=> $limit]));
		$stmtCount->execute($excParams);

		$items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$count = $stmtCount->fetch(\PDO::FETCH_ASSOC);
		$total = $count["c"];
		$pageLimit = $total / $limit;

		if( $total % $limit != 0 ) 
		{
			$pageLimit = ceil($pageLimit);
		}

		$this->_buildProvince($province);
		$this->_buildDistrict($district);
		$this->_buildZone($zone);
		$this->_buildBTS($bts);
		$this->_buildMRT($mrt);

		foreach($items as &$proj) 
		{
			if( $this->is_file_exists( "public/project_pic/".$proj["image_path"] ) )
			{
				$proj["image_path"] = URL::absolute("/public/project_pic/".$proj["image_path"]);
			}
			else
			{
				$proj["image_path"] = URL::absolute("/public/assets/default-project.jpg");
			}
		}

		//$this->projects[] = $project;

		//return new HtmlView('/under_construct', array('page' => 'list_project') );

		return new HtmlView('/template/layout', [
			'page' => 'list_project',
			'act4' => 'act',
			'items'=> $items, 
			'province'=> $province, 
			'district'=> $district, 
			'zone'=> $zone, 
			'bts'=> $bts, 
			'mrt'=> $mrt, 
			'items'=> $items, 
			"p" => "list", 
			'paging'=> [
				"limit"=> $limit,
				"page"=> $page,
				"pageLimit"=> $pageLimit
			]
		]);

    }
	
	public function _buildItems(&$items)
    {
		foreach($items as &$item) 
		{
			$this->_buildProvince($item);
			$this->_buildDistrict($item);
		}
    }

	public function _buildProvince(&$item)
    {
		$db = MedooFactory::getInstance();
		$province = $db->select("province", "*");
		$item['province'] = $province;
    }

	public function _buildDistrict(&$item)
    {
		$db = MedooFactory::getInstance();
		$district = $db->select("district", "*");
		$item['district'] = $district;
    }

	public function _buildZone(&$item)
    {
		$db = MedooFactory::getInstance();
		$zone = $db->select("zone", "*");
		$item['zone'] = $zone;
    }

	public function _buildBTS(&$item)
    {
		$db = MedooFactory::getInstance();
		$bts = $db->select("bts", "*");
		$item['bts'] = $bts;
    }

	public function _buildMRT(&$item)
    {
		$db = MedooFactory::getInstance();
		$mrt = $db->select("mrt", "*");
		$item['mrt'] = $mrt;
    }

	function is_file_exists($filePath)
	{ 
		$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/';

		return is_file($root.$filePath) && file_exists($root.$filePath);
	}
}
