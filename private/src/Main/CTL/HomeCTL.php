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
      $query = "SELECT * FROM property
        WHERE web_status=1
        AND (property_highlight_id IS NOT NULL AND property_highlight_id != 0)
        ORDER BY RAND()
        LIMIT 3";

      $stmt = $db->pdo->prepare($query);
      $stmt->execute();
      $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $this->_buildItems($items);

		
	  $query = "SELECT * FROM property
        WHERE web_status=1
        AND (feature_unit_id = 1)
        ORDER BY RAND()
        LIMIT 3";

      $stmt = $db->pdo->prepare($query);
      $stmt->execute();
      $items2 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $this->_buildItems($items2);


	  $query = "SELECT * FROM property
        WHERE web_status=1
        AND (feature_unit_id = 2)
        ORDER BY RAND()
        LIMIT 3";

      $stmt = $db->pdo->prepare($query);
      $stmt->execute();
      $items3 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $this->_buildItems($items3);


	  $query = "SELECT * FROM property
        WHERE web_status=1
        AND (feature_unit_id = 3)
        ORDER BY RAND()
        LIMIT 3";

      $stmt = $db->pdo->prepare($query);
      $stmt->execute();
      $items4 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $this->_buildItems($items4);


	  $query = "SELECT * FROM property
        WHERE web_status=1
        AND (feature_unit_id = 4)
        ORDER BY RAND()
        LIMIT 3";

      $stmt = $db->pdo->prepare($query);
      $stmt->execute();
      $items5 = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $this->_buildItems($items5);


      $slide_1 = ApiLayout::_get("slide_1");
      $slide_1 = json_decode($slide_1);

      return new HtmlView('/home', ['highlight'=> $items, 'bestbuy' => $items2, 'hotrental' => $items3, 'withtenant' => $items4, 'newcoming' => $items5, 'slide_1'=> $slide_1]);
    }

    public function _buildItems(&$items)
    {
      foreach($items as &$item) {
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
			$path = 'private/src/Main/ThirdParty/uploads/'.$item['project']['image_path'];
			if(is_file($path)) 
			{
				$pic['url'] = URL::absolute("/".$path);
			}
			else 
			{
				$pic['url'] = URL::absolute("/public/images/default-project.png");
			}
		}
		else 
		{
			if(is_file("/public/prop_pic/".$pic['name'])) 
			{
				$pic['url'] = URL::absolute("/public/prop_pic/".$pic['name']);
			}
			else 
			{
				$pic['url'] = URL::absolute("/public/images/default-project.png");
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
      foreach($this->projects as $item) {
        if($item['id'] == $id) return $item;
      }

      $db = MedooFactory::getInstance();
      $project = $db->get("project", "*", ["id"=> $id]);
      if($project) $this->projects[] = $project;

      return $project;
    }
}
