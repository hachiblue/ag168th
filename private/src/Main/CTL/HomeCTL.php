<?php
/**
 * Created by PhpStorm.
 * User: bbillboy
 * Date: 19/6/2558
 * Time: 11:35
 */
namespace Main\CTL;


use Main\Context\Context;
use Main\Http\RequestInfo;
use Main\View\HtmlView;
use Main\View\JsonView;
use Main\ThirdParty\Xcrud\Xcrud;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\URL;

use Main\CTL\ApiLayout;

/**
 * @Restful
 * @uri /home
 */
class HomeCTL extends BaseCTL {

    private $projects = [];

	/**
	 * @GET
	 */
	public function index ()
	{
		$params = $this->reqInfo->params();
		$db = MedooFactory::getInstance();
		
		$pItems = array('page' => 'home', 'act1' => 'act');
		
		$query = "SELECT p.*, IF(p.sell_price=0, p.rent_price, p.sell_price) AS price
					FROM
					  property p
					WHERE  p.web_status = 1 
					  AND (
						p.property_highlight_id IS NOT NULL 
						AND p.property_highlight_id = '".rand(1, 4)."'
					  ) 
					ORDER BY RAND() 
					LIMIT 6 ";

		$stmt = $db->pdo->prepare($query);
		$stmt->execute();
		$items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$this->_buildItems($items);
		
		$highlight_prop = array( '1' => 'Sale at Lost and Plus', '2' => 'Sale at Cost', '3' => 'Sale under Market Price', '4' => 'Made Over already');
		
		$pItems['highlight'] = array();
		if( isset($items[0]) )
		{
			$pItems['highlight'] = array(
				$highlight_prop[$items[0]['property_highlight_id']] => $items
			);
		}

		$feature_unit_id = array(
			'Best Buy', 'Hot Price', 'Discount', 'New', 'HIGHLIGHT OF THE MONTH', 'AROUND XXX M.', 'A BEAUTY OF RIVER', 'IN THE MIDDLE OF EVERYWHERE'
		);
			
		$pItems['feature_unit'] = array();
		
		unset($items);

		foreach( $feature_unit_id as $i => $topic )
		{
			$query = "SELECT p.*, IF(p.sell_price=0, p.rent_price, p.sell_price) AS price FROM property p WHERE  p.web_status = 1 AND ( p.property_highlight_id IS NOT NULL AND p.feature_unit_id = '".$i."' ) ORDER BY RAND() LIMIT 6 ";

			$stmt = $db->pdo->prepare($query);
			$stmt->execute();
			$items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			$this->_buildItems($items);

			$pItems['feature_unit'][$topic] = $items;

			unset($items);

			if( $i == 3 ) break;
		}

		/*
		$query = "SELECT p.*, v.name as province_name, j.name as project_name FROM property p, province v, project j
		WHERE p.province_id = v.id AND p.project_id = j.id AND p.web_status=1
		AND p.feature_unit_id = 1
		ORDER BY RAND()
		LIMIT 6";

		$stmt = $db->pdo->prepare($query);
		$stmt->execute();
		$items2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$this->_buildItems($items2);


		$query = "SELECT p.*, v.name as province_name, j.name as project_name FROM property p, province v, project j
		WHERE p.province_id = v.id AND p.project_id = j.id AND p.web_status=1
		AND p.feature_unit_id = 2
		ORDER BY RAND()
		LIMIT 6";

		$stmt = $db->pdo->prepare($query);
		$stmt->execute();
		$items3 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$this->_buildItems($items3);


		$query = "SELECT p.*, v.name as province_name, j.name as project_name FROM property p, province v, project j
		WHERE p.province_id = v.id AND p.project_id = j.id AND p.web_status=1
		AND p.feature_unit_id = 3
		ORDER BY RAND()
		LIMIT 6";

		$stmt = $db->pdo->prepare($query);
		$stmt->execute();
		$items4 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$this->_buildItems($items4);


		$query = "SELECT p.*, v.name as province_name, j.name as project_name FROM property p, province v, project j
		WHERE p.province_id = v.id AND p.project_id = j.id AND p.web_status=1
		AND p.feature_unit_id = 4
		ORDER BY RAND()
		LIMIT 6";

		$stmt = $db->pdo->prepare($query);
		$stmt->execute();
		$items5 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$this->_buildItems($items5);*/


		//$slide_1 = ApiLayout::_get("slide_1");
		//$slide_1 = json_decode($slide_1);

		return new HtmlView('/template/layout', $pItems);
	}

    public function _buildItems(&$items)
    {
		foreach($items as &$item) 
		{
			$item['project'] = $this->getProject($item['project_id']);
			$this->_buildThumb($item);
			$this->_buildSizeUnit($item);
			$this->_buildRequirement($item);
		}
    }

    public function _buildThumb(&$item)
    {
		$db = MedooFactory::getInstance();
		$pic = $db->get("property_image", "*", ["property_id"=> $item['id']]);

		if(!$pic)
		{
			$pic = [];
			//$path = 'private/src/Main/ThirdParty/uploads/'.$item['project']['image_path'];
			$path = '/public/project_pic/'.$item['project']['image_path'];
			//if(is_file($path)) 
			if( $this->is_file_exists( $path ) ) 
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
			if( $this->is_file_exists( "public/prop_pic/".$pic['name'] ) ) 
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

    public function _buildSizeUnit(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['size_unit'] = $db->get("size_unit", "*", ["id"=> $item['size_unit_id']]);
    }

    public function _buildRequirement(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['requirement'] = $db->get("requirement", "*", ["id"=> $item['requirement_id']]);
    }

    public function getProject($id)
    {
		foreach($this->projects as $item) 
		{
			if($item['id'] == $id) return $item;
		}

		$db = MedooFactory::getInstance();
		$project = $db->get("project", "*", ["id"=> $id]);
		if($project) $this->projects[] = $project;

		return $project;
    }

	function is_file_exists($filePath)
	{ 
		$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/';

		return is_file($root.$filePath) && file_exists($root.$filePath);
	}

}
