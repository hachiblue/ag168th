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
use Main\Helper\URL;
use Main\DB\Medoo\MedooFactory;

/**
 * @Restful
 * @uri /project
 */
class ProjectCTL extends BaseCTL {

    /**
    * @GET
    * @uri /[:id]
    */
    public function index () 
	{
		
		$id = $this->reqInfo->urlParam("id");
		$db = MedooFactory::getInstance();
		$item = $db->get("project", "*", ["id"=> $id]);
		$this->_buildItem($item);

		$item['av_unit'] = $db->count('property', ['and' => ['web_status'=>'1', 'project_id'=>$item['id']]]);
		
		$act = 'act4';
		$pItems = array('page' => 'project', 'item'=> $item, $act => 'act');

		//return new HtmlView('/under_construct', array('page' => 'project') );

		return new HtmlView('/template/layout', $pItems);
    }
   
    public function _buildItem(&$item)
    {
      // foreach($items as &$item) {
        $this->_buildImages($item);
        $this->_buildZone($item);
        $this->_buildSub_district($item);
        $this->_buildProvince($item);
        $this->_buildUnit($item);
	// }
    }

    public function _buildZone(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['zone'] = $db->get("zone", "*", ["id"=> $item['zone_id']]);
    }

    public function _buildSub_district(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['sub_district'] = $db->get("sub_district", "*", ["id"=> $item['sub_district_id']]);
    }

    public function _buildProvince(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['province'] = $db->get("province", "*", ["id"=> $item['province_id']]);
    }

    public function _buildSizeUnit(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['size_unit'] = $db->get("size_unit", "*", ["id"=> $item['size_unit_id']]);
    }

    public function _buildUnit(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['unit']['sale'] = $db->select("property", "*", ["AND" => ["project_id"=> $item['id'], "requirement_id"=>"1"]]);
		$item['unit']['rent'] = $db->select("property", "*", ["AND" => ["project_id"=> $item['id'], "requirement_id"=>"2"]]);
		
		foreach( $item['unit']['sale'] as &$sale )
		{
			$this->_buildRoomType($sale);
			$this->_buildPropImages($sale);
			$this->_buildSizeUnit($sale);
		}

		foreach( $item['unit']['rent'] as &$rent )
		{
			$this->_buildRoomType($rent);
			$this->_buildPropImages($rent);
			$this->_buildSizeUnit($rent);
		}
    }

    public function _buildImages(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['images'] = $db->select("project_image", "*", ["project_id"=> $item['id']]);
		foreach ($item['images'] as &$img) 
		{
			$img['url'] = URL::absolute("/public/project_pics/".$img['image_path']);
		}
    }

    public function _buildPropImages(&$item)
    {
		$db = MedooFactory::getInstance();
		$item['images'] = $db->get("property_image", "*", ["property_id"=> $item['id']]);
		if( $this->is_file_exists( "/public/prop_pic/".$item['images']['name'] ) ) 
		{
			$item['images'] = URL::absolute("/public/prop_pic/".$item['images']['name']);
		}
		else 
		{
			$item['images'] = URL::absolute("/public/assets/default-project.jpg");
		} 
    }

	public function _buildRoomType(&$item)
    {
		$db = MedooFactory::getInstance();

		if( $item['room_type_id'] != '' )
		{
			$item['roomtype'] = $db->get("room_type", "*", ["id"=> $item['room_type_id']]);
		}
		else
		{
			$item['roomtype'] = array( 'name' => 'n/a' );
		}
    }

	function is_file_exists($filePath)
	{ 
		$root = realpath($_SERVER["DOCUMENT_ROOT"]) . '/';

		return is_file($root.$filePath) && file_exists($root.$filePath);
	}
}
