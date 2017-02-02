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

		// paging attribute
		$limit = empty($_GET['limit'])? 9: $_GET['limit'];
		$page = !empty($params['page'])? $params['page']: 1;
		$start = ($page-1)*$limit;

		$query = "SELECT pj.*, pv.name as province_name, sd.name as district_name FROM project pj, province pv, sub_district sd
		WHERE pj.province_id = pv.id AND pj.sub_district_id = sd.id
		AND ({$searchQuery}) AND pj.name != 'Unspecified'
		ORDER BY (CASE pj.bts_id
           WHEN 15 THEN 1
           WHEN 12 THEN 0
         END) DESC, created_at DESC
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

	function is_file_exists($filePath)
	{ 
		$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/';

		return is_file($root.$filePath) && file_exists($root.$filePath);
	}
}
