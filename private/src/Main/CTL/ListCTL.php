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

      $searchQuery = "1";
      $excParams = [];
      if(!empty($params['project_id'])) {
        $searchQuery .= " AND property.project_id=:project_id";
        $excParams[":project_id"] = $params['project_id'];
      }
      if(!empty($params['property_type_id'])) {
        $searchQuery .= " AND property.property_type_id=:property_type_id";
        $excParams[":property_type_id"] = $params['property_type_id'];
      }
      if(!empty($params['bts_id'])) {
        $searchQuery .= " AND property.bts_id=:bts_id";
        $excParams[":bts_id"] = $params['bts_id'];
      }
      if(!empty($params['mrt_id'])) {
        $searchQuery .= " AND property.mrt_id=:mrt_id";
        $excParams[":mrt_id"] = $params['mrt_id'];
      }
      if(!empty($params['zone_id'])) {
        $searchQuery .= " AND property.zone_id=:zone_id";
        $excParams[":zone_id"] = $params['zone_id'];
      }
      if(!empty($params['requirement_id'])) {
        $searchQuery .= " AND (property.requirement_id=:requirement_id OR property.requirement_id=3)";
        $excParams[":requirement_id"] = $params['requirement_id'];
      }
      if(!empty($params['bedrooms'])) {
        if($params['bedrooms'] == "4+") {
          $searchQuery .= " AND property.bedrooms > 3";
        }
        else {
          $searchQuery .= " AND property.bedrooms = :bedrooms";
          $excParams[":bedrooms"] = $params['bedrooms'];
        }
      }
      if(!empty($params['bathrooms'])) {
        if($params['bathrooms'] == "4+") {
          $searchQuery .= " AND property.bathrooms > 3";
        }
        else {
          $searchQuery .= " AND property.bathrooms = :bathrooms";
          $excParams[":bathrooms"] = $params['bathrooms'];
        }
      }
      // if(!empty($params['keyword'])) {
      //   $searchQuery .= " AND project.name LIKE :keyword";
      //   $excParams[":keyword"] = '%'.$params['keyword'].'%';
      // }
      if(!empty($params['price-range']) && !empty($params['requirement_id'])) {
        $field1 = $params['requirement_id'] == 1? "sell_price": "rent_price";
        $priceRange = explode('-', $params['price-range']);
        if(count($priceRange) == 0) {
          $searchQuery .= " AND ({$field1} BETWEEN :price1 AND :price2 )";
          $excParams[":price1"] = $priceRange[0];
          $excParams[":price2"] = $priceRange[1];
        }
        else {
          $searchQuery .= " AND ({$field1} >= :price)";
          $excParams[":price"] = $priceRange[0];
        }
      }

      // paging attribute
      $limit = empty($_GET['limit'])? 12: $_GET['limit'];
      $page = !empty($params['page'])? $params['page']: 1;
      $start = ($page-1)*$limit;

      $query = "SELECT property.*, project.name FROM property
        JOIN project ON property.project_id = project.id
        WHERE property.web_status=1
        AND ({$searchQuery})
        ORDER BY created_at DESC
        LIMIT :start,:limit";

      $queryCount = "SELECT COUNT(property.id) as c FROM property
        JOIN project ON property.project_id = project.id
        WHERE property.web_status=1
        AND ({$searchQuery})";

      $stmt = $db->pdo->prepare($query);
      $stmtCount = $db->pdo->prepare($queryCount);

      $stmt->execute(array_merge($excParams, [":start"=> $start, ":limit"=> $limit]));
      $stmtCount->execute($excParams);

      $items = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      $count = $stmtCount->fetch(\PDO::FETCH_ASSOC);
      $total = $count["c"];
      $pageLimit = $total/$limit;

      if($total%$limit != 0) {
        $pageLimit = ceil($pageLimit);
      }
      $this->_buildItems($items);

      // $projects = $db->select("project", "id, name");
      return new HtmlView('/list', ['items'=> $items, 'paging'=> [
          "limit"=> $limit,
          "page"=> $page,
          "pageLimit"=> $pageLimit
        ]]);
    }

    public function _buildItems(&$items)
    {
      foreach($items as &$item) {
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
      if(!$pic){
        $pic = [];
        $path = 'public/project_pic/'.$item['project']['image_path'];
        if(is_file($path)) {
          $pic['url'] = URL::absolute("/".$path);
        }
        else {
          $pic['url'] = URL::absolute("/public/images/default-project.png");
        }
      }
      else {

		if(is_file("/public/prop_pic/".$pic['name'])) {
          $pic['url'] = URL::absolute("/public/prop_pic/".$pic['name']);
        }
        else {
          $pic['url'] = URL::absolute("/public/images/default-project.png");
        }
      }
      $item['picture'] = $pic;
    }

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
}
