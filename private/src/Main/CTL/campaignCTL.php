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
 * @uri /campaign
 */
class campaignCTL extends BaseCTL {

    /**
     * @GET
     */
    public function index () {
        $db = MedooFactory::getInstance();
        $items = $db->select("article", "*");
        $this->_builds($items);
        return new HtmlView('/campaign', ['items'=> $items]);
    }

    /**
     * @GET
     * @uri /[i:id]
     */
    public function byId () {
      $id = $this->reqInfo->urlParam("id");
      $db = MedooFactory::getInstance();
      $item = $db->get("article", "*", ["id"=> $id]);
      return new HtmlView('/campaignId', ['item'=> $item]);
    }

    public function _builds(&$items)
    {
      foreach($items as &$item)
        $this->_build($item);
    }

    public function _build(&$item)
    {
      $item["image_url"] = URL::absolute("/public/article_pic/".$item["image_path"]);
    }
}
