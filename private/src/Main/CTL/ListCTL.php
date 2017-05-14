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
 * @uri /list
 */
class ListCTL extends BaseCTL {

    private $projects = [];

    /**
     * @GET
     */
    public function index ()
    {
		$params = $this->reqInfo->params();
		$reqTypeId = empty($params['requirement_id'])? 0: $params['requirement_id'];
		$propTypeId = empty($params['property_type_id'])? 0: $params['property_type_id'];
		$db = MedooFactory::getInstance();
		
			
		if( isset($params['q']) && !empty($params['q']) )
		{
			$query = "select p.id, p.name, pv.id as province_id, pv.name as province, z.id as zone_id, z.name as zone_name from project p, property pp, zone z, province pv where pp.project_id = p.id and p.province_id = pv.id and p.zone_id = z.id and ( p.name like :na OR pp.reference_id like :nab  ) GROUP BY p.id limit 200";
			$stmt = $db->pdo->prepare($query);
			$keyword = "%".$params['q']."%";
			$stmt->bindValue(':na', $keyword, \PDO::PARAM_STR);
			$stmt->bindValue(':nab', $keyword, \PDO::PARAM_STR);
			$stmt->execute();
			$items = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			$res = array();
			foreach( $items as $data )
			{	
				$res[] = array( $data['name'], $data['id'], $data['province'], $data['zone_name'], $data['zone_id'], $data['province_id'] );
			}

			echo json_encode($res);
			exit;
		}

		$searchQuery = "1";
		$excParams = [];

		if(!empty($params['searchBy'])) 
		{
			$isAC = $db->count("property", ["reference_id"=> $params['searchBy']]);
			if( $isAC )
			{
				$searchQuery .= " AND property.reference_id=:reference_id";
				$excParams[":reference_id"] = $params['searchBy'];
			}
		}

		if(!empty($params['project_id'])) 
		{
			$searchQuery .= " AND property.project_id=:project_id";
			$excParams[":project_id"] = $params['project_id'];
		}

		if(!empty($params['property_type_id'])) 
		{
			$searchQuery .= " AND property.property_type_id=:property_type_id";
			$excParams[":property_type_id"] = $params['property_type_id'];
		}

		if(!empty($params['bts_id'])) 
		{
			$searchQuery .= " AND property.bts_id=:bts_id";
			$excParams[":bts_id"] = $params['bts_id'];
		}

		if(!empty($params['mrt_id'])) 
		{
			$searchQuery .= " AND property.mrt_id=:mrt_id";
			$excParams[":mrt_id"] = $params['mrt_id'];
		}

		if(!empty($params['zone_id'])) 
		{
			$searchQuery .= " AND property.zone_id=:zone_id";
			$excParams[":zone_id"] = $params['zone_id'];
		}

		if(!empty($params['requirement_id'])) 
		{
			$searchQuery .= " AND (property.requirement_id=:requirement_id OR property.requirement_id=3)";
			$excParams[":requirement_id"] = $params['requirement_id'];
		}

		if(!empty($params['feature_unit_id'])) 
		{
			$searchQuery .= " AND property.feature_unit_id=:feature_unit_id";
			$excParams[":feature_unit_id"] = $params['feature_unit_id'];
		}

		if(!empty($params['bedrooms'])) 
		{
			if($params['bedrooms'] == "4+") 
			{
				$searchQuery .= " AND property.bedrooms > 3";
			}
			else 
			{
				$searchQuery .= " AND property.bedrooms = :bedrooms";
				$excParams[":bedrooms"] = $params['bedrooms'];
			}
		}

		if(!empty($params['bathrooms'])) 
		{
			if($params['bathrooms'] == "4+") 
			{
				$searchQuery .= " AND property.bathrooms > 3";
			}
			else 
			{
				$searchQuery .= " AND property.bathrooms = :bathrooms";
				$excParams[":bathrooms"] = $params['bathrooms'];
			}
		}

		// if(!empty($params['keyword'])) {
		//   $searchQuery .= " AND project.name LIKE :keyword";
		//   $excParams[":keyword"] = '%'.$params['keyword'].'%';
		// }

		if( ( !empty($params['price-range-min']) || !empty($params['price-range-max']) ) && !empty($params['requirement_id'])) 
		{
			$field1 = $params['requirement_id'] == 1? "sell_price": "rent_price";

			if( $params['price-range-min'] > 0 && $params['price-range-max'] > 0 ) 
			{
				$searchQuery .= " AND ({$field1} BETWEEN :price1 AND :price2 )";
				$excParams[":price1"] = $params['price-range-min'];
				$excParams[":price2"] = $params['price-range-max'];
			}
			elseif( $params['price-range-min'] > 0 && $params['price-range-max'] == '' )
			{
				$searchQuery .= " AND ({$field1} >= :price)";
				$excParams[":price"] = $params['price-range-min'];
			}
			elseif( $params['price-range-max'] > 0 && $params['price-range-min'] == '' )
			{
				$searchQuery .= " AND ({$field1} <= :price)";
				$excParams[":price"] = $params['price-range-max'];
			}
		}

		$arrfact = array('swimming_pool', 'onsen', 'gym', 'harden', 'futsal', 'badminton', 'basketball', 'tennis', 'bowling', 'pool_room', 'game_room', 'playground', 'meeting_room', 'private_butler', 'shuttle_bus', 'minimart_supermarket', 'restaurant', 'laundry_service', 'private_parking', 'bathtub_inside_unit');

		foreach( $arrfact as $i => $fct )
		{
			if( isset($params[$fct]) )
			{
				$field = 'has_' . $fct;
				$searchQuery .= " AND ({$field} = 1)";
			}
		}

		// paging attribute
		$limit = empty($_GET['limit'])? 9: $_GET['limit'];
		$page = !empty($params['page'])? $params['page']: 1;
		$start = ($page-1)*$limit;

		$query = "SELECT property.*, project.name, pv.name as province_name, sd.name as district_name FROM property
		JOIN project ON property.project_id = project.id, province pv, sub_district sd
		WHERE property.web_status=1 AND property.province_id = pv.id AND property.sub_district_id = sd.id AND property.web_status = 1
		AND ({$searchQuery}) AND project.name != 'Unspecified' AND property_status_id = '1'
		ORDER BY created_at DESC, IF(property.requirement_id='".$params['requirement_id']."', (CASE property.bts_id
           WHEN 15 THEN 1
           WHEN 12 THEN 0
         END), (CASE property.bts_id
           WHEN 15 THEN 0
           WHEN 12 THEN 1
         END)) DESC, RAND()
		LIMIT :start,:limit";

		$queryCount = "SELECT COUNT(property.id) as c FROM property
		JOIN project ON property.project_id = project.id, province pv, sub_district sd
		WHERE property.web_status=1 AND property.province_id = pv.id AND property.sub_district_id = sd.id AND property.web_status = 1
		AND ({$searchQuery}) AND project.name != 'Unspecified' AND property_status_id = '1' ";

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
		
		$this->_buildZone($zone);
		$this->_buildBTS($bts);
		$this->_buildMRT($mrt);

		$this->_buildItems($items);
	
		$act = $reqTypeId == 1 ? 'act2' : 'act3';

		// $projects = $db->select("project", "id, name");
		return new HtmlView('/template/layout', [
			'page' => 'list',
			$act => 'act',
			'items'=> $items, 
			'zone'=> $zone, 
			'bts'=> $bts, 
			'mrt'=> $mrt, 
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
			$item['project'] = $this->getProject($item['project_id']);
			$this->_buildThumb($item);
			$this->_buildPropertyType($item);
			$this->_buildRequirement($item);
		}
    }

    public function _buildPropertyType(&$item)
    {
		$db = MedooFactory::getInstance();
		$type = $db->get("property_type", "*", ["id"=> $item['property_type_id']]);
		$item['property_type'] = $type;
    }

    public function _buildRequirement(&$item)
    {
		$db = MedooFactory::getInstance();
		$type = $db->get("requirement", "*", ["id"=> $item['requirement_id']]);
		$item['requirement'] = $type;
    }

    public function _buildThumb(&$item)
    {
		$db = MedooFactory::getInstance();

		$pic = $db->get("property_image", "*", ["property_id"=> $item['id']]);

		if(empty($pic))
		{
			$pic = array();
			$path = 'public/project_pic/'.$item['project']['image_path'];
			if( isset($item['project']['image_path']) && !empty($item['project']['image_path']) && $this->is_file_exists( $path ) ) 
			{
				$pic['url'] = URL::absolute("/".$path);
			}
			else 
			{
				$pic['url'] = URL::absolute("/public/assets/default-project.jpg");
			}
		}
		else 
		{
			if( !empty($pic['name']) && $this->is_file_exists( "public/prop_pic/".$pic['name'] ) ) 
			{
				$pic['url'] = URL::absolute("/public/prop_pic/".$pic['name']);
			}
			else 
			{
				$pic['url'] = URL::absolute("/public/assets/default-project.jpg");
			}
		}

		$item['picture'] = $pic;
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

    public function getProject($id)
    {
		foreach($this->projects as $item) 
		{
			if($item['id'] == $id) return $item;
		}

		$db = MedooFactory::getInstance();
		$project = $db->get("project", "*", ["id"=> $id]);
		if($project) 
		{
			$project["images"] = $db->select("project_image", "*", ["project_id"=> $id]);
			foreach($project["images"] as &$img) 
			{
				$img["url"] = URL::absolute("/public/project_pics/".$img['image_path']);
			}

			$this->projects[] = $project;
		}

		return $project;
    }

	function is_file_exists($filePath)
	{ 
		$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/';

		return is_file($root.$filePath) && file_exists($root.$filePath);
	}
}
