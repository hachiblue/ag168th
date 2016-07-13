<?php
exit();

require("bootstrap.php");

use Main\DB\Medoo\MedooFactory;

$dt = date("y-m-d H:i:s", time() - (24*60*60));


$db = MedooFactory::getInstance();
$items = $db->select("enquiry", [
  "id",
  "enquiry_status_id",
  "enquiry_no",
  "assign_manager_id",
  "assign_sale_id",
  "assign_sale_at"
], [
    "AND"=> [
      "enquiry_status_id"=> 1,
      "assign_sale_at[<]"=> $dt
      ]
  ]);

foreach($items as $item) {
  backToManager($item);
  notify($item);
}

function backToManager($item)
{
  $db = MedooFactory::getInstance();
  $now = date("Y-m-d H:i:s");
  $db->insert("case_log", [
    "account_id"=> $item["assign_sale_id"],
    "type_id"=> 1,
    "created_at"=> $now,
    "is_notify"=> 0
    ]);
  $db->update("enquiry", ["assign_sale_id"=> NULL, "assign_sale_at"=> NULL], ["id"=> $item["id"]]);
}

function notify($item)
{
  $db = MedooFactory::getInstance();
  $c = $db->count("case_log", [
    "AND"=>[
      "account_id"=> $item["assign_sale_id"],
      "is_notify"=> 0,
      "type_id"=> 1
      ]
    ]);
  if($c >= 3) {
    $db->update("case_log",
      ["is_notify"=> 1],
      [
        "AND"=>[
          "account_id"=> $item["assign_sale_id"],
          "type_id"=> 1
          ]
      ]);

      $sale = $db->get("account", "*", ["id"=> $item["assign_sale_id"]]);
      $mailContent = <<<MAILCONTENT
      Warning: sale not accept customer 3 time<br />
      ==============================<br />
      sale ID: {$sale["id"]}<br />
      sale name: {$sale["name"]}<br />
MAILCONTENT;

      $mailHeader = "From: system@agent168th.com\r\n";
      $mailHeader = "To: {$sale['email']}\r\n";
      $mailHeader .= "Content-type: text/html; charset=utf-8\r\n";
      @mail($sale["email"], "Assign enquiry: ".$item["enquiry_no"], $mailContent, $mailHeader);
  }
}
