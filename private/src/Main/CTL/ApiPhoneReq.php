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
 * @uri /api/phonereq
 */
class ApiPhoneReq extends BaseCTL
{
  /**
   * @GET
   */
  public function index ()
  {
    $page = !empty($_GET['page'])? $_GET['page']: 1;
    $db = MedooFactory::getInstance();
    $join = [
      "[>]property"=> ["property_id"=> "id"],
      "[>]account"=> ["account_id"=> "id"],
      "[>]enquiry"=> ["enquiry_id"=> "id"],
      "[>]project"=> ["property.project_id"=> "id"],
      "[>]project(project_enq)"=> ["enquiry.project_id"=> "id"],
      "[>]account(manager)"=> ["account.manager_id"=> "id"],
      "[>]account(accepted_account)"=> ["accepted_by"=> "id"],
      "[>]requirement(req_enq)"=> ["enquiry.requirement_id"=> "id"]
    ];
    $field = [
      "property.reference_id",
      "property.project_id",
      "property.address_no",

      "account.id",
      "account.name(sale_name)",
      "account.phone(sale_phone)",

      "enquiry.enquiry_no",
      "enquiry.customer",
      "req_enq.name_for_enquiry(req_name_for_enquiry)",

      "project.name(project_name)",
      "project_enq.name(project_name_enq)",

      "manager.name(manager_name)",
      "accepted_account.name(accepted_name)",

      "request_contact.*"
    ];
    $where = [
      "ORDER"=> "request_contact.created_at DESC"
    ];
    $list = ListDAO::gets("request_contact", [
        "field"=> $field,
        "join"=> $join,
        "where"=> $where,
        "limit"=> 15,
        "page"=> $page
    ]);

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

  	$now = date('Y-m-d H:i:s');
    $db->update("request_contact", ["status_id"=> 2, "accepted_at"=> $now], ["id"=> $id]);

    $item = $db->get("request_contact", "*", ["id"=> $id]);
    $prop = $db->get("property", "*", ["id"=> $item["property_id"]]);
    $acc = $db->get("account", "*", ["id"=> $item["account_id"]]);

    $owners = $db->get("owners", "*", ["id"=> $prop["owner_id"]]);
    $ows = explode(':', $owners['owner']);
    $txt_ow = '';
    foreach( $ows as $ow )
    {
      $txt_ow .= '<br>' . $ow;
    }

    $email = $acc["email"];

    $mailContent = <<<MAILCONTENT
    Owner: {$prop["owner"]}<br />
    ==============================<br />
    property no: {$prop["reference_id"]}<br />
    owner: {$txt_ow}<br />
    ==============================
MAILCONTENT;
	
	/*
    $mailHeader = "From: system@agent168th.com\r\n";
    $mailHeader = "To: {$email}\r\n";
    $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
    @mail($email, "Accept request contact property: ".$prop["reference_id"], $mailContent, $mailHeader);
	*/

	$this->mailsender ( 'system@agent168th.com', $email, 'Accept request contact property: '.$prop["reference_id"], $mailContent );

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

	$now = date('Y-m-d H:i:s');
    $db->update("request_contact", ["status_id"=> 3, "accepted_at"=> $now], ["id"=> $id]);

    $item = $db->get("request_contact", "*", ["id"=> $id]);
    $prop = $db->get("property", "*", ["id"=> $item["property_id"]]);
    $acc = $db->get("account", "*", ["id"=> $item["account_id"]]);

    $email = $acc["email"];

    $mailContent = <<<MAILCONTENT
    Denine request<br />
    ==============================<br />
    property no: {$prop["reference_id"]}
MAILCONTENT;
	
	/*
    $mailHeader = "From: admin@agent168th.com\r\n";
    $mailHeader = "To: {$email}\r\n";
    $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
    @mail($email, "Denine request contact property: ".$prop["reference_id"], $mailContent, $mailHeader);
	*/

	$this->mailsender ( 'system@agent168th.com', $email, 'Denine request contact property: '.$prop["reference_id"], $mailContent );

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
