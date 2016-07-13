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
 * @uri /api/bookreq
 */
class ApiBookReq extends BaseCTL
{
  /**
   * @GET
   */
  public function index ()
  {
    $db = MedooFactory::getInstance();
    $join = [
      "[>]property"=> ["book_property_id"=> "id"],
      "[>]account(sale)"=> ["assign_sale_id"=> "id"],
      // "[>]enquiry"=> ["enquiry_id"=> "id"],
      "[>]project"=> ["enquiry.project_id"=> "id"],
      "[>]project(project_prop)"=> ["property.project_id"=> "id"],
      "[>]account(manager)"=> ["assign_manager_id"=> "id"],
      "[>]requirement(req_enq)"=> ["enquiry.requirement_id"=> "id"]
    ];
    $field = [
      "property.reference_id",
      "property.project_id",
      "property.address_no",

      // "sale.id",
      "sale.name(sale_name)",
      "sale.phone(sale_phone)",

      "enquiry.enquiry_no",
      "enquiry.customer",
      "req_enq.name_for_enquiry(req_name_for_enquiry)",

      "project_prop.name(project_name)",
      "project.name(project_name_enq)",
      // "project_enq.name(project_name_enq)",

      "manager.name(manager_name)",
      "enquiry.wait_book_approve",
      "enquiry.id",
      "enquiry.book_property_id"

      // "request_contact.*"
    ];
    $where = [
      "ORDER"=> "enquiry.updated_at DESC"
    ];
    $where['AND']['enquiry.wait_book_approve'] = 1;
    if($_SESSION['login']['level_id'] == 3) {
      $where['AND']['enquiry.assign_manager_id'] = $_SESSION['login']['id'];
    }
    $list = ListDAO::gets("enquiry", [
        "field"=> $field,
        "join"=> $join,
        "where"=> $where,
        "limit"=> 15
    ]);
    // return \Main\DB\Medoo\MedooFactory::getInstance()->error();

    return $list;
  }

  /**
   * @POST
   * @uri /[i:id]/accept
   */
  public function accept()
  {
    $id = $this->reqInfo->urlParam("id");
    $db = MedooFactory::getInstance();
    $db->update("enquiry",
      ["enquiry_status_id"=> 7, 'wait_book_approve'=> 0],
      ["id"=> $id]);

    $item = $db->get("enquiry", "*", ["id"=> $id]);
    $acc = $db->get("account", "*", ["id"=> $_SESSION['login']['id']]);

    $url = URL::absolute("/admin/enquiries#/edit/".$id);
    $urlProp = URL::absolute("/admin/properties#/edit/".$item['book_property_id']);
    $prop = $db->get("property", ["reference_id"], ['id'=> $item['book_property_id']]);

    $mailContent = <<<MAILCONTENT
    Enquiry has booked.<br />
    Please go to property and change status to booked.<br />
    Enquiry: <a href="{$url}">{$item["enquiry_no"]}</a>.<br />
    Property: <a href="{$urlProp}">{$prop["reference_id"]}</a>.<br />
    Approve by: {$acc['name']}.<br />
MAILCONTENT;

    $mailHeader = "From: system@agent168th.com\r\n";
    $mailHeader = "To: admin@agent168th.com\r\n";
    $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";

    @mail("admin@agent168th.com", "Booked enquiry: ".$item["enquiry_no"], $mailContent, $mailHeader);

    return ["success"=> true];
  }

  /**
   * @POST
   * @uri /[i:id]/denine
   */
  public function denine()
  {
    $id = $this->reqInfo->urlParam("id");
    $db = MedooFactory::getInstance();
    $db->update("enquiry",
      ["enquiry_status_id"=> 5, 'wait_book_approve'=> 0, 'book_property_id'=> NULL],
      ["id"=> $id]);

    return ["success"=> true];
  }

  // internal function
  public function _builds(&$items)
  {
    $enqIdList = array_map(function($item){
      return $item["enquiry_id"];
    }, $items);

    $db = MedooFactory::getInstance();
    $enqs = $db->select("project", ["id", "name"], ["id"=> $enqIdList]);

    foreach($items as &$item){

    }
  }
}
