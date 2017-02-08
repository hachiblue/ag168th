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
use Main\Service\FeatureUnitService;

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
		
		$sql = " select id, name from wm_topic limit 20";
		$stmt = $db->pdo->prepare($sql);
		$stmt->execute();
		$items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach( $items as &$prop )
		{
			$this->_buildTopic($prop);
		}

		$pItems['topics'] = $items;

		unset($items);

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

	public function _buildTopic(&$item)
	{
		$db = MedooFactory::getInstance();

		$sql = " select p.*, IF(p.sell_price=0, p.rent_price, p.sell_price) AS price from wm_property wm, property p where p.reference_id = wm.property_reference_id AND p.web_status = 1 AND wm.wm_topic_id = '".$item['id']."' order by rand() limit 5";
		$stmt = $db->pdo->prepare($sql);
		$stmt->execute();
		$item['property'] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		foreach( $item['property'] as &$prop )
		{
			$prop['project'] = $this->getProject($prop['project_id']);
			$this->_buildThumb($prop);
			$this->_buildSizeUnit($prop);
			$this->_buildRequirement($prop);
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
