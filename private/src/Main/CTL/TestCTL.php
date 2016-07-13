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

/**
 * @Restful
 * @uri /test
 */
class TestCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {
      foreach($property as &$item) {
        unset($item['id']);
        $where = ["AND"=> ["address"=> $item["address"]], ["project_id"=> $item["project_id"]]];
        if($db->get('property', $where)) {
          $db->update("property", $item, $where);
        }
        else {
          $db->insert("property", $item);
        }
      }

      $db = \Main\DB\Medoo\MedooFactory::getInstance();

    }

    /**
     * @PUT
     */
    public function getTest(){
        // if PHP under version 5.4 use return new JsonView(array("message"=> "test"));
        return ($this->reqInfo->params());
    }



    /**
     * @GET
     * @uri /[i:id]
     */
    public function getTestById(){
        $id = $this->reqInfo->urlParam("id");

        // if PHP under version 5.4 use return new JsonView(array("id"=> $id));
        return new JsonView(["id"=> $id]);
    }

    /**
     * @GET
     * @uri /merge
     */
    public function testMerge()
    {
      $db = \Main\DB\Medoo\MedooFactory::getInstance();
      $db2 = \Main\DB\Medoo\MedooFactory::getInstance("111");

      $m = 0;
      $items = $db2->select("project", "*", ["address[!]"=> null]);
      foreach($items as $item) {
        $db->update("project", ["address"=> $item["address"]], ["id"=> $item["id"], "address"=> [null, 0, '0']]);
        $m++;
      }

      return $m;
    }
}
