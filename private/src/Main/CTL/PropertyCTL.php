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
 * @uri /property
 */
class PropertyCTL extends BaseCTL {

    /**
    * @GET
    * @uri /[:id]
    */
    public function index () 
	{
		$id = $this->reqInfo->urlParam("id");
		$db = MedooFactory::getInstance();
		$item = $db->get("property", "*", ["id"=> $id]);
		$this->_buildItem($item);
		
		$item['province'] = $db->get("province", "*", ["id"=> $item['province_id']]);
		$item['sub_district'] = $db->get("sub_district", "*", ["id"=> $item['sub_district_id']]);

		$pItems = array('page' => 'property', 'item'=> $item);

		return new HtmlView('/template/layout', $pItems);
    }

    /**
    * @POST
    * @uri /[:id]
    **/
    public function sendForm()
    {
      $id = $this->reqInfo->urlParam("id");
      $url = URL::absolute("/admin/properties#/edit/".$id);
      $mailContent = <<<MAILCONTENT
      Request enquiry from page property: <a href="{$url}">{$_POST["reference_id"]}</a><br />
      Requirement type: {$_POST["requirement"]}<br />
      Email: {$_POST["email"]}<br />
      First name: {$_POST["first_name"]}<br />
      Last name: {$_POST["last_name"]}<br />
      Date Request: {$_POST["daterequest"]}<br />
      Phone: {$_POST["phone"]}<br />
MAILCONTENT;

      $mailHeader = "From: system@agent168th.com\r\n";
      $mailHeader = "To: admin@agent168th.com\r\n";
      $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
      @mail("admin@agent168th.com", "Request enquiry From property page: ".$_POST["reference_id"], $mailContent, $mailHeader);

      return ['success'=> true];
    }

    public function _buildItem(&$item)
    {
      // foreach($items as &$item) {
		

        $item['project'] = $this->getProject($item['project_id']);

		$path = 'public/project_pic/'.$item['project']['image_path'];

		if( $this->is_file_exists( $path ) ) 
		{
			$proj_pic = URL::absolute("/".$path);
		}
		else 
		{
			$proj_pic = URL::absolute("/public/assets/default-project.jpg");
		}

		$item['project']['pic'] = $proj_pic;

        $this->_buildThumb($item);
        $this->_buildSizeUnit($item);
        $this->_buildRequirement($item);
        $this->_buildImages($item);
        $this->_buildPropType($item);
        $this->_buildZone($item);
      // }
    }

    public function _buildZone(&$item)
    {
      $db = MedooFactory::getInstance();
      $item['zone'] = $db->get("zone", "*", ["id"=> $item['zone_id']]);
    }

    public function _buildPropType(&$item)
    {
      $db = MedooFactory::getInstance();
      $item['property_type'] = $db->get("property_type", "*", ["id"=> $item['property_type_id']]);
    }

	public function _buildThumb(&$item)
	{
		$db = MedooFactory::getInstance();
		$pic = $db->get("property_image", "*", ["property_id"=> $item['id']]);
		if(!$pic)
		{
			$pic = [];
			$path = 'public/project_pic/'.$item['project']['image_path'];

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
			$pic['url'] = URL::absolute("/public/prop_pic/".$pic['name']);
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

    public function _buildImages(&$item)
    {
      $db = MedooFactory::getInstance();
      $item['images'] = $db->select("property_image", "*", ["property_id"=> $item['id']]);
      foreach ($item['images'] as &$img) {
        $img['url'] = URL::absolute("/public/prop_pic/".$img['name']);
      }
    }

    private $projects = [];
    public function getProject($id)
    {
      foreach($this->projects as $item) {
        if($item['id'] == $id) return $item;
      }

      $db = MedooFactory::getInstance();
      $project = $db->get("project", "*", ["id"=> $id]);
      if($project) {
        $project["images"] = $db->select("project_image", "*", ["project_id"=> $id]);
        foreach($project["images"] as &$img) {
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
