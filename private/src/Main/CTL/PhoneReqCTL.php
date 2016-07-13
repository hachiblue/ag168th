<?php

namespace Main\CTL;
use FileUpload\FileUpload;
use Main\DAO\ListDAO;
use Main\DB\Medoo\MedooFactory;
use Main\Helper\ArrayHelper;
use Main\Helper\ResponseHelper;
use Main\Helper\URL;
use Main\Helper\LastAssignManagerHelper;

/**
 * @Restful
 * @uri /api/phone_req
 */
class PhoneReqCTL extends BaseCTL
{
  /**
   * @GET
   */
  public function index ()
  {
    $db = MedooFactory::getInstance();
    $page = !empty($_GET['page'])? $_GET['page']: 1;
    $join = [
      "[>]property"=> ["property_id"=> "id"],
      "[>]account"=> ["account_id"=> "id"],
      "[>]enquiry"=> ["enquiry_id"=> "id"]
    ];
    $field = [
      "request_contact.*",
      "property.reference_id",
      "enquiry.enquiry_no"
    ];
    $where = [
      "ORDER"=> "created_at DESC"
    ];
    $list = ListDAO::gets("request_contact", [
        "field"=> $field,
        "join"=> $join,
        "where"=> $where,
        "page"=> $page,
        "limit"=> 15
    ]);

    return $list;
  }
}
